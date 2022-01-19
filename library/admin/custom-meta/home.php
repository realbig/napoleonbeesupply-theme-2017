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
	}	wp_enqueue_editor();


	remove_post_type_support( 'page', 'editor' );

	add_filter( 'rbm_fieldhelpers_load_select2', '__return_true' );

	add_meta_box(
		'nbs-home-settings',
		'Page Settings',
		'nbs_mb_home_settings',
		'page'
	);

	add_meta_box(
		'nbs-promotion-block',
		__( 'Promotion Blocks', 'napoleonbeesupply-theme-2017' ),
		'nbs_mb_promotions_block',
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

	$hero_page_options = array( array( 'value' => '0', 'text' => "Don't show a button" ) );

	foreach ( $pages as $page ) {

		$hero_page_options[] = array(
			'value' => "page:::{$page->ID}",
			'text'  => $page->post_title,
		);
	}

	$product_categories = get_terms( array(
		'taxonomy'   => 'product_cat',
		'hide_empty' => false,
	) );

	foreach ( $product_categories as $category ) {

		$hero_page_options[] = array(
			'value' => "product_cat:::{$category->term_id}",
			'text'  => "Category: {$category->name}",
		);
	}

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
		'group'       => 'home',
		'label'       => 'Hero Page Link',
		'input_class' => 'regular-text',
		'options'     => $hero_page_options,
		'placeholder' => '- Select a Link -',
	) );

	nbs_field_helpers()->fields->do_field_text( 'hero_page_link_2_text', array(
		'group'       => 'home',
		'label'       => 'Hero Page Link 2 Button Text',
		'input_class' => 'regular-text',
	) );

	nbs_field_helpers()->fields->do_field_select( 'hero_page_link_2', array(
		'group'       => 'home',
		'label'       => 'Hero Page Link 2',
		'input_class' => 'regular-text',
		'options'     => $hero_page_options,
		'placeholder' => '- Select a Link -',
	) );

	nbs_field_helpers()->fields->save->initialize_fields( 'home' );
}

/**
 * Repeater field for outputting Promotion Blocks
 * These will alternate left/right down the page
 *
 * @since	1.1.0
 * @return  void
 */
function nbs_mb_promotions_block() {

	$options = get_terms( array(
		'hide_empty' => true,
		'taxonomy' => $product_cat,
	) );

	$options = wp_list_pluck( $options, 'name', 'term_id' );

	nbs_field_helpers()->fields->do_field_repeater( 'promotions', array(
		'group' => 'promotions',
		'fields' => array(
			'title' => array(
				'type' => 'text',
				'args' => array(
					'label' => __( 'Title', 'napoleonbeesupply-theme-2017' ),
				)
			),
			'content' => array(
				'type' => 'textarea',
				'args' => array(
					'label' => __( 'Content', 'napoleanbeesupply-theme-2017' ),
					'wysiwyg' => true,
				),
			),
			'category' => array(
				'type' => 'select',
				'args' => array(
					'label' => __( 'Product Category to show', 'napoleonbeesupply-theme-2017' ),
					'options' => $options,
					'select2_options' => array(
						'placeholder' => __( 'Select a Category', 'napoleonbeesupply-theme-2017' ),
					),
				),
			)
		),
	) );

	nbs_field_helpers()->fields->save->initialize_fields( 'promotions' );

}