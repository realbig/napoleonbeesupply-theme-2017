<?php
/**
 * Register widget areas
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

if ( ! function_exists( 'foundationpress_sidebar_widgets' ) ) :
function foundationpress_sidebar_widgets() {

	register_sidebar(array(
		'id' => 'shop-widgets',
		'name' => __( 'Shop widgets', 'napoleonbeesupply-theme-2017' ),
		'description' => __( 'Drag widgets to this sidebar container.', 'napoleonbeesupply-theme-2017' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h6 class="widget-title">',
		'after_title' => '</h6>',
	));

	register_sidebar(array(
		'id' => 'sidebar-widgets',
		'name' => __( 'Sidebar widgets', 'napoleonbeesupply-theme-2017' ),
		'description' => __( 'Drag widgets to this sidebar container.', 'napoleonbeesupply-theme-2017' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h6 class="widget-title">',
		'after_title' => '</h6>',
	));

	register_sidebar(array(
		'id' => 'footer-widgets',
		'name' => __( 'Footer widgets', 'napoleonbeesupply-theme-2017' ),
		'description' => __( 'Drag widgets to this footer container', 'napoleonbeesupply-theme-2017' ),
		'before_widget' => '<section id="%1$s" class="large-4 columns widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h6 class="widget-title">',
		'after_title' => '</h6>',
	));
}

add_action( 'widgets_init', 'foundationpress_sidebar_widgets' );
endif;
