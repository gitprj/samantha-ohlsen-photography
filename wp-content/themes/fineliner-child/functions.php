<?php

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
}



// Shortcode for Blog pots

		add_action( 'init', 'uxb_post_load_shortcodes' );

		// Only if Visual Composer is active
		if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
			add_action( 'admin_init', 'uxb_port_load_post_element', 11 );
		}




		// For any modification to global $query object before it's run
		// For example: reset posts per page for custom taxonomy template to be independent from blog posts
		add_action( 'pre_get_posts', 'uxb_post_alter_query_object' );


		// Register all plugin's image sizes
		add_action( 'init', 'post_image_sizes' );



if ( ! function_exists( 'post_image_sizes' ) ) {

	function post_image_sizes() {

	    add_image_size( 'uxb-port-element-thumbnails', 320, 9999 );
		add_image_size( 'uxb-port-related-items', 232, 232, true );
		add_image_size( 'uxb-port-single-landscape', 1100, 676, true );
		add_image_size( 'uxb-port-single-portrait', 600, 816, true );
		add_image_size( 'uxb-port-large-square', 400, 400, true );

	}

}



// For getting array value when using with OptionTree meta box
if ( ! function_exists( 'uxb_post_get_array_value' ) ) {

	function uxb_post_get_array_value( $array, $index ) {
	    return isset( $array[ $index ] ) ? $array[ $index ] : '';
	}

}



if ( ! function_exists( 'uxb_port_get_post_meta_text' ) ) {

	function uxb_port_get_post_meta_text( $string ) {
	    if ( trim( $string ) == '' || trim( $string ) == 'http://' ) {
	        return '-';
	    } else {
	        return $string;
	    }
	}

}



if ( ! function_exists( 'uxb_post_get_attachment' ) ) {

	function uxb_post_get_attachment( $attachment_id ) {

	    $attachment = get_post( $attachment_id );

	    // Need to check it first
	    if( isset( $attachment ) ) {

	       	return array(
	            'alt' 			=> get_post_meta($attachment->ID, '_wp_attachment_image_alt', true),
	            'caption' 		=> $attachment->post_excerpt,
	            'description' 	=> $attachment->post_content,
	            'href' 			=> get_permalink($attachment->ID),
	            'src' 			=> $attachment->guid,
	            'title' 		=> $attachment->post_title,
	        );

	    } else {
	        return array(
	            'alt' 			=> 'N/A',
	            'caption' 		=> 'N/A',
	            'description' 	=> 'N/A',
	            'href' 			=> 'N/A',
	            'src' 			=> 'N/A',
	            'title' 		=> 'N/A',
	        );
	    }
	}

}




if ( ! function_exists( 'uxb_post_get_attachment_id_from_src' ) ) {

	function uxb_post_get_attachment_id_from_src( $image_src ) {

	    global $wpdb;
	    $query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
	    $id = $wpdb->get_var( $query );
	    return $id;

	}

}



if ( ! function_exists( 'uxb_post_alter_query_object' ) ) {

	function uxb_post_alter_query_object( $query ) {

		if ( ! is_admin() && $query->is_main_query() ) {

			if ( is_tax( 'category' ) ) {
				$query->set( 'posts_per_page', -1 ); // Reset posts-per-page for taxonomy-portfolio.php
			}

		}

	}

}



// For checking whether there is specified shortcode incluced in the current post
if ( ! function_exists( 'uxb_post_has_shortcode' ) ) {

	function uxb_post_has_shortcode( $shortcode = '', $content ) {

	    // false because we have to search through the post content first
	    $found = false;

	    // if no short code was provided, return false
	    if ( ! $shortcode ) {
	        return $found;
	    }
	    // check the post content for the short code
	    if ( stripos( $content, '[' . $shortcode) !== false ) {
	        // we have found the short code
	        $found = true;
	    }

	    // return our final results
	    return $found;
	}

}



