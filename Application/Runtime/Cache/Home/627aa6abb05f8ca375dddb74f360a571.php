<?php if (!defined('THINK_PATH')) exit();?><div id="content">											
	<!--列表TABLE-->	
    <table id="rechargeInfoTable" title="充值管理" class="easyui-datagrid" style="width:1000px;;height:366px"
    url="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/benben/getRechargeInfoList"
    toolbar="#rechargeInfotoolbar" pagination="true"
    rownumbers="true" fitColumns="true" singleSelect="true">
    <thead>
    <tr>
			<th field="id" width="5">ID</th>
			<th field="area_id" width="5">区域ID</th>
			<th field="user_id" width="5">用户ID</th>
			<th field="money" width="5">金额</th>
			<th field="admin" width="5">管理员</th>
			<th data-options="field:'type', width:5,align:'left',formatter:formatType" >类型</th>
			<th field="remark" width="55">备注</th>
			<th field="time" width="15">时间</th>
    </tr>
    </thead>
    </table>
	<!--工具栏-->
	<div id="rechargeInfotoolbar">
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newRecharge()">充值</a>
			<!--
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editRecharge()">修改</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyRecharge()">删除</a>
			-->
			<span class="textbox easyui-fluid" style="float:right; width: 276px; height: 30px;">
				<input onkeyup="doSearch()" id="searchRechargeValue" class="textbox-text validatebox-text" type="text" autocomplete="off" placeholder="用户ID" style="margin-left: 0px; margin-right: 0px; padding-top: 7px; padding-bottom: 7px; width: 266px;">
				<input class="textbox-value" type="hidden" value="">
			</span>
    </div>
	<!--弹出框-->
	<div id="rechargeInfoDlg" class="easyui-dialog" style="width:400px;;height:480px;padding:10px 20px" closed="true" buttons="#rechargeInfoDlg-buttons">
		<form id="rechargeInfoFm" method="post" novalidate>
		<!--
			<div class="fitem"><label>id</label><input name="id"  class="easyui-textbox"  disabled="disabled"/></div>
			<div class="fitem"><label>区域ID</label><input name="area_id" class="easyui-textbox" disabled="disabled" /></div>
			<div class="fitem"><label>操作员ID</label><input name="admin" class="easyui-textbox" disabled="disabled" ></div>
			<div class="fitem"><label>创建时间</label><input name="time" class="easyui-textbox" disabled="disabled" ></div>
		-->
			<div class="fitem"><label>用户ID</label><input name="user_id" class="easyui-textbox" required="true"></div>
			<div class="fitem"><label>类型</label>
			<select class="easyui-combobox" name="type" required="true">
				<option value="1" selected="selected">充值</option>
				<option value="2">退款</option>
			 </select>
			</div>
			<div class="fitem"><label>金额</label><input name="money" class="easyui-textbox" required="true"></div>
			<div class="fitem"><label>备注</label><input name="remark" class="easyui-textbox"></div>	
		</form>
    </div>
	<!--弹出框 摁扭-->
	<div id="rechargeInfoDlg-buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveRecharge()" style="width:90px">保存</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#rechargeInfoDlg').dialog('close')" style="width:90px">取消</a>
    </div>	
<script>

function formatType(val,row){
	 if (1 == val){return '充值'};
	 if (2 == val){return '退款'};
}
//■■■■■■■■■■■■■■■■■■■■■■ GIRD	
		var url;
		function newRecharge(){
			$('#rechargeInfoDlg').dialog('open').dialog('setTitle','充值');
			$('#rechargeInfoFm').form('clear');
			url = 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/benben/updateRechargeInfo';
		}
		function editRecharge(){
			var row = $('#rechargeInfoTable').datagrid('getSelected');
			if (row){
				$('#rechargeInfoDlg').dialog('open').dialog('setTitle','修改用户信息');
				$('#rechargeInfoFm').form('load',row);
				UM.getEditor('myRechargeEditor').setContent(row.content, false);//添加编辑框内容
				url = 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/benben/updateRechargeInfo?id='+row.id;
			}
		}
		function saveRecharge(){
			$('#rechargeInfoFm').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
			success: function(result){
						var result = eval('('+result+')');
						if (result.errorMsg){
							//$.messager.show({title: 'Error',msg: result.errorMsg});
							 $.messager.alert('错误',result.errorMsg);
						} else {
							$('#rechargeInfoDlg').dialog('close'); // close the dialog
							$('#rechargeInfoTable').datagrid('reload'); // reload the recharge data
						}
					}
			});
		}
		function destroyRecharge(){
			var row = $('#rechargeInfoTable').datagrid('getSelected');
			if (row){
				$.messager.confirm('确认删除','确定要删除['+row.title+']站的信息吗?',function(r){
				if (r){
					$.post('http://<?php echo ($_SERVER['SERVER_NAME']); ?>/benben/deleteRechargeInfo',{id:row.id,state:2},function(result){
						if (result.success){
							$('#rechargeInfoTable').datagrid('reload'); // reload the recharge data
						} else {
							$.messager.show({ // show error message
							title: 'Error',
							msg: result.errorMsg
							});
						}
					},'json');
				}else{
					$.post('http://<?php echo ($_SERVER['SERVER_NAME']); ?>/benben/deleteRechargeInfo',{id:row.id,state:1},function(result){
						if (result.success){
							$('#rechargeInfoTable').datagrid('reload'); // reload the recharge data
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
			$('#rechargeInfoTable').datagrid('load',{
				searchRechargeValue: $('#searchRechargeValue').val(),
				state:$('#state').val()
			});
		}
		$('#rechargeInfoTable').datagrid({onDblClickRow: function (rowIndex, rowData) { //■■■■■■■■■■■■■■■■■■■■■■双击表
				  //window.open('home-faq-faqShow?id='+rowData.id);
				}       
		}); 
</script>	
<style type="text/css">
    #rechargeInfoFm{margin:0;padding:10px 30px;}
    .ftitle{
    font-size:14px;
    font-weight:bold;
    padding:5px 0;
    margin-bottom:10px;
    border-bottom:1px solid #ccc;
    }
    .fitem{margin-bottom:5px;}
    .fitem label{display:inline-block;width:80px;}
    .fitem input{width:160px;}
    </style>
</div>