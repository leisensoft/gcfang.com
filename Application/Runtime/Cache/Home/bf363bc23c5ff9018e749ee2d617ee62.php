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
	<div class="easyui-navpanel">
		<header>
			<div class="m-toolbar">
				<div class="m-title">藁城房-<?php echo ($zone["name"]); ?></div>
				<div class="m-left">
                    <a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/Mobile/" class="easyui-linkbutton m-back" data-options="plain:true,outline:true">首页</a>
                </div>
			</div>
		</header>
<div class="easyui-tabs" id="index_tabs" data-options="fit:true,border:false,tabWidth:80,tabHeight:35">
        <div title="出售(<?php echo ($countSellHouse); ?>)" style="padding:10px">
			<ul id="list" class="m-list">
				<li class="info_li">
				<?php if(is_array($sellHouse)): foreach($sellHouse as $key=>$s): ?><li class="info_li" id="top_<?php echo ($s["id"]); ?>" >
									    <a href="#" onclick="openDetail(<?php echo ($s["id"]); ?>,1);">
											<?php if(($s["hurry_to_time"]) > "1"): ?><div class="list-header" style="color:red;">[急售][置顶]<?php echo ($s["title"]); ?></div>
											<?php else: ?> 
												<div class="list-header">[置顶]<?php echo ($s["title"]); ?></div><?php endif; ?>
											<div class="list-content">房源编号:<?php echo ($s["id"]); ?> <?php echo ($s["zone_name"]); ?> <?php echo ($s["size"]); ?>平 <?php echo ($s["price"]); ?></div>
											<div class="list-content">联系人:<?php echo ($s["personal_name"]); ?> <?php echo ($s["create_time"]); ?></div>
									     </a>
									</li><?php endforeach; endif; ?>
			</ul>
			<ul class="m-list" id="moreHousesList0"></ul>
			<ul class="m-list">
					<li style="text-align:center" onClick="getMoreHouseList()" id="moreresults0">查看更多房源</li>
			</ul>
	   </div>
        <div title="出租(<?php echo ($countRentHouse); ?>)" style="padding:10px">
           <ul id="list" class="m-list">
				<li>
					<?php if(is_array($rentHouse)): foreach($rentHouse as $key=>$s): ?><li class="info_li" id="top_<?php echo ($s["id"]); ?>" >
									    <a href="#" onclick="openDetail(<?php echo ($s["id"]); ?>,1);">
										<?php if(($s["hurry_to_time"]) > "1"): ?><div class="list-header" style="color:red;">[急售][置顶]<?php echo ($s["title"]); ?></div>
										<?php else: ?> 
											<div class="list-header">[置顶]<?php echo ($s["title"]); ?></div><?php endif; ?>
										<div class="list-content">房源编号:<?php echo ($s["id"]); ?> <?php echo ($s["zone_name"]); ?> <?php echo ($s["size"]); ?>平 <?php echo ($s["price"]); ?></div>
										<div class="list-content">联系人:<?php echo ($s["personal_name"]); ?> <?php echo ($s["create_time"]); ?></div>
									</a>
									</li><?php endforeach; endif; ?>
				</li>
			</ul>
			<ul class="m-list" id="moreHousesList1"></ul>
			<ul class="m-list">
					<li style="text-align:center" onClick="getMoreHouseList()" id="moreresults1">查看更多房源</li>
			</ul>
		</div>
		 <div title="门市(<?php echo ($countShop); ?>)" style="padding:10px">
			<ul id="list" class="m-list">
				<li>
					<?php if(is_array($shopHouse)): foreach($shopHouse as $key=>$s): ?><li class="info_li" id="top_<?php echo ($s["id"]); ?>" >
									    <a href="#" onclick="openDetail(<?php echo ($s["id"]); ?>,1);">
										<?php if(($s["hurry_to_time"]) > "1"): ?><div class="list-header" style="color:red;">[急售][置顶]<?php echo ($s["title"]); ?></div>
										<?php else: ?> 
											<div class="list-header">[置顶]<?php echo ($s["title"]); ?></div><?php endif; ?>
										<div class="list-content">房源编号:<?php echo ($s["id"]); ?> <?php echo ($s["zone_name"]); ?> <?php echo ($s["size"]); ?>平 <?php echo ($s["price"]); ?></div>
										<div class="list-content">联系人:<?php echo ($s["personal_name"]); ?> <?php echo ($s["create_time"]); ?></div>
									</a>
									</li><?php endforeach; endif; ?>
				</li>
			</ul>
			<ul class="m-list" id="moreHousesList2"></ul>
			<ul class="m-list">
					<li style="text-align:center" onClick="getMoreHouseList()" id="moreresults2">查看更多房源</li>
			</ul>
		</div>
        <div title="车位(<?php echo ($countGarage); ?>)" style="padding:10px">
			 <ul id="list" class="m-list">
				<li>
					<?php if(is_array($garageHouse)): foreach($garageHouse as $key=>$s): ?><li class="info_li" id="top_<?php echo ($s["id"]); ?>" >
									    <a href="#" onclick="openDetail(<?php echo ($s["id"]); ?>,1);">
										<?php if(($s["hurry_to_time"]) > "1"): ?><div class="list-header" style="color:red;">[急售][置顶]<?php echo ($s["title"]); ?></div>
										<?php else: ?> 
											<div class="list-header">[置顶]<?php echo ($s["title"]); ?></div><?php endif; ?>
										<div class="list-content">房源编号:<?php echo ($s["id"]); ?> <?php echo ($s["zone_name"]); ?> <?php echo ($s["size"]); ?>平 <?php echo ($s["price"]); ?></div>
										<div class="list-content">联系人:<?php echo ($s["personal_name"]); ?> <?php echo ($s["create_time"]); ?></div>
									</a>
									</li><?php endforeach; endif; ?>
				</li>
			</ul>
			<ul class="m-list" id="moreHousesList3"></ul>
			<ul class="m-list">
					
					<li style="text-align:center" onClick="getMoreHouseList()" id="moreresults3">查看更多房源</li>
			</ul>
		</div>
    </div>
    <style scoped>
        p{
            line-height:150%;
        }
    </style> 	
		<div id="message_box" class="easyui-dialog" style="padding:20px 6px;width:80%;" data-options="inline:true,modal:true,closed:true,title:'联系我们'">
			<p>联系人：<?php echo ($user["person_name"]); ?></p>
			<p>电话：<?php echo ($user["tel"]); ?></p>
			<p>地址：<?php echo ($user["address"]); ?></p>
			<div class="dialog-button">
				<a href="javascript:void(0)" class="easyui-linkbutton" style="width:100%;height:35px" onclick="$('#message_box').dialog('close')">返 回</a>
			</div>
		</div>
		
	</div>
