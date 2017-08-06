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
					<li ><a href="">买 房</a></li>
					<li ><a href="">租  房</a></li>
					<li ><a href="">门市/厂房</a></li>
					<li ><a href="">车库/车位</a></li>
			</ul>
</div>
<style>
.search_form{margin:15px 10px 15px 20px;}
.how_to_recommend a:hover{text-decoration:underline;}
.house_table{width:100%;height:50px;border:0px solid blue;}
.house_info_list_main{height:100%;width:100%;border:0px solid green;float:left;}
.list_title{width:430px;font-size:16px;font-weight:bold;margin:2px 0 0 10px;color:#000;float:left;}
.house_zone{width:140px;font-size:20px;font-weight:bold;float:left;color:#45A21C;}
.house_price{width:90px;font-size:20px;float:left;}
.house_price span{color:#DA5E43;}
.house_size{width:90px;font-size:20px;float:left;}
.house_label_free{height:100%;width:100px;border:0px solid grey;float:left;}
.list_user{float:left;}
.lab2{
		margin:0 0 2px 3px;
		border-bottom: 1px solid rgba(0, 0, 0, 0.25);
		position: relative;
		cursor: pointer;
		font-size:14px;
		color:white;
		display:-moz-inline-box;
		display:inline-block;
		width:32px;		
}
.lab_car{background-color:#DA5E43; width:46px;}
.lab_cottage{background-color:#FFC740;width:46px;}
.lab_elevator{background-color:#45A21C;width:46px;}
.lab_thorough{background-color:#DA5E43; width:60px;}
.lab_decoration{background-color:#45A21C;width:46px;}
</style>		
		<div class="common_box" >
				<div style="width:980px;height:100%;float:left;border:1px solid grey;margin-top:5px;">
					<div class="sub_title" style="margin:10px 20px 0px 20px;">搜索房源:</div>
					房源类型:<input class="search_form" type="text" value="二手房出租"/>
				</div>
<div style="clear:both;"></div>	
				<div style="width:760px;height:auto;float:left;border:1px solid grey;margin-top:3px;">
						<div class="house_info_list">
								<div style="height:36px;float:left;margin:10px 20px 0px 20px;" class="sub_title">推荐房源</div> 
								<div class="how_to_recommend" style="height:36px;float:left;margin:15px 20px 0px 0px;"> <a href="#">(如何加入推荐)</a> </div>
								<div style="clear:both;"></div>
								<div class="house_info_list">
										<div class="house_table">
												
												<div class="house_info_list_main">
														
														<div class="list_title">
															<span class="lab2 lab_top">置顶</span><span class="lab2 lab_hurry">加急</span> <span class="lab2 lab_recommend">推荐</span>
															龙华苑135平带车位小房85万
														</div>
														<div class="house_zone">龙华苑</div>
														<div class="house_size"><span>120</span>平</div>
														<div class="house_price"><span>180万</span></div>
														
														<div class="list_user">由 天运中介 2015年6月1日 提供</div>
												</div>
												
												
												<!--
												<div class="house_label_free">
														<span class="lab2 lab_thorough">南北通透</span><span class="lab2 lab_car">带车库</span>
														<span class="lab2 lab_elevator">带电梯</span><span class="lab2 lab_cottage">带小房</span>
														<span class="lab2 lab_decoration">精装修</span>
												</div> -->
										</div>
										<div style="clear:both;"></div>
										
										
										<div class="house_table"></div>
										<div class="house_table"></div>
										<div class="house_table"></div>
										<div class="house_table"></div>
										<div class="house_table"></div>
								</div>
						</div>
				</div>
		</div>
		
		<div style="clear:both;"></div>
<div class="foot_box">
				<div class="foot_banner"><a href="<!--<?php echo ($cfg["url"]); ?>-->about/about.php">关于我们</a> | <a href="<!--<?php echo ($cfg["url"]); ?>-->about/talented.php" style="color:red; font-weight: bold;">诚征合作</a> | <a href="<!--<?php echo ($cfg["url"]); ?>-->about/agreement.php">用户协议</a> | <a href="<!--<?php echo ($cfg["url"]); ?>-->about/copyright.php">版权声明</a> | <a href="<!--<?php echo ($cfg["url"]); ?>-->about/contact.php">联系我们</a></div> 
				<div class="foot_banner">[web_name]@版权所有&nbsp;&nbsp;&nbsp; 备案号: <a target=_blank href="http://www.miitbeian.gov.cn/publish/query/indexFirst.action">冀ICP备14019838号</a> &nbsp;&nbsp;技术支持: 石家庄市藁城区绿境网络技术有限公司</div>
				<div style="padding-bottom:10px;"  class="foot_banner">[connect_us]</div>		
</div>
</body>
</html>