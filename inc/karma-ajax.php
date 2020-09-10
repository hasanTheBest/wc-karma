<?php

// $karma_pp = 20;

function karma_product_pp(){
  $karma_ppp = $_GET['ppp'];
  echo $karma_ppp;
  
  die();
}
add_action('wp_ajax_product_pp', 'karma_product_pp');
add_action('wp_ajax_nonpriv_product_pp', 'karma_product_pp');

/* function karma_product_pp_set( $query ) {
  global $karma_pp;
    if ( ! is_admin() && $query->is_main_query() && is_post_type_archive( 'product' ) ) {
      // Display 50 posts for a custom post type called 'movie'
      $query->set( 'posts_per_page', $karma_ppp );
      return;
    }
  }
  add_action( 'pre_get_posts', 'karma_product_pp_set', 1 ); */

