<?php get_header(); ?>

<?php
global $post;
            $images_format_layout = get_post_meta( $post->ID, 'layout_mode', true );
            $layout_images_column = ' large-12 ';
            $layout_info_column = ' large-12 ';
            $images_slider_class = '';
            $image_size = 'uxb-port-single-landscape';
            $meta_class_attr = '';
            $layout_meta_columns = 'large-3';
            $layout_content_columns = 'large-9';
            $layout_content_columns_pull = ' pull-3 ';
            $layout_meta_columns_push = ' push-9 ';

            if ( $images_format_layout == 'portrait' ) {

                $layout_images_column = ' large-7 ';
                $layout_info_column = 'large-5 ';
                $images_slider_class = ' portrait-view ';
                $image_size = 'uxb-port-single-portrait';
                $meta_class_attr = ' class="portrait-view" ';
                $layout_meta_columns = 'large-12';
                $layout_content_columns = 'large-12';
                $layout_content_columns_pull = ' ';
                $layout_meta_columns_push = ' ';
            }

    if ( function_exists( 'ot_get_option' ) ) {

        if ( ot_get_option( 'uxbarn_to_setting_enable_zooming_effect', 'true' ) == 'true' ) {
            $blog_thumbnail_class .= ' zoom-effect ';
        }

    }
?>
<div id="uxb-post-inner-content-container">
    <?php if ( have_posts()) : while ( have_posts() ) : the_post(); ?>
        <div id="uxb-port-images-type" class="single_blog_image">
                <div class="uxb-col <?php echo $layout_images_column; ?> columns">
                <?php if(get_field('image') !=''){
                         echo wp_get_attachment_image( get_field('image'), $image_size , true );
                    }  else{ ?>
                            <a href="<?php echo get_permalink(); ?>"><?php echo get_the_post_thumbnail( $post->ID, $image_size ); ?></a>

                     <?php } ?>

                </div>
        </div>
        <div class="uxb-port-content-type" class="row">
            <div class="uxb-col <?php echo $layout_info_column; ?> columns">
                    <div class="row <?php if ( uxb_port_is_using_vc() ) echo ' no-margin-bottom '; ?>">
                            <div class="uxb-col <?php echo $layout_meta_columns; ?> columns <?php echo $layout_meta_columns_push; ?>">
                                     <div id="single-meta-wrapper">
                                            <?php get_template_part( 'template-blog-meta' ); ?>
                                     </div>
                            </div>
                            <div class="uxb-col <?php echo $layout_content_columns; ?> columns <?php echo $layout_content_columns_pull; ?>">

                                           <?php echo uxbarn_get_final_post_content(); ?>
                            </div>
                    </div>

            </div>
        </div>

            <div class="prot_gallery">

                <?php
                    if( function_exists( 'easy_image_gallery' ) ) { ?>
                            <div style="clear:both"></div>
                            <div class="divider-set1  uxb-divider pro_divider">
                                            <hr class="short">
                                            <hr class="middle">
                            </div>
                           <?php if(get_field('gallery_title') != ''){
                                echo '<h3 class="gallery_title uxb-col  large-12  columns">'.get_field('gallery_title').'</h3>';
                            }
                            echo easy_image_gallery();
            } ?>
        </div>
        <div class="blog_info ">
            <div class="uxb-col large-12 columns">
                <?php

                            $post_paging_args = array(
                                'before'        => '<div class="post-paging"><ul><li><strong>' . __( 'Pages:', 'uxbarn' ) . ' </strong></li>',
                                'after'         => '</ul></div>',
                                'link_before'   => '<li>',
                                'link_after'    => '</li>',
                            );

                            wp_link_pages( $post_paging_args );

                        ?>
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
    <?php endwhile; endif; wp_reset_postdata(); ?>
</div>

<?php get_footer(); ?>
