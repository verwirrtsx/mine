<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------



Route::rule('login', 'index/login');
Route::rule('/', 'index/index');
Route::post('dologin', 'index/dologin');
Route::rule('index', 'index/index');
Route::rule('welcome', 'index/welcome');
Route::rule('member_list', 'index/memberList');
Route::rule('member_add', 'index/memberAdd');
Route::rule('member_del', 'index/memberDel');
Route::post('adduser', 'index/adduser');
Route::post('delUser', 'index/delUser');
Route::post('reUser', 'index/reUser');
Route::rule('cate', 'index/cate');
return [

];
