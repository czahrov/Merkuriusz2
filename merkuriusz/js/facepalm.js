$(function(){
	
	/* popup slider pdf */
	(function( popup, box, close, pages, slider, items ){
		popup
		.on({
			open: function( e, num ){
				pages.eq(num).addClass('open');
				popup.addClass('open');
				
			},
			close: function( e ){
				popup.removeClass('open');
				pages.removeClass('open');
				
			},
			click: function( e ){
				$(this).triggerHandler('close');
				
			},
			
		});
		
		close.click( function( e ){
			popup.triggerHandler('close');
			
		} );
		
		box.click( function( e ){
			e.stopPropagation();
			
		} );
		
		items.click( function( e ){
			var self = $(this);
			if( $(this).children('.hitbox').length == 0 ){
				popup.triggerHandler( 'open', [ self.closest('.owl-item').index() ] );
				
			}
			
		} );
		
	})
	(
		$('#pdf-popup'),
		$('#pdf-popup .box'),
		$('#pdf-popup .box .exit'),
		$('#pdf-popup .box .view .page'),
		$('#category-item-slider'),
		$('#category-item-slider .item.inner'),
	);
	
	/* galeria w widoku produktu */
	(function( main, imgs, navs ){
		var current = 0;
		
		imgs.click( function( e ){
			var self = $(this);
			
			main
			.css({
				backgroundImage: function(){
					var url = self.css('background-image').match(/http[^"]+/)[0];
					current = self.parent().index();
					return "url("+ url +")";
					
				},
				
			});
			
		} );
		
		navs.click( function( e ){
			switch( $(this).index() ){
				case 0:
					current--;
				break;
				case 1:
					current++;
				break;
			}
			
			if( current < 0 ) current = imgs.length - 1;
			current %= imgs.length;
			
			main
			.css({
				backgroundImage: function(){
					var url = imgs.eq( current ).css('background-image').match(/http[^"]+/)[0];
					return "url("+ url +")";
					
				},
				
			});
			
		} );
		
	})
	(
		$('.category-single-product .single-product-image:not(.item)'),
		$('.category-single-product .single-product-gallery .single-product-img1'),
		$('.category-single-product .single-product-arrows a')
	);
	
	/* filtrowanie kafelków i popup */
	(function( popup, box, close, popup_title, kafelki, filters, items ){
		var duration = .5;
		var popup_anim;
		
		/* animacja popupu */
		(function(){
			popup_anim = new TimelineLite({
				paused: true,
				onStart: function(){
					popup.addClass( 'open' );
					
				},
				onReverseComplete: function(){
					popup.removeClass( 'open' );
					
				},
				
			})
			.add( 'start', 0 )
			.add(
				TweenLite.fromTo(
					popup,
					duration,
					{
						opacity: 0,
					},
					{
						opacity: 1,
					}
				), 'start'
			)
			.add(
				TweenLite.fromTo(
					box,
					duration,
					{
						opacity: 0,
						yPercent: -100,
					},
					{
						opacity: 1,
						yPercent: 0,
						ease: Power2.easeInOut,
					}
				), 'start+=.3'
			)
			
		})();
		
		popup.on({
			open: function( e, item ){
				var title = $( item ).find( '.title' ).text().trim();
				var img = $( item ).find( '.img' ).attr( 'img' );
				// console.log( item );
				box.css( 'background-image', 'url('+ img +')' );
				popup_title.text( title );
				popup_anim.play();
				
			},
			close: function( e ){
				popup_anim.reverse();
				
			},
			wheel: function( e ){
				e.preventDefault();
				
			},
			
		});
		
		popup
		.add( close )
		.click( function( e ){
			popup.triggerHandler( 'close' );
			
		} );
		
		box.click( function( e ){
			e.stopPropagation();
			
		} );
		
		kafelki.on({
			set: function( e, name ){
				// console.log( name );
				var t = items.filter( '[cats*="'+ name +'"]' );
				// console.log( t );
				// console.log( t.siblings() );
				
				/* t.fadeIn( function(){
					items
					.not( t )
					.fadeOut();
					
				} ); */
				
				new TimelineLite()
				.add( 'start', 0 )
				.add( function(){
					items
					.not( t )
					.fadeOut( 300 );
					
				}, 'start' )
				.add( function(){
					t.fadeIn( 300 );
					
				}, 'start+=0.3' )
				
				
				
			},
			
		});
		
		filters.click(function( e ){
			var cat = $(this).attr( 'cat' );
			kafelki.triggerHandler( 'set', cat );
			$(this).addClass( 'active' ).siblings().removeClass( 'active' );
			
		});
		
		items.click(function( e ){
			popup.triggerHandler( 'open', $(this) );
			
		});
		
	})
	( 
		$( '#oferta > .popup_oferta' ), 
		$( '#oferta > .popup_oferta > .box' ), 
		$( '#oferta > .popup_oferta > .box .btn-close' ), 
		$( '#oferta > .popup_oferta > .box .title' ), 
		$( '#oferta > .box' ), 
		$( '#oferta > .box .filters > .item' ), 
		$( '#oferta > .box  .kafelki > .item' ) 
	);
	
	/* kalkulator znakowania */
	(function( form, segments, inputs ){
		form
		.on({
			calc: function( e ){
				$.post(
					'',
					form.serializeArray(),
					function( data, status ){
						// console.log( data );
						var t = segments.filter('.summary').find('.body');
						t
						.fadeOut( 'fast', function(){
							$(this)
							.empty()
							.html( data )
							.fadeIn( 'fast' )
							
						} )
						
					}
				);
				
			},
			submit: function( e ){
				e.preventDefault();
				
			},
			
		});
		
		segments.filter('.type').find('select').change( function( e ){
			var prepare_a = [ 'S1', 'S2', 'S3', 'L1', 'L2', 'L3', 'CO2' ];
			var matrice_a = [ 'TŁ' ];
			var color_a = [ 'TT1', 'TT2', 'S1', 'S2', 'S3', 'T1', 'T2', 'T3', 'T4', 'K1', 'K2' ];
			
			if( prepare_a.indexOf( $(this).val() ) > -1 ){
				segments.filter('.prepare').slideDown();
			}
			else{
				segments.filter('.prepare').slideUp();
			}
			
			if( matrice_a.indexOf( $(this).val() ) > -1 ){
				segments.filter('.matrice').slideDown();
			}
			else{
				segments.filter('.matrice').slideUp();
			}
			
			if( color_a.indexOf( $(this).val() ) > -1 ){
				segments.filter('.colors').slideDown();
			}
			else{
				segments.filter('.colors').slideUp();
			}
			
		} );
		
		inputs.change( function( e ){
			form.triggerHandler('calc');
			
		} );
		
		form.triggerHandler('calc');
		
	})
	(
		$('form.kalkulator'),
		$('form.kalkulator .segment'),
		$('form.kalkulator .segment').find('input, select')
	);
	
});