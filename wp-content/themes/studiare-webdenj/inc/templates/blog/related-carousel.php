<?php

$args = '';
$post_id = $post->ID;
$item_cats = get_the_terms($post_id, 'category');
if ($item_cats) :
  foreach($item_cats as $item_cat) {
    $item_array[] = $item_cat->term_id;
  }
endif;

$args = array(
  'category__in' => wp_get_post_categories( $post->ID ),
  'posts_per_page' => 6,
  'post__not_in' => array( $post->ID ),
);

$query = new WP_Query($args);

?>

<?php if($query->have_posts()): ?>

	<div class="product-reviews">
			<div class="product-review-title">
	       <i class="fal fa-folders"></i> <h3 class="inner">مطالب زیر را حتما مطالعه کنید</h3>
	    </div>

			<div class="product-reviews-inner">
					<div class="blog-posts-holder">
							<div class="owl-carousel" data-autoplay="true" data-slider-items="3" data-pagination="true" data-navigation="true" data-loop="false">

                  <?php	 while($query->have_posts()): $query->the_post(); ?>
                    <div class="blog-loop-inner">
                      <?php get_template_part( '/inc/templates/blog/grid-related', get_post_format() ); ?>
                    </div>
									<?php endwhile; ?>
							</div>
					</div>
			</div>
	</div>



<?php endif;
wp_reset_postdata();
