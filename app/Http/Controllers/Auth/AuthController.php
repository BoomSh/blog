<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    
    
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * 重写登录
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postLogin(Request $request)
    {   
        //表单验证
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
            'verify' =>'required',
        ],[
            'email.required' =>'邮箱名不能省略', 
            'password.required' => '密码不能为空',
            'verify.required' => '验证码不能为空',
        ]);

        //匹配验证码
        $verify = $request->input('verify');
        if(!Session::get('milkcaptcha')==$verify){
            return redirect('auth/login')->withInput($request->except('password'))->with('msg', '验证码错误');
        }

        //邮箱、密码验证
        $email = $request->input('email');
        $password = $request->input('password');
        if(empty($request->input('remember'))) {  //remember表示是否记住密码
            $remember = 0;
        } else {
            $remember = $request->input('remember');
        }
        //如果要使用记住密码的话，需要在数据表里有remember_token字段
        if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) { 
              
            return redirect()->intended('/admin/index');
        }
        return redirect('auth/login')->withInput($request->except('password'))->with('msg', '用户名或密码错误');
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ],[
            'name.required' => '用户名不能省略',
            'name.max' => "用户名不能超过255位",
            'email.required' =>'邮箱名不能省略',
            'email.email' =>'邮箱格式不正确',
            'email.max' =>'邮箱不能超过255位',
            'email.unique' =>'邮箱名不能重复',
            'password.required' => '密码不能为空',
            'password.confirmed' => '两次输入的密码不一致',
            'password.min' => '密码长度不能小于六位',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
