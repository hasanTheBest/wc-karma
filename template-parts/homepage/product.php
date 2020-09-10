<?php

$karma_terms_theme_mod = get_theme_mod( 'latest_pro_cat', 'uncategorized');
$karma_terms_theme_mod = array_values(array_filter($karma_terms_theme_mod ));

if(!is_array($karma_terms_theme_mod)){return;}
?>
<!-- start product Area -->
<section class="owl-carousel active-product-area section_gap">

<?php foreach( $karma_terms_theme_mod as $ti) : 
	
	$term = get_term($ti);

	$name = $term->name;
	$slug = $term->slug;
	$description = $term->description;
	$permalink = get_term_link( $term->term_id );

$karma_latest_products = karma_wp_query(8, 'product_cat', 'slug', $slug);
?>


		<!-- single product slide -->
		
		<div class="single-product-slider">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6 text-center">
						<div class="section-title">
							<h1><a href="<?php echo esc_url($permalink); ?>"><?php echo esc_html($name); ?></a></h1>
							<p><?php echo wp_kses_post($description); ?></p>
							</div>
						</div>
					</div>
					<div class="row">

						<!-- single product -->
					<?php while($karma_latest_products->have_posts(  )) : $karma_latest_products->the_post(  ); 
					  $price = get_post_meta( get_the_ID(), '_price', true ); 
					  $regular_price = get_post_meta( get_the_ID(), '_regular_price', true ); 
					 ?>

					<div class="col-lg-3 col-md-6">
						<div class="single-product">
							<img class="img-fluid" src="<?php the_post_thumbnail_url( 'medium' ) ?>" alt="<?php the_title(); ?>">
							<div class="product-details">
								<h6><a href="<?php the_permalink(  ); ?>"><?php the_title(); ?></a></h6>
								<div class="price">
									<h6><?php echo esc_html( $price ); ?></h6>
									<h6 class="l-through"><?php echo esc_html($regular_price); ?></h6>
								</div>
								<div class="prd-bottom">

									<a href="" class="social-info">
										<span class="ti-bag"></span>
										<p class="hover-text"><?php _e('add to bag', 'karma'); ?></p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-heart"></span>
										<p class="hover-text"><?php _e('Wishlist', 'karma'); ?></p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-sync"></span>
										<p class="hover-text"><?php _e('compare', 'karma'); ?></p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-move"></span>
										<p class="hover-text"><?php _e('View More', 'karma'); ?></p>
									</a>
								</div>
							</div>
						</div>
					</div>

					<?php endwhile; wp_reset_query(); ?>

				</div> <!-- .row -->
			</div> <!-- .container -->
		</div> <!-- .single-product-slider -->
		
<?php endforeach; ?>

</section>
	<!-- end product Area -->