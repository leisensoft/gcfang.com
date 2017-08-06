
$(".yuan_login_button").hover(function(){
	$(this).css("border","3px solid black");
	$(this).css("color","black");
 },function(){
	$(this).css("border","2px solid #C0C0C0");
	$(this).css("color","white");
 }); 
 
 $("#advantage").hover(function(){
	$(this).css("color","black");
 },function(){
	$(this).css("color","white");	
 }); 
/*列表hover*/
 $(".info_li").hover(function(){
	//$(this).css("background-color","#F2F2F2");
 },function(){
	//$(this).css("background-color","white");
 }); 
 
/*监听tab*/
$('#index_tabs').tabs({
        onSelect: function () {
			getMoreHouseList();
        }
});
/*下拉翻页监听*/
$(document).ready(function() {
	$(window).scroll(function() {
		//if ($(document).scrollTop()<=0){alert("滚动条已经到达顶部为0");}
		if ($(document).scrollTop() >= $(document).height() - $(window).height() ) {
			//getMoreHouseList();
		}
	});
});	
/*左滚动中介*/
$(function(){ 
    $('#Marquee_x').jcMarquee({ 'marquee':'x','margin_right':'10px','speed':50 }); 
    // DIVCSS5提示：10px代表间距，第二个20代表滚动速度 
}); 
 


 
