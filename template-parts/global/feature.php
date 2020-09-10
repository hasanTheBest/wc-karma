<?php if ( ! get_theme_mod( 'featues_switcher', false ) ) {
	return;
}

$karma_features = get_theme_mod('features_repeater', false);

if ( 'features_repeater' === false ) { return; }

?>
<!-- start features Area -->
<section class="features-area section_gap"> 
		<div class="container">
			<div class="row features-inner">
				
				<!-- single features -->
				<?php foreach($karma_features as $feature) : ?>
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="<?php echo esc_url($feature['feature_icon']); ?>" alt="<?php echo esc_attr($feature['feature_title']); ?>">
						</div>
						<h6><?php echo esc_html($feature['feature_title']); ?></h6>
						<p><?php echo esc_html($feature['feature_description']); ?></p>
					</div> 
				</div> <!-- .col-log-3 -->
				<?php endforeach; ?>

			</div> <!-- .row -->
		</div> <!-- .container -->
	</section> <!-- .feature-area -->
	<!-- end features Area -->
