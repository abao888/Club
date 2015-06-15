$(function(){
   $('#widgettest').click(function(){
        alert('widget is good!');
   });
});	


$(function(){
	$('#mydrop').click(function(){
		var $drop=$(".dropdown-menu");
		if($drop.is(":visible")){
		 $(".dropdown-menu").hide(500);
		}else{
		 $(".dropdown-menu").show(500);
		}
	});
	
});