<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/6
 * Time: 9:40
 */

namespace app\index\controller;


use think\Controller;
use  think\db;
use  think\facade\Env;
use think\facade\Config;
class Doit extends  Controller
{
    public  function  catepic(){
        $file = request()->file('file');
        // 移动到框架应用根目录/uploads/ 目录下
        $info = $file->move( Env::get('root_path').'/public/uploads/cate');
        if($info){
            // 成功上传后 获取上传信息
            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
            //echo $info->getSaveName();
            return  json(Config::get('gateway').'/uploads/cate/'.$info->getSaveName());

        }else{
            // 上传失败获取错误信息
            echo $file->getError();
        }
    }

    public  function  cateedit($cid,$cname,$img=""){
        if(empty($cname)){
           $res1= db::table("cate")->where("cid",$cid)->find();
           $cname =$res1['cname'];
        }
     $res =  db::table("cate")->where("cid",$cid)->update([
            "cname"=>$cname,
            "img"=>$img
        ]);

        if($res){
            return json("ok");
        }else{
            return json("error");
        }
    }

    public  function  uploadimg(){
        $file = request()->file('file');
        // 移动到框架应用根目录/uploads/ 目录下
        $info = $file->move( Env::get('root_path').'/public/uploads/shopimg');
        if($info){
            // 成功上传后 获取上传信息
            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
            //echo $info->getSaveName();
            $url= str_replace("\\","/",$info->getSaveName());
            return  json_encode(Config::get('gateway').'/uploads/shopimg/'.$url);

        }else{
            // 上传失败获取错误信息
            echo $file->getError();
        }
    }

    public function  addshop($img=[],$sname,$price,$oprice,$less){
    $data=[
        "sname"=>$sname,
        "price"=>$price,
        "oprice"=>$oprice,
        "less"=>$less,
        "addtime"=>date("Y-m-d H-i-s"),
        "s_img"=>$img[0],
        "status"=>1
    ];
    $res =db::table("shop")->insertGetId($data);
    if($res){
        foreach ($img as $i){
         $data1=[
             "url"=>$i,
             "sid"=>$res,
             "status"=>1
         ];
           db::table("shop_img")->insert($data1);
        }
        return json("ok");
    }

    }
    //下架
    public  function  outshop($sid){
        $res= db::table("shop")->where("sid",$sid)->update(
            [
                "status"=>0
            ]
        );
        if($res){
            return json("ok");
        }else{
            return json("error");
        }
    }

    //上架
    public  function  inshop($sid){
        $res= db::table("shop")->where("sid",$sid)->update(
            [
                "status"=>1
            ]
        );
        if($res){
            return json("ok");
        }else{
            return json("error");
        }
    }
//    banner 上传
    public function  banner(){
        $file =request()->file('file');
        $info = $file->move( Env::get('root_path').'/public/uploads/banner');
        if($info){
            return  json( Config::get('gateway').'/uploads/banner/'.$info->getSaveName());
        }else{
            return json_encode($file->getError());
        }
    }
//banner up
    public  function  addbanner($url,$basecolor,$theme){
        $time =date("Y-m-d H:i:s");
        $url= str_replace("\\","/",$url);
        $data=[
            "theme"=>$theme,
            "url"=>$url,
            "basecolor"=>$basecolor,
            "addtime"=>$time
        ];
       $res= db::table("banner")->insert($data);
        if($res){
            return json("ok");
        }else{
            return json("error");
        }

    }
//    删除banner
    public function  delBanner($bid){
   $res= db::table("banner")->where("bid",$bid)->update([
        "status"=>0
    ]);

        if($res){
            return json("ok");
        }else{
            return json("error");
        }
    }


}