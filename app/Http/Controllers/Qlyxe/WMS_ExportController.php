<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\WMS_Export;
use App\WMS_EXport_Detail;

use DateTime;

class WMS_ExportController extends Controller
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
        $this->_data['siteconfig'] = config('siteconfig.wms.export');
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
        $this->_data['items'] = DB::table('wms_exports as A')
            ->leftjoin('users as B', 'A.user_id','=','B.id')
            ->select('A.*','B.name as username')
            ->where('A.type',$this->_data['type'])
            ->orderBy('A.priority','asc')
            ->orderBy('A.id','desc')
            ->paginate(25);

        $this->_data['total'] = DB::table('wms_exports')
            ->select(DB::raw('sum(export_qty) as qty, sum(export_price) as price'))
            ->whereRaw('FIND_IN_SET(\'publish\',status)')
            ->where('type',$this->_data['type'])->first();

        return view('admin.wms.exports.index',$this->_data);
    }
    
    public function create(){
        return view('admin.wms.exports.create',$this->_data);
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
            $wms_export  = new WMS_Export;
            $warehouses = get_product_in_warehouses();

            if($request->data){
                foreach($request->data as $field => $value){
                    $wms_export->$field = $value;
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
                    $inventory = floatval(@$warehouses[$id][$color][$size]['import']) - floatval(@$warehouses[$id][$color][$size]['export']);
                    if( $inventory <=0 || $value['qty'] > $inventory ){
                        return redirect()->route('admin.wms_export.index',['type'=>$this->_data['type']])->with('danger','Số lượng tồn kho đã có thay đổi vui lòng kiểm tra lại');
                    }
                    $dataInsert[]   = new WMS_EXport_Detail($product);
                    unset($products[$id][$color][$size]);
                }
            }
            $wms_export->code          =    time();
            $wms_export->export_qty    =    (int)$sumQty;
            $wms_export->export_price  =    floatval($sumPrice);
            $wms_export->user_id       =    Auth::id();
            $wms_export->priority      =    (int)str_replace('.', '', $request->priority);
            $wms_export->status        =    ($request->status) ? implode(',',$request->status) : '';
            $wms_export->type          =    $this->_data['type'];
            $wms_export->created_at    =    new DateTime();
            $wms_export->updated_at    =    new DateTime();
            $wms_export->save();
            $wms_export->code          =    update_code($wms_export->id,'PX');
            $wms_export->save();
            $wms_export->details()->saveMany($dataInsert);
            return redirect()->route('admin.wms_export.index',['type'=>$this->_data['type']])->with('success','Thêm dữ liệu <b>'.$wms_export->code.'</b> thành công');
        }
        
    }

    public function edit($id){
        $this->_data['item'] = WMS_Export::find($id);
        if ($this->_data['item'] !== null) {
            $this->_data['products'] = $this->_data['item']->details()->get();
            return view('admin.wms.exports.edit',$this->_data);
        }
        return redirect()->route('admin.wms_export.index',['type'=>$this->_data['type']])->with('danger', 'Dữ liệu không tồn tại');
    }

    public function update(Request $request, $id){
        return redirect( $request->redirects_to )->with('danger', 'Dữ liệu không được phép thay đổi');
    }

    public function delete(Request $request, $id){
        $wms_export = WMS_Export::find($id);
        if ($wms_export !== null) {
            if($request->data){
                foreach($request->data as $field => $value){
                    $wms_export->$field = $value;
                }
            }
            $wms_export->type          = $this->_data['type'];
            $wms_export->updated_at    = new DateTime();
            $wms_export->save();
            WMS_Export_Detail::whereIn('id',$wms_export->details()->pluck('id')->toArray())->update(['status' => 'cancel']);

            return redirect()->route('admin.wms_export.index',['type'=>$this->_data['type']])->with('success', 'Hủy phiếu <b>'.$wms_export->code.'</b> thành công');
        }
        return redirect()->route('admin.wms_export.index',['type'=>$this->_data['type']])->with('danger', 'Dữ liệu không tồn tại');
    }

    public function getWarehouses($type='default'){
        return DB::table('wms_stores')
            ->where('type',$type)
            ->orderBy('priority','asc')
            ->orderBy('id','desc')
            ->get();
    }
    
}