if ( ! function_exists( 'uxb_port_load_post_element' ) ) {

	function uxb_port_load_post_element() {

		global $post;

		$id_array = array();
		//$id_array[''] = ''; // Set first dummy item (not used)
		$args = array(
					'hide_empty' 	=> 0,
		            'orderby' 		=> 'title',
		            'order' 		=> 'ASC',
		        );

		$terms = get_terms( 'category', $args );

		if ( count( $terms ) > 0 ) {

			foreach ( $terms as $term ) {

		      	// If WPML is active (function is available)
				if ( function_exists( 'icl_object_id' ) && is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' ) ) {

					global $sitepress;

					if ( isset( $sitepress ) ) {

						$default_lang = $sitepress->get_default_language();

						// Text will be changed depending on current active lang, but the IDs are still original ones from default lang
						$id_array[ $term->name ] = icl_object_id( $term->term_id, 'category', true, $default_lang );

					} else {
						$id_array[ $term->name ] = $term->term_id;
					}

				} else { // If there is no WPML
					$id_array[ $term->name ] = $term->term_id;
				}

			}

		}


		if ( function_exists( 'vc_map' ) ) {

			vc_map( array(
			   'name' 		=> __( 'Post', 'uxb_port' ),
			   'base' 		=> 'uxb_post',
			   'icon' 		=> 'icon-wpb-uxb_portfolio',
			   'class' 		=> '',
			   'category' 	=> __( 'Content', 'uxb_port' ),
			   'params' 	=> array(
			      array(
			         'type' 		=> 'checkbox',
			         'holder' 		=> 'div',
			         'class' 		=> '',
			         'heading' 		=> __( 'Post categories', 'uxb_port' ),
			         'param_name' 	=> 'categories',
			         'value' 		=> $id_array,
			         'description' 	=> __( 'Select the categories from the list.', 'uxb_port' ),
			         'admin_label' 	=> true,
			      ),
			      array(
			         'type' 		=> 'textfield',
			         'holder' 		=> 'div',
			         'class' 		=> '',
			         'heading' 		=> __( 'Maximum number of items to be displayed', 'uxb_port' ),
			         'param_name' 	=> 'max_item',
			         'value' 		=> '',
			         'description' 	=> __( 'Enter a number to limit the max number of items to be listed. Leave it blank to show all items from the selected categories above. Only number is allowed.', 'uxb_port' ),
			         'admin_label' 	=> true,
			      ),
			      array(
			         'type' 		=> 'dropdown',
			         'holder' 		=> 'div',
			         'class' 		=> '',
			         'heading' 		=> __( 'Type', 'uxb_port'),
			         'param_name' 	=> 'type',
			         'value' 		=> array(
					                        __( 'Grid 3 Columns', 'uxb_port' ) 		=> 'col3',
					                        __( 'Grid 4 Columns', 'uxb_port' ) 		=> 'col4',
					                        __( 'Slider (fade transition)', 'uxb_port' )  => 'flexslider_fade',
					                        __( 'Slider (slide transition)', 'uxb_port' ) => 'flexslider_slide',
					                    ),
			         'description' => __('Select the display type for this element.', 'uxb_port'),
			         'admin_label' => true,
			      ),
			      array(
			         'type' 		=> 'dropdown',
			         'holder' 		=> 'div',
			         'class' 		=> '',
			         'heading' 		=> __( 'Show category filter', 'uxb_port' ),
			         'param_name' 	=> 'show_filter',
			         'value' 		=> array(
					                        __( 'Yes', 'uxb_port' ) => 'true',
					                        __( 'No', 'uxb_port' ) 	=> 'false',
					                    ),
			         'description' 	=> __( 'Whether to display the category filter at the top of the element.', 'uxb_port' ),
			         'dependency' 	=> array(
				                            'element' => 'type',
				                            'value' => array( 'col3', 'col4' ),
				                        ),
			         'admin_label' 	=> false,
			      ),

				  array(
			         'type'			=> 'dropdown',
			         'holder' 		=> 'div',
			         'class' 		=> '',
			         'heading' 		=> __( 'Thumbnail size', 'uxb_port' ),
			         'param_name' 	=> 'img_size',
			         'value' 		=> uxb_port_get_image_size_array(),
			         'description' 	=> __( 'Select which size to be used for the thumbnails. Anyway, the image will be scaled depending on its original size and containing column. If you are not sure which one to use, try <em>Large Square</em> or <em>Original size</em>.', 'uxb_port' ),
			         'admin_label' 	=> false,
			         'dependency' 	=> array(
				                            'element' 	=> 'type',
				                            'value' 	=> array( 'flexslider_fade', 'flexslider_slide' ),
				                        ),
			      ),
			      uxb_post_get_auto_rotation( 'type', array( 'flexslider_fade', 'flexslider_slide' ) ),
			      uxb_post_get_show_bullets( 'type', array( 'flexslider_fade', 'flexslider_slide' ) ),
			      uxb_post_get_orderby(),
			      uxb_post_get_order(),
			      uxb_post_get_extra_class_name(),
			   )

			) );

		}

	}

}



