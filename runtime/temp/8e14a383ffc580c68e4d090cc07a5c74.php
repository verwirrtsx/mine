<?php /*a:1:{s:69:"D:\phpstudy_pro\WWW\mine\application\index\view\index\banner_add.html";i:1568169982;}*/ ?>
<!DOCTYPE html>
<html class="x-admin-sm">
  
  <head>
   <meta charset="UTF-8">
   <title>后台管理系统</title>
   <meta name="renderer" content="webkit|ie-comp|ie-stand">
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
   <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
   <meta http-equiv="Cache-Control" content="no-siteapp" />
   <link rel="stylesheet" href="/admin/css/font.css">
   <link rel="stylesheet" href="/admin/css/xadmin.css">
   <!-- <link rel="stylesheet" href="./css/theme5.css"> -->
   <script src="/admin/lib/layui/layui.js" charset="utf-8"></script>
   <script type="text/javascript" src="/admin/js/xadmin.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <style>
  	.lef{
  		margin-left: 50px;
  	}
  </style>
  <body>
    <div class="x-body">
        <form class="layui-form">
          <div class="layui-form-item">
              <label for="theme" class="layui-form-label">
                  <span class="x-red">*</span>banner主题
              </label>
              
              <div class="layui-input-inline">
                  <input type="text" id="theme" name="theme"
                  autocomplete="off" class="layui-input">
              </div>
              <div class="layui-form-mid layui-word-aux">
                  <span class="x-red">*</span>输入banner主题
              </div>
          </div>
		  
		  <div class="layui-form-item">
		      <label for="basecolor" class="layui-form-label">
		          <span class="x-red">*</span>banner基础色
		      </label>
		      
		      <div class="layui-input-inline">
		          <input type="text" id="basecolor" name="basecolor"
		          autocomplete="off" class="layui-input">
		      </div>
		      <div class="layui-form-mid layui-word-aux">
		          <span class="x-red">*</span>EX：rgb(0,0,0)
		      </div>
		  </div>
		  
		  
          
				<div class="layui-upload lef">
				  <button type="button" class="layui-btn" id="test1">上传图片</button>
				  <div class="layui-upload-list">
				    <img class="layui-upload-img" id="demo1" width="80px">
				    <p id="demoText"></p>
				  </div>
				</div>   
        
          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
              </label>
              <button  class="layui-btn" lay-filter="add" lay-submit="">
                  增加
              </button>
          </div>
      </form>
    </div>
    <script>
        layui.use(['form','layer','upload','jquery'], function(){
           var  $ = layui.jquery;
          var form = layui.form
          ,layer = layui.layer
				 ,upload = layui.upload;
				 var img;
				 
  upload.render({
    elem: '#test1'
    ,url: 'banner'
    ,before: function(obj){
      //预读本地文件示例，不支持ie8
      obj.preview(function(index, file, result){
        $('#demo1').attr('src', result); //图片链接（base64）
      });
    }
    ,done: function(res){
      //如果上传失败
		console.log(res)
		img =res;
      //上传成功
    }
    ,error: function(){
      //演示失败状态，并实现重传
      var demoText = $('#demoText');
      demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
      demoText.find('.demo-reload').on('click', function(){
        uploadInst.upload();
      });
    }
});
  
          //监听提交
          form.on('submit(add)', function(data){
            console.log(data);
            //发异步，把数据提交给php
            
            layui.use('jquery',function(){
      var $=layui.$;
      $.ajax({  
          type: 'post',  
          url: 'addbanner', // ajax请求路径
          data: {  
              basecolor:data.field.basecolor,
              theme:data.field.theme,
              url:img
          },  
          success: function(data){ 
            if(data=='ok'){
                 layer.alert("添加成功", {icon: 6},function () {
  xadmin.close();

                // 可以对父窗口进行刷新 
                x_admin_father_reload();
          });
            }else if(data=='error'){
             layer.alert("添加失败", {icon: 6},function () {
              // 获得frame索引
  xadmin.close();

                // 可以对父窗口进行刷新 
                x_admin_father_reload();
          });
            }
          }  
      });     
    }); 
            

            return false;
          });
          
          
        });
    </script>
    <script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
      })();</script>
  </body>

</html>