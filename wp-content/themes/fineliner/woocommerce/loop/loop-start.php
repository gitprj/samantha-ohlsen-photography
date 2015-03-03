<?php
/*
 * Theme Note
 * -------------------
 * - Added column class (3 or 4 columns) into the ul wrapper
 * 
 * 
 */
 
 
 
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
?>

<?php

	$products_column_class = '';
	
	if ( is_shop() || is_product_category() ) { // WooCommerce's templates, eg., shop page
		
		$products_column_class = ' wooc-col3 '; // default
		$columns_option = ot_get_option( 'uxbarn_to_setting_wooc_number_of_columns', '3' ); // get from Theme Options
		
		if ( $columns_option == '4' ) {
			$products_column_class = ' wooc-col4 ';
		}
		
	}
	
?>

<ul class="products <?php echo $products_column_class; ?>">