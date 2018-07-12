$(function(){
	jQuery(".fifth-container .arrow-circle.prev").click(function () {
		jQuery(".fourth-container .bx-controls-direction .bx-prev").trigger("click");
	});
	jQuery(".fifth-container .arrow-circle.next").click(function () {
		jQuery(".fourth-container .bx-controls-direction .bx-next").trigger("click");
	});

	var realThumbSlider = jQuery(".avialable-product-slider").bxSlider({});
	jQuery(".avialable-product-section .arrow-circle.left").click(function () {
		jQuery(".avialable-product-section .bx-controls-direction .bx-prev").trigger("click");
	});
	jQuery(".avialable-product-section .arrow-circle.right").click(function () {
		jQuery(".avialable-product-section .bx-controls-direction .bx-next").trigger("click");
	});

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

	var owl = $("#product-slider");
	owl.owlCarousel({
		items: 3,
		itemsDesktop: [1184, 3],
		itemsDesktopSmall: [976, 2],
		itemsTablet: [752, 1],
		pagination: false,
	});
	$(".fifth-container .next").click(function () {
		owl.trigger('owl.next');
	})
	$(".fifth-container .prev").click(function () {
		owl.trigger('owl.prev');
	})
	
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
	
	$(".vip-menu-block").click(function () {
		if ($(".vip-menu").hasClass("active")) {
			$(".vip-menu").removeClass("active");
		}
		else {
			$(".vip-menu").addClass("active");
		}
	});
	
})