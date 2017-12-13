<?php 
if(empty($hide_nav)):
?>
<h2 style="text-align:left">Product Box Category</h2>
<div class="product-category-container"> 
	<ul class="product">
		<li><a href="">Category 1 Product Box</a></li>
		<li><a href="">Category 1 Product Box</a></li>
		<li class="arrow-navigation">
			<a href="" class="arrow-left"><img src="<?php echo get_template_directory_uri();?>-child/images/product-category-arrow-left.jpg" /></a>
			<a href="" class="arrow-right"><img src="<?php echo get_template_directory_uri();?>-child/images/product-category-arrow-right.jpg" /></a>
		</li>
	</ul>
</div>
<?php 
endif;
?>

<?php 
if($twice) $loop = 2;
else $loop = 1;

for($x=1; $x <= $loop; $x++):

	$products = get_posts(array("post_type"=>"product", "posts_per_page"=>4));

	$i       = 0;
	$j       = 0;
	$grouped = array();
	foreach($products as $prod):
		$grouped[$j][$i] = $prod->ID;
		
		if($i==1){
			$i=0;
			$j++;
		}else{
			$i++;
		}
		
	endforeach;

	?>
	<div class="product-groups-tbl">
	<?php
	$_pf = new WC_Product_Factory();  

	foreach($grouped as $grouped_prods):
		?>
		<div class="product-groups-row">
		<?php
		foreach($grouped_prods as $prod_id):

			
				$product = $_pf->get_product($prod_id);
			?>
				<div class="product-group-cell">
					<div class="item">
				        <?php 
						$wpcs_thumb = get_post_thumbnail_id($prod_id);
						$wpcs_img_url = wp_get_attachment_url( $wpcs_thumb,'full' );
						$wpcs_img = aq_resize( $wpcs_img_url, $wpcs_crop_image_width, $wpcs_crop_image_height, true );		        	
				    	?>
				        	<div class="product_container">
				        		<div class="product_image_container">
						            <a id="id-<?php echo $prod_id; ?>" class="product_thumb_link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						            	
						            	<div style="
						            		background:url(<?php echo get_the_post_thumbnail_url($prod_id);?>);
						            		background-size:contain;
						            		background-position:center;
						            		width:148px;
						            		height:110px;
						            		background-repeat:no-repeat;
						            		margin:auto;
						            	">
						            		
						            	</div>
						            </a>
					        	</div>
					            <div class="caption">
					            	
						            <h3 class="product_name"><a id="id-<?php echo $prod_id; ?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo get_the_title($prod_id); ?></a></h3>
						            
						            <div class="product-description">
						            	<?php 
						            	$content = get_post($prod_id);
						            	echo  strip_tags( $content->post_content );
						            	?>
						            </div>
						            <div class="product-slider-category">

						            	<?php 
						            	$prod_cat = get_the_terms($prod_id, "product_cat" );
						            	echo $prod_cat[0]->name;
						            	?>

						            </div>
						            <?php

						            if ($wpcs_display_price == 'yes') { ?>
						              <span class="price"><?php echo $product->get_price_html(); ?></span>
						            <?php }
									$rating = (($product->get_average_rating()/5)*100); 

									?>
						              <div class="wpcs_rating woocommerce">
						              	<div class="review-text">Reviews</div>
						              	<div class="woocommerce-product-rating"> 
						              	<div class="star-rating" title="<?php echo $rating; ?>%"> <span style="width: <?php echo $rating; ?>%;" class="rating-yellow-star"></span></div></div>
						              	
						              	<div style="clear:both"> </div>

						              </div>
						           

						              <div class="cart">
						              		<a href="<?php echo do_shortcode('[add_to_cart_url id="'.get_the_ID().'"]') ?>" class="btn-green">
						              			Order
						              		</a>
						              </div>
					           		

					            </div>
				            </div> 

				        </div> <!-- <div class="item"> -->
				</div> <!-- <div class="product-group-cell"> -->
			<?php
		endforeach;
		?>
		</div>
		<?php
	endforeach;
	?>
	</div>

	<div class="load-more-related"><a href="">Load More Related Products</a></div>
<?php 
endfor; #for($x=1; $x <= $loop; $x++):
?>