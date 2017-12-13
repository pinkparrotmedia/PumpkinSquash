<?php 
error_reporting(0);
ini_set("display_errors",0);

add_shortcode("custom_slider_optin","custom_slider_optin");

function custom_slider_optin($atts){
	ob_start();
	?>
	<div class="slider-opt-in-form">
		<div class="tbl-container">
	        <div class="text cell">
	           <h2>Your delivery day</h2>
	           <div>Type your postcode to confirm when we will be coming up your street…</div>
	       </div>
	       <div class="form cell">
		        <input type="text" placeholder="Enter Post Code" class="input-text postcode-delivery-search" name="" />
		        <button type="button" class="btn-dark btn-postcode-delivery-search">Search</button>
		    </div>
	    </div>
	</div>

	<script type="text/javascript">
	jQuery(document).ready(function($){
		$(".btn-postcode-delivery-search").on("click",function(){
			v = $(".postcode-delivery-search").val();
			var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
			$.ajax({
				url : ajaxurl+"?action=postcode_delivery_search",
				type : "post",
				data : {
					postcode : v
				},success : function(d){
					$(".popup-post-code-checker-result").fadeIn();
					$(".btn-postcode-delivery-search").fadeTo("slow",1);

					$(".popup-post-code-checker-result .content").html(d);
				},beforeSend : function(){
					$(".btn-postcode-delivery-search").fadeTo("slow",.5);
				}
			});
		});
	});
	</script>

	<?php
	$out = ob_get_contents();
	ob_end_clean();

	return $out;
} // custom slider option
add_action("wp_ajax_postcode_delivery_search","postcode_delivery_search");
add_action("wp_ajax_nopriv_postcode_delivery_search","postcode_delivery_search");
function postcode_delivery_search(){
	global $wpdb;
	$postcode = $_POST["postcode"];
	$sql = "
	SELECT ID
		FROM `wp_postmeta`
		INNER JOIN `wp_posts` ON `wp_postmeta`.post_id = `wp_posts`.ID
	WHERE `meta_value` LIKE '".esc_sql($postcode)."'
	";
	$result = $wpdb->get_results($sql);
	$id     = $result[0]->ID;

	if(empty($id)):
		?>
		<h1 class="title-bordered">We don't delivery on this postcode<?php echo $postcode;?></h1>
		<?php
	else:

		$post_meta = get_post_meta($id);
		$post      = get_post($id);
	?>
		<h1 class="title-bordered">We Deliver in<br/>your Area on <?php echo $post_meta["day_of_the_week"][0];?>!</h1>
		<?php echo $post->post_content;?>	
		<button type="button" class="btn-green btn-modal-fullwidth-bottom">Save</button>		
	<?php
	endif;
	die();
} //save_delivery_note




add_shortcode("home_recipes", "home_recipes");

function home_recipes($atts){
	global $wpdb;

	ob_start();

	$recipes = get_posts( 
			array("post_type"=>"recipes",
			'tax_query' => array(
	        array(
	            'taxonomy' => 'recipe_categories',
	            'field'    => 'slug',
	            'terms'    => 'home',
	        ),
	    ),

	) );

	$thumbs = array();
	$i = 0;
	
	foreach($recipes as $key=>$erecipe):

		$thumbs[$i]["title"] = get_the_title($erecipe->ID);

		if($atts["ismobile"]):
			$meta = get_post_meta($erecipe->ID);
			
			$id = $meta["mobile_thumbnail"][0];
			
			$thumbs[$i]["thumbnail"] = wp_get_attachment_url($id);
			$style = "height:174px;width:100% !important;";
		else:
			$thumbs[$i]["thumbnail"] = get_the_post_thumbnail_url($erecipe->ID);

			$style = "";
			$style = "height:360px";
		endif;

		$thumbs[$i]["ID"]        = $erecipe->ID;

		

		$i++;
	endforeach;


	

	?>

	<h1 style="color:#403f41" class="recipes-title">Recipes</h1>
	<div class="recipe-portfolio-blocks">
		<div class="row"> 
			<div class="cell portofolio-1"
				style="background:url(<?php echo $thumbs[0]["thumbnail"];?>);
					   background-size:cover;
					   <?php echo $style;?>
					   width:870px;
				" 	
			>
				<div style="background:#ded1c1;position:absolute;width: 370px;padding: 15px;text-align: center; position:absolute"><?php echo $thumbs[0]["title"];?></div>

			</div>

			<div class="cell portofolio-2"
				style="background:url(<?php echo $thumbs[1]["thumbnail"];?>);
					   background-size:cover;
					   <?php echo $style;?>
				" 
			>
				<div style="
					background:#464646;
					position:absolute;
					width: 350px;
					padding: 48px 0px;
					text-align: center;
					right:0px;
					font-size:18px;
					color:#DED1C1;
					"><?php echo $thumbs[1]["title"];?></div>


			</div>
		</div>

		<div class="row"> 
			<div class="cell portofolio-1"
				style="background:url(<?php echo $thumbs[2]["thumbnail"];?>);
					   background-size:cover;
					   <?php echo $style;?>
					   width:356px;
					   position:relative;
				" 	
			>

				<div style="
					background:#007771;
					position:absolute;
					width: 100%;
					padding: 15px 0px;
					text-align: center;
					right:0px;
					font-size:18px;
					color:#fff;
					bottom:0px;
					"><?php echo $thumbs[2]["title"];?></div>


			</div>

			<div class="cell portofolio-1"
				style="background:url(<?php echo $thumbs[3]["thumbnail"];?>);
					   background-size:cover;
					   <?php echo $style;?>
				" 	
			>

			</div>

			<div class="cell portofolio-2"
				style="background:url(<?php echo $thumbs[4]["thumbnail"];?>);
					   background-size:cover;
					   <?php echo $style;?>
				" 
			>

			</div>
		</div>

	</div>
	<?php
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
} // home_recipes



