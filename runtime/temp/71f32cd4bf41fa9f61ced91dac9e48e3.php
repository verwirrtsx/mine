<?php /*a:1:{s:67:"D:\phpstudy_pro\WWW\mine\application\index\view\index\shop_add.html";i:1568191684;}*/ ?>
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
	.imgwitdh{
		width: 50px;
		height: 50px;
	}
	.weiyi{
		mar
	}
  </style>
  <body>
    <div class="x-body">
        <form class="layui-form">
          <div class="layui-form-item">
              <label for="sname" class="layui-form-label">
                  <span class="x-red">*</span>商品名
              </label>
              
              <div class="layui-input-inline">
                  <input type="text" id="sname" name="sname"
                  autocomplete="off" class="layui-input">
              </div>
              <div class="layui-form-mid layui-word-aux">
                  <span class="x-red">*</span>输入商品名
              </div>
          </div>
		  
		  <div class="layui-form-item">
		      <label for="price" class="layui-form-label">
		          <span class="x-red">*</span>商品单价
		      </label>
		      
		      <div class="layui-input-inline">
		          <input type="text" id="price" name="price"
		          autocomplete="off" class="layui-input">
		      </div>
		      <div class="layui-form-mid layui-word-aux">
		          <span class="x-red">*</span>输入商品单价
		      </div>
		  </div>
		  
		  <div class="layui-form-item">
		      <label for="oprice" class="layui-form-label">
		          <span class="x-red">*</span>商品原价
		      </label>
		      
		      <div class="layui-input-inline">
		          <input type="text" id="oprice" name="oprice"
		          autocomplete="off" class="layui-input">
		      </div>
		      <div class="layui-form-mid layui-word-aux">
		          <span class="x-red">*</span>输入商品原价
		      </div>
		  </div>
		  
		  
		<div class="layui-form-item">
		    <label for="less" class="layui-form-label">
		        <span class="x-red">*</span>商品库存
		    </label>
		    
		    <div class="layui-input-inline">
		        <input type="text" id="less" name="less"
		        autocomplete="off" class="layui-input">
		    </div>
		    <div class="layui-form-mid layui-word-aux">
		        <span class="x-red">*</span>商品库存
		    </div>
		</div>
		
		
		
         <div class="layui-form-item" > 
		<div class="layui-upload" style="margin-top: 20px;margin-left: 45px;">
			
		  <button type="button" class="layui-btn" id="test2">多图片上传</button> 
		  <blockquote class="layui-elem-quote layui-quote-nm" style="margin-top: 10px;width: 300px;">
			预览图：
			<div class="layui-upload-list" id="demo2"></div>
		 </blockquote>
		</div>
        </div>
		
		

		
          <div class="layui-form-item">
              <label for="add" class="layui-form-label">
              </label>
              <button  class="layui-btn" lay-filter="add" lay-submit="">
                  增加
              </button>
          </div>
      </form>
    </div>
    <script>
        layui.use(['form','layer','upload'], function(){
           var  $ = layui.jquery;
          var form = layui.form
          ,layer = layui.layer
				 ,upload = layui.upload;
				 var img=[];
				 
upload.render({
    elem: '#test2'
    ,url: 'uploadimg'
    ,multiple: true
    ,before: function(obj){
      //预读本地文件示例，不支持ie8
      obj.preview(function(index, file, result){
        $('#demo2').append('<img src="'+ result +'" alt="'+ file.name +'" class="layui-upload-img imgwitdh">')
      });
    }
    ,done: function(res){
      //上传完毕
	
	  img.push(res);
	   // console.log(img);
    }
  });
  
          //监听提交
    form.on('submit(add)',
    function(data) {
		// console.log($('#sname').val())
    $.ajax({  
                 type: "post",  
                 url: "addshop",  
                 data: {
				  img:img,
    			  sname:$('#sname').val(),
    			  price:$('#price').val(),
    			  oprice:$('#oprice').val(),
    			  less:$('#less').val()
    			  },  
                 dataType: "json",  
                 success: function(data){
    				 // console.log(data);
    				 if(data == "ok"){
    					layer.alert("增加成功", {
    					    icon: 6
    					},
    					function() {
    					    //关闭当前frame
    					    xadmin.close();
    					    // 可以对父窗口进行刷新 
    					    xadmin.father_reload();
    					});
    				 }
    				 if(data == "error"){
    					layer.alert("增加失败", {
    					    icon: 7
    					},
    					function() {
    					    //关闭当前frame
    					    xadmin.close();
    					    // 可以对父窗口进行刷新 
    					    xadmin.father_reload();
    					});
    				 }
                         
                          },  
                 error:function(e){  
                       // console.log(e);  
                 }  
             }); 
        //发异步，把数据提交给php
    
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