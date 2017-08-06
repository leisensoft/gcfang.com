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
<link href="/Public/js/editor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
<script type="text/javascript" charset="utf-8" src="/Public/js/editor/umeditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/js/editor/umeditor.min.js"></script>
<script type="text/javascript" src="/Public/js/editor/lang/zh-cn/zh-cn.js"></script>
<style>
li { display: inline-block;}
li { margin: 3px 0;}
input.labelauty + label { font: 18px "Microsoft Yahei";}
.autoCompleteList{font-size:18px;font-weight:blod;color:#45A21C;}
.autoCompleteList:hover{cursor:pointer;color:#DA5E43;font-size:20px;}
.my_input{font-size:18px;margin:15px 0 0 20px;}

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

/*搜索loading图片*/
.textbox-addon-right{width:0px;}
.combo-arrow {background: transparent url("../Public/icon/loading.gif") no-repeat scroll center center;}
</style>
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
			<div style="width:980px;height:100%;border:1px solid grey;margin-top:5px;">
				<div style="width:100%;height;35px;margin:10px auto;font-size:28px;text-align:center;">个人发布房源 </div>
				
			<form id="add_house_form" method="post" class="easyui-form" data-options="novalidate:true">
					<script type="text/javascript" src="/Public/js/jquery-labelauty.js"></script>
					<link rel="stylesheet" type="text/css" href="/Public/css/jquery-labelauty.css">	
				<div style="margin-left:50px;">
					<ul class="dowebok">
						<li><input type="radio" name="sell_type" field="sell_type" value="1" checked="checked" data-labelauty="出 售"></li>
						<li><input type="radio" name="sell_type" field="sell_type" value="2" data-labelauty="出 租"></li>
					</ul>
					<ul class="dowebok">
						<li><input type="radio" name="house_type" field="house_type" value="1" checked="checked" data-labelauty="二手房"></li>
						<li><input type="radio" name="house_type" field="house_type" value="2" data-labelauty="门市/厂房"></li>
						<li><input type="radio" name="house_type" field="house_type" value="3" data-labelauty="车库/车位"></li>
					</ul>
					<div class="my_input">
						标 题:
						<input style="width:305px;" class="easyui-textbox" type="text" id="title" field="title" name="title"  data-options="required:true"></input>
					</div>
					<div class="my_input">小区或街道名称:
						<input  name="zone_id" field='zone_id'   class="easyui-combobox" style="height:26px;width:220px;" data-options="
													loader: myloader,
													mode: 'remote',
													valueField: 'id',
													textField: 'text',
													formatter: formatItem,
													panelHeight:'auto',
													required:true,
													">	</input>
					</div>
					<div class="my_input">
						面 积:
						<input style="width:100px;" class="easyui-textbox" type="text" id="size" field="size" name="size"  data-options="required:true"></input>
						平方米
					</div>
					<div class="my_input">
						价 格:
						<input style="width:100px;" class="easyui-textbox" type="text" field="price" id="price" name="price" ></input>
						<span style="font-size:14px;">(价格面议请留空)</span>
					</div>
					<div class="my_input">
						<div sytle="margin-bottom:10px;">详细描述:<span style="font-size:14px;">(可自定义内容,也可从word直接粘贴文字)</span></div>
							<script type="text/plain" id="myEditor" style="width:686px;height:240px;">
									<p>我去</p>
							</script>
							<script type="text/javascript">
							//var um = UM.getEditor('myEditor');//实例化编辑器
								$(function() {          
								var um = UM.getEditor('myEditor', { 
									toolbar: ['bold forecolor image video'],   
								 UEDITOR_HOME_URL: "/Public/js/editor/",                
										 imageUrl: "<?php echo U('Home/Img/upload');?>",              
										imagePath: "/Public/upload/",    
										wordCount: false,               
								elementPathEnabled: false,            
								 autoFloatEnabled: false,         
										 textarea: 'content'            
										 });    
								}); 
							</script>
					</div>
					<div class="my_input">
						姓 名:
						<input style="width:180px;" class="easyui-textbox" type="text" field="personal_name" id="personal_name" name="personal_name" data-options="required:true" ></input>
						<span style="font-size:14px;"></span>
					</div>
					<div class="my_input">
						电 话:
						<input style="width:180px;" class="easyui-textbox" type="text" field="personal_tel" id="personal_tel" name="personal_tel" data-options="required:true" ></input>
						<span style="font-size:14px;"></span>
					</div>
					<div class="my_input">
						密 码:
						<input style="width:180px;" class="easyui-textbox" type="password" field="personal_pass" id="personal_pass" name="personal_pass" data-options="required:true" ></input>
						<span style="font-size:14px;">(删除房源信息时用)</span>
					</div>
					<div style="clear:both;"></div>
					<div style="margin-top:10px;background-color:#DA5E43;" class="yuan_logo_button" >
						<div id="submitButton" style="margin:10px 0 0 5px;" onclick="submitAddHouseForm();">确认发布</div>
					 </div>			
				</div>
			 </form>
				
				<div style="width:100%;height:100%;margin:30px auto;font-size:16px;">温馨提示: 1.房源信息会在6个月后自动失效</div>
			  
			</div>
	</div>
	<div style="clear:both;"></div>
<div class="foot_box">
				<div class="foot_banner"><a href="<!--<?php echo ($cfg["url"]); ?>-->about/about.php">关于我们</a> | <a href="<!--<?php echo ($cfg["url"]); ?>-->about/talented.php" style="color:red; font-weight: bold;">诚征合作</a> | <a href="<!--<?php echo ($cfg["url"]); ?>-->about/agreement.php">用户协议</a> | <a href="<!--<?php echo ($cfg["url"]); ?>-->about/copyright.php">版权声明</a> | <a href="<!--<?php echo ($cfg["url"]); ?>-->about/contact.php">联系我们</a></div> 
				<div class="foot_banner">[web_name]@版权所有&nbsp;&nbsp;&nbsp; 备案号: <a target=_blank href="http://www.miitbeian.gov.cn/publish/query/indexFirst.action">冀ICP备14019838号</a> &nbsp;&nbsp;技术支持: 石家庄市绿境网络技术有限公司</div>
				<div style="padding-bottom:10px;"  class="foot_banner">[connect_us]</div>		
</div>
<script>
 function submitAddHouseForm(){
		$.messager.progress();
		$('#add_house_form').form('submit',{
			url: 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/house/userAddHouse',
			onSubmit: function(){
				var isValid = $(this).form('enableValidation').form('validate');
				if (!isValid){
					$.messager.progress('close');	
				}
				return isValid;	// return false will stop the form submission	 
			},
			success: function(result){
					$.messager.progress('close');	
					var result = eval('('+result+')');
					if (result.errorMsg){
						$.messager.alert('问题提示',result.errorMsg,"error");
					} else {
						
						$('#add_house_form').form('reset'); 
						//$("#sell_type").attr("checked","checked");
						$.messager.confirm('添加房源成功','要查看发布的房源信息吗?',function(r){
							if (r){
								location.href = 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/house/detail/id/'+result.house_id+'.html';
							}else{
								location.href = 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>';
							}
						});
					}
			}
		});
	}

var myloader = function(param,success,error){  
		var q = param.q || '';
		if (q.length <= 0){return false}
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
						var items = $.map(data, function(item){
						return {
								id: item.id,
								text: item.text,
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
			var s = '<span class="autoCompleteList">' + row.text + '</span>' ;
			return s;
}
$(function(){$(':input').labelauty();});
</script>
	
</body>
</html>