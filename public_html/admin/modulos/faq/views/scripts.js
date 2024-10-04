$(window).on('load', function(){
	if ($('#faq-accordion').length){
		$('#faq-accordion').accordion({collapsible: true,active: false});
		$('#faq-accordion').on( "click", function( event, ui ) {
			setTimeout(function(){
				var activeIndex = $("#faq-accordion" ).accordion( "option", "active" );
				$('html, body').animate({ scrollTop: ($('#faq-accordion .item-h').eq(activeIndex).offset().top - 120)}, 'slow');
			},500);
		} );
	};
});