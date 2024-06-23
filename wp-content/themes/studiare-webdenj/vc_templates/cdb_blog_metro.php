<?php

// Atts
if ( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );

// Element Class
$class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );



$args = array(
	'post_type' => 'post',
	'posts_per_page' => 1,
	'meta_query'     => array(),
	'cat'      => array(
		'relation' => 'AND',
	),
);

$args2 = array(
	'post_type' => 'post',
	'posts_per_page' => 2,
	'offset' => 1,
	'meta_query'     => array(),
	'cat'      => array(
		'relation' => 'AND',
	),
);

if ( !empty( $metro_cat_include ) ) {
		$cat_include = array();
		$metro_cat_include = explode( ',', $metro_cat_include );
		foreach ( $metro_cat_include as $category ) {
			$term = term_exists( $category, 'category' );
			if ($term !== 0 && $term !== null) {
				$cat_include[] = $term['term_id'];
			}
		}
		if ( ! empty( $cat_include ) ) {
			$args['tax_query'][] =array(
				'taxonomy' => 'category',
				'terms' => $cat_include,
				'operator' => 'IN',
			);

			$args2['tax_query'][] =array(
				'taxonomy' => 'category',
				'terms' => $cat_include,
				'operator' => 'IN',
			);

		}
	}


$loop_metro = new WP_Query( $args );

$loop_metro_2 = new WP_Query( $args2 );

?>






<div class="blog-posts">
	<div class="row">
		<div class="col-lg-8 col-md-9 col-sm-12 col-xs-7 first-post">

					<?php while ($loop_metro -> have_posts()) : $loop_metro -> the_post(); ?>
						<a href="<?php the_permalink() ?>">
							<figure><?php the_post_thumbnail( 'metro_first' ); ?></figure>
							<div class="blog-posts-inner">
								<div class="category">
									<ul>
										<li> <?php print get_the_category(get_the_ID())[0]->name; ?></li>
									</ul>
								</div>
								<h2><?php the_title(); ?></h2>
							</div>
						</a>
						<?php
					endwhile;
					wp_reset_postdata();
					?>
		</div>

		<div class="col-lg-4 col-md-3 col-sm-12 col-xs-5 another-posts">

			<?php while ($loop_metro_2 -> have_posts()) : $loop_metro_2 -> the_post(); ?>
				<a href="<?php the_permalink() ?>">
					<figure><?php the_post_thumbnail( 'metro_others' ); ?></figure>
					<div class="blog-posts-inner">
						<div class="category">
							<ul>
								<li> <?php print get_the_category(get_the_ID())[0]->name; ?></li>
							</ul>
						</div>
						<h2><?php the_title(); ?></h2>
					</div>
				</a>
				<?php
			endwhile;
			wp_reset_postdata();
			?>
		</div>
	</div>
</div>
