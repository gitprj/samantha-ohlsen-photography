<?php

	require_once( ABSPATH . 'wp-admin/includes/plugin.php' ); // for supporting "is_plugin_active()" usage
	
?>

<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        
        <title><?php wp_title( '-', true, 'right' ); ?></title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
        
        <?php if ( function_exists( 'ot_get_option' ) ) : if ( ot_get_option( 'uxbarn_to_setting_upload_favicon' ) ) : ?>
            <link rel="icon" type="image/png" href="<?php echo ot_get_option( 'uxbarn_to_setting_upload_favicon' ); ?>">
        <?php endif; endif; ?>
        
        <?php wp_head(); ?>
    </head>

    <body id="theme-body" <?php body_class(); ?>>
		    	
		<div id="root-border">
			<div id="root-container">
				
				<?php
				
					$show_wpml_lang_selector = false;
					
					if ( function_exists( 'ot_get_option' ) ) {
						
						if ( ot_get_option( 'uxbarn_to_setting_display_theme_wpml_lang_selector' ) == 'true' ) {
							$show_wpml_lang_selector = true;
						}
						
					}
				
				?>
				
				<?php if ( function_exists( 'icl_get_languages' ) && $show_wpml_lang_selector ) : // If WPML plugin is active, display lang selector. ?>
		            <div id="wpml-language-selector">
		            	<?php do_action( 'icl_language_selector' ); ?>
		            </div>
	            <?php endif; ?>
				
				<?php
					
					$menu_style = 'columned-menu';
					
					if ( function_exists( 'ot_get_option' ) ) {
						$menu_style = ot_get_option( 'uxbarn_to_setting_header_style', 'columned-menu' );
					}
					
					$header_class = '';
					$menu_class_full = ''; // to be used with "#header-container", "#logo-wrapper" and "#menu-wrapper" below
					
					if ( $menu_style == 'horizontal-menu' ) {
						
						$header_class = ' horizontal-menu ';
						$menu_class_full = ' class="horizontal-menu" ';
						
					}
					
				?>
				
				<div id="header-container" class="content-width <?php echo $header_class; ?>">
					
				    <!-- Logo -->
				    <div id="logo-wrapper" <?php echo $menu_class_full; ?>>
				        <div id="logo">
				            <a href="<?php echo esc_url( home_url() ); ?>">
		                        
		                        <?php
		                        
		                            $logo_url = get_option( 'uxbarn_sc_header_site_logo' );
									
		                            if ( $logo_url ) {
		                            	
										$attachment_id = uxbarn_get_attachment_id_from_src( $logo_url );
										$image_array = wp_get_attachment_image_src( $attachment_id, 'full' );
			                            
		                                echo '<img src="' . $logo_url . '" alt="' . get_bloginfo( 'name' ) . '" title="' . get_bloginfo( 'name' ) . '" width="' . $image_array[1] . '" height="' . $image_array[2] . '" />';
		                            } else {
		                                echo '<h1>' . get_bloginfo( 'name' ) . '</h1>';
		                            }
		                        
		                        ?>
		                        
		                    </a>
				        </div>
				        
				        <?php
				        
				        	$show_tagline = false;
							
							if ( function_exists( 'ot_get_option' ) ) {
								
								if ( ot_get_option( 'uxbarn_to_setting_display_tagline', 'true' ) == 'true' ) {
									$show_tagline = true;
								}
								
							} else {
								$show_tagline = true;
							}
				        
				        ?>
				        
				        <?php if ( $show_tagline ) : ?>
					        <div id="tagline">
					            <?php bloginfo( 'description' ); ?>
					        </div>
				        <?php endif; ?>
				    </div>
				    <!-- Menu -->
				    <div id="menu-wrapper" <?php echo $menu_class_full; ?>>
				    	
				    	<?php if ( $menu_style == 'columned-menu' || $menu_style == 'columns' ) : ?>
				    	<div id="rendered-menu-wrapper">
			    		<?php endif; ?>
				    		<?php uxbarn_render_nav_menu( $menu_style ); ?>
			    		<?php if ( $menu_style == 'columned-menu' || $menu_style == 'columns' ) : ?>
				    	</div>
				    	<?php endif; ?>
				    	
				    	<?php
				    	
				    		$show_search = false;
							
							if ( function_exists( 'ot_get_option' ) ) {
								
								if ( ot_get_option( 'uxbarn_to_setting_enable_header_search' ) == 'true' ) {
									$show_search = true;
								}
								
							} else {
								$show_search = true;
							}
				    	
				    	?>
				    	
				    	<?php if ( $show_search ) : ?>
				    		
					    	<!-- Search -->
							<div id="header-search">
								<a id="header-search-button" href="javascript:;"><i class="icon-search"></i></a>
							</div>
						    <div id="header-search-input-wrapper">
						    	<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				                    <input id="header-search-input" name="s" type="text" placeholder="<?php echo esc_attr( __( 'Type and hit enter to search ...', 'uxbarn' ) ); ?>" value="<?php echo trim( get_search_query() ); ?>" />
				                </form>
						    </div>
						    
						<?php endif; ?>
						
						<nav id="mobile-menu" class="top-bar">
						    <ul class="title-area">
						        <!-- Do not remove this list item -->
						        <li class="name"></li>
						        
						        <!-- Menu toggle button -->
						        <li class="toggle-topbar menu-icon">
						            <a href="#"><span><?php _e( 'Menu', 'uxbarn' ); ?></span></a>
						        </li>
						    </ul>
						    
						    <!-- Mobile menu's container -->
						    <section class="top-bar-section"></section>
						</nav>
				    
				    </div>
				    
				</div> <!-- End id="header-container" -->
				
				<?php //&& ! is_search() && ! is_single() && ! is_archive()  ?>
				
				<?php
					
					$display_home_slider = false;
					
					if ( function_exists( 'ot_get_option' ) ) {
					
						if ( ot_get_option( 'uxbarn_to_setting_display_home_slider', 'true' ) == 'true' ) {
							$display_home_slider = true;
						}
						
					} else {
						$display_home_slider = true;
					}
				
				?>

				<?php if ( ( is_front_page() || uxbarn_is_frontpage_child() ) &&
						   $display_home_slider ) : // Only display home slider on these conditions ?>
					
					<hr class="layout-divider content-width" />
				
					<?php
					
						$slider_type = 'default-slider';
						
						if ( function_exists( 'ot_get_option' ) ) {
	                    	$slider_type = ot_get_option( 'uxbarn_to_setting_select_slider', 'default-slider' );
	                    }
						
	                    if ( $slider_type == '' ) {
	                        $slider_type = 'default-slider';
	                    }
	                    
	                ?>
	                
	                <?php if ( $slider_type == 'default-slider' ) : ?>
				
						<!-- Home Slider Container -->
						<div id="home-slider-container" class="slider-set">
							
							<?php
                            
                            	$args = array(
									'post_type' => 'uxbarn_homeslider',
									'nopaging' 	=> true,
									'meta_key' 	=> 'uxbarn_homeslider_slide_order',
									'orderby' 	=> 'meta_value_num',
									'order' 	=> 'ASC',
								);
                            	
                                $slides = new WP_Query( $args );
								
                            ?>
                            
                            <?php if ( $slides->have_posts() ) : ?>
								
								<ul class="home-slider-slides">
                            	
                            	<?php $i = 1; while ( $slides->have_posts() ) : $slides->the_post(); ?>
                        		
                        		<?php 
                                    // Define the slide ID
                                    $slide_id = 'slide_' . $i;
                                ?>
									<li id="<?php echo $slide_id; ?>" class="home-slider-item">
										
										<?php
                                        
                                            // Display slide image
                                            if ( has_post_thumbnail() ) {
                                                echo get_the_post_thumbnail( $post->ID, 'theme-home-slider-image' );
                                            } else {
                                                echo '<img src="' . UXB_THEME_ROOT_IMAGE_URL . 'placeholders/1170x600.gif" alt="' . __( 'No Image', 'uxbarn' ) . '" width="1170" height="600" />';
                                            }
                                            
                                            $show_caption = uxbarn_get_array_value( get_post_meta( $post->ID, 'uxbarn_homeslider_caption_display' ), 0 );
																	 
										 	$caption_text = trim( uxbarn_get_array_value(get_post_meta( $post->ID, 'uxbarn_homeslider_caption_body'), 0 ) );
											
											// right, left		 
										 	$caption_position = uxbarn_get_array_value( get_post_meta( $post->ID, 'uxbarn_homeslider_caption_position' ), 0 );
											
											// white, black
											$caption_color = uxbarn_get_array_value( get_post_meta( $post->ID, 'uxbarn_homeslider_caption_color' ), 0 );
											
											$caption_custom_color_style = '';
											$button_custom_color_style = '';
											
											if ( $caption_color == 'custom' ) {
												
												$custom_color = uxbarn_get_array_value( get_post_meta( $post->ID, 'uxbarn_homeslider_caption_custom_color' ), 0 );
												$caption_custom_color_style = ' style="color: ' . $custom_color . ';" ';
												$button_custom_color_style = ' style="border-color: ' . $custom_color . ' !important; color: ' . $custom_color . ' !important; opacity: 1;" ';
												
											}
																	 
										 	$caption_button_text = trim( uxbarn_get_array_value( get_post_meta( $post->ID, 'uxbarn_homeslider_caption_button_text' ), 0 ) );
																	 
										 	$caption_button_url = esc_url( uxbarn_get_array_value( get_post_meta( $post->ID, 'uxbarn_homeslider_caption_button_url' ), 0 ) );
																	 
										 	$show_border = uxbarn_get_array_value( get_post_meta( $post->ID, 'uxbarn_homeslider_border_display' ), 0 );
											$border_custom_color_style = uxbarn_get_array_value( get_post_meta( $post->ID, 'uxbarn_homeslider_border_color' ), 0 );
											if ( $border_custom_color_style != '' ) {
												$border_custom_color_style = ' style="border-color: ' . $border_custom_color_style . ';" ';
											}
                                                                     
                                            // Define caption ID
                                            $slide_caption_id = 'slide-caption_' . $i;
                                            
                                        ?>
                                        
                                        <?php if ( $show_caption == 'true' ) :    ?>
                                        	
                                            <div id="<?php echo $slide_caption_id; ?>" class="slider-caption <?php echo $caption_position . ' ' . $caption_color; ?>">
	                                            <h2 class="caption-title" <?php echo $caption_custom_color_style; ?>><?php the_title(); ?></h2>
	                                            <div class="caption-body" <?php echo $caption_custom_color_style; ?>>
	                                            	<p>
	                                                	<?php echo $caption_text; ?>
	                                                </p>
		                                            <?php if ( $caption_button_text != '' ) : ?>
		                                            	<a href="<?php echo $caption_button_url; ?>" class="<?php echo $caption_color; ?> button" <?php echo $button_custom_color_style; ?>><?php echo $caption_button_text; ?></a>
	                                            	<?php endif; ?>
	                                            </div>
	                                        </div>
	                                        
                                        <?php endif; ?>
                                        
                                        <?php if ( $show_border == 'true' ) : ?>
											<div class="home-slider-item-border" <?php echo $border_custom_color_style; ?>></div>
										<?php endif; ?>
									</li>
									
									<?php $i++; endwhile; ?>
									
								</ul>
			
								<a href="#" class="slider-controller slider-prev"><i class="icon-angle-left"></i></a>
								<a href="#" class="slider-controller slider-next"><i class="icon-angle-right"></i></a>
							
							<?php else : // If there is no slide ?>
                                
                                <div class="home-slider-item no-slide">
                                    <div class="slider-caption">
	                                    <h2 class="caption-title"><?php _e( 'No Slide', 'uxbarn' ); ?></h2>
	                                    <p class="caption-body">
	                                        <?php _e( 'You have not yet added any slide. Please go to "Home Slider > Add New Slide" menu to add ones.', 'uxbarn' ); ?>
	                                    </p>
                                    </div>
                                </div>
                                
                            <?php endif; wp_reset_postdata(); ?>
							
						</div>
						<!-- End id="home-slider-container" -->
						
					<?php else : // else if $slider_type == 'layerslider' ?>
		                
		                <?php
		                    
							$layerslider_shortcode = '';
							
		                    // Get the selected slider
		                    if ( function_exists( 'ot_get_option' ) ) {
		                    	$layerslider_shortcode = ot_get_option( 'uxbarn_to_setting_layerslider_shortcode', '' );
							}
							
		                    $no_slider_class = '';
		                    
		                    if ( $layerslider_shortcode == '' ) {
		                        $no_slider_class = ' class="no-slider" ';
		                    }
		                    
		                    echo '<div id="uxb-layerslider-container">';
		                    echo '<div id="uxb-layerslider"' . $no_slider_class . '>';
		                    
		                    // If the user hasn't specify any LayerSlider shortcode yet
		                    if ( $layerslider_shortcode == '' ) {
		                        
		                        echo '<div class="info box no-layerslider-box">' . __( 'You have not yet specify which LayerSlider to be used here. Please go to: "Theme Options > Home Slider > LayerSlider Shortcode".', 'uxbarn' ) . '</div>';
		                        
		                    } else { // else, simply display it by rendering the specified shortcode.
	                        	echo do_shortcode( $layerslider_shortcode );
		                    }
		                    
		                    echo '</div>'; // close id="uxb-layerslider"
		                    echo '</div>'; // close id="uxb-layerslider-container"
		                    
		                ?>
		                
		            <?php endif; // END: if($slider_type == 'default-slider') ?>
		            
	            <?php endif; // END: if(is_front_page()... ?>
	            
	            
	            <div id="content-container" class="columns-content-width">
	            	
	            	<?php get_template_part( 'template-intro' ); ?>
	            	
	            	<?php if ( ! is_404()  && ! is_singular( 'uxbarn_portfolio' ) && ! is_tax( 'uxbarn_portfolio_tax' ) ) : ?>
	            		
		            	<?php 
		            	
		            		global $uxbarn_intro_display;
							$inner_class = '';
							
							if ( ( is_front_page() || uxbarn_is_frontpage_child() || is_page() ) && $uxbarn_intro_display == 'false' ) {
								//$inner_class = ' no-margin-top ';
							}
		            		
	            		?>
	    				<div id="inner-content-container" class="row <?php echo $inner_class; ?>">
	    					
					<?php endif; ?>
