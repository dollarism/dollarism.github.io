<?php

// Atts
if ( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}



extract( $atts );


$product_visibility_term_ids = wc_get_product_visibility_term_ids();

list( $query_args, $blog_query ) = vc_build_loop_query( $blog_query );

// Carousel Data
$carousel_data = array();

if ( $autoplay != '' ) {
	$carousel_data['data-autoplay'] = 'true';
}

if ( $slides_per_view !== '' ) {
	$carousel_data['data-slider-items'] = $slides_per_view;
}

$carousel_data['data-pagination'] = $show_pagination_control;
$carousel_data['data-navigation'] = $show_prev_next_buttons;
$carousel_data['data-loop'] = $wrap;





?>


<div class="blog-posts-holder">
    <?php if ( $blog_query->have_posts() ) : $i = 0; ?>

			<div class="owl-carousel" <?php echo studiare_get_inline_attrs( $carousel_data ); ?>>

  			<?php while( $blog_query->have_posts() ) : $blog_query->the_post(); ?>
					<div class="blog-loop-inner">
					<?php
                  get_template_part( '/inc/templates/blog/grid-postbit', get_post_format() );
                    ?>
					</div>
          <?php $i++; endwhile; ?>
				</div>
    <?php endif; ?>

</div>
<?php wp_reset_postdata(); ?>