if ( ! function_exists( 'uxb_post_load_shortcodes' ) ) {

	function uxb_post_load_shortcodes() {

		add_shortcode( 'uxb_post', 'uxb_port_load_post_shortcode' );

	}

}



if ( ! function_exists( 'uxb_post_sanitize_numeric_input' ) ) {

	function uxb_post_sanitize_numeric_input( $input, $default ) {

	    if ( trim( $input ) != '' ) {

	        if ( is_numeric( $input ) ) {
	            return $input;
	        } else {
	            return $default;
	        }

	    } else {
	        return $default;
	    }

	}

}




if ( ! function_exists( 'uxb_post_is_using_vc' ) ) {

	function uxb_post_is_using_vc() {

	    // If user is using VC for the content
	    if ( uxb_post_has_shortcode( 'vc_row', get_the_content() ) ) {
	    	return true;
	    } else { // In case the user is using normal post editor (no "vc_row" shortcode found)
	    	return false;
	    }
	}

}

if ( ! function_exists( 'uxb_port_load_post_shortcode' ) ) {

    function uxb_port_load_post_shortcode( $atts ) {

		// Making this shortcode output "override-able" by the filter with custom callback in theme
		$output = apply_filters( 'uxb_port_load_post_shortcode_filter', '', $atts );
		if ( $output != '' ) {
			return $output;
		}

        $default_atts = array(
                            'categories' 	=> '',
                            'max_item' 		=> '',
                            'type' 			=> 'col4', // col3, col4, flexslider_fade, flexslider_slide
                            'show_filter' 	=> 'true', // true, false
                            'show_title' 	=> 'true', // true, false
                            'img_size' 		=> '',
                            'interval' 		=> '', // 0, 5, ..
                            'show_bullets' 	=> 'true', // true, false
                            'orderby' 		=> '',
                            'order' 		=> '',
                            'el_class' 	=> '',
                        );

        extract( shortcode_atts( $default_atts, $atts ) );

		if ( trim( $categories ) == '' ) {
            return '<div class="error box">' . __( 'Cannot generate Post element. Categories must be defined.', 'uxb_port' ) . '</div>';
        }

        $category_id_list = explode( ',', $categories );

		// If WPML is active, get translated category's ID
		if ( function_exists( 'icl_object_id' ) ) {

			$wpml_cat_list = array();

			foreach ( $category_id_list as $cat_id ) {
				$wpml_cat_list[] = icl_object_id( $cat_id, 'category', false, ICL_LANGUAGE_CODE );
			}

			$category_id_list = $wpml_cat_list;

		}


		if ( ! is_numeric( $max_item ) ) {
            $max_item = '';
        }

		// Prepare WP_Query args
        if ( $max_item == '' ) {

            $args = array(
                'post_type' 	=> 'post',
                'nopaging' 		=> true,
                'tax_query' 	=> array(
	                                    array(
		                                    'taxonomy'  => 'category',
		                                    'field' 	=> 'id',
		                                    'terms' 	=> $category_id_list,
                                    	),
                                	),
                'orderby' 		=> $orderby,
                'order' 		=> $order,
            );

        } else {

            $args = array(
                'post_type' 		=> 'post',
                'posts_per_page' 	=> $max_item,
                'tax_query' 		=> array(
		                                    array(
			                                    'taxonomy'  => 'category',
			                                    'field' 	=> 'id',
			                                    'terms' 	=> $category_id_list,
		                                    ),
		                                ),
                'orderby' 			=> $orderby,
                'order' 			=> $order,
            );

        }

        $portfolio = new WP_Query( $args );

		if ( ! $portfolio->have_posts() ) {
			return '<div class="error box">' . __( 'There are no posts available in the selected categories.', 'uxb_port' ) . '</div>';
		}

		if ( $type == 'col3' || $type == 'col4' ) {

			$output =
				'<div class="uxb-port-root-element-wrapper ' . $type . ' ' . $el_class . '">
					<span class="uxb-port-loading-text"><span>' . __( 'Loading', 'uxb_port' ) . '</span></span>

					<div class="uxb-port-loaded-element-wrapper">';

			if ( $show_filter == 'true' ) {

				$filter_string =
						'<ul class="uxb-port-element-filters">
							<li><a href="#" class="active" data-filter="*">' . __( 'All', 'uxb_port' ) . '</a></li>';

				// Generate filter items
				$terms_args = array(
		            'include' => $category_id_list,
		            'orderby' => 'menu_order',
		        );

		        $terms = get_terms( 'category', $terms_args );

		        if ( $terms && ! is_wp_error( $terms ) )  {

		            foreach ( $terms as $term ) {
		                $filter_string .= '<li><a href="#" data-filter=".term_' . $term->term_id . '">' . $term->name . '</a></li>';
		            }

		        }

				$filter_string .= '</ul>'; // close filter list
				$output .= $filter_string;

			}

			$output .= '<div class="uxb-port-element-wrapper">';

			// Generate grid columns
	        if ( $portfolio->have_posts() ) {

	            while ( $portfolio->have_posts() ) {

	                $portfolio->the_post();

					// Prepare category string for each item's class
	                $term_list = '';
	                $terms = get_the_terms( get_the_ID(), 'category' );

	                if ( $terms && ! is_wp_error( $terms ) )  {

	                    foreach ( $terms as $term ) {
	                        $term_list .= 'term_' . $term->term_id . ' ';
	                    }

	                }

	                $thumbnail = '';
	                if ( has_post_thumbnail( get_the_ID() ) ) {
	                    $thumbnail = get_the_post_thumbnail( get_the_ID(), 'uxb-port-element-thumbnails' );
	                } else {
	                    $thumbnail = '<img src="' . UXB_PORT_URL . 'images/placeholders/port-grid.gif" alt="' . __( 'No Thumbnail', 'uxb_port' ) . '" />';
	                }

					$show_title_code = '<hr/><h3>' . get_the_title() . '</h3><hr/>';
					if ( $show_title == 'false' ) {
						$show_title_code = '';
					}

					$output .=
						'<div class="uxb-port-element-item border ' . $term_list . '">
							<div class="uxb-port-element-item-hover">
								<a href="' . get_permalink() . '"></a>
								<div class="uxb-port-element-item-hover-info">' . $show_title_code . '</div>
							</div>
							' . $thumbnail . '
						</div>';

				}

			} else {

			}

			$output .= '</div>'; // close class="portfolio-wrapper"
			$output .= '</div>'; // close class="portfolio-loaded-wrapper"
			$output .= '</div>'; // close class="portfolio-root-wrapper

		} else { // if($type == 'col3' ... ) and this is for "flexslider" type

			$transition_effect = 'fade';

			if ( $type == 'flexslider_slide' ) {
				$transition_effect = 'slide';
			}

			if ( $show_bullets == 'false' ) {
				$show_bullets = ' hide-bullets ';
			}
			/*

			$border_class_array = array( 'class' => 'border' );

			if ( $border == 'no' ) {
				$border_class_array = array();
			}
			*/

		    $output = '<div class="uxb-port-image-slider-root-container ' . $el_class . '">';
			$output .= '<div class="uxb-port-image-slider-wrapper uxb-port-slider-set ' . $show_bullets . '" data-auto-rotation="' . $interval . '" data-effect="' . $transition_effect . '">';
		    $output .= '<ul class="uxb-port-image-slider">';

			if ( $portfolio->have_posts() ) {

	            while ( $portfolio->have_posts() ) {

	                $portfolio->the_post();

					// Default case if there is no thumbnail assigned
					$img_tag = '<img class="border" src="' . UXB_PORT_URL . 'images/placeholders/port-slider.gif" alt="' . __( 'No Thumbnail', 'uxb_port' ) . '" />';

					if ( has_post_thumbnail( get_the_ID() ) ) {

						$attachment_id = get_post_thumbnail_id( get_the_ID() );

						// If there is an alternate thumbnail specified, use it instead
						$alternate_thumbnail_url = uxb_post_get_array_value( get_post_meta( get_the_ID(), 'uxbarn_portfolio_alternate_thumbnail' ), 0 );

						if( $alternate_thumbnail_url != '' ) {
							$attachment_id = uxb_post_get_attachment_id_from_src( $alternate_thumbnail_url );
						}

						$attachment = uxb_post_get_attachment( $attachment_id );

						$img_fullsize = $attachment['src'];

						// Get an array: [0] => url, [1] => width, [2] => height
				        $img_thumbnail = wp_get_attachment_image_src( $attachment_id, $img_size );

				        $title = $attachment['title']; //trim(esc_attr(strip_tags( get_post_meta($attachment_id, '_wp_attachment_image_alt', true) )));

				        $anchor_title = '';

				        if ( $title != '' ) {
				            $anchor_title = ' title="' . $title . '" ';
				        }

				        $img_tag = '<img src="' . $img_thumbnail[0] . '" class="border" alt="' . $attachment['alt'] . '" width="' . $img_thumbnail[1] . '" height="' . $img_thumbnail[2] . '" />';

	                }

					// Don't need to apply "width" or "height" here, it's aleady done in css for 100% width.
					$output .= '<li class="uxb-port-image-slider-item">';

					$output .= '<a href="' . get_permalink() . '"' . $anchor_title . ' class="image-link">' . $img_tag . '</a>';

			        if ( trim( $attachment['caption'] ) != '' ) {
			            $output .= '<div class="uxb-port-image-caption-wrapper"><div class="uxb-port-image-caption">' . $attachment['caption'] . '</div></div>';
			        }

			        $output .= '</li>'; // close "image-slider-item"

				}
			}

		    $output .= '</ul>'; // close "image-slider"
		    $output .= '</div>'; // close "image-slider-wrapper slider-set"
		    $output .=
		            	'<a href="#" class="uxb-port-slider-controller uxb-port-slider-prev"><i class="icon-angle-left"></i></a>
						<a href="#" class="uxb-port-slider-controller uxb-port-slider-next"><i class="icon-angle-right"></i></a>';
		    $output .= '</div>'; // close "image-slider-root-container"

		}

		wp_reset_postdata();

        return $output;

    }

}


