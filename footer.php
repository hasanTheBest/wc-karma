<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Karma
 */

?>



</body>
</html>
<!-- start footer Area -->
<footer class="footer-area section_gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-3  col-md-6 col-sm-6">
					<?php 
					if(is_active_sidebar('footer-about_us')){
						dynamic_sidebar('footer-about_us');
					}
					?>
				</div>
				<div class="col-lg-4  col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<?php 
						if(is_active_sidebar('footer-newsletter')){
							dynamic_sidebar('footer-newsletter');
						}
						?>
					</div>
				</div>
				<div class="col-lg-3  col-md-6 col-sm-6">
					<div class="single-footer-widget mail-chimp">
						<?php 
						if(is_active_sidebar('footer-instagram')){
							dynamic_sidebar('footer-instagram');
						}
						?>
					</div>
				</div>
				<div class="col-lg-2 col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<?php 
						if(is_active_sidebar('footer-follow_us')){
							dynamic_sidebar('footer-follow_us');
						}
						?>
					</div>
				</div>
			</div>
			<div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
				<?php 
				if(is_active_sidebar('footer-copyright')){
					dynamic_sidebar('footer-copyright');
				}
				?>		
			</div>
		</div>
	</footer>
	<!-- End footer Area -->

	<?php wp_footer(); ?>
</body>

</html>

