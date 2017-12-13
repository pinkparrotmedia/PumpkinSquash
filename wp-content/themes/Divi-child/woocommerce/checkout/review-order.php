<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>



<div class="checkout-login-div" style="margin:0px auto">

	<table  class="payment-products" style="border:none !important">
		<thead>
			<tr>
				<th class="product-name"><?php _e( 'Product', 'woocommerce' ); ?></th>
				<th class="product-total"><?php _e( 'Total', 'woocommerce' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php
				do_action( 'woocommerce_review_order_before_cart_contents' );

				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
						?>
						<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
							<td class="product-name">
								<?php echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;'; ?>
								<?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf( '&times; %s', $cart_item['quantity'] ) . '</strong>', $cart_item, $cart_item_key ); ?>
								<?php echo WC()->cart->get_item_data( $cart_item ); ?>
							</td>
							<td class="product-total">
								<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
							</td>
						</tr>
						<?php
					}
				}

				do_action( 'woocommerce_review_order_after_cart_contents' );
			?>
		</tbody>

		<?php /*
		<tfoot>

			<tr class="cart-subtotal">
				<th><?php _e( 'Subtotal', 'woocommerce' ); ?></th>
				<td><?php wc_cart_totals_subtotal_html(); ?></td>
			</tr>

			<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
				<tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
					<th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
					<td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
				</tr>
			<?php endforeach; ?>

			<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

				<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

				<?php wc_cart_totals_shipping_html(); ?>

				<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

			<?php endif; ?>

			<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
				<tr class="fee">
					<th><?php echo esc_html( $fee->name ); ?></th>
					<td><?php wc_cart_totals_fee_html( $fee ); ?></td>
				</tr>
			<?php endforeach; ?>

			<?php if ( wc_tax_enabled() && 'excl' === WC()->cart->tax_display_cart ) : ?>
				<?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
					<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
						<tr class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
							<th><?php echo esc_html( $tax->label ); ?></th>
							<td><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
						</tr>
					<?php endforeach; ?>
				<?php else : ?>
					<tr class="tax-total">
						<th><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
						<td><?php wc_cart_totals_taxes_total_html(); ?></td>
					</tr>
				<?php endif; ?>
			<?php endif; ?>

			<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

			<tr class="order-total">
				<th><?php _e( 'Total', 'woocommerce' ); ?></th>
				<td><?php wc_cart_totals_order_total_html(); ?></td>
			</tr>

			<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

		</tfoot>
		*/ ?>
	</table>

	<table class="tbl-payment-types">
		<tr style="border-bottom: 1px solid #e6e6e6 !important; padding-bottom:22px !important;">
			<td class="payment-select" style="padding-top:26px !important;padding-right:10px !Important;"><label class="custom-radio "><input type="checkbox" class="" /></label></td>
			<td style=" padding-bottom:22px !important; padding-top:25px !important;">
				<h2>Direct Bank Transfer</h2>
				Lorem ipsum dolor sit amet, consectetur 
adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco 
			</td>
		</tr>

		<tr style="border-bottom: 1px solid #e6e6e6 !important; padding-bottom:22px !important;">
			<td class="payment-select" style="padding-top:26px !important;padding-right:10px !Important;"><label class=" custom-radio"><input type="checkbox" class="" /></label></td>
			<td style=" padding-bottom:22px !important; padding-top:25px !important;"><h2>Cheque Payments</h2></td>
		</tr>

		<tr style="border-bottom: 1px solid #e6e6e6 !important; padding-bottom:22px !important;">
			<td class="payment-select" style="padding-top:26px !important;padding-right:10px !Important;"><label class=" custom-radio"><input type="checkbox" class="" /></label></td>
			<td style=" padding-bottom:22px !important; padding-top:25px !important;"><h2>Cash On Delivery</h2></td>
		</tr>
		<tr >
			<td colspan="2" style=" padding-bottom:63px !important; padding-top:25px !important;">

				<div style="float:left; width:33%;position:relative;text-align:center">
					<label style="position:absolute;left: 0;top: 18px;" class=" custom-radio"><input type="checkbox" class=""></label> 
					<img src="/wp-content/themes/Divi-child/images/mastercard.jpg" style="
					    width: 75px;
					  
					">
				</div>
				<div style="float:left; width:33%;position:relative;text-align:center">
					<label style="position:absolute;left: -9px;top: 18px;" class=" custom-radio"><input type="checkbox" class=""></label> 
					<img src="/wp-content/themes/Divi-child/images/paypal.jpg" style="width: 80px;margin-top: 8px;margin-right: -6px;">
				</div>
				<div style="float:left; width:33%;position:relative;text-align:center">
					<label style="position:absolute;left: -4px;top: 18px;" class=" custom-radio"><input type="checkbox" class=""></label> 
					<img src="/wp-content/themes/Divi-child/images/amex.jpg" style="width: 75px;margin-top: 4px;">
				</div>
			</td>
		</tr>
	</table>

</div>


<div style="border-top:1px solid #ddd; padding-top:20px; margin-top:40px; text-align:center">
	<a type="button" class="btn-dark" style="cursor:pointer;display:inline-block">Previous</a>
	<button type="button" class="btn-green" onclick="jQuery('#place_order').trigger('click');" style="cursor:pointer;display:inline-block">Place Order</button>
</div>