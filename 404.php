<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

 <div class="main-wrap">
	<main class="main-content">
		<article>
			<header>
				<h1 class="entry-title"><?php _e( 'Page Not Found', 'napoleonbeesupply-theme-2017' ); ?></h1>
			</header>
			<div class="entry-content">
				<div class="error">
					<p class="bottom"><?php _e( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'napoleonbeesupply-theme-2017' ); ?></p>
				</div>
				<p><?php _e( 'Please try the following:', 'napoleonbeesupply-theme-2017' ); ?></p>
				<ul>
					<li><?php _e( 'Check your spelling', 'napoleonbeesupply-theme-2017' ); ?></li>
					<li>
						<?php
							/* translators: %s: home page url */
							printf( __(
								'Return to the <a href="%s">home page</a>', 'napoleonbeesupply-theme-2017' ),
								home_url()
							);
						?>
					</li>
					<li><?php _e( 'Click the <a href="javascript:history.back()">Back</a> button', 'napoleonbeesupply-theme-2017' ); ?></li>
				</ul>
			</div>
		</article>
	</main>
</div>

<?php get_footer();