if ( ! function_exists( 'uxb_port_get_image_size_array' ) ) {

    function uxb_port_get_image_size_array() {

        // Prepare image size array
        $size_array = array( __( 'Original size', 'uxb_port' ) => 'full' );

        foreach ( get_intermediate_image_sizes() as $s ) {

            global $_wp_additional_image_sizes;

            if ( isset( $_wp_additional_image_sizes[$s] ) ) {

                $width = intval( $_wp_additional_image_sizes[ $s ]['width'] );
                $height = intval( $_wp_additional_image_sizes[ $s ]['height'] );

            } else {

                $width = get_option( $s.'_size_w' );
                $height = get_option( $s.'_size_h' );

            }

            $clean_name = ucwords( str_replace( 'cropped', '', str_replace( '-', ' ', $s ) ) );

            $size_array[ $clean_name . ' (' . $width . 'x' . $height . ')' ] = $s;

        }

        return $size_array;

    }

}



if ( ! function_exists( 'uxb_post_get_auto_rotation' ) ) {

    function uxb_post_get_auto_rotation( $dependency_param_name = '', $dependency_value_array = array() ) {

        $param = array(
                 'type' 		=> 'dropdown',
                 'holder' 		=> 'div',
                 'class' 		=> '',
                 'heading' 		=> __( 'Auto rotation duration', 'uxb_port' ),
                 'param_name' 	=> 'interval',
                 'value' 		=> array(
		                                __( 'Disable auto rotation', 'uxb_port' ) => '0',
		                                '5' => '5',
		                                '6' => '6',
		                                '7' => '7',
		                                '8' => '8',
		                                '9' => '9',
		                                '10' => '10',
		                                '12' => '12',
		                                '14' => '14',
		                                '16' => '16',
		                                '18' => '18',
		                                '20' => '20',
		                                '25' => '25',
		                                '30' => '30',
		                                '40' => '40',
		                                '60' => '60',
		                                '80' => '80',
		                                '100' => '100',
		                            ),
                 'description' 	=> __( 'Select how many seconds to stay on current slide before rotating to the next one.', 'uxb_port' ),
                 'admin_label' 	=> false,
                 'dependency' 	=> array(
	                                    'element' 	=> $dependency_param_name,
	                                    'value' 	=> $dependency_value_array,
	                                ),
              );

        return $param;

    }

}



