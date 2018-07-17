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
	)
	
});