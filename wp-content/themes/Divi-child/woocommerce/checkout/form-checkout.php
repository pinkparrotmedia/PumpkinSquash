<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
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

#wc_print_notices();

#do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
	return;
}

 
?>
<style type="text/css">

</style>


<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>


<div class="woocomerce-error-container"></div>


<div class="checkout-tabs-container">

	<div class="tab-menu">

		<div class="tab active" ><a data-target="#tab-login" href="">Login</a></div>
		<div class="tab"><a data-target="#tab-coupon" href="" >Coupon</a></div>
		<div class="tab" ><a id="a-billing-shipping" data-target="#tab-billing-shipping" href="">Billing & Shipping</a></div>
		<div class="tab"><a id="a-order-payment" href="" data-target="#tab-order-payment">Order & Payment</a></div>

	</div> <!-- .tab-menu -->
	<div class="tab-contents-container">

		<div class="tab-content" id="tab-login">
				<form class=" " method="post" style="">

					<div style="max-width:850px; margin:auto; margin-top:80px; margin-bottom:70px;">
						Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
					</div>

					<?php 
					$uid = get_current_user_id();
					if(empty($uid)):
					?>
					<div style="max-width:485px;margin:auto">
						<p class="form-row  ">
							<label for="username">Username or email  </label>
							<input type="text" class="input-text" name="username" id="username">
						</p>
						<p class="form-row  ">
							<label for="password">Password  </label>
							<input class="input-text" type="password" name="password" id="password">
						</p>
						<button type="button" class="btn btn-green " style="width:100%;margin-top:20px">Proceed to Checkout</button>
					</div>
					<?php 
					else:
					?>	
						<div style="max-width:485px;margin:auto">
								<button onclick="jQuery('#a-billing-shipping').trigger('click');" type="button" class="btn btn-green " style="width:100%;margin-top:20px">Proceed to Checkout</button>
						</div>
					<?php
					endif;
					?>

					<div class="clear"></div>

					
				</form>
		</div> <!-- tab-login-->

		<div class="tab-content" id="tab-coupon">
			<form class=" " method="post" style="display:block">

				<div style="margin-top:176px;width:660px;margin:auto; margin-top:170px;">
					<label style="display:block">Coupon</label>
					<input style="
					    width: 340px;
					    height: 61px;
					    margin-top: 0px;
					    float:left;
					    margin-right:15px;
					    padding-left:20px;
					" type="text" name="coupon_code" class="input-text" placeholder="Coupon code" id="coupon_code" value="">
			
					<input type="submit" class="btn-green" name="apply_coupon" value="Apply coupon">
				</div>

				<div class="clear"></div>
			</form>
		</div> <!-- .tab-coupon -->


		<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">


			<div class="tab-content" id="tab-billing-shipping" style="padding-top:100px;">


					<?php if ( $checkout->get_checkout_fields() ) : ?>

						<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

						<div class="col2-set" id="customer_details">
							<div class="col-1">
								<?php do_action( 'woocommerce_checkout_billing' ); ?>
							</div>

							<div class="col-2">
								<?php do_action( 'woocommerce_checkout_shipping' ); ?>
							</div>
						</div>

						<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

					<?php endif; ?>

					<div style="border-top:1px solid #e6e6e6; padding-top:40px; text-align:right; margin-top:90px;">
						<a style="cursor:pointer;" type="buton" onclick="jQuery('#a-order-payment').trigger('click');" class="btn-green ">Proceed to Orders & Payment</a>
					</div>
			</div> <!-- <div class="tab-content" id="tab-billing-shipping"> -->

			<div id="tab-order-payment" class="tab-content">
 
				<div id="order_review" class="woocommerce-checkout-review-order">
					<?php do_action( 'woocommerce_checkout_order_review' ); ?>
				</div>

				<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

			</div> <!-- #tab-order-payment -->

		</form> <!-- <form name="checkout"  -->

	</div> <!-- .tab-contents -->
</div> <!-- .checkout-tabs-container -->

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>


<script type="text/javascript">
	jQuery(document).ready(function($){
		setTimeout(function(){
			$(".checkout-tabs-container .tab-menu .tab").each(function(){
				if($(this).hasClass("active")){
					target = $(this).find("a").data("target");
					$(target).show();
				}
			});
		},300);

		$(".checkout-tabs-container .tab-menu .tab a").click(function( event ) {
			e = this;
	  		event.preventDefault();
	  		$(".checkout-tabs-container .tab-contents-container .tab-content").hide();

	  		$(".checkout-tabs-container .tab-menu .tab").removeClass("active");

	  		setTimeout(function(){
		  		target = $(e).data("target");
		  		$(e).parent().addClass("active");
				$(target).show();
			},300);

		});

		$('form.checkout.woocommerce-checkout').bind('DOMSubtreeModified',function(){
		if ($('ul.woocommerce-error').length) {
		    $('ul.woocommerce-error').insertAfter('.woocomerce-error-container')//where you want to place it
		}});

	});
</script>
