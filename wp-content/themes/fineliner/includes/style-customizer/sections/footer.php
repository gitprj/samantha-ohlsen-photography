<?php

if ( ! function_exists( 'uxbarn_ctmzr_init_footer_tab' ) ) {
    
    function uxbarn_ctmzr_init_footer_tab( $wp_customize ) {
        
        uxbarn_ctmzr_register_footer_section_tab( $wp_customize );
        uxbarn_ctmzr_register_footer_logo( $wp_customize );
        uxbarn_ctmzr_register_footer_body_styles( $wp_customize );
        
    }
	
}



if ( ! function_exists( 'uxbarn_ctmzr_register_footer_section_tab' ) ) {
    
    function uxbarn_ctmzr_register_footer_section_tab( $wp_customize ) {
            
        $wp_customize->add_section( 'uxbarn_sc_footer_section', array(
                'title'    		=> __( 'Footer', 'uxbarn' ),
                'description' 	=> __( 'Customize the styles of footer area.', 'uxbarn' ),
                'priority' 		=> '45',
            )
        );
        
    }
	
}



if ( ! function_exists( 'uxbarn_ctmzr_register_footer_logo' ) ) {
    
    function uxbarn_ctmzr_register_footer_logo( $wp_customize ) {
        
        // Logo image upload
        $wp_customize->add_setting( 'uxbarn_sc_footer_site_logo', array(
                'default' 	=> '',
                'type' 		=> 'option',
        )); 
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'uxbarn_sc_footer_site_logo', array(
                'label' 	=> __( 'Footer Site Logo (R)', 'uxbarn' ),
                'section' 	=> 'uxbarn_sc_footer_section',
                'priority' 	=> '1',
        )));
        // Description
        $wp_customize->add_setting( 'uxbarn_sc_footer_styles_logo_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control( new WP_Customize_Description_Custom_Control( $wp_customize, 'uxbarn_sc_footer_styles_logo_desc', 
                array(
                    'label' 	=> '',
                    'section' 	=> 'uxbarn_sc_footer_section',
                    'priority' 	=> '2',
                )
            )
        );
        
        // Divider
        $wp_customize->add_setting( 'uxbarn_sc_footer_section_divider1', array(
                'default' 	=> '',
                'type' 		=> 'option',
                'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control( new WP_Customize_Divider_Custom_Control( $wp_customize, 'uxbarn_sc_footer_section_divider1', array(
                    'label' 	=> '',
                    'section' 	=> 'uxbarn_sc_footer_section',
                    'priority' 	=> '4',
                )
            )
        );
        
    }

}



if ( ! function_exists( 'uxbarn_ctmzr_register_footer_body_styles' ) ) {

    function uxbarn_ctmzr_register_footer_body_styles( $wp_customize ) {
        
        // Heading color
        $wp_customize->add_setting( 'uxbarn_sc_footer_body_styles[heading_color]', array(
                'default' 			=> '#333333',
                'type' 				=> 'option',
                'transport' 		=> 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'uxbarn_sc_footer_body_styles[heading_color]', array(
                    'label' 	=> __( 'Footer Heading Color', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_footer_section',
                    'priority' 	=> '5',
                )
            )
        );
        
        // Text color
        $wp_customize->add_setting( 'uxbarn_sc_footer_body_styles[text_color]', array(
                'default' 			=> '#888888',
                'type' 				=> 'option',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'uxbarn_sc_footer_body_styles[text_color]', array(
                    'label' 	=> __( 'Footer Text Color (R)', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_footer_section',
                    'priority' 	=> '10',
                )
            )
        );
        
        // Link color
        $wp_customize->add_setting( 'uxbarn_sc_footer_body_styles[link_color]', array(
                'default'    		=> '#111111',
                'type' 				=> 'option',
                //'transport' => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'uxbarn_sc_footer_body_styles[link_color]', array(
                    'label' 	=> __( 'Footer Link Color (R)', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_footer_section',
                    'priority' 	=> '15',
                )
            )
        );
        // Description
        $wp_customize->add_setting( 'uxbarn_sc_footer_body_styles_link_color_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control( new WP_Customize_Description_Custom_Control( $wp_customize, 'uxbarn_sc_footer_body_styles_link_color_desc', 
                array(
                    'label' 	=> __( 'Only apply to general text hyperlinks.', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_footer_section',
                    'priority' 	=> '16',
                )
            )
        );
        
		
		
		// Custom color checkbox
		$wp_customize->add_setting( 'uxbarn_sc_footer_body_styles[use_custom_hovered_color]', array(
                'default' 			=> false,
                'type' 				=> 'option',
                'sanitize_callback' => 'uxbarn_ctmzr_sanitize_checkbox',
        )); 
        $wp_customize->add_control( 'uxbarn_sc_footer_body_styles[use_custom_hovered_color]', array(
            'label'   	=> __( 'Use custom color for hovered footer link (R)', 'uxbarn' ),
            'section' 	=> 'uxbarn_sc_footer_section',
            'type'    	=> 'checkbox',
            'priority' 	=> '20',
        ));
        // Description
        $wp_customize->add_setting( 'uxbarn_sc_footer_body_styles_use_custom_hovered_footer_link_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control( new WP_Customize_Description_Custom_Control( $wp_customize, 'uxbarn_sc_footer_body_styles_use_custom_hovered_footer_link_desc', 
                array(
                    'label' 	=> __( 'By default, the color depends on color scheme that you have set in "Global" section. If you tick this checkbox, the theme will use below option for the color instead.', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_footer_section',
                    'priority' 	=> '21',
                )
            )
        );
		
		
        // Hovered link color
        $wp_customize->add_setting( 'uxbarn_sc_footer_body_styles[hover_link_color]', array(
                'default' 			=> uxbarn_ctmzr_get_default_color_by_scheme(),
                'type' 				=> 'option',
                //'transport' => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'uxbarn_sc_footer_body_styles[hover_link_color]', array(
                    'label' 	=> __( 'Hovered Footer Link Color (R)', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_footer_section',
                    'priority' 	=> '25',
                )
            )
        );
        // Description
        $wp_customize->add_setting( 'uxbarn_sc_footer_body_styles_link_hover_color_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control( new WP_Customize_Description_Custom_Control( $wp_customize, 'uxbarn_sc_footer_body_styles_link_hover_color_desc', 
                array(
                    'label' 	=> __( 'Only apply to general text hyperlinks. (You need to check the above checkbox to make this option working.)', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_footer_section',
                    'priority' 	=> '26',
                )
            )
        );
        
    }

}