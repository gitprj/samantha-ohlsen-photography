<?php

if ( ! function_exists( 'uxbarn_ctmzr_init_homeslider_tab' ) ) {

    function uxbarn_ctmzr_init_homeslider_tab( $wp_customize ) {
        
        uxbarn_ctmzr_register_homeslider_section_tab( $wp_customize );
        uxbarn_ctmzr_register_homeslider_general_styles( $wp_customize );
        
    }
	
}



if ( ! function_exists( 'uxbarn_ctmzr_register_homeslider_section_tab' ) ) {
    
    function uxbarn_ctmzr_register_homeslider_section_tab( $wp_customize ) {
            
        $wp_customize->add_section( 'uxbarn_sc_home_slider_section', array(
                'title'    		=> __( 'Home Slider', 'uxbarn' ),
                'description' 	=> __( 'Customize the styles of default home slider.', 'uxbarn' ),
                'priority' 		=> '25',
            )
        );
        
    }
	
}



if ( ! function_exists( 'uxbarn_ctmzr_register_homeslider_general_styles' ) ) {
    
    function uxbarn_ctmzr_register_homeslider_general_styles( $wp_customize ) {
        
        // Special desc
        $wp_customize->add_setting( 'uxbarn_sc_home_slider_section_special_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control( new WP_Customize_Description_Custom_Control( $wp_customize, 'uxbarn_sc_home_slider_section_special_desc', 
                array(
                    'label' 	=> __( '<strong>Note:</strong> For other styles like caption color and border color, you can change them in the edit screen of each slide (using "Home Slider" menu on admin panel).', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_home_slider_section',
                    'priority' 	=> '1',
                )
            )
        );
        
        
        // Controller color
        $wp_customize->add_setting( 'uxbarn_sc_home_slider_styles[controller_color]', array(
                'default' 			=> '#111111',
                'type' 				=> 'option',
                'transport' 		=> 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'uxbarn_sc_home_slider_styles[controller_color]', array(
                    'label' 	=> __( 'Controller Base Color', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_home_slider_section',
                    'priority' 	=> '15',
                )
            )
        );
		
		
		
		// Custom color checkbox
		$wp_customize->add_setting( 'uxbarn_sc_home_slider_styles[use_custom_hovered_controller]', array(
                'default' 			=> false,
                'type' 				=> 'option',
                'sanitize_callback' => 'uxbarn_ctmzr_sanitize_checkbox',
        )); 
        $wp_customize->add_control( 'uxbarn_sc_home_slider_styles[use_custom_hovered_controller]', array(
            'label'   	=> __( 'Use custom color for hovered controller (R)', 'uxbarn' ),
            'section' 	=> 'uxbarn_sc_home_slider_section',
            'type'    	=> 'checkbox',
            'priority' 	=> '20',
        ));
        // Description
        $wp_customize->add_setting( 'uxbarn_sc_home_slider_styles_use_custom_color_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control( new WP_Customize_Description_Custom_Control( $wp_customize, 'uxbarn_sc_home_slider_styles_use_custom_color_desc', 
                array(
                    'label' 	=> __( 'By default, the color depends on color scheme that you have set in "Global" section. If you tick this checkbox, the theme will use below option for the color instead.', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_home_slider_section',
                    'priority' 	=> '21',
                )
            )
        );
		
		
		// Hovered controller color
        $wp_customize->add_setting( 'uxbarn_sc_home_slider_styles[hovered_controller_color]', array(
                'default' 			=> uxbarn_ctmzr_get_default_color_by_scheme(),
                'type' 				=> 'option',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'uxbarn_sc_home_slider_styles[hovered_controller_color]', array(
                    'label' 	=> __( 'Hovered Controller Color (R)', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_home_slider_section',
                    'priority' 	=> '25',
                )
            )
        );
		// Description
        $wp_customize->add_setting( 'uxbarn_sc_home_slider_styles_hovered_controller_color', array(
            'default' => '',
        ));
        $wp_customize->add_control( new WP_Customize_Description_Custom_Control( $wp_customize, 'uxbarn_sc_home_slider_styles_hovered_controller_color', 
                array(
                    'label' 	=> __( 'Adjust text color for hovered controller. (You need to check the above checkbox to make this option working.)', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_home_slider_section',
                    'priority' 	=> '26',
                )
            )
        );
        
    }

}
