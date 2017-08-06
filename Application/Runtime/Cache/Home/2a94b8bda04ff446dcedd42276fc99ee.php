<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo ($site_info["title"]); ?></title>
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

	<link rel="stylesheet" type="text/css" href="/Public/css/index.css">	
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
		<div class="header">
				<div class="header_logo">
					<a href="<?php echo ($site_info["area_url"]); ?>"><img alt="<?php echo ($site_info["web_name"]); ?>" src="/Public/img/logo/<?php echo ($site_info["area_id"]); ?>.png" width="121px" height="75px"></img></a>
				</div>
				<div class="header_search">
					<input id="searchValue"  name="searchValue" field='searchValue'   class="easyui-combobox" style="width:266px;height:36px;" 					
					data-options="  prompt:'房源编号、手机号、小区名或拼音',
								    loader: myloader,
									mode: 'remote',
									valueField: 'id',
									textField: 'text',
									formatter: formatItem,
									panelWidth: 350,
									panelHeight:'auto',">	
					</input>
					<a href="javascript:void(0)" class="easyui-linkbutton search_button" onclick="searchHouse()">查 找</a>
					<a target=_blank style="" href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/mapHouse.html" class="easyui-linkbutton">地图找房</a>						
			</div>
		</div>
		<div class="nav">
			<ul>
					<li ><a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>">首  页</a></li>
					<li ><a onclick='$("html,body").animate({scrollTop: $(".main_box").offset().top}, 1000);$("#index_tabs").tabs("select","&nbsp;买 &nbsp; 房");'>买 房</a></li>
					<li ><a onclick='$("html,body").animate({scrollTop: $(".main_box").offset().top}, 1000);$("#index_tabs").tabs("select","&nbsp;租 &nbsp; 房");'>租 房</a></li>
					<li ><a onclick='$("html,body").animate({scrollTop: $(".main_box").offset().top}, 1000);$("#index_tabs").tabs("select","门市/厂房");'>门市/厂房</a></li>
					<li ><a onclick='$("html,body").animate({scrollTop: $(".main_box").offset().top}, 1000);$("#index_tabs").tabs("select","车库/车位");'>车库/车位</a></li>
					<li><a target=_blank href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/mapHouse.html">地图找房</a></li>
			</ul>
		</div>
		<div class="login_box"  style="">
			<div class="user_login" style="" >
			<?php if(($user_info["password"]) == ""): ?><div  class="yuan_login_button" style="height:78px;  background-color:#45A21C; ">
					<div style="padding:10px 0 16px 6px; height:26px;" onclick="location.href='http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/register.html'">中介登陆</div>
					<div style="font-size:13px;text-align:right;"><a target=_blank id="advantage" href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/news/id/14.html" style="color:white;">了解加后有何优势!</a></div>
				</div>
				<div  class="yuan_login_button" style="height:38px; margin-top:3px; background-color:#DA5E43; ">
					<div style="padding:10px 0 0 6px;  line-height:16px; "><a class="my_button" href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/personAddHouse.html">个人发布</a></div>
				</div>
			<?php else: ?>
				<div style="font-size:16px;margin:10px auto;"><?php echo ($user_info["company_name"]); ?></div>
				<a style="height:36px;"  href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/u/manage" class="easyui-linkbutton" >进入后台管理</a>
				<a style="height:36px;"  href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/u/logOff" class="easyui-linkbutton" >退 出</a><?php endif; ?>
			</div>
			<div class="brand">
					<div class="user_ad">
					    <a href="#">
							<div class="user_ad_title">惠民房产</div>
							<div class="user_ad_tel">电话:13315199113</div>
						</a>
					</div>
					<div class="user_ad">
						<a target=_blank href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/a/25">
							<div class="user_ad_title">万通中介</div>
							<div class="user_ad_tel">电话:13931991358</div>
						</a>
					</div>
					<div class="user_ad">
					    <a target=_blank href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/a/26">
							<div class="user_ad_title">常安中介</div>
							<div class="user_ad_tel">电话:15931114687</div>
						</a>
					</div>
					
					<div class="user_ad">
						<div class="user_ad_title">寻求合作</div>
						<div class="user_ad_tel">电话:13932176996</div>
					</div>
						<!--<?php echo ($site_info["famouse_user"]); ?>-->		
			</div>
		</div>
		<div class="main_box">		
