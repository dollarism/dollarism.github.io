<?php

vc_map( array(
	'base'             => 'cdb_pricing_table',
	'name'             => esc_html__( 'Pricing Table', 'studiare' ),
	'description'      => esc_html__( 'Insert pricing table with icon', 'studiare' ),
	'category'         => esc_html__( 'Studiare', 'studiare' ),
	'params'           => array(
		array(
			'type'          => 'textfield',
			'admin_label'   => true,
			'heading'       => esc_html__('Title','studiare'),
			'param_name'    => 'title',
			'value'         => esc_html__('Basic Plan','studiare')
		),
		array(
			'type'          => 'textfield',
			'admin_label'   => true,
			'heading'       => esc_html__('Subtitle','studiare'),
			'param_name'    => 'subtitle',
			'value'         => ''
		),
		array(
			'type'          => 'textfield',
			'admin_label'   => true,
			'heading'       => esc_html__('Price', 'studiare'),
			'param_name'    => 'price'
		),
		array(
			'type'          => 'textfield',
			'admin_label'   => true,
			'heading'       => esc_html__('Currency', 'studiare'),
			'param_name'    => 'currency'
		),
		array(
			'type'          => 'dropdown',
			'heading'       => esc_html__('Show Button', 'studiare'),
			'param_name'    => 'show_button',
			'value'         => array(
				esc_html__('Yes', 'studiare')     => 'yes',
				esc_html__('No', 'studiare')      => 'no'
			)
		),
		array(
			'type'          => 'vc_link',
			'heading'       => esc_html__('Button Link', 'studiare'),
			'param_name'    => 'button_link',
			'dependency'    => array(
				'element'   => 'show_button',
				'value'     => 'yes'
			),
		),
		array(
			'type'          => 'textfield',
			'heading'       => esc_html__('Button Text', 'studiare'),
			'param_name'    => 'button_text'
		),

		array(
			'type'          => 'attach_image',
			'heading'       => esc_html__( 'تصویر آیکون جدول', 'studiare' ),
			'param_name'    => 'image',
			'value'         => '',
			'description'   => esc_html__( 'Select image from media library.', 'studiare' )
		),

		array(
			'type'          => 'textfield',
			'heading'       => esc_html__( 'Image size', 'studiare' ),
			'param_name'    => 'img_size',
			'description'   => esc_html__( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'studiare' )
		),

		array(
			'type'          => 'textarea_html',
			'holder'        => 'div',
			'class'         => '',
			'heading'       => esc_html__('Content', 'studiare'),
			'param_name'    => 'content',
			'value'         => '<li>' . esc_html__('content content content', 'studiare') . '</li><li>' . esc_html__('content content content', 'studiare') . '</li><li>' . esc_html__('content content content', 'studiare') . '</li>',
			'description'   => ''
		),
		array(
			'type'          => 'textfield',
			'heading'       => esc_html__('Extra class name','studiare'),
			'param_name'    => 'el_class',
			'description'   => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.','studiare')
		),
		array(
			'type' => 'css_editor',
			'heading' => esc_html__( 'Css', 'studiare' ),
			'param_name' => 'css',
			'group' => esc_html__( 'Design options', 'studiare' )
		)
	)
) );

if ( class_exists('WPBakeryShortCode') ) {
	class WPBakeryShortCode_Cdb_Pricing_Table extends WPBakeryShortCode {}
}
