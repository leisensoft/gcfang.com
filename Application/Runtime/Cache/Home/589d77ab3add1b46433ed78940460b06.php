<?php if (!defined('THINK_PATH')) exit();?><div id="content">											
	<!--列表TABLE-->	
    <table id="housesInfoTable" title="房源信息表" class="easyui-datagrid" style="width:1000px;;height:366px"
    url="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/benben/getHousesInfoList"
    toolbar="#houseInfotoolbar" pagination="true"
    rownumbers="true" fitColumns="true" singleSelect="true">
    <thead>
    <tr>
			<th field="id" width="2">编号</th>
			<th data-options="field:'house_state',width:3,align:'left',formatter:formatHouseState">状态</th>
			<th data-options="field:'user_type',width:3,align:'left',formatter:formatUserType">来源</th>
			<th data-options="field:'sell_type', width:4,align:'left',formatter:formatSellType" >类型</th>
			<th data-options="field:'house_type',width:6,align:'left',formatter:formatHouseType">房型</th>
			<th field="title" width="15">标题</th>
			<th field="zone_name" width="5">小区名</th>
			<th field="size" width="5">大小</th>
			<th field="price" width="5" data-options="field:'price', width:5,align:'left',formatter:formatPrice">价格</th>
			<th field="top_to_time" width="5">置顶</th>
			<th field="hurry_to_time" width="5">加急</th>
			<th field="create_time" width="10">时间</th>
    </tr>
    </thead>
    </table>
	<!--工具栏-->
	<div id="houseInfotoolbar">
			<!--<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newHouse()">新增</a>-->
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-tip" plain="true" onclick="topHouse()">置顶</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-tip" plain="true" onclick="hurryHouse()">加急</a>
			<!--<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editHouse()">修改</a>-->
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="checkHouse()">审核</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="rubbishHouse()">垃圾</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyHouse()">删除</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="dropHouse()">彻底删除</a>
			
			<span class="textbox easyui-fluid" style="float:right; width: 276px; height: 30px;">
				<input onkeyup="doSearch()" id="searchValue" class="textbox-text validatebox-text" type="text" autocomplete="off" placeholder="房源编号,标题,个人电话,个人姓名" style="margin-left: 0px; margin-right: 0px; padding-top: 7px; padding-bottom: 7px; width: 266px;">
				<input class="textbox-value" type="hidden" value="">
			</span>
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
	<!--弹出框-->
	<div id="housesInfoDlg" class="easyui-dialog" style="width:400px;;height:580px;padding:10px 20px" closed="true" buttons="#housesInfoDlg-buttons">
		<form id="houseInfoFm" method="post" novalidate>
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
			<div class="fitem"><label>余额</label><input name="money" class="easyui-textbox" ></div>
			<div class="fitem"><label>创建时间</label><input name="create_time" class="easyui-textbox" disabled="disabled" ></div>
		</form>
    </div>
	<!--弹出框 摁扭-->
	<div id="housesInfoDlg-buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveHouse()" style="width:90px">保存</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#housesInfoDlg').dialog('close')" style="width:90px">取消</a>
    </div>
		
