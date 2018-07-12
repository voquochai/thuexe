<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactInformation;
use App\Mail\OrderConfirmation;
use App\Register;
use App\Order;
use App\OrderDetail;

use Cache;
use DateTime;


class AjaxController extends Controller
{

	public function index(Request $request){
        
        switch($request->act){
            case 'newsletter':
                $data = $this->newsletter($request);
                break;
            case 'contact':
                $data = $this->contact($request);
                break;
            case 'comment':
                $data = $this->comment($request);
                break;
            case 'order':
                $data = $this->order($request);
                break;
        }
        return response()->json($data);
    }
    
    public function newsletter($request){
        $valid = Validator::make($request->all(), [
            'email' => [
                'required',
                'email',
                Rule::unique('registers')->where(function ($query) use($request) {
                    $query->where('email', $request->email)->where('type', $request->type);
                })
            ],
        ], [
            'email.required' => __('validation.required', ['attribute'=>'Email']),
            'email.email' => __('validation.email', ['attribute'=>'Email']),
            'email.unique' => __('validation.unique', ['attribute'=>'Email']),
        ]);

        $data['type'] = 'danger';
        $data['icon'] = 'warning';

        if ($valid->fails()) {
            $data['message'] = $valid->errors()->first();
            return $data;
        } else {

            $data_insert['title'] = "Đăng ký nhận bản tin";
            $data_insert['email'] = $request->email;
            $data_insert['type'] = $request->type;
            $data_insert['created_at'] = new DateTime();
            $data_insert['updated_at'] = new DateTime();

            if(DB::table('registers')->insert($data_insert)){
                $data['type'] = 'success';
                $data['icon'] = 'check';
                $data['message'] = __('site.sign_up_success');
            }else{
                $data['message'] = __('site.sign_up_fail');
            }
        }
    	return $data;
    }

