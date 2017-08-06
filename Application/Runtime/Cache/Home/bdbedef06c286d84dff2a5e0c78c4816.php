<?php if (!defined('THINK_PATH')) exit();?><div id="content">
<style>
.remark{font-size:14px;color:grey;}
</style>
	<div style="float:left;width:500px;margin:20px 60px;font-size:16px;line-height:29px;">
		<form id="user_info_form" method="post" class="easyui-form" data-options="novalidate:true" enctype="multipart/form-data">
			<table id="form_table" cellpadding="5">
                <tr>
                    <td>手机号码:&nbsp;&nbsp;&nbsp;</td>
                    <td> <input class="easyui-textbox" type="text" name="tel" disabled="disabled"></input>
						<span class="remark">修改请联系客服</span>
					</td>
					
                </tr>
                <tr>
                    <td>联系人:</td>
                    <td><input class="easyui-textbox" type="text" name="person_name" data-options="required:true"></input></td>
                </tr>
				 <tr>
                    <td>联系QQ:</td>
                    <td><input class="easyui-textbox" name="qq" style=""></input></td>
                </tr>
                <tr>
                    <td>公司名称:</td>
                    <td><input class="easyui-textbox" type="text" name="company_name" data-options="required:true" style="width:400px;"></input></td>
                </tr>
                <tr>
                    <td>办公地址:</td>
                    <td><input class="easyui-textbox" name="address" data-options="required:true" style="width:400px;"></input></td>
                </tr>
				<tr>
                    <td>关于我们:</td>
                    <td><input class="easyui-textbox" name="about_us" data-options="multiline:true" style="height:60px;width:400px;"></input></td>
                </tr>
				 <tr>
                    <td>图片:</td>
                    <td><input name="file" class="f1 easyui-filebox"></input><span style="font-size:14px;">(小于2MB,206*240像素,支持jpg,jpeg,png格式)</span></td>
                </tr>
            </table>
		</form>
		<a href="javascript:void(0)" class="easyui-linkbutton" style="margin:30px 0 0 100px;width:100px;" onclick="submitUserInfoForm()">确认修改</a>
	</div>
	<div style="float:left;font-size:16px;margin:20px 60px;">
		图片:<br/>
		<img src="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/Public/img/user/<?php echo ($site_info["area_id"]); ?>/<?php echo ($user_info["id"]); ?>.jpg">
	</div>
<script>
	$('#user_info_form').form('load', 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/u/userInfoJson');
	
	function submitUserInfoForm(){
			$('#user_info_form').form('submit',{
				url: 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/u/userInfoChange',
				onSubmit: function(){
					return $(this).form('validate');
				},
			success: function(result){
						var result = eval('('+result+')');
						if (result.errorMsg){
							$.messager.show({title: 'Error',msg: result.errorMsg});
						} else {
							$('#articlesInfoDlg').dialog('close'); // close the dialog

							//$('#articlesInfoTable').datagrid('reload'); // reload the article data
						}
					}
			});
		}
	
	
</script>
</div>