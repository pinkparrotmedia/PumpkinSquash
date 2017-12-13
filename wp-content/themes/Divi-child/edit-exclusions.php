<div class="edit-exclusions-popup"
	style="
	position: fixed;
    left: 0px;
    top: 0px;
    z-index: 99999;
    overflow-y: scroll;
	top: 0; right: 0; bottom: 0; left: 0;
	paddgin-top:5%;
	background: rgba(0,0,0,.5);
	" 
	>
	<div class="popup-overlay"
			style="
		    
		    width: 100%;
		    z-index: 100000000;
		    height:100vh;
		    padding-top:5%;
		   	po
		    padding-bottom:5%;
		   
		"
	>
		<div class="edit-exclusions-form"
			style="max-width: 820px;
				    background: #fff;
				    padding: 70px;
				    margin: auto;
				    margin-bottom:100px;
				    position:relative;
			" 
			>
			<img class="close-button" onclick="hideRecipePop()" src="/wp-content/themes/Divi-child/images/contact-popup-close.jpg" style="position:absolute;right:17px;top:20px; cursor:pointer" />

			<div class="edit-exclusions-desktop">
				<?php require_once "edit-exclusions-desktop.php";?>
			</div>
			<div class="edit-exclusions-mobile"  >
				<?php require_once "edit-exclusions-mobile.php";?>
			</div>

		</div>
	</div>

</div>
<script type="text/javascript">
	jQuery("body").css({"overflow":"hidden"});
	jQuery(document).ready(function(){
		hideRecipePop = function(){
			jQuery(".edit-exclusions-popup").fadeOut();
			jQuery("body").css({"overflow":"auto"});
		}
	});
</script>