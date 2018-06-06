<?php
/**
 * Third party scripts and tools.
 *
 * @since 1.0.3
 */

defined( 'ABSPATH' ) || die();

// Google Tag Manager
add_action( 'wp_head', 'nbs_google_tag_manager_a_code', 99999999 );
add_action( 'nbs_body_open', 'nbs_google_tag_manager_b_code', 1 );

/**
 * Outputs the Google Tag Manager (A) code.
 *
 * @since 1.0.3
 * @access private
 */
function nbs_google_tag_manager_a_code() {

	include_once 'inc/google-tag-manager-a.php';
}
/**
 * Outputs the Google Tag Manager (B) code.
 *
 * @since 1.0.3
 * @access private
 */
function nbs_google_tag_manager_b_code() {

	include_once 'inc/google-tag-manager-b.php';
}