<?php
/**
 * Recipient customer new account email
 *
 * @author James Allan
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php do_action( 'woocommerce_email_header', $email_heading ); ?>

<p><?php printf( esc_html__( 'Hi there,', 'woocommerce-subscriptions-gifting' ) ); ?></p>
<p><?php printf( esc_html__( '%s just purchased ' .  _n( 'a subscription', 'subscriptions', count( $subscriptions ), 'woocommerce-subscriptions-gifting' ) . ' for you at %s.', 'woocommerce-subscriptions-gifting' ), esc_html( $subscription_purchaser ), esc_html( $blogname ) ); ?></p>

<p><?php printf( esc_html__( 'The order has been received and is being processed. Details of the ' . _n( 'subscription', 'subscriptions', count( $subscriptions ), 'woocommerce-subscriptions-gifting' ) . ' are shown below:', 'woocommerce-subscriptions-gifting' ) ); ?></p>

<?php
	foreach ( $subscriptions as $subscription_id ) {
		$subscription = wcs_get_subscription( $subscription_id );
		$items        = $subscription->get_items();
		$total        = $subscription->get_formatted_order_total();
		echo '<h3>' . sprintf( __( 'Subscription #%s', 'woocommerce-subscriptions-gifting' ), $subscription_id ) . '</h3>';?>
		<table cellspacing="0" cellpadding="6" style="width: 100%; border: 1px solid #eee;" border="1" bordercolor="#eee">
			<thead>
				<tr>
					<th scope="col" style="text-align:left; border: 1px solid #eee;"><?php esc_html_e( 'Product', 'woocommerce-subscriptions-gifting' ); ?></th>
					<th scope="col" style="text-align:left; border: 1px solid #eee;"><?php esc_html_e( 'Quantity', 'woocommerce-subscriptions-gifting' ); ?></th>
					<th scope="col" style="text-align:left; border: 1px solid #eee;"><?php esc_html_e( 'Total', 'woocommerce-subscriptions-gifting' ); ?></th>
				</tr>
			</thead>
			<tbody><?php
		foreach ( $items as $item ) {
			echo '<tr><td style="text-align:left; vertical-align:middle; border: 1px solid #eee; word-wrap:break-word;">' . sprintf( '<a href="%s">%s</a>', get_permalink( $item['product_id'] ), $item['name'] ) . '</td>';
			echo '<td style="text-align:left; vertical-align:middle; border: 1px solid #eee; word-wrap:break-word;">' . $item['item_meta']['_qty'][0] . '</td>';
			echo '<td style="text-align:left; vertical-align:middle; border: 1px solid #eee; word-wrap:break-word;">' . WC_Subscriptions_Product::get_price_string( $item['product_id'], array( 'price' => wc_price( $item['line_subtotal'] ) ) ) . '</td></tr>';
		} ?>
			<tr>
				<th scope="row" colspan="2" style="border: 1px solid #eee;"><?php echo esc_html( 'Total' ); ?></th>
				<td class="product-total" style="border: 1px solid #eee;"><?php echo '<b>' . $total . '</b>'; ?></td>
			</tr>
			</tbody>
		</table><?php
		}
?>

<p><?php printf( esc_html__( 'You may access your account area to view your new ' . _n( 'subscription', 'subscriptions', count( $subscriptions ), 'woocommerce-subscriptions-gifting' ) . ' here: %s.', 'woocommerce-subscriptions-gifting' ), wc_get_page_permalink( 'myaccount' ) ); ?></p>

<?php do_action( 'woocommerce_email_footer' ); ?>
