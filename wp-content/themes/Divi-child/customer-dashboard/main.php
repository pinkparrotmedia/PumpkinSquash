
<div class="et_pb_section">
	<div class="et_pb_row">
		<div class="customer-dashboard-main">
			<div class="customer-dashboard-tbl">
				<div class="row row1">
					<div class="cell block-1"> 
							<a href="<?php echo site_url('recipe');?>?upload=1"  class="btn-green"> Post a Recipe</a>
					</div>

					<div class="cell block-2"> 
							<h2>Customer Support</h2>
							<div class="text">
								consectetur adipisicing elit, sed do 
								eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad 
								minim veniam, 
							</div>
							<button onclick="jQuery('.contact-support-popup').fadeIn(); " style="cursor:pointer" type="button" href="" class="btn-brown">Contact Us</button>
					</div>

					<div class="cell block-3"> 
							<a href="<?php echo site_url('recipe');?>?upload=1" class="btn-dark">Post a Recipe</a>
							<div class="profile">
								<img src="/wp-content/themes/Divi-child/images/customer-dashboar-profile-picture.jpg">
								<div class="name">James Smith</div>
								<div class="email"><small>jamesmith@gmail.com</small></div>
								<div class="amount-balance">
									&pound;1000
								</div>
								<div class="amount-balance-text"><small>Account Balance</small></div>

								<div class="btn">
									<a href="/account-info/?edit_exclusions=1" class="btn-green">Edit Exclusions</a>
								</div>
							</div>
					</div>
				</div> <!-- <div class="row"> -->
			</div>

			<div class="customer-dashboard-tbl">
			
				<div class="row row2">
					<div class="cell block-1"> 
						<a href="<?php echo site_url("order-subscriptions"); ?>" class="btn-dark">View Order/Subscription</a>
					</div>

					<div class="cell block-2"> 
						<a href="<?php echo site_url('recipe');?>?upload=1"  class="btn-green">Post a Recipe</a>
					</div>

				</div> <!-- <div class="row"> -->

			</div> <!-- <div class="customer-dashboard-tbl"> -->
		</div> <!-- customer-dashboard-main -->
	</div> <!-- .et_pb_row -->
</div> <!-- <div class="et_pb_section"> -->



<div class="contact-support-popup"
	style="
	position: fixed;
    left: 0px;
    top: 0px;
    z-index: 99999;
    display:none;
	" 
	>
	<div class="popup-overlay"
			style="
		    background: rgba(0,0,0,.5);
		    width: 100%;
		    position: relative;
		    position: fixed;
		    z-index: 100000000;
		    height:100vh
		"
	>
		<div class="contact-support-form"
			style=" max-width: 885px;
				    background: #fff;
				    padding: 70px;
				    margin: auto;
				    margin-top: 165px;
				    position:relative
			" 
			>
			<img onclick="jQuery('.contact-support-popup').fadeOut(); " src="/wp-content/themes/Divi-child/images/contact-popup-close.jpg" style="position:absolute;right:17px;top:20px; cursor:pointer" />

			<h1 class="title-bordered">Contact Support</h1>

			<div class="input-group ">
				<input type="text" class="input-text bordered" value="Name" style="padding-top:18px; padding-bottom:18px">
			</div>

			<div class="input-group ">
				<input type="text" class="input-text bordered" value="Email" style="padding-top:18px; padding-bottom:18px">
			</div>

			<div class="input-group " style="margin-bottom:47px">
				<textarea class="input-text bordered" style="height:190px">Message</textarea>
			</div>

			<button class="btn-green" style="position:absolute;right:0px;bottom:0px">Submit</button>
		</div>
	</div>

</div>