<script>
function openDetail(id,isTop){
	if(isTop){
			if($("#top_detail_"+id).length>0){ //如果已经打开就退出
				closeDetail(id,1);
				return;
			}
			$.ajax({ 
				url: "http://<?php echo ($_SERVER['SERVER_NAME']); ?>/Mobile/getHouseInfo", 
				type: 'POST',
				dataType: 'html',
				data: 'id='+id+'&&isTop=1',
				beforeSend: function(){
					 //$('#loading').fadeIn();	
				},
				success: function(data){
					$('#top_'+id).append(data);
					if(data){
						//$('#loading').fadeOut();
					}else{
						//$('#moreresults'+tabNo).fadeOut();
						//$('#loading').fadeOut();
						//$('#nomoreresults').fadeIn();
					} 
				},
				error:function(){ alert('ajax error'); },
			});
	}else{
			if($("#detail_"+id).length>0){
				closeDetail(id);
				return;
			}
			$.ajax({ 
				url: "http://<?php echo ($_SERVER['SERVER_NAME']); ?>/Mobile/getHouseInfo", 
				type: 'POST',
				dataType: 'html',
				data: 'id='+id,
				beforeSend: function(){
					 //$('#loading').fadeIn();	
				},
				success: function(data){
					$('#'+id).append(data);
					if(data){
						//$('#loading').fadeOut();
					}else{
						//$('#moreresults'+tabNo).fadeOut();
						//$('#loading').fadeOut();
						//$('#nomoreresults').fadeIn();
					} 
				},
				error:function(){ alert('ajax error'); },
			});
	}
}
function closeDetail(id,isTop){
	if(isTop){
		$("#top_detail_"+id).remove();
	}else{
		$("#detail_"+id).remove();
	}
	
}
/*监听tab*/
$('#index_tabs').tabs({
        onSelect: function () {
			getMoreHouseList();
        }
});
function getMoreHouseList(){ 
			var tab = $('#index_tabs').tabs('getSelected');
			var tabNo = $('#index_tabs').tabs('getTabIndex',tab); //index 0:出售 1:出租 2:门市/厂房 3:车库/车位
			$.ajax({ 
				url: "http://<?php echo ($_SERVER['SERVER_NAME']); ?>/Mobile/getMoreHouseList", 
				type: 'POST',
				dataType: 'html',
				data: 'tabNo='+tabNo+'&&liNo='+$('#moreHousesList'+tabNo).children('li').size()+'&&zone_id='+<?php echo ($zone["id"]); ?>,
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
</script>
</body>	
</html>