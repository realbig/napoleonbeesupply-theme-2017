<?php
/**
 * Displayed when no products are found matching the current query
 *
 * @since {{VERSION}}
 */

defined( 'ABSPATH' ) || die();
?>
<div class="woocommerce-info">
    <div class="woocommerce-notice-content">
        <a href="<?php echo wc_get_page_permalink( 'shop' ); ?>" class="button wc-forward">Back to Shop</a>
		<?php _e( 'No products were found matching your selection.', 'woocommerce' ); ?>
    </div>
</div>

<div class="woocommerce-no-products">
</div>