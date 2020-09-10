<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Karma
 */

if ( ! function_exists( 'karma_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function karma_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'karma' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'karma_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function karma_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'karma' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'karma_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function karma_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'karma' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'karma' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'karma' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'karma' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'karma' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'karma' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'karma_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function karma_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail( 'post-thumbnail', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
			?>
		</a>

		<?php
		endif; // End is_singular().
	}
endif;

// Karma Product Categories 
if(! function_exists('karma_product_cats')){

	function karma_product_cats($taxonomy = 'product_cat', $orderby = 'name', $order = 'ASC', $parent = 0){
	
		$args = [];
	
		$args['taxonomy'] = $taxonomy;
		$args['orderby'] = $orderby;
		$args['order'] = $order;
		$args['parent'] = $parent;
		
		$karma_product_cat = get_terms( $args );
		
		if(!is_array($karma_product_cat)){ return 0;}
		
		$karma_single_deal = [];
		$karma_single_deal_term = [];
		$single_deal_markup = [];
		
		for($i = 0; $i<count($karma_product_cat); $i++) :

		$thumb_id = get_term_meta( $karma_product_cat[$i]->term_id, 'thumbnail_id', true );
		$thumb_url = wp_get_attachment_url( $thumb_id );
		// $thumb_url = wp_get_attachment_thumb_url( $thumb_id );

		$karma_single_deal_term[$i]['name'] = $karma_product_cat[$i]->name;
		$karma_single_deal_term[$i]['img_src'] = $thumb_url;
		$karma_single_deal_term[$i]['permalink'] = get_term_link( $karma_product_cat[$i]);
		
		$karma_single_deal[$i] = $karma_single_deal_term[$i];

		$permalink = $karma_single_deal[$i]['permalink'];
		$img_src = $karma_single_deal[$i]['img_src'];
		$name = $karma_single_deal[$i]['name'];
		
		$single_deal_markup[$i] = '<div class="single-deal">
		<a href="'.esc_url($img_src).'" class="img-pop-up" target="_blank"><div class="overlay"></div></a>
		<img class="img-fluid w-100" src="'.esc_url($img_src).'" alt="'.esc_attr($name).'">
		<a href="'.esc_url($permalink).'" target="_blank">
			<div class="deal-details"><h6 class="deal-title">'.esc_html($name).'</h6></div>
		</a>
		</div>';
		
		endfor;
	
		return $single_deal_markup;
	}
	
}


/* function karma_product_terms($taxonomy = 'product_cat', $orderby= 'name', $order = 'ASC', $parent = 0){
// Product Categories
$args = [];

$args['taxonomy'] = $taxonomy;
$args['orderby'] = $orderby;
$args['order'] = $order;
$args['parent'] = $parent;

$karma_product_terms = get_terms($args);
$terms = [];

foreach($karma_product_terms as $term ){
	$terms[$term->slug] = $term->name. '['. $term->count .']';
}

return $terms;
}
 */
