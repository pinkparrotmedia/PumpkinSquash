<?php
/*
Template Name: Account Info
*/
if( !is_user_logged_in() ):
	wp_redirect(site_url());

else:

	get_header();

	$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

	$user_info = wp_get_current_user();
	$user_meta = get_user_meta($user_info->ID);
	

?>

	<div id="main-content">

	<?php if ( ! $is_page_builder_used ) : ?>

		<div class="container">
			<div id="content-area" class="clearfix">
				<div id="left-area">

	<?php endif; ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

							<div class="account-info-container">
								<div class="tbl">
									<div class="row">
											<div class="cell account-info-buttons" style="width:265px; ">
												<div class="account-profile-container">
													<img class="profile-picture" src="/wp-content/themes/Divi-child/images/account-info-pic.png">
													<h2 style="margin-top:35px"><?php echo $user_meta["first_name"][0]." ".$user_meta["last_name"][0];?></h2>
													<div style="font-size:20px; margin-top:5px;" class="email-address"><?php echo $user_info->data->user_email;?></div>

													<div class="acount-balance-section">
														<h2 class="amount">£1000</h2>
														<div style="font-size:20px;" class="account-balance">Account Balance</div>
													</div>

													<div>
														<a href="?edit_exclusions=1" type="button" class="btn-green btn-block">My Box Exclusions</a>
														<button onclick="jQuery('.delivery-note-popup').show();" type="button" class="btn-green btn-block">Delivery Note</button>
														<a href="/order-subscriptions/" type="button" class="btn-green btn-block">Payment</a>
														<a href="?logout=1" type="button" class="btn-green btn-block">Logout</a>
													</div>

													<div style="padding-top:12px" class="request-account-closure">
														<small>Request Account Closure</small>
													</div>
												</div>
											</div> <!-- <div class="cell">-->
											<div class="cell">

												<div class="account-info-form">
													
													<form id="frm-change-delivery-address" onsubmit="changeDeliveryAddress(); return false;">

														<h1 class="title-borderd">Account Info</h1>

														<div class="input-group brown width-edit">
															<div class="input-label">Name</div>
															<input type="text" class="input-text" value="<?php echo $user_meta["first_name"][0]." ".$user_meta["last_name"][0];?>">
															<a href="" class="edit-btn">edit</a>
														</div>

														<div class="input-group brown width-edit">
															<div class="input-label">Email</div>
															<input type="text" class="input-text" value="<?php echo $user_info->data->user_email;?>">
															<a href="" class="edit-btn">edit</a>
														</div>

														<div class="input-group brown width-edit">
															<div class="input-label">Phone</div>
															<input type="text" name="phone" class="input-text" value="<?php echo $user_meta["billing_phone"][0];?>">
															<a href="" class="edit-btn">edit</a>
														</div>

														<div class="input-group brown width-edit">
															<div class="input-label">Address 1</div>
															<?php 
															$countries_obj   = new WC_Countries();
	    													$countries   = $countries_obj->__get('countries');
															?>
															<input type="text" class="input-text" name="address_1" value="<?php echo $user_meta[billing_address_1][0];?>">
															<a href="" class="edit-btn">edit</a>
														</div>

														<div class="input-group brown width-edit">
															<div class="input-label">Address 2</div>
															<input type="text" class="input-text" name="address_2" value="<?php echo $user_meta[billing_address_2][0];?>">
															<a href="" class="edit-btn">edit</a>
														</div>

														<div class="input-group brown">
															<div class="input-label">Country</div>
															<div class="option-dropdown">
																<select name="country">
																	<option value=""></option>
																	<?php 
																	foreach($countries as $code=>$ecount):
																		$selected = "";
																		if($code == $user_meta[billing_country][0] ) $selected = " selected ";
																	?>
																		<option <?php echo $selected;?> value="<?php echo $code;?>"><?php echo $ecount;?></option>
																	<?php
																	endforeach;
																	?>
																</select>
															</div>
														</div>

														<div class="input-group brown width-edit">
															<div class="input-label">Postcode</div>
															<input type="text" class="input-text" name="postcode" value="<?php echo $user_meta[billing_postcode][0];?>">
															<a href="" class="edit-btn">edit</a>
														</div>
														<div class="div-change-delivery-address-msg"> </div>
														<button style="margin-top:20px;" class="btn-green btn-save-account-info" type="submit">Change Delivery Address</button>
													</form>


													<h1 class="title-borderd" style="margin-top:70px;">Change Password</h1>

													<div class="input-group ">
														<input type="text" class="input-text bordered" value="Old Password">
													</div>

													<div class="input-group ">
														<input type="text" class="input-text bordered" value="New Password">
													</div>

													<div class="input-group ">
														<input type="text" class="input-text bordered" value="Retype New Password">
													</div>

													<div style="margin-top:40px; margin-bottom:80px;" class="btn-save-account-container">
														<button class="btn-green btn-save-account-info" type="button">Save</button>
													</div>
												</div>

											</div> <!-- <div class="cell">-->
									</div> <!-- <div class="row">-->
								</div> <!-- <div class="tbl">-->
							</div>
					

					</article> <!-- .et_pb_post -->

				<?php endwhile; ?>

	<?php if ( ! $is_page_builder_used ) : ?>

				</div> <!-- #left-area -->

				<?php get_sidebar(); ?>
			</div> <!-- #content-area -->
		</div> <!-- .container -->

	<?php endif; ?>

	</div> <!-- #main-content -->

<?php 
endif;
?>


<!-- exclusions popup -->
<?php if(!empty($_GET["edit_exclusions"])):
	require_once "edit-exclusions.php";
endif; #<?php if(!empty($_GET["edit_exclusions"])):?> 
<!-- exclusions popup-->

<script type="text/javascript">
	jQuery(document).ready(function($){
		changeDeliveryAddress = function(){
			var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
			$.ajax({
				url : ajaxurl+"?action=change_delivery_address",
				data : $("#frm-change-delivery-address").serialize(),
				type : "post",
				beforeSend : function(){
					$(".div-change-delivery-address-msg").html("");
					$("#frm-change-delivery-address .btn-green").fadeTo("slow",.5);
				},
				success : function(){
					$(".div-change-delivery-address-msg").html("<div style='margin:10px 0px;'>Successfully changed delivery address </div>");
					$("#frm-change-delivery-address .btn-green").fadeTo("slow",1);
				}
			});
		}
	});
</script>

<?php get_footer(); ?>