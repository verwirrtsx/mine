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
        $arr =array();
        //$res =db::table("cate")->where("status","1")->select();
        $fcate =db::table("cate")->where("status","1")->where("fid","0")->select();
        foreach ($fcate as $key =>$v){
            array_push($arr,$v);
            $res1 =db::table("cate")->where("fid",$v['cid'])->where("status","1")->select();
            foreach ($res1 as $key =>$v1){
                array_push($arr,$v1);
            }
        }
        $this->assign("cate",$arr);
        return $this->fetch();
    }
    //添加页面
    public  function  cateadd(){
        return $this->fetch();
    }
    //添加操作
    public  function  addcate($cname,$img="",$fid=0){
        $img= str_replace("\\","/",$img);
        $res = db::table("cate")->insert([
            "cname"=>$cname,
            "img"=>$img,
            "fid"=>$fid,
            "status"=>1
        ]);
        if($res){
            return json("ok");
        }else{
            return json("error");
        }
    }

    //删除操作
    public  function  delcate($cid){
       $res = db::table("cate")->where("cid",$cid)->update([
            "status"=>0
        ]);
       if($res){
            return json("ok");
       }else{
       return json("error");
       }
    }
    //添加子分类
    public  function  catee(){
        $id =input("id");
        $this->assign("id",$id);
        return $this->fetch();
    }
    //添加子分类
    public function  soncate($cname,$fid,$img=""){
      $res =db::table("cate")->insert([
            "fid"=>$fid,
            "img"=>$img,
            "cname"=>$cname,
          "status"=>1
        ]);
        if($res){
            return json("ok");
        }else{
            return json("error");
        }
    }

    //分类修改
    public  function  cateedit($id){
        $this->assign("id",$id);

        return $this->fetch();
    }
//    待处理订单列表
    public  function  orderList(){
      $list= db::table("order")
          ->paginate(10);
      $this->assign("list",$list);
      return $this->view->fetch();
    }

//    public  function  orderList1(){
//        return $this->view->fetch();
//    }
//    待确认订单列表
    public  function  orderList2(){
        return $this->view->fetch();
    }

    public  function  showorder($id){
        return $this->view->fetch();
    }
//    商品列表
    public  function  shopList(){
$shop=db::table("shop")
    ->where("status",1)
    ->paginate(10);
        $this->assign("shop",$shop);
       return $this->view->fetch();
    }
//    商品添加
    public  function  shopAdd(){
        return $this->view->fetch();
    }
    //    商品列表1
    public  function  shopList1(){
        $shop=db::table("shop")
            ->where("status",0)
            ->paginate(10);
        $this->assign("shop",$shop);
        return $this->view->fetch();
    }

    //商品修改
    public  function shopEdit($sid){

        $this->assign("sid",$sid);
        return $this->fetch();
    }

//    轮播列表
    public  function  bannerList(){
        $ban=  db::table("banner")->where("status",1)->paginate(10);
        $this->assign("bann",$ban);
        return $this->fetch();
    }
    //轮播添加
    public  function  bannerAdd(){

        return $this->fetch();
    }

}
