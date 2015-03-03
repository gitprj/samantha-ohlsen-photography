<?php

/*
 * Theme Note
 * -------------------
 * - Edited the layout and location for related items, up-sell items
 * 
 * 
 */
 
 
 
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked woocommerce_show_messages - 10
	 */
	 do_action( 'woocommerce_before_single_product' );
?>

<div itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<div class="uxb-col large-12 columns">
		<div class="row less-margin-bottom">
			<div class="uxb-col large-5 columns">
				
				<?php
					/**
					 * woocommerce_show_product_images hook
					 *
					 * @hooked woocommerce_show_product_sale_flash - 10
					 * @hooked woocommerce_show_product_images - 20
					 */
					do_action( 'woocommerce_before_single_product_summary' );
				?>
				
			</div>
			<div class="uxb-col large-7 columns">
				<div class="summary entry-summary">
			
					<?php
						/**
						 * woocommerce_single_product_summary hook
						 *
						 * @hooked woocommerce_template_single_title - 5
						 * @hooked woocommerce_template_single_price - 10
						 * @hooked woocommerce_template_single_excerpt - 20
						 * @hooked woocommerce_template_single_add_to_cart - 30
						 * @hooked woocommerce_template_single_meta - 40
						 * @hooked woocommerce_template_single_sharing - 50
						 */
						do_action( 'woocommerce_single_product_summary' );
					?>
			
				</div><!-- .summary -->
			
			</div>
		</div>
		<div class="row">
			<div class="uxb-col large-12 columns">
				<?php
					/**
					 * woocommerce_after_single_product_summary hook
					 *
					 * @hooked woocommerce_output_product_data_tabs - 10
					 * @hooked woocommerce_output_related_products - 20 (moved to below)
					 */
					do_action( 'woocommerce_after_single_product_summary' );
				?>
			</div>
		</div>
		<div class="row">
			<div class="uxb-col large-12 columns">
				<?php 
					
					// Generate up-sell and related-product sections	
					do_action( 'uxbarn_woocommerce_after_single_product_summary' );
					
				?>
			</div>
		</div>
	</div>
</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>