add_shortcode("home_subscribe", "home_subscribe");
function home_subscribe(){
	global $wpdb;
	ob_start();
	?>
	<div class="home-subscribe">
		<div class="home-subscribe-tbl">
			<div class="cell text" style="text-align:left">
				<h2>READ ALL ABOUT IT! <br/>Subscribe here to receive our weekly newsletter </h2> 		
			</div>
			<div class="cell optin-form">
				<input type="text" class="input-text" placeholder="Enter Your Email Here"/>
				<button type="button" class="btn-brown">Subscribe</button>
			</div>
		</div>
	</div>
	<?php
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
}// home subscribe

add_shortcode("home_check_delivery","home_check_delivery");
function home_check_delivery(){
	global $wpdb;
	ob_start();
	?>
	<div class="home-subscribe">
		<div class="home-subscribe-tbl">
			<div class="cell text" style="text-align:left;padding:0px;">
				<h2 style="font-size:15.56px;">Check Delivery Area </h2> 		
			</div>
			<div class="cell text" style="text-align:left;padding:0px;">
				<input type="text" class="input-text" placeholder="Postcode" style="width:122px;height:31px;font-size:11px !important;padding:0px;padding-left:16px;border:1px solid #fff;" />		
			</div>
			<div class="cell optin-form" style="padding:0px;">
				<button type="button" class="btn-brown" style="width:108px; height:32px; font-size:13.25px;padding:0px;margin-left:8px;">Search</button>
			</div>
		</div>
	</div>
	<?php
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
}//home_check_delivery

add_shortcode("email_tpl_cta","email_tpl_cta");
function email_tpl_cta(){
	global $wpdb;
	ob_start();
	?>
	<div class="home-subscribe" style="padding:13px 18px;">
		<div class="home-subscribe-tbl">
			<div class="cell text" style="text-align:left;padding:0px;">
				<h2 style="font-size:15.56px;text-align:left">Lorem ipsum dolor sit amet,  jec </h2> 		
			</div>
			<div class="cell optin-form" style="padding:0px;">
				<button type="button" class="btn-brown" 
						style="width:134px; 
								height:33px; 
								font-size:13.25px;
								padding:0px;
								margin-left:8px;">CTA</button>
			</div>
		</div>
	</div>
	<?php
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
}//email_tpl_cta


add_shortcode("boxes_search_postcode","boxes_search_postcode");
function boxes_search_postcode(){
	global $wpdb;
	ob_start();
	?>
	<div class="home-subscribe">
		<div class="home-subscribe-tbl">
		
			<div class="cell optin-form" style="text-align:center;">
				<h2 style="display:inline-block;margin-right:20px;">Check Delivery Area </h2> 		
				<input type="text" class="input-text" placeholder="Postcode" style="width:433px" />
				<button type="button" class="btn-brown">Search</button>
			</div>
		</div>
	</div>
	<?php
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
} // boxes_search_postcode

add_shortcode("email_template_postcode_search","email_template_postcode_search");
function email_template_postcode_search(){
	global $wpdb;
	ob_start();
	?>
	<div class="home-subscribe">
		<div class="home-subscribe-tbl">
			<div class="cell optin-form" style="text-align:center;">
				<input type="text" class="input-text" placeholder="Enter Post Code" style="width:433px" />
				<button type="button" class="btn-brown">Search</button>
			</div>
		</div>
	</div>
	<?php
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
} // email_template_postcode_search




add_shortcode("blog_page_top_level_category","blog_page_top_level_category");
function blog_page_top_level_category($atts){
	ob_start();

	$categories = get_categories(array("hide_empty"=>0));
	$is_mobile  = $atts["ismobile"];
	?>
	<div class="blog-top-level-category">
		<div class="row">
			<div class="cell section-title">
				<h1 style="padding-left:60px;">Top Level Category</h1>
			</div>
			<?php 

			if(!$is_mobile):
				foreach($categories as $cat):
				?>
				<div class="cell">
					<?php echo $cat->name;?>
				</div>
				<?php 
				endforeach;

			else:
				?>
				<div class="product-category-container"> 
					<ul class="product">
						<li><a href="">Category 1 Product Box</a></li>
						<li><a href="">Category 1 Product Box</a></li>
						<li class="arrow-navigation">
							<a href="" class="arrow-left"><img src="http://pumpkinsquash.local/wp-content/themes/Divi-child/images/product-category-arrow-left.jpg"></a>
							<a href="" class="arrow-right"><img src="http://pumpkinsquash.local/wp-content/themes/Divi-child/images/product-category-arrow-right.jpg"></a>
						</li>
					</ul>
				</div>

				
				<div class="second-level-category-table">
					<h3>Sub Level Category</h3>
					<table>
							<tr><td>First Category</td> <td>Second Category</td> <td>Third Category</td> </tr>
							<tr><td>First Category</td> <td>Second Category</td> <td>Third Category</td> </tr>
					</table>
				</div>

				
				<div class="tags-table">
					<h3>Tags</h3>
					<table>
							<tr><td>First Category</td> <td>Second Category</td> <td>Third Category</td> </tr>
							<tr><td>First Category</td> <td>Second Category</td> <td>Third Category</td> </tr>
					</table>
				</div>
				<?php
			endif;
			?>
		</div>
		
	</div>
	<?php
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
} //blog_page_top_level_category


