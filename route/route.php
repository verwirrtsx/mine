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
Route::rule('cateadd', 'index/cateadd');
Route::rule('addcate', 'index/addcate');
Route::post('delcate', 'index/delcate');
Route::rule('catee', 'index/catee');
Route::rule('soncate', 'index/soncate');
Route::rule('catepic', 'doit/catepic');
Route::rule('cateedit', 'index/cateedit');
Route::post('cateedit', 'doit/cateedit');
Route::rule('order_list', 'index/orderList');
Route::rule('order_list1', 'index/orderList1');
Route::rule('order_list2', 'index/orderList2');
Route::rule('showorder', 'index/showorder');
Route::rule('shop_list', 'index/shopList');
Route::rule('shop_add', 'index/shopAdd');
Route::rule('shop_list1', 'index/shopList1');
Route::post('uploadimg', 'doit/uploadimg');
Route::post('addshop', 'doit/addshop');
Route::post('outshop', 'doit/outshop');
Route::post('inshop', 'doit/inshop');
Route::rule('shop_edit', 'index/shopEdit');
Route::rule('banner_list', 'index/bannerList');
Route::rule('banner_add', 'index/bannerAdd');
Route::rule('banner', 'doit/banner');
Route::rule('addbanner', 'doit/addbanner');
Route::post('delBanner', 'doit/delBanner');



//api
Route::get('getbanner', 'api/get/getbanner');
Route::get('getshop', 'api/get/getshop');
Route::rule('api', 'api/index/index');
return [

];
