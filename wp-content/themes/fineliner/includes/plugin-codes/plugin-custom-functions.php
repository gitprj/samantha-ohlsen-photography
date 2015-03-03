<?php

// ---------------------------------------------- //
// Plugins-related functions & codes
// ---------------------------------------------- //

/***** TGMPA *****/
// TGMPA to create a notification box for user to install the specified plugins
if ( ! function_exists( 'uxbarn_register_additional_plugins' ) ) {
	
	function uxbarn_register_additional_plugins() {
		
	    $plugins = array(
	        array(
	            'name' 		=> 'OptionTree',
	            'slug' 		=> 'option-tree',
	            'required' 	=> true,
	            'version' 	=> '',
	        ),
	    	array(
	            'name' 		=> 'Visual Composer',
	            'slug' 		=> 'js_composer',
	            'source' 	=> get_template_directory() . '/includes/plugin-packages/VisualComposer_4.3.5.zip',
	            'required' 	=> true,
	            'version' 	=> '4.3.5',
	        ),
	        array(
	            'name' 		=> 'LayerSlider',
	            'slug' 		=> 'LayerSlider',
	            'source' 	=> get_template_directory() . '/includes/plugin-packages/LayerSlider_5.3.2.zip',
	            'required' 	=> true,
	            'version' 	=> '5.3.2',
	        ),
	        
			array(
				'name' 		=> 'UXbarn Extension for Visual Composer',
				'slug' 		=> 'uxbarn-vc-extension',
				'source'	=> get_template_directory() . '/includes/plugin-packages/UXbarnVCExtension_1.0.4.zip',
				'required' 	=> true,
				'version' 	=> '1.0.4',
			),
			array(
				'name' 		=> 'UXbarn Portfolio',
				'slug' 		=> 'uxbarn-portfolio',
				'source'	=> get_template_directory() . '/includes/plugin-packages/UXbarnPortfolio_1.1.3.zip',
				'required' 	=> true,
				'version' 	=> '1.1.3',
			),
			array(
				'name' 		=> 'UXbarn Team',
				'slug' 		=> 'uxbarn-team',
				'source'	=> get_template_directory() . '/includes/plugin-packages/UXbarnTeam_1.1.2.zip',
				'required' 	=> true,
				'version' 	=> '1.1.2',
			),
			array(
				'name' 		=> 'UXbarn Testimonials',
				'slug' 		=> 'uxbarn-testimonials',
				'source'	=> get_template_directory() . '/includes/plugin-packages/UXbarnTestimonials_1.0.3.zip',
				'required' 	=> true,
				'version' 	=> '1.0.3',
			),
			
	        array(
	            'name' 		=> 'Contact Form 7',
	            'slug' 		=> 'contact-form-7',
	            'required' 	=> false,
	            'version' 	=> '',
	        ),
	        array(
	            'name' 		=> 'Simple Page Sidebars',
	            'slug' 		=> 'simple-page-sidebars',
	            'required' 	=> true,
	            'version' 	=> '',
	        ),
	        
	    );
	
	    $config = array(
	        'parent_menu_slug'  => 'themes.php', // Default parent menu slug
	        'parent_url_slug'   => 'themes.php', // Default parent URL slug
	        'menu'              => 'install-required-plugins', // Menu slug
	    );
		
	    tgmpa( $plugins, $config );
		
	}

}



