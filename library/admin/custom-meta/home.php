<?php
/**
 * Adds extra meta to home page.
 *
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || die();

add_action( 'add_meta_boxes', 'nbs_add_mb_home' );

/**
 * Adds meta boxes for products.
 *
 * @since 1.0.0
 * @access private
 */
function nbs_add_mb_home() {

	if ( nbs_field_helpers() === false ) {
		return;
	}

	if ( get_the_ID() !== (int) get_option( 'page_on_front' ) ) {
		return;
	}

	remove_post_type_support( 'page', 'editor' );

	add_filter( 'rbm_fieldhelpers_load_select2', '__return_true' );

	add_meta_box(
		'nbs-home-settings',
		'Page Settings',
		'nbs_mb_home_settings',
		'page'
	);
}

/**
 * Outputs the meta box for home page settings.
 *
 * @since 1.0.0
 * @access private
 */
function nbs_mb_home_settings() {

	$pages = get_posts( array(
		'post_type'   => 'page',
		'numberposts' => - 1,
	) );

	nbs_field_helpers()->fields->do_field_text( 'subhead', array(
		'group'       => 'home',
		'label'       => 'Hero Page Sub Header Text',
		'input_class' => 'widefat',
	) );

	nbs_field_helpers()->fields->do_field_text( 'hero_page_link_text', array(
		'group'       => 'home',
		'label'       => 'Hero Page Link Button Text',
		'input_class' => 'regular-text',
	) );

	nbs_field_helpers()->fields->do_field_select( 'hero_page_link', array(
		'group'   => 'home',
		'label'   => 'Hero Page Link',
		'options' => wp_list_pluck( $pages, 'post_title', 'ID' ),
	) );

	nbs_field_helpers()->fields->save->initialize_fields( 'home' );
}