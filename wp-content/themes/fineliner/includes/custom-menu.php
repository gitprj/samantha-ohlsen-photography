<?php

if ( ! function_exists( 'uxbarn_get_nav_menu_break_point_list' ) ) {
	
	function uxbarn_get_nav_menu_break_point_list() {
		
		// The menu handle from the register_nav_menu statement in functions.php
		$theme_location = 'header-menu';
		$theme_locations = get_nav_menu_locations();
		
		// Whether there is any menu created
		if ( ! empty( $theme_locations ) ) {
			$menu_obj = get_term( $theme_locations[ $theme_location ], 'nav_menu' );
		}
		
		
		if ( isset( $menu_obj ) && ! is_wp_error( $menu_obj ) ) {
			
			$uxbarn_break_point_list = array();
			
			$uxbarn_parent_menu_list = null;
			
			$temp_items = wp_get_nav_menu_items( $menu_obj->term_id );
			foreach ( $temp_items as $item ) {
				
				if ( $item->menu_item_parent == '0' ) {
					//echo $item->post_title;
					$uxbarn_parent_menu_list[] = $item;
				}
				
			}
			
			$break_point_runner = 1;
			$index_runner = 0;
			$count = count( $uxbarn_parent_menu_list );
			
			if ( $count > 0 ) {
				
				foreach ( $uxbarn_parent_menu_list as $item ) {
					
					if ( $break_point_runner == 3 ) {
						
						$uxbarn_break_point_list[] = $item;
						$break_point_runner = 1;
						
					} else {
						$break_point_runner += 1;
					}
					
					if( $index_runner == ( $count - 1 ) ) { // last item
						$uxbarn_break_point_list[] = $item;
					}
					
					$index_runner += 1;
					
				}
			
			}
			
		}
		
		return $uxbarn_break_point_list;
		
	}
	
}



if ( ! function_exists( 'search_in_menu_object_array' ) ) {
		
	function search_in_menu_object_array( $needle, $menu_obj_array ) {
		
	     foreach ( $menu_obj_array as $obj ) {
			if( $needle == $obj->ID ) {
				return true;
			}
		 }
		 
		 return false;
		 
	}

}



// Custom walker class
if ( ! class_exists( 'UXbarn_Custom_Menu_Walker' ) ) {

	class UXbarn_Custom_Menu_Walker extends Walker_Nav_Menu {
		
		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
	
			$class_names = $value = '';
	
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;
	
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
	
			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
	
			$output .= $indent . '<li' . $id . $value . $class_names .'>';
	
			$atts = array();
			$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
			$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
			$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
			$atts['href']   = ! empty( $item->url )        ? $item->url        : '';
	
			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
	
			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}
	
			$item_output = $args->before;
			$item_output .= '<a'. $attributes .'>';
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			$item_output .= '</a>';
			$item_output .= $args->after;
	
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
		
		function end_el( &$output, $item, $depth = 0, $args = array() ) {
			
			$uxbarn_break_point_list = uxbarn_get_nav_menu_break_point_list();
			
			$last_parent_menu = end( $uxbarn_break_point_list );
			
			if ( search_in_menu_object_array($item->ID, $uxbarn_break_point_list ) ) {
				
				if ( $item->ID == $last_parent_menu->ID ) {
					$output .= "</li></ul></div>";
				} else {
					$output .= "</li></ul></div><div class='menu-column'><ul class='sf-menu sf-vertical main-menu'>";
				}
				
			} else {
				$output .= "</li>\n";
			}
			
		}
	
	}

}