if ( ! function_exists( 'uxb_post_get_show_bullets' ) ) {

    function uxb_post_get_show_bullets( $dependency_param_name = '', $dependency_value_array = array() ) {

    	return array(
	         'type' 		=> 'dropdown',
	         'holder' 		=> 'div',
	         'class' 		=> '',
	         'heading' 		=> __( 'Show bullets?', 'uxb_port' ),
	         'param_name' 	=> 'show_bullets',
	         'value' 		=> array(
			                        __( 'Yes', 'uxb_port' ) => 'true',
			                        __( 'No', 'uxb_port' )  => 'false',
			                    ),
	         'description' 	=> __( "Whether to display the slider's bullets.", 'uxb_port' ),
	         'admin_label' 	=> false,
	         'dependency' 	=> array(
		                            'element' 	=> $dependency_param_name,
		                            'value' 	=> $dependency_value_array,
		                        ),
	      );

	}

}



if ( ! function_exists( 'uxb_post_get_orderby' ) ) {

    function uxb_post_get_orderby() {

        $param = array(
             'type' 		=> 'dropdown',
             'holder' 		=> 'div',
             'class' 		=> '',
             'heading' 		=> __( 'Order by', 'uxb_port' ),
             'param_name' 	=> 'orderby',
             'value' 		=> array(
		                            __( 'ID', 'uxb_port' ) 			 	=> 'ID',
		                            __( 'Title', 'uxb_port' ) 		 	=> 'title',
		                            __( 'Slug', 'uxb_port' ) 			=> 'name',
		                            __( 'Published Date', 'uxb_port' ) 	=> 'date',
		                            __( 'Modified Date', 'uxb_port' )  	=> 'modified',
		                            __( 'Random', 'uxb_port' ) 		 	=> 'rand',
		                        ),
             'description' 	=> __( 'Select the which parameter to be used for ordering. <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">See more info here</a>', 'uxb_port' ),
             'admin_label' 	=> false,
          );

        return $param;

    }

}