add_shortcode("blog_loop","blog_loop");
function blog_loop(){
	ob_start();
	
	$posts = get_posts();

	foreach($posts as $post):
		$post_thumbnail = get_the_post_thumbnail_url($post->ID);
		$post_link      = get_permalink($post->ID);
	?>
		<div class="blog-post-item">
			<div class="et_pb_row">
				<div class="et_pb_column et_pb_column_1_2">
					<div style="
						height:317px;
						background:url(<?php echo $post_thumbnail?>);
						background-size:cover;
					">

					</div>
				</div>

				<div class="et_pb_column et_pb_column_1_2">
					<h2><?php echo $post->post_title;?></h2>
					<div class="post-author"> By Jame Smith</div>
					<div class="content">
						<?php echo $post->post_content;?>
					</div>

					<div class="et_pb_row readmore">
						<div class="et_pb_column et_pb_column_1_2 readmore-button">
							<a href="<?php echo $post_link;?>" class="btn-green">Read More</a>
						</div>

						<div class="et_pb_column et_pb_column_1_2 social-buttons">
							<div class="single-post-social">
								<div class="tbl-container">
									<div class="row">
										<div class="cell share-text">
												Share 
										</div>
										<?php 
										$share_url = get_permalink( $post->ID );
										?>

										<div class="cell facebook">
											<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_url;?>"> 
												<img src="/wp-content/themes/Divi-child/images/blog-social-facebook.png" />
											</a>
										</div>

										<div class="cell twitter">
											<a href="https://twitter.com/home?status=<?php echo $share_url;?>"> 
												<img src="/wp-content/themes/Divi-child/images/blog-social-twitter.png" />
											</a>
										</div>

										<div class="cell instagram">
											<a href="https://instagram.com/"> 
												<img src="/wp-content/themes/Divi-child/images/blog-social-instagram.png" />
											</a>
										</div>

									</div>
								</div>
							</div> <!-- <div class="single-post-social"> -->

						</div> <!-- <div class="et_pb_column_1_2">-->
					</div> <!-- .et_pb_row-->
				</div>
			</div>
		</div>
	<?php
	endforeach;

	$out = ob_get_contents();
	ob_end_clean();
	return $out;
}//blog_loop


add_shortcode("blog_categories_tags","blog_categories_tags");
function blog_categories_tags(){
	ob_start();

	$categories = get_categories(array("hide_empty"=>0));
	$tags       = get_tags(array("hide_empty"=>0));
	?>
	<div class="blog-lists-sidebar">
		<h2>Sub Level Category</h2>
		<?php 
		foreach($categories as $cat):
			?>
			<div class="cat-tag-item"><?php echo $cat->name;?></div>
			<?php
		endforeach;
		?>

		<h2 style="margin-top:57px;">Tags</h2>
		<?php 
		foreach($tags as $tag):
			?>
			<div class="cat-tag-item"><?php echo $tag->name;?></div>
			<?php
		endforeach;
		?>
	</div>
	<?php
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
}//blog_categories_tags



add_shortcode("top_login_dropdown","top_login_dropdown");
function top_login_dropdown($atts){
	ob_start();
	if($atts["mobile"]): 
		echo $atts["mobile"];
		$style = "display:block";
		?>
		<style type="text/css">
		.top-right-signin-signup.login, .top-right-signin{
			display: block !important;
		}
		.top-right-signin-signup.login .register-dark-grey{
			margin: 0px -36px;
		}
		.top-right-signin .hide-on-mobile-signupsignin{
			display: none
		}
		.top-right-signin .btn-green{
			width: 100%;
		}
		.top-right-signin .register-tbl{
			display: table !important;
		}
		.top-right-signin .register-tbl .row{
			display: table-row !important;
		}
		.top-right-signin .register-tbl .row .cell{
			display: table-cell !important;
		}
		.top-right-signin .register-tbl .row .cell.checkbox{
			padding: 0px 20px 0px 4px !important;
			width: 65px;
		}
		.register-dark-grey .signupnow {
		    width: 155px;
		    padding-right: 9px !important;
		}
		.register-dark-grey .register-now{
			text-align: left;
		}
		.register-dark-grey .register-now h3{
			font-size: 16px;
		}
		.register-dark-grey .register-now div{
			font-size: 11px;
		}
		</style>
		<?php
	else:
		$style = "";
	endif;
	?>
	<div class="top-right-signin-signup top-right-dropdown-signin login">
		<div class="main-signin-container">
			<?php 
			if($atts["mobile"]): 
			?>
			<img src="/wp-content/themes/Divi-child/images/signup-mobile-search.jpg" 
				onclick="jQuery('.top-right-dropdown-signup').hide();" 
				style="position:absolute;cursor:pointer;right: 0px;top: 10px;right: 49px;"/>
			<img src="/wp-content/themes/Divi-child/images/signup-mobile-close.jpg" 
				onclick="jQuery('.top-right-dropdown-signin').hide();" 
				style="position:absolute;cursor:pointer;right: 0px;top: 10px;right: 0px;" />
			<?php
			else:
			?>
			<img src="/wp-content/themes/Divi-child/images/close-signin.png" 
				onclick="jQuery('.top-right-dropdown-signin').hide();" 
				style="position:absolute;cursor:pointer;right: 0px;top: 34px;right: 17px;" />
			<?php 
			endif;
			?>

			<div class="form-container">
				<h1>Login</h1>
				<div class="with">with</div>
				<div class="social-logins">
					<?php 
					if($atts["mobile"]): 
					?>
					<a href=""><img src="/wp-content/themes/Divi-child/images/signup-mobile-facebook.jpg" /></a>
					<a href=""><img src="/wp-content/themes/Divi-child/images/signup-mobile-twitter.jpg" /></a>
					<?php 
					else:
					?>
					<a href=""><img src="/wp-content/themes/Divi-child/images/signin-facebook.png" /></a>
					<a href=""><img src="/wp-content/themes/Divi-child/images/signin-twitter.png" /></a>
					<?php 
					endif;
					?>
				</div>
				<div class="or">or</div>
				<div class="form">
					<form id="top-login-form">
						<input type="text" class="input-text" placeholder="Name" name="username" />
						<input type="password" class="input-text" placeholder="Password" name="password" />
						<div class="forgot-password">
							<a href=""> Forgot Password?</a>
						</div>
						<div class="buttons">
							<button type="button" class="btn-green btn-top-login">Login</button>
						</div>
						<div class="top-login-msg"></div>
					</form>
				</div>
				
			</div>

			<div class="register-dark-grey">
					<div class="register-tbl">
						<div class="row">
							<div class="cell register-now" style="width:325px">
								<h3>Register Now</h3>
								<div class="">If your haven’t got an account already, click here to get started… </div>
							</div>
							<div class="cell signupnow" style="padding:0px;">
								<a  style="padding-right:20px;padding-left:20px;" href="" class="btn-signup btn-brown">Sign Up Now</a>
							</div>
						</div>
					</div>
			</div>

		</div>
	</div>

	<script type="text/javascript">
	jQuery(document).ready(function($){
		var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";

		$(".btn-top-login").click(function(){
			e = this;
			$.ajax({
				url : ajaxurl+"?action=pumpkin_front_login",
				type : "post",
				dataType : "json",
				data : $("#top-login-form").serialize(),
				beforeSend : function(){
					$(e).fadeTo("slow",.5);
					$(".top-login-msg").html("");
				},
				success : function(d){
					$(e).fadeTo("slow",1);
					if(d.error==1){
						$(".top-login-msg").html("<div style='padding-bottom:20px;margin-top:-20px'>"+d.msg+"</div>");
					}else{
						window.location = "<?php echo site_url();?>/account-info";
					}
				}
			});
		});
	});
	</script>
	<?php
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
}// top login dropdown



