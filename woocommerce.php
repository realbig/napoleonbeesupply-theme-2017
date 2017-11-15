<?php
/**
 * Basic WooCommerce support
 * For an alternative integration method see WC docs
 * http://docs.woothemes.com/document/third-party-custom-theme-compatibility/
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

<div class="main-wrap full-width">
	<main class="main-content">
		<?php woocommerce_content(); ?>
	</main>
</div>
<?php get_footer();
