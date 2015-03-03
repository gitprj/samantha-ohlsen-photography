<?php

// Register Custom Post Type: Home Slider
if ( ! function_exists( 'uxbarn_register_cpt_homeslider' ) ) {
	
    function uxbarn_register_cpt_homeslider() {
    	
        $args = array(
            'label' 			=> __( 'Home Slider', 'uxbarn' ),
            'labels' 			=> array(
				                        'singular_name'		=> __( 'Slide', 'uxbarn' ),
				                        'add_new' 			=> __( 'Add New Slide', 'uxbarn' ),
				                        'add_new_item' 		=> __( 'Add New Slide', 'uxbarn' ),
				                        'new_item' 			=> __( 'New Slide', 'uxbarn' ),
				                        'edit_item' 		=> __( 'Edit Slide', 'uxbarn' ),
				                        'all_items' 		=> __( 'All Slides', 'uxbarn' ),
				                        'view_item' 		=> __( 'View Slide', 'uxbarn' ),
				                        'search_items' 		=> __( 'Search Slides', 'uxbarn' ),
				                        'not_found' 		=>  __( 'Nothing found', 'uxbarn' ),
				                        'not_found_in_trash' => __( 'Nothing found in Trash', 'uxbarn' ),
			                        ),
            'menu_icon' 		=> UXB_THEME_ROOT_IMAGE_URL . 'admin/uxbarn_sm2.jpg',
            'description' 		=> __( 'Slides that will be displayed on homepage.', 'uxbarn' ),
            'public' 			=> false,
            'show_ui' 			=> true,
            'capability_type' 	=> 'post',
            'hierarchical' 		=> false,
            'has_archive' 		=> false,
            'supports' 			=> array( 'title', 'thumbnail' ),
            'rewrite' 			=> false,
        );
        
        register_post_type( 'uxbarn_homeslider', $args );
        
        add_filter( 'manage_uxbarn_homeslider_posts_columns', 'uxbarn_create_homeslider_columns_header' );  
        add_action( 'manage_uxbarn_homeslider_posts_custom_column', 'uxbarn_create_homeslider_columns_content' );  
        
    }

}



if ( ! function_exists( 'uxbarn_create_homeslider_columns_header' ) ) {
	
    function uxbarn_create_homeslider_columns_header( $defaults ) {
    	
        $custom_columns = array(
            'cb' 			=> '<input type=\"checkbox\" />',
            'slide_order' 	=> __( 'Order', 'uxbarn' ),
        	'title' 		=> __( 'Title', 'uxbarn' ),
            'cover_image' 	=> __( 'Thumbnail', 'uxbarn' ),
        );

        $defaults= array_merge( $custom_columns, $defaults );
        return $defaults;
        
    }
    
}



if ( ! function_exists('uxbarn_create_homeslider_columns_content' ) ) {
	
    function uxbarn_create_homeslider_columns_content( $column ) {
    	
        global $post;
        switch ( $column )
        {
            case 'cover_image':
                the_post_thumbnail( 'medium' );
                break;
			case 'slide_order':
                echo uxbarn_get_array_value( get_post_meta( $post->ID, 'uxbarn_homeslider_slide_order' ), 0 );
                break;
        }
         
    }
	
}