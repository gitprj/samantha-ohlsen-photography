<?php

if ( ! function_exists( 'uxbarn_create_homeslider_meta_boxes' ) ) {
	
    function uxbarn_create_homeslider_meta_boxes() {
        
        uxbarn_create_homeslider_caption();
		uxbarn_create_homeslider_order();
        
    }
	
}



if ( ! function_exists( 'uxbarn_create_homeslider_caption' ) ) {
	
    function uxbarn_create_homeslider_caption() {
    	
        $args = array(
            'id'          => 'uxbarn_homeslider_caption_meta_box',
            'title'       => __( 'Slide Settings', 'uxbarn' ),
            'desc'        => '',
            'pages'       => array( 'uxbarn_homeslider' ),
            'context'     => 'normal',
            'priority'    => 'high',
            'fields'      => array(
                array(
                    'id'          => 'uxbarn_homeslider_caption_display',
                    'label'       => __( 'Caption Display', 'uxbarn' ),
                    'desc'        => __( 'Whether to show the caption of this slide.', 'uxbarn' ),
                    'std'         => 'true',
                    'type'        => 'radio',
                    'section'     => 'uxbarn_sec_homeslider_caption',
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
                        'src' 
					  )
                    ),
                ),
                array(
                    'id'          => 'uxbarn_homeslider_caption_body',
                    'label'       => __( 'Caption Text', 'uxbarn' ),
                    'desc'        => __( 'Caption text to be displayed. For caption title, use the Title field above.', 'uxbarn' ),
                    'std'         => '',
                    'type'        => 'textarea-simple',
                    'section'     => 'uxbarn_sec_homeslider_caption',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => ''
              ),
              array(
                    'id'          => 'uxbarn_homeslider_caption_position',
                    'label'       => __( 'Caption Position', 'uxbarn' ),
                    'desc'        => __( 'Select where to display the caption.', 'uxbarn' ),
                    'std'         => 'left',
                    'type'        => 'select',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => '',
                    'choices'     => array( 
                      array(
                        'value'       => 'left',
                        'label'       => __( 'Left', 'uxbarn' ),
                        'src'         => ''
                      ),
                      array(
                        'value'       => 'right',
                        'label'       => __( 'Right', 'uxbarn' ),
                        'src'         => ''
                      ),
                    ),
                  ),
              array(
                    'id'          => 'uxbarn_homeslider_caption_color',
                    'label'       => __( 'Caption Color', 'uxbarn' ),
                    'desc'        => __( 'Select the color for the caption.', 'uxbarn' ),
                    'std'         => 'black',
                    'type'        => 'select',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => '',
                    'choices'     => array( 
                      array(
                        'value'       => 'black',
                        'label'       => __( 'Black', 'uxbarn' ),
                        'src'         => ''
                      ),
                      array(
                        'value'       => 'white',
                        'label'       => __( 'White', 'uxbarn' ),
                        'src'         => ''
                      ),
                      array(
                        'value'       => 'custom',
                        'label'       => __( 'Custom', 'uxbarn' ),
                        'src'         => ''
                      ),
                    ),
                  ),
              array(
                    'id'          => 'uxbarn_homeslider_caption_custom_color',
                    'label'       => __( 'Caption Custom Color', 'uxbarn' ),
                    'desc'        => __( 'Select the custom color for the caption.', 'uxbarn' ),
                    'std'         => '',
                    'type'        => 'colorpicker',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => '',
                  ),
              array(
                    'id'          => 'uxbarn_homeslider_caption_button_text',
                    'label'       => __( 'Button Text', 'uxbarn' ),
                    'desc'        => __( 'Enter the text for the button which is part of the caption. This text is optional. <strong>If you leave this blank, the button will not be displayed.</strong>', 'uxbarn' ),
                    'std'         => '',
                    'type'        => 'text',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => '',
                  ),
                  
              array(
                    'id'          => 'uxbarn_homeslider_caption_button_url',
                    'label'       => __( 'Button URL', 'uxbarn' ),
                    'desc'        => __( 'Enter the target URL for the button. For example: http://www.uxbarn.com', 'uxbarn' ),
                    'std'         => '',
                    'type'        => 'text',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => '',
                  ),
                  
                array(
                    'id'          => 'uxbarn_homeslider_border_display',
                    'label'       => __( 'Border Display', 'uxbarn' ),
                    'desc'        => __( 'Whether to display a border for this slide.', 'uxbarn' ),
                    'std'         => 'true',
                    'type'        => 'radio',
                    'section'     => '',
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
                        'src' 
					  )
                    ),
                ),
              	array(
                    'id'          => 'uxbarn_homeslider_border_color',
                    'label'       => __( 'Border Color', 'uxbarn' ),
                    'desc'        => __( 'Select the border color for this slide.', 'uxbarn' ),
                    'std'         => '',
                    'type'        => 'colorpicker',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => '',
              	),
                  
            )
        );
        
        ot_register_meta_box( $args );
		
    }

}



if ( ! function_exists( 'uxbarn_create_homeslider_order' ) ) {
	
	function uxbarn_create_homeslider_order() {
		
        $args = array(
            'id'          => 'uxbarn_homeslider_slide_order_meta_box',
            'title'       => __( 'Slide Order Settings', 'uxbarn' ),
            'desc'        => '',
            'pages'       => array( 'uxbarn_homeslider' ),
            'context'     => 'normal',
            'priority'    => 'high',
            'fields'      => array(
                array(
                    'id'          => 'uxbarn_homeslider_slide_order',
                    'label'       => __( 'Slide Order Number', 'uxbarn' ),
                    'desc'        => __( 'Enter a number for ordering the slide. Only number is allowed.', 'uxbarn' ),
                    'std'         => '1',
                    'type'        => 'text',
                    'section'     => 'uxbarn_sec_homeslider_slide_order',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => '',
                ),
            ),
        );
		
		ot_register_meta_box( $args );
		
	}

}