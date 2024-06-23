<?php

global $client_logo_index, $hover_style, $img_size;

// Atts
if ( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );

// Element Class
$class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );

$css_class = "partners-logos {$columns_count}_cols";

if ( $column_spacing == 'no' ) {
    $css_class .= ' no-gap';
}

if ( $image_borders == 'yes' ) {
    $css_class .= ' with-borders';
}

// Thumb Size
if ( ! $img_size ) {
	$img_size = "thumbnail";
}

// Show Team Members
$client_logo_index = 0;

?>
<div class="<?php echo esc_attr( $css_class ) . vc_shortcode_custom_css_class($css, ' '); ?>">
	<?php echo wpb_js_remove_wpautop( $content ); ?>
</div>

