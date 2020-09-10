<?php
// $karma_cat_name = [];
$karma_hot_cat_id = get_theme_mod('hot_deal_cat', 0);

if( $karma_hot_cat_id === 0){ return; }

$karma_hot_cat = get_term($karma_hot_cat_id);

$karma_exclusive_products = karma_wp_query(-1, 'product_cat', 'slug', $karma_hot_cat->slug);

if(! $karma_exclusive_products->have_posts(  )){ return; }

$karma_time_title = get_theme_mod('edt_title', __('Exclusive Hot Deal Ends Soon!', 'karma'));
$karma_time_subtitle = get_theme_mod('edt_subtitle', __('Who are in extremely love with eco friendly system.', 'karma'));
$karma_time_days = get_theme_mod('edt_days', __('10', 'karma'));
$karma_time_hours = get_theme_mod('edt_hours', __('23', 'karma'));
$karma_time_minutes = get_theme_mod('edt_mins', __('47', 'karma'));
$karma_time_seconds = get_theme_mod('edt_secs', __('59', 'karma'));
?>
<!-- Start exclusive deal Area --> 
<section class="exclusive-deal-area">
		<div class="container-fluid">
			<div class="row justify-content-center align-items-center">
				<div class="col-lg-6 no-padding exclusive-left">
					<div class="row clock_sec clockdiv" id="clockdiv">
						<div class="col-lg-12">
							<h1><?php echo esc_html($karma_time_title); ?></h1>
							<p><?php echo esc_html($karma_time_subtitle); ?></p>
						</div>
						<div class="col-lg-12">
							<div class="row clock-wrap">
								<div class="col clockinner1 clockinner">
									<h1 class="days"><?php echo esc_html($karma_time_days); ?></h1>
									<span class="smalltext"><?php _e('Days', 'karma'); ?></span>
								</div>
								<div class="col clockinner clockinner1">
									<h1 class="hours"><?php echo esc_html($karma_time_hours); ?></h1>
									<span class="smalltext"><?php _e('Hours', 'karma'); ?></span>
								</div>
								<div class="col clockinner clockinner1">
									<h1 class="minutes"><?php echo esc_html($karma_time_minutes); ?></h1>
									<span class="smalltext"><?php _e('Mins', 'karma'); ?></span>
								</div>
								<div class="col clockinner clockinner1">
									<h1 class="seconds"><?php echo esc_html($karma_time_seconds); ?></h1>
									<span class="smalltext"><?php _e('Secs', 'karma'); ?></span>
								</div>
							</div>
						</div>
					</div>
					<a href="<?php echo bloginfo(home_url('/shop')); ?>" class="primary-btn"><?php _e('Shop Now', 'karma'); ?></a>
				</div>

			<div class="col-lg-6 no-padding exclusive-right">
					<div class="active-exclusive-product-slider">

					<!-- single exclusive carousel -->
					<?php while($karma_exclusive_products->have_posts()) : $karma_exclusive_products->the_post(); ?>
						<div class="single-exclusive-slider">
							<img class="img-fluid" src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'medium')); ?>" alt="<?php the_title(); ?>">
							<div class="product-details">
								<div class="price">
									<h6><?php echo get_post_meta(get_the_ID(), '_price', true) ?></h6>
									<h6 class="l-through"><?php echo get_post_meta(get_the_ID(), '_regular_price', true) ?></h6>
								</div>
								<h4><?php the_title() ?></h4>
								<div class="add-bag d-flex align-items-center justify-content-center">
									<a class="add-btn" href=""><span class="ti-bag"></span></a>
									<span class="add-text text-uppercase"><?php _e('Add to Bag', 'karma'); ?></span>
								</div>
							</div>
						</div>
					<?php endwhile; wp_reset_query(); ?>

					</div>
				</div>

			</div>
		</div>
	</section>
	<!-- End exclusive deal Area -->