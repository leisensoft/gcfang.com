<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>[title]</title>
	<meta name="keywords" content="[keywords]" />
	<meta name="description" content="[description]" />
	<link rel="stylesheet" type="text/css" href="/Public/css/easyUI/easyui.css">
    <link rel="stylesheet" type="text/css" href="/Public/css/easyUI/icon.css">
    <link rel="stylesheet" type="text/css" href="/Public/css/easyUI/color.css">
    <script type="text/javascript" src="/Public/js/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/js/jquery.easyui.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/Public/css/reset.css">
	<link rel="stylesheet" type="text/css" href="/Public/css/common.css">
</head>	
<body>
		<div class="top">
			<div class="top_a">
				<div class="top_left">
						<a href="[site_url]" onclick="window.external.addFavorite(this.href,this.title);return false;" title='[site_name]' rel="sidebar">加入收藏</a>
						<a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/shortcut" target=_blank>放到桌面</a>        
				</div>
				<div class="top_right">					
						<!--
						<?php if(($user_name) == ""): ?>欢迎您 [user_name] <a target=_blank href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/u/manage">我的办公室</a>
						<?php else: ?>
							欢迎您来到 [site_name] <a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/register.html">[注册] [登陆]</a><?php endif; ?>
						-->
						
						
				</div>
			</div>	
</div>
		<div class="nav">
			<ul>
					<li ><a style="color:yellow;" href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>">廉州房产首页</a></li>
					<li ><a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/mapHouse">地图找房</a></li>
			</ul>
</div>	
		<div class="common_box" >
				<div style="width:980px;height:100%;float:left;border:1px solid grey;margin-top:20px;">
				  <div style="width:100%;height;35px;margin:10px auto;font-size:28px;text-align:center;">关于我们 </div>
				  
				  <div style="width:100%;height;35px;margin:20px auto;font-size:14px;text-align:center;">作者:小刘&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;时间:2015.06.01 </div>
				  
				  
				  <div style="width:100%;height:100%;margin:30px auto;font-size:16px;">石家庄市藁城区绿境网络技术有限公司</div>
				</div>
		</div>
		<div style="clear:both;"></div>
<div class="foot_box">
				<div class="foot_banner"><a href="<!--<?php echo ($cfg["url"]); ?>-->about/about.php">关于我们</a> | <a href="<!--<?php echo ($cfg["url"]); ?>-->about/talented.php" style="color:red; font-weight: bold;">诚征合作</a> | <a href="<!--<?php echo ($cfg["url"]); ?>-->about/agreement.php">用户协议</a> | <a href="<!--<?php echo ($cfg["url"]); ?>-->about/copyright.php">版权声明</a> | <a href="<!--<?php echo ($cfg["url"]); ?>-->about/contact.php">联系我们</a></div> 
				<div class="foot_banner">[web_name]@版权所有&nbsp;&nbsp;&nbsp; 备案号: <a target=_blank href="http://www.miitbeian.gov.cn/publish/query/indexFirst.action">冀ICP备14019838号</a> &nbsp;&nbsp;技术支持: 石家庄市绿境网络技术有限公司</div>
				<div style="padding-bottom:10px;"  class="foot_banner">[connect_us]</div>		
</div>
</body>
</html>