<?php
/**
 * Shows the Bee order form.
 */

get_header();

$featured  = get_term_meta( get_queried_object_id(), 'thumbnail_id', true );
$image_src = false;

if ( $featured ) {

	$image_src = wp_get_attachment_image_src( $featured, 'full' );
}
?>

<?php get_template_part( 'template-parts/featured-image' ); ?>

    <div class="main-wrap full-width nbs-bee-order-form">
        <main class="main-content">

            <div class="woocommerce-archive-header"
				<?php echo $image_src ? "style=\"background-image: url({$image_src[0]})\"" : ''; ?>
            >
                <div class="woocommerce-archive-header-container">
                    <h1 class="page-title">
                        Bee Order Form
                    </h1>

                    <?php woocommerce_taxonomy_archive_description(); ?>
                </div>
            </div>

            <div class="row">
                <div class="columns small-12">
                    <table id="nbs-bee-order-form">
                        <tr>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th></th>
                        </tr>

						<?php while ( have_posts() ) : ?>
							<?php the_post(); ?>

                            <tr>
                                <td>
									<?php the_title(); ?>
                                </td>
                                
                                <td>
                                    <?php wc_get_template( 'loop/price.php' ); ?>
                                </td>
                                
                                <td>
                                    <input type="number" name="nbs_bee_order_quantity_<?php the_ID(); ?>"
                                           class="nbs-bee-order-form-qty" value="1"
                                           data-product="<?php the_ID(); ?>"
                                    />
                                </td>

                                <td>
									<?php woocommerce_template_loop_add_to_cart(); ?>
                                </td>
                            </tr>

						<?php endwhile; ?>
                    </table>
                </div>
            </div>
        </main>
    </div>
<?php get_footer();