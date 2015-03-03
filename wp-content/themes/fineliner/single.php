<?php get_header(); ?>

<?php 

    // Code for managing the blog sidebar and other related variables
    if ( function_exists( 'ot_get_option' ) ) {
    	$sidebar_location = ot_get_option( 'uxbarn_to_setting_blog_sidebar' );
	} else {
		$sidebar_location = 'right';
	}
    
    $content_class ='';
    $sidebar_class = '';
    $content_column_class = ' large-9 ';
    
    //global $uxbarn_blog_thumbnail_size;
    $uxbarn_blog_thumbnail_size = 'theme-blog-thumbnail';
	$blog_thumbnail_class = '';
    
    $blog_sidebar_id = 'uxbarn-blog-sidebar';
    
	if ( $sidebar_location != 'none' ) {
    	
        if ( $sidebar_location == 'left' ) {
            
            $content_class =' push-3 ';
            $sidebar_class = ' pull-9 ';
            
        }
        
        $content_class .= ' with-sidebar ';
        
    } else {
    	
        $content_column_class = ' large-12 ';
        $uxbarn_blog_thumbnail_size = 'theme-blog-thumbnail-full';
		$blog_thumbnail_class = ' full ';
		
    }
    
	if ( function_exists( 'ot_get_option' ) ) {
			
		if ( ot_get_option( 'uxbarn_to_setting_enable_zooming_effect', 'true' ) == 'true' ) {
			$blog_thumbnail_class .= ' zoom-effect ';
		}
		
	}
    
?>

