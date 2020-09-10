<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Karma
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<!-- Favicon
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/fav.png">
	-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<!-- Start Header Area -->
	<header class="header_area sticky-header">
		<div class="main_menu">
			<nav class="navbar navbar-expand-lg navbar-light main_box">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->

						<?php if(has_custom_logo(  )) :
						$karma_custom_logo = get_custom_logo(  );
						$karma_custom_logo = str_replace('custom-logo-link', 'navbar-brand logo_h custom-logo-link', $karma_custom_logo);
						echo $karma_custom_logo;
						else : ?>
						<a class="navbar-brand logo_h" href="<?php home_url( '/'); ?>">
						<?php bloginfo( 'name' )?>
						</a>
						<?php endif; ?>

					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
					<?php 
						$karma_nav_menu = wp_nav_menu( array(
							'container' => '',
							'theme_location' => 'menu-1',
							'menu_class'		=> 'nav navbar-nav menu_nav ml-auto',
							'echo' => false
						) );

						$karma_nav_menu = str_replace('class="menu-item', 'class="menu-item nav-item', $karma_nav_menu);
						$karma_nav_menu = str_replace('current-menu-item', 'active', $karma_nav_menu);
						$karma_nav_menu = str_replace('menu-item-has-children', 'menu-item-has-children submenu dropdown', $karma_nav_menu);
						$karma_nav_menu = str_replace('sub-menu', 'sub-menu dropdown-menu', $karma_nav_menu);
						$karma_nav_menu = str_replace('<a', '<a class="nav-link"', $karma_nav_menu);
						echo $karma_nav_menu;
					?>	
						<ul class="nav navbar-nav navbar-right">
							<li class="nav-item"><a href="#" class="cart"><span class="ti-bag"></span></a></li>
							<li class="nav-item">
								<button class="search"><span class="lnr lnr-magnifier" id="search"></span></button>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</div>
		<!-- Search  -->
		<?php get_search_form(  ); ?>
		
	</header>
	<!-- End Header Area -->
		<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
						<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
					<?php endif; ?>
					<header class="woocommerce-products-header">
					<?php
					/**
					 * Hook: woocommerce_archive_description.
					 *
					 * @hooked woocommerce_taxonomy_archive_description - 10
					 * @hooked woocommerce_product_archive_description - 10
					 */
					do_action( 'woocommerce_archive_description' );
					?>
				</header>
					<nav class="d-flex align-items-center">
						<a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">Shop<span class="lnr lnr-arrow-right"></span></a>
						<a href="category.html">Fashon Category</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->
	
	
