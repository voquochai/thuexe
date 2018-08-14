<?php

namespace App\Http\Controllers\Qlyxe\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Notifications\UserRegistered;
use Illuminate\Http\Request;

use DateTime;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('qlyxe.auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            // 'username' => 'required|alpha_dash|unique:users,username',
            'password' => 'required|min:6|confirmed',
            'policy' => 'required',
        ], [
            'name.required' => 'Vui lòng nhập Họ Tên',
            'email.required' => 'Vui lòng nhập Email',
            'email.email' => 'Không đúng định dạng Email',
            'email.unique' => 'Email này đã được sử dụng, vui lòng chọn Email khác',
            // 'username.required' => 'Vui lòng nhập Tên đăng nhập',
            // 'username.alpha_dash' => 'Tên đăng nhập không được chứa các ký tự đặc biệt',
            // 'username.unique' => 'Tên đăng nhập này đã trùng, vui lòng chọn tên khác',
            // 'password.required' => 'Vui lòng nhập Mật khẩu',
            'password.min' => 'Mật khẩu có ít nhất :min ký tự',
            'password.confirmed' => 'Confirm Mật khẩu không chính xác',
            'policy.required' => 'Bạn chưa đồng ý Điều khoản dịch vụ & Chính sách bảo mật của chúng tôi',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Member
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'province_id' => $data['province_id'],
            'district_id' => $data['district_id'],
            // 'username' => $data['username'],
            'password' => bcrypt($data['password']),
            // 'remember_token' => str_random(10),
            'type'       => 'qlyxe',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        if($user) session()->flash('success', 'Thêm dữ liệu <b>'.$user->name.'</b> thành công');
        return $user;
    }

    protected function registered(Request $request, $user)
    {
        $user->notify(new UserRegistered($user));
    }
}
