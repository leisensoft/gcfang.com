<?php if (!defined('THINK_PATH')) exit();?><div id="content">	
<div title="发布房源" style="padding:10px">
							 <form id="add_house_form" method="post" class="easyui-form" data-options="novalidate:true">
							<div style="margin-left:50px;">
								<ul class="dowebok">
									<li><input type="radio" name="sell_type" field="sell_type" value="1" checked="checked" >出 售</li>&nbsp;&nbsp;&nbsp;
									<li><input type="radio" name="sell_type" field="sell_type" value="2" >出 租</li>
								</ul>
								<ul class="dowebok">
									<li><input type="radio" name="house_type" field="house_type" value="1" checked="checked" >二手房</li>&nbsp;&nbsp;&nbsp;
									<li><input type="radio" name="house_type" field="house_type" value="2" >门市/厂房</li>&nbsp;&nbsp;&nbsp;
									<li><input type="radio" name="house_type" field="house_type" value="3" >车库/车位</li>
								</ul>
								<div class="my_input">
									标 题:
									<input style="width:305px;" class="easyui-textbox" type="text" id="title" field="title" name="title"  data-options="required:true"></input>
								</div>
								<div class="my_input">小区或街道名称:
<style>
/*搜索loading图片*/
.textbox-addon-right{width:0px;}
.combo-arrow {background: transparent url("../Public/icon/loading.gif") no-repeat scroll center center;}
</style>
									<input  name="zone_id" field='zone_id'   class="easyui-combobox" style="height:26px;width:220px;" data-options="
																loader: myloader,
																mode: 'remote',
																valueField: 'id',
																textField: 'text',
																formatter: formatItem,
																panelHeight:'auto',
																required:true,
																">	</input>
								</div>
								<div class="my_input">
									面 积:
									<input style="width:100px;" class="easyui-textbox" type="text" id="size" field="size" name="size"  data-options="required:true"></input>
									平方米
								</div>
								<div class="my_input">
									价 格:
									<input style="width:100px;" class="easyui-textbox" type="text" field="price" id="price" name="price" ></input>
									<span style="font-size:14px;">(价格面议请留空)</span>
								</div>
								<div class="my_input">
									<div sytle="margin-bottom:10px;">详细描述:<span style="font-size:14px;">(可自定义内容,也可从word直接粘贴文字)</span></div>
										<script type="text/plain" id="myEditor" style="width:686px;height:240px;">
													<p>&nbsp;房屋户型：室 厅 卫</p> 
													<p>&nbsp;所在楼层：楼</p> 
													<p>&nbsp;房屋概况：</p> 
													<p>&nbsp;其他：</p>
										</script>
									    <script type="text/javascript">
										//var um = UM.getEditor('myEditor');//实例化编辑器
											$(function() {          
											var um = UM.getEditor('myEditor', { 
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
								<div  class="my_input">
									<div style="float:left;line-height:60px;">增值服务:</div>
									<div style="float:left;">
										<ul class="dowebok">
											<li><input type="checkbox" value="1"  name="tag_is_top" field="tag_type" >首页置顶(1元/天)</li>&nbsp;&nbsp;&nbsp;
											<li><input type="checkbox" value="1"  name="tag_is_hurry" field="tag_type"  >加急红字(0.5元/天)</li>
										</ul>
									</div>
									<div id="tag_days" style="display:block;float:left;line-height:60px;">
										天数:<input class="easyui-numberspinner" value="1" name="days" data-options="min:1,max:30" style="width:45px;"></input>
										<a style="color:#45A21C;">充值</a></span>
									</div>
								</div>
								<div style="clear:both;"></div>
								<div style="background-color:#DA5E43;" class="yuan_logo_button" >
									<div id="submitButton" style="margin:10px 0 0 5px;" onclick="submitAddHouseForm();">确认发布</div>
								 </div>
							</div>
						 </form>
						</div>
<script>
		//■■■■■■■■■■■■■■■■■■■■■■add_house_form 提交房源信息
 function submitAddHouseForm(){
		$.messager.progress();
		$('#add_house_form').form('submit',{
			url: 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/house/userAddHouse',
			onSubmit: function(){
				var isValid = $(this).form('enableValidation').form('validate');
				if (!isValid){
					$.messager.progress('close');	
				}
				return isValid;	// return false will stop the form submission	 
			},
			success: function(result){
					$.messager.progress('close');	
					var result = eval('('+result+')');
					if (result.errorMsg){
						$.messager.alert('问题提示',result.errorMsg,"error");
					} else {
						$('#add_house_form').form('reset'); 
						$.messager.confirm('修改房源成功','要查看修改后的房源信息吗?',function(r){
							if (r){
								window.open('http://<?php echo ($_SERVER['SERVER_NAME']); ?>/house/detail/id/'+result.house_id+'.html');
							}
						});	  
					}
			}
		});
	}
//■■■■■■■■■■■■■■■■■■■■■■auto complete
var myloader = function(param,success,error){  
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
</script>
</div>