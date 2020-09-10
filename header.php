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
					<!-- <ul class="nav navbar-nav menu_nav ml-auto">
							<li class="nav-item active"><a class="nav-link" href="index.html">Home</a></li>
							<li class="nav-item submenu dropdown">
								<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
								 aria-expanded="false">Shop</a>
								<ul class="dropdown-menu">
									<li class="nav-item"><a class="nav-link" href="category.html">Shop Category</a></li>
									<li class="nav-item"><a class="nav-link" href="single-product.html">Product Details</a></li>
									<li class="nav-item"><a class="nav-link" href="checkout.html">Product Checkout</a></li>
									<li class="nav-item"><a class="nav-link" href="cart.html">Shopping Cart</a></li>
									<li class="nav-item"><a class="nav-link" href="confirmation.html">Confirmation</a></li>
								</ul>
							</li>
							<li class="nav-item submenu dropdown">
								<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
								 aria-expanded="false">Blog</a>
								<ul class="dropdown-menu">
									<li class="nav-item"><a class="nav-link" href="blog.html">Blog</a></li>
									<li class="nav-item"><a class="nav-link" href="single-blog.html">Blog Details</a></li>
								</ul>
							</li>
							<li class="nav-item submenu dropdown">
								<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
								 aria-expanded="false">Pages</a>
								<ul class="dropdown-menu">
									<li class="nav-item"><a class="nav-link" href="login.html">Login</a></li>
									<li class="nav-item"><a class="nav-link" href="tracking.html">Tracking</a></li>
									<li class="nav-item"><a class="nav-link" href="elements.html">Elements</a></li>
								</ul>
							</li>
							<li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
						</ul> -->
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
