<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\WMS_Import;
use App\WMS_Import_Detail;

use DateTime;

class WMS_ImportController extends Controller
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
        $this->_data['siteconfig'] = config('siteconfig.wms.import');
        $this->_data['default_language'] = config('siteconfig.general.language');
        $this->_data['languages'] = config('siteconfig.languages');
        $this->_data['pageTitle'] = $this->_data['siteconfig'][$this->_data['type']]['page-title'];
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(){
        $this->_data['items'] = DB::table('wms_imports as A')
            ->leftjoin('users as B', 'A.user_id','=','B.id')
            ->select('A.*','B.name as username')
            ->where('A.type',$this->_data['type'])
            ->orderBy('A.priority','asc')
            ->orderBy('A.id','desc')
            ->paginate(25);

        $this->_data['total'] = DB::table('wms_imports')
            ->select(DB::raw('sum(import_qty) as qty, sum(import_price) as price'))
            ->whereRaw('FIND_IN_SET(\'publish\',status)')
            ->where('type',$this->_data['type'])->first();

        return view('admin.wms.imports.index',$this->_data);
    }

    public function ajax(Request $request){
        if($request->ajax()){
            $warehouses = get_product_in_warehouses();
            $code = strtoupper($request->q);
            
            if( count($warehouses) > 0 && isset($warehouses[$code]) ){
                $products = [];
                $id = $warehouses[$code];
                $product = DB::table('products as A')
                    ->leftjoin('product_languages as B', 'A.id','=','B.product_id')
                    ->select('A.regular_price as price','B.title')
                    ->where('A.id',$id)
                    ->where('B.language', $this->_data['default_language'])
                    ->first();
                foreach( $warehouses[$id] as $idColor => $sizes ){
                    
                    foreach( $sizes as $idSize => $val){
                        $key = count($products);
                        $products[$key]['id']       =  time()+$key;
                        $products[$key]['product_id']      =  $id;
                        $products[$key]['product_code']     =  $code;
                        $products[$key]['product_price']    =  @$product->price;
                        $products[$key]['product_qty']      =  1;
                        $products[$key]['title']    =  @$product->title.($val['color_title'] ? ' - '.$val['color_title']: '').($val['size_title'] ? ' - '.$val['size_title'] : '');
                        $products[$key]['color_id']    =  $idColor;
                        $products[$key]['size_id']     =  $idSize;
                        $products[$key]['color_title']   =  $val['color_title'];
                        $products[$key]['size_title']    =  $val['size_title'];
                        $products[$key]['inventory']    =  floatval(@$val['import']) - floatval(@$val['export']);
                    }
                }
                return response()->json(['items'=>$products]);
            }
            
        }
    }
    
    public function create(){
        return view('admin.wms.imports.create',$this->_data);
    }

    public function store(Request $request){
        $valid = Validator::make($request->all(), [
            'products'          => 'required',
            ], [
            'products.required' => 'Vui lòng chọn sản phẩm',
        ]);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        } else {
            $wms_import  = new WMS_Import;

            if($request->data){
                foreach($request->data as $field => $value){
                    $wms_import->$field = $value;
                }
            }
            $inputProduct = $request->products;
            $products = [];
            $product  = [];
            $sumPrice = 0;
            $sumQty   = 0;
            $dataInsert = [];
            foreach($inputProduct as $key => $value){
                $id    = (int)$value['id'];
                $color = (int)@$value['color_id'];
                $size  = (int)@$value['size_id'];
                if( !isset($products[$id][$color][$size]) ){
                    $products[$id][$color][$size]['title']  =  $value['title'];
                    $products[$id][$color][$size]['code']  =  strtoupper($value['code']);
                    $products[$id][$color][$size]['price'] =  $value['price'];
                    @$products[$id][$color][$size]['qty']  +=  $value['qty'];
                    @$products[$id][$color][$size]['color_title']  =  $value['color_title'];
                    @$products[$id][$color][$size]['size_title']  =  $value['size_title'];
                }else{
                    @$products[$id][$color][$size]['qty']  +=  $value['qty'];
                    unset($inputProduct[$key]);
                }
            }
            array_values($inputProduct);
            foreach($inputProduct as $key => $value){
                $id    = (int)$value['id'];
                $color = (int)@$value['color_id'];
                $size  = (int)@$value['size_id'];
                if( isset($products[$id][$color][$size]) ){
                    $product['product_id']    =   $id;
                    $product['product_code']  =   $products[$id][$color][$size]['code'];
                    $product['product_title'] =   $products[$id][$color][$size]['title'];
                    $product['product_qty']   =   $products[$id][$color][$size]['qty'];
                    $product['product_price'] =   $products[$id][$color][$size]['price'];
                    $product['color_id']      =   $color;
                    $product['size_id']       =   $size;
                    $product['color_title']   =   $products[$id][$color][$size]['color_title'];
                    $product['size_title']    =   $products[$id][$color][$size]['size_title'];
                    
                    $sumPrice       += $products[$id][$color][$size]['price']*$products[$id][$color][$size]['qty'];
                    $sumQty         += $products[$id][$color][$size]['qty'];
                    $dataInsert[]   = new WMS_Import_Detail($product);
                    unset($products[$id][$color][$size]);
                }
            }

            $wms_import->code          =    time();
            $wms_import->import_qty    =    (int)$sumQty;
            $wms_import->import_price  =    floatval($sumPrice);
            $wms_import->user_id       =    Auth::id();
            $wms_import->priority      =    (int)str_replace('.', '', $request->priority);
            $wms_import->status        =    ($request->status) ? implode(',',$request->status) : '';
            $wms_import->type          =    $this->_data['type'];
            $wms_import->created_at    =    new DateTime();
            $wms_import->updated_at    =    new DateTime();
            $wms_import->save();
            $wms_import->code          =    update_code($wms_import->id,'PN');
            $wms_import->save();
            $wms_import->details()->saveMany($dataInsert);
            return redirect()->route('admin.wms_import.index',['type'=>$this->_data['type']])->with('success','Thêm dữ liệu <b>'.$wms_import->code.'</b> thành công');
        }
        
    }

    public function edit(Request $request, $id){
        $this->_data['item'] = WMS_Import::find($id);
        if ($this->_data['item'] !== null) {
            $this->_data['products'] = $this->_data['item']->details()->get();
            return view('admin.wms.imports.edit',$this->_data);
        }
        return redirect()->route('admin.wms_import.index',['type'=>$this->_data['type']])->with('danger', 'Dữ liệu không tồn tại');
    }

    public function update(Request $request, $id){
        return redirect( $request->redirects_to )->with('danger', 'Dữ liệu không được phép thay đổi');
    }

    public function delete(Request $request, $id){
        $wms_import = WMS_Import::find($id);
        if ($wms_import !== null) {
            if($request->data){
                foreach($request->data as $field => $value){
                    $wms_import->$field = $value;
                }
            }
            $wms_import->type          = $this->_data['type'];
            $wms_import->updated_at    = new DateTime();
            $wms_import->save();
            WMS_Import_Detail::whereIn('id',$wms_import->details()->pluck('id')->toArray())->update(['status' => 'cancel']);

            return redirect()->route('admin.wms_import.index',['type'=>$this->_data['type']])->with('success', 'Hủy phiếu <b>'.$wms_import->code.'</b> thành công');
        }
        return redirect()->route('admin.wms_import.index',['type'=>$this->_data['type']])->with('danger', 'Dữ liệu không tồn tại');
    }

    public function getWarehouses($type='default'){
        return DB::table('wms_stores')
            ->where('type',$type)
            ->orderBy('priority','asc')
            ->orderBy('id','desc')
            ->get();
    }
    
}