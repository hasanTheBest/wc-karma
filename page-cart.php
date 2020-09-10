<?php 
/* Template Name: Checkout Page */
get_header();
?>

<!--================Checkout Area =================-->
<section class="checkout_area section_gap">
    <div class="container">
      <?php
      while ( have_posts() ) :
        the_post();
        the_content();
      endwhile; // End of the loop.
      ?>
    </div><!-- container -->
</section><!-- checkout_area -->
<!--================End Checkout Area =================-->

<?php get_footer();?>