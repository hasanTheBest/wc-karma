<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$xl = absint(wc_get_loop_prop( 'columns' )) * 3;
$lg = $xl - 1;
$md = $lg - 1;

if(! is_active_sidebar('sidebar-shop')){
	$xl = $lg = $md = 12;
}

?>

<div class="products col-xl-<?php echo esc_attr( $xl ); ?> col-lg-<?php echo esc_attr( $lg ); ?> col-md-<?php echo esc_attr( $md ); ?>">
