<?php
/*
Template Name: Front
*/
get_header();

$hero_page_link = nbs_field_helpers()->fields->get_meta_field( 'hero_page_link' );

if ( $hero_page_link ) {

	$hero_page_link_parts = explode( ':::', $hero_page_link );

	switch ( $hero_page_link_parts[0] ) {

		case 'product_cat':

			$hero_page_link = get_term_link( (int) $hero_page_link_parts[1], 'product_cat' );
			break;

		case 'page':

			$hero_page_link = get_permalink( $hero_page_link_parts[1] );
			break;
	}
}

$hero_page_link_2 = nbs_field_helpers()->fields->get_meta_field( 'hero_page_link_2' );
?>

    <header class="front-hero" role="banner"
		<?php echo nbs_get_featured_interchange( get_post_thumbnail_id( $post->ID ) ); ?>>
		<div class="color-overlay"></div>
        <div class="marketing">
            <div class="tagline">
                <h1 class="header"><?php the_title(); ?></h1>
                <h4 class="subheader"><?php echo nbs_field_helpers()->fields->get_meta_field( 'subhead' ); ?></h4>

				<?php if ( $hero_page_link ) : ?>
                    <a role="button" class="large button"
                       href="<?php echo esc_url_raw( $hero_page_link ); ?>">
						<?php echo nbs_field_helpers()->fields->get_meta_field( 'hero_page_link_text' ); ?>
                    </a>
				<?php endif; ?>

                <?php if ( $hero_page_link_2 ) : ?>
                    <a role="button" class="large button"
                       href="<?php echo esc_url_raw( $hero_page_link_2 ); ?>">
						<?php echo nbs_field_helpers()->fields->get_meta_field( 'hero_page_link_2_text' ); ?>
                    </a>
				<?php endif; ?>

            </div>
        </div>

        <span class="honeycomb-overlay honeycomb-overlay-1 overlay-a"></span>
        <span class="honeycomb-overlay honeycomb-overlay-2 overlay-b"></span>
        <span class="honeycomb-overlay honeycomb-overlay-1 overlay-c"></span>
    </header>

<?php $categories = get_terms( array(
	'taxonomy'   => 'product_cat',
	'hide_empty' => false,
	'parent'     => 0,
	'exclude'    => array( 107 )
) ); ?>
<?php if ( $categories ) : ?>
    <section class="product-categories">
        <div class="hexagon-grid">
			<?php foreach ( $categories as $category ) : ?>
				<?php
				$thumbnail_ID   = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );
				$category_image = wp_get_attachment_image_url( $thumbnail_ID, 'medium' );
				?>
                <div class="hexagon-item-container">
                    <div class="product-category hexagon">
                        <a href="<?php echo get_term_link( $category ); ?>" class="hexagon-background"
                           style="background-image: url('<?php echo esc_attr( $category_image ); ?>');"></a>
                        <p class="hexagon-text"><?php echo $category->name; ?></p>
                    </div>
                </div>
			<?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>

<?php
$featured_products   = get_posts( array(
	'post_type'   => 'product',
	'numberposts' => 1,
	'meta_key'    => 'nbs_featured_status',
	'meta_value'  => 'featured',
) );
$featured_product_ID = false;

if ( $featured_products ) {

	$featured_product_ID = $featured_products[0]->ID;
}
?>

<?php if ( $featured_product_ID ) : ?>
    <section class="featured-product">
		<?php
		$featured_product  = wc_get_product( $featured_product_ID );
		$featured_image_ID = nbs_field_helpers()->fields->get_field( 'featured_image', $featured_product_ID );
		$featured_image    = wp_get_attachment_image_url( $featured_image_ID, 'large' );

		if ( $featured_image ) : ?>
            <div class="featured-product-featured-image"
                 style="background-image: url('<?php echo esc_attr( $featured_image ); ?>');">
                <span class="honeycomb-overlay honeycomb-overlay-2"></span>
            </div>
		<?php endif; ?>

        <article class="featured-product-product">
            <div class="featured-product-container">
                <div class="featured-product-image">
                    <div class="featured-product-image-container hexagon hexagon-no-cover">
						<?php echo $featured_product->get_image(); ?>
                    </div>
                </div>

                <div class="featured-product-content">
                    <h1 class="featured-product-title">
                        <a href="<?php echo $featured_product->get_permalink(); ?>">
                            Featured: <?php echo $featured_product->get_title(); ?>
                        </a>
                    </h1>

                    <p class="featured-product-price">
						<?php echo $featured_product->get_price_html(); ?>
                    </p>

                    <div class="featured-product-excerpt">
						<?php echo $featured_product->get_short_description(); ?>
                    </div>

                    <?php
                    
                        global $product;

                        $product = $featured_product;

                        woocommerce_template_loop_add_to_cart();

                    ?>

                </div>
            </div>
        </article>
    </section>
