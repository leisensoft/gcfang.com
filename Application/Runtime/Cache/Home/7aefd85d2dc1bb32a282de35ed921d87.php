<?php if (!defined('THINK_PATH')) exit();?><div id="content">											
	<!--列表TABLE-->	
    <table id="zonesInfoTable" title="小区信息表" class="easyui-datagrid" style="width:1000px;;height:366px"
    url="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/benben/getZonesInfoList"
    toolbar="#zoneInfotoolbar" pagination="true"
    rownumbers="true" fitColumns="true" singleSelect="true">
    <thead>
    <tr>
			<th field="id" width="5">编号</th>
			<th field="area_id" width="5">分站ID</th>
			<th field="name" width="10">名字</th>
			<th field="name_spell" width="10">拼音缩写</th>
			<th field="baidu_coordinate" width="10">百度坐标</th>
			<th field="address" width="40">地址</th>
			<th data-options="field:'state', width:5,align:'left',formatter:formatState" >状态</th>
			<th field="creat_time" width="15">创建日期</th>
    </tr>
    </thead>
    </table>
	<!--工具栏-->
	<div id="zoneInfotoolbar">
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newZone()">新增</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editZone()">修改</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyZone()">删除</a>
			
			<span class="textbox easyui-fluid" style="float:right; width: 276px; height: 30px;">
				<input onkeyup="doSearch()" id="searchValue" class="textbox-text validatebox-text" type="text" autocomplete="off" placeholder="名称,拼音缩写,地址" style="margin-left: 0px; margin-right: 0px; padding-top: 7px; padding-bottom: 7px; width: 266px;">
				<input class="textbox-value" type="hidden" value="">
			</span>
			<select id="state"  panelHeight="auto" onchange="doSearch()" style="width:60px;float:right;">
					<option value="">状态</option>
					<option value="2">未审核</option>
					<option value="1">审核</option>
			</select>
    </div>
	<!--弹出框-->
	<div id="zonesInfoDlg" class="easyui-dialog" style="width:400px;;height:350px;padding:10px 20px" closed="true" buttons="#zonesInfoDlg-buttons">
		<form id="zoneInfoFm" method="post" novalidate>
			<div class="fitem"><label>编号</label><input name="id"  class="easyui-textbox"  disabled="disabled"/></div>
			<div class="fitem"><label>分站ID</label><input name="area_id" class="easyui-textbox" required="true"/></div>
			<div class="fitem"><label>名字</label><input name="name" class="easyui-textbox"/></div>
			<div class="fitem"><label>拼音缩写</label><input name="name_spell" class="easyui-textbox" /></div>
			<div class="fitem"><label>百度坐标</label><input name="baidu_coordinate" class="easyui-textbox" /></div>
			<div class="fitem"><label>地址</label><input name="address" class="easyui-textbox" /></div>
			<div class="fitem"><label>状态</label><input name="state" class="easyui-textbox" /></div>
			<div class="fitem"><label>创建日期</label><input name="creat_time" class="easyui-textbox" disabled="disabled" /></div>
		</form>
    </div>
	<!--弹出框 摁扭-->
	<div id="zonesInfoDlg-buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveZone()" style="width:90px">保存</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#zonesInfoDlg').dialog('close')" style="width:90px">取消</a>
    </div>
		
<script>
function formatState(val,row){
	 if (2 == val){return '未审核'};
	 if (1 == val){return '审核'};
}
//■■■■■■■■■■■■■■■■■■■■■■ GIRD	
		var url;
		function newZone(){
			$('#zonesInfoDlg').dialog('open').dialog('setTitle','新增小区');
			$('#zoneInfoFm').form('clear');
			url = 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/benben/updateZoneInfo';
		}
		function editZone(){
			var row = $('#zonesInfoTable').datagrid('getSelected');
			if (row){
				$('#zonesInfoDlg').dialog('open').dialog('setTitle','修改小区信息');
				$('#zoneInfoFm').form('load',row);
				url = 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/benben/updateZoneInfo?id='+row.id;
			}
		}
		function saveZone(){
			$('#zoneInfoFm').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
			success: function(result){
						var result = eval('('+result+')');
						if (result.errorMsg){
							$.messager.show({title: 'Error',msg: result.errorMsg});
						} else {
							$('#zonesInfoDlg').dialog('close'); // close the dialog
							$('#zonesInfoTable').datagrid('reload'); // reload the zone data
						}
					}
			});
		}
	
		function destroyZone(){
			var row = $('#zonesInfoTable').datagrid('getSelected');
			if (row){
				$.messager.confirm('确认删除','确定要删除['+row.name+']小区的信息吗?',function(r){
				if (r){
					$.post('http://<?php echo ($_SERVER['SERVER_NAME']); ?>/benben/deleteZoneInfo',{id:row.id},function(result){
						if (result.success){
							$('#zonesInfoTable').datagrid('reload'); // reload the zone data
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
			$('#zonesInfoTable').datagrid('load',{
				searchValue: $('#searchValue').val(),
				state:$('#state').val()
			});
		}
		$('#zonesInfoTable').datagrid({onDblClickRow: function (rowIndex, rowData) { //■■■■■■■■■■■■■■■■■■■■■■双击表
				  window.open('http://<?php echo ($_SERVER['SERVER_NAME']); ?>/house/zoneDetail/id/'+rowData.id);
				}       
		}); 
</script>	
<style type="text/css">
    #zoneInfoFm{
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