<?php

// Atts
if ( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );

// Element Class
$class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );

$css_class = "studiare-social-links";

if ( $display_type == 'rounded' ) {
	$css_class .= ' rounded';
}

if ( $light  == true ) {
    $css_class .= ' light';
}

?>
<div class="<?php echo esc_attr( $css_class ) . vc_shortcode_custom_css_class( $css, ' ' ); ?>">
	<?php echo do_shortcode( '[social_networks' . when_match( $display_type == 'rounded', 'rounded', '', false ) . when_match( ! empty( $light ), $light, '', false ) . ']' ); ?>
</div>
