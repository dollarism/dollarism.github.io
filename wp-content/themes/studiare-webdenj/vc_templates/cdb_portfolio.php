<?php

// Atts
if ( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );

list( $query_args, $portfolio_query ) = vc_build_loop_query( $portfolio_query );

// Element Class
$class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );

$css_class = "cdb-vc-portfolio";


?>
<div class="<?php echo esc_attr( $css_class ) . vc_shortcode_custom_css_class($css, ' '); ?>">

    <?php if ( ! is_tax() && $category_filter ) : ?>
        <?php
            $categories = get_terms( 'portfolio_category' );
            if ( ! is_wp_error( $categories ) && ! empty( $categories ) ) {
        ?>
            <div class="portfolio-list-categories">
            <?php
	            $categories = get_terms( 'portfolio_category' );
	            if ( ! is_wp_error( $categories ) && ! empty( $categories ) ) { ?>
                    <div class="portfolio-list-cat portfolio-controls">
                        <ul class="mixitup-controls">
                            <li><a href="#" class="control" data-filter="all"><?php esc_html_e('All', 'studiare'); ?></a></li>
				            <?php foreach ($categories as $key => $cateogry) { ?>
                                <li><a href="#" class="control" data-filter=".portfolio-cat-<?php echo esc_attr( $cateogry->slug ); ?>"><?php echo esc_html( $cateogry->name ); ?></a></li>
				            <?php } ?>
                        </ul>
                    </div>
            <?php } ?>
            </div>
        <?php } ?>
    <?php endif; ?>

	<div class="portfolio-holder portfolio-masonry portfolio-<?php echo esc_attr( $columns_count ); ?>-col">

		<?php if ( $portfolio_query->have_posts() ) : ?>

			<?php while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post(); ?>

				<?php get_template_part( 'inc/templates/portfolio/portfolio-item' ); ?>

			<?php  endwhile; ?>

        <?php else: ?>

			<?php get_template_part( 'inc/templates/not-found' ); ?>

        <?php endif; ?>

	</div>

</div>

<?php wp_reset_postdata(); ?>