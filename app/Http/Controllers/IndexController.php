<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Post\PostController;
use App\UserModel;
use App\Liuyanban;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
class UserController extends Controller
{
    public $userModel;
    public function __construct(){
        if($this->userModel == null){
            $this->userModel = new UserModel();
        }
    }
    //视图展示
    public function showPage($url){
        return view($url);
    }
    //添加用户
    public function create(Request $request){
       $user = $request->all();
       $result = $this->userModel->createUser($user);
       if($result){
           Session::put(['user',$result['username'],'uid' => $result['id']]);
           Session::save();
           return redirect('postList');
       }
    }
    public function submit(Request $res){

        if (!Auth::check()){
            return response()->json(['code' => '404', 'state' => 'username error' ,'msg' => '用户数据异常']);
        }
        if( $res -> has('content') ){
            $user = Auth::user();
            $liuyan = new Liuyanban;
            $liuyan -> user_id = $user -> id ;
            $liuyan -> content = $res ->input('content');
            $liuyan -> user = $user -> user ;
            $liuyan -> save();
            return response()->json(['code' => '200', 'state' => 'ok' ,'msg' => '用户数据添加成功']);
        }else{
            return response()->json(['code' => '400', 'state' => 'content error' ,'msg' => '提交数据为空']);
        }

    }
}