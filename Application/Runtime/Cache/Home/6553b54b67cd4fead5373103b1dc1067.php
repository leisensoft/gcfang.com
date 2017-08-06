<?php if (!defined('THINK_PATH')) exit();?><div id="content">											
	<!--列表TABLE-->	
    <table id="housesInfoTable" title="房源信息表" class="easyui-datagrid" style="width:1000px;;height:366px"
    url="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/u/getHousesInfoList"
    toolbar="#house_list_toolbar" pagination="true"
    rownumbers="false" fitColumns="true"   singleSelect="true">
    <thead>
    <tr>
			<th field="id" width="5">编号</th>
			<th field="title" width="30">标题</th>
			<th field="zone_name" width="10" sortable="true">小区或路段</th>
			<th field="size" width="5">面积(平米)</th>
			<th field="price" width="5" data-options="field:'price', width:5,align:'left',formatter:formatPrice">价格</th>
			<th data-options="field:'sell_type', width:4,align:'left',formatter:formatSellType" >类型</th>
			<th data-options="field:'house_type',width:6,align:'left',formatter:formatHouseType">房型</th>
			<th field="top_to_time" width="5">置顶</th>
			<th field="hurry_to_time" width="5">加急</th>
			<th field="create_time" width="15">创建时间</th>
    </tr>
    </thead>
    </table>
	<!--工具栏-->
	<div id="house_list_toolbar">
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-tip" plain="true" onclick="topHouse()">置顶</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-tip" plain="true" onclick="hurryHouse()">加急</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editHouse()">修改</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyHouse()">删除</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" plain="true" onclick="dealHouse()">成交</a>
			<!--
			日期:<input class="easyui-datebox" style="width:115px" data-options="formatter:myformatter,parser:myparser">
            至   <input class="easyui-datebox" style="width:115px" data-options="formatter:myformatter,parser:myparser"> 
			-->
			
			<span class="textbox easyui-fluid" style="float:right; width: 276px; height: 30px;">
				<input onkeyup="doSearch()" id="searchValue" class="textbox-text validatebox-text" type="text" autocomplete="off" placeholder="搜索(房源编号,小区名称,标题或包含内容)" style="margin-left: 0px; margin-right: 0px; padding-top: 7px; padding-bottom: 7px; width: 266px;">
				<input class="textbox-value" type="hidden" value="">
			</span>
			<select id="house_state" onchange="doSearch()" panelHeight="auto" style="width:80px;float:right;">
					<option value="">状态</option>
					<option value="1">在售</option>
					<option value="5">成交</option>
					<option value="3">删除</option>
			</select>
			
			<select id="house_type" onchange="doSearch()" panelHeight="auto" style="width:80px;float:right;">
					<option value="">房源类型</option>
					<option value="1">二手房</option>
					<option value="2">门市/厂房</option>
					<option value="3">车库/车位</option>
			</select>
			
			<select id="house_sell_type"  panelHeight="auto" onchange="doSearch()" style="width:60px;float:right;">
					<option value="">售/租</option>
					<option value="1">出售</option>
					<option value="2">出租</option>
			</select>
    </div>
