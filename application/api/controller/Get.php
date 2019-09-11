<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/11
 * Time: 11:36
 */

namespace app\api\controller;


use think\Controller;
use  think\db;
class Get extends Controller
{

    public  function  getbanner(){
        $res=  db::table("banner")->where("status",1)->select();
        return json($res);
    }

    public function  getshop(){
        $shop=db::table("shop")
            ->where("status",1)
            ->select();

        return json($shop);
    }

    //数组拼接
    public  function  getshop1(){
        $shop=[];
      $lists=  db::table("shop")->where("status",1)->select();
      foreach ($lists as $k =>$list){
        $img=  db::table("shop_img")
              ->where("sid",$list['sid'])
              ->where("status",1)
            ->column("url");

//        dump($img);
        $list['imgurl']=$img;
        array_push($shop,$list);
      }

      return json($shop);

    }



}