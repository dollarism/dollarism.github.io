<?php

vc_map( array(
	'base'             => 'cdb_section_heading',
	'name'             => esc_html__( 'Section Heading', 'studiare' ),
	'description'      => esc_html__( 'Section title, subtitle and button', 'studiare' ),
	'category'         => esc_html__( 'Studiare', 'studiare' ),
	'params'           => array(
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Section Title', 'studiare' ),
			'param_name'  => 'title',
			'admin_label' => true,
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Section Subtitle', 'studiare' ),
			'param_name'  => 'subtitle',
			'admin_label' => true,
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => esc_html__( 'Title color', 'studiare' ),
			'param_name'  => 'title_color',
			'admin_label' => true,
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => esc_html__( 'Subtitle color', 'studiare' ),
			'param_name'  => 'subtitle_color',
			'admin_label' => true,
		),

		array(
			'type'          => 'dropdown',
			'heading'       => esc_html__('Show Button', 'studiare' ),
			'param_name'    => 'show_button',
			'value'         => array(
				esc_html__('Yes', 'studiare' )     => 'yes',
				esc_html__('No', 'studiare' )      => 'no',
			),
			'std' => 'no',
			'group'      => esc_html__( 'دکمه', 'studiare' ),
		),
		array(
			'type'          => 'vc_link',
			'heading'       => esc_html__('Button Link', 'studiare' ),
			'param_name'    => 'button_link',
			'group'      => esc_html__( 'دکمه', 'studiare' ),
			'dependency'    => array(
				'element'   => 'show_button',
				'value'     => 'yes'
			)
		),
		array(
			'type'          => 'textfield',
			'heading'       => esc_html__('Button Text', 'studiare' ),
			'param_name'    => 'button_text',
			'group'      => esc_html__( 'دکمه', 'studiare' ),
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
	class WPBakeryShortCode_Cdb_Section_Heading extends WPBakeryShortCode {}
}
