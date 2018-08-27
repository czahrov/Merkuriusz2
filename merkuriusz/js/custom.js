$(function(){
	
	/* slider - najnowsze produkty */
	(function(){
		var owl = $("#product-slider");
		owl.owlCarousel({
			items: 4,
			/* itemsDesktop: [1184, 3],
			itemsDesktopSmall: [976, 2],
			itemsTablet: [752, 1], */
			pagination: false,
		});
		
		$(".fifth-container .next").click(function () {
			owl.trigger('owl.next');
		});
		
		$(".fifth-container .prev").click(function () {
			owl.trigger('owl.prev');
		});
		
		jQuery(".fifth-container .arrow-circle.prev").click(function () {
			jQuery(".fourth-container .bx-controls-direction .bx-prev").trigger("click");
		});
		
		jQuery(".fifth-container .arrow-circle.next").click(function () {
			jQuery(".fourth-container .bx-controls-direction .bx-next").trigger("click");
		});
		
	})();
	
	/* slider - vip elektronika */
	(function(){
		var realThumbSlider = jQuery(".avialable-product-slider").bxSlider({});
		jQuery(".avialable-product-section .arrow-circle.left").click(function () {
			jQuery(".avialable-product-section .bx-controls-direction .bx-prev").trigger("click");
		});
		
		jQuery(".avialable-product-section .arrow-circle.right").click(function () {
			jQuery(".avialable-product-section .bx-controls-direction .bx-next").trigger("click");
		});
		
	})();
	
	/* slider - partnerzy */
	(function(){
		var owl = $("#owl-demo");
		owl.owlCarousel({
			items: 7,
			itemsDesktop: [1184, 4],
			itemsDesktopSmall: [976, 3],
			pagination: false,
		});
		$(".next").click(function () {
			owl.trigger('owl.next');
		})
		$(".prev").click(function () {
			owl.trigger('owl.prev');
		})
		
	})();
	
	/* slider - katalogi pdf */
	(function(){
		var owl = $("#category-item-slider");
		owl.owlCarousel({
			items: 4,
			itemsDesktop: [1184, 3],
			itemsDesktopSmall: [976, 2],
			itemsTablet: [752, 1],
			pagination: false,
		});
		$(".category-blocks .fifth-container .next").click(function () {
			owl.trigger('owl.next');
		})
		$(".category-blocks .fifth-container .prev").click(function () {
			owl.trigger('owl.prev');
		})
		
	})();
	
	$(".vip-menu-block").click(function () {
		if ($(".vip-menu").hasClass("active")) {
			$(".vip-menu").removeClass("active");
		}
		else {
			$(".vip-menu").addClass("active");
		}
	});
	
	/* szerokość slidera głównego na home-page */
	(function( menu, slider ){
		$(window).resize( function( e ){
			if( window.innerWidth >= 992 ){
				slider
				.css({
					marginLeft: menu.outerWidth( true ),
				});
				
			}
			else{
				slider
				.css({
					marginLeft: 0,
				});
			}
			
		} )
		.resize();
		
	})(
		$('body.home-page #Nav-container'),
		$('body.home-page #demo')
	);
	
	/* newsletter */
	(function( panel, form, input, button, status ){
		var unreg = false;
		
		panel
		.on({
			init: function( e ){
				status.hide();
				
			},
			msg: function( e, stat, msg ){
				status
				.removeClass( 'pass info fail' )
				.addClass( stat )
				.children( '.msg' )
				.html( msg );
				
				status.slideDown();
				
			},
			send: function( e ){
				var url = "newsletter?@mode@=@data@";
				
				$.ajax({
					type: 'GET',
					url: url.replace( /@mode@/, unreg===false?( 'add' ):( 'unreglink' ) ).replace( /@data@/, input.val().trim() ),
					success: function( data ){
						try{
							var resp = JSON.parse( data );
							panel.triggerHandler( 'msg', [ resp.status, resp.msg ] );
							
							if( resp.status === 'info' ){
								unreg = true;
								
							}
							else{
								unreg = false;
								
							}
							
						}
						catch( err ){
							console.error( err );
							console.info( data );
							panel.triggerHandler( 'msg', [ 'fail', 'Błąd odpowiedzi serwera.<br>Proszę spróbować ponownie za chwilę.' ] );
							
						}
						
					},
					error: function(){
						panel.triggerHandler( 'msg', [ 'fail', 'Nie udało się nawiązać połączenia z serwerem.<br>Spróbuj ponownie za chwilę.' ] );
						
					},
					
				});
				
			},
			
		});
		
		panel.triggerHandler( 'init' );
		
		button.click( function( e ){
			// panel.triggerHandler( 'send' );
			
		} );
		
		status.click( function( e ){
			$(this).slideUp();
			
		} );
		
		input.change( function( e ){
			unreg = false;
			
		} );
		
		form
		.on({
			submit: function( e ){
				console.log('submit');
				e.preventDefault();
				panel.triggerHandler( 'send' );
			},
			
		})
		
	})
	(
		$( '#newsletter' ), 
		$( '#newsletter form' ), 
		$( '#newsletter form > .mail' ), 
		$( '#newsletter form > .send' ), 
		$( '#newsletter .status' ) 
	);
	
	/* tabela rozmiarów falk&ross */
	(function( colors ){
		colors.click( function( e ){
			$(this).next('.prop').show();
			colors.not( $(this) ).next('.prop').hide();
			
		} );
		
	})
	(
		$('#frtable .color')
	);
	
})