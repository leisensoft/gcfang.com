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
<link rel="stylesheet" type="text/css" href="/Public/css/personAddHouse.css">	
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
	<div class="common_box" >
			<div style="width:980px;height:100%;border:1px solid grey;margin-top:5px;">
				<div style="width:100%;height;35px;margin:10px auto;font-size:28px;text-align:center;">个人发布房源 </div>
				
						<div style="color:grey;width:100%;text-align:center;font-size:16px;">
							<br/>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:red;font-weight:bold;">重要提示：本站采用最新网页技术开发，需使用IE8或更高版本浏览器（如有问题可联系客服代发信息）</span>。
							<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;推荐使用：
							<a href="http://jifendownload.2345.cn/jifen_2345/2345explorer_k39547990.exe">2345王牌浏览器 点击下载</a>
						</div>
				
			<form id="add_house_form" method="post" class="easyui-form" data-options="novalidate:true">				
				<div style="margin-left:50px;">
					<ul class="dowebok">
						<li><input type="radio" name="sell_type" field="sell_type" value="1" checked="checked" >出 售</li>&nbsp;&nbsp;&nbsp;
						<li><input type="radio" name="sell_type" field="sell_type" value="2" >出 租</li>
					</ul>
					<ul class="dowebok">
						<li><input type="radio" name="house_type" field="house_type" value="1" checked="checked">二手房</li>&nbsp;&nbsp;&nbsp;
						<li><input type="radio" name="house_type" field="house_type" value="2" >门市/厂房</li>&nbsp;&nbsp;&nbsp;
						<li><input type="radio" name="house_type" field="house_type" value="3" >车库/车位</li>
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
													<p>&nbsp;房屋户型：室 厅 卫</p> 
													<p>&nbsp;所在楼层：楼</p> 
													<p>&nbsp;房屋概况：</p> 
													<p>&nbsp;其他：</p>
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
						<input style="width:180px;" class="easyui-textbox" type="text" field="personal_tel" id="personal_tel" name="personal_tel" data-options="required:true,validType:['length[8,11]'],invalidMessage:'请输入8位座机号或11位的手机号码'" ></input>
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
				<div style="width:100%;height:100%;margin:30px auto;font-size:16px;">温馨提示: 房源信息会在6个月后自动失效,您也可以在房产信息页面输入密码删除信息</div>
			</div>
	</div>
	<div style="clear:both;"></div>
<div class="foot_box">
				<div class="foot_banner"><a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/about/id/9.html">关于我们</a> | <a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/about/id/10.html" style="color:red; font-weight: bold;">诚征合作</a> | <a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/about/id/11.html">用户协议</a> | <a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/about/id/12.html">版权声明</a> | <a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/about/id/13.html">联系我们</a> | <a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/sitemap.html">网站地图</a> | <a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/sitemap.xml">sitemap</a></div> 
				<div class="foot_banner"><?php echo ($site_info["web_name"]); ?>@版权所有&nbsp;&nbsp;&nbsp; 备案号: <a target=_blank href="http://www.miitbeian.gov.cn/publish/query/indexFirst.action">冀ICP备14019838号</a> &nbsp;&nbsp;技术支持: 石家庄市绿境网络技术有限公司</div>
				<div style="padding-bottom:10px;"  class="foot_banner"><?php echo ($site_info["connect_us"]); ?> <?php echo ($site_info["count_code"]); ?></div>		
</div>
<script>
 function submitAddHouseForm(){
		$.messager.progress();
		$('#add_house_form').form('submit',{
			url: 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/house/personAddHouse',
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
						alert('恭喜您发布成功!通过审核后会在首页显示.如需修改请删除后重新提交');
						location.href = 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/house/detail/id/'+result.house_id+'.html';
						//$("#sell_type").attr("checked","checked");
						/*
						$.messager.confirm('添加房源成功','要查看发布的房源信息吗?',function(r){
							if (r){
								location.href = 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/house/detail/id/'+result.house_id+'.html';
							}else{
								location.href = 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>';
							}
						}); 
						*/
					}
					$('#add_house_form').form('reset');
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