/***** WooCommerce *****/
if ( ! function_exists( 'uxbarn_init_woocommerce' ) ) {
	
	function uxbarn_init_woocommerce() {
		
	    // Change main wrapper
		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
		remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
		add_action( 'woocommerce_before_main_content', 'uxbarn_wooc_theme_wrapper_start', 10 );
		add_action( 'woocommerce_after_main_content', 'uxbarn_wooc_theme_wrapper_end', 10 );
		
		// Remove breadcrumbs
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
		
		// Remove WooCommerce default sidebar (use our own predefined)
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
		
		// Remove default shop page title
		add_filter( 'woocommerce_show_page_title', 'uxbarn_wooc_remove_shop_page_title' );
		
		// Remove default product category description
		remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
		remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );
		
		
		// Set a number of columns for the shop page and archive page
		if ( is_shop() || is_product_category() ) {
			
			$columns_option = '3';
			if ( function_exists( 'ot_get_option' ) ) {
				$columns_option = ot_get_option( 'uxbarn_to_setting_wooc_number_of_columns', '3' ); // get from Theme Options
			}
			add_filter( 'loop_shop_columns', create_function( '', 'return ' . $columns_option . ';' ) );
			
		}
		
		
		// Set a number of products per page
		$products_number_option = '15';
		if ( function_exists( 'ot_get_option' ) ) {
			$products_number_option = ot_get_option( 'uxbarn_to_setting_wooc_number_of_products', '15' ); // get from Theme Options
		}
		
		if ( ! is_numeric( $products_number_option ) ) {
			$products_number_option = '15';
		}
		add_filter( 'loop_shop_per_page', create_function( '$cols', 'return ' . $products_number_option . ';' ), 20 );
		
		
		// Change up-sell and related-product sections to use our own action and function
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
		add_action( 'uxbarn_woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
		
		$display_related_product = 'true';
		if ( function_exists( 'ot_get_option' ) ) {
			$display_related_product = ot_get_option( 'uxbarn_to_setting_wooc_display_related_product', 'true' );
		}
		if ( $display_related_product == 'true' ) {
			add_action( 'uxbarn_woocommerce_after_single_product_summary', 'uxbarn_woocommerce_output_related_products', 20 );
		}
		
		// Create theme filters for updating image sizes specifically for the theme (only if they have not been updated in the first time yet)
		if ( ! get_option( 'uxbarn_are_wooc_image_sizes_already_updated' ) ) {
			
			add_filter( 'uxbarn_filter_update_wooc_image_sizes', 'uxbarn_update_wooc_image_sizes' );
			apply_filters( 'uxbarn_filter_update_wooc_image_sizes', array( 'shop_thumbnail', '125', '125', 1 ) );
			apply_filters( 'uxbarn_filter_update_wooc_image_sizes', array( 'shop_catalog', '340', '340', 1 ) );
			apply_filters( 'uxbarn_filter_update_wooc_image_sizes', array( 'shop_single', '406', '406', 1 ) );
			
			add_option( 'uxbarn_are_wooc_image_sizes_already_updated', true );
			
		} 
		
		// Disable WooCommerce default styles 
		if ( version_compare( WOOCOMMERCE_VERSION, '2.1' ) >= 0 ) {
			add_filter( 'woocommerce_enqueue_styles', '__return_false' );
		} else {
			define( 'WOOCOMMERCE_USE_CSS', false );
		}
		
	}
	
}



if ( ! function_exists( 'uxbarn_woocommerce_output_related_products' ) ) {
		
	function uxbarn_woocommerce_output_related_products() {
		
		$max_number = 4;
		if ( function_exists( 'ot_get_option' ) ) {
			$max_number = (int)ot_get_option( 'uxbarn_to_setting_wooc_max_related_products', 4 ); // get from Theme Options
		}
		
		// Set max number of Related Products section
		if ( version_compare( WOOCOMMERCE_VERSION, '2.1' ) >= 0 ) { // For later than v2.1
			
			$args = array(
				'posts_per_page' => $max_number,
				'columns' => 4,
				'orderby' => 'rand'
			);
	
			woocommerce_related_products( apply_filters( 'woocommerce_output_related_products_args', $args ) );
			
		} else {
			
			woocommerce_related_products( $max_number, 4 ); // 4 products max, 4 columns (not used because the theme is using 4-columns layout by default)
			
		}
		
	}

}



