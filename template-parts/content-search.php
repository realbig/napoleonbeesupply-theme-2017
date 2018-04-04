<?php
/**
 * The template for displaying content in search
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header>
        <?php $labels = get_post_type_labels( get_post_type_object( get_post_type() ) ); ?>
		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . "{$labels->singular_name}: ", '</a></h2>' ); ?>
    </header>

    <div class="entry-content">
		<?php the_excerpt(); ?>
		<?php edit_post_link( __( '(Edit)', 'foundationpress' ), '<span class="edit-link">', '</span>' ); ?>
    </div>
</article>
