<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Karma 
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function karma_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'karma_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function karma_woocommerce_scripts() {
	wp_enqueue_style( 'karma-woocommerce-style', get_template_directory_uri() . '/woocommerce.css' );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'karma-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'karma_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function karma_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'karma_woocommerce_active_body_class' );

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function karma_woocommerce_products_per_page() {
	return 12;
}
add_filter( 'loop_shop_per_page', 'karma_woocommerce_products_per_page' );

/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function karma_woocommerce_thumbnail_columns() {
	return 4;
}
add_filter( 'woocommerce_product_thumbnails_columns', 'karma_woocommerce_thumbnail_columns' );

/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function karma_woocommerce_loop_columns() {
	return 3;
}
add_filter( 'loop_shop_columns', 'karma_woocommerce_loop_columns' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function karma_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'karma_woocommerce_related_products_args' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'karma_woocommerce_header_cart' ) ) {
			karma_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'karma_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function karma_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		karma_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'karma_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'karma_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function karma_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'karma' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'karma' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'karma_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function karma_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php karma_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}

/* Only markup design purposes */
add_filter('wp_calculate_image_srcset', '__return_empty_array');

/**
 * Remove default WooCommerce wrapper, breadcrumb, structured data.
 */
// if(!is_page_template('woocommerce/single-product.php')){
// 	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
// 	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
// 	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
// }
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

if ( ! function_exists( 'karma_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function karma_woocommerce_wrapper_before() {
		?>
		<main id="primary" class="content-area container">
			<div class="row">
			<?php
	}
}
add_action( 'woocommerce_before_main_content', 'karma_woocommerce_wrapper_before' );
add_action( 'woocommerce_before_main_content', 'woocommerce_get_sidebar', 15 );

if ( ! function_exists( 'karma_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function karma_woocommerce_wrapper_after() {
			?>
			</div><!-- .row -->
		</main><!-- .container -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'karma_woocommerce_wrapper_after' );

/* 
	BEFORE SHOP LOOP
	HOOK: woocommerce_before_shop_loop
*/
remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 );
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

// Sorting Bar wrapper start
if ( ! function_exists( 'karma_before_loop_content_product_bar_wrapper_start' ) ) {
	
	function karma_before_loop_content_product_bar_wrapper_start() {
		
		echo '<div class="filter-bar d-flex flex-wrap align-items-center">';
	}
}
add_action( 'karma_wc_before_loop_content_product', 'karma_before_loop_content_product_bar_wrapper_start', 1 );

// Sorting Bar wrapper end
if ( ! function_exists( 'karma_before_loop_content_product_bar_wrapper_end' ) ) {
	
	function karma_before_loop_content_product_bar_wrapper_end() {
		
		echo '</div>';
	}
}
add_action( 'karma_wc_before_loop_content_product', 'karma_before_loop_content_product_bar_wrapper_end', 9 );

// Catalog Ordering wrapper start
if ( ! function_exists( 'karma_sorting_bar_catalog_wrapper_start' ) ) {
	function karma_sorting_bar_catalog_wrapper_start() {
		echo '<div class="sorting">';
	}
}
add_action('karma_wc_before_loop_content_product', 'karma_sorting_bar_catalog_wrapper_start', 2);

// Catalog Ordering
add_action('karma_wc_before_loop_content_product', 'woocommerce_catalog_ordering', 3);

// Catalog Ordering wrapper end
if ( ! function_exists( 'karma_sorting_bar_catalog_wrapper_end' ) ) {
	function karma_sorting_bar_catalog_wrapper_end() {
		echo '</div>';
	}
}
add_action('karma_wc_before_loop_content_product', 'karma_sorting_bar_catalog_wrapper_end', 4);


// Product per page
if(! function_exists('karma_product_per_page')){
	function karma_product_per_page(){
		echo '<div class="sorting mr-auto">
						<select class="product-per-page">
							<option value="15">Show 15</option>
							<option value="20">Show 20</option>
							<option value="25">Show 25</option>
							<option value="30">Show 30</option>
							<option value="35">Show 35</option>
							<option value="45">Show 45</option>
							<option value="50">Show 50</option>
						</select>
					</div>';
	}
}
add_action('karma_wc_before_loop_content_product', 'karma_product_per_page', 5);

// Pagination wrapper start
if ( ! function_exists( 'karma_sorting_pagination_start' ) ) {
	function karma_sorting_pagination_start() {
		echo '<div class="pagination">';
	}
}
add_action('karma_wc_before_loop_content_product', 'karma_sorting_pagination_start', 6);

// Pagination
// 	$args = array(
//     'mid_size'           => 2,
//     'prev_next'          => true,
//     'prev_text'          => __('« Previous'),
//     'next_text'          => __('Next »'),
//     'type'               => 'plain',
//     'add_args'           => false,
//     'add_fragment'       => '',
//     'before_page_number' => '',
//     'after_page_number'  => ''
// );
// $karma_sorting_pagi = get_the_posts_pagination($args);

