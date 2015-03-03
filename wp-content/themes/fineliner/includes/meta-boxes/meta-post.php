<?php

if ( ! function_exists( 'uxbarn_create_post_meta_boxes' ) ) {
	
	function uxbarn_create_post_meta_boxes() {
		
		uxbarn_create_post_excerpt_meta_box();
		uxbarn_create_alternate_content();
		uxbarn_create_post_misc_meta_box();
		
	}
	
}
	


if ( ! function_exists( 'uxbarn_create_post_excerpt_meta_box' ) ) {

	function uxbarn_create_post_excerpt_meta_box() {
		
		$args = array(
			'id'          => 'uxbarn_post_excerpt_meta_box',
			'title'       => __( 'Post Excerpt Settings', 'uxbarn' ),
			'desc'        => '',
			'pages'       => array( 'post' ),
			'context'     => 'normal',
			'priority'    => 'high',
			'fields'      => array(
				array(
		        'id'          => 'uxbarn_post_excerpt',
		        'label'       => __( 'Post Excerpt', 'uxbarn' ),
		        'desc'        => __( 'This post excerpt will be used as a summarized description for your blog post. It will be displayed on the blog post list. <p>If you leave this blank, the very first post content will be used to display instead.</p>', 'uxbarn' ),
		        'std'         => '',
		        'type'        => 'textarea-simple',
		        'section'     => 'uxbarn_sec_post_excerpt',
		        'rows'        => '',
		        'post_type'   => '',
		        'taxonomy'    => '',
		        'class'       => ''
		      ),
			)
		);
		
		ot_register_meta_box( $args );
		
	}
	
}



if ( ! function_exists( 'uxbarn_create_alternate_content' ) ) {
		
	function uxbarn_create_alternate_content() {
		
		$args = array(
	        'id'          => 'uxbarn_post_alternate_content_meta_box',
	        'title'       => __( 'Alternate Content Settings', 'uxbarn' ),
	        'desc'        => '',
	        'pages'       => array( 'post' ),
	        'context'     => 'normal',
	        'priority'    => 'high',
	        'fields'      => array(
	            array(
	                'id'          => 'uxbarn_post_alternate_thumbnail',
	                'label'       => __( 'Alternate Thumbnail for Blog Posts Element', 'uxbarn' ),
	                'desc'        => __( 'By default, when using Blog Posts Element (via Visual Composer) on a page, it will use Featured Image for each post thumbnail. If you want to use the different thumbnail for the element, you can use this option.<br/><br/>Note that if you leave this blank, the element will use Featured Image for the thumbnail (default).', 'uxbarn' ),
	                'std'         => '',
	                'type'        => 'upload',
	                'section'     => 'uxbarn_alternate_content_sec',
	                'rows'        => '',
	                'post_type'   => '',
	                'taxonomy'    => '',
	                'class'       => ''
	            ),
	        )
	    );
	    
	    ot_register_meta_box( $args );
		
	}
	
}



if ( ! function_exists( 'uxbarn_create_post_misc_meta_box' ) ) {

	function uxbarn_create_post_misc_meta_box() {
		
		$args = array(
			'id'          => 'uxbarn_post_misc_meta_box',
			'title'       => __( 'Meta Info / Other Settings', 'uxbarn' ),
			'desc'        => '',
			'pages'       => array( 'post' ),
			'context'     => 'normal',
			'priority'    => 'high',
			'fields'      => array(
		      array(
		        'id'          => 'uxbarn_post_meta_info_date',
		        'label'       => __( 'Show date?', 'uxbarn' ),
		        'desc'        => __( 'Whether to display the date on blog posts page and single page.', 'uxbarn' ),
		        'std'         => 'true',
		        'type'        => 'radio',
		        'section'     => 'uxbarn_sec_miscellaneous',
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
	          	)
			  ),
			  array(
		        'id'          => 'uxbarn_post_meta_info_author',
		        'label'       => __( 'Show author name?', 'uxbarn' ),
		        'desc'        => __( 'Whether to display the author name on blog posts page and single page.', 'uxbarn' ),
		        'std'         => 'true',
		        'type'        => 'radio',
		        'section'     => 'uxbarn_sec_miscellaneous',
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
	          	)
			  ),
			  array(
		        'id'          => 'uxbarn_post_meta_info_categories',
		        'label'       => __( 'Show categories?', 'uxbarn' ),
		        'desc'        => __( 'Whether to display the categories on blog posts page and single page.', 'uxbarn' ),
		        'std'         => 'true',
		        'type'        => 'radio',
		        'section'     => 'uxbarn_sec_miscellaneous',
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
	          	)
			  ),
			  array(
		        'id'          => 'uxbarn_post_meta_info_comment',
		        'label'       => __( 'Show comment count?', 'uxbarn' ),
		        'desc'        => __( 'Whether to display the comment count on blog posts page and single page.', 'uxbarn' ),
		        'std'         => 'true',
		        'type'        => 'radio',
		        'section'     => 'uxbarn_sec_miscellaneous',
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
	          	)
			  ),
			  array(
		        'id'          => 'uxbarn_post_meta_info_single_author_box',
		        'label'       => __( 'Show author box on single page?', 'uxbarn' ),
		        'desc'        => __( 'Whether to display the author box on the post single page.', 'uxbarn' ),
		        'std'         => 'true',
		        'type'        => 'radio',
		        'section'     => 'uxbarn_sec_miscellaneous',
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
	          	)
			  ),
			  array(
		        'id'          => 'uxbarn_post_meta_info_single_tags',
		        'label'       => __( 'Show tags on single page?', 'uxbarn' ),
		        'desc'        => __( 'Whether to display the tags list on the post single page.', 'uxbarn' ),
		        'std'         => 'true',
		        'type'        => 'radio',
		        'section'     => 'uxbarn_sec_miscellaneous',
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
	          	)
			  ),
			),
		);
		
		ot_register_meta_box( $args );
		
	}

}
		

?>