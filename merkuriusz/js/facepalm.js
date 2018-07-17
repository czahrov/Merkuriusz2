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
	
});