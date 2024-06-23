<?php

// Atts
if ( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );

// Link
$link = vc_build_link($link);

// Element Class
$class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );

$css_class = "btn btn-{$style} {$size} {$align} {$css_class}";

$button_style = array();

if ( $color !== '' ) {
	if ( $style == 'border' ) {
		$button_style[] = 'color:' . $color;
		$button_style[] = 'border-color:' . $color;
	} elseif ( $style == 'filled' ) {
		$button_style[] = 'background-color:' . $color;
		$button_style[] = 'border-color:' . $color;
		
	}
}

?>
<a href="<?php echo esc_url( $link['url'] ); ?>" class="<?php echo esc_attr( $css_class ) . vc_shortcode_custom_css_class($css, ' '); ?>" <?php if ( !empty($link['target']) ) : ?>target="<?php echo esc_attr( $link['target'] ); ?>"<?php endif; ?> title="<?php echo esc_attr( $title); ?>" <?php studiare_inline_style( $button_style ); ?>><?php echo esc_html( $title ); ?></a>
