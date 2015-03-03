/*global jQuery:false, ThemeOptions:false, google:false */

/*
 * Fineliner - Responsive Portfolio WordPress Theme
 * By UXbarn
 * Themeforest Profile: http://themeforest.net/user/UXbarn?ref=UXbarn
 * Demo URL: http://themes.uxbarn.com/redirect.php?theme=fineliner_wp
 * Created: October 21, 2013
 */

jQuery(document).ready(function($) {
	"use strict";

	// --------------------------------------------------------- //
	// Configuration Options
	// --------------------------------------------------------- //
	var homeSliderAutoAnimated = Boolean(ThemeOptions.default_slider_auto_rotation);
	var homeSliderAutoAnimatedDelay = parseInt(ThemeOptions.default_slider_rotation_duration, 10);
	var homeSliderAnimation = ThemeOptions.default_slider_transition;
	var homeSliderAnimationSpeed = parseInt(ThemeOptions.default_slider_transition_speed, 10);
	var homeSliderCaptionAnimated = Boolean(ThemeOptions.default_slider_caption_animation);

	var imageSliderAnimationSpeed = 700;

	var enableLightbox = Boolean(ThemeOptions.enable_lightbox_wp_gallery);
	// ---------------------------------------------- //



	// ---------------------------------------------- //
	// Global Read-Only Variables (DO NOT CHANGE!)
	// ---------------------------------------------- //
	var isSearchDisplayed = false;

	var isHomeSliderLoaded = false;
	var isHomeSliderFirstTimeHovered = false;

	var ua = navigator.userAgent.toLowerCase();
	var isAndroid = ua.indexOf("android") > -1;
	var androidversion = parseFloat(ua.slice(ua.indexOf('android') + 8));
	
	var contentWidth = parseInt($('.columns-content-width').css('width').replace('px', ''), 10);
	// ---------------------------------------------- //



	// ---------------------------------------------- //
	// Core Scripts
	// ---------------------------------------------- //

	// Initialize custom functions
	renderGoogleMaps();
	initMobileMenu();

	// Initialize Foundation framework
	$(document).foundation();
	
	// To move the meta info (in single page) inside the VC row-column element (if VC is in use here)
	if(contentWidth > 480) {
		$('#inner-blog-single-item .blog-meta').prependTo('#single-content-wrapper .row:first > .uxb-col');
		
		// Hide loading text
		$('#inner-blog-single-item .loading-text').css('display', 'none');
		
		// To prevent the content "jumping" in single post page by initially hide the elements then show them once the above prepending is done.
		$('#single-content-wrapper, #inner-blog-single-item .blog-meta, #inner-blog-single-item .blog-title').stop().animate({ opacity: 1 });
	}

	// Force displaying tabs element after JS has been loaded
	$('#content-container .section-container').addClass('display-block');

	// Add CSS class to submit button of comment form
	$('input#submit, input[type="submit"], input[type="button"]').addClass('button');

	// To remove some empty tags
	$('p:empty').remove(); // This is mostly added by WP automatically

	// To unwrap "p" tag out of "x" button of the message box
	if ($('.box .close').length > 0) {
		if ($('.box .close').parent().prop('tagName').toLowerCase() === 'p') {
			$('.box .close').unwrap();
		}
	}

	// To remove margin-bottom out of the last "p" element inside the message box
	$('.box').find('p:last-child').addClass('no-margin-bottom');



	/***** Home Slider *****/
	if (jQuery().flexslider) {

		if ($('#home-slider-container').length > 0) {

			if (!homeSliderCaptionAnimated) {
				$('.slider-caption .caption-title, .slider-caption .caption-body').css('opacity', 1);
			}
			
			$('#home-slider-container').imagesLoaded(function() {
			
				$('#home-slider-container').flexslider({
					animation : homeSliderAnimation,
					directionNav : false,
					contolNav : false,
					pauseOnAction : true,
					pauseOnHover : true,
					slideshow : homeSliderAutoAnimated,
					slideshowSpeed : homeSliderAutoAnimatedDelay,
					animationSpeed : homeSliderAnimationSpeed,
					selector : '.home-slider-slides > li',
					initDelay : 2000,
					smoothHeight : true,
					start : function(slider) {
	
						var initFadingSpeed = 500;
						var initDelay = 0;
						// "slide" effect has some different transition to re-define
						if (homeSliderAnimation == 'slide') {
							initFadingSpeed = 1;
							initDelay = 800;
						}
	
						$('#home-slider-container .home-slider-slides, #home-slider-container .flex-viewport').stop().animate({// "fade" and "slide" effect container
							opacity : 1
						}, initFadingSpeed, function() {
	
							if (homeSliderCaptionAnimated) {
								$(slider.slides[slider.currentSlide]).find('.slider-caption .caption-title').delay(initDelay).stop().animate({
									opacity : 1
								}, 500, function() {
									$(slider.slides[slider.currentSlide]).find('.slider-caption .caption-body').stop().animate({
										opacity : 1
									}, 800);
	
								});
							}
						});
	
						isHomeSliderLoaded = true;
	
						// Hide loading gif
						$(slider).closest('#home-slider-container').css({
							background : 'none',
							// reset init height fix for Safari (also working on other browsers). this will also set the inline height based on the first slide's image
							height : $(slider).closest('#home-slider-container').find('.home-slider-slides li.flex-active-slide img').height() + 'px',
						}).addClass('auto-height');
	
					},
					before : function() {
						if (homeSliderCaptionAnimated) {
							$('.slider-caption .caption-title, .slider-caption .caption-body').stop().animate({
								opacity : 0
							}, 1);
						}
					},
					after : function(slider) {
	
						$(slider).closest('#home-slider-container').css('height', 'inherit');
	
						if (homeSliderCaptionAnimated) {
	
							$(slider.slides[slider.currentSlide]).find('.slider-caption .caption-title').stop().animate({
								opacity : 1
							}, 500, function() {
								$(slider.slides[slider.currentSlide]).find('.slider-caption .caption-body').stop().animate({
									opacity : 1
								}, 800);
	
							});
						}
					}
				});
				
			});
				
			$('#home-slider-container .slider-prev').on('click', function() {
				$(this).closest('.slider-set').flexslider('prev');
				return false;
			});
			$('#home-slider-container .slider-next').on('click', function() {
				$(this).closest('.slider-set').flexslider('next');
				return false;
			});

			// Set the position of home slider's border
			//alert($('.home-slider-item:first-child').height());
			var $homeSliderBorder = $('.home-slider-item-border');
			$homeSliderBorder.css({
				height : '89%',
				top : '5.5%',
				width : '94.35897435897436%',
				left : '2.820512820512821%',
			});

			// Display slider controller on hovered
			$('#home-slider-container').hover(function() {
				if ($(this).find('.home-slider-item:not(.clone)').length > 1) {
					if (isHomeSliderLoaded) {// works only when the slider is loaded
						isHomeSliderFirstTimeHovered = true;
						// this is used to prevent the "mousemove" event below continuously firing the handler
						$(this).find('.slider-controller').css('display', 'block').stop().animate({
							opacity : 1
						});
					}
				}
			}, function() {
				$(this).find('.slider-controller').stop().animate({
					opacity : 0
				});
			});
			// If the mouse cursor is moving on the slider when it is just loaded, display the controller
			$('#home-slider-container').mousemove(function() {
				if ($(this).find('.home-slider-item:not(.clone)').length > 1) {
					if (!isHomeSliderFirstTimeHovered && isHomeSliderLoaded) {
						$(this).find('.slider-controller').css('display', 'block').stop().animate({
							opacity : 1
						});
					}
				}
			});

		}

	}



	/***** Menu *****/
	// Only for columned menu layout
	if ( ! $('#menu-wrapper').hasClass('horizontal-menu')) {
		
		// Firstly, replicate the displaying menu from the default menu UL
		// then divide the menu items into columns
		var menuItems = $('#rendered-menu-wrapper > ul.main-menu > li').clone();
		var menuItemCount = $(menuItems).length;
		var itemCounter = 1;
		var menuColumnDiv = $('<div class="menu-column" />');
		var menuColumnUl = $('<ul class="sf-menu sf-vertical main-menu" />');
				
		$(menuItems).each(function(index) {
			
			// Add cloned list items into the created UL
			$(menuColumnUl).append($(this));
			//console.debug($(this).children());
			
			// 3 items per column
			if (itemCounter == 3 || index == menuItemCount - 1) {
				
				// Add menu UL into the column wrapper and then into root menu wrapper
				$('#rendered-menu-wrapper').append($(menuColumnDiv).append($(menuColumnUl)));
				
				// Prepare another set of column wrapper
				menuColumnDiv = $('<div class="menu-column" />');
				menuColumnUl = $('<ul class="sf-menu sf-vertical main-menu" />');
				
				// Reset the counter
				itemCounter = 1;
				
			} else {
				itemCounter += 1;
			}
			
		});
		
		// Fade-in the complete relicated menu
		$('#rendered-menu-wrapper').stop().animate({
			opacity : 1,
		});
		
		// Remove the default UL set
		$('#rendered-menu-wrapper > ul.main-menu').remove();
		
	}
	
	// Load menu engine
	if (jQuery().superfish) {
		$('.sf-menu').superfish({
			animation : {
				height : 'show'	// slide-down effect without fade-in
			},
			speed : 'normal',
			speedOut : 'normal',
			delay : 400	// 0.4 second delay on mouseout
		});

	}

	// Set marker for active menu
	var menuParent = $('.main-menu > .current-menu-item, .main-menu > .current-menu-parent');
	menuParent.append('<span class="menu-marker"></span>');
	$('.menu-marker').stop().animate({
		opacity : 1
	});

	// Menu on hovered
	$('.main-menu > li').mouseover(function() {
		$('.main-menu > li > a, .menu-marker').not($(this).children('a')).stop().animate({
			opacity : 0.2
		});
	}).mouseout(function() {
		$('.main-menu > li > a, .menu-marker').not($(this).children('a')).stop().animate({
			opacity : 1
		}, 600);
	});

	// Header Search Button
	$('#header-search-button').click(function() {
		if (!isSearchDisplayed) {

			// Hide menu
			$('.menu-column').stop().animate({
				opacity : 0
			}, 300, function() {
				$(this).css('display', 'none');
			});
			$('#menu-wrapper.horizontal-menu .main-menu').stop().animate({
				opacity : 0
			}, 300);

			//$('#mobile-menu > ul').css('visibility', 'hidden');
			$('#mobile-menu > ul').stop().animate({
				opacity : 0
			});

			// Display search input
			$('#header-search-input-wrapper').css('display', 'block').stop().animate({
				opacity : 1
			}, 300);

			$('#header-search-button').addClass('cancel').find('i').removeClass().addClass('icon-remove');
			$('#header-search-input').focus();

			isSearchDisplayed = true;
		} else {
			// Show menu
			$('.menu-column').css('display', '').stop().animate({
				opacity : 1
			}, 300);
			$('#menu-wrapper.horizontal-menu .main-menu').stop().animate({
				opacity : 1
			}, 300);
			
			//$('#mobile-menu > ul').css('visibility', 'visible');
			$('#mobile-menu > ul').stop().animate({
				opacity : 1
			}, 400);

			// Hide search input
			$('#header-search-input-wrapper').stop().animate({
				opacity : 0
			}, 200, function() {
				$(this).css('display', 'none');
			});

			$('#header-search-button').removeClass('cancel').find('i').removeClass().addClass('icon-search');

			isSearchDisplayed = false;
		}

	});

	

	/***** Image Slider *****/
	if (jQuery().flexslider) {

		var imageSlider = $('.image-slider-wrapper');
		imageSlider.each(function() {

			var autoRotate = $(this).attr('data-auto-rotation'), 
				imageSliderAutoAnimated = true, 
				imageSliderAutoAnimatedDelay = 10000;
				
			if (autoRotate !== '0') {
				imageSliderAutoAnimatedDelay = parseInt(autoRotate, 10) * 1000;
				// Convert to milliseconds
			} else {
				imageSliderAutoAnimated = false;
			}
			
			var imageSliderAnimation = $(this).attr('data-effect');
			
			$(this).imagesLoaded(function() {

				$(this).flexslider({
					animation : imageSliderAnimation,
					directionNav : false,
					contolNav : false,
					pauseOnAction : true,
					pauseOnHover : true,
					slideshow : imageSliderAutoAnimated,
					slideshowSpeed : imageSliderAutoAnimatedDelay,
					animationSpeed : imageSliderAnimationSpeed,
					selector : '.image-slider > li',
					initDelay : 2000,
					smoothHeight : true,
					start : function(slider) {

						var initFadingSpeed = 800;
						var initDelay = 0;
						// "slide" effect has some different transition to re-define
						if (imageSliderAnimation == 'slide') {
							initFadingSpeed = 1;
							initDelay = 800;
						}

						$(slider).find('.image-slider, .flex-viewport').css('visibility', 'visible').stop().animate({
							opacity : 1,
						}, initFadingSpeed);
						
						// Whether the border is enabled or not
						var borderEnabled = $(slider).closest('.image-slider-wrapper').find('.image-slider li.flex-active-slide img').hasClass('border');
						var extraInitHeight = 16; // border top + bottom heights
						if( ! borderEnabled) { // if not, then there is no extra initial height
							extraInitHeight = 0;
						}

						// Hide loading gif
						$(slider).closest('.image-slider-wrapper').css({
							background : 'none',
							// reset init height fix for Safari (also working on other browsers). this will also set the inline height based on the first slide's image
							height : $(slider).closest('.image-slider-wrapper').find('.image-slider li.flex-active-slide img').height() + extraInitHeight + 'px',
						}).addClass('auto-height');

						$(slider).closest('.image-slider-root-container').attr('data-loaded', 'true');
						
					},
					before : function() {
					},
					after : function(slider) {
						// set a new height based on the next slide
						$(slider).closest('.image-slider-wrapper').css('height', 'inherit');
					},
				});
				// END: flexslider

			});
			//END: imageLoaded

		});
		// END: each

		$('.image-slider-root-container .slider-prev').on('click', function() {
			$(this).closest('.image-slider-root-container').find('.slider-set').flexslider('prev');
			return false;
		});
		$('.image-slider-root-container .slider-next').on('click', function() {
			$(this).closest('.image-slider-root-container').find('.slider-set').flexslider('next');
			return false;
		});

		// Display slider controller on hovered
		$('.image-slider, .slider-controller').hover(function() {
			var root = $(this).closest('.image-slider-root-container');
			if ($(root).find('.image-slider-item:not(.clone)').length > 1) {
				if ($(root).attr('data-loaded') == 'true') {// works only when the slider is loaded
					$(root).attr('data-first-hover', 'true');
					// this is used to prevent the "mousemove" event below continuously firing the handler
					$(root).find('.slider-controller').css('display', 'block').stop().animate({
						opacity : 1
					});
				}
			}
		}, function() {
			var root = $(this).closest('.image-slider-root-container');
			$(root).find('.slider-controller').stop().animate({
				opacity : 0
			});
		});
		// If the mouse cursor is moving on the slider when it is just loaded, display the controller
		$('.image-slider, .slider-controller').mousemove(function() {
			var root = $(this).closest('.image-slider-root-container');
			if ($(root).find('.image-slider-item:not(.clone)').length > 1) {
				if ($(root).attr('data-first-hover') != 'true' && $(root).attr('data-loaded') == 'true') {
					$(root).find('.slider-controller').css('display', 'block').stop().animate({
						opacity : 1
					});
				}
			}
		});
		
		// Some sliders that are in "large-6" column (only left column) might display some 1px glitch.
		// To fix that, using the JS code below to reduce the width by 1px to hide it.
		var slidersToBeFixed = $('.row .large-6.columns:first-child .image-slider-root-container');
		$(slidersToBeFixed).each(function() {
			$(this).css('width', $(this).width() - 1 );
		});

	}



	


	// ---------------------------------------------- //
	// Elements / Misc.
	// ---------------------------------------------- //

	/***** Google Maps *****/
	function renderGoogleMaps() {

		if ( typeof google !== 'undefined' && typeof google.maps.MapTypeId !== 'undefined') {

			var elements = $('.google-map');

			elements.each(function() {

				var rawlatlng = $(this).attr('data-latlng').split(',');
				var lat = jQuery.trim(rawlatlng[0]);
				var lng = jQuery.trim(rawlatlng[1]);
				var address = $(this).attr('data-address');
				var displayType = $(this).attr('data-display-type');
				var zoomLevel = parseInt($(this).attr('data-zoom-level'), 10);
				$(this).css('height', $(this).attr('data-height'));

				switch(displayType.toUpperCase()) {
					case 'ROADMAP' :
						displayType = google.maps.MapTypeId.ROADMAP;
						break;
					case 'SATELLITE' :
						displayType = google.maps.MapTypeId.SATELLITE;
						break;
					case 'HYBRID' :
						displayType = google.maps.MapTypeId.HYBRID;
						break;
					case 'TERRAIN' :
						displayType = google.maps.MapTypeId.TERRAIN;
						break;
					default :
						displayType = google.maps.MapTypeId.ROADMAP;
						break;
				}

				var geocoder = new google.maps.Geocoder();
				var latlng = new google.maps.LatLng(lat, lng);
				var myOptions = {
					scrollwheel : false,
					zoom : zoomLevel,
					center : latlng,
					mapTypeId : displayType
				};

				var map = new google.maps.Map($(this)[0], myOptions);

				geocoder.geocode({
					'address' : address,
					'latLng' : latlng,
				}, function(results, status) {
					if (status === google.maps.GeocoderStatus.OK) {
						var marker;
						if (jQuery.trim(address).length > 0) {
							marker = new google.maps.Marker({
								map : map,
								position : results[0].geometry.location
							});

							map.setCenter(results[0].geometry.location);

						} else {
							marker = new google.maps.Marker({
								map : map,
								position : latlng
							});

							marker.setPosition(latlng);
							map.setCenter(latlng);

						}

					} else {
						window.alert("Geocode was not successful for the following reason: " + status);
					}
				});

			});
		}

	}



	// Add FancyBox feature to WP gallery shortcode
	if (enableLightbox) {
		registerFancyBoxToWPGallery();
	}
	function registerFancyBoxToWPGallery() {
		// WP Gallery shortcode
		var $wpGallery = $('.gallery');

		$wpGallery.each(function() {
			var mainId = $(this).attr('id');

			var items = $(this).find('.gallery-item').find('a');

			items.each(function() {

				var href = $(this).attr('href');

				if (href.toLowerCase().indexOf('.jpg') >= 0 || href.toLowerCase().indexOf('.jpeg') >= 0 || href.toLowerCase().indexOf('.png') >= 0 || href.toLowerCase().indexOf('.gif') >= 0) {

					$(this).addClass('image-box');
					$(this).attr('rel', mainId);

				}

			});

		});
	}



	/***** Fancybox *****/
	if (jQuery().fancybox) {
		if (isAndroid && androidversion <= 4.0) {
			// Fancybox's thumbnail helper is not working on older Android, so disable it.
			$('.image-box').not('.clone .image-box').fancybox();
		} else {
			$('.image-box').not('.clone .image-box').fancybox({
				helpers : {
					thumbs : {
						width : 50,
						height : 50
					}
				}
			});
		}
	}



	/***** Accordion/Toggle *****/
	var animateObj = {
		animate : 'easeOutQuint',
		duration : 600,
	};

	if ($('.accordion').length > 0) {

		$('.accordion').each(function() {
			
			var isCollapsible = $(this).attr('data-collapsible');
			if (isCollapsible == 'true') {
				isCollapsible = true;
			}
			
			var activeVar = parseInt($(this).attr('data-active-index'), 10);
			if ($(this).attr('data-active-index') == '-1') {
				activeVar = false;
			}
			
			$(this).accordion({
				autoHeight : false,
				heightStyle : 'content', // jQuery UI 1.10.x
				collapsible : isCollapsible,
				animate : animateObj,
				active : activeVar,
				create : function() {
					$(this).css({
						height : 'auto',
						visibility : 'visible',
					}).animate({
						opacity : 1
					});
				},
			});
		});

	}

	if ($('.toggle').length > 0) {

		$('.toggle').accordion({
			autoHeight : false,
			heightStyle : 'content', // jQuery UI 1.10.x
			collapsible : true,
			animate : animateObj,
			active : false,
			create : function() {
				$(this).css({
					height : 'auto',
					visibility : 'visible',
				}).animate({
					opacity : 1
				});
			},
		});

		if ($('.toggle').hasClass('active')) {
			$('.toggle.active').accordion({
				heightStyle : 'content',
				autoHeight : false,
				collapsible : true,
				animate : animateObj,
				active : 0,
				create : function() {
					$(this).css({
						height : 'auto',
						visibility : 'visible',
					}).animate({
						opacity : 1
					});
				},
			});

			$('body').scrollTop(0);
		}

	}



	/***** Tabs *****/
	if ($('html').hasClass('lt-ie9')) {
		$('.auto').addClass('tabs').removeClass('auto').attr('data-section', 'tabs');
	}
	var tabs = $('.vertical-tabs p.title > a, .tabs p.title > a, .auto p.title > a');
	tabs.click(function() {

		// Force hiding any content that contains Google Map
		$(this).parents('.section-container').find('.content').each(function() {
			if ($(this).find('.google-map').length > 0) {
				$(this).css('display', 'none');
			}
		});

		var map = $(this).parents('section').find('.content').find('.google-map');
		if (map.length > 0) {
			// Re-render Google Map for tab content and display the content
			$(this).parents('section').find('.content').css({
				'display' : 'block',
				'width' : '100%'
			});
			renderGoogleMaps();
		}
	});



	/***** Progress Bar *****/
	if (isAndroid) {
		if (androidversion >= 4.0) {
			animateProgressBar();
		} else {

			$('.progress-bar .bar-meter').each(function() {
				$(this).css('width', $(this).attr('data-meter') + '%');
			});

		}
	} else {
		animateProgressBar();
	}
	function animateProgressBar() {

		if (jQuery().waypoint) {

			$('.progress-bar').waypoint(function() {

				var meter = $(this).find('.bar-meter');
				$(meter).css('width', 0);
				$(meter).delay(250).animate({
					width : $(meter).attr('data-meter') + '%',
				}, 1400, 'easeOutQuint');

			}, {
				offset : '85%',
				triggerOnce : true
			});

		}

	}
	
	
	
	/***** ScrollUp Button *****/
	if (jQuery().scrollUp) {
		$.scrollUp({
			scrollSpeed: 700,
			easingType: 'easeOutQuint',
			scrollText: '',
		});
	}
	



	// "placeholder" attribute fix for all browsers
/*
	$('[placeholder]').focus(function() {
		var input = $(this);
		if (input.val() == input.attr('placeholder')) {
			input.val('');
			input.removeClass('placeholder');
		}
	}).blur(function() {
		var input = $(this);
		if (input.val() === '' || input.val() == input.attr('placeholder')) {
			input.addClass('placeholder');
			input.val(input.attr('placeholder'));
		}
	}).blur();
	$('[placeholder]').parents('form').submit(function() {
		$(this).find('[placeholder]').each(function() {
			var input = $(this);
			if (input.val() == input.attr('placeholder')) {
				input.val('');
			}
		});
	});*/

	
	


	/***** Mobile Menu *****/
	function initMobileMenu() {
		//var defaultMenuList = $('#root-menu');
		var mobileMenuList = $('<ul />').appendTo($('#mobile-menu .top-bar-section'));

		var clonedList = $('#menu-wrapper .main-menu > li').clone();
		clonedList = getGeneratedSubmenu(clonedList);
		clonedList.appendTo(mobileMenuList);

	}

	// Recursive function for generating submenus
	function getGeneratedSubmenu(list) {
		//console.debug($('#menu-wrapper .main-menu > li'));
		$(list).each(function() {
			//$(this).append('<li class="divider"></li>');

			if ($(this).find('ul').length > 0) {
				var submenu = $(this).find('ul');

				$(this).addClass('has-dropdown');
				submenu.addClass('dropdown');

				getGeneratedSubmenu(submenu.find('li'));
			}
		});

		return list;
	}
	
	
	
	
	/***** WooCommerce *****/
	//$('.inline.show_review_form.button').addClass('small').prepend('<i class="icon-plus"></i>');
	$('.single_add_to_cart_button.button, .add_to_cart_button.button').prepend('<i class="icon-shopping-cart"></i>');
	$('.button.product_type_variable').prepend('<i class="icon-wrench"></i>');
	$('.button.product_type_simple').not('.add_to_cart_button').prepend('<i class="icon-file-alt"></i>');

	// To select the review tab when changing the current review page
	if(document.location.hash!='') {
		
	    // Get the index from URL hash
	    var tabSelect = document.location.hash.substr(1,document.location.hash.length);
	    
	    // Jump to the tabs location
	    if(tabSelect == 'comment-1') {
	    	
	    	var queryStrings = getUrlVars();
	    	
	    	// If the page is reloaded after adding item to cart, don't do scrolling to review area
	    	if(typeof queryStrings['added-to-cart'] === 'undefined') {
		    	
		    	//document.getElementsByClassName('woocommerce-tabs')[0].scrollIntoView();
		    	if(jQuery().scrollintoview) {
		    		$('.woocommerce-tabs').scrollintoview();
		    	}
		    	
	    	}
	    }
	    
	}
	
	$('.woocommerce.widget_product_search #searchform').css('display', 'block');
	
	
	/***** Utils Functions *****/
	/*** Getting query string ***/
	function getUrlVars() {
	    var vars = [], hash;
	    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
	    for(var i = 0; i < hashes.length; i++) {
	        hash = hashes[i].split('=');
	        vars.push(hash[0]);
	        vars[hash[0]] = hash[1];
	    }
	    return vars;
	}
	
});
