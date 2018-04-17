<?php
/**
 * RBM Field Helpers
 */

defined( 'ABSPATH' ) || die();

/**
 * Gets the Napleon Bee Supply RBM Field Helpers instance.
 *
 * @since 1.0.2
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

/**
 * Gets a field description tip.
 *
 * @since 1.0.2
 *
 * @param string $description Description text.
 */
function nbs_fieldhelpers_get_field_tip( $description ) {

	ob_start();
	?>
	<div class="fieldhelpers-field-description fieldhelpers-field-tip">
		<span class="fieldhelpers-field-tip-toggle dashicons dashicons-editor-help" data-toggle-tip></span>
		<p class="fieldhelpers-field-tip-text">
			<?php echo $description; ?>
		</p>
	</div>
	<?php

	return ob_get_clean();
}