    public function contact($request){
        $valid = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ], [
            'name.required' => __('validation.required', ['attribute'=>__('site.name')]),
            'email.required' => __('validation.required', ['attribute'=>'Email']),
            'email.email' => __('validation.email', ['attribute'=>'Email']),
            'subject.required' => __('validation.required', ['attribute'=>__('site.subject')]),
            'message.required' => __('validation.required', ['attribute'=>__('site.message')]),
        ]);

        $data['type'] = 'danger';
        $data['icon'] = 'warning';

        if ($valid->fails()) {
            $data['message'] = $valid->errors()->first();
            return $data;
        } else {

            $client_ip = $request->getClientIp();
            if(Cache::has($client_ip.'_contact')){
                $data['message'] = __('site.contact_wait');
                return $data;
            }else{
                Cache::add($client_ip.'_contact',$request->email,10);
            }

            $data_insert['title'] = $request->subject;
            $data_insert['name'] = $request->name;
            $data_insert['email'] = $request->email;
            $data_insert['description'] = $request->message;
            $data_insert['type'] = $request->type;
            $data_insert['created_at'] = new DateTime();
            $data_insert['updated_at'] = new DateTime();
            $contact = Register::create($data_insert);
            if($contact){
                $data['type'] = 'success';
                $data['icon'] = 'check';
                $data['message'] = __('site.contact_success');
                if(@config('settings.email_username') !='') Mail::to(config('settings.email_to'))->send(new ContactInformation($contact));
            }else{
                $data['message'] = __('site.contact_fail');
            }
        }
        return $data;
    }

    public function comment($request){
        $valid = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'description' => 'required',
            // 'score' => 'required|between:1,5'
        ], [
            'name.required' => __('validation.required', ['attribute'=>__('site.name')]),
            'email.required' => __('validation.required', ['attribute'=>'Email']),
            'email.email' => __('validation.email', ['attribute'=>'Email']),
            'description.required' => __('validation.required', ['attribute'=>__('site.content')]),
            // 'score.required' => 'Yêu cầu nhập vào điểm số',
            // 'score.between' => 'Vui lòng chỉ nhập từ :min tới :max khi chấm điểm'
        ]);

        $data['type'] = 'danger';
        $data['icon'] = 'warning';

        if ($valid->fails()) {
            $data['message'] = $valid->errors()->first();
            return $data;
        } else {

            $client_ip = $request->getClientIp();
            $table = $request->product_id ? 'product' : 'post' ;
            $id = $request->product_id ? $request->product_id : $request->post_id ;

            if(Cache::has($client_ip.'_comment_'.$table.'_'.$id)){
                $data['message'] = __('site.comment_wait', ['attribute'=>( $table == 'product' ? __('site.product') : __('site.post') )] );
                return $data;
            }else{
                Cache::add($client_ip.'_comment_'.$table.'_'.$id,$id,10);
            }

            $data_insert['parent'] = (int)$request->parent;
            $data_insert['product_id'] = ($request->product_id) ? $request->product_id : null ;
            $data_insert['post_id'] = ($request->post_id) ? $request->post_id : null ;
            $data_insert['member_id'] = auth()->guard('member')->check() ? auth()->guard('member')->id() : null ;
            $data_insert['name'] = $request->name;
            $data_insert['email'] = $request->email;
            $data_insert['description'] = $request->description;
            $data_insert['status'] = '';
            $data_insert['type'] = $request->type;
            $data_insert['created_at'] = new DateTime();
            $data_insert['updated_at'] = new DateTime();

            if(DB::table('comments')->insert($data_insert)){
                $data['type'] = 'success';
                $data['icon'] = 'check';
                $data['message'] = __('site.comment_success');
            }else{
                $data['message'] = __('site.comment_fail');
            }
        }
        return $data;
    }

    public function order($request){
        $valid = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email'
        ], [
            'name.required' => __('validation.required', ['attribute'=>__('site.name')]),
            'phone.required' => __('validation.required', ['attribute'=>__('site.phone')]),
            'email.required' => __('validation.required', ['attribute'=>'Email']),
            'email.email' => __('validation.email', ['attribute'=>'Email']),
        ]);

        $data['type'] = 'danger';
        $data['icon'] = 'warning';

        if ($valid->fails()) {
            $data['message'] = $valid->errors()->first();
            return $data;
        } else {

            $product = DB::table('products as A')
                ->leftjoin('product_languages as B', 'A.id', '=', 'B.product_id')
                ->select('A.id','A.code','A.regular_price','A.sale_price', 'B.title')
                ->where('A.id',$request->product_id)
                ->first();
            $hosting = DB::table('attributes as A')
                ->leftjoin('attribute_languages as B', 'A.id','=','B.attribute_id')
                ->select('A.*','B.title')
                ->where('B.language','vi')
                ->where('A.id',$request->hosting_id)
                ->first();

            $product_price = $product->sale_price > 0 ? $product->sale_price : $product->regular_price;
            $hosting_price = $hosting->sale_price > 0 ? $hosting->sale_price : $hosting->regular_price;
            $domain_price  = (int)$request->domain_price;
            $license       = (int)$request->license;

            $total = ($product_price + $hosting_price + $domain_price)*$license;
            $order = Order::create([
                'code'          =>  time(),
                'name'          =>  $request->name,
                'email'         =>  $request->email,
                'phone'         =>  $request->phone,
                'note'          =>  $request->note,
                'order_qty'     =>  $license,
                'subtotal'      =>  floatval($total),
                'order_price'   =>  floatval($total),
                'member_id'     =>  auth()->guard('member')->check() ? auth()->guard('member')->id() : null,
                'status_id'     =>  1,
                'type'          =>  'online',
                'created_at'    => new DateTime(),
                'updated_at'    => new DateTime(),
            ]);
            $order->code = update_code($order->id,'DH');
            $order->save();
            $order->details()->save(new OrderDetail([
                'product_id'    =>  $product->id,
                'product_title' =>  $product->title,
                'product_code'  =>  $product->code,
                'product_qty'   =>  $license,
                'product_price' =>  $product_price,
                'color_title'   =>  $hosting->title.' - '.number_format($hosting_price,0,',','.'),
                'size_title'    =>  $request->domain_name ? $request->domain_name.' - '.number_format($domain_price,0,',','.') : null,
            ]));
            if($order){
                $data['type'] = 'success';
                $data['icon'] = 'check';
                $data['message'] = "Cám ơn ".$order->name." đã đăng ký dịch vụ. Chúng tôi sẽ phản hồi lại qua ".$order->email." trong thời gian sớm nhất. Trân trọng!";
                $data['redirect'] = route('frontend.cart.tracking', ['email'=>$order->email, 'code'=>$order->code]);
                // if(@config('settings.email_username') !='') Mail::to($order->email)->send(new OrderConfirmation($order));
            }else{
                $data['message'] = "Hệ thống đang bận. Quý khách vui lòng thử lại sau.";
            }
        }
        return $data;
    }
}