add_shortcode("top_singup_dropdown","top_singup_dropdown");
function top_singup_dropdown($atts){
	ob_start();
	if($atts["mobile"]): 
		$style = "display:block";
		?>
		<style type="text/css">
		.top-right-signin{
			display: block;
		}
		.top-right-signin .hide-on-mobile-signupsignin{
			display: none
		}
		.top-right-signin .btn-green{
			width: 100%;
		}
		.top-right-signin .register-tbl{
			display: table !important;
		}
		.top-right-signin .register-tbl .row{
			display: table-row !important;
		}
		.top-right-signin .register-tbl .row .cell{
			display: table-cell !important;
		}
		.top-right-signin .register-tbl .row .cell.checkbox{
			padding: 0px 20px 0px 4px !important;
			width: 65px;
		}
		</style>
		<?php
	else:
		$style = "";
	endif;
	?>
	<div class="top-right-signin-signup top-right-dropdown-signup" style="<?php echo $style;?>">
		<div class="main-signin-container">
			<?php 
			if($atts["mobile"]): 
			?>
			<img src="/wp-content/themes/Divi-child/images/signup-mobile-search.jpg" 
				onclick="jQuery('.top-right-dropdown-signup').hide();" 
				style="position:absolute;cursor:pointer;right: 0px;top: 10px;right: 49px;"/>
			<img src="/wp-content/themes/Divi-child/images/signup-mobile-close.jpg" 
				onclick="jQuery('.top-right-dropdown-signup').hide();" 
				style="position:absolute;cursor:pointer;right: 0px;top: 10px;right: 0px;" />
			<?php
			else:
			?>
			<img src="/wp-content/themes/Divi-child/images/close-signin.png" 
				onclick="jQuery('.top-right-dropdown-signup').hide();" 
				style="position:absolute;cursor:pointer;right: 0px;top: 34px;right: 17px;" />
			<?php 
			endif;
			?>

			<div class="form-container">
				<h1>Register</h1>
				<div class="with">with</div>
				<div class="social-logins">
					<?php 
					if($atts["mobile"]): 
					?>
					<a href=""><img src="/wp-content/themes/Divi-child/images/signup-mobile-facebook.jpg" /></a>
					<a href=""><img src="/wp-content/themes/Divi-child/images/signup-mobile-twitter.jpg" /></a>
					<?php 
					else:
					?>
					<a href=""><img src="/wp-content/themes/Divi-child/images/signin-facebook.png" /></a>
					<a href=""><img src="/wp-content/themes/Divi-child/images/signin-twitter.png" /></a>
					<?php 
					endif;
					?>
				</div>
				<div class="or">or</div>
				<div class="form">
					<form id="frm-top-register" onsubmit="topRegisterForm(); return false;" name="frm-top-register">
						<input type="text" required class="input-text" placeholder="Name" name="name" />
						<input type="email" required class="input-text" placeholder="Email" name="email" />
						<div class="address-lookup">
							<input type="text" class="input-text" placeholder="Address lookup">
						</div>
						<div class="buttons" style="text-align:left; margin-top:30px;">
							<button type="submit" class="btn-green btn-top-register">Register</button>
							<div class="top-register-msg"> </div>
						</div>
					</form>
				</div>
				
				<div class="register-tbl" style="padding-bottom:60px">
					<div class="row">
						<div class="cell checkbox" style="padding:0px; padding-right:20px">
							<label class="checkbox"><input type="checkbox" /></label>
						</div>
						<div class="cell" style="font-size:12px;padding: 0px;text-align: left;paddin-bottom: 20px;">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
						</div>
					</div>
				</div>

			</div>

		</div>
	</div>

	<script type="text/javascript">
	jQuery(document).ready(function($){
		topRegisterForm = function(){
			var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
			e = $(".btn-top-register");
		 
			$.ajax({
				url : ajaxurl+"?action=pumpkin_front_register",
				type : "post",
				dataType : "json",
				data : $("#frm-top-register").serialize(),
				beforeSend : function(){
					$(e).fadeTo("slow",.5);
					$(".top-register-msg").html("");
				},
				success : function(d){
					$(e).fadeTo("slow",1);
					if(d.error==1){
						$(".top-register-msg").html("<div style='padding-bottom:20px;margin-top:10px'>"+d.msg+"</div>");
					}else{
						$(".top-register-msg").html("<div style='padding-bottom:20px;margin-top:10px'>"+d.msg+"</div>");
						setTimeout(function(){
							window.location = "<?php echo site_url();?>/account-info";
						},2000);
					}
				}
			});
	 
		}
	});
	</script>
	<?php
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
}// top_singup_dropdown


