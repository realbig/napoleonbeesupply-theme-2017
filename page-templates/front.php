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
?>

    <header class="front-hero" role="banner"
		<?php echo nbs_get_featured_interchange( get_post_thumbnail_id( $post->ID ) ); ?>>
        <div class="marketing">
            <div class="tagline">
                <h1 class="header"><?php the_title(); ?></h1>
                <h4 class="subheader"><?php echo nbs_field_helpers()->fields->get_meta_field( 'subhead' ); ?></h4>

				<?php if ( $hero_page_link ) : ?>
                    <a role="button" class="large button hide-for-small-only"
                       href="<?php echo esc_url_raw( $hero_page_link ); ?>">
						<?php echo nbs_field_helpers()->fields->get_meta_field( 'hero_page_link_text' ); ?>
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
				$category_image = wp_get_attachment_url( $thumbnail_ID );
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
		$featured_image    = wp_get_attachment_image_url( $featured_image_ID, 'full' );

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
                        Featured: <?php echo $featured_product->get_title(); ?>
                    </h1>

                    <p class="featured-product-price">
						<?php echo $featured_product->get_price_html(); ?>
                    </p>

                    <div class="featured-product-excerpt">
						<?php echo $featured_product->get_short_description(); ?>
                    </div>

                    <a href="<?php echo $featured_product->get_permalink(); ?>" class="button large tertiary">
                        View Product
                    </a>
                </div>
            </div>
        </article>
    </section>
<?php endif; ?>

<?php
$subfeatured_products = get_posts( array(
	'post_type'   => 'product',
	'numberposts' => 4,
	'meta_key'    => 'nbs_featured_status',
	'meta_value'  => 'sub_featured',
) );
?>

<?php if ( $subfeatured_products ): ?>
    <section class="subfeatured-products subfeatured-products-count-<?php echo count( $subfeatured_products ); ?>">

		<?php foreach ( $subfeatured_products as $product ) : ?>

			<?php $product = wc_get_product( $product ); ?>

            <article class="subfeatured-product">
                <div class="featured-product-image">
                    <div class="featured-product-image-container hexagon hexagon-no-cover">
						<?php echo $product->get_image(); ?>
                    </div>

                    <h1 class="featured-product-title">
						<?php echo $product->get_title(); ?>
                    </h1>

                    <p class="featured-product-price">
						<?php echo $product->get_price_html(); ?>
                    </p>

                    <div class="featured-product-excerpt">
						<?php echo $product->get_short_description(); ?>
                    </div>

                    <a href="<?php echo $product->get_permalink(); ?>" class="button primary">
                        View Product
                    </a>
                </div>
            </article>
		<?php endforeach; ?>

    </section>
<?php endif; ?>

<?php
get_footer();