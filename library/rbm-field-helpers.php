<?php
/**
 * RBM Field Helpers
 */

defined( 'ABSPATH' ) || die();

//add_action( 'muplugins_loaded', 'nbs_field_helpers' );
/**
 * Gets the Napleon Bee Supply RBM Field Helpers instance.
 *
 * @since {{VERSION}}
 */
function nbs_field_helpers() {

	static $field_helpers;

	if ( $field_helpers === null ) {

		$field_helpers = new RBM_FieldHelpers( array(
			'ID'   => 'nbs',
		) );
	}

	return $field_helpers;
}

nbs_field_helpers();