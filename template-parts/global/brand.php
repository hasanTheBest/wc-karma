<?php 

if ( ! get_theme_mod( 'brand_switcher', false ) ) { return; }

$karma_brands = get_theme_mod('brands_repeater', false);

if ( 'brands_repeater' === false ) { return; }

?>
<!-- Start brand Area -->
<section class="brand-area section_gap">
	<div class="container">
		<div class="row">

			<!-- single brand -->
			<?php foreach($karma_brands as $brand) : ?>
			<a class="col single-img" href="<?php echo esc_url($brand['brand_url']); ?>" title="<?php echo esc_attr($brand['brand_title']); ?>">
				<img class="img-fluid d-block mx-auto" src="<?php echo esc_url($brand['brand_img']); ?>" alt="<?php echo esc_attr($brand['brand_title']); ?>">
			</a>
			<?php endforeach; ?>

		</div> <!-- .row -->
	</div>
</section>
<!-- End brand Area -->