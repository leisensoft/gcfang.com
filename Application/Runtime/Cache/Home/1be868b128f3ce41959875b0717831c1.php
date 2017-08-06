<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
	<meta name="keywords" content="[keywords]" />
	<meta name="description" content="[description]" />
	<meta baidu-gxt-verify-token="5b60a5f5fc32f289bdae383702e80828">
	<link rel="stylesheet" type="text/css" href="/Public/css/easyUI/easyui.css">
    <link rel="stylesheet" type="text/css" href="/Public/css/easyUI/icon.css">
    <link rel="stylesheet" type="text/css" href="/Public/css/easyUI/color.css">
    <script type="text/javascript" src="/Public/js/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/js/jquery.easyui.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/Public/css/reset.css">
	<link rel="stylesheet" type="text/css" href="/Public/css/common.css">

<script type="text/javascript" src="/Public/js/prettify.js"></script>
<link href="/Public/js/editor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
<script type="text/javascript" charset="utf-8" src="/Public/js/editor/umeditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/js/editor/umeditor.min.js"></script>
<script type="text/javascript" src="/Public/js/editor/lang/zh-cn/zh-cn.js"></script>
<style>
.pln{color:#000}@media screen{.str{color:#080}.kwd{color:#008}.com{color:#800}.typ{color:#606}.lit{color:#066}.pun,.opn,.clo{color:#660}.tag{color:#008}.atn{color:#606}.atv{color:#080}.dec,.var{color:#606}.fun{color:red}}@media print,projection{.str{color:#060}.kwd{color:#006;font-weight:bold}.com{color:#600;font-style:italic}.typ{color:#404;font-weight:bold}.lit{color:#044}.pun,.opn,.clo{color:#440}.tag{color:#006;font-weight:bold}.atn{color:#404}.atv{color:#060}}pre.prettyprint{padding:2px;border:1px solid #888}ol.linenums{margin-top:0;margin-bottom:0}li.L0,li.L1,li.L2,li.L3,li.L5,li.L6,li.L7,li.L8{list-style-type:none}li.L1,li.L3,li.L5,li.L7,li.L9{background:#eee}
pre.prettyprint{
	border-color:#D1D7DC;
}
ol.linenums li{
	list-style-type:decimal;
	background:#fff;
	color:#2B91AF;
	line-height:18px;
	border-left:1px solid #D1D7DC;
	margin-left:5px;
	padding-left:10px;
}
</style>
</head>	
<body>

 <body class="easyui-layout">
    <div data-options="region:'north'" style="height:60px;">
		 <div class="" style="font-size:16px;margin:10px 0 0 30px;">
				<?php if(is_array($all_sites)): foreach($all_sites as $key=>$vo): ?><a href="<?php echo ($vo); ?>" target=_blank><?php echo ($key); ?></a>&nbsp;<?php endforeach; endif; ?>
		 </div>
	</div>
    <div data-options="region:'west',title:'菜 单',collapsible:false" style="width:166px;">
	
			<div class="easyui-panel" style="padding:5px">
				<ul class="easyui-tree">
					 <li>
						<span>房产信息管理</span>
							 <ul>
									<li><span><div onclick="open1('房源','http://<?php echo ($_SERVER['SERVER_NAME']); ?>/benben/housesInfo')">房源</div></span></li>
									<li><span><div onclick="open1('用户','http://<?php echo ($_SERVER['SERVER_NAME']); ?>/benben/usersInfo')">用户</div></span></li>
									<li><span><div onclick="open1('小区','http://<?php echo ($_SERVER['SERVER_NAME']); ?>/benben/zoneInfo')">小区</div></span></li>
							 </ul>
					 </li>
					 <li>
						<span>文章管理</span>
							 <ul>
								<li><span><div onclick="open1('文章','http://<?php echo ($_SERVER['SERVER_NAME']); ?>/benben/articlesInfo')">文章</div></span></li>
							</ul>
					 </li>
					 <li>
						<span>财务管理</span>
							<ul>
								<li><span><div onclick="open1('充值','http://<?php echo ($_SERVER['SERVER_NAME']); ?>/benben/rechargeInfo')">充值</div></span></li>
								<li><span><div onclick="open1('消费查询','http://<?php echo ($_SERVER['SERVER_NAME']); ?>/benben/dealInfo')">消费</div></span></li>
							</ul>
					 </li>
					 <li>
						<span>网站信息管理</span>
							<ul>
								<li><span><div onclick="open1('多站点','http://<?php echo ($_SERVER['SERVER_NAME']); ?>/benben/sitesInfo')">多站点</div></span></li>
								<li><span>广告位</span></li>
								<li><span>修改密码</span></li>
							</ul>
					 </li>
				</ul>
			</div>
	
	
	</div>
    <div data-options="region:'center',title:''" style="padding:5px;background:#eee;">
			<div id="tt" class="easyui-tabs" data-options="tabWidth:136" style="width:99%;height:auto">
						<div title="主 页" style="padding:10px">
									
						
						
						
						
						</div>
			</div>
	</div>
<script>	
	//tab code
	
	$(function(){
		$('#tt').tabs({
		    border:false,
			onLoad:function(panel){
				var plugin = panel.panel('options').title;
				panel.find('textarea[name="code-'+plugin+'"]').each(function(){
					var data = $(this).val();
					data = data.replace(/(\r\n|\r|\n)/g, '\n');
					if (data.indexOf('\t') == 0){
						data = data.replace(/^\t/, '');
						data = data.replace(/\n\t/g, '\n');
					}
					data = data.replace(/\t/g, '    ');
					var pre = $('<pre name="code" class="prettyprint linenums"></pre>').insertAfter(this);
					pre.text(data);
					$(this).remove();
				});
				prettyPrint();
			}
		});
	}); 
	function open1(plugin,myhref){
		if ($('#tt').tabs('exists',plugin)){
			$('#tt').tabs('select',plugin);
		} else {
			$('#tt').tabs('add',{
				title:plugin,
				href:myhref,
				closable:true,
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
</script>
</body>
<html>