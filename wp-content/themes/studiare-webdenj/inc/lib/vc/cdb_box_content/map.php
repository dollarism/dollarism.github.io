<?php

vc_map( array(
	'base'             => 'cdb_box_content',
	'name'             => esc_html__( 'Content Box', 'studiare' ),
	'description'      => esc_html__( 'Insert content block', 'studiare' ),
	'as_parent'        => array('except' => 'vc_tabs'),
	'content_element'  => true,
	'show_settings_on_create'   => false,
	'js_view'          => 'VcColumnView',
	'category'         => esc_html__( 'Studiare', 'studiare' ),
	'params'           => array(
		array(
			'type'           => 'textfield',
			'heading'        => esc_html__( 'Extra class name', 'studiare' ),
			'param_name'     => 'el_class',
			'description'    => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'studiare' ),
		),
		array(
			'type'       => 'css_editor',
			'heading'    => 'Css',
			'param_name' => 'css',
			'group'      => esc_html__( 'Design options', 'studiare' ),
		)
	)
) );


if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_cdb_box_content extends WPBakeryShortCodesContainer {}
}