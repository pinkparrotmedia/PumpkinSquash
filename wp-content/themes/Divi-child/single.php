<?php

get_header();

get_header();

$is_page_builder_used = 1;

?>

<div id="main-content">

<?php if ( ! $is_page_builder_used ) : ?>

	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">

<?php endif; ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php if ( ! $is_page_builder_used ) : ?>

					<h1 class="entry-title main_title"><?php the_title(); ?></h1>
				<?php
					$thumb = '';

					$width = (int) apply_filters( 'et_pb_index_blog_image_width', 1080 );

					$height = (int) apply_filters( 'et_pb_index_blog_image_height', 675 );
					$classtext = 'et_featured_image';
					$titletext = get_the_title();
					$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Blogimage' );
					$thumb = $thumbnail["thumb"];

					if ( 'on' === et_get_option( 'divi_page_thumbnails', 'false' ) && '' !== $thumb )
						print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height );
				?>

				<?php endif; ?>

					<div class="entry-content">

						<div class="et_pb_section et_pb_fullwidth_section  et_pb_section_0 et_section_regular fullwidth-image">
								
							<div class="et_pb_module et-waypoint et_pb_fullwidth_image et_pb_animation_left  et_pb_fullwidth_image_0">
								<?php /*								
								<img src="<?php echo get_the_post_thumbnail_url(get_the_id(), "full");?>" alt="">
								*/?>
								<div 
								class= "single-blog-post";
								style="
									background:url('<?php echo get_the_post_thumbnail_url(get_the_id(), "full");?>');
								">

								</div>
							</div>
							
						</div> <!-- .et_pb_fullwidth_section header -->
						
						<h1 class="single-post-title"><?php the_title()?></h1>

						<div class="et_pb_section single-post-content">
							<div class="et_pb_row">
								<div class="et_pb_column et_pb_column_main_content"> 
									<div class="main-content">
										<?php
											the_content();
										?>

										<div class="single-post-social">
											<div class="tbl-container">
												<div class="row">
													<div class="cell share-text">
															Share 
													</div>
													<?php 
													$share_url = get_permalink( get_the_id() );
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
										</div>


									</div> <!-- <div class="main-content"> -->
								</div> <!-- <div class="et_pb_column ">  -->
							</div> <!-- <div class="et_pb_row"> -->

							<div class="similar-topics et_pb_row">
								<h1 class="section_title">Similar Posts</h1>

								<?php 
								$category = get_the_category();

								$similar_posts = get_posts(array("category"     =>$category[0]->term_id,
																"posts_per_page"=> 3,
																"post__not_in"  => array( get_the_id() ) ));
								
								foreach($similar_posts as $post):
									$post_link = get_permalink($post->ID);
									?>
									<div class="et_pb_column et_pb_column_1_3 similar-topic-post">
										<?php 

										$thumbnail_url = get_the_post_thumbnail_url($post->ID,"medium");
										?>	

										<div style="
											background:url(<?php echo $thumbnail_url?>);
											background-size:cover;
											min-height:317px;
											width:100%;
										">

										</div>
										<h2><?php echo $post->post_title;?></h2>
										<div class="post-author"> By Jame Smith</div>
										<div class="content">
											<?php echo $post->post_content;?>
										</div>

										<div class="et_pb_row readmore">
											<div class="et_pb_column et_pb_column_1_2 readmore-button">
												<a href="<?php echo $post_link;?>" class="btn-green">Read More</a>
											</div>

											<div class="et_pb_column et_pb_column_1_2">
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
									</div> <!--  et_pb_column_1_3 -->
									<?php 
								endforeach;
								?>
								
							</div>  <!-- .<div class="similar-topics"> -->


						</div> <!-- <div class="et_pb_section single-post-content"> -->


						<div class="et_pb_section comment-section">
							<div class="et_pb_row">
								<div class="comments-section-container">
									<h1 class="section-title">Comments</h1>
									<?php 
									$comments[0]["img"] = "/wp-content/themes/Divi-child/images/comment-profile-1.png";
									$comments[0]["name"] = "Sarah Lawton";
									$comments[0]["content"] = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex";
									
									$comments[1]["img"] = "/wp-content/themes/Divi-child/images/comment-profile-2.png";
									$comments[1]["name"] = "James Smith";
									$comments[1]["content"] = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex";
									
									$comments[2]["img"] = "/wp-content/themes/Divi-child/images/comment-profile-3.png";
									$comments[2]["name"] = "James Smith";
									$comments[2]["content"] = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex";
									

									foreach($comments as $comment):
									?>
									<div class="comment-container">
										<div class="tbl-comment">
											<div class="row">
												<div class="cell profile-picture">
													<img src="<?php echo $comment["img"];?>"/>
												</div>

												<div class="cell comment-content">
													<h3>
														<?php echo $comment["name"];?>
													</h3>
													<div><?php echo $comment["content"];?></div>
												</div>
											</div>
										</div>
									</div>
									<?php
									endforeach;
									?>

									<textarea class="input-comment" placeholder="Message"></textarea>
									<div class="submit-cooment-section" >
											<button class="btn-dark">Submit</button>
									</div>
								</div>
							</div> <!-- <div class="et_pb_row"> -->
						</div> <!-- et_pb_section comment-section -->

					</div> <!-- .entry-content -->

				<?php
					if ( ! $is_page_builder_used && comments_open() && 'on' === et_get_option( 'divi_show_pagescomments', 'false' ) ) comments_template( '', true );
				?>

				</article> <!-- .et_pb_post -->

			<?php endwhile; ?>

<?php if ( ! $is_page_builder_used ) : ?>

			</div> <!-- #left-area -->

			<?php get_sidebar(); ?>
		</div> <!-- #content-area -->
	</div> <!-- .container -->

<?php endif; ?>

</div> <!-- #main-content -->

<?php get_footer(); ?>