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

</head>
<body style="text-align:center;">
    <div class="easyui-panel" title=" " style="width:400px;">
        <div style="padding:10px 60px 20px 60px">
        <form id="ff" method="post">
            <table cellpadding="5">
                <tr>
                    <td>Name:</td>
                    <td><input class="easyui-textbox" type="text" id="m_name" name="m_name" data-options="required:true"></input></td>
                </tr>
                <tr>
                    <td>password:</td>
                    <td><input class="easyui-textbox" type="password" id="password" name="password" data-options="required:true"></input></td>
                </tr>
            </table>
        </form>
        <div style="text-align:center;padding:5px">
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitLoginForm()">Submit</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="clearForm()">Clear</a>
        </div>
        </div>
    </div>
    <script>
        function submitForm(){
            $('#ff').form('submit');
        }
        function clearForm(){
            $('#ff').form('clear');
        }
function submitLoginForm(){
		$('#ff').form('submit',{
			url: 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index/submitManagerLogin',
			onSubmit: function(){
				if(''==$("#m_name").val()){
					alert('不能为空');
					$("#m_name").focus();
					return false;
				}
				if(''==$("#password").val()){
					alert('不能为空');
					$("#password").focus();
					return false;
				}	
			},
		success: function(result){
					var result = eval('('+result+')');
					if (result.errorMsg){
						alert(result.errorMsg);
					} else {
					    location.href = 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/benben/';
					}
				}
		});
}
    </script>
</body>
</html>