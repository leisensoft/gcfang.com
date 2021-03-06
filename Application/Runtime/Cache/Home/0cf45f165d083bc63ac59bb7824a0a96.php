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
    <table id="sitesInfoTable" title="分站信息表" class="easyui-datagrid" style="width:1000px;;height:366px"
    url="http://<?php echo ($_SERVER['SERVER_NAME']); ?>/benben/getSitesInfoList"
    toolbar="#siteInfotoolbar" pagination="true"
    rownumbers="true" fitColumns="true" singleSelect="true">
    <thead>
    <tr>
			<th field="area_id" width="5">编号</th>
			<th field="city_name" width="15">城市名</th>
			<th field="area_url" width="10">网址</th>
			<th field="web_name" width="40">网站名</th>
    </tr>
    </thead>
    </table>
	<!--工具栏-->
	<div id="siteInfotoolbar">
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newSite()">新增</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editSite()">修改</a>
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroySite()">删除</a>
			
			<span class="textbox easyui-fluid" style="float:right; width: 276px; height: 30px;">
				<input onkeyup="doSearch()" id="searchValue" class="textbox-text validatebox-text" type="text" autocomplete="off" placeholder="搜索" style="margin-left: 0px; margin-right: 0px; padding-top: 7px; padding-bottom: 7px; width: 266px;">
				<input class="textbox-value" type="hidden" value="">
			</span>
    </div>
	<!--弹出框-->
	<div id="sitesInfoDlg" class="easyui-dialog" style="width:400px;;height:580px;padding:10px 20px" closed="true" buttons="#sitesInfoDlg-buttons">
		<form id="siteInfoFm" method="post" novalidate>
			<div class="fitem"><label>area_id</label><input name="area_id"  class="easyui-textbox"  disabled="disabled"/></div>
			<div class="fitem"><label>地区名</label><input name="area_name" class="easyui-textbox" required="true"></div>
			<div class="fitem"><label>拼音字母:</label><input name="name_spell" class="easyui-textbox"></div>
			<div class="fitem"><label>所属城市名</label><input name="city_name" class="easyui-textbox" ></div>
			<div class="fitem"><label>网址</label><input name="area_url" class="easyui-textbox" ></div>
			<div class="fitem"><label>title</label><input name="title" class="easyui-textbox" ></div>
			<div class="fitem"><label>keywords</label><input name="keywords" class="easyui-textbox" ></div>
			<div class="fitem"><label>description</label><input name="description" class="easyui-textbox" ></div>
			<div class="fitem"><label>网站名</label><input name="web_name" class="easyui-textbox" ></div>
			<div class="fitem"><label>2345天气代码</label><input name="2345_weather" class="easyui-textbox" ></div>
			<div class="fitem"><label>首页滚动图片HTML</label><input name="roll_box_img_src" class="easyui-textbox" ></div>
			<div class="fitem"><label>首页登陆右边HTML</label><input name="famouse_user" class="easyui-textbox" ></div>
			<div class="fitem"><label>联系我们HTML</label><input name="connect_us" class="easyui-textbox" ></div>
			<div class="fitem"><label>创建时间</label><input name="create_time" class="easyui-textbox" disabled="disabled" ></div>
		</form>
    </div>
	<!--弹出框 摁扭-->
	<div id="sitesInfoDlg-buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveSite()" style="width:90px">保存</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#sitesInfoDlg').dialog('close')" style="width:90px">取消</a>
    </div>
		
<script>
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
		function newSite(){
			$('#sitesInfoDlg').dialog('open').dialog('setTitle','新增分站');
			$('#siteInfoFm').form('clear');
			url = 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/benben/updateSiteInfo';
		}
		function editSite(){
			var row = $('#sitesInfoTable').datagrid('getSelected');
			if (row){
				$('#sitesInfoDlg').dialog('open').dialog('setTitle','修改分站信息');
				$('#siteInfoFm').form('load',row);
				url = 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/benben/updateSiteInfo?area_id='+row.area_id;
			}
		}
		function saveSite(){
			$('#siteInfoFm').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
			success: function(result){
						var result = eval('('+result+')');
						if (result.errorMsg){
							$.messager.show({title: 'Error',msg: result.errorMsg});
						} else {
							$('#sitesInfoDlg').dialog('close'); // close the dialog
							$('#sitesInfoTable').datagrid('reload'); // reload the user data
						}
					}
			});
		}
	
		function destroySite(){
			var row = $('#sitesInfoTable').datagrid('getSelected');
			if (row){
				$.messager.confirm('确认删除','确定要删除['+row.area_name+']站的信息吗?',function(r){
				if (r){
					$.post('http://<?php echo ($_SERVER['SERVER_NAME']); ?>/benben/deleteSiteInfo',{area_id:row.area_id},function(result){
						if (result.success){
							$('#sitesInfoTable').datagrid('reload'); // reload the user data
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
			$('#sitesInfoTable').datagrid('load',{
				searchValue: $('#searchValue').val()
			});
		}
		$('#sitesInfoTable').datagrid({onDblClickRow: function (rowIndex, rowData) { //■■■■■■■■■■■■■■■■■■■■■■双击表
				  //window.open('home-faq-faqShow?id='+rowData.id);
				}       
		}); 
</script>	
<style type="text/css">
    #siteInfoFm{
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