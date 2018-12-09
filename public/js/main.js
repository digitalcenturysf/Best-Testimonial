(function( $ ) {
	'use strict'; 
	/*----------------------------
	bestt Testimonial
	------------------------------ */  
	$(".bestt-testimonial").owlCarousel({
		autoPlay: true, 
		slideSpeed:2000,
		pagination:true,
		navigation:false,	  
		items : 1, 
		navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
		itemsDesktop : [1199,1],
		itemsDesktopSmall : [980,1],
		itemsTablet: [768,1],
		itemsMobile : [479,1],
	}); 

	/*----------------------------
	bestt2 Testimonial
	------------------------------ */  
	$(".bestt2-testimonial").owlCarousel({
	    autoPlay: true, 
	  slideSpeed:2000,
	  pagination:true,
	  navigation:false,	  
	    items : 1, 
	  navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
	    itemsDesktop : [1199,1],
	  itemsDesktopSmall : [980,1],
	  itemsTablet: [768,1],
	  itemsMobile : [479,1],
	});


})( jQuery );
