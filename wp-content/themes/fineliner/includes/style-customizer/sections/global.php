<?php

if ( ! function_exists( 'uxbarn_ctmzr_init_global_tab' ) ) {
    
    function uxbarn_ctmzr_init_global_tab( $wp_customize ) {
        
        uxbarn_ctmzr_register_global_section_tab( $wp_customize );
        uxbarn_ctmzr_register_global_color_scheme( $wp_customize );
        uxbarn_ctmzr_register_global_colors( $wp_customize );
        uxbarn_ctmzr_register_global_fonts( $wp_customize );
        
    }
	
}



if ( ! function_exists( 'uxbarn_ctmzr_register_global_section_tab' ) ) {
    
    function uxbarn_ctmzr_register_global_section_tab( $wp_customize ) {
            
        $wp_customize->add_section( 'uxbarn_sc_global_section', array(
                'title'    		=> __( 'Global', 'uxbarn' ),
                'description' 	=> __( 'Customize the global styles', 'uxbarn' ),
                'priority' 		=> '5',
            )
        );
        
    }
	
}



if ( ! function_exists( 'uxbarn_ctmzr_register_global_color_scheme' ) ) {
    
    function uxbarn_ctmzr_register_global_color_scheme( $wp_customize ) {
        
        // Color scheme
        $wp_customize->add_setting( 'uxbarn_sc_global_color_scheme', array(
                'default'	=> 'red',
                'type'		=> 'option',
            )
        );
        $wp_customize->add_control( 'uxbarn_sc_global_color_scheme', array(
            'label'   => __( 'Color Scheme (R)', 'uxbarn' ),
            'section' => 'uxbarn_sc_global_section',
            'type'    => 'select',
            'choices' => array(
                'red' 		=> __( 'Red', 'uxbarn' ),
                'blue' 		=> __( 'Blue', 'uxbarn' ),
                'gold' 		=> __( 'Gold', 'uxbarn' ),
                'green' 	=> __( 'Green', 'uxbarn' ),
                'pink' 		=> __( 'Pink', 'uxbarn' ),
                'yellow' 	=> __( 'Yellow', 'uxbarn' ),
                'custom' 	=> __( 'Custom (select colors below)', 'uxbarn' ),
                ),
            'priority' => '10',
        ));
        
        // Description
        $wp_customize->add_setting( 'uxbarn_sc_global_styles_color_scheme_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control( new WP_Customize_Description_Custom_Control( $wp_customize, 'uxbarn_sc_global_styles_color_scheme_desc', 
                array(
                    'label' 	=> __( '<p>Color scheme means to assign major color set to elements of the theme. However, you can also override some element color by individually set the color option on each section.</p><p>For example, color scheme "Red" will make a content hyperlink red color but you can also use another color for the link by using "Content" section.</p>', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_global_section',
                    'priority' 	=> '11',
                )
            )
        );
        
        // Divider
        $wp_customize->add_setting( 'uxbarn_sc_global_section_divider1', array(
                'default'    => '',
                'type' => 'option',
                'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control( new WP_Customize_Divider_Custom_Control( $wp_customize, 'uxbarn_sc_global_section_divider1', array(
                    'label' 	=> '',
                    'section'   => 'uxbarn_sc_global_section',
                    'priority' 	=> '12',
                )
            )
        );
    }

}



if ( ! function_exists( 'uxbarn_ctmzr_register_global_colors' ) ) {

    function uxbarn_ctmzr_register_global_colors( $wp_customize ) {
        
        // Description
        $wp_customize->add_setting( 'uxbarn_sc_global_styles1', array(
            'default' => '',
        ));
        $wp_customize->add_control( new WP_Customize_Description_Custom_Control( $wp_customize, 'uxbarn_sc_global_styles1', 
                array(
                    'label'		=> __( 'To use colors below, you need to select Color Scheme above as "Custom".', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_global_section',
                    'priority' 	=> '14',
                )
            )
        );
        
        // Primary color
        $wp_customize->add_setting( 'uxbarn_sc_global_styles[accent_color]', array(
                'default' 	=> '',
                'type' 		=> 'option',
                //'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'uxbarn_sc_global_styles[accent_color]', array(
                    'label'     => __( 'Accent Color (R)', 'uxbarn' ),
                    'section'   => 'uxbarn_sc_global_section',
                    'priority' 	=> '15',
                )
            )
        );
        
        // Divider
        $wp_customize->add_setting( 'uxbarn_sc_global_section_divider2', array(
                'default' 	=> '',
                'type' 		=> 'option',
                'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control( new WP_Customize_Divider_Custom_Control( $wp_customize, 'uxbarn_sc_global_section_divider2', array(
                    'label' 	=> '',
                    'section' 	=> 'uxbarn_sc_global_section',
                    'priority' 	=> '22',
                )
            )
        );
        
    }

}



if ( ! function_exists( 'uxbarn_ctmzr_register_global_fonts' ) ) {

    function uxbarn_ctmzr_register_global_fonts( $wp_customize ) {
        
        // Primary font
        $wp_customize->add_setting( 'uxbarn_sc_global_styles[primary_font]', array(
                'default' 	=> '',
                'type' 		=> 'option',
                'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control( new WP_Customize_FontFamily_Custom_Control( $wp_customize, 'uxbarn_sc_global_styles[primary_font]', 
            array(
                'label'   	=> __( 'Primary Font', 'uxbarn' ),
                'section' 	=> 'uxbarn_sc_global_section',
                'priority' 	=> '25',
            )
        ));
        // Description
        $wp_customize->add_setting( 'uxbarn_sc_global_styles_primary_font_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control( new WP_Customize_Description_Custom_Control( $wp_customize, 'uxbarn_sc_global_styles_primary_font_desc', 
                array(
                    'label' 	=> __( 'Primary font is for content headings.', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_global_section',
                    'priority' 	=> '26',
                )
            )
        );
        
        // Secondary font
        $wp_customize->add_setting( 'uxbarn_sc_global_styles[secondary_font]', array(
                'default' 	=> '',
                'type' 		=> 'option',
                'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control( new WP_Customize_FontFamily_Custom_Control( $wp_customize, 'uxbarn_sc_global_styles[secondary_font]', 
            array(
                'label'   	=> __( 'Secondary Font', 'uxbarn' ),
                'section' 	=> 'uxbarn_sc_global_section',
                'priority' 	=> '30',
            )
        ));
        // Description
        $wp_customize->add_setting( 'uxbarn_sc_global_styles_secondary_font_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control( new WP_Customize_Description_Custom_Control( $wp_customize, 'uxbarn_sc_global_styles_secondary_font_desc', 
                array(
                    'label' 	=> __( 'Secondary font is for menu, general content body and widget headings.', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_global_section',
                    'priority' 	=> '31',
                )
            )
        );
        
    }

}