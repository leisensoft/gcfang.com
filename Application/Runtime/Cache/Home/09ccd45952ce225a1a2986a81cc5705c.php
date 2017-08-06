<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo ($article["title"]); ?> <?php echo ($site_info["title"]); ?></title>
	<meta name="keywords" content="<?php echo ($site_info["keywords"]); ?>" />
	<meta name="description" content="<?php echo ($site_info["description"]); ?>" />
	<meta baidu-gxt-verify-token="5b60a5f5fc32f289bdae383702e80828">
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
						<a href="<?php echo ($site_info["area_url"]); ?>" onclick="alert('请使用Ctrl+D进行添加');" title='<?php echo ($site_info["web_name"]); ?>' rel="sidebar">加入收藏</a>
						<a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/shortcut" target=_blank>放到桌面</a>   
&nbsp;&nbsp;&nbsp;<span style="color:blue;">[商务合作电话 小刘:13932176996]</span>						
				</div>
				<div class="top_right">					
						<!--
						<?php if(($user_name) == ""): ?>欢迎您 <?php echo ($user_info["person_name"]); ?> <a target=_blank href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/u/manage">我的办公室</a>
						<?php else: ?>
							欢迎您来到 <?php echo ($site_info["web_name"]); ?> <a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/register.html">[注册] [登陆]</a><?php endif; ?>
						-->	
				</div>
			</div>	
</div>
		<div class="nav">
			<ul>
					<li ><a style="color:yellow;" href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>"><?php echo ($site_info["web_name"]); ?>首页</a></li>
					<li ><a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/mapHouse">地图找房</a></li>
			</ul>
</div>
<style>
.about_nav{width:166px;height:36px;margin:10px 3px 0 78px; font-size:18px;font-weight:bold;cursor:pointer;color:grey;}
.about_nav a:hover{text-decoration:underline;}
</style>		
		<div class="common_box" >
				<div style="width:226px;height:230px;float:left;border:1px solid grey;margin-top:20px;">
					 <div class="about_nav"><a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/about/id/9.html">关于我们</a></div>
					 <div class="about_nav"><a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/about/id/10.html">诚征合作</a></div>
					 <div class="about_nav"><a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/about/id/11.html">用户协议</a></div>
					 <div class="about_nav"><a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/about/id/12.html">版权声明</a></div>
					 <div class="about_nav"><a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/about/id/13.html">联系我们</a></div>
				</div>
				<div style="width:740px;height:100%;float:left;margin-left:4px;border:1px solid grey;margin-top:20px;">
				  <div style="width:100%;height;35px;margin:10px auto;font-size:28px;text-align:center;"><?php echo ($article["title"]); ?> </div>
				  <div style="width:100%;height:100%;margin:30px auto;font-size:16px;"><?php echo ($article["content"]); ?></div>
				</div>
		</div>
		<div style="clear:both;"></div>
<div class="foot_box">
				<div class="foot_banner"><a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/about/id/9.html">关于我们</a> | <a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/about/id/10.html" style="color:red; font-weight: bold;">诚征合作</a> | <a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/about/id/11.html">用户协议</a> | <a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/about/id/12.html">版权声明</a> | <a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/about/id/13.html">联系我们</a> | <a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/sitemap.html">网站地图</a> | <a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/sitemap.xml">sitemap</a></div> 
				<div class="foot_banner"><?php echo ($site_info["web_name"]); ?>@版权所有&nbsp;&nbsp;&nbsp; 备案号: <a target=_blank href="http://www.miitbeian.gov.cn/publish/query/indexFirst.action">冀ICP备14019838号</a> &nbsp;&nbsp;技术支持: 石家庄市绿境网络技术有限公司</div>
				<div style="padding-bottom:10px;"  class="foot_banner"><?php echo ($site_info["connect_us"]); ?> <?php echo ($site_info["count_code"]); ?></div>		
</div>
</body>
</html>