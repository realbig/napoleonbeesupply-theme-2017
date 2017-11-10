<?php
/**
 * Adds extra meta to products.
 *
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || die();

add_action( 'add_meta_boxes', 'nbs_add_mb_product' );

/**
 * Adds meta boxes for products.
 *
 * @since 1.0.0
 * @access private
 */
function nbs_add_mb_product() {

	add_meta_box(
		'nbs-product-featured-image',
		'Featured Image',
		'nbs_mb_product_featured_image',
		'product',
		'side'
	);
}

/**
 * Outputs the meta box for product subhead.
 *
 * @since 1.0.0
 * @access private
 */
function nbs_mb_product_featured_image() {

	nbs_field_helpers()->fields->do_field_media( 'featured_image', array(
		'group'       => 'product',
		'description' => 'Used in any area the product is featured (such as the homepage).',
	) );

	nbs_field_helpers()->fields->save->initialize_fields( 'product' );
}