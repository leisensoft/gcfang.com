<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo ($user_info["company_name"]); ?> - <?php echo ($area_name); ?>最专业的房产网站</title>
	<link rel="stylesheet" type="text/css" href="/Public/css/easyUI/easyui.css">
    <link rel="stylesheet" type="text/css" href="/Public/css/easyUI/icon.css">
    <link rel="stylesheet" type="text/css" href="/Public/css/easyUI/color.css">
    <script type="text/javascript" src="/Public/js/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/js/jquery.easyui.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/Public/css/reset.css">
	<link rel="stylesheet" type="text/css" href="/Public/css/common.css">
	<link rel="stylesheet" type="text/css" href="/Public/css/showUser.css">
</head>
<body>
	<div class="common_box">
			<div class="main_left">
				<div style="height:50px;line-height:50px;" class="u_title"><?php echo ($user_info["company_name"]); ?><span class="u_title_url">网址: http://<?php echo ($_SERVER['SERVER_NAME']); ?>/a/<?php echo ($user_info["id"]); ?>  
				<a  href="#" onclick="alert('请使用Ctrl+D进行添加');" title='<?php echo ($user_info["company_name"]); ?>'  rel="sidebar">收藏</a>
				</span> </div>
			</div>
			<div class="user_info">
					<div class="about_us">
						<div class="about_info">
							<div class="about_title">&nbsp;关于我们</div>
							<div class="about_content">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($user_info["about_us"]); ?></div>
						</div>
						<div class="about_pic"><img src="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/Public/img/user/<?php echo ($site_info["area_id"]); ?>/<?php echo ($user_info["id"]); ?>.jpg"/></div>
					</div>
					<div class="connect_us">
						<div class="about_title">&nbsp;联系我们</div>
						<div class="connect_content">
							<ul>
								<li>联系人: <?php echo ($user_info["person_name"]); ?></li>
								<li>电 话: <?php echo ($user_info["tel"]); ?></li>
								<?php if(!empty($user_info["qq"])): ?><li>Q Q : <?php echo ($user_info["qq"]); ?> <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo ($user_info["qq"]); ?>&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:<?php echo ($user_info["qq"]); ?>:51" alt="点击这里给我发消息" title="点击这里给我发消息"/></a></li><?php endif; ?>
								<li>地 址: <?php echo ($user_info["address"]); ?></li>
							</ul>
						</div>	
					</div>
			</div>
			<div class="u_list_box"><div class="about_title">房源信息<!-- <a target=_blank href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/mapHouse/uid/<?php echo ($user_info["id"]); ?>.html">地图找房</a>--></div>
						<div class="info_tabs">
								<ul>
									<?php if(is_array($top_houses)): foreach($top_houses as $key=>$s): ?><li class="info_li">
										 <a target=_blank href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/house/detail/id/<?php echo ($s["id"]); ?>.html">
											<?php if(($s["hurry_to_time"]) > "1"): ?><span style="color:red;" class="info_tabs_title"><?php echo ($s["title"]); ?><span class="lab lab_hurry">急</span><span class="lab lab_top">顶</span></span>
											<?php else: ?> 
												<span class="info_tabs_title"><?php echo ($s["title"]); ?><span class="lab lab_top">顶</span></span><?php endif; ?>
											<span class="info_tabs_zone"><?php echo ($s["zone_name"]); ?></span> <span class="info_tabs_size"><?php echo ($s["size"]); ?>平米</span> <span class="info_tabs_price"><?php echo ($s["price"]); ?></span> <span class="info_tabs_date"><?php echo ($s["create_time"]); ?></span>	
										 </a>
										</li><?php endforeach; endif; ?>
									
									<?php if(is_array($houses)): foreach($houses as $key=>$s): ?><li class="info_li">
										<a target=_blank href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/house/detail/id/<?php echo ($s["id"]); ?>.html">
											<?php if(($s["hurry_to_time"]) > "1"): ?><span style="color:red;" class="info_tabs_title"><?php echo ($s["title"]); ?><span class="lab lab_hurry">急</span></span>
											<?php else: ?> 
												<span class="info_tabs_title"><?php echo ($s["title"]); ?></span><?php endif; ?>
											<span class="info_tabs_zone"><?php echo ($s["zone_name"]); ?></span> <span class="info_tabs_size"><?php echo ($s["size"]); ?>平米</span> <span class="info_tabs_price"><?php echo ($s["price"]); ?></span> <span class="info_tabs_date"><?php echo ($s["create_time"]); ?></span>	
										</a>
										</li><?php endforeach; endif; ?>
								</ul>
								<ul class="page"><?php echo ($page); ?></ul>
						</div>
			</div>
	</div>
<div style="clear:both;"></div>
			<div class="friend_link_box">
				<b><a href=_blank href="#">友情链接与合作伙伴:</a></b>
				<a href=_blank href="#">百度</a>
			</div>
			
			<div class="foot_box"> 
				<div class="foot_banner"><?php echo ($web_name); ?>@版权所有&nbsp;&nbsp;&nbsp; 备案号: <a target=_blank href="http://www.miitbeian.gov.cn/publish/query/indexFirst.action">冀ICP备14019838号</a> &nbsp;&nbsp;技术支持: 石家庄市藁城区绿境网络技术有限公司</div>
				<div style="padding-bottom:10px;"  class="foot_banner">客服电话:13932176996 客服QQ:826909082
<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=826909082&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:826909082:51" alt="点击这里给我发消息" title="点击这里给我发消息"/></a>
							QQ群:344742767
<a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=7a7eccbb392ffdae289ce789a732279b7917e602706cee940fa2f61994808fce"><img border="0" src="http://pub.idqqimg.com/wpa/images/group.png" alt="" title=""></a>				
							<?php echo ($site_info["count_code"]); ?></div>		
			</div>	
</body>
</html>