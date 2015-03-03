/*global jQuery:false */

jQuery(document).ready(function($) {
	"use strict";
	
	// Disable these options because there is no need to use with theme
	$('#woocommerce_frontend_css, #woocommerce_frontend_css_primary').closest('tr').css('display', 'none');
	$('#woocommerce_enable_lightbox').closest('fieldset').css('display', 'none');
	
});