add_shortcode("recipe_search","recipe_search");
function recipe_search(){
	ob_start();
	?>
	<div class="slider-opt-in-form recipe_search">
		<div class="tbl-container">
	        <div class="text cell">
	          	<input type="text" class="input-text pull-left" value="Lorem ipsum dolor" />
	          	<div class="option-dropdown"><select><option>Category</option></select></div>
	       </div>
	       <div class="form cell">
		        <button type="button" class="btn-dark" style="margin-right:20px">Search</button>
		    </div>
	    </div>
	</div>
	<?php
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
}// recipe_search

add_shortcode("recipe_category_block_1","recipe_category_block_1");
function recipe_category_block_1(){
	global $wpdb;
	ob_start();
	
	$args = array(
	    'post_type' => 'recipes',
	    'tax_query' => array(
	        array(
	            'taxonomy' => 'recipe_categories',
	            'field'    => 'slug',
	            'terms'    => 'recipe-category-1',
	        ),
	    ),
	);

	$posts = get_posts($args);

	$img1 = get_the_post_thumbnail_url($posts[0]->ID);
	$img2 = get_the_post_thumbnail_url($posts[1]->ID);
	?>
	<div class="et_pb_row et_pb_row_1 et_pb_row_3-4_1-4">
			
			
		<div class="et_pb_column et_pb_column_3_4  et_pb_column_1" style="background:url('<?php echo $img1;?>'); background-size:cover;background-repeat:no-repeat;">


			<div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_left  et_pb_text_1">


			<div class="et_pb_text_inner">

			<div style="margin-top: 335px;padding-left: 60px;" class="recipe-block-1-container">
			<h2><?php echo $posts[0]->post_title;?></h2>
			<div class="pull-left" style="
			width: 755px;
			padding-right: 20px;
			"><?php echo $posts[0]->post_content;?></div>
			<p><button type="button" class="btn-dark pull-left">Button</button></p>
			<div class="clearfix"></div>
			</div>

			</div>
			</div> <!-- .et_pb_text -->
		</div> <!-- .et_pb_column -->

		<div class="et_pb_column et_pb_column_1_4  et_pb_column_2" style="background:url('<?php echo $img2;?>'); background-size:cover;background-repeat:no-repeat;">


			<div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_left  et_pb_text_2">


				<div class="et_pb_text_inner">

				<h2 style="text-align: center;color:#fff; margin-top:250px"><?php echo $posts[1]->post_title;?></h2>
				<div style="text-align: center;color:#fff;"><?php echo $posts[1]->post_content;?></div>
				<p style="text-align: center; margin-top:30px"><button style="width:200px;padding-right:0px;padding-left:0px;" class="btn-brown" type="button">Download PDF</button></p>

				</div>
			</div> <!-- .et_pb_text -->
		</div> <!-- .et_pb_column -->
	</div>
	<?php
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
} //function recipe_category_block_1(){



add_shortcode("recipe_category_block_2","recipe_category_block_2");
function recipe_category_block_2(){
	ob_start();

	$args = array(
	    'post_type' => 'recipes',
	    'tax_query' => array(
	        array(
	            'taxonomy' => 'recipe_categories',
	            'field'    => 'slug',
	            'terms'    => 'recipe-category-2',
	        ),
	    ),
	);

	$posts = get_posts($args);

	$img1 = get_the_post_thumbnail_url($posts[0]->ID);
	$img2 = get_the_post_thumbnail_url($posts[1]->ID);
	$img3 = get_the_post_thumbnail_url($posts[2]->ID);
	$img4 = get_the_post_thumbnail_url($posts[3]->ID);

	?>
	<style type="text/css">
		.recipes-category-block-2 .category{
			position: relative;
		}
		.recipes-category-block-2 .category .title.top{
			position:absolute;
			top:0px; 
			background:#403f41;
			color:#fff; 
			text-align:center; 
			padding:15px;
			width:100%;
			left:0px;
			z-index: 1;
		}
		.recipes-category-block-2 .category .title.bottom{
			position:absolute;
			bottom:0px; 
			background:#ded1c1; 
			text-align:center; 
			padding:15px;width:100%
		}
		.recipe-content{
			display: none;
			position: absolute;
			top: 0px;
			left: 0px;
			height: 100%;
			width: 100%;
			color:#fff;
			text-align: center;
		}
		.recipes-category-block-2 .category:hover .recipe-content{
			display: block;
			z-index: 2;
			background:#403f41;
		}
	</style>
	<div class="recipes-category-block-2">
		<div class="tbl" style="min-height:490px;">
			<div class="row">
				<div class="cell align-center cell1 category" style="background:url('<?php echo $img1;?>'); background-size:cover"> 
					<div style="text-align:center; color:#fff;padding-right:60px;padding-left:60px">
						
						<div  class="title top">
					  		<?php echo $posts[0]->post_title;?>
					    </div>

						<div class="recipe-content">
							<h3 style="color:#fff; padding-top:60px"><?php echo $posts[0]->post_title;?></h3>
							<?php echo $posts[0]->post_content;?>
							<button type="button" class="btn-brown" style="padding: 9px 37px;
    margin-top: 30px;">View All</button>
						</div>
						
					</div>
				</div>
				<div class="cell cell2 category" 
					  style="background:url('<?php echo $img2;?>'); background-size:cover"> 

					  <div class="title bottom">
					  		<?php echo $posts[1]->post_title;?>
					  </div>

					  <div class="recipe-content">
						<h3 style="color:#fff; padding-top:60px"><?php echo $posts[0]->post_title;?></h3>
						<?php echo $posts[1]->post_content;?>
						<button type="button" class="btn-brown" style="padding: 9px 37px;
margin-top: 30px;">View All</button>
					  </div>


				</div>
				<div class="cell cell3 category"
					style="background:url('<?php echo $img3;?>'); background-size:cover"
					> 
					
					<div  class="title top">
				  		<?php echo $posts[2]->post_title;?>
				    </div>

					<div class="recipe-content">
						<h3 style="color:#fff; padding-top:60px"><?php echo $posts[0]->post_title;?></h3>
						<?php echo $posts[2]->post_content;?>
						<button type="button" class="btn-brown" style="padding: 9px 37px;
margin-top: 30px;">View All</button>
					</div>

				</div>
				<div class="cell cell4 category"
					style="background:url('<?php echo $img4;?>'); background-size:cover"
					> 
					<div class="title bottom">
					  		<?php echo $posts[3]->post_title;?>
					  </div>

					  <div class="recipe-content">
						<h3 style="color:#fff; padding-top:60px"><?php echo $posts[0]->post_title;?></h3>
						<?php echo $posts[3]->post_content;?>
						<button type="button" class="btn-brown" style="padding: 9px 37px;
margin-top: 30px;">View All</button>
					  </div>
				</div>
			</div>
		</div>	
	</div>
	<?php
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
} // recipe_category_block_2

