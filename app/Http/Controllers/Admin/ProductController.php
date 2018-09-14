<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\ProductLanguage;
use App\Category;
use App\Attribute;
use App\MediaLibrary;

use Excel;
use DateTime;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $_data;

    public function __construct(Request $request)
    {
        $this->_data['type'] = (isset($request->type) && $request->type !='') ? $request->type : 'default';
        $this->_data['siteconfig'] = config('siteconfig.product');
        $this->_data['default_language'] = config('siteconfig.general.language');
        $this->_data['languages'] = config('siteconfig.languages');
        $this->_data['path'] = $this->_data['siteconfig']['path'];
        $this->_data['thumbs'] = config('settings.thumbs.product') ? config('settings.thumbs.product') : $this->_data['siteconfig'][$this->_data['type']]['thumbs'];
        $this->_data['pageTitle'] = $this->_data['siteconfig'][$this->_data['type']]['page-title'];
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request){
        $whereRaw = "A.type='".$this->_data['type']."'";
        $whereRaw .= $request->category_id ? " and A.category_id=".$request->category_id : "";
        $whereRaw .= $request->title ? " and (A.code like '%".$request->title."%' or B.title like '%".$request->title."%') " : "";
        $whereRaw .= $request->created_at ? " and A.created_at like '%".$request->created_at."%'" : "";
        $whereRaw .= $request->status ? " and FIND_IN_SET('".$request->status."',A.status)" : "";
        $this->_data['oldInput'] = $request->all();
        $this->_data['categories'] = $this->getCategories($this->_data['type']);
        $this->_data['items'] = DB::table('products as A')
            ->leftjoin('product_languages as B', 'A.id','=','B.product_id')
            ->leftjoin('category_languages as C', 'A.category_id','=','C.category_id')
            ->select('A.*','B.title','C.title as category')
            ->whereRaw($whereRaw)
            ->where('B.language', $this->_data['default_language'])
            ->where('C.language', $this->_data['default_language'])
            ->orderBy('A.priority','asc')
            ->orderBy('A.id','desc')
            ->paginate(25);
        return view('admin.products.index',$this->_data);
    }
    
    public function ajax(Request $request){
        if($request->ajax()){
            $data['items'] = DB::table('products as A')
                ->leftjoin('product_languages as B', 'A.id','=','B.product_id')
                ->select('A.id','A.code','A.original_price as price','B.title')
                ->where('A.code','like', "%$request->q%")
                ->orWhere('B.title','like', "%$request->q%")
                ->where('A.type',$request->t)
                ->where('B.language', $this->_data['default_language'])
                ->orderBy('A.priority','asc')
                ->orderBy('A.id','desc')
                ->get();

            if( $data['items'] !== null ){
                foreach( $data['items'] as $key => $item ){
                    $colors = DB::table('attributes as A')
                                ->leftjoin('attribute_languages as B', 'A.id','=','B.attribute_id')
                                ->select('A.id','B.title')
                                ->whereIn('A.id', DB::table('product_attribute')->where('product_id', $item->id)->where('type','product_colors')->pluck('attribute_id') )
                                ->where('A.type','product_colors')
                                ->where('B.language', $this->_data['default_language'])
                                ->orderBy('A.priority','asc')
                                ->orderBy('A.id','desc')
                                ->get();
                    $sizes = DB::table('attributes as A')
                                ->leftjoin('attribute_languages as B', 'A.id','=','B.attribute_id')
                                ->select('A.id','B.title')
                                ->whereIn('A.id', DB::table('product_attribute')->where('product_id', $item->id)->where('type','product_sizes')->pluck('attribute_id') )
                                ->where('A.type','product_sizes')
                                ->where('B.language', $this->_data['default_language'])
                                ->orderBy('A.priority','asc')
                                ->orderBy('A.id','desc')
                                ->get();
                    $data['items'][$key]->qty = 1;
                    $data['items'][$key]->colors = $colors;
                    $data['items'][$key]->sizes = $sizes;
                }
            }
            return response()->json($data);
        }
    }
    
    public function create(){
        $this->_data['suppliers'] = $this->getSupplier();
        $this->_data['categories'] = $this->getCategories($this->_data['type']);
        if( config('siteconfig.attribute.'.$this->_data['type']) && config('siteconfig.attribute.'.$this->_data['type']) !='default'  ){
            foreach( config('siteconfig.attribute.'.$this->_data['type']) as $k => $v ){
                if( !$v ) continue;
                $this->_data['attrs'][$k] = $this->getAttributes($k);
            }
        }
        
    	return view('admin.products.create',$this->_data);
    }

    public function store(Request $request){
        // dd($request);
        $valid = Validator::make($request->all(), [
            'dataL.vi.title'   => 'required',
            'code'        => 'required|unique:products,code',
            'image'            => 'image|max:2048',
            'data.category_id' => 'exists:categories,id'
        ], [
            'dataL.vi.title.required'   => 'Vui lòng nhập Tên Sản Phẩm',
            'code.required'   => 'Vui lòng nhập Mã Sản Phẩm',
            'code.unique'          => 'Mã sản phẩm đã tồn tại, vui lòng nhập mã khác',
            'image.image'               => 'Không đúng chuẩn hình ảnh cho phép',
            'image.max'                 => 'Dung lượng vượt quá giới hạn cho phép là :max KB',
            'data.category_id.exists'   => 'Vui lòng chọn Danh mục',
        ]);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        } else {
            $product  = new Product;

            if($request->data){
                foreach($request->data as $field => $value){
                    $product->$field = $value;
                }
            }

            if($request->hasFile('image')){
                $product->image = save_image( $this->_data['path'],$request->file('image'),$this->_data['thumbs'] );
            }

            if($request->hasFile('files')){
                $fileuploader = json_decode($request->input('fileuploader-list-files'),true);
                foreach($request->file('files') as $file){
                    $fileName  = $file->getClientOriginalName();
                    if( false !== $key = array_search($fileName, $request->attachment['name']) ){
                        $fileMime  = $file->getClientMimeType();
                        $fileSize      = $file->getClientSize();
                        $imageName = save_image( $this->_data['path'],$file, null);
                        
                        if( isset($fileuploader[$key]['editor']) ){
                            $newImg  = Image::make( public_path($this->_data['path'].'/'.$imageName) );
                            if( @$fileuploader[$key]['editor']['rotation'] ){
                                $rotation = -(int)$fileuploader[$key]['editor']['rotation'];
                                $newImg->rotate($rotation);
                            }
                            if( @$fileuploader[$key]['editor']['crop'] ){
                                $width  = round($fileuploader[$key]['editor']['crop']['width']);
                                $height = round($fileuploader[$key]['editor']['crop']['height']);
                                $left   = round($fileuploader[$key]['editor']['crop']['left']);
                                $top    = round($fileuploader[$key]['editor']['crop']['top']);
                                $newImg->crop($width,$height,$left,$top);
                            }
                            $newImg->save( public_path($this->_data['path'].'/'.$imageName) );
                        }

                        $media = MediaLibrary::create([
                            'image' => $imageName,
                            'alt'   => $request->attachment['alt'][$key],
                            'editor' => isset($fileuploader[$key]['editor']) ? $fileuploader[$key]['editor'] : '',
                            'mime_type' => $fileMime,
                            'type' => $this->_data['type'],
                            'size' => $fileSize,
                            'priority'   => $request->attachment['priority'][$key],
                        ]);
                        $media_list_id[] = $media->id;
                        unset($fileuploader[$key]);
                    }
                }
                $product->attachments = implode(',',$media_list_id);
            }
            $product->code           = strtoupper($request->code);
            $product->original_price = floatval(str_replace('.', '', $request->original_price));
            $product->regular_price  = floatval(str_replace('.', '', $request->regular_price));
            $product->sale_price     = floatval(str_replace('.', '', $request->sale_price));
            $product->weight         = (int)str_replace('.', '', $request->weight);
            
            $product->priority       = (int)str_replace('.', '', $request->priority);
            $product->status         = ($request->status) ? implode(',',$request->status) : '';
            $product->user_id        = Auth::id();
            $product->type           = $this->_data['type'];
            $product->created_at     = new DateTime();
            $product->updated_at     = new DateTime();
            $product->save();

            $dataL = [];
            $dataInsert = [];
            foreach($this->_data['languages'] as $lang => $val){
                if($request->dataL[$lang]){
                    foreach($request->dataL[$lang] as $fieldL => $valueL){
                        $dataL[$fieldL] = $valueL;
                    }
                }

                if( !isset($request->dataL[$this->_data['default_language']]['slug']) || $request->dataL[$this->_data['default_language']]['slug'] == ''){
                    $dataL['slug']       = str_slug($request->dataL[$this->_data['default_language']]['title']);
                }else{
                    $dataL['slug']       = str_slug($request->dataL[$this->_data['default_language']]['slug']);
                }
                $dataL['attributes'] = $request->input('attributes.'.$lang);
                $dataL['language']   = $lang;
                $dataInsert[]        = new ProductLanguage($dataL);
            }
            $product->languages()->saveMany($dataInsert);

            $attrs = [];
            if( config('siteconfig.attribute.'.$this->_data['type']) && config('siteconfig.attribute.'.$this->_data['type']) !='default'  ){
                foreach( config('siteconfig.attribute.'.$this->_data['type']) as $k => $v ){
                    if ( $v && $request->has($k) && is_array($request->$k) && count($request->$k) > 0) {
                        foreach ($request->$k as $l) {
                            $attrs[$l] = ['type' => $k];
                        }
                    }
                }
            }
            $product->attribute()->sync($attrs);

            return redirect()->route('admin.product.index',['type'=>$this->_data['type']])->with('success','Thêm dữ liệu <b>'.$product->languages[0]->title.'</b> thành công');
        }
        
    }

    public function edit($id){
        $this->_data['item'] = Product::find($id);
        if ($this->_data['item'] !== null) {
            $this->_data['suppliers'] = $this->getSupplier();
            $this->_data['categories'] = $this->getCategories($this->_data['type']);
            if( config('siteconfig.attribute.'.$this->_data['type']) && config('siteconfig.attribute.'.$this->_data['type']) !='default'  ){
                foreach( config('siteconfig.attribute.'.$this->_data['type']) as $k => $v ){
                    if( !$v ) continue;
                    $this->_data['attrs'][$k] = $this->getAttributes($k);
                }
            }
            $this->_data['images'] = $this->getMediaLibrary($this->_data['item']['attachments']);
            return view('admin.products.edit',$this->_data);
        }
        return redirect()->route('admin.product.index',['type'=>$this->_data['type']])->with('danger', 'Dữ liệu không tồn tại');
    }

    public function update(Request $request, $id){
        // dd($request);
        $valid = Validator::make($request->all(), [
            'dataL.vi.title' => 'required',
            'code' => 'required|unique:products,code,'.$id,
            'image' => 'image|max:2048',
            'data.category_id' => 'exists:categories,id'
        ], [
            'dataL.vi.title.required'    => 'Vui lòng nhập Tên Sản Phẩm',
            'code.required'   => 'Vui lòng nhập Mã Sản Phẩm',
            'code.unique' => 'Mã sản phẩm đã tồn tại, vui lòng nhập mã khác',
            'image.image' => 'Không đúng chuẩn hình ảnh cho phép',
            'image.max' => 'Dung lượng vượt quá giới hạn cho phép là :max KB',
            'data.category_id.exists' => 'Vui lòng chọn Danh mục',
        ]);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        } else {
            $product = Product::find($id);
            if ($product !== null) {
                if($request->data){
                	foreach($request->data as $field => $value){
                        $product->$field = $value;
                    }
                }

                if($request->hasFile('image')){
                    delete_image( $this->_data['path'].'/'.$product->image, $this->_data['thumbs'] );
                    $product->image = save_image( $this->_data['path'], $request->file('image'), $this->_data['thumbs'] );
                }

                $fileuploader = json_decode($request->input('fileuploader-list-files'),true);
                $media_list_id = [];
                
                if($request->media){
                    foreach($request->media['id'] as $key => $media_id){
                        $media = MediaLibrary::find($media_id);
                        if( isset($fileuploader[$key]['editor']) ){
                            $newImg = Image::make( public_path($this->_data['path'].'/'. $media->image) );
                            if( @$fileuploader[$key]['editor']['rotation'] ){
                                $rotation = -(int)$fileuploader[$key]['editor']['rotation'];
                                $newImg->rotate($rotation);
                            }
                            if( @$fileuploader[$key]['editor']['crop'] ){
                                $width = round($fileuploader[$key]['editor']['crop']['width']);
                                $height = round($fileuploader[$key]['editor']['crop']['height']);
                                $left = round($fileuploader[$key]['editor']['crop']['left']);
                                $top = round($fileuploader[$key]['editor']['crop']['top']);
                                $newImg->crop($width,$height,$left,$top);
                            }
                            $newImg->save( public_path($this->_data['path'].'/'. $media->image) );
                            $media->editor = $fileuploader[$key]['editor'];
                            
                        }
                        $media->priority = $request->media['priority'][$key];
                        $media->save();
                        $media_list_id[] = $media_id;
                        unset($fileuploader[$key]);
                    }
                    $fileuploader = array_values($fileuploader);
                }

                if($request->hasFile('files')){
                    
                    foreach($request->file('files') as $file){
                        $fileName  = $file->getClientOriginalName();
                        if( false !== $key = array_search($fileName, $request->attachment['name']) ){

                            $fileMime  = $file->getClientMimeType();
                            $fileSize      = $file->getClientSize();
                            $imageName = save_image( $this->_data['path'],$file, null);

                            if( isset($fileuploader[$key]['editor']) ){
                                $newImg  = Image::make( public_path($this->_data['path'].'/'.$imageName) );
                                if( @$fileuploader[$key]['editor']['rotation'] ){
                                    $rotation = -(int)$fileuploader[$key]['editor']['rotation'];
                                    $newImg->rotate($rotation);
                                }
                                if( @$fileuploader[$key]['editor']['crop'] ){
                                    $width  = round($fileuploader[$key]['editor']['crop']['width']);
                                    $height = round($fileuploader[$key]['editor']['crop']['height']);
                                    $left   = round($fileuploader[$key]['editor']['crop']['left']);
                                    $top    = round($fileuploader[$key]['editor']['crop']['top']);
                                    $newImg->crop($width,$height,$left,$top);
                                }
                                $newImg->save( public_path($this->_data['path'].'/'.$imageName) );
                            }

                            $media = MediaLibrary::create([
                                'image' => $imageName,
                                'alt'   => $request->attachment['alt'][$key],
                                'editor' => isset($fileuploader[$key]['editor']) ? $fileuploader[$key]['editor'] : '',
                                'mime_type' => $fileMime,
                                'type' => $this->_data['type'],
                                'size' => $fileSize,
                                'priority'   => $request->attachment['priority'][$key],
                            ]);
                            $media_list_id[] = $media->id;
                            unset($fileuploader[$key]);
                        }
                    }
                    
                }
                $product->code           = strtoupper($request->code);
                $product->attachments    = implode(',',$media_list_id);
                $product->original_price = floatval(str_replace('.', '', $request->original_price));
                $product->regular_price  = floatval(str_replace('.', '', $request->regular_price));
                $product->sale_price     = floatval(str_replace('.', '', $request->sale_price));
                $product->weight         = (int)str_replace('.', '', $request->weight);
                
                $product->priority       = (int)str_replace('.', '', $request->priority);
                $product->status         = ($request->status) ? implode(',',$request->status) : '';
                $product->type           = $this->_data['type'];
                $product->updated_at     = new DateTime();
                $product->save();
                $i = 0;
                foreach($this->_data['languages'] as $lang => $val){
                    $productLang = ProductLanguage::find($product->languages[$i]['id']);
                    if($request->dataL[$lang]){
                        foreach($request->dataL[$lang] as $fieldL => $valueL){
                            $productLang->$fieldL = $valueL;
                        }
                    }
                    if( !isset($request->dataL[$this->_data['default_language']]['slug']) || $request->dataL[$this->_data['default_language']]['slug'] == '' ){
                        $productLang->slug       = str_slug($request->dataL[$this->_data['default_language']]['title']);
                    }else{
                        $productLang->slug       = str_slug($request->dataL[$this->_data['default_language']]['slug']);
                    }
                    $productLang->attributes = $request->input('attributes.'.$lang);
                    $productLang->language   = $lang;
                    $productLang->save();
                    $i++;
                }
                $attrs = [];
                if( config('siteconfig.attribute.'.$this->_data['type']) && config('siteconfig.attribute.'.$this->_data['type']) !='default'  ){
                    foreach( config('siteconfig.attribute.'.$this->_data['type']) as $k => $v ){
                        if ( $v && $request->has($k) && is_array($request->$k) && count($request->$k) > 0) {
                            foreach ($request->$k as $l) {
                                $attrs[$l] = ['type' => $k];
                            }
                        }
                    }
                }
                $product->attribute()->sync($attrs);
                return redirect( $request->redirects_to )->with('success','Cập nhật dữ liệu <b>'.$product->languages[0]->title.'</b> thành công');
            }
            return redirect( $request->redirects_to )->with('danger', 'Dữ liệu không tồn tại');
        }
    }

    public function delete($id){
    	$product = Product::find($id);
        $deleted = $product->languages[0]->title;
        if ($product !== null) {
            delete_image($this->_data['path'].'/'.$product->image,$this->_data['thumbs']);
            if( $product->attachments ){
                $arrID = explode(',',$product->attachments);
                $medias = MediaLibrary::select('*')->whereIn('id',$arrID)->get();
                if( $medias !== null ){
                    foreach( $medias as $media ){
                        delete_image($this->_data['path'].'/'.$media->image,$this->_data['thumbs']);
                    }
                    MediaLibrary::destroy($arrID);
                }
            }
            if( $product->delete() ){
                return redirect()->route('admin.product.index',['type'=>$this->_data['type']])->with('success', 'Xóa dữ liệu <b>'.$deleted.'</b> thành công');
            }else{
                return redirect()->route('admin.product.index',['type'=>$this->_data['type']])->with('danger', 'Xóa dữ liệu bị lỗi');
            }
        }
        return redirect()->route('admin.product.index',['type'=>$this->_data['type']])->with('danger', 'Dữ liệu không tồn tại');
    }

    public function export(Request $request){
        $filename = 'Danh-Sach-San-Pham-'.date('dmY');
        $fileExt = $request->extension;

        $whereRaw = "A.type='".$this->_data['type']."'";
        $whereRaw .= $request->category_id ? " and A.category_id=".$request->category_id : "";
        $whereRaw .= $request->title ? " and (A.code like '%".$request->title."%' or B.title like '%".$request->title."%') " : "";
        $whereRaw .= $request->created_at ? " and A.created_at like '%".$request->created_at."%'" : "";
        $whereRaw .= $request->status ? " and FIND_IN_SET('".$request->status."',A.status)" : "";
        $data = DB::table('products as A')
            ->leftjoin('product_languages as B', 'A.id','=','B.product_id')
            ->leftjoin('category_languages as C', 'A.category_id','=','C.category_id')
            ->select('A.*','B.title','C.title as category')
            ->whereRaw($whereRaw)
            ->where('B.language', $this->_data['default_language'])
            ->where('C.language', $this->_data['default_language'])
            ->orderBy('A.priority','asc')
            ->orderBy('A.id','desc')
            ->get()->toArray();

        return Excel::create($filename, function($excel) use ($data) {
            $excel->sheet('Sản phẩm', function($sheet) use ($data) {
            	$sheet->loadView('excel.products')->with(['data'=>$data]);
                // $sheet->fromArray( json_decode( json_encode($data), true) );
            });
        })->download($fileExt);
    }

    public function import(Request $request){
        $path = 'uploads/files';
        $file = save_image($path,$request->file('file'),null);
        $data = Excel::load(public_path($path.'/'.$file), function($reader) {})->get();
        $dataInsert = [];
        foreach($data as $val){
        	$dataInsert[] = [
        		'code'	=>	$val->ma_sp,
        		'title'	=>	$val->ten_san_pham,
        		'original_price'	=>	$val->gia_goc,
        		'regular_price'	=>	$val->gia_ban,
        		'sale_price'	=>	$val->gia_khuyen_mai,
        		'weight'	=>	$val->trong_luong_gram,
        	];
        }
        dd($dataInsert);
    }

    public function getSupplier($type='default'){
        return DB::table('suppliers')
            ->where('type',$type)
            ->orderBy('priority','asc')
            ->orderBy('id','desc')
            ->get();
    }

    public function getCategories($type){
        return DB::table('categories as A')
            ->leftjoin('category_languages as B', 'A.id','=','B.category_id')
            ->select('A.id', 'A.parent', 'B.title')
            ->whereRaw('(A.type = \''.$type.'\' or A.type = \'default\')')
            ->where('B.language', $this->_data['default_language'])
            ->orderBy('A.priority','asc')
            ->orderBy('A.id','desc')
            ->get();
    }

    public function getAttributes($type){
        return DB::table('attributes as A')
            ->leftjoin('attribute_languages as B', 'A.id','=','B.attribute_id')
            ->select('A.*','B.title')
            ->where('A.type',$type)
            ->where('B.language', $this->_data['default_language'])
            ->orderBy('A.priority','asc')
            ->orderBy('A.id','desc')
            ->get();
    }

    public function getMediaLibrary($attachments){
        $arrID = explode(',',$attachments);
        return MediaLibrary::select('*')->whereIn('id',$arrID)->orderBy('priority','asc')->orderBy('id','desc')->get();
    }
}