if ( ! function_exists( 'uxb_post_get_order' ) ) {

    function uxb_post_get_order() {

        $param = array(
             'type' 		=> 'dropdown',
             'holder' 		=> 'div',
             'class' 		=> '',
             'heading' 		=> __( 'Order', 'uxb_port' ),
             'param_name' 	=> 'order',
             'value' 		=> array(
		                            __( 'Ascending', 'uxb_port' )  => 'ASC',
		                            __( 'Descending', 'uxb_port' ) => 'DESC',
		                        ),
             'description' 	=> __( '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">See more info here</a>', 'uxb_port' ),
             'admin_label' 	=> false,
          );

        return $param;

    }

}



if ( ! function_exists( 'uxb_post_get_extra_class_name' ) ) {

    function uxb_post_get_extra_class_name() {

        $param = array(
             'type' 		=> 'textfield',
             'holder' 		=> 'div',
             'class' 		=> '',
             'heading' 		=> __( 'Extra class name', 'uxb_port' ),
             'param_name' 	=> 'el_class',
             'value' 		=> '',
             'description' 	=> __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'uxb_port' ),
             'admin_label' 	=> false,
          );

        return $param;

    }

}

		add_action( 'wp_enqueue_scripts', 'uxb_post_load_frontend_styles' );
		add_action( 'wp_enqueue_scripts', 'uxb_post_load_frontend_scripts' );
		add_action( 'wp_enqueue_scripts', 'uxb_post_load_on_demand_assets' );


