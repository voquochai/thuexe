<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Setting;
use App\Member;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use Cache;
use DateTime;

class MemberController extends Controller
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
        $this->middleware(function($request,$next){
            $lang = (session('lang')) ? session('lang') : config('settings.language');
            App::setLocale($lang);
            $this->_data = set_type($request->type,$lang);
            $this->_data['lang'] = $lang;
            $this->_data['meta_seo'] = set_meta_tags($lang);
            View::share('siteconfig', config('siteconfig'));
            return $next($request);
        });
    }

    public function index(){
        
        $this->_data['site']['title'] = __('site.member');
        $this->_data['breadcrumb'] = '<li> <a href="'.url('/').'">'.__('site.home').'</a> </li>';
        $this->_data['breadcrumb'] .= '<li> <a href="'.url('/member').'"> '.$this->_data['site']['title'].' </a> </li>';


        $id = auth()->guard('member')->user()->id;
        $this->_data['items'] = Order::where('member_id',$id)->get();
        return view('frontend.member.index', $this->_data);
    }

    public function profile(Request $request){

        $this->_data['site']['title'] = __('site.member');
        $this->_data['breadcrumb'] = '<li> <a href="'.url('/').'">'.__('site.home').'</a> </li>';
        $this->_data['breadcrumb'] .= '<li> <a href="'.url('/member').'"> '.__('account.profile').' </a> </li>';

        $id = auth()->guard('member')->user()->id;
        $member = Member::find($id);
        if ($request->isMethod('put')) {
            $valid = Validator::make($request->all(), [
                'data.name' => 'required',
                'password' => 'confirmed'
            ], [
                'data.name.required' => 'Vui lòng nhập Họ Tên',
                'password.confirmed' => 'Confirm Mật khẩu không chính xác',
            ]);
            if ($valid->fails()) {
                return redirect()->back()->withErrors($valid);
            } else {
                if($request->data){
                    foreach($request->data as $field => $value){
                        $member->$field = $value;
                    }
                }
                if ($request->has('password')) {
                    if( !Hash::check($request->oldpassword,$member->password) ){
                        return redirect()->back()->with('danger','Mật khẩu cũ không chính xác');
                    }
                    $member->password = bcrypt($request->password);
                }

                $member->updated_at     = new DateTime();
                $member->save();
                return redirect()->back()->with('success','Cập nhật dữ liệu <b>'.$member->name.'</b> thành công');
            }
        }
        $this->_data['member'] = $member;
        return view('frontend.member.profile', $this->_data);
    }

    public function orders(){

        $this->_data['site']['title'] = __('site.member');
        $this->_data['breadcrumb'] = '<li> <a href="'.url('/').'">'.__('site.home').'</a> </li>';
        $this->_data['breadcrumb'] .= '<li> <a href="'.url('/member').'"> '.__('account.profile').' </a> </li>';

        $id = auth()->guard('member')->user()->id;
        $this->_data['items'] = Order::where('member_id',$id)->paginate(25);
        return view('frontend.member.orders', $this->_data);
    }

    public function orderDetail($id){

        $this->_data['site']['title'] = __('site.member');
        $this->_data['breadcrumb'] = '<li> <a href="'.url('/').'">'.__('site.home').'</a> </li>';
        $this->_data['breadcrumb'] .= '<li> <a href="'.url('/member').'"> '.__('account.profile').' </a> </li>';

        $member_id = auth()->guard('member')->user()->id;
        $this->_data['item'] = Order::where('member_id',$member_id)->where('id',$id)->first();
        if ($this->_data['item'] !== null) {

            $product_id    = explode(',',$this->_data['item']['product_id']);
            $product_code  = explode(',',$this->_data['item']['product_code']);
            $product_size  = explode(',',$this->_data['item']['product_size']);
            $product_color = explode(',',$this->_data['item']['product_color']);
            $product_qty   = explode(',',$this->_data['item']['product_qty']);
            $product_price = explode(',',$this->_data['item']['product_price']);
            $products = [];
            foreach($product_id as $key => $id){
                $product = DB::table('product_languages')
                    ->select('title')
                    ->where('product_id',$id)
                    ->where('language',$this->_data['lang'])
                    ->first();

                $color = DB::table('attribute_languages')
                            ->select('title')
                            ->where('attribute_id',$product_color[$key])
                            ->where('language',$this->_data['lang'])
                            ->first();

                $size = DB::table('attribute_languages')
                            ->select('title')
                            ->where('attribute_id',$product_size[$key])
                            ->where('language',$this->_data['lang'])
                            ->first();
                $products[$key]['id']     =  $id;
                $products[$key]['code']   =  $product_code[$key];
                $products[$key]['price']  =  $product_price[$key];
                $products[$key]['qty']    =  $product_qty[$key];
                $products[$key]['color']  =  $product_color[$key];
                $products[$key]['size']   =  $product_size[$key];
                $products[$key]['pname']  =  @$product->title;
                $products[$key]['pcolor'] =  @$color->title;
                $products[$key]['psize']  =  @$size->title;
                $products[$key]['sumProPrice']  =  $product_price[$key]*$product_qty[$key];
            }
            $this->_data['products'] = $products;
            
        }
        return view('frontend.member.order_detail', $this->_data);
    }
    
}
