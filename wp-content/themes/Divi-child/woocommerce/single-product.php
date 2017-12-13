<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
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
 * @version     1.6.4
 */

get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

?>

<div id="main-content">



			<?php while ( have_posts() ) : the_post(); ?>

					<div class="et_pb_section">
						<div class="et_pb_row">
							<div class="et_pb_column et_pb_column_1_2">
								<?php 
									the_post_thumbnail();
								?>
							</div>
							<div class="et_pb_column et_pb_column_1_2">
								<h1><?php echo get_the_title();?></h1>
								<?php 
									the_content();
								?>
								<div class="order-button">
									<a href="/cart/?add-to-cart=<?php echo get_the_id();?>&quantity=1" class="btn-green">Order </a>
								</div>
							</div>
						</div>
					</div>

					<div class="et_pb_section product-options">
						<div class="et_pb_row ">
								
							<div class="et_pb_column et_pb_column_2_3">
								<h1>Lorem Ipsum Dolor</h1>
								<div>

									consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
									labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum 
									dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim
									 id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium 

									 <br/><br/>

									 doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et 
									 quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas 
									 sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione 
									 voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, 
									 consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.
								</div>
							</div>

							<div class="et_pb_column et_pb_column_1_3">
									<div class="option-dropdown">
										<select>
											<option>Option 1 </option>
											<option>Option 2 </option>
										</select>
									</div>

									<div class="option-dropdown">
										<select>
											<option>Option 1 </option>
											<option>Option 2 </option>
										</select>
									</div>

									<div class="option-dropdown">
										<select>
											<option>Option 1 </option>
											<option>Option 2 </option>
										</select>
									</div>

									<div class="option-dropdown">
										<select>
											<option>Option 1 </option>
											<option>Option 2 </option>
										</select>
									</div>
							</div>

						</div>
					</div>


					<div class="et_pb_section">
						<div class="et_pb_row">
								<div class="et_pb_column et_pb_column_4_4 ">
									<h1>Related Box</h1>
									
									<div class="related-products-slider">
										<?php echo do_shortcode("[wpcs id='103']"); ?>
									</div>
									<div class="related-product-cols-mobile">
										<?php echo do_shortcode('[mobile_product_box_category hide_nav="1"]');?>
									</div>

								</div>
						</div>
					</div>

			<?php endwhile; ?>


	</div> <!-- .container -->


</div> <!-- #main-content -->

<?php get_footer(); ?>