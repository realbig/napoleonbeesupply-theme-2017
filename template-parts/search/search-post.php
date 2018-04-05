<?php
/**
 * The template for displaying content in search for Posts
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
        <header>
			<?php if ( has_post_thumbnail() ) : ?>

                <div class="featured-hero" <?php echo nbs_get_featured_interchange( get_post_thumbnail_id() ); ?>>
                    <div class="featured-hero-content">
						<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
						<?php foundationpress_entry_meta(); ?>
                    </div>
                </div>

			<?php else: ?>

				<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
				<?php foundationpress_entry_meta(); ?>

			<?php endif; ?>
        </header>
	<?php endif; ?>

    <div class="entry-content">
		<?php the_excerpt(); ?>
		<?php edit_post_link( __( '(Edit)', 'foundationpress' ), '<span class="edit-link">', '</span>' ); ?>
    </div>

    <footer>
		<?php $tag = get_the_tags();
		if ( $tag ) { ?><p><?php the_tags(); ?></p><?php } ?>
    </footer>
</article>
