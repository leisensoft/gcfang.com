<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo ($site_info["title"]); ?></title>
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

<link href="/Public/js/editor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
<script type="text/javascript" charset="utf-8" src="/Public/js/editor/umeditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/js/editor/umeditor.min.js"></script>
<script type="text/javascript" src="/Public/js/editor/lang/zh-cn/zh-cn.js"></script>
</head>	
<style>
.yuan_logo_button { 
font-size:26px;
font-weight:bold;
color:white; 
border: 2px solid #C0C0C0; 
-moz-border-radius: 10px; 
-webkit-border-radius: 10px; 
border-radius: 10px; 
position:relative; 
padding:5px; 
background:#FFF; 
z-index:2; 
behavior: url(iecss3.htc); 
width:120px;
height:40px;
margin: 3px 0 0 10px;
background-color:#45A21C;
cursor:pointer;
float:left;
}
.yuan_logo_button a{color:#FFF;}
.yuan_logo_button a:hover{color:#333;}
.yuan_logo_button:hover{border:2px solid black;color:black;}
.menu_title{
    padding-left: 25px;
    font-size: 18px;
    background-color: #DFDFDF;	
    line-height: 36px;
    height: 40px;
	width:102px;
    color: #999;
	font-weight:bold;
	float:left;
}
.menu_sub{
	padding-left: 30px;
    font-size: 16px;
    background-color: #F0F0F0;
    line-height: 36px;
    height: 36px;
	width:97px;
    color: #999;
	float:left;
}
.menu_sub a{color:#999;}
.menu_sub a:hover{color: #000;}
.menu_sub:hover{background-color: white;}
.tabs-title{font-size:18px;}
li {display: inline-block;}
li {margin: 3px 0;}
input.labelauty + label { font: 18px "Microsoft Yahei";}
/*.combo-arrow{background:transparent url("") no-repeat scroll center center;}*/
.autoCompleteList{
		font-size:18px;
		font-weight:blod;
		color:#45A21C;
}
.autoCompleteList:hover{cursor:pointer;color:#DA5E43;font-size:20px;}
.my_input{font-size:18px;margin:15px 0 0 20px;}
.dowebok {font-size:18px;margin: 15px 0px 0px 20px;}
.news_title{font-size:14px;font-weight:bold;width:166px;display:block;float:left;}
.news_data{font-size:14px;color:grey;}
.news_title:hover{color:red;cursor:pointer;}
</style>
<body class="easyui-layout">
    <div data-options="region:'north'" style="height:60px;">
		 <div style="width:140px;height" class="yuan_logo_button" >
			<div style="margin:10px 0 0 5px;"><a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>" target=_blank><?php echo ($site_info["web_name"]); ?></a></div>
		 </div>
		 <div style="background-color:#DA5E43;" class="yuan_logo_button" >
			<div style="margin:10px 0 0 5px;"><a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/a/<?php echo ($user_info["id"]); ?>" target=_blank>商家首页</a>
			</div>
		 </div>
		 <div style="float:left;line-height:50px; margin:13px 10px;font-size:16px;"><?php echo ($site_info["connect_us"]); ?></div>
	</div>
    <div data-options="region:'west',title:'菜 单',collapsible:false" style="width:129px;">
		 <div style="margin:0 auto;padding:1px;" class="yuan_logo_button">
				<div style="margin:10px 0 0 5px;" onclick="open1('房源管理','http://<?php echo ($_SERVER['SERVER_NAME']); ?>/u/houseList');">房源管理</div>
		 </div>
		 <div style="background-color:#DA5E43;margin:2px auto;padding:1px;" class="yuan_logo_button">
				<div style="margin:10px 0 0 5px;" onclick="open1('发布房源','http://<?php echo ($_SERVER['SERVER_NAME']); ?>/u/addHouse')">发布房源</div>
		 </div>
		 <div class="menu_title">增值服务</div>
		 <div class="menu_sub"><a onclick="open1('消费查询','http://<?php echo ($_SERVER['SERVER_NAME']); ?>/u/dealInfo')" href="#">消费查询</a></div>
		 <div class="menu_sub"><a onclick="open1('置顶加急','http://<?php echo ($_SERVER['SERVER_NAME']); ?>/u/moneyTag')" href="#">置顶加急</a></div>
		 <div class="menu_sub"><a onclick="open1('专属网址','http://<?php echo ($_SERVER['SERVER_NAME']); ?>/u/owenUrl')" href="#">专属网址</a></div>
		 <div class="menu_sub"><a onclick="open1('电脑维修','http://<?php echo ($_SERVER['SERVER_NAME']); ?>/u/fixComputer')" href="#">电脑维修</a></div>
		 <div class="menu_title">设置</div>
		 <div class="menu_sub"><a onclick="open1('专属主页','http://<?php echo ($_SERVER['SERVER_NAME']); ?>/u/ownPage')" href="#">专属主页</a></div>
		 <div class="menu_sub"><a onclick="open1('商家信息','http://<?php echo ($_SERVER['SERVER_NAME']); ?>/u/userInfo');" href="#">商家信息</a></div>
		 <div class="menu_sub"><a href="#" onclick="changePass()">修改密码</a></div>
		 <div class="menu_sub"><a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/u/logOff">安全退出</a></div>
	</div>
	<div data-options="region:'center',title:''" style="padding:5px;background:#eee;">
		<div id="tt" class="easyui-tabs" data-options="tabWidth:136" style="width:99%;height:auto">
				<div title="主 页" style="padding:10px">
						<div style="font-size:16px;width:440px;float:left;">
							<div style="margin:20px 20px;">
									通知：
							</div>	
							<ul style="">
								<?php if(is_array($outNew)): foreach($outNew as $key=>$s): ?><li><a target=_blank href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/news/id/<?php echo ($s["id"]); ?>"><span class="news_title"><?php echo ($s["title"]); ?></span><span class="news_data"><?php echo ($s["time"]); ?></span></a></li><?php endforeach; endif; ?>
							</ul>
						</div>
						<div style="width:290px;float:left;">
							<iframe allowtransparency="true" frameborder="0" width="290" height="96" scrolling="no" src="http://tianqi.2345.com/plugin/widget/index.htm?s=1&z=1&t=0&v=0&d=2&bd=0&k=&f=&q=1&e=1&a=1&c=54511&w=290&h=96&align=center"></iframe>
							<div class="easyui-calendar" onclick="window.open('http://tools.2345.com/rili.htm');" style="width:290px;height:250px;"></div>
						</div>
				</div>		
		</div>
	</div>
<script>
//■■■■■■■■■■■■■■■■■■■■■■修改密码
function changePass(){
			$.messager.prompt('修改密码', '请输入新密码', function(r){
				if (r!=''&&r){
							$.post('http://<?php echo ($_SERVER['SERVER_NAME']); ?>/u/changePass',{r:r},function(result){
								if (result.success){
									 $.messager.alert('修改密码成功','新密码为: '+r+' 请牢记!');
								} else {
									$.messager.show({title: '修改密码失败',msg: result.errorMsg});
								}
							},'json');
				}else{
					 $.messager.alert('输入错误','不能为空','error');
				}
			});
}	
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
			}
		});
	});
	function open1(plugin,myhref){
		if ($('#tt').tabs('exists',plugin)){
			$('#tt').tabs('select', plugin);
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