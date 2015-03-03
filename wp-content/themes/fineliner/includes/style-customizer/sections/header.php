<?php

if ( ! function_exists( 'uxbarn_ctmzr_init_header_tab' ) ) {
    
    function uxbarn_ctmzr_init_header_tab( $wp_customize ) {
        
        uxbarn_ctmzr_register_header_section_tab( $wp_customize );
        uxbarn_ctmzr_register_header_logo( $wp_customize );
        uxbarn_ctmzr_register_header_text( $wp_customize );
        
    }
	
}



if ( ! function_exists( 'uxbarn_ctmzr_register_header_section_tab' ) ) {
    
    function uxbarn_ctmzr_register_header_section_tab( $wp_customize ) {
            
        $wp_customize->add_section('uxbarn_sc_header_section', array(
                'title'    		=> __( 'Header', 'uxbarn' ),
                'description' 	=> __( 'Customize the header styles', 'uxbarn' ),
                'priority' 		=> '15',
            )
        );
        
    }
	
}



if ( ! function_exists( 'uxbarn_ctmzr_register_header_logo' ) ) {
    
    function uxbarn_ctmzr_register_header_logo( $wp_customize ) {
        
        // Logo image upload
        $wp_customize->add_setting( 'uxbarn_sc_header_site_logo', array(
                'default' 	=> '',
                'type' 		=> 'option',
        )); 
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'uxbarn_sc_header_site_logo', array(
                'label' 	=> __( 'Site Logo (R)', 'uxbarn' ),
                'section' 	=> 'uxbarn_sc_header_section',
                'priority' 	=> '5',
        )));
        // Description
        $wp_customize->add_setting( 'uxbarn_sc_header_styles_logo_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control( new WP_Customize_Description_Custom_Control( $wp_customize, 'uxbarn_sc_header_styles_logo_desc', 
                array(
                    'label' 	=> __( 'If not set, site title will display.', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_header_section',
                    'priority' 	=> '6',
                )
            )
        );
        
        // Divider
        $wp_customize->add_setting( 'uxbarn_sc_header_section_divider1', array(
                'default' 	=> '',
                'type' 		=> 'option',
                'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control( new WP_Customize_Divider_Custom_Control( $wp_customize, 'uxbarn_sc_header_section_divider1', array(
                    'label' 	=> '',
                    'section' 	=> 'uxbarn_sc_header_section',
                    'priority' 	=> '7',
                )
            )
        );
        
    }

}



if ( ! function_exists( 'uxbarn_ctmzr_register_header_text' ) ) {
    
    function uxbarn_ctmzr_register_header_text( $wp_customize ) {
        
        // Site title color
        $wp_customize->add_setting( 'uxbarn_sc_header_styles[site_title_color]', array(
                'default' 			=> '#402E38',
                'type' 				=> 'option',
                'transport' 		=> 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'uxbarn_sc_header_styles[site_title_color]', array(
                    'label'		=> __( 'Site Title Color', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_header_section',
                    'priority' 	=> '30',
                )
            )
        );
        // Description
        $wp_customize->add_setting( 'uxbarn_sc_header_styles_title_color_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control( new WP_Customize_Description_Custom_Control( $wp_customize, 'uxbarn_sc_header_styles_title_color_desc', 
                array(
                    'label' 	=> __( 'This color is for site title (if the logo image is not used).', 'uxbarn'),
                    'section' 	=> 'uxbarn_sc_header_section',
                    'priority' 	=> '31',
                )
            )
        );
		
		
		// Site tagline color
        $wp_customize->add_setting( 'uxbarn_sc_header_styles[site_tagline_color]', array(
                'default' 			=> '#666666',
                'type' 				=> 'option',
                'transport' 		=> 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'uxbarn_sc_header_styles[site_tagline_color]', array(
                    'label'		=> __( 'Site Tagline Color', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_header_section',
                    'priority' 	=> '35',
                )
            )
        );
        // Description
        $wp_customize->add_setting( 'uxbarn_sc_header_styles_tagline_color_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control( new WP_Customize_Description_Custom_Control( $wp_customize, 'uxbarn_sc_header_styles_tagline_color_desc', 
                array(
                    'label' 	=> __( 'This color is for the site tagline.', 'uxbarn'),
                    'section' 	=> 'uxbarn_sc_header_section',
                    'priority' 	=> '36',
                )
            )
        );
        
    }

}
    