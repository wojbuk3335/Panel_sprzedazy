 $(document).ready(function(){
	document.querySelectorAll('.dropdown-menu1').forEach(function(el) {
		el.style.display = 'none';
	});
	
	document.querySelectorAll('.dropdown-menu2').forEach(function(el) {
		el.style.display = 'none';
	});

	// Show hide popover
	$(".dropdown1").click(function(){
		$(this).find(".dropdown-menu1").toggle();
	});
		
	// Show hide popover
	$(".dropdown2").click(function(){
		$(this).find(".dropdown-menu2").toggle();
	});

	$(".menu").on("click","li",function(){
			var tabsId=$(this).attr("id");
			$(this).addClass("active").siblings().removeClass("active");
			$("#"+tabsId+"-content-box").addClass("active").siblings().removeClass("active");
	});
});
	
$(document).on("click", function(event){
	var $trigger = $(".dropdown1");
	if($trigger !== event.target && !$trigger.has(event.target).length){
		$(".dropdown-menu1").slideUp("fast");
	}            
});
	
$(document).on("click", function(event){
	var $trigger = $(".dropdown2");
	if($trigger !== event.target && !$trigger.has(event.target).length){
		$(".dropdown-menu2").slideUp("fast");
	}            
});
	
