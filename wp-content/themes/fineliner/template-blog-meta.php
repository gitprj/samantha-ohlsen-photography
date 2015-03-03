<?php

	// Whether to prioritize Theme Options setting
	if ( function_exists( 'ot_get_option' ) ) {
		
		$override_with_theme_options = ot_get_option( 'uxbarn_to_setting_override_post_meta_info' );
		
		
		// Post meta info
		$show_meta_date = '';
		if ( $override_with_theme_options == 'true' ) {
		    $show_meta_date = ot_get_option( 'uxbarn_to_post_meta_info_date' );
		} else {
		    $show_meta_date = uxbarn_get_array_value( get_post_meta( $post->ID, 'uxbarn_post_meta_info_date' ), 0 );
		}
		
		$show_meta_author = '';
		if ( $override_with_theme_options == 'true' ) {
		    $show_meta_author = ot_get_option( 'uxbarn_to_post_meta_info_author' );
		} else {
		    $show_meta_author = uxbarn_get_array_value( get_post_meta( $post->ID, 'uxbarn_post_meta_info_author' ), 0 );
		}
		
		$show_meta_categories = '';
		if ( $override_with_theme_options == 'true' ) {
		    $show_meta_categories = ot_get_option( 'uxbarn_to_post_meta_info_categories' );
		} else {
		    $show_meta_categories = uxbarn_get_array_value( get_post_meta( $post->ID, 'uxbarn_post_meta_info_categories' ), 0 );
		}
		
		$show_meta_comment_count = '';
		if ( $override_with_theme_options == 'true' ) {
		    $show_meta_comment_count = ot_get_option( 'uxbarn_to_post_meta_info_comment' );
		} else {
		    $show_meta_comment_count = uxbarn_get_array_value( get_post_meta( $post->ID, 'uxbarn_post_meta_info_comment' ), 0 );
		}
		
	} else {
		
		$override_with_theme_options = 'true';
		$show_meta_date = 'true';
		$show_meta_author = 'true';
		$show_meta_categories = 'true';
		$show_meta_comment_count = 'true';
		
	}

?>

<?php if ( $show_meta_comment_count == 'true' || $show_meta_date == 'true' || $show_meta_author == 'true' || $show_meta_categories == 'true' ) : ?>

<ul class="blog-meta">
	
	<?php if ( $show_meta_date == 'true' ) : ?>
		
	    <li class="meta-date">
	        <strong class="title"><?php _e( 'Date', 'uxbarn' ); ?></strong><?php echo get_the_time( get_option( 'date_format' ) ); ?>
	    </li>
    <?php endif; ?>
    
    <?php if ( $show_meta_author == 'true' ) : ?>
	    <li class="meta-author">
	        <strong class="title"><?php _e( 'Author', 'uxbarn' ); ?></strong><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author(); ?></a>
	    </li>
	    
    <?php endif; ?>
    
    <?php if ( $show_meta_categories == 'true' ) : ?>
    	
	    <li class="meta-categories">
	        <strong class="title"><?php _e( 'Categories', 'uxbarn' ); ?></strong>
	        <ul>
	        <?php
	        
				$categories = get_the_category( get_the_ID() );
				
				if ( count( $categories ) > 0 ) {
					foreach ( $categories as $category ) {
						echo '<li><a href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a></li>';
					}
				} else {
					echo '<li> - </li>';
				}
				
			?>
			</ul>
	    </li>
	    
    <?php endif; ?>
	    
    <?php if ( $show_meta_comment_count == 'true' ) : ?>
    	
	    <li class="meta-comments">
	        <strong class="title"><?php _e( 'Discussion', 'uxbarn' ); ?></strong><a href="<?php comments_link(); ?>"><?php comments_number( __( '0 Comment', 'uxbarn' ), __( '1 Comment', 'uxbarn' ), __( '% Comments', 'uxbarn' ) ); ?></a>
	    </li>
	    
    <?php endif; ?>
    
</ul>

<?php endif; ?>