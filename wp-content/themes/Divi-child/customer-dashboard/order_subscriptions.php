<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<?php 
$user_id = get_current_user_id();
$user_meta = get_user_meta($user_id);

$customer_orders = get_posts( array(
    'numberposts' => -1,
    'meta_value'  => get_current_user_id(),
    'post_type'   => "shop_subscription",
    'post_status' => "active",
) );
$order_id   = $customer_orders[0]->ID;

$order_meta = get_post_meta($order_id);

$order = wc_get_order( $order_id );
$items = $order->get_items();

foreach ( $items as $item ) {
    $product_name = $item->get_name();
    $product_id   = $item->get_product_id();
   
    $post_data    = get_post($product_id);
   	$post_content = $post_data->post_content;
   	$short_description = $post_data->post_excerpt;


    $product_variation_id = $item->get_variation_id();
}


?>

<div class="order-subscription-main">
	<div class="tbl ">
		<div class="row hide-on-mobile">
			<div class="cell col1">
					&nbsp;
			</div>
			<div class="cell col2">
					<h3 style="text-align:center;margin-top:40px; margin-bottom:25px">Delivery on <?php echo date("l F d, Y",strtotime($order_meta["_schedule_next_payment"][0]));?></h3>
			</div>
			<div class="cell col3 radios-arrows">
					<div class="pull-left radios" style="margin-top:5px">
						<input type="radio" name="month_year"> Month
						<input type="radio" name="month_year" style="margin-left:20px"> Year
					</div>

					<div class="pull-left arrows" style="margin-left:50px;">
						<i class="fa fa-angle-left"></i>
						<i class="fa fa-angle-right"></i>
					</div>
			</div>
		</div>

		<div class="row order-subscription-section hide-on-mobile">
			<div class="cell col1">
				<h3>Delivery Note</h3>

				<div class="delivery-note-panel">
					<?php echo $user_meta["user_delivery_note"][0];?>
				</div>

				<table class="order-details-tbl">
					<tr>
						<td style="width:175px"><h3 style="font-size:20px">Order</h3></td>
						<td><?php echo $product_name;?></td>
					</tr>

					<tr>
						<td><h3 style="font-size:20px">Number</h3></td>
						<td>#<?php echo $order_id;?></td>
					</tr>

					<tr>
						<td><h3 style="font-size:20px">Subscription</h3></td>
						<td>Weekly</td>
					</tr>

					<tr>
						<td><h3 style="font-size:20px">Status</h3></td>
						<td>Paid</td>
					</tr>
					<tr><td></td><td></td></tr>
				</table>

				<button type="button" class="btn-green" style="width:100%;display:block;padding-right:20px;padding-left:20px;font-size:12px;">
					Invoice 
						<span style="padding:0px 20px;font-family: 'Montserrat', sans-serif; font-size: 16px;">#<?php echo $order_id;?></span> 
					<i class="fa fa-download"></i>
				</button>
			</div>
			<div class="cell col2 ">
				<div style="text-align:center; margin-top:60px">
					<img src="/wp-content/uploads/2017/09/large-product-image.png" style="max-width:255px;" />
				</div>
				<div style="text-align:center;margin-bottom:30px">
					<h3 style="margin-top:30px"><?php echo $product_name;?></h3>
					<div ><?php echo $short_description;?></div>
				</div>
				<!-- Start Bullets-->
				<div class="et_pb_row single-product-bullets" style="padding:0px;">
					<?php echo $post_content;?>
				</div>
				<!-- End Bullets-->

				<!-- Start Calendar-->
				<div style="border-top:1px solid #ebebeb; border-bottom:1px solid #ebebeb; padding-bottom:40px;margin-bottom:40px">

						<style type="text/css">
						.ui-datepicker-calendar{
							border: none !important
						}

						.ui-datepicker-inline{
							width: 100%;
							border: none;
						}
						.ui-datepicker-header{
							display: none;
						}
						.ui-state-default{
							border:none !important;
							background: none !important;
							text-align: center !important;
							position: relative;
						}
						.ui-datepicker-calendar td{
							border: none !important
						}
						.ui-widget.ui-widget-content{
							border: none !important;
							padding: 0px !important
						}
						.ui-datepicker-calendar .ui-state-active {
							background:#007771 !important;
							color:#fff;
							border-radius: 5px;
						}
						.ui-datepicker-calendar .ui-state-active:hover:after{
							border:2px solid #007771 !important;
							border-radius: 5px;
							content : "  ";
							position:absolute;
							height:100%;
							width: 100%;
							left: -2px;
							top:0px
						}
						.ui-datepicker-calendar thead span{
							text-transform: uppercase;
							font-weight: normal;
						}
						</style>

						<div style="background:#464646;color:#fff;text-align:center;padding:22px 0px;margin-top:65px;margin-bottom:25px">Suspend Delivery</div>
						<div class="calendar-picker order_subscription" ></div>
				</div>
				<!-- End calendar-->

			</div>
			<div class="cell col3">
					<h3 style="text-align:center">Products You Ordered</h3>
					<div style="text-align:center; margin-top:60px">
						<img src="/wp-content/uploads/2017/09/large-product-image.png" style="max-width:255px;" />
					</div>

					<h3 style="text-align:center;margin-top:100px;"><?php echo $product_name;?></h3>
					<div style="text-align:center; margin-bottom:51px;"><?php echo $short_description;?></div>

					<div style="text-align:center">Delivery Date</div>
					<div style="text-align:center"><?php echo date("F d, Y (l) ",strtotime($order_meta["_schedule_next_payment"][0]));?></div>
			</div>
		</div>
	
		<?php 
		/* order subscriptiosn mobile */
		?>
		<div class="hide-on-desktop">
			<div class="row order-subscription-section">
				<div class="cell col1" style="width:40% !important; float:left;    padding: 7px 5px;  border-bottom:none; border-top: none;">
					View Product Box By : 
				</div>
				<div class="cell col2" style="width:30% !important; float:left;padding: 7px 5px;  border-bottom:none; border-right:none;border-left:none; border-top: none;">
						Month <i class="fa fa-angle-down"></i>
				</div>
				<div class="cell col2" style="width:30% !important; float:left;padding: 7px 5px;;  border-bottom:none; border-top: none;">
						
						Year <i class="fa fa-angle-down"></i>
				</div>
			</div>
			<div class="row order-subscription-section">
				<div class="cell col1" style="border-right:none;width:10% !important; float:left;    padding: 7px 5px;  border-bottom:none;">
					<i class="fa fa-angle-left"></i>
				</div>
				<div class="cell col2" style="width:80% !important; float:left;    padding: 7px 5px;  border-bottom:none; border-right:none;border-left:none">
						<div style="text-align:center;font-size:11px;adding-top:3px;">Delivery on <?php echo date("l F d, Y ",strtotime($order_meta["_schedule_next_payment"][0]));?></div>
				</div>
				<div class="cell col2 " style="border-left:none;width:10% !important; float:left;    padding: 7px 5px;  border-bottom:none;">
						
						<i class="fa fa-angle-right"></i>
				</div>
			</div>

			<div class="row order-subscription-section">
				<div class="cell col2 ">
					<div style="text-align:center; margin-top:60px">
						<img src="/wp-content/uploads/2017/09/large-product-image.png" style="max-width:255px;" />
					</div>
					<div style="text-align:center;margin-bottom:30px">
						<h3 style="margin-top:30px">Box Name Goes Here</h3>
						<div>consectetur adipisicing elit, sed do </div>
					</div>
					<!-- Start Bullets-->
					<div class="et_pb_row single-product-bullets" style="border-bottom:1px solid #ebebeb">
						<div class="et_pb_column et_pb_column_1_2"  >
							<ul>
								<li>consectetur adipisicing</li>
								<li>consectetur adipisicing</li>
								<li>consectetur adipisicing</li>
								<li>consectetur adipisicing</li>
							</ul>
						</div>
						<div class="et_pb_column et_pb_column_1_2"  >
							<ul>
								<li>consectetur adipisicing</li>
								<li>consectetur adipisicing</li>
								<li>consectetur adipisicing</li>
								<li>consectetur adipisicing</li>
							</ul>
						</div>
					</div>
					<!-- End Bullets-->
					<div style="background:#464646;color:#fff;text-align:center;padding:22px 0px;margin-top:25px;margin-bottom:25px">Suspend Delivery</div>

				</div> <!-- <div class="cell col2 "> -->

				<div class="cell col3" style="padding-top:0px; margin-top:37px;">
						<h3 style="text-align:center;border-bottom:1px solid #ebebeb;margin: 0px -29px;padding: 14px 0px;">Products You Ordered</h3>
						
						<div style="float:left;width:120px;">
							<div style="text-align:center; margin-top:60px">
								<img src="/wp-content/uploads/2017/09/large-product-image.png" style="max-width:100%;" />
							</div>
							
						</div>
						<div style="float:left;width: 180px;padding-left: 17px; font-size:11px">
							<h3 style="text-align: left;margin-top: 60px;font-size: 19px;">Box Name Goes Here</h3>
							<div style="text-align: left;margin-bottom: 7px;  font-size:11px;">Lorem ipsum dolor sit amet</div>

							<div style="text-align: left;  font-size:11px; ">Delivery Date</div>
							<div style="text-align: left; font-size:11px;">September 24, 2017 (Monday)</div>

						</div>
						<div style="clear:both"> </div>

						<h3 style="border-top: 1px solid #ebebeb;padding-top: 20px;margin-top: 32px; text-align:left">Delivery Note</h3>

						<div class="delivery-note-panel">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna 
						</div>

						<table class="order-details-tbl">
							<tr>
								<td style="width:175px"><h3 style="font-size:12px">Order</h3></td>
								<td>Lorem Ipsum</td>
							</tr>

							<tr>
								<td><h3 style="font-size:12px">Number</h3></td>
								<td>#123123</td>
							</tr>

							<tr>
								<td><h3 style="font-size:12px">Subscription</h3></td>
								<td>Weekly</td>
							</tr>

							<tr>
								<td><h3 style="font-size:12px">Status</h3></td>
								<td>Paid</td>
							</tr>
							<tr><td></td><td></td></tr>
						</table>

						<button type="button" class="btn-green" style="width:100%;display:block;padding-right:20px;padding-left:20px;font-size:13px;padding:0px; height:39px">
							<span style="float:left;padding-left:10px">Invoice </span>
								#12312312321
							<i class="fa fa-download" style="font-size:12px; float:right"></i>
							<div style="clearfix:both"> </div>
						</button>

				</div> <!-- <div class="cell col3"> -->

				
			</div> <!-- <div class="row order-subscription-section"> -->
		</div> <!-- <div class="hide-on-desktop"> -->
		<?php
		/* End order subscription mobile*/
		?>

	</div> <!-- <div class="tbl "> -->


