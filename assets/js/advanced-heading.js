(function ($) {	
	var elb_heading_init = function ($scope, $) {
		$('.elb-heading-title[data-blur-type="animation_blurred"]').each(function(){
			var elm = $(this); 
			var holdTime = elm.attr('data-blur-holdtime') * 1000;
			elm.attr('data-animation-blur','process')				
			elm.find('.elb-hd-letter').each(function(index,letter){
				index += 1;
				var animateDelay = index/20 + 's';
				$(letter).css({'-webkit-animation-delay':animateDelay, 'animation-delay':animateDelay});
			})
			setInterval(function(){
				elm.attr('data-animation-blur','done')				
				setTimeout(function(){
					elm.attr('data-animation-blur','process')
				},150);		
			},holdTime);	
		});
		$('.elb-heading-title[data-blur-type="random_blurred"]').each(function(){
			var elm = $(this); 
			var numLetters = elm.find('.elb-hd-letter').length;		
			var holdTime = elm.attr('data-blur-holdtime') * 1000;
			setInterval(function(){
				var indexChild = (Math.floor(Math.random()*numLetters)+1);				
				elm.find('span:nth-child('+indexChild+')').css({'text-shadow' : '0 0 '+(Math.floor(Math.random()*35)+4)+'px var(--current-color)'});
			},holdTime);		
		});
	};

	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/elb-heading-widget.default', elb_heading_init);
	});
	
})(jQuery);	

