<?php

vc_map( array(
	'base'             => 'cdb_animated_counter',
	'name'             => esc_html__( 'Animated Counter', 'studiare' ),
	'description'      => esc_html__( 'Shows animated counter with label', 'studiare' ),
	'category'         => esc_html__( 'Studiare', 'studiare' ),
	'params'           => array(
		array(
			'type'          => 'textfield',
			'heading'       => esc_html__('Actual Value','studiare' ),
			'param_name'    => 'value',
			'description'   => esc_html__('Our final point. For ex.: 95','studiare' ),
			'save_always'   => true,
			'admin_label'   => true,
		),
		array(
			'type'          => 'textarea',
			'heading'       => esc_html__('Label','studiare' ),
			'param_name'    => 'label',
			'save_always'   => true,
			'admin_label'   => true,
		),
		array(
			'type'          => 'dropdown',
			'heading'       => esc_html__( 'Color scheme', 'studiare' ),
			'param_name'    => 'color_scheme',
			'value'         => array(
				esc_html__( 'Dark', 'studiare' ) => 'dark',
				esc_html__( 'Light', 'studiare' ) => 'light',
				esc_html__( 'Custom', 'studiare' ) => 'custom'
			),
			'save_always'   => true,
			'admin_label'   => true,
		),
		array(
			'type'          => 'colorpicker',
			'heading'       => esc_html__( 'Custom text color', 'studiare' ),
			'param_name'    => 'text_color',
			'dependency'    => array(
				'element' => 'color_scheme',
				'value' => array( 'custom' )
			)
		),
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

if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Cdb_Animated_Counter extends WPBakeryShortCode {}
}