<?php
/**
 * RBM Field Helpers
 */

defined( 'ABSPATH' ) || die();

/**
 * Gets the Napleon Bee Supply RBM Field Helpers instance.
 *
 * @since {{VERSION}}
 */
function nbs_field_helpers() {

	if ( ! class_exists( 'RBM_FieldHelpers' ) ) {
		return false;
	}

	static $field_helpers;

	if ( $field_helpers === null ) {

		$field_helpers = new RBM_FieldHelpers( array(
			'ID' => 'nbs',
		) );
	}

	return $field_helpers;
}

nbs_field_helpers();