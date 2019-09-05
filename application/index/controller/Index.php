<?php
namespace app\index\controller;

use think\Controller;
use think\facade\Session;
use  think\db;
class Index extends  Controller
{
    //主页
    public function index()
    {
        if(Session::get("admin")){
            return $this->view->fetch();
        }else{
            return redirect('index/login');
            }
    }

//    登录页面
    public  function  login(){

       return $this->view->fetch();

    }
    //登录操作
    public  function  dologin($username,$password){
       $res= db::table("admin")->where("id",1)->find();
        if($username == $res['username'] && md5($password) ==$res['password']){
            Session::set("admin", $res['username']);
            Session::set("logintime", date("Y-m-d H:i:s"));
            return json('ok');
        }else{
            return json('error');
        }
    }

    //后台桌面
    public  function  welcome(){
       $admin= Session::get("admin");
        $time =Session::get("logintime");
       $this->assign([
           "admin"=>$admin,
           "time"=>$time
       ]);
       return $this->fetch();
    }

    //用户列表
    public function  memberList(){

        $list = Db::name('user')->where('status',1)->paginate(10);
        // 把分页数据赋值给模板变量list
        $this->assign('list', $list);
        return $this->view->fetch();
    }

    //添加用户
    public  function  memberAdd(){
        return $this->view->fetch();

    }
    //添加用户 操作
    public  function  adduser($email,$username,$password,$sex,$phone,$address){
   $res= db::table("user")->insert([
                "email"=>$email,
                "username"=>$username,
                "address"=>$address,
                "phone"=>$phone,
                "sex"=>$sex,
               "password"=>md5($password),
                "addtime"=>date("Y-m-d H:i:s")
             ]);
   if($res){
    return json("ok");
   }else{
       return  json("error");
   }
    }
//    删除页面
    public  function memberDel(){
        $list = Db::name('user')->where('status',0)->paginate(10);
        // 把分页数据赋值给模板变量list
        $this->assign('list', $list);
        return $this->view->fetch();
    }

//    执行删除
    public  function  delUser($id){
        $res=Db::table("user")->where("id",$id)->update([
            "status"=>0
        ]);
        if($res){
return json("ok");
        }else{
            return json("error");
        }
    }

//恢复
    public  function  reUser($id){
        $res=Db::table("user")->where("id",$id)->update([
            "status"=>1
        ]);
        if($res){
            return json("ok");
        }else{
            return json("error");
        }
    }

//    分类
    public  function  cate(){
        return $this->view->fetch();
    }
}