</div> <!-- <div class="order-subscription-main"> -->



<?php 
if($_GET["suspend_delivery"]): 
?>
<style type="text/css">
	.suspend-delivery-popup .ui-datepicker-calendar a,
	.suspend-delivery-popup td,
	.suspend-delivery-popup th{
		font-size: 11px !important;
    	padding: 5px 7px !important;
	}
</style>
<div class="pumpkinsquash-popup suspend-delivery-popup" style="
	position: fixed;
    left: 0px;
    top: 0px;
    z-index: 99999;
    overflow-y: scroll;
	top: 0; right: 0; bottom: 0; left: 0;
	paddgin-top:5%;
	background: rgba(0,0,0,.5);
	">
	<div class="popup-overlay pumpkinsquash-popup-overlay " 
			style="
			    
			    width: 100%;
			    z-index: 100000000;
			    height:100vh;
			    padding-top:5%;
			   	po
			    padding-bottom:5%;
			   
			">
			<div class=" pumpkinsquash-popup-content " style="width: 950px;
					    background: #fff;
					    padding: 40px;
					    margin: auto;
					    margin-bottom:100px;
					    position:relative;
				">
				<img class="pumpkinsquash-close" onclick="jQuery('.pumpkinsquash-popup').hide();" src="/wp-content/themes/Divi-child/images/contact-popup-close.jpg" style="position:absolute;right:17px;top:20px; cursor:pointer">

				<h1 class="title-bordered" style="border-bottom:1px solid #ebebeb;text-align:left;margin-top:20px">Suspend Delivery <div style="float:right; font-size:21px">Aug, 2017</div></h1>

				<div class="datepicker order_subscription" style="margin:30px -15px 43px -15px"></div>

				<button type="button" class="btn-green btn-modal-fullwidth-bottom">Change</button>
			</div>
	</div>

</div>
<?php
endif; #if($_GET["contact_support"]): 
?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
<script>
jQuery( function() {
	dPicker = jQuery( ".calendar-picker" ).datepicker({ 
		firstDay: 1, 
	});
	jQuery('.calendar-picker').datepicker({ dateFormat: 'mm/dd/YYYY' });

	setTimeout(function(){ 

		jQuery( ".calendar-picker" ).datepicker("setDate","<?php echo date("m/d/Y",strtotime($order_meta["_schedule_next_payment"][0]));?>" );
	},100);
} );
</script>

