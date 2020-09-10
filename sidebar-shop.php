<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Karma
 */

if ( ! is_active_sidebar( 'sidebar-shop' ) ) {
	return;
}

$xl = 12 - (absint(wc_get_loop_prop( 'columns' )) * 3);
$lg = $xl + 1;
$md = $lg + 1;

?>
<aside id="secondary" class="widget-area col-xl-<?php echo esc_attr($xl);?> col-lg-<?php echo esc_attr($lg);?> col-md-<?php echo esc_attr($md);?>">
	<?php dynamic_sidebar('sidebar-shop'); ?>
</aside><!-- #secondary -->
