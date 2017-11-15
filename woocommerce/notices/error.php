<?php
/**
 * Show error messages
 *
 * @since {{VERSION}}
 */

defined( 'ABSPATH' ) || die();

if ( ! $messages ) {
	return;
}

?>
<div class="woocommerce-error">
    <ul class="woocommerce-notice-content">
		<?php foreach ( $messages as $message ) : ?>
            <li><?php echo wp_kses_post( $message ); ?></li>
		<?php endforeach; ?>
    </ul>
</div>