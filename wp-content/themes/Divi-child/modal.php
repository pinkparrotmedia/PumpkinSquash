<?php #if($_GET["postcode_checker_result"]):?>
<div class="pumpkinsquash-popup popup-post-code-checker-result" style="
	position: fixed;
    left: 0px;
    top: 0px;
    z-index: 99999;
    overflow-y: scroll;
	top: 0; right: 0; bottom: 0; left: 0;
	paddgin-top:5%;
	background: rgba(0,0,0,.5);
	display:none
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
					    padding: 55px 65px 70px 65px;
					    margin: auto;
					    margin-bottom:100px;
					    position:relative;
				">
				<img class="pumpkinsquash-close" onclick="jQuery('.pumpkinsquash-popup').hide();" src="/wp-content/themes/Divi-child/images/contact-popup-close.jpg" style="position:absolute;right:17px;top:20px; cursor:pointer">
				<div class="content"> </div>
				 				
				 
			</div>
	</div>

</div>	
<?php #endif; #if($_GET["postcode_checker_result"]):?>

<div class="pumpkinsquash-popup delivery-note-popup" style="
	position: fixed;
    left: 0px;
    top: 0px;
    z-index: 99999;
    overflow-y: scroll;
	top: 0; right: 0; bottom: 0; left: 0;
	paddgin-top:5%;
	background: rgba(0,0,0,.5);
	display:none
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

				<form id="frm-delivery-note">
					<h1 class="title-bordered" style="border-bottom:1px solid #ebebeb;">Delivery Note</h1>
					<?php 
					$user_id = get_current_user_id();
					$user_meta = get_user_meta($user_id);
					?>
					<textarea class="input-text" placeholder="Message" style="height:195px; margin-bottom:35px; margin-top:20px;" name="delivery_note"><?php echo $user_meta["user_delivery_note"][0];?></textarea>
				</form>
				<button type="button" class="btn-green btn-modal-fullwidth-bottom" onclick="saveDeliveryNote(this);">Save</button>
			</div>
	</div>

</div>	
<script type="text/javascript">
	jQuery(document).ready(function($){
		var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
		saveDeliveryNote = function(e){
			$.ajax({
				url : ajaxurl+"?action=save_delivery_note",
				beforeSend : function(){
					$(e).fadeTo("fast",".8");
					$(e).html("Saving...");
				},
				type : "post",
				data : $("#frm-delivery-note").serialize(),
				success : function(){
					$(e).fadeTo("fast","1");
					$(e).html("Saved");
					setTimeout(function(){
						$(e).html("Save");
					},3000);
				}
			});
		}
	});
</script>



<?php 
if($_GET["change_delivery_address"]): 
?>
<div class="pumpkinsquash-popup change-delivery-popup" style="
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

				<h1 class="title-bordered" style="border-bottom:1px solid #ebebeb;">Change Delivery Address</h1>

				<div style="margin-top:30px;padding-bottom:7px">Your current delivery address </div>
				<input style="height:39px;width:100%" type="text" class="input-text" placeholder="1234 Suite, Lorem Ipsum, Dolor Este 09995" />
				
				<div style="margin-top:20px;padding-bottom:7px">Your current delivery address </div>
				<input style="height:39px;width:100%; margin-bottom:45px;" type="text" class="input-text" placeholder="Input your address here" />
					

				<button type="button" class="btn-green btn-modal-fullwidth-bottom">Submit</button>
			</div>
	</div>

</div>
<?php
endif; #if($_GET["change_delivery_address"]): 
?>


<?php 
if($_GET["contact_support"]): 
?>
<div class="pumpkinsquash-popup contact-support-popup" style="
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

				<h1 class="title-bordered" style="border-bottom:1px solid #ebebeb;">Customer Support</h1>

				<input style="height:39px;width:100%; margin-top:40px;" type="text" class="input-text" placeholder="Name" />
				
				<input style="height:39px;width:100%; margin-top:20px" type="text" class="input-text" placeholder="Email" />

				<textarea class="input-text" placeholder="Message" style="height:195px; margin-bottom:35px; margin-top:20px;"></textarea>

				<button type="button" class="btn-green btn-modal-fullwidth-bottom">Submit</button>
			</div>
	</div>

</div>
<?php
endif; #if($_GET["contact_support"]): 
?>