<script>
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
function formatHouseState(val,row){
	 if (1 == val){return "<span style='color:green'>正常</span>"};
	 if (2 == val){return '已审核'};
	 if (3 == val){return '删除'};
	 if (4 == val){return '垃圾'};
	 if (5 == val){return "<span style='color:red'>未审核</span>"};
	 if (6 == val){return '未通过'};	  
}
function formatUserType(val,row){
	 if (1 == val){return '中介'};
	 if (2 == val){return '个人'};
	 if (3 == val){return '管理员'};
	 if (4 == val){return '采集'};
}
//■■■■■■■■■■■■■■■■■■■■■■ GIRD	
		var url;
		function newHouse(){
			$('#housesInfoDlg').dialog('open').dialog('setTitle','新增用户');
			$('#houseInfoFm').form('clear');
			url = 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/benben/updateHouseInfo';
		}
		function editHouse(){
			var row = $('#housesInfoTable').datagrid('getSelected');
			if (row){
				$('#housesInfoDlg').dialog('open').dialog('setTitle','修改用户信息');
				$('#houseInfoFm').form('load',row);
				url = 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/benben/updateHouseInfo?id='+row.id;
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
							$('#housesInfoTable').datagrid('reload'); // reload the house data
						}
					}
			});
		}
		function destroyHouse(){ //■■■■■■■■■■■■■■■■■■■■■■删除
			var row = $('#housesInfoTable').datagrid('getSelected');
			if (row){
				$.messager.confirm('确认删除','确定要删除['+row.title+']的信息吗?',function(r){
				if (r){
					$.post('http://<?php echo ($_SERVER['SERVER_NAME']); ?>/benben/deleteHouseInfo',{id:row.id},function(result){
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
		function dropHouse(){ //■■■■■■■■■■■■■■■■■■■■■■彻底删除
			var row = $('#housesInfoTable').datagrid('getSelected');
			if (row){
				$.messager.confirm('确认彻底删除','确定要彻底删除['+row.title+']的信息吗?',function(r){
				if (r){
					$.post('http://<?php echo ($_SERVER['SERVER_NAME']); ?>/benben/dropHouseInfo',{id:row.id},function(result){
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
		function rubbishHouse(){ //■■■■■■■■■■■■■■■■■■■■■■垃圾信息
			var row = $('#housesInfoTable').datagrid('getSelected');
			if (row){
				$.messager.confirm('确认垃圾','确定是垃圾? ['+row.title+']?',function(r){
				if (r){
					$.post('http://<?php echo ($_SERVER['SERVER_NAME']); ?>/benben/rubbishHouseInfo',{id:row.id},function(result){
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
		function checkHouse(){ //■■■■■■■■■■■■■■■■■■■■■■审核
			var row = $('#housesInfoTable').datagrid('getSelected');
			if (row){
				$.messager.confirm('确认删除','审核 ['+row.title+'] 的信息吗?',function(r){
				if (r){
					$.post('http://<?php echo ($_SERVER['SERVER_NAME']); ?>/benben/checkHouseInfo',{id:row.id,check:1},function(result){
						if (result.success){
							$('#housesInfoTable').datagrid('reload'); // reload the house data
						} else {
							$.messager.show({ // show error message
							title: 'Error',
							msg: result.errorMsg
							});
						}
					},'json');
				}else{
					$.post('http://<?php echo ($_SERVER['SERVER_NAME']); ?>/benben/checkHouseInfo',{id:row.id,check:6},function(result){
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
		function doSearch(){  //■■■■■■■■■■■■■■■■■■■■■■搜索
			$('#housesInfoTable').datagrid('load',{
				searchValue: $('#searchValue').val(),
				house_sell_type: $('#house_sell_type').val(),
				house_type: $('#house_type').val(),
			});
		}
		$('#housesInfoTable').datagrid({onDblClickRow: function (rowIndex, rowData) { //■■■■■■■■■■■■■■■■■■■■■■双击表
				  window.open('http://<?php echo ($_SERVER['SERVER_NAME']); ?>/house/detail/id/'+rowData.id);
				}       
		}); 
		
		//■■■■■■■■■■■■■■■■■■■■■■ 设置为置顶信息
function topHouse(){
	var row = $('#housesInfoTable').datagrid('getSelected');
	if (row){
			  $.messager.prompt('设置置顶', '请输入要置顶的天数(1-100天)', function(r){
					if (r>=0&&r<=100&&parseInt(r)==r&&r){
							//alert('置顶天数: '+r);
								$.post('http://<?php echo ($_SERVER['SERVER_NAME']); ?>/benben/setHouseToTop',{id:row.id,user_id:row.user_id,day:r},function(result){
									if (result.success){
										 $.messager.alert('OK','置顶成功!');
										 $('#housesInfoTable').datagrid('reload'); // reload the house data
									} else {
										$.messager.show({title: '有错误',msg: result.errorMsg});
									}
								},'json');
					}else{
						 $.messager.alert('输入错误','请输入正确的天数,天数范围为(1-100天)','error');
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
			  $.messager.prompt('设置加急', '请输入要加急的天数(1-100天)', function(r){
					if (r>=0&&r<=100&&parseInt(r)==r){
								$.post('http://<?php echo ($_SERVER['SERVER_NAME']); ?>/benben/setHouseToHurry',{id:row.id,day:r},function(result){
									if (result.success){
										 $.messager.alert('OK','加急成功!');
										 $('#housesInfoTable').datagrid('reload'); // reload the house data
									} else {
										$.messager.show({title: '有错误',msg: result.errorMsg});
									}
								},'json');
					}else{
						 $.messager.alert('输入错误','请输入正确的天数,天数范围为(1-100天)','error');
					}
				});
	}
}	

</script>	
<style type="text/css">
    #houseInfoFm{
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