if ( ! function_exists( 'uxbarn_wooc_register_sidebars' ) ) {
		
	function uxbarn_wooc_register_sidebars() {
		
		// Shop page sidebar
		register_sidebar( array (
		        'name' 			=> __( 'Shop Page Sidebar', 'uxbarn' ),
		        'id' 			=> 'uxbarn-wooc-shop-page-sidebar',
		        'description' 	=> __( 'Sidebar for WooCommerce shop and archive page.', 'uxbarn' ),
		        'before_widget' => '<div id="%1$s" class="%2$s widget-item row"><div class="uxb-col large-12 columns"><div class="inner-widget-item">',
		        'after_widget' 	=> '</div></div></div>',
		        'before_title' 	=> '<h4>',
		        'after_title' 	=> '</h4>',
	        )
	    );
			
	}

}



if ( ! function_exists( 'uxbarn_wooc_remove_shop_page_title' ) ) {
		
	function uxbarn_wooc_remove_shop_page_title() {
		return '';
	}

}



if ( ! function_exists( 'uxbarn_update_wooc_image_sizes' ) ) {
	
	function uxbarn_update_wooc_image_sizes( $image_size_array ) {
		
	    $size = array(
					'width' 	=> $image_size_array[1],
					'height' 	=> $image_size_array[2],
					'crop' 		=> $image_size_array[3],
				);
				
		update_option( $image_size_array[0] . '_image_size', $size );
		
	}
	
}
	
			

if ( ! function_exists( 'uxbarn_wooc_theme_wrapper_start' ) ) {
	
	function uxbarn_wooc_theme_wrapper_start() {
		
		$class = '';
		$shop_sidebar_wrapper_start = '';
		
		if ( is_shop() ) {
			
			$class = ' shop-page ';
			
			$sidebar_appearance = ot_get_option( 'uxbarn_to_setting_wooc_shop_page_sidebar', 'none' ); // get from Theme Options
			$content_class = '';
	        $sidebar_class = '';
	        $content_column_class = ' large-9 ';
			
			if ( $sidebar_appearance != 'none' ) {
				
				if ( $sidebar_appearance == 'left' ) {
	                
	                $content_class = ' push-3 ';
	                $sidebar_class = ' pull-9 ';
	                
	            }
	            
	            $content_class .= ' with-sidebar ';
				$shop_sidebar_wrapper_start = '<div class="row"><div class="uxb-col ' . $content_column_class . ' columns ' . $content_class . '">';
				
			}
			
		}
		
		if ( is_product_category() ) {
			$class = ' product-category-page ';
		}
		
		
	    echo '<div id="wooc-content-container" class="columns-content-width ' . $class . '">' . $shop_sidebar_wrapper_start;
	}
	
}



if ( ! function_exists( 'uxbarn_wooc_theme_wrapper_end' ) ) {
	
	function uxbarn_wooc_theme_wrapper_end() {
		
		$shop_sidebar_wrapper_end = '';
		$display_shop_sidebar_content = false;
		
		if ( is_shop() ) {
			
			$sidebar_appearance = ot_get_option( 'uxbarn_to_setting_wooc_shop_page_sidebar', 'none' ); // get from Theme Options
	        $sidebar_class = '';
			
			if ( $sidebar_appearance != 'none' ) {
				
				if ( $sidebar_appearance == 'left' ) {
	                $sidebar_class = ' pull-9 ';
	            }
				
	            $shop_sidebar_wrapper_end = '</div></div>';
				$display_shop_sidebar_content = true;
				
			}

		}
		
	    echo '</div>';
		
		if ( $display_shop_sidebar_content ) : 
	    ?>
	    	<div id="sidebar-wrapper" class="uxb-col large-3 columns <?php echo $sidebar_class; ?>"><?php dynamic_sidebar( 'uxbarn-wooc-shop-page-sidebar' ); ?></div>
	    <?php
		endif;
		
	    echo $shop_sidebar_wrapper_end;
	}
	
}



