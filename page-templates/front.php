<?php
/*
Template Name: Front
*/
get_header();
?>

    <header class="front-hero" role="banner"
		<?php echo nbs_get_featured_interchange( get_post_thumbnail_id( $post->ID ) ); ?>>
        <div class="marketing">
            <div class="tagline">
                <h1 class="header"><?php the_title(); ?></h1>
                <h4 class="subheader"><?php echo nbs_field_helpers()->fields->get_meta_field( 'subhead' ); ?></h4>

				<?php $hero_page_link_ID = nbs_field_helpers()->fields->get_meta_field( 'hero_page_link' ); ?>
				<?php if ( $hero_page_link_ID ) : ?>
                    <a role="button" class="large button hide-for-small-only"
                       href="<?php echo get_permalink( $hero_page_link_ID ); ?>">
						<?php echo nbs_field_helpers()->fields->get_meta_field( 'hero_page_link_text' ); ?>
                    </a>
				<?php endif; ?>
            </div>
        </div>

        <span class="honeycomb-overlay honeycomb-overlay-1 overlay-a"></span>
        <span class="honeycomb-overlay honeycomb-overlay-2 overlay-b"></span>
        <span class="honeycomb-overlay honeycomb-overlay-1 overlay-c"></span>
    </header>

<?php $categories = get_terms( array( 'taxonomy' => 'product_cat', 'hide_empty' => false ) ); ?>
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
$featured_product_IDs = wc_get_featured_product_ids();
$featured_product_ID  = false;

if ( $featured_product_IDs ) {

	$featured_product_ID = array_shift( $featured_product_IDs );
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
get_footer();