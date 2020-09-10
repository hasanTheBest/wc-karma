<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>

<section class="related-product-area section_gap_bottom related products">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-6 text-center">
					<div class="section-title">
						<h1><?php esc_html_e( 'Deals of the Week', 'woocommerce' ); ?></h1>
          </div>
				</div>
      </div> <!-- .row -->
      <div class="row">
      <?php // woocommerce_product_loop_start(); ?>

        <?php foreach ( $related_products as $related_product ) : ?>

          <?php
            $post_object = get_post( $related_product->get_id() );

            setup_postdata( $GLOBALS['post'] =& $post_object );

            wc_get_template_part( 'content', 'product' ); ?>

        <?php endforeach; ?>

      <? // woocommerce_product_loop_end(); ?>
    </div> <!-- .row -->
  </div> <!-- .container -->
</section>

<?php endif;

wp_reset_postdata();