if ( ! function_exists( 'uxbarn_load_wooc_assets' ) ) {
	
	function uxbarn_load_wooc_assets() {
		
		wp_register_style( 'uxbarn-woocommerce', get_template_directory_uri() . '/css/woocommerce-custom.css', false );
		wp_register_style( 'uxbarn-woocommerce-2.1', get_template_directory_uri() . '/css/woocommerce-custom-2.1.css', false );
		wp_enqueue_style( 'uxbarn-woocommerce' );
		
		if ( version_compare( WOOCOMMERCE_VERSION, '2.1' ) >= 0 ) {
			wp_enqueue_style( 'uxbarn-woocommerce-2.1' );
		}
		
		wp_register_script( 'uxbarn-scrollintoview', get_template_directory_uri() . '/js/jquery.scrollintoview.min.js', array( 'jquery' ), null );
		
		// Disable WooCommerce's lightbox to use our own on the product single page
		if ( is_product() ) {
			
			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
			wp_dequeue_script( 'prettyPhoto' );
			wp_dequeue_script( 'prettyPhoto-init' );
			
			wp_enqueue_script( 'uxbarn-mousewheel' );
			wp_enqueue_style( 'uxbarn-fancybox' );
			wp_enqueue_script( 'uxbarn-fancybox' );
			wp_enqueue_style( 'uxbarn-fancybox-helpers-thumbs' );
			wp_enqueue_script( 'uxbarn-fancybox-helpers-thumbs' );
			
			wp_enqueue_script( 'uxbarn-scrollintoview' );
			
		}

	}
	
}



if ( ! function_exists( 'uxbarn_load_wooc_admin_assets' ) ) {
	
	function uxbarn_load_wooc_admin_assets( $page ) {
		
		if ( $page == 'woocommerce_page_woocommerce_settings' || 
			 $page == 'woocommerce_page_wc-settings' ) { // For WooC v2.1
			wp_enqueue_script( 'uxbarn-admin-wooc', get_template_directory_uri() . '/js/theme-wooc.js', false, false, true );
		}
		
	}
	
}



/***** LayerSlider *****/
if ( ! function_exists( 'uxbarn_layerslider_overrides' ) ) {
	
	function uxbarn_layerslider_overrides() {
	    // Disable auto-update feature
	    $GLOBALS['lsAutoUpdateBox'] = false;
	}
	
}



/***** OptionTree *****/
// Hide the "Settings" menu of OptionTree 
if ( ! function_exists( 'uxbarn_hide_ot_admin_menu' ) ) {
	
	function uxbarn_hide_ot_admin_menu() {
	    echo '<style type="text/css">#toplevel_page_ot-settings{display:none;}</style>';
	}
	
}



// To register OptionTree's "Theme Options" menu at the root of admin panel.
function ot_register_theme_options_page() {
  
    /* get the settings array */
    $get_settings = get_option( 'option_tree_settings' );
    
    /* sections array */
    $sections = isset( $get_settings['sections'] ) ? $get_settings['sections'] : array();
    
    /* settings array */
    $settings = isset( $get_settings['settings'] ) ? $get_settings['settings'] : array();
    
    /* contexual_help array */
    $contextual_help = isset( $get_settings['contextual_help'] ) ? $get_settings['contextual_help'] : array();
    
    /* build the Theme Options */
    if ( function_exists( 'ot_register_settings' ) && OT_USE_THEME_OPTIONS ) {
      
      ot_register_settings( array(
          array(
            'id'                  => 'option_tree',
            'pages'               => array( 
              array(
                'id'              => 'ot_theme_options',
                'parent_slug'     => '',
                'page_title'      => apply_filters( 'ot_theme_options_page_title', __( 'Theme Options', 'uxbarn' ) ),
                'menu_title'      => apply_filters( 'ot_theme_options_menu_title', __( 'Theme Options', 'uxbarn' ) ),
                'capability'      => $caps = apply_filters( 'ot_theme_options_capability', 'edit_theme_options' ),
                'menu_slug'       => apply_filters( 'ot_theme_options_menu_slug', 'ot-theme-options' ),
                'icon_url'        => apply_filters( 'ot_theme_options_icon_url', UXB_THEME_ROOT_IMAGE_URL . 'admin/uxbarn_sm.jpg' ),
                'position'        => apply_filters( 'ot_theme_options_position', null ),
                'updated_message' => apply_filters( 'ot_theme_options_updated_message', __( 'Theme Options updated.', 'uxbarn' ) ),
                'reset_message'   => apply_filters( 'ot_theme_options_reset_message', __( 'Theme Options reset.', 'uxbarn' ) ),
                'button_text'     => apply_filters( 'ot_theme_options_button_text', __( 'Save Changes', 'uxbarn' ) ),
                'screen_icon'     => 'themes',
                'contextual_help' => $contextual_help,
                'sections'        => $sections,
                'settings'        => $settings
              )
            )
          )
        ) 
      );
      
      // Filters the options.php to add the minimum user capabilities.
      add_filter( 'option_page_capability_option_tree', create_function( '$caps', "return '$caps';" ), 999 );
    
    }
  
}



