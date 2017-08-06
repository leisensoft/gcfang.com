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

<link rel="stylesheet" type="text/css" href="/Public/css/register.css">	
</head>	
<body>
		<div class="nav">
			<ul>
					<li ><a style="color:yellow;" href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>"><?php echo ($site_info["web_name"]); ?>首页</a></li>
					<li ><a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/mapHouse">地图找房</a></li>
			</ul>
</div>	
		<div class="common_box" >
				<div style="width:980px;height:100%;margin:0 auto;">
				  <div style="width:490px;height:572px;margin:10px 0 0 0;float:left;border:solid 1px grey;">
					 <div class="sub_title" style="line-height:40px;margin:20px 0 40px 0;color:#DA5E43;width:100%;text-align:center;" >免费注册,免费发布信息</div>
					 <form id="register_form" method="post" class="easyui-form" data-options="novalidate:true">
					<div class="my_input">
						 手机号码: 
						 <input style="width:150px;" class="easyui-textbox" type="text" id="tel" field="tel" name="tel"  data-options="required:true,validType:['length[11,11]'],invalidMessage:'请输入11位的手机号码'"></input>
					</div>
					<div class="my_note">当您发布信息时此号码将显示在网页上,同时这也是您登陆本网站的用户名称</div>
					 <div class="my_input">	
							 设置密码:
							 <input style="width:150px;" class="easyui-textbox" type="password" field="password" name="password" data-options="prompt:'',required:true,validType:['length[6,20]'],invalidMessage:'请输入6位以上的密码'"></input>
					 </div>
					 <div class="my_input">
							 您的姓名:
							 <input style="width:150px;" class="easyui-textbox" type="text" field="person_name" name="person_name" data-options="prompt:'',required:true"></input>
					 </div>
					 <div class="my_input">
							 公司名称:
							 <input style="width:250px;" class="easyui-textbox" type="text" field="company_name" name="company_name" data-options="prompt:'',required:true"></input>
					 </div>
					 <div class="my_input">
							 办公地址:
							 <input style="width:350px;" class="easyui-textbox" type="text" field="address" name="address" data-options="required:true"></input>
					 </div>
					 <div class="my_note">(以下为选填信息:建议填写)</div>
					 <div class="my_input">
							 联系QQ :
							 <input style="width:150px;" class="easyui-textbox" type="text" field="qq" name="qq" ></input>
					 </div>
					 <div class="my_input">
							 公司电话: 
							 <input style="width:150px;" class="easyui-textbox" type="text" field="shop_tel" name="shop_tel" ></input>
					 </div>
					 <div class="my_input">
							 公司简介:
							 <input style="width:350px;" class="easyui-textbox" type="text" field="about_us" name="about_us" data-options="prompt:''"></input>
					 </div>
					 <div class="my_input">
							  验 证 码 :
							   <input style="width:75px;" class="easyui-textbox" type="text" name="valid_code" data-options="required:true"  ></input>
							   <input type="hidden" name="valid_id" value="1">
							   <img id="valid_1" onclick="this.src='http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/verify_code?id=1&&rnd='+Math.random()" src="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/verify_code?id=1&&rnd"+Math.random()/>
							   <span style="font-size:14px;">点击图片刷新</span>
					 </div>
					 <div class="my_input" style="">
							<div  style="background-color:#DA5E43;" onclick="submitRegisterForm();" class="yuan_login_button" ><div style="margin:3px 0 0 64px;">注&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;册</div></div>
					 </div>
					 </form>      
				  </div>
				  <div style="width:430px;height:385px;margin:10px 0 0 30px;font-size:14px;float:left;border:1px solid grey;">
						<div class="sub_title" style="line-height:40px;margin:20px 0 40px 0;color:#45A21C;width:100%;text-align:center;">如果您已拥有帐户，请在下面登录</div>
						<form id="login_form" method="post" >
						<div class="my_input2">
							 <div class="input_front">手机号:</div>
							 <div class="input_front"><input value="<?php echo ($user_cookie_tel); ?>" field="tel" style="" id="u_tel" class="my_login" type="text" name="u_tel"></input></div>						 
						</div>
