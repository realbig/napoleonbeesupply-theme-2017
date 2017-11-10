<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "container" div.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php get_template_part( 'template-parts/off-canvas-menu' ); ?>

<div class="off-canvas-content" data-off-canvas-content>

    <header class="site-header" role="banner">
        <div class="site-title-bar title-bar" <?php foundationpress_title_bar_responsive_toggle() ?>>
            <div class="title-bar-left">
                <span class="site-mobile-title title-bar-title">
                    <?php if ( has_custom_logo() ) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else: ?>
                        <?php bloginfo( 'name' ); ?>
                    <?php endif; ?>
                </span>

                <button class="menu-icon" type="button"
                        data-toggle="off-canvas-menu"></button>
            </div>
        </div>

        <nav class="site-navigation top-bar" role="navigation">
            <div class="top-bar-left">
                <div class="site-desktop-title top-bar-title">
					<?php if ( has_custom_logo() ) : ?>
						<?php the_custom_logo(); ?>
					<?php else: ?>
						<?php bloginfo( 'name' ); ?>
					<?php endif; ?>
                </div>
            </div>
            <div class="top-bar-right">
				<?php foundationpress_top_bar_r(); ?>

				<?php if ( ! get_theme_mod( 'wpt_mobile_menu_layout' ) || get_theme_mod( 'wpt_mobile_menu_layout' ) === 'topbar' ) : ?>
					<?php get_template_part( 'template-parts/mobile-top-bar' ); ?>
				<?php endif; ?>
            </div>
        </nav>

    </header>

    <div class="container">
