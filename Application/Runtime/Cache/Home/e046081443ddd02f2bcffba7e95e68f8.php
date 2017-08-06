<?php if (!defined('THINK_PATH')) exit();?><div id="content">		
<div style="font-size:18px;margin:10px 10px;">当前余额: <?php echo ($user_info["money"]); ?> 元</div>
									
	<!--列表TABLE-->	
    <table id="dealInfoTable" title="消费信息查询" class="easyui-datagrid" style="width:1000px;;height:366px"
    url="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/u/getDealInfoList"
    toolbar="#deal_toolbar" pagination="true"
    rownumbers="false" fitColumns="true"   singleSelect="true">
    <thead>
    <tr>
			<th field="id" width="10">消费编号</th>
			<th field="type" width="5" data-options="field:'type', width:5,align:'left',formatter:formatDealType">类型</th>
			<th field="money" width="10" sortable="true">价格(元)</th>
			<th field="remark" width="40">备注</th>
			<th field="house_id" width="10">房源ID</th>
			<th field="tag_days" width="10">天数</th>
			<th field="deal_time" width="15">创建时间</th>
    </tr>
    </thead>
    </table>
<script>
//■■■■■■■■■■■■■■■■■■■■■■修改列表格式
function formatDealType(val,row){
	 if (1 == val){return '置顶'};
	 if (2 == val){return '加急'};
	 if (3 == val){return '其他'};
}
function formatSellType(val,row){
	 if (1 == val){return '售'};
	 if (2 == val){return '&nbsp;&nbsp;&nbsp;&nbsp;租'};
}
function formatPrice(val,row){
	 if (0 == val){return '面议'};
	 return val;
}
//■■■■■■■■■■■■■■■■■■■■■■ GIRD	
		var url;
		function newDeal(){
			$('#dealInfoDlg').dialog('open').dialog('setTitle','新增房源');
			$('#dealInfoFm').form('clear');
			url = 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/u/updateDealInfo';
		}
		function editDeal(){
			var row = $('#dealInfoTable').datagrid('getSelected');
			if (row){
				$('#dealInfoDlg').dialog('open').dialog('setTitle','修改房源信息');
				$('#dealInfoFm').form('load',row);
				UM.getEditor('myEditor2').setContent(row.content, false);//添加编辑框内容
				url = 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/u/updateDealInfo?id='+row.id;
			}
		}
</script>	
<style type="text/css">
    #dealInfoFm{margin:0;padding:10px 30px;}
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