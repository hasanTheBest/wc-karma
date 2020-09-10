<?php

$karma_cat_single_deal_markup = karma_product_cats('product_cat', 'count', 'DESC');
if($karma_cat_single_deal_markup === 0){return;}

?>

	<!-- Start category Area -->
	<section class="category-area">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8 col-md-12">
					<div class="row">
						<div class="col-lg-8 col-md-8">
							<?php echo $karma_cat_single_deal_markup[0] ; ?>	
						</div>
						<div class="col-lg-4 col-md-4">
						<?php echo $karma_cat_single_deal_markup[1]; ?>	
						</div>
						<div class="col-lg-4 col-md-4">
						<?php echo $karma_cat_single_deal_markup[2]; ?>	
						</div>
						<div class="col-lg-8 col-md-8">
						<?php echo $karma_cat_single_deal_markup[3]; ?>	
						</div>
					</div> <!-- .row -->
				</div> <!-- .col-lg-8 -->
				<div class="col-lg-4 col-md-6">
				<?php echo $karma_cat_single_deal_markup[4]; ?>	
				</div> <!-- .col-lg-4 -->
			</div> <!-- .row .justify-content-center-->
		</div>
	</section>
	<!-- End category Area -->