<?php endif; ?>

<?php 

$promotions = nbs_field_helpers()->fields->get_meta_field( 'promotions' );

if ( $promotions && is_array( $promotions ) ) : 

    foreach ( $promotions as $index => $promotion ) : ?> 

        <section class="promotions grid-container">

            <div class="grid-x grid-margin-x">

                <div class="cell small-12 large-4<?php echo ( ( ( $index + 1 ) % 2 == 0 ) ? ' large-order-2' : '' ); ?>">

                    <h2><?php echo esc_html( $promotion['title'] ); ?></h2>

                    <?php echo apply_filters( 'the_content', $promotion['content'] ); ?>

                </div>

                <div class="cell small-12 large-8<?php echo ( ( ( $index + 1 ) % 2 == 0 ) ? ' large-order-1' : '' ); ?>">

                    <div class="subfeatured-products">

                        <?php

                            if ( $promotion['category'] ) {

                                $products_in_category_query = new WP_Query( array(
                                    'posts_per_page' => 3,
                                    'post_type' => 'product',
                                    'fields' => 'ids',
                                    'tax_query' => array(
                                        'relation' => 'AND',
                                        array(
                                            'taxonomy' => 'product_cat',
                                            'field' => 'term_id',
                                            'terms' => $promotion['category'],
                                        ),
                                    )
                                ) );

                                $products_in_category_shortcode = new WC_Shortcode_Products( array(
                                    'limit' => count( $products_in_category_query->posts ),
                                    'columns' => count( $products_in_category_query->posts ),
                                    'ids' => implode( ',', $products_in_category_query->posts ),
                                    'orderby' => 'notrealorderby', // Prevents WooCommerce from providing a default orderby. WP will fallback to something sane instead
                                    'order' => 'DESC', // WooCommerce defaults this to ASC for some reason. WP uses DESC
                                    'suppress_filters' => true,
                                ) );

                                $products_in_category = $products_in_category_shortcode->get_content();

                                if ( $products_in_category_query->have_posts() && $products_in_category ) {

                                    echo $products_in_category;

                                }

                            }

                        ?>

                    </div>

                </div>
                
            </div>

        </section>

    <?php endforeach;

endif;

?>

<?php

// If you pass "on_sale" to WooCommerce's shortcode function and there are no On Sale products, it shows latest products instead. So we'll grab them ourselves
$sale_products = wc_get_product_ids_on_sale();

$on_sale_product_query = new WC_Shortcode_Products( array(
    'limit' => count( $sale_products ),
    'columns' => count( $sale_products ),
    'orderby' => 'date',
    'order' => 'DESC',
    'orderby' => 'notrealorderby', // Prevents WooCommerce from providing a default orderby. WP will fallback to something sane instead
    'order' => 'DESC', // WooCommerce defaults this to ASC for some reason. WP uses DESC
    'ids' => implode( ',', $sale_products ),
) );

$on_sale = $on_sale_product_query->get_content();

if ( $sale_products && $on_sale ) : ?>

    <section class="subfeatured-products">

        <h2><?php _e( 'On Sale', 'napoleonbeesupply-theme-2017' ); ?></h2>

        <?php echo $on_sale; ?>

    </section>

<?php endif; ?>

<?php

$new_product_query = new WC_Shortcode_Products( array(
    'limit' => 4,
    'columns' => 4,
    'orderby' => 'date',
    'order' => 'DESC',
) );

$new_products = $new_product_query->get_content();

if ( $new_products ) : ?>

    <section class="subfeatured-products">

        <h2><?php _e( 'New Items', 'napoleonbeesupply-theme-2017' ); ?></h2>

        <?php echo $new_products; ?>

    </section>

<?php endif; ?>

<?php
get_footer();