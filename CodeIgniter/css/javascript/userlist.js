
$(document).ready(function(){
	$("#usersonline li").click(function(){
	  window.location=$(this).find("a").attr("href"); return false;
	});
});