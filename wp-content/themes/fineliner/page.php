<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
               
    <?php
    
        $sidebar = uxbarn_get_array_value( get_post_meta( $post->ID, 'uxbarn_setting_select_custom_sidebar' ), 0 );
        $sidebar_appearance = uxbarn_get_array_value( get_post_meta( $post->ID, 'uxbarn_page_sidebar_appearance' ), 0 );
        //echo var_dump($sidebar_appearance);
        $content_class = '';
        $sidebar_class = '';
        $content_column_class = ' large-9 ';
		
		$page_sidebar_id = 'uxbarn-page-sidebar';
        
        if ( $sidebar_appearance != 'none' && $sidebar_appearance != '' ) {
        	
            if ( $sidebar_appearance == 'left' ) {
                
                $content_class = ' push-3 ';
                $sidebar_class = ' pull-9 ';
                
            }
            
            $content_class .= ' with-sidebar ';
            
        } else {
            $content_column_class = ' large-12 ';
        }
		
    ?>
    
    <div class="uxb-col <?php echo $content_column_class; ?> columns <?php echo $content_class; ?>">
        
        <?php echo uxbarn_get_final_post_content(); ?>
        
        <?php
	        
        	if ( function_exists( 'ot_get_option' ) ) {
        		$enable_page_comment = ot_get_option( 'uxbarn_to_setting_enable_page_comment', 'true' );
        	} else {
        		$enable_page_comment = 'true';
        	}
        
        ?>
        
        <?php if ( $enable_page_comment == 'true' ) : ?>
            
            <?php if ( comments_open() ) : ?>
                
                <!-- Comment Section -->
                <div class="row">
                    <div class="uxb-col large-12 columns">
                        
                        <?php comments_template(); ?>
                        
                    </div>
                </div>
                
            <?php endif; ?>
            
        <?php endif; ?>
        
    </div>
    
    <?php if ( $sidebar_appearance != 'none' && $sidebar_appearance != '' ) : ?>
    
        <div id="sidebar-wrapper" class="uxb-col large-3 columns <?php echo $sidebar_class; ?>">
            <?php get_sidebar(); ?>
        </div>
        
    <?php endif; ?>
        
<?php endwhile; ?> 
        
<?php get_footer(); ?>