<?php

// Atts
if ( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );

// Element Class
$class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );

$css_class = "animated-counter counter-{$color_scheme}";

$text_styles = array();

if ( $color_scheme == 'custom') {

	if ( $text_color !== '' ) {
		$text_styles[] = 'color: '. $text_color .'';
	}
}

?>
<div class="<?php echo esc_attr( $css_class ) . vc_shortcode_custom_css_class($css, ' '); ?>">

	<div class="counter-text" <?php studiare_inline_style($text_styles); ?>>
		<span class="counter-number"><?php echo esc_attr( $value ); ?></span>

		<?php if ( $label !== '' ) { ?>
			<span class="counter-label"><?php echo wp_kses_post( $label ); ?></span>
		<?php } ?>
	</div>

</div>
