<?php

// Atts
if ( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );

// Element Class
$class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );

$css_class = "teachers-wrapper {$columns_count}-cols";

$paged = get_query_var( 'paged', 1 );

$teachers = new WP_Query( array( 'post_type' => 'teacher', 'posts_per_page' => $per_page ,'paged' => $paged ) );

?>

<?php if($teachers->have_posts()): ?>
    <div class="<?php echo esc_attr( $css_class ) . vc_shortcode_custom_css_class($css, ' '); ?>">

	    <?php while($teachers->have_posts()): $teachers->the_post(); ?>

		    <?php get_template_part( 'inc/templates/teacher-item' ); ?>

	    <?php endwhile; ?>
    </div>

<?php else: ?>

	<?php get_template_part( 'inc/templates/not-found' ); ?>

<?php endif; ?>