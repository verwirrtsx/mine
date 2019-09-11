<?php /*a:1:{s:69:"D:\phpstudy_pro\WWW\mine\application\index\view\index\shop_list1.html";i:1568192622;}*/ ?>
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
        <!--[if lt IE 9]>
          <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
          <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="x-nav">
          <span class="layui-breadcrumb">
            <a href="">首页</a>
            <a href="">演示</a>
            <a>
              <cite>导航元素</cite></a>
          </span>
          <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" onclick="location.reload()" title="刷新">
            <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
        </div>
        <div class="layui-fluid">
            <div class="layui-row layui-col-space15">
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-body ">
                            <form class="layui-form layui-col-space5">
                                <div class="layui-inline layui-show-xs-block">
                                    <input class="layui-input"  autocomplete="off" placeholder="开始日" name="start" id="start">
                                </div>
                                <div class="layui-inline layui-show-xs-block">
                                    <input class="layui-input"  autocomplete="off" placeholder="截止日" name="end" id="end">
                                </div>
                                <div class="layui-inline layui-show-xs-block">
                                    <input type="text" name="username"  placeholder="请输入商品名" autocomplete="off" class="layui-input">
                                </div>
                                <div class="layui-inline layui-show-xs-block">
                                    <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                                </div>
                            </form>
                        </div>
                        <div class="layui-card-header">
                            <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
                            <button class="layui-btn" onclick="xadmin.open('添加商品','shop_add',600,400)"><i class="layui-icon"></i>添加</button>
                        </div>
                        <div class="layui-card-body ">
                            <table class="layui-table layui-form">
                              <thead>
                                <tr>
                                  <th>
                                    <input type="checkbox" name=""  lay-skin="primary">
                                  </th>
                                  <th>商品图片</th>
                                  <th>商品名</th>
                                  <th>商品价格</th>
                                  <th>商品原价</th>
                                  <th>商品库存</th>
                                  <th>加入时间</th>
                                  <th>状态</th>
                                  <th>操作</th>
                              </thead>
                              <tbody>
                               <?php if(is_array($shop) || $shop instanceof \think\Collection || $shop instanceof \think\Paginator): $i = 0; $__LIST__ = $shop;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                               <tr>
                                 <td>
                                   <input type="checkbox" name=""  lay-skin="primary">
                                 </td>
                                 <td>
                               	  <img src=" <?php echo htmlentities($v['s_img']); ?>"  width="50px" height="50px"/>
                                
                                 </td>
                                 <td><?php echo htmlentities($v['sname']); ?></td>
                                 <td><?php echo htmlentities($v['price']); ?></td>
                                 <td><?php echo htmlentities($v['oprice']); ?></td>
                                 <td><?php echo htmlentities($v['less']); ?></td>
                                 <td><?php echo htmlentities($v['addtime']); ?></td>
                                  <td class="td-status">
                                    <span class="layui-btn layui-btn-danger layui-btn-mini">
                                                      已下架
                                                  </span></td>
                                  <td class="td-manage">
                                    <a onclick="member_stop(this,<?php echo htmlentities($v['sid']); ?>)" href="javascript:;"  title="上架">
                                      <i class="layui-icon">&#xe62f;</i>
                                    </a>
                                    <a title="编辑"  onclick="xadmin.open('编辑','shop_edit?sid='+<?php echo htmlentities($v['sid']); ?>,800,800)" href="javascript:;">
                                      <i class="layui-icon">&#xe642;</i>
                                    </a>
									
                                    
                                  </td>
                                </tr>
								<?php endforeach; endif; else: echo "" ;endif; ?>
                              </tbody>
                            </table>
                        </div>
                        <div class="layui-card-body ">
                            <div class="page">
                                <div>
                                 <?php echo $shop; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </body>
    <script>
      layui.use(['laydate','form','jquery'], function(){
        var laydate = layui.laydate;
        var form = layui.form,$ = layui.jquery;
        
        //执行一个laydate实例
        laydate.render({
          elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
          elem: '#end' //指定元素
        });
      });

       /*用户-停用*/
      function member_stop(obj,id){
          layer.confirm('确认要上架吗？',function(index){
			
			$.ajax({
			             type: "POST",  
			             url: "inshop",  
			             data: {
							 sid:id
				
						  },  
			             dataType: "json",  
			             success: function(data){
							 // console.log(data);
							 if(data == "ok"){
								layer.alert("上架成功", {
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
								layer.alert("上架失败", {
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
			                    console.log(e);  
			             }  
			         });  

              
          });
      }

      /*用户-删除*/
      function member_del(obj,id){
          layer.confirm('确认要删除吗？',function(index){
              //发异步删除数据
              $(obj).parents("tr").remove();
              layer.msg('已删除!',{icon:1,time:1000});
          });
      }



      function delAll (argument) {

        var data = tableCheck.getData();
  
        layer.confirm('确认要删除吗？'+data,function(index){
            //捉到所有被选中的，发异步进行删除
            layer.msg('删除成功', {icon: 1});
            $(".layui-form-checked").not('.header').parents('tr').remove();
        });
      }
    </script>
    <script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
      })();</script>
</html>