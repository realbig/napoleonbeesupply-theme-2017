<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "off-canvas-wrap" div and all content after.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

// TODO Social links
?>

</div><!-- Close container -->
<div class="footer-container">
    <span class="honeycomb-overlay honeycomb-overlay-2"></span>
    <footer class="footer">
        <section class="footer-left">
	        <?php if ( has_custom_logo() ) : ?>
		        <?php the_custom_logo(); ?>
	        <?php else: ?>
		        <?php bloginfo( 'name' ); ?>
	        <?php endif; ?>

            <p class="footer-social">
                <span class="footer-social-icon fa fa-facebook-square"></span>
                <span class="footer-social-icon fa fa-twitter-square"></span>
            </p>

            <p class="footer-meta">
                Copyright 2017, Napoleon Bee Supply, LLC<br/>
                Built by <a href="https://realbigmarketing.com" class="footer-rbm-link">Real Big Marketing</a>
            </p>
        </section>

		<?php dynamic_sidebar( 'footer-widgets' ); ?>
    </footer>
</div>

</div><!-- Close off-canvas content -->

<?php wp_footer(); ?>
</body>
</html>
