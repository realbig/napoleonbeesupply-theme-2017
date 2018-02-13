<?php
/**
 * The default template for Contact.
 *
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <section class="contact-upper">
        <div class="contact-container">
            <header>
                <h1 class="entry-title"><?php the_title(); ?></h1>
            </header>
            <div class="entry-content">
				<?php the_content(); ?>
            </div>
        </div>

	    <?php
	    $map_image = nbs_field_helpers()->fields->get_field( 'map_image' );
	    $map_link  = nbs_field_helpers()->fields->get_field( 'map_link' );
	    ?>

	    <?php if ( $map_image && $map_link ): ?>
            <div class="contact-map">
                <a href="<?php echo esc_url_raw( $map_link ); ?>" target="_blank">
				    <?php echo wp_get_attachment_image( $map_image, 'full' ); ?>
                    <span class="contact-map-text">
                        Click to view map and directions
                    </span>
                </a>
            </div>
	    <?php endif; ?>
    </section>

    <section class="contact-lower">
        <div class="contact-container-left">
			<?php
			$form_ID = nbs_field_helpers()->fields->get_field( 'ninjaformid' );

			if ( $form_ID ) {

				ninja_forms_display_form( $form_ID );
			}
			?>
        </div>

        <div class="contact-container-right">
			<?php
			$address = nbs_field_helpers()->fields->get_field( 'address' );

			if ( $address ) {

				echo do_shortcode( wpautop( $address ) );
			}
			?>
        </div>
    </section>
</article>