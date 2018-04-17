<?php
/**
 * Contact Template extra meta.
 *
 * @since 1.0.2
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'add_meta_boxes', 'nbs_add_metaboxes_contact' );

function nbs_add_metaboxes_contact() {

	global $post;

	if ( get_post_meta( $post->ID, '_wp_page_template', true ) !== 'page-templates/contact.php' ) {
		return;
	}

	wp_enqueue_editor();
	add_filter( 'rbm_fieldhelpers_load_select2', '__return_true' );

	add_meta_box(
		'nbs-contact-info',
		'Contact Information',
		'nbs_mb_contact',
		'page'
	);
}

function nbs_mb_contact() {

	nbs_field_helpers()->fields->do_field_media( 'map_image', array(
		'group' => 'contact',
		'label' => 'Map Image',
	) );

	nbs_field_helpers()->fields->do_field_text( 'map_link', array(
		'group'       => 'contact',
		'label'       => 'Map Link (Google Maps Link)',
		'input_class' => 'widefat',
	) );

	nbs_field_helpers()->fields->do_field_textarea( 'address', array(
		'group'   => 'contact',
		'label'   => 'Address',
		'rows'    => 15,
		'wysiwyg' => true,
	) );

	nbs_field_helpers()->fields->do_field_textarea( 'hours', array(
		'group'   => 'contact',
		'label'   => 'Hours',
		'rows'    => 15,
		'wysiwyg' => true,
	) );

	$forms        = Ninja_Forms()->form()->get_forms();
	$form_options = array();

	/** @var NF_Database_Models_Form $form */
	foreach ( $forms as $form ) {

		$form_options[] = array(
			'text'  => $form->get_setting( 'title' ),
			'value' => $form->get_id(),
		);
	}

	nbs_field_helpers()->fields->do_field_select( 'ninjaformid', array(
		'group'   => 'contact',
		'label'   => 'Contact Form',
		'options' => $form_options,
	) );

	nbs_field_helpers()->fields->save->initialize_fields( 'contact' );
}