<div style="clear:both;"></div>
			 <div id="index_tabs" class="easyui-tabs info_tabs"  data-options="tabPosition:'top',tabHeight:'36'">
					 <div title="&nbsp;买 &nbsp; 房" style="padding:10px;">
							<ul>
								<?php if(is_array($sellHouse)): foreach($sellHouse as $key=>$s): ?><li class="info_li">
									<a target=_blank href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/house/detail/id/<?php echo ($s["id"]); ?>.html">
										<?php if(($s["hurry_to_time"]) > "1"): ?><span style="color:red;" class="info_tabs_title"><?php echo ($s["title"]); ?><span class="lab lab_hurry">急</span><span class="lab lab_top">顶</span></span>
										<?php else: ?> 
											<span class="info_tabs_title"><?php echo ($s["title"]); ?><span class="lab lab_top">顶</span></span><?php endif; ?>
										<span class="info_tabs_zone"><?php echo ($s["zone_name"]); ?></span> <span class="info_tabs_size"><?php echo ($s["size"]); ?>平</span> <span class="info_tabs_price"><?php echo ($s["price"]); ?></span> <span class="info_tabs_date"><?php echo ($s["create_time"]); ?></span>	
									</a>
									</li><?php endforeach; endif; ?>
							</ul>
							<ul id="moreHousesList0"></ul>
							<div onClick="getMoreHouseList()" class="loadingmore" id="moreresults0">下一页</div>
					 </div>
					 <div title="&nbsp;租 &nbsp; 房" style="padding:10px">
							<ul>
								<?php if(is_array($rentHouse)): foreach($rentHouse as $key=>$s): ?><li class="info_li">
									<a target=_blank href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/house/detail/id/<?php echo ($s["id"]); ?>.html">
										<?php if(($s["hurry_to_time"]) > "1"): ?><span style="color:red;" class="info_tabs_title"><?php echo ($s["title"]); ?><span class="lab lab_hurry">急</span><span class="lab lab_top">顶</span></span>
										<?php else: ?> 
											<span class="info_tabs_title"><?php echo ($s["title"]); ?><span class="lab lab_top">顶</span></span><?php endif; ?>
										<span class="info_tabs_zone"><?php echo ($s["zone_name"]); ?></span> <span class="info_tabs_size"><?php echo ($s["size"]); ?>平</span> <span class="info_tabs_price"><?php echo ($s["price"]); ?></span> <span class="info_tabs_date"><?php echo ($s["create_time"]); ?></span>	
									</a>
									</li><?php endforeach; endif; ?>
							</ul>
							<ul id="moreHousesList1"></ul>
							<div onclick="getMoreHouseList();" class="loadingmore" id="moreresults1">下一页</div>
					 </div>
					 <div title="门市/厂房" style="padding:10px">
					    <ul>
							<?php if(is_array($shopHouse)): foreach($shopHouse as $key=>$s): ?><li class="info_li">
								<a target=_blank href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/house/detail/id/<?php echo ($s["id"]); ?>.html">
									<?php if(($s["hurry_to_time"]) > "1"): ?><span style="color:red;" class="info_tabs_title"><?php echo ($s["title"]); ?><span class="lab lab_hurry">急</span><span class="lab lab_top">顶</span></span>
									<?php else: ?> 
										<span class="info_tabs_title"><?php echo ($s["title"]); ?><span class="lab lab_top">顶</span></span><?php endif; ?>
									<span class="info_tabs_zone"><?php echo ($s["zone_name"]); ?></span> <span class="info_tabs_size"><?php echo ($s["size"]); ?>平</span> <span class="info_tabs_price"><?php echo ($s["price"]); ?></span> <span class="info_tabs_date"><?php echo ($s["create_time"]); ?></span>	
								</a>
								</li><?php endforeach; endif; ?>
						</ul>
						<ul id="moreHousesList2"></ul>
						<div onclick="getMoreHouseList();" class="loadingmore" id="moreresults2">下一页</div>
					 </div>
					 <div title="车库/车位" style="padding:10px">
						<ul>
							<?php if(is_array($garageHouse)): foreach($garageHouse as $key=>$s): ?><li class="info_li">
								<a target=_blank href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/house/detail/id/<?php echo ($s["id"]); ?>.html">
									<?php if(($s["hurry_to_time"]) > "1"): ?><span style="color:red;" class="info_tabs_title"><?php echo ($s["title"]); ?><span class="lab lab_hurry">急</span><span class="lab lab_top">顶</span></span>
									<?php else: ?> 
										<span class="info_tabs_title"><?php echo ($s["title"]); ?><span class="lab lab_top">顶</span></span><?php endif; ?>
									<span class="info_tabs_zone"><?php echo ($s["zone_name"]); ?></span> <span class="info_tabs_size"><?php echo ($s["size"]); ?>平</span> <span class="info_tabs_price"><?php echo ($s["price"]); ?></span> <span class="info_tabs_date"><?php echo ($s["create_time"]); ?></span>	
								</a>
								</li><?php endforeach; endif; ?>
						</ul>
						<ul id="moreHousesList3"></ul>
						<div onclick="getMoreHouseList();" class="loadingmore" id="moreresults3">下一页</div>
					 </div>
					 
			 </div>
			 
			  <div class="ad_box_right">
				<span class="ad_box_title">广告位招商</span><br/>联系电话:13932176996
			 </div>
			 
			 <div class="ad_box_right" style="height:80px;" >
				<span class="ad_box_title">便民服务</span>
				<div style="text-align:left;margin:5px 5px;"><a target=_blank href="http://gcfang.cn/wz.html">*藁城违章摄像头一览</a></div>
				<div style="text-align:left;margin:5px 5px;"><a target=_blank href="http://gcfang.cn/index/news/id/21.html">*藁城公交路线图</a></div>
			 </div>