<div style="clear:both;"></div>
						<div class="my_input2">
							 <div class="input_front">密 码:</div>
							 <div class="input_front"><input  style="" class="my_login" type="password" id="u_pass" name="u_pass" ></input></div>
						</div>
						<!--
<div style="clear:both;"></div>						
						<div class="my_input2">
							  <div class="input_front">验证码:</div><input style="width:100px;" maxlength="4"  class="my_login" type="text" name="name" ></input>
						</div>
						-->
<div style="clear:both;"></div>
						<div class="my_input2" style="">
							<div  class="yuan_login_button" onclick="submitLoginForm();" ><div style="margin:3px 0 0 64px;">登&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;陆</div></div>
						</div>
						</form>
						<div style="color:grey;">
							<br/>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:red;font-weight:bold;">重要提示：本站采用最新网页技术开发，需使用IE8或更高版本浏览器（如有问题可联系客服免费升级）</span>。
							<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;推荐使用：
							<a href="http://jifendownload.2345.cn/jifen_2345/2345explorer_k39547990.exe">2345王牌浏览器 点击下载</a>
						</div>
				  </div>
				</div>
		</div>
		<div style="clear:both;"></div>
<div class="foot_box">
				<div class="foot_banner"><a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/about/id/9.html">关于我们</a> | <a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/about/id/10.html" style="color:red; font-weight: bold;">诚征合作</a> | <a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/about/id/11.html">用户协议</a> | <a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/about/id/12.html">版权声明</a> | <a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/about/id/13.html">联系我们</a> | <a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/sitemap.html">网站地图</a> | <a href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/sitemap.xml">sitemap</a></div> 
				<div class="foot_banner"><?php echo ($site_info["web_name"]); ?>@版权所有&nbsp;&nbsp;&nbsp; 备案号: <a target=_blank href="http://www.miitbeian.gov.cn/publish/query/indexFirst.action">冀ICP备14019838号</a> &nbsp;&nbsp;技术支持: 石家庄市绿境网络技术有限公司</div>
				<div style="padding-bottom:10px;"  class="foot_banner"><?php echo ($site_info["connect_us"]); ?> <?php echo ($site_info["count_code"]); ?></div>		
</div>
<script>
var c_start=document.cookie.indexOf("lei666_tel=");
if(c_start != -1){ $('#u_pass').focus();}else{$('#u_tel').focus();}
function submitRegisterForm(){
		$('#register_form').form('submit',{
			url: 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/submitRegister',
			onSubmit: function(){
				 return $(this).form('enableValidation').form('validate');
			},
		success: function(result){
					var result = eval('('+result+')');
					if (result.errorMsg){
						  $.messager.alert('提示',result.errorMsg,'error');
						  $('#valid_1').attr("src",'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/verify_code?id=1&&rnd='+Math.random());
						  //
					} else {
						$.messager.alert('提示','恭喜您注册成功,现在即将跳转后台.您就可以马上发布信息了!');
					    location.href = 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/u/manage';
					}
				}
		});
}
function submitLoginForm(){
		$('#login_form').form('submit',{
			url: 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/submitLogin',
			onSubmit: function(){
				if(''==$("#u_tel").val()){
					alert('手机号不能为空');
					$("#u_tel").focus();
					return false;
				}
				if(''==$("#u_pass").val()){
					alert('密码不能为空');
					$("#u_pass").focus();
					return false;
				}	
			},
		success: function(result){
					var result = eval('('+result+')');
					if (result.errorMsg){
						if(result.err_no == '1')
							$("#u_tel").focus();
						if(result.err_no == '2'){
							$("#u_pass").val('');
							$("#u_pass").focus();
						}
						alert(result.errorMsg);
					} else {
					    location.href = 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/u/manage';
					}
				}
		});
}	
</script>
</body>
</html>