add_shortcode("recipe_category_block_3","recipe_category_block_3");
function recipe_category_block_3(){

	$args = array(
	    'post_type' => 'recipes',
	    'posts_per_page' => 8,
	    'tax_query' => array(
	        array(
	            'taxonomy' => 'recipe_categories',
	            'field'    => 'slug',
	            'terms'    => 'recipe-category-3',
	        ),
	    ),
	);

	$posts = get_posts($args);
	$post_ids = array();
	$i = 0;
	$j = 0;
	foreach($posts as $epost):
		$post_ids[$i][] = $epost;
		$j++;
		if($j == 4){
			$i++;
		}
	endforeach;

	ob_start();
	?>

	<?php 

	foreach($post_ids as $row):?>
	<div class="recipes-category-block-3">
		<div class="tbl" style="min-height:490px;">
			<div class="row">
				<?php 
				$title_pos = "bottom";
				foreach($row as $cell):
					$img = get_the_post_thumbnail_url($cell->ID);
				?>
					<div class="cell" 
						  style="background:url('<?php echo $img;?>');
						  	background-size:cover;
						  "> 

						  <div style="position:absolute;<?php echo $title_pos;?>:0px; 
						  			background:rgba(255,255,255,.8);
						  			padding:15px;width:100%;
						  			padding-left:40px;
						  			">
						  		<h3 style="font-weight:normal;color:#403f41"><?php echo $cell->post_title;?></h3>
						  		<div><?php echo $cell->post_content;?></div>
						  </div>
					</div>
				<?php 
					if($title_pos == "bottom") $title_pos = "top";
					else $title_pos = "bottom";
				endforeach;?>
				
			</div>
		</div>	
	</div>
	<?php endforeach;?>


	<?php
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
} //recipe_category_block_3


add_shortcode("custom_testimonials","custom_testimonials");
function custom_testimonials(){
	ob_start();
		$testimonials = get_posts(array("post_type"=>"testimonials"));
		?>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.cycle2/2.1.6/jquery.cycle2.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.cycle2/2.1.6/jquery.cycle2.carousel.js"></script>
		
		<style type="text/css">
		.testimonial-image{
			height: 110px;
			width: 110px;
			margin: auto;
			margin-top: 88px;
		}
		.cycle-slide.cycle-slide-active + .cycle-slide > .image-container .testimonial-image{
			height: 190px;
			width: 190px;
			margin-top: 0px;
		}
		.cycle-slide.cycle-slide-active .txt-container{
			float: left;
			width: 235px;
		}
		.cycle-slide.cycle-slide-active .image-container .testimonial-image{
			float: left;
			margin-left: 60px;
		}
		.cycle-slide.cycle-slide-active - .cycle-slide{
			display: none;
		}

		.cycle-slide.cycle-slide-active + .cycle-slide + .cycle-slide .txt-container{
			float: right;
			width: 235px;
		}

		.cycle-slide.cycle-slide-active + .cycle-slide + .cycle-slide > .image-container .testimonial-image{
			float: right;
			margin-right: 60px;
		}
		#testi-prev{
			position:absolute;left:-100px;cursor:pointer;color: #666;
								    font-size: 64px;
								    top: 200px;
		}
		#testi-next{
			position:absolute;right:-100px;cursor:pointer;color: #666;
								    font-size: 64px;
								    top: 200px;
		}
		@media only screen and (max-width: 414px)  {
			.cycle-slide{
				width: 100% !important;
			}
			.cycle-slide.cycle-slide-active .image-container .testimonial-image{
				float: none;
				margin-left: auto;
				text-align: center;
			}
			.cycle-slide.cycle-slide-active .txt-container{
				float: none;
				width: 100%;
				text-align: center;
				width: 235px;
				margin: auto;
			}
			.cycle-slide .image-container{
				height: 125px !important;
			}
			#testi-prev,#testi-next{
				display: none;
			}
		}
		</style>

		<div style="position:relative;max-width:970px;margin:auto;">
			<div 
				style="max-width:970px; margin:auto; min-height:290px; max-height:400px;" 
				class="testimonials-carousel"
			    data-cycle-carousel-fluid=true
			    data-cycle-carousel-visible=3
			    data-cycle-slides="> div"
			    data-cycle-paused=false
			    data-cycle-speed=600
			    data-cycle-next="#testi-next"
			    data-cycle-prev="#testi-prev"

				>
				<?php
				foreach($testimonials as $testi):
					$title = $testi->post_title;
					$desc  = $testi->post_content;
					$img   = get_the_post_thumbnail_url($testi->ID);
					
				?>
					<div class="" style="text-align:center">
						<div class="image-container" style="height:200px; margin-bottom:25px; border:0px solid red">
							<div style="background:url(<?php echo $img;?>);
								background-size:contain;
								background-position:center;
								background-repeat:no-repeat;
								" 
								class="testimonial-image"> 
							</div>
						</div>

						<div style="height:300px; border:0px solid blue; " class="txt-container">
							<div><?php echo $title;?></div>
							<div style="font-size:12px; 
										line-height:20px; 
										white-space:normal; 
										text-align:center; 
										padding:0px 0px;"><?php echo $desc;?></div>
						</div>
						<div class="clearfix"> </div> <br clear="all" />
					</div>
				<?php
				endforeach;
				?>
				
			</div>

			<a id="testi-prev" style=""><i class="fa fa-angle-left"></i> </a>
			<a id="testi-next" style=""><i class="fa fa-angle-right"></i> </a>


		</div>
		
		
		
		<script type="text/javascript">
		jQuery(document).ready(function(){
			function is_mobile() {
				if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
				    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))){

					return true;
				}else{
					return false;
				} 
			}
			if(is_mobile() ){
				jQuery(".testimonials-carousel").cycle({"fx":"fade","timeout":0,"paused":true});
			}else{
				jQuery(".testimonials-carousel").cycle({"fx":"carousel","timeout":1000,"paused":true});
			}
			
		});
		</script>

		<?php
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
} //function custom_testimonials(){



