(function($, document, window){
	
	$(document).ready(function(){

		// Cloning main navigation for mobile menu
		$(".mobile-navigation").append($(".main-navigation .menu").clone());

		// Mobile menu toggle 
		$(".menu-toggle").click(function(){
			$(".mobile-navigation").slideToggle();
		});

		$(".graduates").flexslider({
			animation:"slide",
			smoothHeight:true,
			controlNav: false,
			directionNav: true,
			prevText:'<i class="fa fa-angle-left"></i>',
			nextText:'<i class="fa fa-angle-right"></i>',
		});
	});

	$(window).load(function(){

	});

})(jQuery, document, window);