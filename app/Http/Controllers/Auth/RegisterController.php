<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AccountHabitus;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = RouteServiceProvider::HOTRO;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
          'cRealName' => ['required', 'string', 'max:255'],
          'cAccName' => ['required', 'string', 'max:60', 'unique:Account_Info', 'alpha_dash'],
          'cPassWord' => ['required', 'string', 'min:6', 'confirmed'],
          'cSecPassword' => ['required', 'string', 'min:6'],
          'cEMail' => ['required', 'string', 'email', 'max:255', 'unique:Account_Info'],
        ],
        [
          'required' => ':attribute không được để trống',
          'string' => ':attribute phải là chuỗi',
          'alpha_dash' => ':attribute không chưa ký tự đặc biệt',
          'min'  =>  ':attribute phải điền ít nhất :min ký tự',
          'max'  =>  ':attribute phải điền không quá :max ký tự',
          'email'  =>  ':attribute phải là email thật',
          'unique'  =>  ':attribute đã được sử dụng, chọn :attribute khác',
          'confirmed' => ':attribute nhập lại không khớp'
        ],
        [
          'cAccName' => 'Tài khoản đăng nhập',
          'cRealName' => 'Họ và Tên',
          'cPassWord' => 'Mật khẩu',
          'cSecPassword' => 'Mật khẩu cấp 2',
          'cEMail' => 'Địa chỉ email',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
          'cRealName' => $data['cRealName'],
          'cAccName' => $data['cAccName'],
          'cEMail' => $data['cEMail'],
          'cPassWord' => md5($data['cPassWord']),
          'cSecPassword' => md5($data['cSecPassword']),
          'avatar' => 'https://ui-avatars.com/api/?name='. urlencode($data['cRealName']). '&color=7F9CF5&background=EBF4FF&size=256',
        ]);

        if ($user) {
          $data_habitus = [
            'cAccName' => $data['cAccName'],
            'iFlag' => 0,
            'iLeftSecond' => 0,
            'nExtPoint' => 0,
            'nExtPoint2' => 0,
            'dBeginDate' => now(),
            'iLeftMonth' => 0,
            'dEndDate' => date('Y-m-d', strtotime('+2 year')),
          ];
          $account_habitus = AccountHabitus::create($data_habitus);
        }

        return $user;
    }

    protected function redirectTo()
    {
      return route('hotro.dashboard');
    }
}