/***** Visual Composer *****/
// Remove default VC elements
if ( ! function_exists( 'uxbarn_remove_default_vc_elements' ) ) {
	
    function uxbarn_remove_default_vc_elements() {
        
		if ( function_exists( 'vc_remove_element' ) ) {
				
			vc_remove_element( 'vc_row' ); // re-enable in mapping.php
	        vc_remove_element( 'vc_button' ); // re-enable in mapping.php
	        vc_remove_element( 'vc_twitter' );
	        vc_remove_element( 'vc_googleplus' );
	        vc_remove_element( 'vc_tweetmeme' );
	        vc_remove_element( 'vc_facebook' );
	        vc_remove_element( 'vc_pinterest' );
	        vc_remove_element( 'vc_single_image' ); // re-enable in mapping.php
	        vc_remove_element( 'vc_gallery' ); // re-enable in mapping.php
	        vc_remove_element( 'vc_tabs' ); // re-enable in mapping.php
	        vc_remove_element( 'vc_tour' ); // re-enable in mapping.php
	        vc_remove_element( 'vc_accordion' ); // re-enable in mapping.php
	        vc_remove_element( 'vc_toggle' );
	        //vc_remove_element( 'vc_separator' );
	        vc_remove_element( 'vc_progress_bar' ); // re-enable in mapping.php
	        vc_remove_element( 'vc_cta_button' ); // re-enable in mapping.php
	        vc_remove_element( 'vc_message' ); // re-enable in mapping.php
	        vc_remove_element( 'vc_text_separator' );
	        vc_remove_element( 'vc_teaser_grid' ); // depreciated since VC 3.7.1. use vc_posts_grid instead
	        vc_remove_element( 'vc_posts_slider' );
	        vc_remove_element( 'vc_video' ); // re-enable in mapping.php
	        vc_remove_element( 'vc_gmaps' ); // re-enable in mapping.php
	        vc_remove_element( 'vc_raw_html' ); // re-enable in mapping.php
	        vc_remove_element( 'vc_raw_js' ); // re-enable in mapping.php
	        vc_remove_element( 'vc_flickr' ); // re-enable in mapping.php
	        vc_remove_element( 'vc_wp_search' ); // re-enable in mapping.php
	        vc_remove_element( 'vc_wp_meta' );
	        vc_remove_element( 'vc_wp_recentcomments' );
	        vc_remove_element( 'vc_wp_calendar' );
	        vc_remove_element( 'vc_wp_pages' );
	        vc_remove_element( 'vc_wp_tagcloud' );
	        vc_remove_element( 'vc_wp_custommenu' );
	        vc_remove_element( 'vc_wp_text' );
	        vc_remove_element( 'vc_wp_posts' );
	        vc_remove_element( 'vc_wp_links' );
	        vc_remove_element( 'vc_wp_categories' );
	        vc_remove_element( 'vc_wp_archives' );
	        vc_remove_element( 'vc_wp_rss' );
	        vc_remove_element( 'vc_widget_sidebar' );
	        vc_remove_element( 'contact-form-7' ); // re-enable in mapping.php
	        vc_remove_element( 'layerslider_vc' ); // re-enable in mapping.php
	        vc_remove_element( 'gravityform' ); // re-enable in mapping.php
			vc_remove_element( 'vc_pie' ); // re-enable in mapping.php
			
			// From 3.7.1
			vc_remove_element( 'vc_posts_grid' ); // re-enable in mapping.php
			vc_remove_element( 'vc_carousel' );
			vc_remove_element( 'vc_images_carousel' );
			
			// From 4.0.2
			//vc_remove_element( 'vc_button2' );
			vc_remove_element( 'vc_cta_button2' );
			
		}
        
    }

}



