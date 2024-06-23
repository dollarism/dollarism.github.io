<?php

// Atts
if ( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );

wp_enqueue_script( 'gmaps' );

// Element Class
$class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );

$css_class = "studiare-google-map";

$id = 'google-map-' . rand(100,999);

if ( empty( $lat ) ) {
	$lat = 36.169941;
}

if ( empty( $lng ) ) {
	$lng = - 115.139830;
}

// Map Style
$map_style = array();
if ( $map_width ) {
	$map_style['width'] = ' width: ' . $map_width . ';';
}
if ( $map_height ) {
	$map_style['height'] = ' height: ' . $map_height . ';';
}

if ( $disable_mouse_whell == 'disable' ) {
	$disable_mouse_whell = 'false';
} else {
	$disable_mouse_whell = 'true';
}

$pin_url = get_template_directory_uri() . '/assets/images/map-marker.svg';

if (!empty($image)) {
	$image = explode(',',$image);
	if(!empty($image[0])) {
		$image = $image[0];
		$image = wp_get_attachment_image_src($image, 'full');
		$pin_url = $image[0];
	}
}

if (!empty($style_json)) {
	$decode_styles = 'base64' . '_decode';
	$style_json = "styles :" . rawurldecode($decode_styles(strip_tags($style_json)));
}


?>
<div class="<?php echo esc_attr( $css_class ) . vc_shortcode_custom_css_class($css, ' '); ?>">
	<div id="<?php echo esc_attr( $id ); ?>" class="google-map-inner"<?php echo( ( $map_style ) ? ' style="' . esc_attr( implode( ' ', $map_style ) ) . '"' : '' ); ?>></div>
</div>
<?php

$google_map_script = '
    jQuery(document).ready(function ($) {
        google.maps.event.addDomListener(window, "load", googleMapInit);
        
        var center, map;
        function googleMapInit() {
            center = new google.maps.LatLng("'. esc_js( $lat ) .'","'. esc_js( $lng ) .'");
            
            var mapOptions = {
                zoom: '. esc_js( $map_zoom ) .',
                center: center,
                panControl: false,
                mapType: "roadmap",
                streetViewControl: false,
                fullscreenControl: false,
                mapTypeControl: false,
                scrollwheel: '. esc_js( $disable_mouse_whell ) .',
                ' . sanitize_text_field( $style_json ) . '
            };
            
            var mapElement = document.getElementById("'. esc_js( $id ) .'");
            
            map = new google.maps.Map(mapElement, mapOptions);
            
            var marker = new google.maps.Marker({
                position: center,
                icon: "'. esc_url( $pin_url ) .'",
                map: map
            });
            
            var infowindow = new google.maps.InfoWindow({
                content: "' . esc_js($infowindow_text ) .'",
                pixelOffset: new google.maps.Size(0,71),
                boxStyle: {
                    width: "320px"
                }
            });
    
            marker.addListener("click", function() {
                infowindow.open(map, marker);
                map.setCenter(center);
            });
            
        }
    });
';

wp_add_inline_script( 'studiare-theme', $google_map_script );