if ( ! function_exists( 'uxb_post_load_frontend_styles' ) ) {

	function uxb_post_load_frontend_styles() {

		// Prepare all styles
	    wp_register_style( 'uxb-port-foundation', get_stylesheet_directory_uri() . 'css/foundation-lite.css', array(), null ); // only contains row, columns stuff
	    wp_register_style( 'uxb-port-isotope', get_stylesheet_directory_uri() . 'css/isotope.css', array(), null );
	    wp_register_style( 'uxbarn-fancybox', get_stylesheet_directory_uri() . 'css/jquery.fancybox.css', array(), null ); // named the handle as same as the theme's
		wp_register_style( 'uxbarn-fancybox-helpers-thumbs', get_stylesheet_directory_uri() . 'css/fancybox/helpers/jquery.fancybox-thumbs.css', array(), null ); // named the handle as same as the theme's
		wp_register_style( 'uxbarn-flexslider', get_stylesheet_directory_uri() . 'css/flexslider.css', array(), null ); // named the handle as same as the theme's
	    wp_register_style( 'uxbarn-font-awesome', get_stylesheet_directory_uri() . 'css/font-awesome.min.css', array(), null );
		wp_register_style( 'uxb-port-frontend', get_stylesheet_directory_uri() . 'css/plugin-frontend.css', array(), null );
		wp_register_style( 'uxb-port-responsive', get_stylesheet_directory_uri() . 'css/plugin-responsive.css', array( 'uxb-port-frontend' ), null );

	}

}



if ( ! function_exists( 'uxb_post_load_frontend_scripts' ) ) {

	function uxb_post_load_frontend_scripts() {

		// Prepare all scripts
	    wp_register_script( 'uxb-port-modernizr', get_stylesheet_directory_uri() . 'js/custom.modernizr.js', array( 'jquery' ), null );
	    wp_register_script( 'uxb-port-foundation', get_stylesheet_directory_uri() . 'js/foundation.min.js', array( 'jquery' ), null, true );
	    wp_register_script( 'uxbarn-isotope', get_stylesheet_directory_uri() . 'js/jquery.isotope.min.js', array( 'jquery' ), null, true ); // named the handle as same as the theme's
	    wp_register_script( 'uxb-port-mousewheel', get_stylesheet_directory_uri() . 'js/jquery.mousewheel-3.0.6.pack.js', array( 'jquery' ), null, true );
	    wp_register_script( 'uxbarn-flexslider', get_stylesheet_directory_uri() . 'js/jquery.flexslider.js', array( 'jquery' ), null, true ); // named the handle as same as the theme's
	    wp_register_script( 'uxbarn-fancybox', get_stylesheet_directory_uri() . 'js/jquery.fancybox.pack.js', array( 'jquery' ), null, true ); // named the handle as same as the theme's
	    wp_register_script( 'uxbarn-fancybox-helpers-thumbs', get_stylesheet_directory_uri() . 'js/fancybox-helpers/jquery.fancybox-thumbs.js', array( 'jquery' ), null, true ); // named the handle as same as the theme's
	    wp_register_script( 'uxb-port-frontend', get_stylesheet_directory_uri() . 'js/plugin-frontend.js', array( 'jquery' ), null, true );


		// Prepare any values from the plugin options to be used in the front-end JS
		if ( is_plugin_active( 'option-tree/ot-loader.php' ) ) {

			$plugin_options = get_option( 'uxb_port_plugin_options' );

			$portfolio_slider_transition = $plugin_options['uxb_port_po_single_page_slider_transition'];

			if ( $portfolio_slider_transition == '' ) {
				$portfolio_slider_transition = 'fade';
			}

		    $portfolio_slider_transition_speed = uxb_port_sanitize_numeric_input( $plugin_options['uxb_port_po_single_page_slider_transition_speed'], 600 );
		    $portfolio_slider_auto_rotation = $plugin_options['uxb_port_po_single_page_slider_auto_rotation'] == 'false' ? false : true;
		    $portfolio_slider_rotation_duration = uxb_port_sanitize_numeric_input( $plugin_options['uxb_port_po_single_page_slider_rotation_duration'], 5000 );

		} else {

			$portfolio_slider_transition = 'fade';
		    $portfolio_slider_transition_speed = 600;
		    $portfolio_slider_auto_rotation = false;
		    $portfolio_slider_rotation_duration = 5000;

		}

		$params = array(
	            'portfolio_slider_transition' 			=> $portfolio_slider_transition,
	            'portfolio_slider_transition_speed' 	=> $portfolio_slider_transition_speed,
	            'portfolio_slider_auto_rotation' 		=> $portfolio_slider_auto_rotation,
	            'portfolio_slider_rotation_duration' 	=> $portfolio_slider_rotation_duration,
	        );

	    wp_localize_script( 'uxb-port-frontend', 'UXbarnPortOptions', $params );

	}

}



