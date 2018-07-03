<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmation;
use App\Setting;
use App\User;
use App\Order;
use App\OrderDetail;
use App\Coupon;

use DateTime;
class CartController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    private $_data;
    public function __construct(Request $request){
        $this->_data = set_type($request->type);
        $this->middleware(function($request,$next){
            $this->_data['lang'] = (session('lang')) ? session('lang') : config('settings.language');
            App::setLocale($this->_data['lang']);
            $this->_data['meta_seo'] = set_meta_tags($this->_data['lang']);
            View::share('siteconfig', config('siteconfig'));
            $this->_data['cart'] = is_array($cart = json_decode($request->cookie('cart'), true)) ? $cart : [];
            $this->_data['coupon'] = is_array($coupon = json_decode($request->cookie('coupon'), true)) ? $coupon : [];
            if (count($this->_data['cart']) > 0) {
                $this->_data['countCart'] = count($this->_data['cart']);
                
            }else{
                $this->_data['countCart'] = 0;
            }
            return $next($request);
        });
    }
    public function index(Request $request){
        $this->_data['page']['title'] = __('site.cart');
        $this->_data['breadcrumb'] = '<li> <a href="'.url('/').'">'.__('site.home').'</a> </li>';
        $this->_data['breadcrumb'] .= '<li> <a href="'.url('/gio-hang').'"> '.$this->_data['page']['title'].' </a> </li>';
        if(count($this->_data['cart']) > 0) {
            $sumCartPrice = $sumOrderPrice = 0;
            $countCart = count($this->_data['cart']);
            foreach ($this->_data['cart'] as $key => $val) {
                $sumCartPrice += $val['price']*$val['qty'];
                $this->_data['cart'][$key]['price'] =   number_format($val['price'], 0, ',', '.');
                $this->_data['cart'][$key]['sumProPrice'] =   number_format($val['price']*$val['qty'], 0, ',', '.');
            }
            if( count($this->_data['coupon']) > 0 ){
                if($this->_data['coupon']['change_conditions_type'] == 'percentage_discount_from_total_cart'){
                    $sumOrderPrice = $sumCartPrice - (($this->_data['coupon']['coupon_amount']/100)*$sumCartPrice);
                }else{
                    $sumOrderPrice = $sumCartPrice - $this->_data['coupon']['coupon_amount'];
                }
            }else{
                $sumOrderPrice = $sumCartPrice;
            }
            if($sumOrderPrice < 0) $sumOrderPrice = 0;
            $this->_data['countCart'] = $countCart;
            $this->_data['sumCartPrice'] = number_format($sumCartPrice, 0, ',', '.');
            $this->_data['sumOrderPrice'] = number_format($sumOrderPrice, 0, ',', '.');
            
        }else{
            $this->_data['countCart'] = 0;
            $this->_data['sumCartPrice'] = 0;
            $this->_data['sumOrderPrice'] = 0;
        }
        return view('frontend.default.cart', $this->_data);
    }
    public function tracking(Request $request){
        $this->_data['page']['title'] = __('site.tracking');
        $this->_data['breadcrumb'] = '<li> <a href="'.url('/').'">'.__('site.home').'</a> </li>';
        $this->_data['breadcrumb'] .= '<li> '.$this->_data['page']['title'].' </li>';
        $this->_data['item'] = Order::where('email',$request->email)->where('code',$request->code)->first();
        if ($this->_data['item'] !== null) {
            $this->_data['product'] = $this->_data['item']->details()->get()->first();
        }
        return view('frontend.default.tracking',$this->_data);
        
    }
    public function checkOut(Request $request){
        $this->_data['page']['title'] = __('site.checkout');
        $this->_data['breadcrumb'] = '<li> <a href="'.url('/').'">'.__('site.home').'</a> </li>';
        $this->_data['breadcrumb'] .= '<li> <a href="'.url('/thanh-toan').'"> '.$this->_data['page']['title'].' </a> </li>';
        $this->_data['payments'] = DB::table('posts as A')
            ->leftjoin('post_languages as B', 'A.id', '=', 'B.post_id')
            ->select('A.id','A.link','B.title','B.slug','B.description')
            ->where('B.language',$this->_data['lang'])
            ->whereRaw('FIND_IN_SET(\'publish\',A.status)')
            ->where('A.type','payment')
            ->orderBy('A.priority','asc')
            ->orderBy('A.id','desc')
            ->get();
        if (count($this->_data['cart']) > 0) {
            $sumCartPrice = $sumOrderPrice = 0;
            $countCart = count($this->_data['cart']);
            foreach ($this->_data['cart'] as $key => $val) {
                $sumCartPrice += $val['price']*$val['qty'];
                $this->_data['cart'][$key]['price'] =   number_format($val['price'], 0, ',', '.');
                $this->_data['cart'][$key]['sumProPrice'] =   number_format($val['price']*$val['qty'], 0, ',', '.');
            }
            if( count($this->_data['coupon']) > 0 ){
                if($this->_data['coupon']['change_conditions_type'] == 'percentage_discount_from_total_cart'){
                    $sumOrderPrice = $sumCartPrice - (($this->_data['coupon']['coupon_amount']/100)*$sumCartPrice);
                }else{
                    $sumOrderPrice = $sumCartPrice - $this->_data['coupon']['coupon_amount'];
                }
            }else{
                $sumOrderPrice = $sumCartPrice;
            }
            if($sumOrderPrice < 0) $sumOrderPrice = 0;
            $this->_data['countCart'] = $countCart;
            $this->_data['sumCartPrice'] = number_format($sumCartPrice, 0, ',', '.');
            $this->_data['sumOrderPrice'] = number_format($sumOrderPrice, 0, ',', '.');
            return view('frontend.default.checkout', $this->_data);
        }
        return redirect()->route('frontend.home.index');
        
    }
    public function placeOrder(Request $request){
        if (count($this->_data['cart']) > 0) {
            $valid = Validator::make($request->all(), [
                'name' => 'required',
                'address' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
            ], [
                'name.required' => __('validation.required', ['attribute'=>__('site.name')]),
                'address.required' => __('validation.required', ['attribute'=>__('site.address')]),
                'email.required' => __('validation.required', ['attribute'=>'Email']),
                'email.email' => __('validation.email', ['attribute'=>'Email']),
                'phone.required' => __('validation.required', ['attribute'=>__('site.phone')]),
            ]);
            if ($valid->fails()) {
                return redirect()->back()->withErrors($valid)->withInput();
            } else {
                $shipping = $request->shipping ? $request->shipping : 0;
                $sumCartPrice = $sumOrderPrice = 0;
                $sumProQty = 0;
                $dataInsert = [];
                foreach($this->_data['cart'] as $key => $val){
                    $sumCartPrice           += $val['price']*$val['qty'];
                    $sumProQty              += $val['qty'];
                    $dataInsert[]   = new OrderDetail([
                        'product_id'    =>  $val['id'],
                        'product_title' =>  $val['title'],
                        'product_code'  =>  $val['code'],
                        'product_qty'   =>  $val['qty'],
                        'product_price' =>  $val['price'],
                        'color_id'   =>  $val['color_id'],
                        'size_id'    =>  $val['size_id'],
                        'color_title'   =>  $val['color_title'],
                        'size_title'    =>  $val['size_title'],
                    ]);
                }
                if( count($this->_data['coupon']) > 0 ){
                    if($this->_data['coupon']['change_conditions_type'] == 'percentage_discount_from_total_cart'){
                        $sumOrderPrice = $sumCartPrice - (($this->_data['coupon']['coupon_amount']/100)*$sumCartPrice);
                    }else{
                        $sumOrderPrice = $sumCartPrice - $this->_data['coupon']['coupon_amount'];
                    }
                    DB::table('coupons')->where('id',$this->_data['coupon']['id'])->increment('used',1);
                }else{
                    $sumOrderPrice = $sumCartPrice;
                }
                if($sumOrderPrice < 0) $sumOrderPrice = 0;
                $order = Order::create([
                    'code'          =>  time(),
                    'coupon_code'   =>  $this->_data['coupon'] ? $this->_data['coupon']['code'] : null,
                    'coupon_amount' =>  $this->_data['coupon'] ? $this->_data['coupon']['coupon_amount'] : 0,
                    'name'          =>  $request->name,
                    'address'       =>  $request->address,
                    'email'         =>  $request->email,
                    'phone'         =>  $request->phone,
                    'province_id'   =>  (int)$request->province_id,
                    'district_id'   =>  (int)$request->district_id,
                    'note'          =>  $request->order_note,
                    'payment_id'    =>  (int)$request->payment,
                    'shipping'      =>  (int)$shipping,
                    'subtotal'      =>  floatval($sumCartPrice),
                    'order_qty'     =>  (int)$sumProQty,
                    'order_price'   =>  floatval($sumOrderPrice + $shipping),
                    'member_id'     =>  auth()->guard('member')->check() ? auth()->guard('member')->id() : null,
                    'status_id'     =>  1,
                    'type'          =>  'online',
                    'created_at'    => new DateTime(),
                    'updated_at'    => new DateTime(),
                ]);
                $order->code = update_code($order->id,'DH');
                $order->save();
                $order->details()->saveMany($dataInsert);
                $cookieCart = cookie('cart', '', 720);
                $cookieCoupon = cookie('coupon', '', 720);
                if(@config('settings.email_username') !='') Mail::to($order->email)->send(new OrderConfirmation($order));
                return redirect()->route('frontend.cart.thankyou')->with('orderCode', $order->code)->withCookie($cookieCart)->withCookie($cookieCoupon);
            }
        }else{
            return redirect()->route('frontend.home.index');
        }
    }
    public function thankYou(){
        $this->_data['page']['title'] = __('cart.continue_shopping');
        $this->_data['breadcrumb'] = '<li> <a href="'.url('/').'">'.__('site.home').'</a> </li>';
        $this->_data['breadcrumb'] .= '<li> <a href="'.url('/san-pham').'"> '.$this->_data['page']['title'].' </a> </li>';
        return view('frontend.default.thankyou',$this->_data);
    }
    public function checkCoupon(){
        $data = ['type' =>'success','icon' =>'check'];
        $sumCartPrice = 0;
        foreach ($this->_data['cart'] as $key => $val) {
            $sumCartPrice += $val['price']*$val['qty'];
        }
        if( $this->_data['coupon']['used'] >= $this->_data['coupon']['number_of_uses'] ){
            $data = [
                'type' =>'danger',
                'icon' =>'warning',
                'message'   =>  'Mã coupon <b>'.$this->_data['coupon']['code'].'</b> đã hết số lần sử dụng'
            ];
        }
        if( $this->_data['coupon']['min_restriction_amount'] > 0 && $sumCartPrice < $this->_data['coupon']['min_restriction_amount'] ){
            $data = [
                'type' =>'danger',
                'icon' =>'warning',
                'message'   =>  'Mã coupon <b>'.$this->_data['coupon']['code'].'</b> chỉ áp dụng cho đơn hàng có tổng giá trị từ <b>'.number_format($this->_data['coupon']['min_restriction_amount'],0,',','.').' đ</b>'
            ];
        }
        if( $this->_data['coupon']['max_restriction_amount'] > 0 && $sumCartPrice > $this->_data['coupon']['max_restriction_amount'] ){
            $data = [
                'type' =>'danger',
                'icon' =>'warning',
                'message'   =>  'Mã coupon <b>'.$this->_data['coupon']['code'].'</b> chỉ áp dụng cho đơn hàng có tổng giá trị đến <b>'.number_format($this->_data['coupon']['max_restriction_amount'],0,',','.').' đ</b>'
            ];
        }
        if( $this->_data['coupon']['begin_at'] !== null && time() < strtotime($this->_data['coupon']['begin_at']) ){
            $data = [
                'type' =>'danger',
                'icon' =>'warning',
                'message'   =>  'Mã coupon <b>'.$this->_data['coupon']['code'].'</b> chỉ áp dụng từ ngày <b>'.$this->_data['coupon']['begin_at'].'</b>'
            ];
        }
        if( $this->_data['coupon']['end_at'] !== null && time() > strtotime($this->_data['coupon']['end_at']) ){
            $data = [
                'type' =>'danger',
                'icon' =>'warning',
                'message'   =>  'Mã coupon <b>'.$this->_data['coupon']['code'].'</b> chỉ áp dụng đến ngày <b>'.$this->_data['coupon']['end_at'].'</b>'
            ];
        }
        
        return $data;
    }
    public function getTotalPrice(){
        $sumCartPrice = $sumOrderPrice = 0;
        foreach ($this->_data['cart'] as $key => $val) {
            $sumCartPrice += $val['price']*$val['qty'];
        }
        if( count($this->_data['coupon']) > 0 ){
            if($this->_data['coupon']['change_conditions_type'] == 'percentage_discount_from_total_cart'){
                $sumOrderPrice = $sumCartPrice - (($this->_data['coupon']['coupon_amount']/100)*$sumCartPrice);
            }else{
                $sumOrderPrice = $sumCartPrice - $this->_data['coupon']['coupon_amount'];
            }
        }else{
            $sumOrderPrice = $sumCartPrice;
        }
        if($sumOrderPrice < 0) $sumOrderPrice = 0;
        return ['sumCartPrice' => $sumCartPrice, 'sumOrderPrice' => $sumOrderPrice];
    }
    public function coupon(Request $request){
        if ($request->ajax()) {
            if( count($this->_data['coupon']) == 0 || $this->_data['coupon']['code'] != $request->code ){
                $this->_data['coupon'] = Coupon::where('code',$request->code)->whereRaw('FIND_IN_SET(\'publish\',status)')->first();
            }
            if( count($this->_data['coupon']) > 0 ){
                $data = self::checkCoupon();
                if($data['type'] == 'danger'){
                    return response()->json($data);
                }
                if($this->_data['coupon']['change_conditions_type'] == 'percentage_discount_from_total_cart'){
                    $sale = $this->_data['coupon']['coupon_amount'].'%';
                }else{
                    $sale = number_format($this->_data['coupon']['coupon_amount'],0,',','.').' VNĐ';
                }
                $this->_data['coupon']['coupon_amount_text'] = $sale;
                $countCart = count($this->_data['cart']);
                $cookieCart = cookie('cart', json_encode($this->_data['cart']), 720);
                $cookieCoupon = cookie('coupon', json_encode($this->_data['coupon']), 720);
                $totalPrice = self::getTotalPrice();
                return response()->json([
                    'type'  =>  'success',
                    'message'   =>  __('cart.sale',['attribute'=>$sale]),
                    'icon'  =>  'check',
                    'countCart' => $countCart,
                    'sumCartPrice' => number_format($totalPrice['sumCartPrice'], 0, ',', '.'),
                    'sumOrderPrice' => number_format($totalPrice['sumOrderPrice'], 0, ',', '.')
                ])->withCookie($cookieCart)->withCookie($cookieCoupon);
            }
            return response()->json([
                'type'  =>  'danger',
                'message'   =>  'Dữ liệu không tồn tại',
                'icon'  =>  'warning',
            ]);
        }
    }
    public function checkInCart($id,$qty,$color_id=0,$size_id=0){
        $flag = 0;
        $max = count($this->_data['cart']);
        for($i=0; $i<$max; $i++){
            if( $this->_data['cart'][$i]['id'] == $id && $this->_data['cart'][$i]['color_id'] == $color_id && $this->_data['cart'][$i]['size_id'] == $size_id ){
                $this->_data['cart'][$i]['qty'] += $qty;
                $flag = 1;
            }
        }
        if($flag) return true;
        return false;
    }
    public function buyDomain(Request $request){
        $domain = $request->domain;
        $price = (int)$request->price;
        if ( $request->ajax() ) {
            $cookieDomain = cookie('domain', json_encode(['name'=>$domain, 'price'=>$price]), 720);
            return response()->json([
                'type'    =>  'success',
                'title' =>  '',
                'message' => "Đăng ký tên miền $domain thành công",
            ])->withCookie($cookieDomain);
        }else{
            return response()->json([
                'type'    =>  'warning',
                'title' =>  '',
                'message' => "Đăng ký tên miền $domain thất bại"
            ]);
        }
    }
    public function addToCart(Request $request){
        $id = $request->id;
        $color_id = (int)$request->color;
        $size_id = (int)$request->size;
        $qty = is_numeric($request->qty) && $request->qty > 0 ? $request->qty : 1;
        if ($request->ajax() && is_numeric($id)) {
            $product = DB::table('products as A')
                ->leftjoin('product_languages as B', 'A.id','=','B.product_id')
                ->select('A.*','B.title')
                ->where('A.id',$id)
                ->where('B.language', $this->_data['lang'])
                ->first();
            $color = DB::table('attribute_languages')
                ->select('title')
                ->where('attribute_id',$color_id)
                ->where('language',$this->_data['lang'])
                ->first();
            $size = DB::table('attribute_languages')
                ->select('title')
                ->where('attribute_id',$size_id)
                ->where('language',$this->_data['lang'])
                ->first();
            if ($product !== null) {
                if (count($this->_data['cart']) > 0) {
                    $max = count($this->_data['cart']);
                    if( !self::checkInCart($id,$qty,$color_id,$size_id) ){
                        $this->_data['cart'][$max] = [
                            'id' => $id,
                            'title' => $product->title,
                            'code' => $product->code,
                            'price' => $product->sale_price > 0 ? $product->sale_price : $product->regular_price,
                            'qty' => $qty,
                            'image' =>  $product->image ? asset('public/uploads/products/'.get_thumbnail($product->image)) : asset('noimage/300x300'),
                            'color_id' => $color_id,
                            'size_id' => $size_id,
                            'color_title' => @$color->title,
                            'size_title' => @$size->title,
                        ];
                    }
                }else{
                    $this->_data['cart'][0] = [
                        'id' => $id,
                        'title' => $product->title,
                        'code' => $product->code,
                        'price' => $product->sale_price > 0 ? $product->sale_price : $product->regular_price,
                        'qty' => $qty,
                        'image' =>  $product->image ? asset('public/uploads/products/'.get_thumbnail($product->image)) : asset('noimage/300x300'),
                        'color_id' => $color_id,
                        'size_id' => $size_id,
                        'color_title' => @$color->title,
                        'size_title' => @$size->title,
                    ];
                }
                
                $countCart = count($this->_data['cart']);
                $cookieCart = cookie('cart', json_encode($this->_data['cart']), 720);
                $cookieCoupon = cookie('coupon', json_encode($this->_data['coupon']), 720);
                $totalPrice = self::getTotalPrice();
                return response()->json([
                    'type'    =>  'success',
                    'title' =>  '',
                    'message' => __('cart.added'),
                    'countCart' => $countCart,
                    'sumCartPrice' => number_format($totalPrice['sumCartPrice'], 0, ',', '.'),
                    'sumOrderPrice' => number_format($totalPrice['sumOrderPrice'], 0, ',', '.')
                ])->withCookie($cookieCart)->withCookie($cookieCoupon);
            }else{
                return response()->json([
                    'type'    =>  'warning',
                    'title' =>  '',
                    'message' => __('cart.failing')
                ]);
            }
        }else{
            return response()->json([
                'type'    =>  'warning',
                'title' =>  '',
                'message' => __('cart.failing')
            ]);
        }
    }
    public function updateCart(Request $request){
        $key = $request->key;
        $qty = $request->qty;
        if ($request->ajax() && is_numeric($key) && is_numeric($qty)) {
            if (isset($this->_data['cart'][$key]) && $qty > 0) {
                $this->_data['cart'][$key]['qty'] = $qty;
                $this->_data['cart'][$key]['sumProPrice'] = $this->_data['cart'][$key]['qty'] * $this->_data['cart'][$key]['price'];
            } elseif (isset($this->_data['cart'][$key])) {
                unset($this->_data['cart'][$key]);
            }
            $countCart = count($this->_data['cart']);
            $cookieCart = cookie('cart', json_encode($this->_data['cart']), 720);
            $cookieCoupon = cookie('coupon', json_encode($this->_data['coupon']), 720);
            $totalPrice = self::getTotalPrice();
            return response()->json([
                'key' => $key,
                'type'    =>  'success',
                'title' =>  '',
                'message' => __('cart.updated'),
                'sumProPrice'  => number_format($this->_data['cart'][$key]['sumProPrice'], 0, ',', '.'),
                'countCart' => $countCart,
                'sumCartPrice' => number_format($totalPrice['sumCartPrice'], 0, ',', '.'),
                'sumOrderPrice' => number_format($totalPrice['sumOrderPrice'], 0, ',', '.')
            ])->withCookie($cookieCart)->withCookie($cookieCoupon);
        }
    }
    public function deleteCart(Request $request){
        $key = $request->key;
        if ($request->ajax() && is_numeric($key)) {
            if ( isset($this->_data['cart'][$key]) ) {
                unset($this->_data['cart'][$key]);
            }
            $countCart = count($this->_data['cart']);
            $cookieCart = cookie('cart', json_encode($this->_data['cart']), 720);
            $cookieCoupon = cookie('coupon', json_encode($this->_data['coupon']), 720);
            $totalPrice = self::getTotalPrice();
            return response()->json([
                'key' => $key,
                'type'    =>  'success',
                'title' =>  '',
                'message' => __('cart.deleted'),
                'countCart' => $countCart,
                'sumCartPrice' => number_format($totalPrice['sumCartPrice'], 0, ',', '.'),
                'sumOrderPrice' => number_format($totalPrice['sumOrderPrice'], 0, ',', '.')
            ])->withCookie($cookieCart)->withCookie($cookieCoupon);
        }else{
            return response()->json([
                'type'    =>  'error',
                'title' =>  '',
                'message' => __('cart.not_exist')
            ]);
        }
    }
    public function deleteAll(Request $request){
        $cookieCart = cookie('cart', '', 720);
        $cookieCoupon = cookie('coupon', '', 720);
        return redirect()->route('frontend.cart.index')->withCookie($cookieCart)->withCookie($cookieCoupon);
    }
    
}