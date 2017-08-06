<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo ($house_info["title"]); ?>-<?php echo ($site_info["web_name"]); ?></title>
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

<link rel="stylesheet" type="text/css" href="/Public/css/houseDetail.css">	
</head>	
<body>
		<div class="nav">
			<ul>
					<li ><a style="color:yellow;" href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>"><?php echo ($site_info["web_name"]); ?>首页</a></li>
					<li ><a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/mapHouse">地图找房</a></li>
			</ul>
</div>	
		<div class="common_box" >
				<div style="width:686px;height:auto;float:left;border:1px solid #ccc;margin-top:10px;">
					  <div style="text-align:center;width:100%;height;35px;margin:10px 0 0 20px;font-size:18px;line-height:28px;">
						 <h1><?php echo ($house_info["title"]); ?></h1>房源编号: <?php echo ($house_info["id"]); ?>
					  </div>
					  <div class="house_info">
							 <div class="house_zone"><a title="点击查看该小区房源" class="easyui-tooltip" style="color:#45A21C;" target=_blank href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/house/zoneDetail/id/<?php echo ($house_info["zone_id"]); ?>.html"><?php echo ($house_info["zone_name"]); ?></a></div>
							 <div class="house_size"><span><?php echo ($house_info["size"]); ?></span>平</div>
							 <div class="house_price"><?php echo ($house_info["price"]); ?></div>
							 <div class="house_create_time" style="font-size:14px;"><?php echo ($house_info["create_time"]); ?></div>
					  </div>
<div style="clear:both;"></div>
					  <div style="border-top:1px dashed #000; margin:0 auto;font-size:16px;margin:0 0 0 10px;">
					  详细信息:
					  </div>
					  <div style="margin:30px auto;font-size:16px;"><?php echo ($house_info["content"]); ?></div>	  
				</div>
				<div style="width:266px;height:auto;float:left;border:1px solid #ccc;margin:10px 0 0 5px;">
					<?php if(empty($house_info["personal_tel"])): ?><ul class="user_info">
							
							<a class="easyui-tooltip" title="点击访问我的主页" target=_blank href="<?php echo ($user_info["shop_url"]); ?>"><img src="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/Public/img/user/<?php echo ($site_info["area_id"]); ?>/<?php echo ($user_info["id"]); ?>.jpg"/></a>
							<li class="company_name"><a class="easyui-tooltip" title="点击访问我的主页" target=_blank href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/a/<?php echo ($user_info["id"]); ?>"><?php echo ($user_info["company_name"]); ?></a></li>
							<li>&nbsp;</li>
							<li>联系人 : <?php echo ($user_info["person_name"]); ?></li>
							<li>手机 : <?php echo ($user_info["tel"]); ?></li>
							<?php if(!empty($user_info["shop_tel"])): ?><li>电话 : <?php echo ($user_info["shop_tel"]); ?></li><?php endif; ?>
							<?php if(!empty($user_info["qq"])): ?><li>Q Q : <?php echo ($user_info["qq"]); ?> <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo ($user_info["qq"]); ?>&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:<?php echo ($user_info["qq"]); ?>:51" alt="点击这里给我发消息" title="点击这里给我发消息"/></a></li><?php endif; ?>
							<li>地 址: <?php echo ($user_info["address"]); ?></li>
						</ul>
					<?php else: ?> 
						<ul class="personal_info">
							<li style="text-align:center;font-weight:bold;">联系方式</li>
							<li>联系人 : <?php echo ($house_info["personal_name"]); ?></li>
							<li>手 机 : <?php echo ($house_info["personal_tel"]); ?></li>
							<li style="text-align:right;margin-right:10px;"><a onclick="delHouse()" style="border:1px solid #ccc;-moz-border-radius: 10px; -webkit-border-radius: 10px; border-radius: 10px;" class="easyui-tooltip" title="需发布者本人输入密码后删除房源信息">删除房源</a></li>
						</ul><?php endif; ?>			
				</div>
		</div>
		<div style="clear:both;"></div>
<div class="foot_box">
				<div class="foot_banner"><a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/about/id/9.html">关于我们</a> | <a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/about/id/10.html" style="color:red; font-weight: bold;">诚征合作</a> | <a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/about/id/11.html">用户协议</a> | <a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/about/id/12.html">版权声明</a> | <a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/about/id/13.html">联系我们</a> | <a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/sitemap.html">网站地图</a> | <a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/sitemap.xml">sitemap</a></div> 
				<div class="foot_banner"><?php echo ($site_info["web_name"]); ?>@版权所有&nbsp;&nbsp;&nbsp; 备案号: <a target=_blank href="http://www.miitbeian.gov.cn/publish/query/indexFirst.action">冀ICP备14019838号</a> &nbsp;&nbsp;技术支持: 石家庄市绿境网络技术有限公司</div>
				<div style="padding-bottom:10px;"  class="foot_banner"><?php echo ($site_info["connect_us"]); ?> <?php echo ($site_info["count_code"]); ?></div>		
</div>
<script>
function delHouse(){
	 $.messager.prompt('删除房源', '请输入发布房源时设置的密码,如果忘记请联系客服删除.', function(pass){
									if (pass){
										  $.post("http://<?php echo ($_SERVER['SERVER_NAME']); ?>/house/personDelHouse",{id:<?php echo ($house_info["id"]); ?>,pass:pass},function(result){
												if('err'==result){
													 $.messager.alert('错误','删除失败','error');
												}
												if('ok'==result){
													 $.messager.alert('提示','删除成功');
													 location.href = "http://<?php echo ($_SERVER['SERVER_NAME']); ?>";
												}
										  });
									}
	 });
}
</script>
</body>
</html>