// function karma_sorting_pagination(){

// }

add_action('karma_wc_before_loop_content_product', 'woocommerce_pagination', 7);

// Pagination wrapper end
if ( ! function_exists( 'karma_sorting_pagination_end' ) ) {
	function karma_sorting_pagination_end() {
		echo '</div>';
	}
}
add_action('karma_wc_before_loop_content_product', 'karma_sorting_pagination_end', 8);

// Products Wrapper Start
if ( ! function_exists( 'karma_before_loop_content_product' ) ) {
	
	function karma_before_loop_content_product() {
		
		echo '<section class="lattest-product-area pb-40 category-list"><div class="row">';
	}
}
add_action( 'karma_wc_before_loop_content_product', 'karma_before_loop_content_product', 10 );

/* 
	AFTER SHOP LOOP
	HOOK: woocommerce_after_shop_loop
*/
remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );

// Products Wrapper Close
if ( ! function_exists( 'karma_after_loop_content_product' ) ) {

	function karma_after_loop_content_product() {
		echo '</div> <!-- .row --> ';
		echo '</section> <!-- .latest-product-area  -->';
	}
}
add_action( 'karma_wc_after_loop_content_product', 'karma_after_loop_content_product', 10 );

// Below content sorting bar wrapper start
if ( ! function_exists( 'karma_after_loop_content_product_bar_wrapper_start' ) ) {
	
	function karma_after_loop_content_product_bar_wrapper_start() {
		
		echo '<div class="filter-bar d-flex flex-wrap align-items-center">';
	}
}
add_action('karma_wc_after_loop_content_product', 'karma_after_loop_content_product_bar_wrapper_start', 12);

// Below content sorting bar wrapper end
if ( ! function_exists( 'karma_after_loop_content_product_bar_wrapper_end' ) ) {
	
	function karma_after_loop_content_product_bar_wrapper_end() {
		
		echo '</div>';
	}
}
add_action('karma_wc_after_loop_content_product', 'karma_after_loop_content_product_bar_wrapper_end', 18);

// Below Pagination bar->product per page
if(! function_exists('karma_below_product_per_page')){
	function karma_below_product_per_page(){
		echo '<div class="sorting mr-auto">
						<select class="product-per-page">
							<option value="15">Show 15</option>
							<option value="20">Show 20</option>
							<option value="25">Show 25</option>
							<option value="30">Show 30</option>
							<option value="35">Show 35</option>
							<option value="45">Show 45</option>
							<option value="50">Show 50</option>
						</select>
					</div>';
	}
}
add_action('karma_wc_after_loop_content_product', 'karma_below_product_per_page', 14);

// Below sorting bar Pagination wrapper start
if ( ! function_exists( 'karma_below_sorting_pagination_start' ) ) {
	function karma_below_sorting_pagination_start() {
		echo '<div class="pagination">';
	}
}
add_action('karma_wc_after_loop_content_product', 'karma_below_sorting_pagination_start', 15);

// Below sorting bar Pagination bar-> pagination 
add_action('karma_wc_after_loop_content_product', 'woocommerce_pagination', 16);

// Below sorting bar Pagination wrapper end
if ( ! function_exists( 'karma_below_sorting_pagination_end' ) ) {
	function karma_below_sorting_pagination_end() {
		echo '</div>';
	}
}
add_action('karma_wc_after_loop_content_product', 'karma_below_sorting_pagination_end', 17);

// Change default pagination
function karma_wc_pagination($args){
	$args['type'] = 'plain';

	return $args;
}
add_filter('woocommerce_pagination_args', 'karma_wc_pagination');

/* 
	SIDEBAR
	HOOK: woocommerce_sidebar
*/
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

/* 
	CONTENT PRODUCT
	HOOK: woocommerce_sidebar
*/
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);

// Product Details open
function karma_product_details_open(){
	echo '<div class="product-details">';
}
add_action('woocommerce_shop_loop_item_title', 'karma_product_details_open', 5);

add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 7);
add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 12);

// Product Details close
function karma_product_details_close(){
	echo '</div>';
}
add_action('woocommerce_after_shop_loop_item', 'karma_product_details_close', 15);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

// Product Detail Bottom open
function karma_prd_bottom_open(){
	echo '<div class="prd-bottom">';
}
add_action('woocommerce_after_shop_loop_item_title', 'karma_prd_bottom_open', 15);

// Add to cart button
add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 20);

function karma_add_to_cart_text($text){
	$text = __('Add to Bag', 'karma');
	return $text;
}
add_filter('woocommerce_product_add_to_cart_text', 'karma_add_to_cart_text');

// Product Detail Bottom close
function karma_prd_bottom_close(){
	echo '</div>';
}
add_action('woocommerce_after_shop_loop_item_title', 'karma_prd_bottom_close', 50);

// Product Details
// function karma_after_content_title(){
// 	echo '</div>';
// }
// add_action('woocommerce_shop_loop_item_title', 'karma_after_content_title', 5);