add_shortcode("order_subscription_panel","order_subscription_panel");
function order_subscription_panel(){
	ob_start();
		require_once $_SERVER[DOCUMENT_ROOT]."/wp-content/themes/Divi-child/customer-dashboard/order_subscriptions.php";
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
} //order_subscription_panel


add_shortcode("mobile_product_box_category","mobile_product_box_category");
function mobile_product_box_category($atts){

	$twice    = $atts["twice"];
	$hide_nav = $atts["hide_nav"];
	ob_start();
	require_once $_SERVER[DOCUMENT_ROOT]."/wp-content/themes/Divi-child/mobile_product_box_category.php";
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
}//mobile_product_box_category

add_shortcode("get_in_touch","get_in_touch");
function get_in_touch(){
	ob_start();
	echo "test";
	require_once $_SERVER[DOCUMENT_ROOT]."/wp-content/themes/Divi-child/page-getintouch.php";
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
} // get_in_touch

add_shortcode("checkout_login","checkout_login");
function checkout_login(){

	ob_start();
	?>
	<style type="text/css">
	.input-text {
	    display: block;
	    height:45px;
	    border: 1px solid #ccc;
	    width: 100%;
	    color: #403f41;
	    font-size: 12px;
	    font-family: 'Montserrat', sans-serif;
	    margin-top: 20px;
	}
	.checkout-login-div{
		text-align: left;
	}
	</style>

		<h1 style="text-align:center;border-bottom:1px solid #e6e6e6;padding-bottom:15px;">Login</h1>
		<p style="text-align:center;padding:40px 0px; width:330px; margin:auto">  Lorem ipsum dolor sit amet, consectetur adipisi
		cing elit, seddoeiusmod mpor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris n</p>

		<div class="checkout-login-div" style="margin:0px 22px">
		      <div>
			      <div>Username or Email</div>
			      <input type="text" class="input-text" placeholder="jamesmith@gmail.com" style="margin-top:10px" /> 
		      </div>

		      <div style="margin-top:30px">
			      <div>Password </div>
			      <input type="password" class="input-text" value="9918238123" style="padding-left:20px;margin-top:10px" /> 
		      </div>

		      <button type="button" class="btn btn-green" style="margin-top:20px; margin-bottom:40px;display:block;width:100%;padding-top:11px;">Apply Coupon</button>

		      <div style="text-align:center">Step 1/4</div>
		</div>
	<?php
	$out = ob_get_contents();
	ob_end_clean();
	return $out;

}//checkout_login

add_shortcode("checkout_coupon","checkout_coupon");
function checkout_coupon(){

	ob_start();
	?>
	<style type="text/css">
	.input-text {
	    display: block;
	    height:45px;
	    border: 1px solid #ccc;
	    width: 100%;
	    color: #403f41;
	    font-size: 12px;
	    font-family: 'Montserrat', sans-serif;
	    margin-top: 20px;
	}
	.checkout-login-div{
		text-align: left;
	}
	</style>

		<h1 style="text-align:center;border-bottom:1px solid #e6e6e6;padding-bottom:15px;">Coupon</h1>
	
		<div class="checkout-login-div" style="margin:0px 22px">
		  
		      <div style="margin-top:80px">
			      <div>Coupon </div>
			      <input type="text" class="input-text" value="James" style=" margin-top:10px" /> 
		      </div>

		      <button type="button" class="btn btn-green" style="margin-top:20px; margin-bottom:40px;display:block;width:100%;padding-top:11px;">Apply Coupon</button>

		      <div style="text-align:center">Step 2/4</div>
		</div>
	<?php
	$out = ob_get_contents();
	ob_end_clean();
	return $out;

}//checkout_coupon


add_shortcode("checkout_order_payment","checkout_order_payment");
function checkout_order_payment(){
	ob_start();
		require_once $_SERVER[DOCUMENT_ROOT]."/wp-content/themes/Divi-child/checkout_order_payment.php";
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
} // checkout coupon



