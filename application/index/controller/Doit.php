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
            return  json_encode('/uploads/cate/'.$info->getSaveName());

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


}