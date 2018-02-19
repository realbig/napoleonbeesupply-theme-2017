<?php
/**
 * Handles WooCommerce support/modifications.
 *
 * @since {{VERSION}}
 */

defined( 'ABSPATH' ) || die();

add_filter( 'woocommerce_show_page_title', '__return_false' );
remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description' );

add_action( 'woocommerce_before_shop_loop', 'nbs_wc_template_archive_header', 1 );
add_action( 'woocommerce_before_shop_loop', 'nbs_wc_template_archive_header_results', 15 );
add_action( 'woocommerce_before_shop_loop', 'nbs_wc_template_close_div', 99 );
add_action( 'woocommerce_before_shop_loop', 'nbs_wc_template_close_div', 100 );
add_action( 'woocommerce_before_shop_loop', 'nbs_wc_template_close_div', 101 );

add_filter( 'woocommerce_price_format', 'nbs_wc_price_format' );

/**
 * WooCommerce template before shop loop.
 *
 * @since {{VERSION}}
 * @access private
 */
function nbs_wc_template_archive_header() {

	add_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
	?>

    <div class="woocommerce-archive-header">
    <div class="woocommerce-archive-header-container">

    <h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

    <?php do_action( 'woocommerce_archive_description' ); ?>

	<?php
}

/**
 * WooCommerce template before shop loop.
 *
 * @since {{VERSION}}
 * @access private
 */
function nbs_wc_template_archive_header_results() {

	?>
    <div class="woocommerce-archive-header-results">
	<?php
}

/**
 * WooCommerce template div closer.
 *
 * @since {{VERSION}}
 * @access private
 */
function nbs_wc_template_close_div() {
	?>
    </div>
	<?php
}

/**
 */
function nbs_wc_price_format( $format ) {

	return '%1$s<span class="price-amount">%2$s</span>';
}