<div style="clear:both;"></div>
<div class="loading" id="loading">正加载更多房源信息~请耐心等待.......</div>
<div class="loading" id="nomoreresults">没有更多的房源信息了~</div>
		</div>
		<div class="friend_link_box">
			<b><a href="#">友情链接与合作伙伴:</a></b>
			<a target=_blank href="#">百度</a>
		</div>
		<div style="clear:both;"></div>
<div class="foot_box">
				<div class="foot_banner"><a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/about/id/9.html">关于我们</a> | <a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/about/id/10.html" style="color:red; font-weight: bold;">诚征合作</a> | <a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/about/id/11.html">用户协议</a> | <a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/about/id/12.html">版权声明</a> | <a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/about/id/13.html">联系我们</a> | <a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/sitemap.html">网站地图</a> | <a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/sitemap.xml">sitemap</a></div> 
				<div class="foot_banner"><?php echo ($site_info["web_name"]); ?>@版权所有&nbsp;&nbsp;&nbsp; 备案号: <a target=_blank href="http://www.miitbeian.gov.cn/publish/query/indexFirst.action">冀ICP备14019838号</a> &nbsp;&nbsp;技术支持: 石家庄市绿境网络技术有限公司</div>
				<div style="padding-bottom:10px;"  class="foot_banner"><?php echo ($site_info["connect_us"]); ?> <?php echo ($site_info["count_code"]); ?></div>		
</div>
<script>
 function getMoreHouseList(){ 
			var tab = $('#index_tabs').tabs('getSelected');
			var tabNo = $('#index_tabs').tabs('getTabIndex',tab); //index 0:出售 1:出租 2:门市/厂房 3:车库/车位
			$.ajax({ 
				url: "http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/getMoreHouseList", 
				type: 'POST',
				dataType: 'html',
				data: 'tabNo='+tabNo+'&&liNo='+$('#moreHousesList'+tabNo).children('li').size(),
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
function searchHouse(){
	var q = $("input[name='searchValue']").val() || '';
	if (q.length <= 0){return false;}
	$(".textbox-addon-right").css("width","18px");
	//alert($("input[name='searchValue']").val());
	var houseURL = 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/house/detail/id/';
			$.ajax({
					url: 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/house/searchHouse',
					type: 'POST',
					dataType: 'json',
					data: 'searchValue='+$("input[name='searchValue']").val(),
					success: function(data){
							$(".textbox-addon-right").css("width","0px");
							if(!data.success)$.messager.alert('提示',data.err,'error');
							if(data.houseid){location.href = houseURL+data.houseInfo.id;}
							if(data.telhouseone){location.href = houseURL+data.houseInfo[0].id;}
							if(data.telhouseduo){
//1.创建 tab 2.加载列表 3.下拉刷新
								if ($('#index_tabs').tabs('exists','搜索结果')){
									$('#index_tabs').tabs('select','搜索结果');
								} else {
									$('#index_tabs').tabs('add',{
										title:'搜索结果',
										href:'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/getMoreHouseList/indexSearchValue/'+$("input[name='searchValue']").val(),
										closable:false,
										extractor:function(data){
											data = $.fn.panel.defaults.extractor(data);
											var tmp = $('<div></div>').html(data);
											data = tmp.find('#content').html();
											tmp.remove();
											return data;
										}
									});
								}
								
							}
							if(data.user){
								 $.messager.confirm('搜索结果', '此号码属于 ['+data.houseInfo.company_name+' ],是否跳转到商家首页?', function(r){
									if (r){
										location.href = data.houseInfo.shop_url;
									}
								});
							}
							if(data.zonename){
								location.href = 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/house/zoneDetail/id/'+data.houseInfo.id+'.html';
								//alert(data.houseInfo.baidu_coordinate);
							}
							//alert(data.houseInfo.title);
					},
					error: function(){
							error.apply(this, arguments);
					}
			});		
}
//■■■■■■■■■■■■■■■■■■■■■■auto complete
var myloader = function(param,success,error){  
			var q = param.q || '';
			if (q.length <= 0){return false;}
			$(".textbox-addon-right").css("width","18px");
			$.ajax({
					url: 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/house/autoCompleteZone',
					dataType: 'jsonp',
					data: {
							featureClass: "P",
							style: "full",
							maxRows: 10,
							name_startsWith: q
					},
					success: function(data){
							$(".textbox-addon-right").css("width","0px");
							var items = $.map(data, function(item){
							return {
									id: item.text,
									text: item.text,
									address: item.address,
								};
							});
							success(items);
					},
					error: function(){
							error.apply(this, arguments);
					}
			});
	}
function formatItem(row){    //■■■■■■■■■■■■■■■■■■■■■■调整搜索结果下拉格式
			//var s = '<span class="autoCompleteList">' + row.text + '</span>' ;
			var s = '<span style="font-weight:bold;font-size:16px;">' + row.text + '</span><br/>' +
                    '<span style="color:#888">' + row.address + '</span>';
			return s;
}
</script>
<script type="text/javascript" src="/Public/js/index.js"></script>
</body>
</html>