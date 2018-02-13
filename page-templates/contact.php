<?php
/**
 * Template Name: Contact
 *
 * The template for displaying contact page
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

 get_header(); ?>

 <?php get_template_part( 'template-parts/featured-image' ); ?>

 <div class="main-wrap full-width">
	 <main class="main-content">
		 <?php while ( have_posts() ) : the_post(); ?>
		 	<?php get_template_part( 'template-parts/content', 'contact' ); ?>
		 <?php endwhile;?>
	 </main>
 </div>
 <?php get_footer();
