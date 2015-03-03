<?php

add_action( 'wp_head', 'uxbarn_ctmzr_css_output' );
add_action( 'wp_head', 'uxbarn_ctmzr_custom_css_output' );

if ( ! function_exists( 'uxbarn_ctmzr_css_output' ) ) {

    function uxbarn_ctmzr_css_output() {
        
        // For resetting to default (delete all customized options)
        $is_reset = get_option( 'uxbarn_sc_reset_to_default' );
        if ( $is_reset && $is_reset == 'reset_styles' ) {
            
            delete_option( 'uxbarn_sc_global_color_scheme' );
            delete_option( 'uxbarn_sc_global_styles' );
            delete_option( 'uxbarn_sc_site_background_styles' );
            delete_option( 'uxbarn_sc_header_site_logo' );
            delete_option( 'uxbarn_sc_header_styles' );
            delete_option( 'uxbarn_sc_menu_styles' );
            delete_option( 'uxbarn_sc_submenu_styles' );
            delete_option( 'uxbarn_sc_home_slider_styles' );
            delete_option( 'uxbarn_sc_page_intro_styles' );
            delete_option( 'uxbarn_sc_content_body_styles' );
            delete_option( 'uxbarn_sc_content_background_styles' );
            delete_option( 'uxbarn_sc_sidebar_body_styles' );
            delete_option( 'uxbarn_sc_footer_site_logo' );
            delete_option( 'uxbarn_sc_footer_body_styles' );
            delete_option( 'uxbarn_sc_other_styles' );
            delete_option( 'uxbarn_sc_other_styles_custom_css' );
            delete_option( 'uxbarn_sc_reset_to_default' );
            
        }
        
    ?>
        <style type="text/css">
        <?php 
            
            // Global: Colors
            $option_set = get_option( 'uxbarn_sc_global_color_scheme' );
            
            if ( $option_set ) {

                if ( $option_set == 'custom' ) {
                	
                    $option_set = get_option('uxbarn_sc_global_styles');
                    
                    // Primary color
                    uxbarn_ctmzr_print_css('.main-menu li ul a:hover, .main-menu li ul li:hover > a, .top-bar.expanded .title-area .menu-icon a, .top-bar-section a:hover, .top-bar-section .dropdown li.title h5 a:hover, #content-container a, #content-container h1 span, #content-container h2 span, #content-container h3 span, #content-container h4 span, #content-container h5 span, #content-container h6 span, #intro h1 span, #intro h2 span, #footer-root-container a:hover, #content-container .blog-title a:hover, #content-container #sidebar-wrapper a:hover, #author-info h3, #content-container .tags a:hover, #content-container .blog-element-title a:hover, #content-container blockquote cite, #root-container .button:hover, #content-container .uxb-team-name a:hover, #root-container #content-container .uxb-tmnl-testimonial-item .uxb-tmnl-cite, #root-container #footer-content .uxb-tmnl-testimonial-item .uxb-tmnl-cite, #content-container .ui-accordion .ui-accordion-header.ui-state-active a', 
                        'color', $option_set, 'accent_color');
					
					// tagcloud
					uxbarn_ctmzr_print_css('#footer-content .tags-widget a:hover, #content-container #sidebar-wrapper .tagcloud a:hover, #root-container #footer-content .tagcloud a:hover', 
                        'color', $option_set, 'accent_color', '', ' !important');
                        
                    uxbarn_ctmzr_print_css('.main-menu .menu-marker, .uxb-port-element-item-hover, .flex-control-paging li a.flex-active, span.dropcap.custom, span.highlight.custom', 
                        'background', $option_set, 'accent_color');
					
					// background with "!important"
					uxbarn_ctmzr_print_css('.slider-controller:hover, .uxb-port-slider-controller:hover, #content-container .cta-box-button .button.solid-color', 
                        'background', $option_set, 'accent_color', '', ' !important');
                        
                    //uxbarn_ctmzr_print_css('.portfolio-item-hover', 
                    //    'background', $option_set, 'accent_color', '', '', true, 0.8);
                        
                    uxbarn_ctmzr_print_css_box_shadow('.top-bar.expanded .title-area .menu-icon a span',
                        '-webkit-box-shadow', $option_set, 'accent_color', '0 10px 0 1px %s, 0 16px 0 1px %s, 0 22px 0 1px %s' );
						
					uxbarn_ctmzr_print_css_box_shadow('.top-bar.expanded .title-area .menu-icon a span',
                        'box-shadow', $option_set, 'accent_color', '0 10px 0 1px %s, 0 16px 0 1px %s, 0 22px 0 1px %s' );
                    
                    uxbarn_ctmzr_print_css('.has-line, #content-container .tags a:hover, #root-container .button:hover, #content-container .uxb-tmnl-testimonial-bullets a.selected, #content-container #sidebar-wrapper .uxb-tmnl-testimonial-bullets a.selected, #footer-content .uxb-tmnl-testimonial-bullets a.selected, .gallery-wrapper .gallery-item:hover, #content-container .ui-accordion-header.ui-state-active, #footer-content .tags-widget a:hover, #content-container #sidebar-wrapper .tagcloud a:hover, #root-container #footer-content .tagcloud a:hover, #root-container #sidebar-wrapper .flickr_badge_image a:hover, #root-container #footer-content .flickr_badge_image a:hover, input[type="text"]:focus, input[type="password"]:focus, input[type="date"]:focus, input[type="datetime"]:focus, input[type="datetime-local"]:focus, input[type="month"]:focus, input[type="week"]:focus, input[type="email"]:focus, input[type="number"]:focus, input[type="search"]:focus, input[type="tel"]:focus, input[type="time"]:focus, input[type="url"]:focus, textarea:focus, select:focus, #root-container .input-text:focus', 
                        'border-color', $option_set, 'accent_color');
                    
                    uxbarn_ctmzr_print_css('#content-container blockquote, .section-container.vertical-tabs > section.active > .title,  .section-container.vertical-tabs > .section.active > .title, .cta-box.left-line', 
                        'border-left-color', $option_set, 'accent_color');
					
					uxbarn_ctmzr_print_css('.cta-box.right-line', 
                        'border-right-color', $option_set, 'accent_color');
                        
                    uxbarn_ctmzr_print_css('#uxb-team-info, .cta-box.bottom-line', 
                        'border-bottom-color', $option_set, 'accent_color');
					
					uxbarn_ctmzr_print_css('.section-container.tabs > section.active > .title, .section-container.tabs > .section.active > .title, .section-container.auto > section.active > .title, .section-container.auto > .section.active > .title, .cta-box.top-line', 
                        'border-top-color', $option_set, 'accent_color');
                    
                    uxbarn_ctmzr_print_css('@media only screen and (max-width: 767px) { .section-container.vertical-tabs > section.active > .title, .section-container.vertical-tabs > .section.active > .title', 
                        'border-top-color', $option_set, 'accent_color', '', ' !important', false, 1, true);
                    
					
					
					// Only for WooCommerce related
					if ( class_exists( 'Woocommerce' ) ) {
						
						uxbarn_ctmzr_print_css('.woocommerce div.product span.price,.woocommerce div.product p.price,.woocommerce #content div.product span.price,.woocommerce #content div.product p.price,.woocommerce-page div.product span.price,.woocommerce-page div.product p.price,.woocommerce-page #content div.product span.price,.woocommerce-page #content div.product p.price,#content-container .added_to_cart:hover,.product_list_widget span.amount,#root-container .price_slider_wrapper .button:hover, .woocommerce a.button:hover,.woocommerce button.button:hover,.woocommerce input.button:hover,.woocommerce #respond input#submit:hover,.woocommerce #content input.button:hover,.woocommerce-page a.button:hover,.woocommerce-page button.button:hover,.woocommerce-page input.button:hover,.woocommerce-page #respond input#submit:hover,.woocommerce-page #content input.button:hover,#root-container #sidebar-wrapper .widget_shopping_cart_content .button:hover,#root-container #footer-content .widget_shopping_cart_content .button:hover, .cart-tab .amount, .widget_shopping_cart_content .total .amount', 
                        	'color', $option_set, 'accent_color');
							
						uxbarn_ctmzr_print_css('#wooc-content-container .woocommerce-tabs .tabs > li.active', 
                        	'border-top-color', $option_set, 'accent_color');
							
						uxbarn_ctmzr_print_css('.woocommerce a.button:hover,.woocommerce button.button:hover,.woocommerce input.button:hover,.woocommerce #respond input#submit:hover,.woocommerce #content input.button:hover,.woocommerce-page a.button:hover,.woocommerce-page button.button:hover,.woocommerce-page input.button:hover,.woocommerce-page #respond input#submit:hover,.woocommerce-page #content input.button:hover,#root-container #sidebar-wrapper .widget_shopping_cart_content .button:hover,#root-container #footer-content .widget_shopping_cart_content .button:hover', 
                        	'border-color', $option_set, 'accent_color');
						
					}

					uxbarn_ctmzr_print_css('.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,.woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle', 
                        'background', $option_set, 'accent_color');
					
                }
                
            }
			
			
            // Global: Fonts
            $option_set = get_option('uxbarn_sc_global_styles');
            uxbarn_ctmzr_print_css('.slider-caption .caption-title, #uxb-layerslider-container h1, #uxb-layerslider-container h1, #uxb-layerslider-container h2, #uxb-layerslider-container h3, #uxb-layerslider-container h4, #uxb-layerslider-container h5, #content-container h1, #content-container h2, #content-container h3, #content-container h4, #content-container h5, #content-container h6, #intro h1, #intro h2', 
                'font-family', $option_set, 'primary_font'); 
				
            uxbarn_ctmzr_print_css('body, .main-menu, .slider-caption .caption-body, #content-container .columns, #intro p, #content-container .blog-title, #sidebar-wrapper .widget-item h4, #content-container .blog-element-title, #content-container .ui-accordion .ui-accordion-header, #content-container .uxb-team-position', 
                'font-family', $option_set, 'secondary_font');
        
		
			
            // Site Background
            $option_set = get_option('uxbarn_sc_site_background_styles');
            uxbarn_ctmzr_print_css('body', 'background-color', $option_set, 'background_color'); 
            uxbarn_ctmzr_print_css('body', 'background-image', $option_set, 'background_image', 'url("', '")');
            uxbarn_ctmzr_print_css('body', 'background-repeat', $option_set, 'background_repeat');
            uxbarn_ctmzr_print_css('body', 'background-position', $option_set, 'background_position');
			
			$is_fullscreen = $option_set['is_fullscreen'];
            if ( ! empty( $is_fullscreen ) && $is_fullscreen == 'true' ) {
            	
				uxbarn_ctmzr_print_css('body', 'background', $option_set, 'background_image', 'url("', '") no-repeat center center fixed');
            	uxbarn_ctmzr_print_css_background_size( 'body', 'cover' );
				
			}
            
			
			
            // Header
            $option_set = get_option('uxbarn_sc_header_styles');
            uxbarn_ctmzr_print_css('#logo h1', 'color', $option_set, 'site_title_color');
            uxbarn_ctmzr_print_css('#tagline', 'color', $option_set, 'site_tagline_color');
			
			
			
			// Mobile menu background
			//uxbarn_ctmzr_print_css('#mobile-menu', 'background', $option_set, 'background_color', '', '', true, 1);
            
            // Menu: Menu options
            $option_set = get_option('uxbarn_sc_menu_styles');
            // menu color
            uxbarn_ctmzr_print_css('.main-menu > li > a', 'color', $option_set, 'color');
            // hovered menu color
            uxbarn_ctmzr_print_css('.main-menu > li > a:hover, .main-menu > li:hover > a', 'color', $option_set, 'hover_color');
            // active menu color
            uxbarn_ctmzr_print_css('.main-menu a.active, .main-menu > li.current-menu-item > a, .main-menu > li.current-menu-parent > a', 
                'color', $option_set, 'active_color');
                
			
			// Mobile menu text color
			//uxbarn_ctmzr_print_css('#mobile-menu .top-bar .toggle-topbar.menu-icon a', 'color', $option_set, 'active_color');
            
            
            // Menu: Submenu options
            $option_set = get_option('uxbarn_sc_submenu_styles');
            // submenu bg color
            uxbarn_ctmzr_print_css('.main-menu li ul', 'background', $option_set, 'background_color');
            // submenu color
            uxbarn_ctmzr_print_css('.main-menu li ul a', 'color', $option_set, 'color');
            // hovered submenu background color
            uxbarn_ctmzr_print_css('.main-menu li ul a:hover, .main-menu li ul li:hover > a', 'background', $option_set, 'hover_background_color' );
            
			// hovered submenu color
			if ( $option_set ) {
				
                $use_custom_color = false;
                $use_custom_color = isset( $option_set['use_custom_hovered_color'] ) ? $option_set['use_custom_hovered_color'] : $use_custom_color;
                
                if ( $use_custom_color ) { // if user wants to use custom link colors
            		uxbarn_ctmzr_print_css( '.main-menu li ul a:hover, .main-menu li ul li:hover > a', 'color', $option_set, 'hover_color' );
                } else { // else, use color from global color scheme
                	
                	$option_set = get_option( 'uxbarn_sc_global_color_scheme' );
					
                	// if global is custom, then print it out otherwise, use from predefined CSS (not printed this)
					if ( $option_set && $option_set == 'custom' ) {
									
	                    $option_set = get_option( 'uxbarn_sc_global_styles' );
	                    uxbarn_ctmzr_print_css( '.main-menu li ul a:hover, .main-menu li ul li:hover > a', 'color', $option_set, 'accent_color' );
						
					}
					
                }
				
            }
            
			
			
			// Home Slider
            $option_set = get_option('uxbarn_sc_home_slider_styles');
            // controller color
            uxbarn_ctmzr_print_css('.slider-controller', 'background', $option_set, 'controller_color');
			
			// hovered controller color
			if ( $option_set ) {
				
                $use_custom_color = false;
                $use_custom_color = isset( $option_set['use_custom_hovered_controller'] ) ? $option_set['use_custom_hovered_controller'] : $use_custom_color;
                
                if ( $use_custom_color ) { // if user wants to use custom link colors
            		uxbarn_ctmzr_print_css('.slider-controller:hover, .uxb-port-slider-controller:hover', 'background', $option_set, 'hovered_controller_color', '', ' !important' );
                } else { // else, use color from global color scheme
                
                	$option_set = get_option( 'uxbarn_sc_global_color_scheme' );
					
                	// if global is custom, then print it out otherwise, use from predefined CSS (not printed this)
					if ( $option_set && $option_set == 'custom' ) {
									
	                    $option_set = get_option( 'uxbarn_sc_global_styles' );
						uxbarn_ctmzr_print_css('.slider-controller:hover, .uxb-port-slider-controller:hover', 'background', $option_set, 'accent_color', '', ' !important' );
						
					}
					
                }
				
            }
			
			
            // Page Intro: Colors
            $option_set = get_option('uxbarn_sc_page_intro_styles'); 
            uxbarn_ctmzr_print_css('#intro h1, #intro h2', 'color', $option_set, 'title_color');
            uxbarn_ctmzr_print_css('#intro p', 'color', $option_set, 'body_color');
            
			
			
            // Content: Body colors
            $option_set = get_option('uxbarn_sc_content_body_styles'); 
            uxbarn_ctmzr_print_css('#inner-content-container h1, #inner-content-container h2, #inner-content-container h3, #inner-content-container h4, #inner-content-container h5, #inner-content-container h6', 'color', $option_set, 'heading_color' );
            
            uxbarn_ctmzr_print_css('#inner-content-container .columns', 'color', $option_set, 'text_color');
            
			// link color
			if ( $option_set ) {
				
                $use_custom_color = false;
                $use_custom_color = isset( $option_set['use_custom_link_color'] ) ? $option_set['use_custom_link_color'] : $use_custom_color;
                
                if ( $use_custom_color ) { // if user wants to use custom link colors
					uxbarn_ctmzr_print_css('#inner-content-container a', 'color', $option_set, 'link_color');
                } else { // else, use color from global color scheme
                	
                	$option_set = get_option( 'uxbarn_sc_global_color_scheme' );
					
					// if global is custom, then print it out otherwise, use from predefined CSS (not printed this)
					if ( $option_set && $option_set == 'custom' ) {
							
	                    $option_set = get_option( 'uxbarn_sc_global_styles' );
						uxbarn_ctmzr_print_css('#inner-content-container a', 'color', $option_set, 'accent_color');
						
					}
					
                }
				
            }
            
            
            // Content: Bg
            $option_set = get_option('uxbarn_sc_content_background_styles');
            uxbarn_ctmzr_print_css('#root-container', 'background-color', $option_set, 'background_color');
            uxbarn_ctmzr_print_css('#root-container', 'background-image', $option_set, 'background_image', 'url("', '")');
            uxbarn_ctmzr_print_css('#root-container', 'background-repeat', $option_set, 'background_repeat');
            uxbarn_ctmzr_print_css('#root-container', 'background-position', $option_set, 'background_position');
            
			
			
			// Sidebar
			$option_set = get_option('uxbarn_sc_sidebar_body_styles');
			// heading color
			uxbarn_ctmzr_print_css('#sidebar-wrapper .widget-item h4', 'color', $option_set, 'heading_color' );
			// text color
			uxbarn_ctmzr_print_css('#content-container #sidebar-wrapper .columns, #content-container #sidebar-wrapper p', 'color', $option_set, 'text_color' );
			// link color
			uxbarn_ctmzr_print_css('#content-container #sidebar-wrapper a', 'color', $option_set, 'link_color' );
			// hovered link color
			if ( $option_set ) {
				
                $use_custom_color = false;
                $use_custom_color = isset( $option_set['use_custom_hovered_color'] ) ? $option_set['use_custom_hovered_color'] : $use_custom_color;
                
                if ( $use_custom_color ) { // if user wants to use custom link colors
					uxbarn_ctmzr_print_css('#content-container #sidebar-wrapper a:hover', 'color', $option_set, 'hover_link_color' );
                } else { // else, use color from global color scheme
                	
                	$option_set = get_option( 'uxbarn_sc_global_color_scheme' );
					
					// if global is custom, then print it out otherwise, use from predefined CSS (not printed this)
					if ( $option_set && $option_set == 'custom' ) {
							
	                    $option_set = get_option( 'uxbarn_sc_global_styles' );
						uxbarn_ctmzr_print_css('#content-container #sidebar-wrapper a:hover', 'color', $option_set, 'accent_color' );
						
					}
					
                }
				
            }
			
			
            // Footer: colors
            $option_set = get_option('uxbarn_sc_footer_body_styles');
            uxbarn_ctmzr_print_css('#footer-content h5', 'color', $option_set, 'heading_color');
            uxbarn_ctmzr_print_css('#footer-content-container, #footer-bar-container', 'color', $option_set, 'text_color');
            uxbarn_ctmzr_print_css('#footer-root-container a', 'color', $option_set, 'link_color');
			// hovered link color
			if ( $option_set ) {
				
                $use_custom_color = false;
                $use_custom_color = isset( $option_set['use_custom_hovered_color'] ) ? $option_set['use_custom_hovered_color'] : $use_custom_color;
                
                if ( $use_custom_color ) { // if user wants to use custom link colors
                	uxbarn_ctmzr_print_css('#footer-root-container a:hover', 'color', $option_set, 'hover_link_color');
                } else { // else, use color from global color scheme
                	
                	$option_set = get_option( 'uxbarn_sc_global_color_scheme' );
					
                	// if global is custom, then print it out otherwise, use from predefined CSS (not printed this)
					if ( $option_set && $option_set == 'custom' ) {
								
	                    $option_set = get_option( 'uxbarn_sc_global_styles' );
						uxbarn_ctmzr_print_css('#footer-root-container a:hover', 'color', $option_set, 'accent_color');
						
					}
					
                }
				
            }
            
            // Other Styles
            $option_set = get_option('uxbarn_sc_other_styles');
            uxbarn_ctmzr_print_css('::-moz-selection', 'background', $option_set, 'text_selection_color');
            uxbarn_ctmzr_print_css('::selection', 'background', $option_set, 'text_selection_color');
            
        ?>
        </style> 
    <?php
        
    }

}


