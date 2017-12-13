<?php
/*
Template Name: Checkout Billing Shipping
*/

get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

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
	    padding-left: 20px;
	}
	.div-checkout-billing-shipping{
		text-align: left;
	}
	.input-group{
		margin-top: 20px;
	}

	@media only screen and (max-width: 414px)  {
		.input-text::-webkit-input-placeholder { /* Chrome/Opera/Safari */
	 	  font-size: 11px;
		}
		.input-text::-moz-placeholder { /* Firefox 19+ */
	 	  font-size: 11px;
		}
		.input-text:-ms-input-placeholder { /* IE 10+ */
	 	  font-size: 11px;
		}
		.input-text:-moz-placeholder { /* Firefox 18- */
	 	  font-size: 11px;
		}
		.input-text{
			 padding-left: 20px !important; 
		}
	}
	</style>

<div id="main-content">

<?php if ( ! $is_page_builder_used ) : ?>

	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">

<?php endif; ?>



			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content">
						<div class="et_pb_section  et_pb_section_0 et_section_regular">
							<div class=" et_pb_row et_pb_row_0">
								<div class="et_pb_column et_pb_column_4_4  et_pb_column_0">
									<div class="div-checkout-billing-shipping">
										<h1 style="text-align:center;border-bottom:1px solid #e6e6e6;padding-bottom:15px;">Billing & Shipping</h1>

										<h2 style="margin-top:54px">Billing Details</h2>

										<div class="input-group">
											<div>First Name</div>
											<input type="text" class="input-text" placeholder="First Name" style="margin-top:10px"> 
										</div>

										<div class="input-group">
											<div>Last Name</div>
											<input type="text" class="input-text" placeholder="Last Name" style="margin-top:10px"> 
										</div>

										<div class="input-group">
											<div>Address line 1</div>
											<input type="text" class="input-text" placeholder="#143 Suite 8, Lorem ipsum, London 3324" style="margin-top:10px"> 
										</div>

										<div class="input-group">
											<div>Address line 2</div>
											<input type="text" class="input-text" placeholder="#143 Suite 8, Lorem ipsum, London 3324" style="margin-top:10px"> 
										</div>


										<div class="input-group" style="display:table; width:100%">
											<div style="display:table-row">
												<div style="display:table-cell;padding-right:7px" >
													<div>Town/City</div>
													<input type="text" class="input-text" placeholder="Lorem ipsum" style="margin-top:10px"> 
										
												</div>

												<div style="display:table-cell;padding-left:7px">
													<div>Postcode</div>
													<input type="text" class="input-text" placeholder="3311" style="margin-top:10px"> 
									
												</div>

											</div> <!-- <div class="display:table-row"> -->
										</div> <!-- <div style="display:table"> -->

										<div class="input-group">
											<div>Contact</div>
											<input type="text" class="input-text" placeholder="James" style="margin-top:10px"> 
										</div>
										<div class="input-group">
											<div>Email Address</div>
											<input type="text" class="input-text" placeholder="james@gmail.com" style="margin-top:10px"> 
										</div>


										<h2 style="margin-top:54px">Shipping Address</h2>

										<div class="input-group">
											<div>First Name</div>
											<input type="text" class="input-text" placeholder="First Name" style="margin-top:10px"> 
										</div>

										<div class="input-group">
											<div>Last Name</div>
											<input type="text" class="input-text" placeholder="Last Name" style="margin-top:10px"> 
										</div>

										<div class="input-group">
											<div>Address line 1</div>
											<input type="text" class="input-text" placeholder="#143 Suite 8, Lorem ipsum, London 3324" style="margin-top:10px"> 
										</div>

										<div class="input-group">
											<div>Address line 2</div>
											<input type="text" class="input-text" placeholder="#143 Suite 8, Lorem ipsum, London 3324" style="margin-top:10px"> 
										</div>


										<div class="input-group" style="display:table; width:100%">
											<div style="display:table-row">
												<div style="display:table-cell;padding-right:7px">
													<div>Town/City</div>
													<input type="text" class="input-text" placeholder="Lorem ipsum" style="margin-top:10px"> 
										
												</div>

												<div style="display:table-cell;padding-left:7px">
													<div>Postcode</div>
													<input type="text" class="input-text" placeholder="3311" style="margin-top:10px"> 
									
												</div>

											</div> <!-- <div class="display:table-row"> -->
										</div> <!-- <div style="display:table"> -->

										<button type="button" class="btn btn-green" style="margin-top:20px; margin-bottom:40px;display:block;width:100%;padding-top:11px;">Proceed To Payment</button>


									</div>	 <!-- <div class="div-checkout-billing-shipping"> -->
								</div> <!-- <div class="et_pb_column et_pb_column_4_4  et_pb_column_0"> -->

							</div> <!-- <div class=" et_pb_row et_pb_row_0">-->
						</div> <!-- <div class="et_pb_section  et_pb_section_0 et_section_regular"> -->
					</div> <!-- <div class="entry-content"> -->
				</article> <!-- .et_pb_post -->

			<?php endwhile; ?>

<?php if ( ! $is_page_builder_used ) : ?>

			</div> <!-- #left-area -->

			<?php get_sidebar(); ?>
		</div> <!-- #content-area -->
	</div> <!-- .container -->

<?php endif; ?>

</div> <!-- #main-content -->



<!-- exclusions popup -->
<?php if(!empty($_GET["edit_exclusions"])):
	require_once "edit-exclusions.php";
endif; #<?php if(!empty($_GET["edit_exclusions"])):?> 
<!-- exclusions popup-->

<?php get_footer(); ?>