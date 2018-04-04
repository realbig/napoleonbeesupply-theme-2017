<?php
/**
 * Register Menus
 *
 * @link http://codex.wordpress.org/Function_Reference/register_nav_menus#Examples
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

register_nav_menus( array(
	'top-bar-r'  => esc_html__( 'Right Top Bar', 'foundationpress' ),
	'mobile-nav' => esc_html__( 'Mobile', 'foundationpress' ),
) );


/**
 * Desktop navigation - right top bar
 *
 * @link http://codex.wordpress.org/Function_Reference/wp_nav_menu
 */
if ( ! function_exists( 'foundationpress_top_bar_r' ) ) {
	function foundationpress_top_bar_r() {

		$cart_count = WC()->cart->get_cart_contents_count();

		$search = "<li id=\"menu-item-search\" class=\"menu-item menu-item-search\"><a href=\"#\" data-search-toggle><span class=\"fa fa-search\"</a></li>";
		?>

        <div class="nav-catalog">
            <a href="#" data-toggle="off-canvas-menu">
                Shop
            </a>
        </div>

        <div class="nav-container">
            <div class="top-nav">

                <div class="site-search">
                    <?php get_search_form(); ?>
                </div>

                <a href="https://www.facebook.com/napoleonbeesupply/" aria-label="Facebook" target="_blank" title="Facebook" class="nav-icon facebook-link">
                    <span class="footer-social-icon fa fa-facebook"></span>
                </a>

                <a href="<?php echo wp_login_url(); ?>" class="wp-login nav-icon" aria-label="Log In" title="Log In">
                    <span class="fa fa-user"></span>
                </a>

                <a href="<?php echo wc_get_cart_url(); ?>" class="woocommerce-cart nav-icon" aria-label="Shopping Cart"
                   title="Shopping Cart">
                    <span class="fa fa-shopping-cart"></span>
                    &nbsp;&nbsp;$<?php echo WC()->cart->cart_contents_total; ?>
                </a>
            </div>

            <div class="bottom-nav">
				<?php wp_nav_menu( array(
					'container'      => false,
					'menu_class'     => 'dropdown menu',
					'items_wrap'     => "<ul id=\"%1\$s\" class=\"%2\$s desktop-menu\" data-dropdown-menu>%3\$s</ul>",
					'theme_location' => 'top-bar-r',
					'depth'          => 3,
					'fallback_cb'    => false,
					'walker'         => new Foundationpress_Top_Bar_Walker(),
				) ); ?>
            </div>
        </div>
		<?php
	}
}


/**
 * Mobile navigation - topbar (default) or offcanvas
 */
if ( ! function_exists( 'foundationpress_mobile_nav' ) ) {
	function foundationpress_mobile_nav() {
		wp_nav_menu( array(
			'container'      => false, // Remove nav container
			'menu'           => __( 'mobile-nav', 'foundationpress' ),
			'menu_class'     => 'vertical menu',
			'theme_location' => 'mobile-nav',
			'before'         => '<div class="hexagon hexagon-no-cover"><div class="hexagon-background"></div>',
			'after'          => '</div>',
			'link_before'    => '<div class="hexagon-text">',
			'link_after'     => '</div>',
			'items_wrap'     => '<ul id="%1$s" class="%2$s" data-accordion-menu data-submenu-toggle="true">%3$s</ul>',
			'fallback_cb'    => false,
			'walker'         => new Foundationpress_Mobile_Walker(),
		) );
	}
}


/**
 * Add support for buttons in the top-bar menu:
 * 1) In WordPress admin, go to Apperance -> Menus.
 * 2) Click 'Screen Options' from the top panel and enable 'CSS CLasses' and 'Link Relationship (XFN)'
 * 3) On your menu item, type 'has-form' in the CSS-classes field. Type 'button' in the XFN field
 * 4) Save Menu. Your menu item will now appear as a button in your top-menu
 */
if ( ! function_exists( 'foundationpress_add_menuclass' ) ) {
	function foundationpress_add_menuclass( $ulclass ) {
		$find    = array( '/<a rel="button"/', '/<a title=".*?" rel="button"/' );
		$replace = array( '<a rel="button" class="button"', '<a rel="button" class="button"' );

		return preg_replace( $find, $replace, $ulclass, 1 );
	}

	add_filter( 'wp_nav_menu', 'foundationpress_add_menuclass' );
}
