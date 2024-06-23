<?php
if (!defined('HTQ_SLUG'))
{
    return;
}

// Atts
if ( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );

$test_query_str = $atts['test_query'];
  
list( $query_args, $blog_query ) = vc_build_loop_query( $test_query_str );

// Element Class
$class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );

$css_class = "blog-loop-inner blog-loop-view-grid {$columns}-columns";

?>

<div class="<?php echo esc_attr( $css_class ) . vc_shortcode_custom_css_class($css, ' '); ?>">

	<?php if ( $blog_query->have_posts() ) : $i = 0; ?>

    <?php while( $blog_query->have_posts() ) : $blog_query->the_post(); ?>
		<?php 
                get_template_part( '/inc/templates/blog/grid-postbit', 'test' ); 
                ?>

	<?php endwhile; else : ?>

		<?php get_template_part( '/inc/templates/not-found' ); ?>

	<?php endif; ?>

</div>

<?php 
wp_reset_postdata();