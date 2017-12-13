<?php
/*
Template Name: Recipe
*/

get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

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
					<?php
						the_content();

						if ( ! $is_page_builder_used )
							wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
					?>
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





<!-- Pop Up Post REcipe -->
<?php if(!empty($_GET["upload"])):?>
<div class="recipe-post-popup"
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
		<div class="contact-support-form"
			style="width: 950px;
				    background: #fff;
				    padding: 55px 65px 70px 65px;
				    margin: auto;
				    margin-bottom:100px;
				    position:relative;
			" 
			>
			<img class="close-post-recipe" onclick="hideRecipePop()" src="/wp-content/themes/Divi-child/images/contact-popup-close.jpg" style="position:absolute;right:17px;top:20px; cursor:pointer" />

			<h1 class="title-bordered">Post your recipe</h1>

			<div style="display:table" class="input-group recipe-form-table">
				<div style="display:table-row" class="row">
					
					<div class="cell" style="display:table-cell;vertical-align:top;width: 260px;padding-right: 20px;">
						<img src="/wp-content/themes/Divi-child/images/camera-icon.png" class="profile-photo" />
						<div style="
							    margin-top: 15px;
							    margin-bottom: 33px;
							    font-size:11px
							">Click to upload photo</div>

						<input type="text" class="input-text" value="Cooking Time" />

						<input type="text" class="input-text" value="Number of Serving" />

						<input type="text" class="input-text" value="Oven Temperature" />
					</div>

					<div class="cell" style="display:table-cell;vertical-align:top;padding-left:8px;">
						<input type="text" class="input-text" value="Recipe Title" />
						<textarea class="input-text" style="font-size:14px;height:176px">Description and Recipe Introduction&#13;Why do you like this recipe? When do you and your family like to eat it? Share your comments here...</textarea>

						<textarea class="input-text" style="font-size:14px;height:114px">Ingredients&#13;Put each ingredient on its own line with the required quantity
						</textarea>

						<textarea class="input-text" style="font-size:14px;height:114px">Direction&#13;Put each step on its own line
						</textarea>

						<div class="confirmation-box-container" style="font-size:14px; font-style:italic;margin:30px 0px 70px 0px; padding-bottom:40px;">
							<label class="custom-radio pull-left">
								<input type="checkbox" >
							</label>
							<div class="pull-left confirmation-checkbox"
								style="
								    width: 490px;
								    margin-left: 20px;
								"
							>
								This is my own recipe and I have permission to publish it and any images. I agree to Pumpkin Squash Limited using this recipe and photography for marketing and commercial purposes.
							</div>
						</div>	
						<br clear="all" />
						<div class="clearfix"> </div>
					</div>
					
				</div>
			</div>

			<button class="btn-green" style="position:absolute;right:0px;bottom:0px">Publish</button>
		</div>
	</div>

</div>
<script type="text/javascript">
	jQuery("body").css({"overflow":"hidden"});
	jQuery(document).ready(function(){
		hideRecipePop = function(){
			jQuery(".recipe-post-popup").fadeOut();
			jQuery("body").css({"overflow":"auto"});
		}
	});
</script>
<?php endif;#<?php if(!empty($_GET["upload"])):?>
<!-- End Pop Up post Recipe-->

<?php get_footer(); ?>