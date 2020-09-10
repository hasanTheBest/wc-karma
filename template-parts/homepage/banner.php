<?php
$karma_banner_products = karma_wp_query(-1, 'product_visibility', 'name', 'featured');

if(! $karma_banner_products->have_posts(  )){ return; }

?>
  <!-- start banner Area -->
  <section class="banner-area">
		<div class="container">
			<div class="row fullscreen align-items-center justify-content-start">
				<div class="col-lg-12">
					<div class="active-banner-slider owl-carousel">
						<?php while($karma_banner_products->have_posts(  )) : $karma_banner_products->the_post(  ); ?>
						<!-- single-slide -->
						<div class="row single-slide align-items-center d-flex">
							<div class="col-lg-5 col-md-6">
								<div class="banner-content">
									<h1><?php the_title(); ?></h1> 
									<?php the_excerpt(); ?>
									<div class="add-bag d-flex align-items-center">
										<a class="add-btn" href=""><span class="lnr lnr-cross"></span></a>
										<span class="add-text text-uppercase"><?php _e('Add to Bag', 'karma') ?></span>
									</div>
								</div>
							</div>
							<div class="col-lg-7">
								<div class="banner-img">
									<img class="img-fluid" src="<?php echo esc_url(get_the_post_thumbnail_url( get_the_Id(), 'full' )); ?>" alt="<?php the_title(); ?>">
								</div>
							</div>
						</div>
						<?php wp_reset_query; endwhile?>
						
					</div>
				</div>
			</div>
		</div>
  </section>
<!-- End banner Area --> 