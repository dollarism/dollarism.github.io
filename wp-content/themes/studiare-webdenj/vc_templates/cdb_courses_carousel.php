<?php

global $product;

// Atts
if ( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}



extract( $atts );

// Element Class
$class = 'portfolio-container conatiner portfolio-layout-';
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );

// Portfolio Holder Class
$portfolio_holder_class = array('portfolio-holder clearfix');

$product_visibility_term_ids = wc_get_product_visibility_term_ids();
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



$args = array(
	'post_type' => 'product',
	'posts_per_page' => $posts_per_page,
	'orderby' => $orderby,
	'meta_query'     => array(),
	'tax_query'      => array(
		'relation' => 'AND',
	),
);

$args['meta_query'][] = array(
	'key'     => '_price',
	'value'   => 0,
	'compare' => '>=',
	'type'    => 'DECIMAL',
);

switch ( $courses_type ) {
		case 'featured':
			$args['tax_query'][] = array(
				'taxonomy' => 'product_visibility',
				'field'    => 'term_taxonomy_id',
				'terms'    => $product_visibility_term_ids['featured'],
			);
			break;
		case 'onsale':
			$product_ids_on_sale    = wc_get_product_ids_on_sale();
			$product_ids_on_sale[]  = 0;
			$args['post__in'] = $product_ids_on_sale;
			break;
	}

switch ( $orderby ) {
		case 'price':
			$args['meta_key'] = '_price';
			$args['orderby']  = 'meta_value_num';
			break;
		case 'sales':
			$args['meta_key'] = 'total_sales';
			$args['orderby']  = 'meta_value_num';
			break;
		default:
			$args['orderby'] = $orderby;
	}

	if ( !empty( $courses_cat_include ) ) {
			$cat_include = array();
			$courses_cat_include = explode( ',', $courses_cat_include );
			foreach ( $courses_cat_include as $category ) {
				$term = term_exists( $category, 'product_cat' );
				if ($term !== 0 && $term !== null) {
					$cat_include[] = $term['term_id'];
				}
			}
			if ( ! empty( $cat_include ) ) {
				$args['tax_query'][] =array(
					'taxonomy' => 'product_cat',
					'terms' => $cat_include,
					'operator' => 'IN',
				);
			}
		}

$products_query = new WP_Query( $args );

?>


<div class="products courses-holder">
    <?php if ( $products_query->have_posts() ) : $i = 0; ?>

			<div class="owl-carousel" <?php echo studiare_get_inline_attrs( $carousel_data ); ?>>

  			<?php while( $products_query->have_posts() ) : $products_query->the_post(); ?>
					<?php
                    get_template_part( 'woocommerce/content', 'product-carousel' );
                    ?>
          <?php $i++; endwhile; ?>
				</div>
    <?php endif; ?>

</div>
<?php wp_reset_postdata(); ?>
