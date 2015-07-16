var tooltipDiv;
$(function(){
	$("*[tooltip='on']").hover(function(){
		
		var tooltip_div = "";
		var eHeight = $(this).height();
		var eWidth = $(this).width();
		var tip = $(this).data("tooltip");
		
		tooltip_div += '<div class="tooltip" style="position:absolute;top:-'+ (eHeight * 2 + 20) +'px; right: -10px;">';
		tooltip_div += '<div class="tooltip_holder" style="position:relative;">';
		tooltip_div += '<div class="arrow_down" style="position:absolute; bottom:-10px; right:10px;"></div>';
		tooltip_div += tip;
		tooltip_div += '</div>';
		tooltip_div += '</div>';
		
		$(this).css("cursor","help");
		tooltipDiv = $(tooltip_div).appendTo(this);
	}, function(){ 
		tooltipDiv.remove();
	});
});