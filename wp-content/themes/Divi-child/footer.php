<?php if ( 'on' == et_get_option( 'divi_back_to_top', 'false' ) ) : ?>

	<span class="et_pb_scroll_top et-pb-icon"></span>

<?php endif;

if ( ! is_page_template( 'page-template-blank.php' ) ) : 
			?>
			<footer id="main-footer" class="footer-desktop">
				<div class="container">
					<div class="container-table">
						<div class="footer-section section-1">
							<?php dynamic_sidebar( 'sidebar-2' ); ?>
							<div style="clear:both"> </div>
						</div>

						<div class="footer-section section-2">
							
							<div style="display:table;width:100%;">
								<div style="display:table-cell;width:50%" class="footer-menu-container">
									<h5>Category</h5>
									Lorem Ipmsum Dolor <br/>
									Lorem Ipmsum Dolor <br/>
									Lorem Ipmsum Dolor <br/>
									Lorem Ipmsum Dolor <br/>
									Lorem Ipmsum Dolor <br/>
									Lorem Ipmsum Dolor <br/>
								</div>

								<div style="display:table-cell;width:50%" class="footer-menu-container">
									<h5>Partners</h5>
									Lorem Ipmsum Dolor <br/>
									Lorem Ipmsum Dolor <br/>
									Lorem Ipmsum Dolor <br/>
									Lorem Ipmsum Dolor <br/>
									Lorem Ipmsum Dolor <br/>
									Lorem Ipmsum Dolor <br/>
								</div>

							</div>
						</div>

						<div class="footer-section section-3" class="footer-menu-container">
							<h5>Lorem Ipsum</h5>
							Lorem Ipmsum Dolor <br/>
							Lorem Ipmsum Dolor <br/>
							Lorem Ipmsum Dolor <br/>
							Lorem Ipmsum Dolor <br/>
							Lorem Ipmsum Dolor <br/>
							Lorem Ipmsum Dolor <br/>
						</div>



					</div>
				</div>

			</footer> <!-- #main-footer -->


			<footer class="footer-mobile" style="display:none">
					<?php dynamic_sidebar( 'sidebar-3' ); ?>
			</footer> <!-- <footer class="footer-mobile"> -->

		</div> <!-- #et-main-area -->

<?php endif; // ! is_page_template( 'page-template-blank.php' ) ?>

	</div> <!-- #page-container -->

	<?php 
	require_once "modal.php";
	?>

	<?php wp_footer(); ?>


	<script type="text/javascript">
	jQuery(document).on("change","input[type=checkbox]",function(){
		if( jQuery(this).is(":checked") ){
			isChecked = true;
			jQuery(this).parent().addClass("checked");
		}else{
			isChecked = false;
			jQuery(this).parent().removeClass("checked");
		}
		
	});
	</script>

</body>
</html>