<?php
// If a featured image is set, insert into layout and use Interchange
// to select the optimal image size per named media query.
if ( has_post_thumbnail( $post->ID ) ) : ?>
    <header class="featured-hero" role="banner"
		<?php echo nbs_get_featured_interchange( get_post_thumbnail_id( $post->ID ) ); ?>>
    </header>
<?php endif;
