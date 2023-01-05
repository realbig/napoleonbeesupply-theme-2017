<?php
/**
 * Handles Woo`Co`mmerce support/modifications.
 *
 * @since 1.0.2
 */

defined( 'ABSPATH' ) || die();

add_filter( 'woocommerce_show_page_title', '__return_false' );
remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description' );

add_action( 'woocommerce_before_single_product', 'nbs_wc_single_product_notices' );
add_action( 'woocommerce_before_shop_loop', 'nbs_wc_template_archive_header', 1 );
add_action( 'woocommerce_before_shop_loop', 'nbs_wc_template_archive_header_results', 15 );
add_action( 'woocommerce_before_shop_loop', 'nbs_wc_template_close_div', 99 );
add_action( 'woocommerce_before_shop_loop', 'nbs_wc_template_close_div', 100 );
add_action( 'woocommerce_before_shop_loop', 'nbs_wc_template_close_div', 101 );

if ( is_active_sidebar( 'shop-widgets' ) ) {
    add_action( 'woocommerce_before_shop_loop', 'nbs_add_shop_sidebar', 102 );
    add_action( 'woocommerce_after_shop_loop', 'nbs_wc_template_close_div', 2 );
    add_action( 'woocommerce_after_shop_loop', 'nbs_wc_template_close_div', 3 );
}

add_filter( 'woocommerce_price_format', 'nbs_wc_price_format' );
//add_filter( 'pre_get_posts', 'nbs_bee_order_form_order' );
add_action( 'woocommerce_before_cart', 'nbs_wc_add_checkout_cart_notice', 11 );
add_action( 'woocommerce_before_checkout_form', 'nbs_wc_add_checkout_cart_notice', 11 );
add_filter( 'woocommerce_cart_item_class', 'nbs_wc_cart_item_class', 10, 2 );
//add_filter( 'woocommerce_email_order_items_table', 'nbs_add_wc_order_email_sku');
add_action( 'woocommerce_credit_card_form_end', 'nbs_woocommerce_credit_card_form_end', 11 );

// Change number of columns on product pages
add_filter( 'woocommerce_product_thumbnails_columns', function( $columns ) {
    return 3;
} );

/**
 * WooCommerce template before shop loop.
 *
 * @since 1.0.2
 * @access private
 */
function nbs_wc_template_archive_header() {

	add_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );

	$featured = get_term_meta( get_queried_object_id(), 'thumbnail_id', true );
	$image_src = false;

	if ( $featured ) {

	    $image_src = wp_get_attachment_image_src( $featured, 'full' );
	}
	?>

    <div class="woocommerce-archive-header"
    <?php echo $image_src ? "style=\"background-image: url({$image_src[0]})\"" : ''; ?>
    >
    <div class="woocommerce-archive-header-container">

    <h1 class="page-title"><?php woocommerce_page_title(); ?></h1>


    <?php do_action( 'woocommerce_archive_description' );
    
}

/**
 * WooCommerce template before shop loop.
 *
 * @since 1.0.2
 * @access private
 */
function nbs_wc_template_archive_header_results() {

	?>
    <div class="woocommerce-archive-header-results">
	<?php
}

/**
 * Add Shop Sidebar to the primary Product Archive
 *
 * @since   1.1.1
 * @return  void
 */
function nbs_add_shop_sidebar() {

    ?>

    <div class="row">

        <div class="small-12 medium-3 columns shop-sidebar">
            <?php dynamic_sidebar( 'shop-widgets' ); ?>
        </div>

        <div class="small-12 medium-9 columns">

    <?php

}

/**
 * WooCommerce template div closer.
 *
 * @since 1.0.2
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

    if ( is_admin() ) return $format;

	return '%1$s<span class="price-amount">%2$s</span>';
}

/**
 * Modifies the order of items on the bee order form.
 *
 * @since 1.0.2
 * @access private
 *
 * @param WP_Query $wp_query
 */
function nbs_bee_order_form_order( $wp_query ) {

	if ( is_admin() || 
        ! $wp_query->is_main_query() || 
        ( is_a( $wp_query->queried_object, 'WP_Term' ) && get_term_meta( get_queried_object()->term_id, 'nbs_bees_category', true ) !== '1' ) 
    ) {

		return;
	}

	$wp_query->set( 'orderby', 'meta_value_num' );
	$wp_query->set( 'meta_key', 'form_order' );
}

function nbs_add_wc_order_email_sku( $table, $order ) {

	ob_start();

	$template = 'emails/email-order-items.php';
	wc_get_template( $template, array(
		'order'                 => $order,
        'items'                 => $order->get_items(),
		'show_download_links'   => true,
		'show_sku'              => true,
		'show_purchase_note'    => true,
		'show_image'            => false,
	) );

	return ob_get_clean();
}

