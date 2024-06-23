<?php

// Atts
if ( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );

// Element Class
$class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );

$css_class = "testimonials-wrapper";

$slider_data = array();
$slider_data['data-loop'] = $wrap;
$slider_data['data-pagination'] = $show_pagination_control;

if ( $autoplay != '' ) {
	$slider_data['data-autoplay'] = 'true';
}


if ( $slides_per_view !== '' ) {
	$slider_data['data-slider-items'] = $slides_per_view;
}

?>
<div class="<?php echo esc_attr( $css_class ) . vc_shortcode_custom_css_class($css, ' '); ?>">

	<div class="testimonials-carousel owl-carousel" <?php echo studiare_get_inline_attrs( $slider_data ); ?>>
		<?php echo do_shortcode( $content ); ?>
	</div>

</div>
