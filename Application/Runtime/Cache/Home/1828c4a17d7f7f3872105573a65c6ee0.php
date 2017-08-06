<?php if (!defined('THINK_PATH')) exit();?><div id="content">
    <!--
		<input  class="easyui-combobox" style="height:26px;width:220px;" data-options="
																loader: myloader,
																mode: 'remote',
																valueField: 'id',
																textField: 'text',
																formatter: formatItem,
																panelHeight:'auto',
																">	</input>
	-->															
	<!--列表TABLE-->	
    <table id="usersInfoTable" title="用户信息表" class="easyui-datagrid" style="width:1000px;;height:366px"
    url="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/benben/getUsersInfoList"
    toolbar="#userInfotoolbar" pagination="true"
    rownumbers="true" fitColumns="true" singleSelect="true">
    <thead>
    <tr>
			<th field="id" width="5">编号</th>
			<th data-options="field:'state', width:4,align:'left',formatter:formatState" >状态</th>
			<th field="money" width="5">余额</th>
			<th field="person_name" width="5">联系人</th>
			<th field="company_name" width="20">商铺名</th>
			<th field="tel" width="10">电话</th>
			<th field="address" width="55">地址</th>
    </tr>
    </thead>
    </table>
	<!--工具栏-->
	<div id="userInfotoolbar">
			<!--<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">新增</a>-->
			
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">修改</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="checkUser()">审核</a>
			
			<span class="textbox easyui-fluid" style="float:right; width: 276px; height: 30px;">
				<input onkeyup="doSearch()" id="searchValue" class="textbox-text validatebox-text" type="text" autocomplete="off" placeholder="id,电话,联系人,店铺名" style="margin-left: 0px; margin-right: 0px; padding-top: 7px; padding-bottom: 7px; width: 266px;">
				<input class="textbox-value" type="hidden" value="">
			</span>
			<select id="state"  panelHeight="auto" onchange="doSearch()" style="width:60px;float:right;">
					<option value="">状态</option>
					<option value="1">正常</option>
					<option value="2">停用</option>
			</select>
    </div>
	<!--弹出框-->
	<div id="usersInfoDlg" class="easyui-dialog" style="width:400px;;height:580px;padding:10px 20px" closed="true" buttons="#usersInfoDlg-buttons">
		<form id="userInfoFm" method="post" novalidate>
			<div class="fitem"><label>id</label><input name="id"  class="easyui-textbox"  disabled="disabled"/></div>
			<div class="fitem"><label>电话</label><input name="tel" class="easyui-textbox" required="true"></div>
			<div class="fitem"><label>联系人</label><input name="person_name" class="easyui-textbox"></div>
			<div class="fitem"><label>公司名</label><input name="company_name" class="easyui-textbox" ></div>
			<div class="fitem"><label>地址</label><input name="address" class="easyui-textbox" ></div>
			<div class="fitem"><label>所属地区ID</label><input name="area_id" class="easyui-textbox" ></div>
			<div class="fitem"><label>qq</label><input name="qq" class="easyui-textbox" ></div>
			<div class="fitem"><label>私有主页URL</label><input name="shop_url" class="easyui-textbox" ></div>
			<div class="fitem"><label>公司电话</label><input name="shop_tel" class="easyui-textbox" ></div>
			<div class="fitem"><label>关于我们</label><input name="about_us" class="easyui-textbox" ></div>
			<div class="fitem"><label>友情链接</label><input name="friend_link" class="easyui-textbox" ></div>
			<div class="fitem"><label>公司图片src</label><input name="pic_src" class="easyui-textbox" ></div>
			<div class="fitem"><label>余额</label><input name="money" disabled="disabled" class="easyui-textbox" ></div>
			<div class="fitem"><label>创建时间</label><input name="register_time" class="easyui-textbox" disabled="disabled" ></div>
			<div class="fitem"><label>注册IP</label><input name="ip" class="easyui-textbox" disabled="disabled" ></div>
			<div class="fitem"><label>密码</label><input name="password" class="easyui-textbox"></div>
		</form>
    </div>
	<!--弹出框 摁扭-->
	<div id="usersInfoDlg-buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">保存</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#usersInfoDlg').dialog('close')" style="width:90px">取消</a>
    </div>
		
<script>
function formatState(val,row){
	 if (1 == val){return '正常'};
	 if (2 == val){return '停用'};
}
		var myloader = function(param,success,error){  //■■■■■■■■■■■■■■■■■■■■■■ auto complete
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
	
//■■■■■■■■■■■■■■■■■■■■■■ GIRD	
		var url;
		function newUser(){
			$('#usersInfoDlg').dialog('open').dialog('setTitle','新增用户');
			$('#userInfoFm').form('clear');
			url = 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/benben/updateUserInfo';
		}
		function editUser(){
			var row = $('#usersInfoTable').datagrid('getSelected');
			if (row){
				$('#usersInfoDlg').dialog('open').dialog('setTitle','修改用户信息');
				$('#userInfoFm').form('load',row);
				url = 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/benben/updateUserInfo?id='+row.id;
			}
		}
		function saveUser(){
			$('#userInfoFm').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
			success: function(result){
						var result = eval('('+result+')');
						if (result.errorMsg){
							$.messager.show({title: 'Error',msg: result.errorMsg});
						} else {
							$('#usersInfoDlg').dialog('close'); // close the dialog
							$('#usersInfoTable').datagrid('reload'); // reload the user data
						}
					}
			});
		}
	
		function checkUser(){
			var row = $('#usersInfoTable').datagrid('getSelected');
			if (row){
				$.messager.confirm('确认审核','确定要审核通过 ['+row.company_name+'] 的信息吗?',function(r){
				if (r){
					$.post('http://<?php echo ($_SERVER['SERVER_NAME']); ?>/benben/checkUserInfo',{id:row.id,check:1},function(result){
						if (result.success){
							$('#usersInfoTable').datagrid('reload'); // reload the user data
						} else {
							$.messager.show({ // show error message
							title: 'Error',
							msg: result.errorMsg
							});
						}
					},'json');
				}else{
					$.post('http://<?php echo ($_SERVER['SERVER_NAME']); ?>/benben/checkUserInfo',{id:row.id,check:2},function(result){
						if (result.success){
							$('#usersInfoTable').datagrid('reload'); // reload the user data
						} else {
							$.messager.show({ // show error message
							title: 'Error',
							msg: result.errorMsg
							});
						}
					},'json');
				}
				});
			}
		}
		
		function doSearch(){  //■■■■■■■■■■■■■■■■■■■■■■搜索
			$('#usersInfoTable').datagrid('load',{
				searchValue: $('#searchValue').val(),
				state:$('#state').val()
			});
		}
$('#usersInfoTable').datagrid({onDblClickRow: function (rowIndex, rowData) { //■■■■■■■■■■■■■■■■■■■■■■双击表
			  window.open('http://<?php echo ($_SERVER['SERVER_NAME']); ?>/a/'+rowData.id);
			}       
}); 
</script>	
<style type="text/css">
    #userInfoFm{
    margin:0;
    padding:10px 30px;
    }
    .ftitle{
    font-size:14px;
    font-weight:bold;
    padding:5px 0;
    margin-bottom:10px;
    border-bottom:1px solid #ccc;
    }
    .fitem{
    margin-bottom:5px;
    }
    .fitem label{
    display:inline-block;
    width:80px;
    }
    .fitem input{
    width:160px;
    }
    </style>
</div>