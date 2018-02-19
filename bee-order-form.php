<?php
/**
 * Shows the Bee order form.
 */

get_header(); ?>

<?php get_template_part( 'template-parts/featured-image' ); ?>

    <div class="main-wrap full-width">
        <main class="main-content">

            <div class="woocommerce-archive-header">
                <div class="woocommerce-archive-header-container">
                    <h1 class="page-title">
                        Bee Order Form
                    </h1>
                </div>
            </div>

            <div class="row">
                <div class="columns small-12">
                    <table id="nbs-bee-order-form">
                        <tr>
                            <th>Item</th>
                            <th>1-25</th>
                            <th>26-50</th>
                            <th>51-99</th>
                            <th>100+</th>
                            <th>Quantity</th>
                            <th></th>
                        </tr>

						<?php while ( have_posts() ) : ?>
							<?php the_post(); ?>

							<?php
							$pricing_data   = false;
							$pricing_enable = get_post_meta( get_the_ID(), '_as_quantity_range_pricing_enable', true );

							if ( $pricing_enable === 'on' ) {

								$pricing      = get_post_meta( get_the_ID(), '_as_quantity_range_pricing_values', true );
								$pricing_data = wp_list_pluck( $pricing, 'price', 'min_qty' );
							}
							?>

                            <tr>
                                <td>
									<?php the_title(); ?>
                                </td>

								<?php
								$quantities = array( 1, 26, 51, 100 );

								foreach ( $quantities as $quantity ) :
									?>
                                    <td>
										<?php
										if ( $pricing_data ) {

											echo wc_price( $pricing_data[$quantity] );

										} else {

											wc_get_template( 'loop/price.php' );
										}
										?>
                                    </td>

								<?php endforeach; ?>
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