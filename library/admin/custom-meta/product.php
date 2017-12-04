<?php
/**
 * Adds extra meta to products.
 *
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || die();

add_action( 'add_meta_boxes', 'nbs_add_mb_product' );

// Columns
add_filter( "manage_edit-product_columns", 'nbs_add_columns_product' );
add_action( "manage_product_posts_custom_column", 'nbs_columns_data_product', 10, 2 );

/**
 * Adds meta boxes for products.
 *
 * @since 1.0.0
 * @access private
 */
function nbs_add_mb_product() {

	if ( nbs_field_helpers() === false ) {
		return;
	}

	add_meta_box(
		'nbs-product-featured',
		'Featured Product',
		'nbs_mb_product_featured',
		'product',
		'side'
	);

	add_meta_box(
		'nbs-product-featured-image',
		'Featured Image',
		'nbs_mb_product_featured_image',
		'product',
		'side'
	);
}

/**
 * Outputs the meta box for product featured.
 *
 * @since 1.0.0
 * @access private
 */
function nbs_mb_product_featured() {

	nbs_field_helpers()->fields->do_field_radio( 'featured_status', array(
		'group'   => 'product',
		'label'   => __( 'Product Featured Status', 'napoleonbeesupply-theme-2017' ),
		'options' => array(
			''             => __( 'Not Featured', 'napoleonbeesupply-theme-2017' ),
			'featured'     => __( 'Featured', 'napoleonbeesupply-theme-2017' ),
			'sub_featured' => __( 'Secondary Featured', 'napoleonbeesupply-theme-2017' ),
		),
	) );
}

/**
 * Outputs the meta box for product featured image.
 *
 * @since 1.0.0
 * @access private
 */
function nbs_mb_product_featured_image() {

	nbs_field_helpers()->fields->do_field_media( 'featured_image', array(
		'group'                     => 'product',
		'description'               => __( 'Used in any area the product is featured (such as the homepage).', 'napoleonbeesupply-theme-2017' ),
		'description_placement'     => 'after_label',
		'description_tip_alignment' => 'right',
	) );

	nbs_field_helpers()->fields->save->initialize_fields( 'product' );
}

/**
 * Adds columns to the Posts List Table for Products.
 *
 * @since {{VERSION}}
 * @access private
 *
 * @param $columns
 *
 * @return array
 */
function nbs_add_columns_product( $columns ) {

	if ( ! is_array( $columns ) ) {
		$columns = array();
	}

	$new = array();

	foreach ( $columns as $key => $title ) {
		$new[ $key ] = $title;

		if ( $key == 'name' ) {
			$new['product_featured'] = __( 'Featured', 'napoleonbeesupply-theme-2017' );
		}
	}

	return $new;
}

/**
 * Adds column data to the Posts List Table for Products.
 *
 * @since {{VERSION}}
 * @access private
 *
 * @param $column_name
 * @param $post_id
 */
function nbs_columns_data_product( $column_name, $post_id ) {

	switch ( $column_name ) {
		case 'product_featured':

			$featured = nbs_field_helpers()->fields->get_field( 'featured_status', $post_id );

			switch ( $featured ) {

				case 'featured':
					echo '<span class="dashicons dashicons-star-filled"></span>';
					_e( 'Featured', 'napoleonbeesupply-theme-2017' );
					break;

				case 'sub_featured':
					echo '<span class="dashicons dashicons-star-half"></span>';
					_e( 'Secondary Featured', 'napoleonbeesupply-theme-2017' );
					break;

				default:
					echo '<span class="dashicons dashicons-star-empty"></span>';
					_e( 'Not Featured', 'napoleonbeesupply-theme-2017' );
			}
			break;
	}
}