<?php
/**
 * Product import alterations (From WooCommerce Product Import Suite)
 *
 * @since {{VERSION}}
 */

defined( 'ABSPATH' ) || die();

add_action( 'woocommerce_csv_product_imported', 'nbs_product_import', 10, 3 );

/**
 * Additional import processes.
 *
 * @since {{VERSION}}
 *
 * @param $post
 * @param $processing_product_id
 * @param $importer
 */
function nbs_product_import( $post, $processing_product_id, $importer ) {

	$featured_image_path = get_template_directory() . "/library/product-import/images/{$post['sku']}.jpg";

	if ( file_exists( $featured_image_path ) ) {

		$attachment_ID = nbs_import_image( $featured_image_path );

		if ( $attachment_ID !== false ) {

			set_post_thumbnail( $processing_product_id, $attachment_ID );
		}
	}

	$images = glob( get_template_directory() . "/library/product-import/images/{$post['sku']}?.jpg" );

	if ( $images ) {

		$gallery = array();

		foreach ( $images as $file ) {

			$attachment_ID = nbs_import_image( $file );

			if ( $attachment_ID === false ) {

				continue;
			}

			$gallery[] = $attachment_ID;
		}

		if ( ! empty( $gallery ) ) {

			update_post_meta( $processing_product_id, '_product_image_gallery', implode( ',', $gallery ) );
		}
	}
}

/**
 * Imports a file.
 *
 * @since {{VERSION}}
 *
 * @param $filepath
 *
 * @return int|bool|WP_Error
 */
function nbs_import_image( $filepath ) {

	$filename    = basename( $filepath );
	$upload_file = wp_upload_bits( $filename, null, file_get_contents( $filepath ) );

	if ( ! $upload_file['error'] ) {

		$wp_filetype = wp_check_filetype( $filename, null );

		$attachment = array(
			'post_mime_type' => $wp_filetype['type'],
			'post_title'     => preg_replace( '/\.[^.]+$/', '', $filename ),
			'post_content'   => '',
			'post_status'    => 'inherit'
		);

		$attachment_id = wp_insert_attachment( $attachment, $upload_file['file'] );

		if ( ! is_wp_error( $attachment_id ) ) {

			require_once( ABSPATH . "wp-admin" . '/includes/image.php' );

			$attachment_data = wp_generate_attachment_metadata( $attachment_id, $upload_file['file'] );

			wp_update_attachment_metadata( $attachment_id, $attachment_data );
		}

	} else {

		return false;
	}

	return $attachment_id;
}