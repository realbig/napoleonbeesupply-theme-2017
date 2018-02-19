<?php
/**
 * Adds extra meta to Bees category.
 *
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || die();

add_action( 'product_cat_add_form_fields', 'nbs_product_cat_add_meta_fields', 10 );
add_action( 'product_cat_edit_form_fields', 'nbs_product_cat_edit_meta_fields', 10 );
add_action( 'edited_product_cat', 'nbs_product_cat_save_meta_fields', 10 );
add_action( 'create_product_cat', 'nbs_product_cat_save_meta_fields', 10 );

function nbs_product_cat_add_meta_fields() {

	nbs_product_cat_meta_fields();
}

function nbs_product_cat_edit_meta_fields( $term ) {

	nbs_product_cat_meta_fields( $term->term_id );
}

function nbs_product_cat_meta_fields( $term_ID = false ) {

	wp_nonce_field( 'nbs_bee_category_nonce_save_term_meta', 'nbs_bee_category_nonce' );
	?>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="_nbs_bees_category">
                Use Bee Order Form
				<?php echo nbs_fieldhelpers_get_field_tip( 'If enabled, this category page will show the Bee Order Form' ); ?>
            </label>
        </th>
        <td>
			<?php
			nbs_field_helpers()->fields->do_field_toggle( 'bees_category', array(
				'value' => get_term_meta( $term_ID, 'nbs_bees_category', true ),
			) );
			?>
        </td>
    </tr>
	<?php
}

function nbs_product_cat_save_meta_fields( $term_id ) {

	if ( ! isset( $_POST['nbs_bee_category_nonce'] ) ||
	     ! wp_verify_nonce( $_POST['nbs_bee_category_nonce'], 'nbs_bee_category_nonce_save_term_meta' )
	) {

		return;
	}

	if ( isset( $_POST['nbs_bees_category'] ) ) {

		update_term_meta( $term_id, 'nbs_bees_category', $_POST['nbs_bees_category'] );

	} else {

		delete_term_meta( $term_id, 'nbs_bees_category' );
	}
}