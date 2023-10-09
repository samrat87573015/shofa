(function ($) {
	"use strict";
	

	var windowOn = $(window);

	$(window).on('load', function () {

		$('#preloader').delay(350).fadeOut('slow');
	
		$('body').delay(350).css({ 'overflow': 'visible' });
	
	})

	// menu last item
	$('.main-menu nav > ul > li').slice(-3).addClass('menu-last');

	// mega menu class add
	$('.has-megamenu > ul.submenu ').addClass('mega-menu');

	// mega menu class add
	$('.has-megamenu > ul.mega-menu ul ').removeClass('submenu');

	// mega menu class add
	$('.has-megamenu ul.mega-menu li.has-dropdown > a ').addClass('mega-menu-title');




	////////////////////////////////////////////////////
	//  00. Sticky Header Js
	windowOn.on('scroll', function () {
		var scroll = $(window).scrollTop();
		if (scroll < 100) {
			$("#header-sticky,#header-mob-sticky,#header-tab-sticky").removeClass("header-stickys");
		} else {
			$("#header-sticky,#header-mob-sticky,#header-tab-sticky").addClass("header-stickys");
		}
	});



	///////////////////////////////////////////////////
	// 01.  Scroll to top
	windowOn.on('scroll', function () {
		var scroll = windowOn.scrollTop();
		if (scroll < 245) {
			$('.scroll-to-target').removeClass('open');

		} else {
			$('.scroll-to-target').addClass('open');
		}
	});

	///////////////////////////////////////////////////
	// 02. Scroll Up Js
	if ($('.scroll-to-target').length) {
		$(".scroll-to-target").on('click', function () {
		var target = $(this).attr('data-target');
		// animate
		$('html, body').animate({
			scrollTop: $(target).offset().top
		}, 1000);
	
		});
	}

	////////////////////////////////////////////////////
	// 03. Data CSS Js
	$("[data-background").each(function () {
		$(this).css("background-image", "url( " + $(this).attr("data-background") + "  )");
	});

	$("[data-width]").each(function () {
		$(this).css("width", $(this).attr("data-width"));
	});

	$("[data-bg-color]").each(function () {
		$(this).css("background-color", $(this).attr("data-bg-color"));
	});



	////////////////////////////////////////////////////
	// 04. Nice Select Js
	$('select').niceSelect();


	////////////////////////////////////////////////////
	// 05. Mobile Menu Js
	$('#mobile-menu').meanmenu({
		meanMenuContainer: '.mobile-menu',
		meanScreenWidth: "1199",
		meanExpand: ['<i class="fal fa-plus"></i>'],
	});


	$(".tp-cat-toggle").on("click", function () {
		$('.category-menu').slideToggle(500);
	});


	////////////////////////////////////////////////////
	// 06. Sidebar Js
	$(".tp-menu-toggle").on("click", function () {
		$(".tpsideinfo").addClass("tp-sidebar-opened");
		$(".body-overlay").addClass("opened");
	});
	$(".tpsideinfo__close").on("click", function () {
		$(".tpsideinfo").removeClass("tp-sidebar-opened");
		$(".body-overlay").removeClass("opened");
	});
	$(".body-overlay").on("click", function () {
		$(".tpsideinfo").removeClass("tp-sidebar-opened");
		$(".body-overlay").removeClass("opened");
	});

		////////////////////////////////////////////////////
	// 06. search active
	$(".search_icon").on("click", function () {
		$(".search_modal").addClass("active");
		$(".body-overlay").addClass("opened");
	});
	$("#search_model_close").on("click", function () {
		$(".search_modal").removeClass("active");
		$(".body-overlay").removeClass("opened");
	});

	$(".body-overlay").on("click", function () {
		$(".search_modal").removeClass("active");
		$(".body-overlay").removeClass("opened");
	});


	////////////////////////////////////////////////////
	// 07. Sidebar Js
	$(".tp-cart-toggle").on("click", function () {
		$(".tp-cart-info-area").addClass("tp-sidebar-opened");
		$(".cartbody-overlay").addClass("opened");
	});
	$(".tpcart__close").on("click", function () {
		$(".tp-cart-info-area").removeClass("tp-sidebar-opened");
		$(".cartbody-overlay").removeClass("opened");
	});
	$(".cartbody-overlay").on("click", function () {
		$(".tp-cart-info-area").removeClass("tp-sidebar-opened");
		$(".cartbody-overlay").removeClass("opened");
	});


	////////////////////////////////////////////////////
	// 08. Slider Js
	var sliderswiper = new Swiper('.slider-active', {
		// Optional parameters
		loop: true,
		slidesPerView: 1,
		effect: "fade",
		autoplay: {
			delay: 4500,
			disableOnInteraction: true,
		},
		pagination: {
			el: ".slider-pagination",
			clickable: true,
		},
	});


	////////////////////////////////////////////////////
	// 09. Price Filter Js
	if ($("#slider-range").length) {

		$("#slider-range").slider({

			range: true,

			min: 0,

			max: 1000,

			values: [0, 500],

			slide: function (event, ui) {

				$("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);

			}

		});

		$("#amount").val("$" + $("#slider-range").slider("values", 0) +

			" - $" + $("#slider-range").slider("values", 1));

		$('#filter-btn').on('click', function () {

			$('.filter-widget').slideToggle(1000);

		});

	}


		////////////////////////////////////////////////////
	// 10. Swiper Js
	$('.cart-minus').on('click', function () {
		var $input = $(this).parent().find('input');
		var count = parseInt($input.val()) - 1;
		count = count < 1 ? 1 : count;
		$input.val(count);
		$input.change();
		return false;
	});

	$('.cart-plus').on('click', function () {
		var $input = $(this).parent().find('input');
		$input.val(parseInt($input.val()) + 1);
		$input.change();
		return false;
	});


	////////////////////////////////////////////////////
	// 11. Show Login Toggle Js
	$('#showlogin').on('click', function () {
		$('#checkout-login').slideToggle(900);
	});

	////////////////////////////////////////////////////
	// 12. Show Coupon Toggle Js
	$('#showcoupon').on('click', function () {
		$('#checkout_coupon').slideToggle(900);
	});

	////////////////////////////////////////////////////
	// 13. Create An Account Toggle Js
	$('#cbox').on('click', function () {
		$('#cbox_info').slideToggle(900);
	});

	////////////////////////////////////////////////////
	// 14. Shipping Box Toggle Js
	$('#ship-box').on('click', function () {
		$('#ship-box-info').slideToggle(1000);
	});

	////////////////////////////////////////////////////
	// 15. Slider Js
	var greensliderswiper = new Swiper('.greenslider-active', {
		// Optional parameters
		loop: true,
		slidesPerView: 1,
		fade: "effect",
		effect: 'fade',
		autoplay: {
			delay: 5000,
			disableOnInteraction: false,
		},
		pagination: {
			el: ".greenslider-pagination",
			clickable: true,
		},
	});


	////////////////////////////////////////////////////
	// 16. Slider Js
	var slidertwoswiper = new Swiper('.slidertwo-active', {
		// Optional parameters
		loop: true,
		slidesPerView: 1,
		effect: 'fade',
		autoplay: {
			delay: 5500,
			disableOnInteraction: false,
		},
		pagination: {
			el: ".slidertwo_pagination",
			clickable: true,
		},
	});


	////////////////////////////////////////////////////
	// 17. Slider Js
	var slidertwoswiper = new Swiper('.sliderthree-active', {
		// Optional parameters
		loop: false,
		effect: 'fade',
		slidesPerView: 1,
		autoplay: {
			delay: 6000,
			disableOnInteraction: false,
		},
		pagination: {
			el: ".tpsliderthree__pagination",
			clickable: true,
		},
	});


	////////////////////////////////////////////////////
	// 18. Slider Js
	var shopswiper = new Swiper('.shopslider-active', {
		// Optional parameters
		loop: true,
		slidesPerView: 6,
		spaceBetween: 25,
		centereMode: true,
		autoplay: {
			delay: 3500,
			disableOnInteraction: true,
		},
		breakpoints: {
			'1400': {
				slidesPerView: 6,
			},
			'1200': {
				slidesPerView: 5,
			},
			'992': {
				slidesPerView: 4,
			},
			'768': {
				slidesPerView: 3,
			},
			'576': {
				slidesPerView: 2,
			},
			'0': {
				slidesPerView: 1,
			},
		},
	});


	////////////////////////////////////////////////////
	// 19. Slider Js
	var shopswiper = new Swiper('.tp-team-active', {
		// Optional parameters
		loop: true,
		slidesPerView: 4,
		spaceBetween: 25,
		centereMode: true,
		autoplay: {
			delay: 3500,
			disableOnInteraction: true,
		},
		breakpoints: {
			'1400': {
				slidesPerView: 4,
			},
			'1200': {
				slidesPerView: 4,
			},
			'992': {
				slidesPerView: 3,
			},
			'768': {
				slidesPerView: 2,
			},
			'576': {
				slidesPerView: 2,
			},
			'0': {
				slidesPerView: 1,
			},
		},
	});


	////////////////////////////////////////////////////
	// 20. Slider Js
	var whitproductswiper = new Swiper('.related-product-active', {
		// Optional parameters
		loop: true,
		slidesPerView: 5,
		spaceBetween: 30,
		autoplay: {
			delay: 3500,
			disableOnInteraction: true,
		},
		breakpoints: {
			'1400': {
				slidesPerView: 5,
			},
			'1200': {
				slidesPerView: 5,
			},
			'992': {
				slidesPerView: 4,
			},
			'768': {
				slidesPerView: 2,
			},
			'576': {
				slidesPerView: 2,
			},
			'0': {
				slidesPerView: 1,
			},
		},
		// Navigation arrows
		navigation: {
			nextEl: '.tprelated__nxt',
			prevEl: '.tprelated__prv',
		},
	});


	////////////////////////////////////////////////////
	// 21. Slider Js
	var whitproductswiper = new Swiper('.product-active', {
		// Optional parameters
		loop: true,
		slidesPerView: 3,
		spaceBetween: 30,
		autoplay: {
			delay: 3500,
			disableOnInteraction: true,
		},
		breakpoints: {
			'1400': {
				slidesPerView: 3,
			},
			'1200': {
				slidesPerView: 3,
			},
			'992': {
				slidesPerView: 2,
			},
			'768': {
				slidesPerView: 2,
			},
			'576': {
				slidesPerView: 2,
			},
			'0': {
				slidesPerView: 1,
			},
		},
		// Navigation arrows
		navigation: {
			nextEl: '.tpproductarrow__nxt',
			prevEl: '.tpproductarrow__prv',
		},
	});


	////////////////////////////////////////////////////
	// 22. Slider Js
	$('[data-countdown]').each(function () {
		var $this = $(this),
			finalDate = $(this).data('countdown');
		$this.countdown(finalDate, function (event) {

			$this.html(event.strftime('<span class="cdown days"><span class="time-count">%-D</span> <p>Days</p></span> <span class="cdown hour"><span class="time-count">%-H</span> <p>Hour</p></span> <span class="cdown minutes"><span class="time-count">%M</span> <p>Minute</p></span> <span class="cdown second"> <span><span class="time-count">%S</span> <p>Second</p></span>'));
		});
	});



	////////////////////////////////////////////////////
	// 23. Brand Js
	var brandswiper = new Swiper('.brand-active', {
		// Optional parameters
		loop: true,
		slidesPerView: 6,
		spaceBetween: 30,
		freeMode: true,
		autoplay: {
			delay: 3000,
			disableOnInteraction: true,
		},
		breakpoints: {
			'1400': {
				slidesPerView: 6,
			},
			'1200': {
				slidesPerView: 4,
			},
			'992': {
				slidesPerView: 3,
			},
			'768': {
				slidesPerView: 3,
			},
			'576': {
				slidesPerView: 2,
			},
			'0': {
				slidesPerView: 1,
			},
		},
	});



	////////////////////////////////////////////////////
	// 24. product Js
	var platinamproswiper = new Swiper('.platinam-pro-active', {
		// Optional parameters
		loop: true,
		slidesPerView: 4,
		spaceBetween: 30,
		autoplay: {
			delay: 3000,
			disableOnInteraction: true,
		},
		breakpoints: {
			'1400': {
				slidesPerView: 4,
			},
			'1200': {
				slidesPerView: 3,
			},
			'992': {
				slidesPerView: 2,
			},
			'768': {
				slidesPerView: 2,
			},
			'576': {
				slidesPerView: 1,
			},
			'0': {
				slidesPerView: 1,
			},
		},
		// Navigation arrows
		navigation: {
			nextEl: '.tpplatiarrow__nxt',
			prevEl: '.tpplatiarrow__prv',
		},
	});



	///////////////////////////////////////////////////
	// 25. Magnific Js
	$(".popup-video").magnificPopup({
		type: "iframe",
	});


	////////////////////////////////////////////////////
	// 26. magnificPopup Js
	$('.popup-image').magnificPopup({
		type: 'image',
		gallery: {
			enabled: true
		}
	});

	////////////////////////////////////////////////////
	// 27. product Js
	var testiswiper = new Swiper('.testi-active', {
		// Optional parameters
		loop: true,
		slidesPerView: 3,
		spaceBetween: 30,
		autoplay: {
			delay: 3000,
			disableOnInteraction: true,
		},
		breakpoints: {
			'1400': {
				slidesPerView: 3,
			},
			'1200': {
				slidesPerView: 3,
			},
			'992': {
				slidesPerView: 3,
			},
			'768': {
				slidesPerView: 2,
			},
			'576': {
				slidesPerView: 1,
			},
			'0': {
				slidesPerView: 1,
			},
		},
		// Navigation arrows
		navigation: {
			nextEl: '.tptestiarrow__nxt',
			prevEl: '.tptestiarrow__prv',
		},
	});

	////////////////////////////////////////////////////
	// 28. Postbox Js
	var postboxswiper = new Swiper('.postbox-active', {
		// Optional parameters
		loop: true,
		slidesPerView: 1,
        spaceBetween: 0,
		autoplay: {
		  delay: 4000,
		},
		// Navigation arrows
		navigation: {
			nextEl: ".postbox-slider-button-next",
			prevEl: ".postbox-slider-button-prev",
		},
	});


	////////////////////////////////////////////////////
	// 29. Postbox Js
	var democol = $('.tpproduct [class*="col"]');
	democol.on({
		mouseenter: function () {
			$(this).siblings().stop().css('z-index', '-1');
		},
		mouseleave: function () {
			$(this).siblings().stop().css('z-index', '1');
		}
	});


	////////////////////////////////////////////////////
	// 30. Postbox Js
	var swiper = new Swiper('.swiper--top', {
		spaceBetween: 0,
		centeredSlides: true,
		speed: 30000,
		slidesPerView: 1,
		autoplay: {
			delay: 1,
		},
		loop: true,
		freeMode: true,
		slidesPerView: 'auto',
		allowTouchMove: false,
		disableOnInteraction: true,
	});

	// product details thumb slider
	$(document).ready(function() {
		$(".flex-control-thumbs").addClass("product-thumbnails");
		if ($(".woocommerce-product-gallery").hasClass("vertical") && $(window).width() > 992) {
			var verti = true;
		} else {
			var verti = false;
		}

		$('.product-thumbnails').slick({
			dots: false,
			arrows: false,
			prevArrow: '<div class="prev"><i class="far fa-angle-left"></i></div>',
			nextArrow: '<div class="next"><i class="far fa-angle-right"></i></div>',
			autoplay: false,
			Speed: 2000,
			slidesToShow: 3,
			slidesToScroll: 1,
			focusOnSelect: true,
			vertical: true,
			loop: true,
		});
	});

	
	///////////////////////////////////////////////////
	// *.  z-index to top
	var democol = $('.product-style-2 .col');
	democol.on({
		mouseenter: function () {
			$(this).siblings().stop().css('z-index', '-1');
		},
		mouseleave: function () {
			$(this).siblings().stop().css('z-index', '1');
		}
	});


})(jQuery);