$(document).ready(function() {

	var get = window.location.pathname;
	
	page = get.replace('/','');

	page = (page=='') ? 'index' : page;
	
	$("#link-"+page).attr('class', 'hover');

	//$('#projetos li').hover(preview(this));
	
	/*
	$("#projetos li").hover(
		function() {
			item = this.id;
			flechaTooltip(item);
		}
	) 
	*/

	/***************************
	 * tabs/accordion alternando 
	 ***************************/
	 
	$("div.slide-tabs").tabs("div.slide-items > div", { 
	
		effect: 'fade',
		//effect: 'horizontal', 
		rotate: true,
		fadeInSpeed: 1000,
		fadeOutSpeed: 0
 
    // use the slideshow plugin. It accepts its own configuration 
    }).slideshow( {	autoplay: true, interval: 10000 } );
    
/*
	$("#home-banner").accordion();

	window.setInterval(function() {
		var actual = $('#home-banner').accordion('option', 'active');
		var next   = (actual==2) ? 0 : (actual+1);		
		$('#home-banner').accordion('option', 'active', next);
		$('#home-banner').accordion('activate', next);
	}, 5000);
*/


	/******************************
	 * tooltip projetos/portifolio
	 * ****************************/
    
    $("#projetos img").tooltip({

			onBeforeShow: function() {
				var opt    = this.getTrigger(); 
				var optID  = opt.attr('id').replace('projeto-','');
				
				$.ajax({
					type: "GET",
					url: "/projeto/"+optID+'/1',
					success: function(msg){
						$("#tooltip-projeto").html(msg);
					}
				}); 
				
			}, 

    		effect:    'slide',
    		direction: 'left',
    		tip:       '#tooltip-projeto'
    });  


});


/* 
 * 
 * 
 * teste tooltip flecha - nao implementado */

function preview(e) {
	$("body").append("<p id='screenshot'>teste</p>");								 
	$("#screenshot")
		.css("top",(e.pageY - 10) + "px")
		.css("left",(e.pageX + 30) + "px")
		.fadeIn("fast");
}

function flechaTooltip(item) {
	
	console.log('teste:'+item);
    alert(item);
    
    $("#"+item).tooltip({
			/*
			onBeforeShow: function() {
				var opt = this.getTrigger(); 
				tooltipdiv = opt.id(); 
			}, 
    	 	*/

    		effect:    'slide',
    		direction: 'left',
    		tip:       '#tooltip-' + item
    });  
	
}