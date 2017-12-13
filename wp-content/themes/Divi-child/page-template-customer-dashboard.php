<?php
/*
Template Name: Customer Dashboard
*/

get_header();

$is_page_builder_used = "on";


?>

<div id="main-content">

<?php if ( ! $is_page_builder_used ) : ?>

	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">

<?php endif; ?>

			<?php 
			while ( have_posts() ) : the_post();
				require_once $_SERVER[DOCUMENT_ROOT]."/wp-content/themes/Divi-child/customer-dashboard/main.php";
						
			endwhile; ?>

<?php if ( ! $is_page_builder_used ) : ?>

			</div> <!-- #left-area -->

			<?php get_sidebar(); ?>
		</div> <!-- #content-area -->
	</div> <!-- .container -->

<?php endif; ?>

</div> <!-- #main-content -->

<?php get_footer(); ?>