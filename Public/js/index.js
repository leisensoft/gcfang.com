
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
/*�б�hover*/
 $(".info_li").hover(function(){
	//$(this).css("background-color","#F2F2F2");
 },function(){
	//$(this).css("background-color","white");
 }); 
 
/*����tab*/
$('#index_tabs').tabs({
        onSelect: function () {
			getMoreHouseList();
        }
});
/*������ҳ����*/
$(document).ready(function() {
	$(window).scroll(function() {
		//if ($(document).scrollTop()<=0){alert("�������Ѿ����ﶥ��Ϊ0");}
		if ($(document).scrollTop() >= $(document).height() - $(window).height() ) {
			//getMoreHouseList();
		}
	});
});	
/*������н�*/
$(function(){ 
    $('#Marquee_x').jcMarquee({ 'marquee':'x','margin_right':'10px','speed':50 }); 
    // DIVCSS5��ʾ��10px�����࣬�ڶ���20��������ٶ� 
}); 
 


 