// Register custom params and customize some interfaces of VC elements
if ( ! function_exists( 'uxbarn_init_vc_element_interfaces' ) ) {
		
	function uxbarn_init_vc_element_interfaces() {
		
		require_once( get_template_directory() . '/includes/plugin-codes/visual-composer/param-array.php' );
		
		if ( function_exists( 'vc_map' ) ) {
			require_once( get_template_directory() . '/includes/plugin-codes/visual-composer/mapping.php' );
		}
		
		
		
		// Modify VC element orders (since theme v1.5.0)
		if ( function_exists( 'vc_map_update' ) ) {
			
			if ( shortcode_exists( 'vc_row' ) ) vc_map_update( 'vc_row', array( 'weight' => 500 ) );
			if ( shortcode_exists( 'vc_column_text' ) ) vc_map_update( 'vc_column_text', array( 'weight' => 495 ) );
			if ( shortcode_exists( 'uxb_heading' ) ) vc_map_update( 'uxb_heading', array( 'weight' => 490 ) );
			
			// New VC element since VC 4.3.2
			if ( shortcode_exists( 'vc_custom_heading' ) ) vc_map_update( 'vc_custom_heading', array( 'weight' => 485 ) );
			
			if ( shortcode_exists( 'vc_button' ) ) vc_map_update( 'vc_button', array( 'weight' => 480 ) );
			if ( shortcode_exists( 'vc_button2' ) ) vc_map_update( 'vc_button2', array( 'weight' => 475 ) );
			if ( shortcode_exists( 'uxb_icon' ) ) vc_map_update( 'uxb_icon', array( 'weight' => 470 ) );
			if ( shortcode_exists( 'vc_single_image' ) ) vc_map_update( 'vc_single_image', array( 'weight' => 465 ) );
			if ( shortcode_exists( 'vc_video' ) ) vc_map_update( 'vc_video', array( 'weight' => 460 ) );
			
			if ( shortcode_exists( 'uxb_blockquote' ) ) vc_map_update( 'uxb_blockquote', array( 'weight' => 455 ) );
			if ( shortcode_exists( 'vc_message' ) ) vc_map_update( 'vc_message', array( 'weight' => 450 ) );
			if ( shortcode_exists( 'vc_gmaps' ) ) vc_map_update( 'vc_gmaps', array( 'weight' => 445 ) );
			if ( shortcode_exists( 'vc_gallery' ) ) vc_map_update( 'vc_gallery', array( 'weight' => 440 ) );
			if ( shortcode_exists( 'vc_flickr' ) ) vc_map_update( 'vc_flickr', array( 'weight' => 435 ) );
			
			if ( shortcode_exists( 'vc_tabs' ) ) vc_map_update( 'vc_tabs', array( 'weight' => 430 ) );
			if ( shortcode_exists( 'vc_tour' ) ) vc_map_update( 'vc_tour', array( 'weight' => 425 ) );
			if ( shortcode_exists( 'vc_accordion' ) ) vc_map_update( 'vc_accordion', array( 'weight' => 420 ) );
			if ( shortcode_exists( 'uxb_divider' ) ) vc_map_update( 'uxb_divider', array( 'weight' => 415 ) );
			if ( shortcode_exists( 'vc_separator' ) ) vc_map_update( 'vc_separator', array( 'weight' => 410 ) );
			
			// New VC element since VC 4.3.2
			if ( shortcode_exists( 'vc_empty_space' ) ) vc_map_update( 'vc_empty_space', array( 'weight' => 405 ) );
			if ( shortcode_exists( 'vc_pie' ) ) vc_map_update( 'vc_pie', array( 'weight' => 400 ) );
			if ( shortcode_exists( 'vc_progress_bar' ) ) vc_map_update( 'vc_progress_bar', array( 'weight' => 395 ) );
			if ( shortcode_exists( 'vc_cta_button' ) ) vc_map_update( 'vc_cta_button', array( 'weight' => 390 ) );
			if ( shortcode_exists( 'vc_posts_grid' ) ) vc_map_update( 'vc_posts_grid', array( 'weight' => 370 ) );
			
			if ( shortcode_exists( 'vc_wp_search' ) ) vc_map_update( 'vc_wp_search', array( 'weight' => 365 ) );
			
		}
		
	}
	
}