/* 
	CONTENT SINGLE PRODUCT
	HOOK: woocommerce_before_single_product
*/
/* 
function karma_single_product_image_area(){
	echo '<div class="product_image_area"><div class="container"><div class="row s_product_inner">';
}
add_action('woocommerce_before_single_product', 'karma_single_product_image_area', 20);

// single product image area wrapper end
function karma_single_product_image_area_end(){
	echo '</div></div></div>';
}
add_action('woocommerce_before_single_product_summary', 'karma_single_product_image_area_end', 30); */


function karma_single_product_image_area(){
	echo '<div class="product_image_area"><div class="container"><div class="row s_product_inner">';
}
add_action('woocommerce_single_before_main_content', 'karma_single_product_image_area', 20);

// single product summary entry wrapper
function karma_single_product_summary_wrapper(){
	echo '<div class="col-lg-5 offset-lg-1"><div class="s_product_text">';
}
add_action('woocommerce_single_product_summary', 'karma_single_product_summary_wrapper', 3);

// single product summary entry wrapper
function karma_single_product_summary_wrapper_end(){
	echo '</div></div>';
}
add_action('woocommerce_single_product_summary', 'karma_single_product_summary_wrapper_end', 70);

// single product image area wrapper end
function karma_single_product_image_area_end(){
	echo '</div></div></div>';
}
add_action('woocommerce_single_product_summary', 'karma_single_product_image_area_end', 80);

// single product description area
function karam_single_product_description_wrapper( ){
	echo '<section class="product_description_area"><div class="container">';
}
add_action('woocommerce_after_single_product_summary', 'karam_single_product_description_wrapper', 5);

// single product description area end
function karam_single_product_description_wrapper_end( ){
	echo '</section></div>';
}
add_action('woocommerce_after_single_product_summary', 'karam_single_product_description_wrapper_end', 12);

// single related_product  area
function karam_single_related_product_wrapper( ){
	echo '<section class="related-product-area section_gap_bottom"><div class="container"><div class="row justify-content-center">';
}
add_action('woocommerce_after_single_product_summary', 'karam_single_related_product_wrapper', 17);

// single related_product description area end
function karam_single_related_product_wrapper_end( ){
	echo '</section></div></div>';
}
add_action('woocommerce_after_single_product_summary', 'karam_single_related_product_wrapper_end', 30);

// single product meta
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

add_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 15);

/* function karam_product_specifications($heading){
	$heading = 'Specification';
	return $heading; 
}
add_filter('woocommerce_product_additional_information_heading', 'karam_product_specifications', 10); */
function karma_single_product_tabs($tabs){
	$tabs['additional_information']['title'] = __('Specification', 'karma');

	$tabs['comments']['title'] = __('Comments', 'karma');
	$tabs['comments']['priority'] = 40;
	$tabs['comments']['callback'] = __('karma_single_product_comments_callback', 'karma');

// echo '<pre>';print_r($tabs);echo '</pre>';

	return $tabs;
}
add_filter('woocommerce_product_tabs', 'karma_single_product_tabs');

function karma_single_product_comments_callback($para){
	$para =  'COMMENTS 	CONTENT HERE';
	echo $para;
}

if ( ! function_exists( 'karma_review_display_comment_text' ) ) {

	/**
	 * Display the review content.
	 */
	function karma_review_display_comment_text() {
		// echo '<div class="description">';
		comment_text();
		// echo '</div>';
	}
}

/* function karma_single_review_form($rf){
	echo '<pre>';print_r($rf);echo '</pre>';
	return $rf;
} */
//add_filter('woocommerce_product_review_comment_form_args', 'karma_single_review_form');

/* CHECKOUT PAGE */
function karma_checkout_before_customer_details(){
	echo '<div class="billing_details"><div class="row">';
}
add_action('woocommerce_checkout_before_customer_details', 'karma_checkout_before_customer_details');

/* function karma_checkout_after_customer_details(){
	echo '</div>';
}
add_action('woocommerce_checkout_after_customer_details', 'karma_checkout_after_customer_details');
 */
function karma_checkout_before_order_review_heading(){
	echo '<div class="col-lg-4"><div class="order_box">';
}
add_action('woocommerce_checkout_before_order_review_heading', 'karma_checkout_before_order_review_heading');

function karma_checkout_after_order_review(){
	echo '</div></div></div>'; /* col-lg-4 Row and billing details */
}
add_action('woocommerce_checkout_after_order_review', 'karma_checkout_after_order_review');
function karma_billing_form_field_text($field, $key, $args){
	$args['class'][] = ($key !== 'billing_company') ?  'col-md-6 form-group p_star' : 'col-md-12 form-group';
	$args['input_class'][] = 'form-control';
	$args['label_class'][] = 'placeholder';
	
	// echo '<pre>';print_r($args);echo '</pre>';

	return $field;
	return $key;
	return $args;
}
add_filter('woocommerce_form_field_text', 'karma_billing_form_field_text', 5, 3);















