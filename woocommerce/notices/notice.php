<?php
/**
 * Show messages
 *
 * @since {{VERSION}}
 *
 * @var array $messages
 */

defined( 'ABSPATH' ) || die();

if ( ! $messages ) {
	return;
}

?>
<?php foreach ( $messages as $message ) : ?>
    <div class="woocommerce-info">
        <div class="woocommerce-notice-content">
			<?php echo wp_kses_post( $message ); ?>
        </div>
    </div>
<?php endforeach; ?>