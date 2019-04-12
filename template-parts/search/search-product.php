<?php
/**
 * The template for displaying content in search for Products
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

$product = wc_get_product( get_post() );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="image">
			<?php the_post_thumbnail( 'thumbnail' ); ?>
		</div>
	<?php endif; ?>

	<div class="content">
		<header>
			<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

			<?php echo $product->get_price_html(); ?>
		</header>

		<div class="entry-content">
			<?php the_excerpt(); ?>
			<?php edit_post_link( __( '(Edit)', 'napoleonbeesupply-theme-2017' ), '<span class="edit-link">', '</span>' ); ?>
		</div>
	</div>
</article>
