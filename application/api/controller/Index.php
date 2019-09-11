<?php
namespace app\api\controller;

use think\Controller;
use  think\db;
use think\facade\Env;

class Index extends  Controller
{
    public function index()
    {
        $arr =[
            [
                "a"=>1,
                "b"=>2
            ],
            [
                "a"=>1,
                "b"=>2
            ]
        ];

        return json(Config::get('gateway'));

    }


}