<?php if ( have_posts()) : while ( have_posts() ) : the_post(); ?>

	<!-- Blog Content -->
    <div class="uxb-col <?php echo $content_column_class; ?> columns <?php echo $content_class; ?>">
        
        <div <?php post_class(); ?> >
        
            <div class="blog-item single">
    			
    			<div id="inner-blog-single-item">
    				
	                <?php if ( has_post_thumbnail() ) : ?>
	                    <div class="blog-item-thumbnail border <?php echo $blog_thumbnail_class; ?>">
							<a href="<?php echo get_permalink(); ?>"><?php echo get_the_post_thumbnail( $post->ID, $uxbarn_blog_thumbnail_size ); ?></a>
	                	</div>
				    <?php endif; ?>
	                
	                <span class="loading-text"><span><?php _e( 'Loading', 'uxbarn' ); ?></span></span>
	                
	                <h1 class="blog-title"><?php the_title(); ?></h1>
	                <div id="single-content-wrapper">
	                	<?php get_template_part( 'template-blog-meta' ); ?>
	                    <?php echo uxbarn_get_final_post_content(); ?>
	                </div>
	                <?php 
	                
	                    $post_paging_args = array(
	                        'before' 		=> '<div class="post-paging"><ul><li><strong>' . __( 'Pages:', 'uxbarn' ) . ' </strong></li>',
	                        'after' 		=> '</ul></div>',
	                        'link_before' 	=> '<li>',
	                        'link_after' 	=> '</li>',
	                    );
	                    
	                    wp_link_pages( $post_paging_args );
	                    
	                ?>
	                
                </div>
                
                <?php
                
                	if ( function_exists( 'ot_get_option' ) ) {
	                    
	                    $override_with_theme_options = ot_get_option( 'uxbarn_to_setting_override_post_meta_info' );
	                    
	                    // Single page's elements
	                    $show_author_box = '';
	                    if ( $override_with_theme_options == 'true' ) {
	                        $show_author_box = ot_get_option( 'uxbarn_to_post_meta_info_single_author_box' );
	                    } else {
	                        $show_author_box = uxbarn_get_array_value( get_post_meta( $post->ID, 'uxbarn_post_meta_info_single_author_box' ), 0 );
	                    }
	                    
	                    $show_tags = '';
	                    if ( $override_with_theme_options == 'true' ) {
	                        $show_tags = ot_get_option( 'uxbarn_to_post_meta_info_single_tags' );
	                    } else {
	                        $show_tags = uxbarn_get_array_value( get_post_meta( $post->ID, 'uxbarn_post_meta_info_single_tags' ), 0 );
	                    }
						
					} else {
						
						$override_with_theme_options = 'true';
						$show_author_box = 'true';
						$show_tags = 'true';
						
					}
                
                ?>
                
                <?php if ( $show_author_box == 'true' ) : ?>
                    
                    <!-- Author Box -->
                    <div id="author-box">
                    	<div id="author-photo-wrapper">
                        	<?php echo get_avatar( get_the_author_meta( 'user_email' ), 90, '', get_the_author() ); ?>
                        </div>
                        <div id="author-info">
                            <h3><?php echo __( 'About ', 'uxbarn' ) . get_the_author(); ?></h3>
                            <p>
                                <?php echo get_the_author_meta( 'description' ); ?>
                            </p>
                            <ul id="author-social">
                                <li>&nbsp;</li>
                                <?php if ( get_the_author_meta( 'twitter' ) != '' ) : ?>
                                <li>
                                    <a href="<?php echo get_the_author_meta( 'twitter' ); ?>"><img src="<?php echo UXB_THEME_ROOT_IMAGE_URL; ?>social/team/Twitter.png" alt="Twitter" title="Twitter" /></a>
                                </li>
                                <?php endif; ?>
                                <?php if ( get_the_author_meta( 'facebook' ) != '' ) : ?>
                                <li>
                                    <a href="<?php echo get_the_author_meta( 'facebook' ); ?>"><img src="<?php echo UXB_THEME_ROOT_IMAGE_URL; ?>social/team/Facebook.png" alt="Facebook" title="Facebook" /></a>
                                </li>
                                <?php endif; ?>
                                <?php if ( get_the_author_meta( 'google' ) != '' ) : ?>
                                <li>
                                    <a href="<?php echo get_the_author_meta( 'google' ); ?>"><img src="<?php echo UXB_THEME_ROOT_IMAGE_URL; ?>social/team/Google.png" alt="Google+" title="Google+" /></a>
                                </li>
                                <?php endif; ?>
                                <?php if ( get_the_author_meta( 'linkedin' ) != '' ) : ?>
                                <li>
                                    <a href="<?php echo get_the_author_meta( 'linkedin' ); ?>"><img src="<?php echo UXB_THEME_ROOT_IMAGE_URL; ?>social/team/LinkedIn.png" alt="LinkedIn" title="LinkedIn" /></a>
                                </li>
                                <?php endif; ?>
                                <?php if ( get_the_author_meta( 'dribbble' ) != '' ) : ?>
                                <li>
                                    <a href="<?php echo get_the_author_meta( 'dribbble' ); ?>"><img src="<?php echo UXB_THEME_ROOT_IMAGE_URL; ?>social/team/Dribbble.png" alt="Dribbble" title="Dribbble" /></a>
                                </li>
                                <?php endif; ?>
                                <?php if ( get_the_author_meta( 'forrst' ) != '' ) : ?>
                                <li>
                                    <a href="<?php echo get_the_author_meta( 'forrst' ); ?>"><img src="<?php echo UXB_THEME_ROOT_IMAGE_URL; ?>social/team/Forrst.png" alt="Forrst" title="Forrst" /></a>
                                </li>
                                <?php endif; ?>
                                <?php if ( get_the_author_meta( 'flickr' ) != '' ) : ?>
                                <li>
                                    <a href="<?php echo get_the_author_meta( 'flickr' ); ?>"><img src="<?php echo UXB_THEME_ROOT_IMAGE_URL; ?>social/team/Flickr.png" alt="Flickr" title="Flickr" /></a>
                                </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                    
                <?php endif; // if($show_author_box) ?>
                
                <?php if ( $show_tags == 'true' ) : ?>
                    
                    <!-- Tags -->
                    <?php if ( get_the_tags( $post->ID ) ) : ?>
                        
                    <div id="tags-wrapper" class="blog-section">
                        <h4 class="blog-section-title"><?php _e( 'Tags', 'uxbarn'); ?></h4>
                        <?php the_tags( '<ul class="tags"><li>', '</li><li>', '</li></ul>' ); ?>
                    </div>
                    
                    <?php endif; ?>
                    
                <?php endif; ?>
            
                <!-- Comment Section -->
                <?php comments_template(); ?>
                
                
            </div>
            
        </div>
            
    </div>
    
    <?php if ( $sidebar_location != 'none' ) : ?>
        
        <div id="sidebar-wrapper" class="uxb-col large-3 columns for-nested <?php echo $sidebar_class; ?>">
            <?php get_sidebar(); ?>
        </div>
        
    <?php endif; ?>

<?php endwhile; endif; wp_reset_postdata(); ?>

<?php get_footer(); ?>