// Customize the VC rows and columns to use theme's Foundation framework
if ( ! function_exists( 'uxbarn_customize_custom_css_classes' ) ) {
	
    function uxbarn_customize_vc_rows_columns( $class_string, $tag ) {
            
        // vc_row 
        if ( $tag == 'vc_row' || $tag == 'vc_row_inner' ) {
        	
            $replace = array(
                'vc_row-fluid' 	=> 'row',
                'wpb_row' 		=> '',
            );
			
            $class_string = uxbarn_replace_string_with_assoc_array( $replace, $class_string );
			
        }
        
        // vc_column
        if ( $tag == 'vc_column' || $tag == 'vc_column_inner' ) {
        	
            $replace = array(
                'wpb_column' 		=> '',
                'column_container' 	=> '',
            );
			
            $to_be_replaced = array( '', '' );
            
            $class_string = uxbarn_replace_string_with_assoc_array(
                                $replace, preg_replace( '/vc_span(\d{1,2})/', 'uxb-col large-$1 columns', $class_string )
                            );
							
			// Custom columns	
			$class_string = uxbarn_replace_string_with_assoc_array(
                                $replace, preg_replace( '/vc_(\d{1,2})\\/12/', 'uxb-col large-$1 columns', $class_string )
                            );
							
			// VC 4.3.x (it changed the tags)
			$class_string = uxbarn_replace_string_with_assoc_array(
                                $replace, preg_replace('/vc_col-(xs|sm|md|lg)-(\d{1,2})/', 'uxb-col large-$2 columns', $class_string)
                            );
							
        }
        
        return $class_string;
		
    }

}



// Unused for now (use CSS in admin.css instead)
if ( ! function_exists( 'uxbarn_remove_vc_metabox' ) ) {
	
	function uxbarn_remove_vc_metabox() {
		
		remove_meta_box( 'vc_teaser', 'post', 'side' );
		remove_meta_box( 'vc_teaser', 'page', 'side' );
		
	}

}



if ( ! function_exists( 'uxbarn_load_custom_vc_js' ) ) {
	
    function uxbarn_load_custom_vc_js() {
        // ---------------------------------
        // wpb_composer_front_js (v4.3.2)
        // ---------------------------------
        // Main purposes are to: 
        // 1. Unload script of vc accordion to use our own
        // 2. Fix the conflict with Theme Customizer in "vc_tabsBehaviour()", so the function is commented out
        wp_deregister_script( 'wpb_composer_front_js' );
        wp_register_script( 'wpb_composer_front_js', get_template_directory_uri() . '/includes/plugin-codes/visual-composer/js/js_composer_front.js', array( 'jquery' ), WPB_VC_VERSION, true );
    }
	
}