/**
* Alert for in-store-pickup items on checkout.
 *
 * @since 1.0.2
 * @access private
 */
function nbs_wc_add_checkout_cart_notice() {

    /** @var WooCommerce $woocommerce */
    global $woocommerce;

    $items = $woocommerce->cart->get_cart();

    foreach ( $items as $item ) {

        if ( $item['data']->is_virtual() ) {

            wc_print_notice( 'Please Note: One or more of your items is an in store pickup ONLY item. If you purchase this, you will not be charged shipping for this product, but must come in the store to pick it up.', 'notice' );

            break;
        }
    }
}

/**
* Alert for in-store-pickup items on single product.
 *
 * @since 1.0.2
 * @access private
 */
function nbs_wc_single_product_notices() {

    /** @var WC_Product $product */
    global $product;

    if ( $product->is_virtual() ) {

        wc_print_notice( 'Please Note: This is an in store pickup ONLY item. If you purchase this, you will not be charged shipping for this product, but must come in the store to pick it up.', 'notice' );
    }

}

/**
 * Modifies the cart item class.
 *
 * @since 1.0.2
 * @access private
 *
 * @param string $class
 * @param array $cart_item
 *
 * @return string
 */
function nbs_wc_cart_item_class( $class, $cart_item ) {

    if ( $cart_item['data']->is_virtual() ) {

        $class .= ' is-virtual';
    }

    return $class;
}

/**
 * Show some helper text for the Credit Card form
 * This form is slow to process and users could get confused
 *
 * @param   string  $id  Payment Gateway ID
 *
 * @since   1.0.8
 * @return  void
 */
function nbs_woocommerce_credit_card_form_end( $id ) {

    if ( $id !== 'ppcp-credit-card-gateway' ) return;

    ?>

    <p class="form-row form-row-wide">

        <?php printf( __( 'Once you click "%s", please wait while your order is processed. Do not hit the back button or resubmit your order.', 'napoleonbeesupply-theme-2017' ), apply_filters( 'woocommerce_order_button_text', __( 'Place order', 'woocommerce' ) ) ); ?>

    </p>

    <?php

}

if ( class_exists( 'FacetWP' ) && is_active_sidebar( 'shop-widgets' ) ) {

    add_action( 'woocommerce_before_shop_loop', function() {

        // Remove default pagination
	    remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );

        remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

        add_action( 'woocommerce_before_shop_loop', function() {
            echo do_shortcode( '[facetwp facet="results_count"]' );
        }, 20 );

    }, 10 );

    add_action( 'woocommerce_after_shop_loop', function() {
		
		echo do_shortcode( '[facetwp pager="true"]' );
		
	}, 1 );
	
}

/**
 * Remove Bundled Product Images from Product Single
 *
 * @param   string           $html          Image HTML
 * @param   integer          $product_id    Product ID of the Bundled Item
 * @param   WC_Bundled_Item  $bundled_item  Bundled Item object
 *
 * @since   1.1.1
 * @return  string                          Image HTML
 */
add_filter( 'woocommerce_bundled_product_image_html', function( $html, $product_id, $bundled_item ) {

    return '';

}, 10, 3 );

/**
 * Remove Bundled Product Images from the Cart
 *
 * @param   string  $html           Image HTML
 * @param   array   $cart_item      Cart Item Data
 * @param   string  $cart_item_key  Cart Item Index
 *
 * @since   1.1.1
 * @return  string                  Image HTML
 */
add_filter( 'woocommerce_cart_item_thumbnail', function( $html, $cart_item, $cart_item_key ) {

    if ( ! isset( $cart_item['bundled_item_id'] ) || ! $cart_item['bundled_item_id'] ) return $html;

    return '';

}, 10, 3 );

add_filter( 'do_shortcode_tag', 'nbs_fix_products_shortcode_output', 10, 4 );

/**
 * Fix staggered output of the [products] shortcode
 *
 * @param   string  $output  Shortcode output
 * @param   string  $tag     Shortcode tag
 * @param   array   $attr    Shortcode attributes array or empty string
 * @param   array   $m       Regular expression match array
 *
 * @since   {{VERSION}}
 * @return  string           Shortcode output
 */
function nbs_fix_products_shortcode_output( $output, $tag, $attr, $m ) {

    if ( strtolower( $tag ) != 'products' ) return $output;

    return preg_replace( '/\t|\n/sim', '', $output );

}