<?php

/**
 * Build the custom settings & update OptionTree.
 */
if ( ! function_exists( 'uxbarn_custom_theme_options' ) ) {
    
    function uxbarn_custom_theme_options() {
      /**
       * Get a copy of the saved settings array. 
       */
      $saved_settings = get_option( 'option_tree_settings', array() );
      
      /**
       * Custom settings array that will eventually be 
       * passes to the OptionTree Settings API Class.
       */
      $custom_settings = array( 
        'contextual_help' => array(
          
          'sidebar'       => ''
        ),
        
        // Sections
        
        'sections'        => array( 
          array(
            'id'          => 'uxbarn_to_general_section',
            'title'       => __( 'General', 'uxbarn' )
          ),
          array(
            'id'          => 'uxbarn_to_home_slider_section',
            'title'       => __( 'Home Slider', 'uxbarn' )
          ),
          array(
            'id'          => 'uxbarn_to_blog_section',
            'title'       => __( 'Blog', 'uxbarn' )
          ),
          array(
            'id'          => 'uxbarn_to_footer_section',
            'title'       => __( 'Footer', 'uxbarn' )
          ),
          array(
            'id'          => 'uxbarn_to_social_network_section',
            'title'       => __( 'Social Network', 'uxbarn' )
          ),
          array(
            'id'          => 'uxbarn_to_google_fonts_section',
            'title'       => __( 'Google Fonts', 'uxbarn' )
          ),
          array(
            'id'          => 'uxbarn_to_wpml_section',
            'title'       => __( 'WPML Plugin', 'uxbarn' )
          ),
          array(
            'id'          => 'uxbarn_to_woocommerce_section',
            'title'       => __( 'WooCommerce Plugin', 'uxbarn' )
          ),
        ),
        'settings'        => array( 
            
              // General Tab
            
              array(
                'id'          => 'uxbarn_to_setting_upload_favicon',
                'label'       => __( 'Upload Favicon', 'uxbarn' ),
                'desc'        => __( 'Favicon will be displayed on the address bar and tab of the browser. Click the icon to upload the image or if you already know the URL of the image, just paste it to the box.', 'uxbarn' ),
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'uxbarn_to_general_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => ''
              ),
              
			  array(
                'id'          => 'uxbarn_to_setting_header_style',
                'label'       => __( 'Header Style', 'uxbarn' ),
                'desc'        => __( 'Select which header style to use.', 'uxbarn' ),
                'std'         => 'columned-menu',
                'type'        => 'select',
                'section'     => 'uxbarn_to_general_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'columned-menu',
                    'label'       => __( 'Left logo + columned menus (Default)', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'horizontal-menu',
                    'label'       => __( 'Center logo + horizontal menus', 'uxbarn' ),
                    'src'         => ''
                  )
                ),
              ),
			  
			  array(
                'id'          => 'uxbarn_to_setting_display_tagline',
                'label'       => __( 'Display Tagline?', 'uxbarn' ),
                'desc'        => __( 'Whether to display the site tagline under the logo.', 'uxbarn' ),
                'std'         => 'true',
                'type'        => 'radio',
                'section'     => 'uxbarn_to_general_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'true',
                    'label'       => __( 'Yes', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'false',
                    'label'       => __( 'No', 'uxbarn' ),
                    'src'         => ''
                  )
                ),
              ),
			  
			  array(
                'id'          => 'uxbarn_to_setting_enable_header_search',
                'label'       => __( 'Display Header Search?', 'uxbarn' ),
                'desc'        => __( 'Whether to enable the search feature on the header.', 'uxbarn' ),
                'std'         => 'true',
                'type'        => 'radio',
                'section'     => 'uxbarn_to_general_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'true',
                    'label'       => __( 'Yes', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'false',
                    'label'       => __( 'No', 'uxbarn' ),
                    'src'         => ''
                  )
                ),
              ),
              
			  array(
                'id'          => 'uxbarn_to_setting_display_scrollup_button',
                'label'       => __( 'Display Back-To-Top Button?', 'uxbarn' ),
                'desc'        => __( 'Whether to enable and display back-to-top button.', 'uxbarn' ),
                'std'         => 'false',
                'type'        => 'radio',
                'section'     => 'uxbarn_to_general_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'true',
                    'label'       => __( 'Yes', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'false',
                    'label'       => __( 'No', 'uxbarn' ),
                    'src'         => ''
                  )
                ),
              ),
			  
              array(
                'id'          => 'uxbarn_to_setting_enable_lightbox_wp_gallery',
                'label'       => __( 'Enable Lightbox for WordPress Gallery?', 'uxbarn' ),
                'desc'        => __( 'Whether to enable lightbox feature for WordPress gallery shortcode. <br/><br/><strong>Note:</strong> Also make sure that you already set the "Link To" option to "Media File" in your gallery shortcode.', 'uxbarn' ),
                'std'         => 'true',
                'type'        => 'radio',
                'section'     => 'uxbarn_to_general_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'true',
                    'label'       => __( 'Yes', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'false',
                    'label'       => __( 'No', 'uxbarn' ),
                    'src'         => ''
                  )
                ),
              ),
              
              array(
                'id'          => 'uxbarn_to_setting_enable_page_comment',
                'label'       => __( 'Enable Page Comment?', 'uxbarn' ),
                'desc'        => __( 'Whether to enable the comment function for all Page by default.<br/><br/>When you have enabled it, please make sure that each Page is also marked as "Allow Comments". You can find that mark from the Quick Edit menu of the Page.', 'uxbarn' ),
                'std'         => 'false',
                'type'        => 'radio',
                'section'     => 'uxbarn_to_general_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'true',
                    'label'       => __( 'Yes', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'false',
                    'label'       => __( 'No', 'uxbarn' ),
                    'src'         => ''
                  )
                ),
              ),
              
              
              
              
              // Home Slider Tab
              
              array(
                'id'          => 'uxbarn_to_setting_display_home_slider',
                'label'       => __( 'Display Home Slider?', 'uxbarn' ),
                'desc'        => __( 'Whether to display the slider on homepage.', 'uxbarn' ),
                'std'         => 'true',
                'type'        => 'radio',
                'section'     => 'uxbarn_to_home_slider_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'true',
                    'label'       => __( 'Yes', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'false',
                    'label'       => __( 'No', 'uxbarn' ),
                    'src'         => ''
                  )
                ),
              ),
              
              array(
                'id'          => 'uxbarn_to_setting_select_slider',
                'label'       => __( 'Slider Type', 'uxbarn' ),
                'desc'        => __( 'Select which slider type you would like to use on homepage:<br/><br/><strong>Default Slider:</strong> This is the default one. You can use "Home Slider" menu on your admin panel to manage slides for this type.<br/><br/><strong>LayerSlider:</strong> You can manage sliders using "LayerSlider WP" menu on your admin panel. After you have created some sliders there, select this option as "LayerSlider" then paste the shortcode of the slider you want into the field below.', 'uxbarn' ),
                'std'         => 'default-slider',
                'type'        => 'select',
                'section'     => 'uxbarn_to_home_slider_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'default-slider',
                    'label'       => __( 'Default Slider', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'layerslider',
                    'label'       => __( 'LayerSlider', 'uxbarn' ),
                    'src'         => ''
                  )
                ),
              ),
              
              array(
                'id'          => 'uxbarn_to_setting_default_slider_transition',
                'label'       => __( "Home Slider's Transition Effect", 'uxbarn' ),
                'desc'        => __( 'Select the transition for basic slider.', 'uxbarn' ),
                'std'         => 'fade',
                'type'        => 'select',
                'section'     => 'uxbarn_to_home_slider_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'fade',
                    'label'       => __( 'Fade', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'slide',
                    'label'       => __( 'Slide', 'uxbarn' ),
                    'src'         => ''
                  ),
                ),
              ),
              
              array(
                'id'          => 'uxbarn_to_setting_default_slider_transition_speed',
                'label'       => __( "Home Slider's Transition Speed", 'uxbarn' ),
                'desc'        => __( 'Enter a number of how fast you want the transition to animate, in milliseconds.', 'uxbarn' ),
                'std'         => '700',
                'type'        => 'text',
                'section'     => 'uxbarn_to_home_slider_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => ''
              ),
              
              array(
                'id'          => 'uxbarn_to_setting_default_slider_auto_rotation',
                'label'       => __( "Enable Home Slider's Auto Rotation?", 'uxbarn'),
                'desc'        => __( 'Whether to enable the auto rotation mode for the slider.', 'uxbarn' ),
                'std'         => 'true',
                'type'        => 'radio',
                'section'     => 'uxbarn_to_home_slider_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'true',
                    'label'       => __( 'Yes', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'false',
                    'label'       => __( 'No', 'uxbarn' ),
                    'src'         => ''
                  )
                ),
              ),
              
              array(
                'id'          => 'uxbarn_to_setting_default_slider_rotation_duration',
                'label'       => __( "Home Slider's Rotation Delay", 'uxbarn' ),
                'desc'        => __( 'Enter a number of how long to stay on the current slide before rotating to the next one, in milliseconds.', 'uxbarn' ),
                'std'         => '8000',
                'type'        => 'text',
                'section'     => 'uxbarn_to_home_slider_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => ''
              ),
              
              array(
                'id'          => 'uxbarn_to_setting_default_slider_caption_animation',
                'label'       => __( "Enable Home Slider's Caption Animation?", 'uxbarn' ),
                'desc'        => __( 'Whether to enable the fade animation for the slider caption.', 'uxbarn' ),
                'std'         => 'true',
                'type'        => 'radio',
                'section'     => 'uxbarn_to_home_slider_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'true',
                    'label'       => __( 'Yes', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'false',
                    'label'       => __( 'No', 'uxbarn' ),
                    'src'         => ''
                  )
                ),
              ),
              
              array(
                'id'          => 'uxbarn_to_setting_layerslider_shortcode',
                'label'       => __( 'LayerSlider Shortcode', 'uxbarn' ),
                'desc'        => __( 'Paste the shortcode of the slider that you have created in "LayerSlider WP" menu. For example, [layerslider id="1"]<br/><br/>Make sure you have already installed and activated the LayerSlider plugin.', 'uxbarn' ),
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_to_home_slider_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
              ),
              
			  
              
              
              // Blog Tab
              
              array(
                'id'          => 'uxbarn_to_setting_enable_zooming_effect',
                'label'       => __( 'Enable Zooming Effect on Blog Thumbnail?', 'uxbarn' ),
                'desc'        => __( 'Whether to enable the zooming effect when hovering the mouse on the blog thumbnail on blog list page.', 'uxbarn' ),
                'std'         => 'true',
                'type'        => 'radio',
                'section'     => 'uxbarn_to_blog_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'true',
                    'label'       => __( 'Yes', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'false',
                    'label'       => __( 'No', 'uxbarn' ),
                    'src'         => ''
                  )
                ),
              ),
              
              array(
                'id'          => 'uxbarn_to_setting_blog_sidebar',
                'label'       => __( 'Blog Sidebar', 'uxbarn' ),
                'desc'        => __( 'Select how the blog sidebar displayed on the blog page (Posts page). You can manage its widgets in "Appearance > Widgets > Blog Sidebar"', 'uxbarn' ),
                'std'         => 'right',
                'type'        => 'select',
                'section'     => 'uxbarn_to_blog_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'none',
                    'label'       => __( 'Hide blog sidebar', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'right',
                    'label'       => __( 'Right side', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'left',
                    'label'       => __( 'Left side', 'uxbarn' ),
                    'src'         => ''
                  ),
                ),
              ),
              
              array(
                'id'          => 'uxbarn_to_setting_override_post_meta_info',
                'label'       => __( 'Override Post Meta Info?', 'uxbarn' ),
                'desc'        => __( 'Whether to override the meta info custom fields of all individual posts with this global setting.', 'uxbarn' ),
                'std'         => 'false',
                'type'        => 'radio',
                'section'     => 'uxbarn_to_blog_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'true',
                    'label'       => __( 'Yes', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'false',
                    'label'       => __( 'No', 'uxbarn' ),
                    'src'         => ''
                  )
                ),
              ),
              
			  array(
                'id'          => 'uxbarn_to_post_meta_info_date',
                'label'       => __( 'Show date?', 'uxbarn' ),
                'desc'        => __( 'Whether to display the date on blog posts page and single page.', 'uxbarn' ),
                'std'         => 'true',
                'type'        => 'radio',
                'section'     => 'uxbarn_to_blog_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'true',
                    'label'       => __( 'Yes', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'false',
                    'label'       => __( 'No', 'uxbarn' ),
                    'src'         => ''
                  ),
              	),
              ),
              
              array(
                'id'          => 'uxbarn_to_post_meta_info_author',
                'label'       => __( 'Show author name?', 'uxbarn' ),
                'desc'        => __( 'Whether to display the author name on blog posts page and single page.', 'uxbarn' ),
                'std'         => 'true',
                'type'        => 'radio',
                'section'     => 'uxbarn_to_blog_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'true',
                    'label'       => __( 'Yes', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'false',
                    'label'       => __( 'No', 'uxbarn' ),
                    'src'         => ''
                  ),
              	),
              ),
              
			  array(
                'id'          => 'uxbarn_to_post_meta_info_categories',
                'label'       => __( 'Show categories?', 'uxbarn' ),
                'desc'        => __( 'Whether to display the categories on blog posts page and single page.', 'uxbarn' ),
                'std'         => 'true',
                'type'        => 'radio',
                'section'     => 'uxbarn_to_blog_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'true',
                    'label'       => __( 'Yes', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'false',
                    'label'       => __( 'No', 'uxbarn' ),
                    'src'         => ''
                  ),
              	),
              ),
              
			  array(
                'id'          => 'uxbarn_to_post_meta_info_comment',
                'label'       => __( 'Show comment count?', 'uxbarn' ),
                'desc'        => __( 'Whether to display the comment count on blog posts page and single page.', 'uxbarn' ),
                'std'         => 'true',
                'type'        => 'radio',
                'section'     => 'uxbarn_to_blog_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'true',
                    'label'       => __( 'Yes', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'false',
                    'label'       => __( 'No', 'uxbarn' ),
                    'src'         => ''
                  ),
              	),
              ),
              
			  array(
                'id'          => 'uxbarn_to_post_meta_info_single_author_box',
                'label'       => __( 'Show author box on single page?', 'uxbarn' ),
                'desc'        => __( 'Whether to display the author box on the post single page.', 'uxbarn' ),
                'std'         => 'true',
                'type'        => 'radio',
                'section'     => 'uxbarn_to_blog_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'true',
                    'label'       => __( 'Yes', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'false',
                    'label'       => __( 'No', 'uxbarn' ),
                    'src'         => ''
                  ),
              	),
              ),
              
			  array(
                'id'          => 'uxbarn_to_post_meta_info_single_tags',
                'label'       => __( 'Show tags on single page?', 'uxbarn' ),
                'desc'        => __( 'Whether to display the tags list on the post single page.', 'uxbarn' ),
                'std'         => 'true',
                'type'        => 'radio',
                'section'     => 'uxbarn_to_blog_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'true',
                    'label'       => __( 'Yes', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'false',
                    'label'       => __( 'No', 'uxbarn' ),
                    'src'         => ''
                  ),
              	),
              ),
              
              
              
			  
              // Footer Tab
              
              array(
                'id'          => 'uxbarn_to_setting_display_footer_widget_area',
                'label'       => __( 'Display Footer Widget Area?', 'uxbarn' ),
                'desc'        => __( 'Whether to display the widget area in footer.', 'uxbarn' ),
                'std'         => 'true',
                'type'        => 'radio',
                'section'     => 'uxbarn_to_footer_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'true',
                    'label'       => __( 'Yes', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'false',
                    'label'       => __( 'No', 'uxbarn' ),
                    'src'         => ''
                  )
                ),
              ),
              
              array(
                'id'          => 'uxbarn_to_setting_footer_widget_area_columns',
                'label'       => __( 'Footer Widget Area Columns', 'uxbarn' ),
                'desc'        => __( 'Select a number of columns for the footer widget area.', 'uxbarn' ),
                'std'         => '4',
                'type'        => 'select',
                'section'     => 'uxbarn_to_footer_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => '1',
                    'label'       => __( '1 Column', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => '2',
                    'label'       => __( '2 Columns', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => '3',
                    'label'       => __( '3 Columns', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => '4',
                    'label'       => __( '4 Columns', 'uxbarn' ),
                    'src'         => ''
                  )
                ),
              ),
              
              array(
                'id'          => 'uxbarn_to_setting_copyright_text',
                'label'       => __( 'Copyright Text', 'uxbarn' ),
                'desc'        => __( 'This copyright text will be displayed in the footer below the widget area.<br/><br/><strong>Important: </strong>If you use some HTML tag like anchor tag for a link, make sure to have the opening and closing tag properly.', 'uxbarn' ),
                'std'         => '2013 &copy; Fineliner. Premium Theme by <a href="http://themeforest.net/user/UXbarn?ref=UXbarn">UXbarn</a>.',
                'type'        => 'text',
                'section'     => 'uxbarn_to_footer_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => ''
              ),
              
    		  
    		  
    		  // Social Network Tab
              
              array(
                'id'          => 'uxbarn_to_setting_social_set',
                'label'       => __( 'Social Icon Set', 'uxbarn' ),
                'desc'        => __( 'Select whether to use the default built-in set or define your own set for social icons.', 'uxbarn' ),
                'std'         => 'default',
                'type'        => 'select',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'default',
                    'label'       => __( 'Default Set', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'custom',
                    'label'       => __( 'Custom Set', 'uxbarn' ),
                    'src'         => ''
                  ),
                ),
              ),
              
			  array(
		        'id'          => 'uxbarn_to_setting_social_custom_set',
		        'label'       => __( 'Custom Social Network Icons', 'uxbarn' ),
		        'desc'        => __( 'You can use this option to add your own list of social network icon. Just click "Add New" button, enter the title, URL and upload the icon image. You can also rearrange the positions using drag-and-drop feature here.', 'uxbarn' ),
		        'std'         => '',
		        'type'        => 'list-item',
		        'section'     => 'uxbarn_to_social_network_section',
		        'rows'        => '',
		        'post_type'   => '',
		        'taxonomy'    => '',
		        'min_max_step'=> '',
		        'class'       => 'social-custom-set',
		        'condition'   => '',
		        'operator'    => 'and',
		        'settings'    => array( 
		          array(
		            'id'          => 'uxbarn_to_setting_social_custom_set_url',
		            'label'       => __( 'URL', 'uxbarn' ),
		            'desc'        => __( 'Enter the URL for this social icon', 'uxbarn' ),
		            'std'         => '',
		            'type'        => 'text',
		            'rows'        => '',
		            'post_type'   => '',
		            'taxonomy'    => '',
		            'min_max_step'=> '',
		            'class'       => '',
		            'condition'   => '',
		            'operator'    => 'and'
		          ),
		          array(
		            'id'          => 'uxbarn_to_setting_social_custom_set_icon',
		            'label'       => __( 'Icon', 'uxbarn' ),
		            'desc'        => __( 'Upload an image for this social icon', 'uxbarn' ),
		            'std'         => '',
		            'type'        => 'upload',
		            'rows'        => '',
		            'post_type'   => '',
		            'taxonomy'    => '',
		            'min_max_step'=> '',
		            'class'       => '',
		            'condition'   => '',
		            'operator'    => 'and'
		          )
		        )
		      ),
              
              array(
                'id'          => 'uxbarn_to_setting_social_facebook',
                'label'       => __( 'Facebook URL', 'uxbarn' ),
                'desc'        => '',
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_facebook_upload',
                'label'       => __( 'Facebook Icon', 'uxbarn' ),
                'desc'        => __( "You can leave it blank to use theme's default icon.", 'uxbarn' ),
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_twitter',
                'label'       => __( 'Twitter URL', 'uxbarn' ),
                'desc'        => '',
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_twitter_upload',
                'label'       => __( 'Twitter Icon', 'uxbarn' ),
                'desc'        => __( "You can leave it blank to use theme's default icon.", 'uxbarn' ),
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_google_plus',
                'label'       => __( 'Google+ URL', 'uxbarn' ),
                'desc'        => '',
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_google_plus_upload',
                'label'       => __( 'Google+ Icon', 'uxbarn' ),
                'desc'        => __( "You can leave it blank to use theme's default icon.", 'uxbarn' ),
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_linkedin',
                'label'       => __( 'LinkedIn URL', 'uxbarn' ),
                'desc'        => '',
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_linkedin_upload',
                'label'       => __( 'LinkedIn Icon', 'uxbarn' ),
                'desc'        => __( "You can leave it blank to use theme's default icon.", 'uxbarn' ),
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_flickr',
                'label'       => __( 'Flickr URL', 'uxbarn' ),
                'desc'        => '',
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_flickr_upload',
                'label'       => __( 'Flickr Icon', 'uxbarn' ),
                'desc'        => __( "You can leave it blank to use theme's default icon.", 'uxbarn' ),
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_behance',
                'label'       => __( 'Behance URL', 'uxbarn' ),
                'desc'        => '',
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_behance_upload',
                'label'       => __( 'Behance Icon', 'uxbarn' ),
                'desc'        => __( "You can leave it blank to use theme's default icon.", 'uxbarn' ),
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_dribbble',
                'label'       => __( 'Dribbble URL', 'uxbarn' ),
                'desc'        => '',
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_dribbble_upload',
                'label'       => __( 'Dribbble Icon', 'uxbarn' ),
                'desc'        => __( "You can leave it blank to use theme's default icon.", 'uxbarn' ),
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_forrst',
                'label'       => __( 'Forrst URL', 'uxbarn' ),
                'desc'        => '',
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_forrst_upload',
                'label'       => __( 'Forrst Icon', 'uxbarn' ),
                'desc'        => __( "You can leave it blank to use theme's default icon.", 'uxbarn' ),
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_vimeo',
                'label'       => __( 'Vimeo URL', 'uxbarn' ),
                'desc'        => '',
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_vimeo_upload',
                'label'       => __( 'Vimeo Icon', 'uxbarn' ),
                'desc'        => __( "You can leave it blank to use theme's default icon.", 'uxbarn' ),
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_youtube',
                'label'       => __( 'YouTube URL', 'uxbarn' ),
                'desc'        => '',
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_youtube_upload',
                'label'       => __( 'YouTube Icon', 'uxbarn' ),
                'desc'        => __( "You can leave it blank to use theme's default icon.", 'uxbarn' ),
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_tumblr',
                'label'       => __( 'Tumblr URL', 'uxbarn' ),
                'desc'        => '',
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_tumblr_upload',
                'label'       => __( 'Tumblr Icon', 'uxbarn' ),
                'desc'        => __( "You can leave it blank to use theme's default icon.", 'uxbarn' ),
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_github',
                'label'       => __( 'Github URL', 'uxbarn' ),
                'desc'        => '',
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_github_upload',
                'label'       => __( 'Github Icon', 'uxbarn' ),
                'desc'        => __( "You can leave it blank to use theme's default icon.", 'uxbarn' ),
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_rss',
                'label'       => __( 'RSS URL', 'uxbarn' ),
                'desc'        => '',
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_rss_upload',
                'label'       => __( 'RSS Icon', 'uxbarn' ),
                'desc'        => __( "You can leave it blank to use theme's default icon.", 'uxbarn' ),
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              
              
              
              // Google Fonts Tab
              
              array(
                'id'          => 'uxbarn_to_setting_google_fonts_loader',
                'label'       => __( 'Google Fonts Loader', 'uxbarn' ),
                'desc'        => __( 'To enable Google Fonts selection, please go to <a href="http://www.google.com/webfonts#" target="_blank">Google Web Fonts website</a>, select the fonts you like, copy the family list then paste them to this textbox. After that simply press "Save Changes" button and the fonts will be loaded to all font select lists in Style Customizer.<br/><br/>Please read more detail about this in the provided documentation under the section of "Getting Started > Google Fonts".</p>', 'uxbarn' ),
                'std'         => UXB_DEFAULT_GOOGLE_FONTS,
                'type'        => 'textarea-simple',
                'section'     => 'uxbarn_to_google_fonts_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => ''
              ),
              array(
                'id'          => 'uxbarn_to_setting_google_fonts_character_sets',
                'label'       => __( 'Character Sets', 'uxbarn'),
                'desc'        => __( 'Choose the character sets you want. If you have no idea what is this, just leave them unchecked.', 'uxbarn' ),
                'std'         => '',
                'type'        => 'checkbox',
                'section'     => 'uxbarn_to_google_fonts_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array(
                  array(
                    'value'       => 'latin',
                    'label'       => __( 'Latin (latin)', 'uxbarn' ),
                    'src'         => ''
                  ), 
                  array(
                    'value'       => 'latin-ext',
                    'label'       => __( 'Latin Extended (latin-ext)', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'cyrillic',
                    'label'       => __( 'Cyrillic (cyrillic)', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'cyrillic-ext',
                    'label'       => __( 'Cyrillic Extended (cyrillic-ext)', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'greek',
                    'label'       => __( 'Greek (greek)', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'greek-ext',
                    'label'       => __( 'Greek Extended (greek-ext)', 'uxbarn' ),
                    'src'         => ''
                  ),
                ),
              ),
			  
			  
			  // WPML Plugin Tab
              
              array(
                'id'          => 'uxbarn_to_setting_display_theme_wpml_lang_selector',
                'label'       => __( 'Display WPML Language Selector?', 'uxbarn' ),
                'desc'        => __( 'If WPML is activated, use this option to display the WPML language selector in the header location defined by theme. <br/><br/><strong>Note: </strong>Theme will use the configuration that you set in "WPML > Languages > Language switcher options".', 'uxbarn' ),
                'std'         => 'false',
                'type'        => 'radio',
                'section'     => 'uxbarn_to_wpml_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'true',
                    'label'       => __( 'Yes', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'false',
                    'label'       => __( 'No', 'uxbarn' ),
                    'src'         => ''
                  )
                ),
              ),
              
			  
			  
			  // WooCommerce Plugin Tab
              
              array(
                'id'          => 'uxbarn_to_setting_wooc_shop_page_sidebar',
                'label'       => __( 'Shop Page Sidebar', 'uxbarn' ),
                'desc'        => __( 'If WooCommerce is activated, use this option to display the sidebar on shop page. <br/><br/>You can manage the widgets of this sidebar by going to "Appearance > Widgets" menu and look for "Shop Page Sidebar" widget area.', 'uxbarn' ),
                'std'         => 'none',
                'type'        => 'select',
                'section'     => 'uxbarn_to_woocommerce_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'none',
                    'label'       => __( 'Hide shop sidebar', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'right',
                    'label'       => __( 'Right side', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'left',
                    'label'       => __( 'Left side', 'uxbarn' ),
                    'src'         => ''
                  ),
                ),
              ),
              array(
                'id'          => 'uxbarn_to_setting_wooc_number_of_columns',
                'label'       => __( 'Number of Columns on Shop Page', 'uxbarn' ),
                'desc'        => __( 'Select the number columns to use on shop page and archive page. This option is for working with WooCommerce plugin only.', 'uxbarn' ),
                'std'         => '3',
                'type'        => 'select',
                'section'     => 'uxbarn_to_woocommerce_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => '3',
                    'label'       => __( '3 Columns', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => '4',
                    'label'       => __( '4 Columns', 'uxbarn' ),
                    'src'         => ''
                  )
				),
              ),
              array(
                'id'          => 'uxbarn_to_setting_wooc_number_of_products',
                'label'       => __( 'Number of Products Per Page on Shop Page', 'uxbarn' ),
                'desc'        => __( 'Enter the number of products per page to use on shop page and archive page. This option is for working with WooCommerce plugin only.', 'uxbarn' ),
                'std'         => '15',
                'type'        => 'text',
                'section'     => 'uxbarn_to_woocommerce_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => ''
              ),
              array(
                'id'          => 'uxbarn_to_setting_wooc_display_related_product',
                'label'       => __( 'Display Related Products?', 'uxbarn' ),
                'desc'        => __( 'Whether to display Related Products section on product single page. This option is for working with WooCommerce plugin only.', 'uxbarn' ),
                'std'         => 'true',
                'type'        => 'radio',
                'section'     => 'uxbarn_to_woocommerce_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'true',
                    'label'       => __( 'Yes', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'false',
                    'label'       => __( 'No', 'uxbarn' ),
                    'src'         => ''
                  )
				),
              ),
              array(
                'id'          => 'uxbarn_to_setting_wooc_max_related_products',
                'label'       => __( 'Max Number of Related Products', 'uxbarn' ),
                'desc'        => __( 'Enter the max number of related products to be displayed on product single page. This option is for working with WooCommerce plugin only.<br/><br/>Note that this is the "maximum" number so the products may be sometimes displayed less than this number but not more than. It is controlled by WooCommerce plugin itself.', 'uxbarn' ),
                'std'         => '4',
                'type'        => 'text',
                'section'     => 'uxbarn_to_woocommerce_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => ''
              ),
              
        )
      );
       
      /* settings are not the same update the DB */
      if ( $saved_settings !== $custom_settings ) {
        update_option( 'option_tree_settings', $custom_settings ); 
      }
      
    }

}