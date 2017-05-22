<?php

namespace App\Http\Controllers\Auth;

use App\Liuyanban;
use App\User;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Symfony\Component\HttpFoundation\Request;


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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    //用户退出登录
    public function logout()
    {
        auth()->logout();
        return redirect('/home');
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
            'password' => 'required|min:6|confirmed',
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


    public function loginin(Request $res)
    {
        if (Auth::attempt(['user' => $res->user, 'password' => $res->password], $res->remember_me)) {

            $user = User::where('user', '=', $res->get('user'));
            Auth::login($user->first());
            return redirect('index.html');
        } else {
            echo '<script>alert(\'当前用户信息有误,返回重新重试\')</script>';
            return redirect()->back();
        }
    }

    public function islogin()
    {
        $ly_all = Liuyanban::all();
        if (Auth::check()) {
            $user = Auth::user();
            $arr = ['name' => $user->name , 'ly' => $ly_all];
        } else
            $arr = ['ly' => $ly_all];
        return view('index/index', $arr);
    }
    



}
