<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo ($site_info["title"]); ?></title>
	<meta name="keywords" content="<?php echo ($site_info["keywords"]); ?>" />
	<meta name="description" content="<?php echo ($site_info["description"]); ?>" />
	<link rel="stylesheet" type="text/css" href="/Public/css/easyUI/easyui.css">
    <link rel="stylesheet" type="text/css" href="/Public/css/easyUI/icon.css">
    <link rel="stylesheet" type="text/css" href="/Public/css/easyUI/color.css">
    <script type="text/javascript" src="/Public/js/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/js/jquery.easyui.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/Public/css/reset.css">
	<link rel="stylesheet" type="text/css" href="/Public/css/common.css">
</head>	
<body>
		<div class="nav">
			<ul>
					<li ><a style="color:yellow;" href="http://<?php echo ($_SERVER['SERVER_NAME']); ?>">廉州房产首页</a></li>
					<li ><a href="">买 房</a></li>
					<li ><a href="">租  房</a></li>
					<li ><a href="">门市/厂房</a></li>
					<li ><a href="">车库/车位</a></li>
			</ul>
</div>	
<style>
.my_input{width:100%;font-size:18px;margin:15px 0 0 20px;}
.my_input2{width:370px;font-size:18px;margin:15px 0 0 30px;}
.my_note{ width:100%;font-size:14px;margin:2px 0 0 20px;color:red;}

.my_login{
width: 218px;
display: inline-block;
font-family: helvetica,arial,sans-serif;
font-weight: bold;
margin: 0px;
list-style: outside none none;
border: 2px solid #DFDFDF;
border-radius: 2px;
padding: 11px 9px;
color: #595959;
vertical-align: middle;
background-color: #FFF;
transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
resize: none;
outline: medium none;
font-size: 16px;
line-height: 18px;
}
.my_login:focus{outline: 0px none;border: 2px solid #58B12E;}

.input_front{float:left;width:66px;line-height:50px;}

.yuan_login_button { 
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
width:220px;
height:27px;
margin: 3px 0 0 50px;
background-color:#45A21C;
cursor:pointer;
}
</style>
		<div class="common_box" >
				<div style="width:980px;height:100%;margin:0 auto;">
				  <div style="width:490px;height:572px;margin:10px 0 0 0;float:left;border:solid 1px grey;">
					 <div class="sub_title" style="line-height:40px;margin:20px 0 40px 0;color:#DA5E43;width:100%;text-align:center;" >免费注册,免费发布信息</div>
					 <form id="register_form" method="post" class="easyui-form" data-options="novalidate:true">
					<div class="my_input">
						 手机号码: 
						 <input style="width:150px;" class="easyui-textbox" type="text" field="tel" name="tel"  data-options="required:true"></input>
					</div>
					<div class="my_note">当您发布信息时此号码将显示在网页上,同时这也是您登陆本网站的用户名称</div>
						
					 <div class="my_input">	
							 设置密码:
							 <input style="width:150px;" class="easyui-textbox" type="password" field="password" name="password" data-options="prompt:'',required:true"></input>
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
					 <div class="my_note">(以下为选填信息:建议填写) </div>
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
				  <div style="width:430px;height:335px;margin:10px 0 0 30px;font-size:14px;float:left;border:1px solid grey;">
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
						
				  </div>
				</div>
		</div>
		<div style="clear:both;"></div>
<div class="foot_box">
				<div class="foot_banner"><a href="<!--<?php echo ($cfg["url"]); ?>-->about/about.php">关于我们</a> | <a href="<!--<?php echo ($cfg["url"]); ?>-->about/talented.php" style="color:red; font-weight: bold;">诚征合作</a> | <a href="<!--<?php echo ($cfg["url"]); ?>-->about/agreement.php">用户协议</a> | <a href="<!--<?php echo ($cfg["url"]); ?>-->about/copyright.php">版权声明</a> | <a href="<!--<?php echo ($cfg["url"]); ?>-->about/contact.php">联系我们</a></div> 
				<div class="foot_banner"><?php echo ($site_info["web_name"]); ?>@版权所有&nbsp;&nbsp;&nbsp; 备案号: <a target=_blank href="http://www.miitbeian.gov.cn/publish/query/indexFirst.action">冀ICP备14019838号</a> &nbsp;&nbsp;技术支持: 石家庄市藁城区绿境网络技术有限公司</div>
				<div style="padding-bottom:10px;"  class="foot_banner"><?php echo ($site_info["connect_us"]); ?></div>		
</div>
<script>
//cookie焦点控制
var c_start=document.cookie.indexOf("lei666_tel=");
if(c_start != -1){ 
	$('#u_pass').focus();
}else{
	$('#u_tel').focus();
}

$(".yuan_login_button").hover(function(){
	$(this).css("border","2px solid black");
	$(this).css("color","black");
 },function(){
	$(this).css("border","2px solid #C0C0C0");
	$(this).css("color","white");
 }); 
 function submitRegisterForm(){
		$('#register_form').form('submit',{
			url: 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/submitRegister',
			onSubmit: function(){
				 return $(this).form('enableValidation').form('validate');
			},
		success: function(result){
					var result = eval('('+result+')');
					if (result.errorMsg){
						//$.messager.show({title: 'Error',msg: result.errorMsg});
						alert(result.errorMsg);
					} else {
						alert('恭喜您注册成功,现在即将跳转后台.您就可以马上发布信息了!');
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