add_shortcode("checkout_thankyou","checkout_thankyou");
function checkout_thankyou(){

	ob_start();
	?>
	<style type="text/css">
	.input-text {
	    display: block;
	    height:45px;
	    border: 1px solid #ccc;
	    width: 100%;
	    color: #403f41;
	    font-size: 12px;
	    font-family: 'Montserrat', sans-serif;
	    margin-top: 20px;
	}
	.checkout-login-div{
		text-align: left;
	}
	</style>

		<h1 style="text-align:center;margin-top: 61px;">Thank You</h1>
		<p style="text-align:center;padding: 0px 0px;width:330px;margin:auto;margin-top: 0px;">  Lorem ipsum dolor sit amet, consectetur adipisi
		cing elit, seddoeiusmod mpor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris n</p>

		<button type="button" class="btn-green" style="
		    padding-top: 11px;
		    margin-top: 60px;
		    width: 100%;
		    margin-bottom: 40px;
		">Print Receipt</button>
		
	<?php
	$out = ob_get_contents();
	ob_end_clean();
	return $out;

}//checkout_thankyou


add_action("wp_ajax_pumpkin_front_login","pumpkin_front_login");
add_action("wp_ajax_nopriv_pumpkin_front_login","pumpkin_front_login");
function pumpkin_front_login(){
	global $wpdb;
	$username = $_POST["username"];
	$password = $_POST["password"];
	$r = wp_authenticate($username, $password);

	$msg = "";
	if(!empty($r->errors)):
		$msg = "<div><b>Error:</b> Invalid username or password </div>";
		$error = 1;
	else:
		wp_set_auth_cookie($r->ID);
		wp_set_current_user($r->ID);
		$error = 0;
	endif;

	echo json_encode(array("error"=>$error, "msg"=>$msg));
	die();
} // pumpkin_front_log

add_action("wp_ajax_pumpkin_front_register","pumpkin_front_register");
add_action("wp_ajax_nopriv_pumpkin_front_register","pumpkin_front_register");
function pumpkin_front_register(){
	global $wpdb;

	$user_name   = $_POST["email"];
	$user_email = $_POST["email"];

	$user_id = username_exists( $user_name );
	if ( !$user_id and email_exists($user_email) == false ) {
		$random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
		$user_id = wp_create_user( $user_name, $random_password, $user_email );

		wp_set_auth_cookie($user_id);
		wp_set_current_user($user_id);

		update_user_meta($user_id,"first_name",$_POST["name"]);
		$error = 0;
		$message = "Successfully created user. ";
	} else {
		$error = 1;
		$message = "User already exists";
	}

	echo json_encode(array("error"=>$error, "msg"=>$message));
	die();
}//pumpkin_front_register

add_action("wp_ajax_save_delivery_note","save_delivery_note");
add_action("wp_ajax_nopriv_save_delivery_note","save_delivery_note");
function save_delivery_note(){
	$uid = get_current_user_id();
	print_r($_POST);
	$success = update_user_meta($uid, "user_delivery_note",$_POST["delivery_note"]);
	echo $success;
	die();
} //save_delivery_note


add_action("wp_ajax_change_delivery_address","change_delivery_address");
add_action("wp_ajax_nopriv_change_delivery_address","change_delivery_address");
function change_delivery_address(){
	global $wdpb;

	$uid = get_current_user_id();
	$customer_orders = get_posts( array(
	    'numberposts' => -1,
	    'meta_value'  => get_current_user_id(),
	    'post_type'   => "shop_subscription",
	    'post_status' => "active",
	) );
	$order_id   = $customer_orders[0]->ID;


	$billing_address = array( array( "billing_address_1" => $_POST["address_1"] ),
							array( "billing_address_2"   => $_POST["address_2"] ),
							array( "billing_postcode"    => $_POST["postcode"] ),
							array( "billing_country"     => $_POST["country"] ),
							array( "billing_phone"       => $_POST["phone"] ),

							array( "shipping_address_1"  => $_POST["address_1"] ),
							array( "shipping_address_2"  => $_POST["address_2"] ),
							array( "shipping_postcode"   => $_POST["postcode"] ),
							array( "shipping_country"    => $_POST["country"] ),
							array( "shipping_phone"      => $_POST["phone"] ),

					);
	foreach($billing_address as $eadd):
		foreach($eadd as $meta_key=>$meta_value):
			update_user_meta( $uid, $meta_key, $meta_value);
		endforeach;
	endforeach;


    $order_billing_address = array( 
	    						array( "_billing_address_1" => $_POST["address_1"] ),
								array("_billing_address_2"  => $_POST["address_2"] ),
								array("_billing_postcode"   => $_POST["postcode"] ),
								array("_billing_country"    => $_POST["country"] ),
								array("_billing_phone"      => $_POST["phone"] ),

								array("_shipping_address_1" => $_POST["address_1"] ),
								array("_shipping_address_2" => $_POST["address_2"] ),
								array("_shipping_postcode"  => $_POST["postcode"] ),
								array("_shipping_country"   => $_POST["country"] ),
								array("_shipping_phone"     => $_POST["phone"] ), 
							);
    foreach($order_billing_address as $eadd):
		foreach($eadd as $meta_key=>$meta_value):
			update_user_meta( $uid, $meta_key, $meta_value);
		endforeach;
	endforeach;

	# send email to user that they changed address
	$user_info = get_userdata($uid);

	if(!empty($user_info->data->user_email)):
		$to      = $user_info->data->user_email;
		$subject = "Changed Delivery Address";
		$body    = "Succesfully changed delivery address<br/>";
		$body   .= "<b>Address 1 </b> : ".$_POST["address_1"]."<br/>";
		$body   .= "<b>Address 2 </b> : ".$_POST["address_2"]."<br/>";
		$body   .= "<b>Postcode </b> : ".$_POST["postcode"]."<br/>";
		$body   .= "<b>Country </b> : ".$_POST["country"]."<br/>";
		 
		wp_mail( $to, $subject, $body );
	endif;
	die();
}//change_delivery_address

## hide admin bar on frontend
add_filter('show_admin_bar', '__return_false');
?>