if( ! function_exists('uxbarn_ctmzr_custom_css_output')) {
    
    function uxbarn_ctmzr_custom_css_output() {
        
        $option_set = get_option('uxbarn_sc_other_styles_custom_css');
        if($option_set) {
            echo '<style type="text/css">' . $option_set . '</style>';
        }
        
    }
	
}


if( ! function_exists('uxbarn_ctmzr_print_css')) {
	
    function uxbarn_ctmzr_print_css($selector, $property, $option_set, $option_name, $prefix='', $postfix='', $rgb=false, $opacity=1, $media_query=false, $echo=true) {
        
        $return = '';
        
        if($option_set) {
            
            $value = $option_set[$option_name];
            
            if ( !empty( $value ) ) {
                
                // Check whether there is Google Fonts code contained. If so, wrap the font with double quotes and fallback font.
                if(strpos($value,'[#GF#]') !== false) {
                    $value = str_replace('[#GF#]', '', $value);
					$value_temp = explode(':', $value); // split and remove any weights out
					$value = $value_temp[0];
                    $prefix = '"';
                    $postfix = '", sans-serif';
                }
                
                // For background-image; when there is no image assigned, just don't print it out
                if($property == 'background-image') {
                    if(empty($value)) {
                        $echo = false;
                    }
                }
                
                // For typography and background set; when the user haven't selected any item (-1), 
                // just don't print it out (use default style)
                if($property == 'font-family' ||
                    $property == 'font-size' ||
                    $property == 'font-style' ||
                    $property == 'font-weight' ||
                    $property == 'line-height' ||
                    $property == 'background-position' ||
                    $property == 'background-repeat') {
                        
                    // "-1" means no selection so there is no custom css printed    
                    if($value == '-1' || empty($value)) {
                        $echo = false;
                    }
                }
                    
                
                $return = sprintf('%s { %s: %s; }',
                            $selector, $property, $prefix.$value.$postfix
                        );
                        
                if($media_query) {
                    $return = sprintf('%s { %s: %s; } }',
                            $selector, $property, $prefix.$value.$postfix
                        );
                        
                }
                
                if($rgb) {
                    $rgb_value = uxbarn_hex2rgb($value);
                    
                    $value1 = 'rgb(' . $rgb_value[0] . ',' . $rgb_value[1] . ',' . $rgb_value[2] . ')';
                    $value2 = 'rgba(' . $rgb_value[0] . ',' . $rgb_value[1] . ',' . $rgb_value[2] . ',' . $opacity . ')';
                    
                    $return = sprintf('%s { %s: %s; %s: %s; }',
                            $selector, $property, $value1, $property, $value2
                        );
                }
                
                if($echo) {
                    echo $return;
                }
            
            }
            
        }

    }

}



if ( ! function_exists( 'uxbarn_ctmzr_print_css_box_shadow' ) ) {
	
    function uxbarn_ctmzr_print_css_box_shadow( $selector, $property, $option_set, $option_name, $string_value, $postfix = '' ) {
    	
		if ( $option_set ) {
            
            $value = $option_set[ $option_name ];
			
			if( ! empty( $value ) ) {
		            
				$return = sprintf( '%s { %s: ' . $string_value . ' %s; }', $selector, $property, $value, $value, $value, $postfix );
				
				echo $return;
				
			}
			
		}
		
	}
	
}



if ( ! function_exists( 'uxbarn_ctmzr_print_css_background_size' ) ) {
	
    function uxbarn_ctmzr_print_css_background_size( $selector, $value ) {
    	
		echo sprintf( '%s { -webkit-background-size: %s; -moz-background-size: %s; -o-background-size: %s; background-size: %s; }', $selector, $value, $value, $value, $value );
		
	}
	
}
    