<?php

namespace App\Http\Controllers\Qlyxe;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Order;
use App\OrderDetail;

use DateTime;

class OrderController extends Controller
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
        $this->_data['siteconfig'] = config('siteconfig.order');
        $this->_data['default_language'] = config('siteconfig.general.language');
        $this->_data['languages'] = config('siteconfig.languages');
        $this->_data['pageTitle'] = 'Phiếu thuê xe';
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(){

        $this->_data['items'] = DB::table('orders as A')
            ->where('A.type',$this->_data['type'])
            ->orderBy('A.priority','asc')
            ->orderBy('A.id','desc')
            ->paginate(25);

        $this->_data['total'] = DB::table('orders')
            ->select(DB::raw('sum(order_qty) as qty, sum(order_price) as price'))
            ->where('status_id', '<' , 4)
            ->where('type',$this->_data['type'])->first();

        return view('qlyxe.orders.index',$this->_data);
    }

    public function ajax(Request $request){
        if($request->ajax()){
            $data['items'] = DB::table('products as A')
                ->leftjoin('product_languages as B', 'A.id','=','B.product_id')
                ->select(DB::raw('A.id,A.code,A.original_price,A.regular_price,A.sale_price,1 as qty,B.title'))
                ->where('A.code','like', "%$request->q%")
                ->orWhere('B.title','like', "%$request->q%")
                ->where('A.type',$request->t)
                ->where('B.language', $this->_data['default_language'])
                ->orderBy('A.priority','asc')
                ->orderBy('A.id','desc')
                ->get();
            return response()->json($data);
        }
    }
    
    public function create(){
        return view('qlyxe.orders.create',$this->_data);
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
            $order  = new Order;

            if($request->data){
                foreach($request->data as $field => $value){
                    $order->$field = $value;
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
                    $dataInsert[]   = new OrderDetail($product);
                    unset($products[$id][$color][$size]);
                }
            }
            

            $order->code          =    time();
            $order->order_qty     =    (int)$sumQty;
            $order->subtotal      =    floatval($sumPrice);
            $order->coupon_amount =    floatval($request->coupon_amount);
            $order->shipping      =    (int)str_replace('.', '', $request->shipping);
            $order->order_price   =    ($order->subtotal + $order->shipping)-$order->coupon_amount;
            $order->user_id       =    Auth::id();
            $order->priority      =    (int)str_replace('.', '', $request->priority);
            $order->type          =    $this->_data['type'];
            $order->created_at    =    new DateTime();
            $order->updated_at    =    new DateTime();
            $order->save();
            $order->code          =    update_code($order->id,'DH');
            $order->save();
            $order->details()->saveMany($dataInsert);
            return redirect()->route('qlyxe.order.index',['type'=>$this->_data['type']])->with('success','Thêm dữ liệu <b>'.$order->code.'</b> thành công');
        }
        
    }

    public function edit($id){
        $this->_data['item'] = Order::find($id);
        if ($this->_data['item'] !== null) {
            $this->_data['products'] = $this->_data['item']->details()->get();
            $products = [];
            if($this->_data['products'] !== null){
                foreach($this->_data['products'] as $key => $val){
                    $product = DB::table('products')
                        ->select('id','original_price','regular_price','sale_price')
                        ->where('id',$val->product_id)
                        ->first();
                    $products[$key]['id']       =  $val->product_id;
                    $products[$key]['code']     =  $val->product_code;
                    $products[$key]['price']    =  $val->product_price;
                    $products[$key]['qty']      =  $val->product_qty;
                    $products[$key]['title']    =  $val->product_title;
                    $products[$key]['prices']   =  [
                        'Giờ'   =>  $product->original_price,
                        'Ngày'   =>  $product->regular_price,
                        'Tháng'   =>  $product->sale_price,
                    ];
                }
                $this->_data['products'] = $products;
            }
            return view('qlyxe.orders.edit',$this->_data);
        }
        return redirect()->route('qlyxe.order.index',['type'=>$this->_data['type']])->with('danger', 'Dữ liệu không tồn tại');
    }

    public function update(Request $request, $id){
        $valid = Validator::make($request->all(), [
            'products'          => 'required',
            ], [
            'products.required' => 'Vui lòng chọn sản phẩm',
        ]);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        } else {
            $order = Order::find($id);

            if ($order !== null) {
                if($request->data){
                    foreach($request->data as $field => $value){
                        $order->$field = $value;
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
                        $dataInsert[]   = new OrderDetail($product);
                        unset($products[$id][$color][$size]);
                    }
                }
                $order->order_qty     =    (int)$sumQty;
                $order->subtotal      =    floatval($sumPrice);
                $order->coupon_amount =    floatval($request->coupon_amount);
                $order->shipping      =    (int)str_replace('.', '', $request->shipping);
                $order->order_price   =    ($order->subtotal + $order->shipping)-$order->coupon_amount;
                $order->priority      =    (int)str_replace('.', '', $request->priority);
                $order->type          =    $this->_data['type'];
                $order->updated_at    =    new DateTime();
                $order->save();
                OrderDetail::whereIn('id',$order->details()->pluck('id')->toArray())->delete();
                $order->details()->saveMany($dataInsert);
                return redirect( $request->redirects_to )->with('success','Cập nhật dữ liệu <b>'.$order->name.'</b> thành công');
            }
            return redirect( $request->redirects_to )->with('danger', 'Dữ liệu không tồn tại');
        }
    }

    public function delete($id){
        $order = Order::find($id);
        $deleted = $order->name;
        if ($order !== null) {
            if( $order->delete() ){
                OrderDetail::whereIn('id',$order->details()->pluck('id')->toArray())->delete();
                return redirect()->route('qlyxe.order.index',['type'=>$this->_data['type']])->with('success', 'Xóa dữ liệu <b>'.$deleted.'</b> thành công');
            }else{
                return redirect()->route('qlyxe.order.index',['type'=>$this->_data['type']])->with('danger', 'Xóa dữ liệu bị lỗi');
            }
        }
        return redirect()->route('qlyxe.order.index',['type'=>$this->_data['type']])->with('danger', 'Dữ liệu không tồn tại');
    }
}
