<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Karma  
 */

get_header();

	get_template_part('/template-parts/homepage/banner');
	get_template_part('/template-parts/global/feature');
	get_template_part('/template-parts/homepage/product-category');
	get_template_part('/template-parts/homepage/product');
	get_template_part('/template-parts/global/exclusive-deal');
	get_template_part('/template-parts/global/brand');
	get_template_part('/template-parts/global/related-products');

	
	
get_footer();