<!--修改房源信息弹出框-->
	<div id="housesInfoDlg" class="easyui-dialog" style="width:800px;height:520px;padding:10px 20px" closed="true" buttons="#housesInfoDlg-buttons">
		<form id="houseInfoFm" method="post" novalidate>
			<div class="fitem"><label>标题</label><input name="title" style="width:305px;"  class="easyui-textbox" data-options="required:true" /></div>
			<div class="fitem"><label>小区</label><input name="zone_name" class="easyui-textbox" disabled="disabled"/>一经发布,不可修改.</div>
			<div class="fitem"><label>面积</label><input name="size" class="easyui-textbox" data-options="required:true" />平米</div>
			<div class="fitem"><label>价格</label><input name="price" class="easyui-textbox"  />万元(面议请留空)</div>
			
			<div class="">
			<script type="text/plain" id="myEditor2" style="width:686px;height:240px;">
												<p>我去</p>
										</script>
									    <script type="text/javascript">
										//var um = UM.getEditor('myEditor');//实例化编辑器
											$(function() {          
											var um = UM.getEditor('myEditor2', { 
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
		</form>
    </div>
<!--修改房源信息 弹出框 摁扭-->
	<div id="housesInfoDlg-buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveHouse()" style="width:90px">保存</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#housesInfoDlg').dialog('close')" style="width:90px">取消</a>
    </div>
<!--成交 弹出框 -->
<div id="dealInfoDlg" class="easyui-dialog" style="width:406px;height:200px;padding:10px 20px" closed="true" buttons="#dealInfoDlg-buttons">
		<form id="dealInfoFm" method="post" novalidate>
			<div class="fitem"><label>成交价：</label><input name="deal_money" style="width:66px;"  class="easyui-textbox" data-options="required:true" /></div>
			<div class="fitem"><label>备注：</label><input name="deal_remark" data-options="multiline:true"  style="width:266px;height:60px;"  class="easyui-textbox" /></div>
		</form>
    </div>
<!--成交 弹出框 摁扭-->
<div id="dealInfoDlg-buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="submitDealHouse()" style="width:90px">保存</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dealInfoDlg').dialog('close')" style="width:90px">取消</a>
    </div>
<script>
//■■■■■■■■■■■■■■■■■■■■■■成交
function dealHouse(){
		var row = $('#housesInfoTable').datagrid('getSelected');
		if (row){
			$('#dealInfoDlg').dialog('open').dialog('setTitle','恭喜成交！');
			$('#dealInfoDlg').form('load',row);
			url = 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/u/dealHouse?id='+row.id;
		}
}
function submitDealHouse(){
	$('#dealInfoFm').form('submit',{
		url: url,
		onSubmit: function(){
			return $(this).form('validate');
		},
	success: function(result){
				var result = eval('('+result+')');
				if (result.errorMsg){
					$.messager.show({title: 'Error',msg: result.errorMsg});
				} else {
					$('#dealInfoDlg').dialog('close'); // close the dialog
					alert('保存成功');
					$('#housesInfoTable').datagrid('reload'); // reload the house data
				}
			}
	});
}


//■■■■■■■■■■■■■■■■■■■■■■修改日历格式
		function myformatter(date){
            var y = date.getFullYear();
            var m = date.getMonth()+1;
            var d = date.getDate();
            return y+'年'+(m<10?('0'+m):m)+'月'+(d<10?('0'+d):d)+"日";
        }
        function myparser(s){
            if (!s) return new Date();
            var ss = (s.split('-'));
            var y = parseInt(ss[0],10);
            var m = parseInt(ss[1],10);
            var d = parseInt(ss[2],10);
            if (!isNaN(y) && !isNaN(m) && !isNaN(d)){
                return new Date(y,m-1,d);
            } else {
                return new Date();
            }
        }
//■■■■■■■■■■■■■■■■■■■■■■修改列表格式
function formatHouseType(val,row){
	 if (1 == val){return '二手房'};
	 if (2 == val){return '门市/厂房'};
	 if (3 == val){return '车库/车位'};
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
		function newHouse(){
			$('#housesInfoDlg').dialog('open').dialog('setTitle','新增房源');
			$('#houseInfoFm').form('clear');
			url = 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/u/updateHouseInfo';
		}
		function editHouse(){
			var row = $('#housesInfoTable').datagrid('getSelected');
			if (row){
				$('#housesInfoDlg').dialog('open').dialog('setTitle','修改房源信息');
				$('#houseInfoFm').form('load',row);
				UM.getEditor('myEditor2').setContent(row.content, false);//添加编辑框内容
				url = 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/u/updateHouseInfo?id='+row.id;
			}
		}
//■■■■■■■■■■■■■■■■■■■■■■ 设置为置顶信息
function topHouse(){
	var row = $('#housesInfoTable').datagrid('getSelected');
	if (row){
			  $.messager.prompt('设置置顶', '请输入要置顶的天数(1-30天)', function(r){
					if (r>=0&&r<=30&&parseInt(r)==r&&r){
							//alert('置顶天数: '+r);
								$.post('http://<?php echo ($_SERVER['SERVER_NAME']); ?>/u/setHouseToTop',{id:row.id,user_id:row.user_id,day:r},function(result){
									if (result.success){
										 $.messager.alert('OK','置顶成功!');
										 $('#housesInfoTable').datagrid('reload'); // reload the house data
									} else {
										$.messager.show({title: '有错误',msg: result.errorMsg});
									}
								},'json');
					}else{
						 $.messager.alert('输入错误','请输入正确的天数,天数范围为(1-30天)','error');
					}
				});
				
		//$('#housesInfoDlg').dialog('open').dialog('setTitle','设为置顶信息');
		//$('#houseInfoFm').form('load',row);
		//url = 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/u/updateHouseInfo?id='+row.id;
	}
}
//■■■■■■■■■■■■■■■■■■■■■■ 设置为加急信息
function hurryHouse(){
	var row = $('#housesInfoTable').datagrid('getSelected');
	if (row){
			  $.messager.prompt('设置加急', '请输入要加急的天数(1-30天)', function(r){
					if (r>=0&&r<=30&&parseInt(r)==r){
								$.post('http://<?php echo ($_SERVER['SERVER_NAME']); ?>/u/setHouseToHurry',{id:row.id,user_id:row.user_id,day:r},function(result){
									if (result.success){
										 $.messager.alert('OK','加急成功!');
										 $('#housesInfoTable').datagrid('reload'); // reload the house data
									} else {
										$.messager.show({title: '有错误',msg: result.errorMsg});
									}
								},'json');
					}else{
						 $.messager.alert('输入错误','请输入正确的天数,天数范围为(1-30天)','error');
					}
				});
	}
}		
function saveHouse(){
	$('#houseInfoFm').form('submit',{
		url: url,
		onSubmit: function(){
			return $(this).form('validate');
		},
	success: function(result){
				var result = eval('('+result+')');
				if (result.errorMsg){
					$.messager.show({title: 'Error',msg: result.errorMsg});
				} else {
					$('#housesInfoDlg').dialog('close'); // close the dialog
					$.messager.confirm('修改房源成功','要查看修改后的房源信息吗?',function(r){
						if (r){
							window.open('http://<?php echo ($_SERVER['SERVER_NAME']); ?>/house/detail/id/'+result.house_id+'.html');
						}
					});
					$('#housesInfoTable').datagrid('reload'); // reload the house data
				}
			}
	});
}
function destroyHouse(){
	var row = $('#housesInfoTable').datagrid('getSelected');
	if (row){
		$.messager.confirm('确认删除','确定要删除['+row.title+']的房源信息吗?',function(r){
		if (r){
			$.post('http://<?php echo ($_SERVER['SERVER_NAME']); ?>/u/deleteHouseInfo',{id:row.id},function(result){
				if (result.success){
					$('#housesInfoTable').datagrid('reload'); // reload the house data
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
function doSearch(){  //■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■搜索
	$('#housesInfoTable').datagrid('load',{
		searchValue: $('#searchValue').val(),
		house_sell_type: $('#house_sell_type').val(),
		house_type: $('#house_type').val(),
		house_state:$('#house_state').val(),
	});
}
$('#housesInfoTable').datagrid({onDblClickRow: function (rowIndex, rowData) { //■■■■■■■■■■■■■■■■■■■■■■双击表
		  window.open('http://<?php echo ($_SERVER['SERVER_NAME']); ?>/house/detail/id/'+rowData.id+'.html');
		}       
}); 
</script>	
<style type="text/css">
    #houseInfoFm{margin:0;padding:10px 30px;}
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