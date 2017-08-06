<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">  
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>房源详页</title>  
    <link rel="stylesheet" type="text/css" href="/Public/mobile/easyui.css">  
    <link rel="stylesheet" type="text/css" href="/Public/mobile/mobile.css">  
    <link rel="stylesheet" type="text/css" href="/Public/mobile/icon.css">  
	 <link rel="stylesheet" type="text/css" href="/Public/mobile/add.css">
    <script type="text/javascript" src="/Public/mobile/jquery.min.js"></script>  
    <script type="text/javascript" src="/Public/mobile/jquery.easyui.min.js"></script> 
    <script type="text/javascript" src="/Public/mobile/jquery.easyui.mobile.js"></script> 
</head>
<body>
<style>
ul {list-style:none;}
li {margin-bottom:7px;}
</style>
	<div class="easyui-navpanel">

		<header>
			<div class="m-toolbar">
				<div class="m-title">搜索结果</div>
				<div class="m-left">
                    <a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/mobile/" class="easyui-linkbutton m-back" data-options="plain:true,outline:true">返回</a>
                </div>
			</div>
		</header>
		
		<footer>
			<div class="m-toolbar">
				<div class="m-title">www.gcfang.cn - 简约不简单</div>
			</div>
		</footer>
		
		  <div style="text-align:left;margin:5px 30px;font-size:14px;">
		   <span style="font-weight:bold;"><?php echo ($house["title"]); ?></span>
            <ul>
					 
					 <li>房源编号：<?php echo ($house["id"]); ?> &nbsp; 发布时间：<?php echo ($house["create_time"]); ?></li>
					 <li>面积：<?php echo ($house["size"]); ?>平 价格：<?php echo ($house["price"]); ?> </li>
					 <li>联系人： <?php echo ($house["personal_name"]); ?> <?php echo ($house["personal_tel"]); ?> </li>
			 </ul>
		详细信息： <?php echo ($house["content"]); ?>
		</div>
	</div>
	
	
<script>
</script>
</body>	
</html>