if ( ! function_exists( 'uxb_post_load_on_demand_assets' ) ) {

	function uxb_post_load_on_demand_assets() {

		// Load the prepared styles depending on the current page and shortcode
		if ( is_page() || is_single() ) {

			global $post;

			if ( uxb_port_has_shortcode( 'uxb_post', $post->post_content ) ) {

				wp_enqueue_style( 'uxb-port-isotope' );
				wp_enqueue_style( 'uxbarn-flexslider' );
				wp_enqueue_style( 'uxb-port-frontend' );
				wp_enqueue_style( 'uxb-port-responsive' );

				wp_enqueue_script( 'uxbarn-isotope' );
				wp_enqueue_script( 'uxbarn-flexslider' );
    			wp_enqueue_script( 'uxb-port-frontend' );

			}

		}


		if ( is_singular( 'post' ) ) {

	    	wp_enqueue_style( 'uxb-port-foundation' );
			wp_enqueue_style( 'uxb-port-isotope' );
			wp_enqueue_style( 'uxbarn-fancybox' );
			wp_enqueue_style( 'uxbarn-fancybox-helpers-thumbs' );
			wp_enqueue_style( 'uxbarn-flexslider' );
			wp_enqueue_style( 'uxbarn-font-awesome' );
			wp_enqueue_style( 'uxb-port-frontend' );
			wp_enqueue_style( 'uxb-port-responsive' );

		    wp_enqueue_script( 'uxb-port-modernizr' );
		    wp_enqueue_script( 'uxb-port-foundation' );
		    wp_enqueue_script( 'uxbarn-isotope' );
		    wp_enqueue_script( 'uxb-port-mousewheel' );
		    wp_enqueue_script( 'uxbarn-flexslider' );
		    wp_enqueue_script( 'uxbarn-fancybox' );
		    wp_enqueue_script( 'uxbarn-fancybox-helpers-thumbs' );
			wp_enqueue_script( 'uxb-port-frontend' );

			// Conditional comment for IE8
		    global $wp_styles;
		    wp_enqueue_style( 'uxb-port-foundation-ie8', get_stylesheet_directory_uri() . 'css/foundation-ie8.css', array(), null);
		    $wp_styles->add_data( 'uxb-port-foundation-ie8', 'conditional', 'IE 8' );

		}

		if ( is_tax( 'category' ) ) {

	    	wp_enqueue_style( 'uxb-port-foundation' );
			wp_enqueue_style( 'uxb-port-isotope' );
			wp_enqueue_style( 'uxb-port-frontend' );
			wp_enqueue_style( 'uxb-port-responsive' );

		    wp_enqueue_script( 'uxb-port-modernizr' );
		    wp_enqueue_script( 'uxb-port-foundation' );
		    wp_enqueue_script( 'uxbarn-isotope' );
			wp_enqueue_script( 'uxb-port-frontend' );


		}

	}

}

add_action( 'add_meta_boxes', 'register_custom_fields_to_cpt');
function register_custom_fields_to_cpt() {
	add_meta_box( 'template_box', 'Layout Mode', 'set_layout_mode', 'post', 'normal', 'high'  );
}
add_action( 'save_post', 'save_custom_fields_values');
function set_layout_mode(){
	global $post;
    wp_nonce_field('layout_mode_meta_nonce', 'layout_mode_meta_box_nonce');
    $data = get_post_meta($post->ID, 'layout_mode', true);
    if($data !=''){
    	$selected = "selected=selected";
    }
    else{
    	$selected = "";
    }

    ?>
    <select name="layout_mode" id="layout_mode">
    	<option value="landscape" <?php echo $selected; ?>>Landscape</option>
    	<option value="portrait" <?php echo $selected; ?>>Portrait</option>
    </select>

<?php }

function save_custom_fields_values( $post_id ) {

                    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
                    if( !current_user_can( 'edit_post' ) ) return;
                    $posttype = get_post_type($post_id);


                        //Save Home featured_post Fields
                        if(isset( $_POST['layout_mode_meta_box_nonce'] )) {
                              if( !isset( $_POST['layout_mode_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['layout_mode_meta_box_nonce'], 'layout_mode_meta_nonce' ) ) {
                                     return;
                             } else {
                                 $layout_mode = isset( $_POST['layout_mode'] )  ? $_POST['layout_mode'] : '';
                                 update_post_meta( $post_id, 'layout_mode', $layout_mode );

                            }
                        }
}