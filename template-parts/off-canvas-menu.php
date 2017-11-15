<?php
/**
 * Template part for off canvas menu
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>

<nav class="off-canvas-menu off-canvas position-right" id="off-canvas-menu" data-off-canvas data-auto-focus="false"
     role="navigation">

    <button class="off-canvas-close" data-toggle="off-canvas-menu">
        Close
    </button>

    <h2 class="off-canvas-section-title">Cart</h2>

    <div class="woocommerce-cart">
        <a href="<?php echo wc_get_cart_url(); ?>">
            <span class="fa fa-shopping-cart"></span>
            &nbsp;<?php echo WC()->cart->get_cart_contents_count(); ?> items
            &nbsp;-&nbsp;$<?php echo WC()->cart->cart_contents_total; ?>
        </a>
    </div>

    <h2 class="off-canvas-section-title">Navigation</h2>

	<?php foundationpress_mobile_nav(); ?>

	<?php $categories = get_terms( array( 'taxonomy' => 'product_cat', 'hide_empty' => false ) ); ?>
	<?php if ( $categories ) : ?>

        <h2 class="off-canvas-section-title">Catalog</h2>

        <section class="product-categories hexagon-grid hexagon-grid-force-small">
			<?php foreach ( $categories as $category ) : ?>
				<?php
				$thumbnail_ID   = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );
				$category_image = wp_get_attachment_url( $thumbnail_ID );
				?>
                <div class="hexagon-item-container">
                    <a href="<?php echo get_term_link( $category ); ?>"
                       class="product-category hexagon hexagon-force-small">
                        <div class="hexagon-background"
                             style="background-image: url('<?php echo esc_attr( $category_image ); ?>');"></div>
                        <p class="hexagon-text"><?php echo $category->name; ?></p>
                    </a>
                </div>
			<?php endforeach; ?>
        </section>
	<?php endif; ?>
</nav>
