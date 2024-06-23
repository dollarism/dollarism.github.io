<?php

vc_map(array(
	'name' => esc_html__('Google Map', 'studiare'),
	'base' => 'cdb_google_map',
	'description'      => esc_html__( 'Shows Google map block', 'studiare' ),
	'category' => esc_html__('Studiare', 'studiare'),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Map Width', 'studiare'),
			'param_name' => 'map_width',
			'value' => '100%',
			'description' => esc_html__('Enter map width in px or %', 'studiare')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Map Height', 'studiare'),
			'param_name' => 'map_height',
			'value' => '460px',
			'description' => esc_html__('Enter map height in px', 'studiare')
		),
		array(
			'type' => 'attach_images',
			'heading' => esc_html__('Pin image', 'studiare'),
			'param_name' => 'image'
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Latitude', 'studiare'),
			'param_name' => 'lat',
			'description' => wp_kses(__('<a href="http://www.latlong.net/convert-address-to-lat-long.html">Here is a tool</a> where you can find Latitude & Longitude of your location', 'studiare'), array('a' => array('href' => array())))
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Longitude', 'studiare'),
			'param_name' => 'lng',
			'description' => wp_kses(__('<a href="http://www.latlong.net/convert-address-to-lat-long.html">Here is a tool</a> where you can find Latitude & Longitude of your location', 'studiare'), array('a' => array('href' => array())))
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Map Zoom', 'studiare'),
			'param_name' => 'map_zoom',
			'value' => 18
		),
		array(
			'type' => 'textarea_raw_html',
			'heading' => 'Map Style',
			'param_name' => 'style_json',
			'value' => '',
			'description' => wp_kses(__('Paste the style code here. Browse map styles in <a href="https://snazzymaps.com/"">SnazzyMaps</a>.', 'studiare'), array('a' => array('href' => array())))
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Your Address', 'studiare'),
			'param_name' => 'infowindow_text',
		),
		array(
			'type' => 'checkbox',
			'param_name' => 'disable_mouse_whell',
			'value' => array(
				esc_html__('Disable map zoom on mouse wheel scroll', 'studiare') => 'disable'
			)
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'studiare'),
			'param_name' => 'el_class',
			'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'studiare')
		),
		array(
			'type' => 'css_editor',
			'heading' => esc_html__('Css', 'studiare'),
			'param_name' => 'css',
			'group' => esc_html__('Design options', 'studiare')
		)
	)
));

if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Cdb_Google_Map extends WPBakeryShortCode {}
}