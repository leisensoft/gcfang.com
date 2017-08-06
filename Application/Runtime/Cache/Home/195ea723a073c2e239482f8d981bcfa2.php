<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo ($zone_info["name"]); ?> - <?php echo ($site_info["title"]); ?></title>
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
		<script type="text/javascript" src="/Public/js/scrolltopcontrol.js"></script>
<style>
/*小区信息*/
.info_box div{float:left;height:200px;padding-top:10px;}
.info_box {border:1px solid #ccc;width:980px;height:100%;float:left;margin-top:10px;}
.house_type{width:80px;display:inline-block;text-align:left;padding-left:10px;line-height:30px;font-size:18px;}
.house_sell{width:50px;display:inline-block;}
.house_sell_title{width:50px;display:inline-block;font-weight:bold;}
/*信息列表*/
.info_li span{margin-top:0px;}
.info_tabs{width:770px;float:left;min-height:500px;}
.info_tabs ul li{height:30px;margin-top:0px;padding-top:0px; cursor:pointer;font: 14px/1.5 Tahoma,"Microsoft Yahei","Simsun";border-bottom: 1px solid #CDCDCD;border-radius: 15px;}
.info_tabs ul li:hover{background-color:#D0D5DB;}
.info_tabs ul li span{display:-moz-inline-box;display:inline-block;-moz-inline-box;display:inline-block;}
.info_tabs_zone{color:#45A21C;margin-left:3px;width:90px;}
.info_tabs_price{color:#DA5E43;margin-left:5px;width:66px;}
.info_tabs_size{color:grey;margin-left:5px;width:66px;}
.info_tabs_date{color:grey;margin-left:3px;width:62px;font-size:15px;}
.info_tabs_title{margin:0 5px 0 10px;height:22px;width:486px;display:font-size:14px;overflow:hidden;}

.house_page{background-color:#45A21C;color:white;font-size:16px;border-radius:5px;text-align:center;margin:10px 290px;}
/*加载更多*/
.loading {float:left;background:#DA5E43;color:white;font-size:20px;padding:5px 10px;text-align:center;width:700px;margin:0px auto;display:none;border-radius: 5px;}
.loadingmore {float:left;background:#DA5E43;color:white;font-size:20px;padding:5px 10px;text-align:center;width:728px;margin:0px auto;display:block;border-radius: 15px;cursor:pointer;}
.loadingmore:hover { border:1px solid grey;color:black;}
/*右侧广告*/
.ad_box_right{width:200px;height:85px;float:right;border:1px solid #ccc;}
</style>
		<div class="common_box" >
				<div class="info_box">
				    <div style="width:280px;text-align:center;border-right:1px solid #ccc;;">
						<div style="width:280px;height:40px;font-size:28px;line-height:0px;"><?php echo ($zone_info["name"]); ?></div>
						<div style="margin-left:40px;">
							<ul>
								<li><span class="house_type"> </span><span class="house_sell_title">出售</span><span class="house_sell_title">出租</span></li>
								<li><span class="house_type">二手房</span><span class="house_sell"><?php echo ($countSellHouse); ?></span><span class="house_sell"><?php echo ($countRentHouse); ?></span></li>
								<li><span class="house_type">车库/位</span><span class="house_sell"><?php echo ($countSellGarage); ?></span><span class="house_sell"><?php echo ($countRentGarage); ?></span></li>
								<li><span class="house_type">门市</span><span class="house_sell"><?php echo ($countSellShop); ?></span><span class="house_sell"><?php echo ($countRentShop); ?></span></li>
								<li></li>
							</ul>
						</div>
				    </div>
				  
				    <div style="width:400px;font-size:14px;text-align:left;border-right:1px solid #ccc;">简介:暂无</div>

				    <div style="width:290px;">图片暂无</div>
				</div>
		


				<div id="index_tabs" class="easyui-tabs info_tabs"  data-options="plain:true,tabPosition:'top',tabHeight:'36'">
					 <div title="&nbsp;买 &nbsp; 房" style="padding:10px;">
							<ul>
								<?php if(is_array($sellHouse)): foreach($sellHouse as $key=>$s): ?><li class="info_li">
										<?php if(($s["hurry_to_time"]) > "1"): ?><span style="color:red;" class="info_tabs_title"><?php echo ($s["title"]); ?><span class="lab lab_hurry">急</span><span class="lab lab_top">顶</span></span>
										<?php else: ?> 
											<span class="info_tabs_title"><?php echo ($s["title"]); ?><span class="lab lab_top">顶</span></span><?php endif; ?>
										<span class="info_tabs_size"><?php echo ($s["size"]); ?>平</span> <span class="info_tabs_price"><?php echo ($s["price"]); ?></span> <span class="info_tabs_date"><?php echo ($s["create_time"]); ?></span>	
									</li><?php endforeach; endif; ?>
							</ul>
							<ul id="moreHousesList0"></ul>
							<div onClick="getMoreHouseLise()" class="loadingmore" id="moreresults0">下一页</div>
					 </div>
					 <div title="&nbsp;租 &nbsp; 房" style="padding:10px">
							<ul>
								<?php if(is_array($rentHouse)): foreach($rentHouse as $key=>$s): ?><li class="info_li">
										<?php if(($s["hurry_to_time"]) > "1"): ?><span style="color:red;" class="info_tabs_title"><?php echo ($s["title"]); ?><span class="lab lab_hurry">急</span><span class="lab lab_top">顶</span></span>
										<?php else: ?> 
											<span class="info_tabs_title"><?php echo ($s["title"]); ?><span class="lab lab_top">顶</span></span><?php endif; ?>
										<span class="info_tabs_size"><?php echo ($s["size"]); ?>平</span> <span class="info_tabs_price"><?php echo ($s["price"]); ?></span> <span class="info_tabs_date"><?php echo ($s["create_time"]); ?></span>	
									</li><?php endforeach; endif; ?>
							</ul>
							<ul id="moreHousesList1"></ul>
							<div onclick="getMoreHouseLise();" class="loadingmore" id="moreresults1">下一页</div>
					 </div>
					 <div title="门市/厂房" style="padding:10px">
					    <ul>
							<?php if(is_array($shopHouse)): foreach($shopHouse as $key=>$s): ?><li class="info_li">
									<?php if(($s["hurry_to_time"]) > "1"): ?><span style="color:red;" class="info_tabs_title"><?php echo ($s["title"]); ?><span class="lab lab_hurry">急</span><span class="lab lab_top">顶</span></span>
									<?php else: ?> 
										<span class="info_tabs_title"><?php echo ($s["title"]); ?><span class="lab lab_top">顶</span></span><?php endif; ?>
									<span class="info_tabs_size"><?php echo ($s["size"]); ?>平</span> <span class="info_tabs_price"><?php echo ($s["price"]); ?></span> <span class="info_tabs_date"><?php echo ($s["create_time"]); ?></span>	
								</li><?php endforeach; endif; ?>
						</ul>
						<ul id="moreHousesList2"></ul>
						<div onclick="getMoreHouseLise();" class="loadingmore" id="moreresults2">下一页</div>
					 </div>
					 <div title="车库/车位" style="padding:10px">
						<ul>
							<?php if(is_array($garageHouse)): foreach($garageHouse as $key=>$s): ?><li class="info_li">
									<?php if(($s["hurry_to_time"]) > "1"): ?><span style="color:red;" class="info_tabs_title"><?php echo ($s["title"]); ?><span class="lab lab_hurry">急</span><span class="lab lab_top">顶</span></span>
									<?php else: ?> 
										<span class="info_tabs_title"><?php echo ($s["title"]); ?><span class="lab lab_top">顶</span></span><?php endif; ?>
									<span class="info_tabs_size"><?php echo ($s["size"]); ?>平</span> <span class="info_tabs_price"><?php echo ($s["price"]); ?></span> <span class="info_tabs_date"><?php echo ($s["create_time"]); ?></span>	
								</li><?php endforeach; endif; ?>
						</ul>
						<ul id="moreHousesList3"></ul>
						<div onclick="getMoreHouseLise();" class="loadingmore" id="moreresults3">下一页</div>
					 </div>
				</div>		
				<div class="ad_box_right">
				广告位招商
				</div>
				
				<div class="loading" id="loading">正加载更多房源信息~请耐心等待.......</div>
				<div class="loading" id="nomoreresults">没有更多的房源信息了~</div>
		</div>
		<div style="clear:both;"></div>
<div class="foot_box">
				<div class="foot_banner"><a href="<!--<?php echo ($cfg["url"]); ?>-->about/about.php">关于我们</a> | <a href="<!--<?php echo ($cfg["url"]); ?>-->about/talented.php" style="color:red; font-weight: bold;">诚征合作</a> | <a href="<!--<?php echo ($cfg["url"]); ?>-->about/agreement.php">用户协议</a> | <a href="<!--<?php echo ($cfg["url"]); ?>-->about/copyright.php">版权声明</a> | <a href="<!--<?php echo ($cfg["url"]); ?>-->about/contact.php">联系我们</a></div> 
				<div class="foot_banner"><?php echo ($site_info["web_name"]); ?>@版权所有&nbsp;&nbsp;&nbsp; 备案号: <a target=_blank href="http://www.miitbeian.gov.cn/publish/query/indexFirst.action">冀ICP备14019838号</a> &nbsp;&nbsp;技术支持: 石家庄市绿境网络技术有限公司</div>
				<div style="padding-bottom:10px;"  class="foot_banner"><?php echo ($site_info["connect_us"]); ?></div>		
</div>
</body>
<script>
function getMoreHouseLise(){ 
			var tab = $('#index_tabs').tabs('getSelected');
			var tabNo = $('#index_tabs').tabs('getTabIndex',tab); //index 0:出售 1:出租 2:门市/厂房 3:车库/车位
			$.ajax({ 
				url: "http://<?php echo ($_SERVER['SERVER_NAME']); ?>/house/getMoreHouseLise", 
				type: 'POST',
				dataType: 'html',
				data: 'tabNo='+tabNo+'&&liNo='+$('#moreHousesList'+tabNo).children('li').size()+'&&zone_id=<?php echo ($zone_info["id"]); ?>',
				beforeSend: function(){
					 $('#loading').fadeIn();	
				},
				success: function(data){
					if(data){
						$('#moreHousesList'+tabNo).append(data);
						$('#loading').fadeOut();
					}else{
						$('#moreresults'+tabNo).fadeOut();
						$('#loading').fadeOut();
						$('#nomoreresults').fadeIn();
					} 
				},
				error:function(){ alert('ajax error'); },
			});
}	
$('#index_tabs').tabs({
        onSelect: function () {
			getMoreHouseLise();
        }
});
$(document).ready(function() {
	$(window).scroll(function() {
		//if ($(document).scrollTop()<=0){alert("滚动条已经到达顶部为0");}
		if ($(document).scrollTop() >= $(document).height() - $(window).height() ) {
			getMoreHouseLise();
		}
	});
});	
</script>
</html>