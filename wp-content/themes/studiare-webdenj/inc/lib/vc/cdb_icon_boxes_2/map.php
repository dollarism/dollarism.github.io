<?php

vc_map( array(
	'base'             => 'cdb_icon_box_2',
	'name'             => esc_html__( 'جعبه های آیکون 2', 'studiare' ),
	'description'      => esc_html__( 'جعبه آیکون و محتوا قرار دهید', 'studiare' ),
	'category'         => esc_html__( 'Studiare', 'studiare' ),
	'params'           => array(
		array(
			'type' => 'vc_link',
			'heading' => esc_html__( 'URL (Link)', 'studiare' ),
			'param_name' => 'link',
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Icon Type', 'studiare' ),
			'param_name'  => 'icon_style',
			'value'       => array(
				esc_html__( 'Icon Font', 'studiare' ) => 'icon-font',
				esc_html__( 'Image', 'studiare' ) => 'image',
			),
			'save_always' => true,
			'admin_label' => true,
		),
		array(
			'type' 			=> 'iconpicker',
			'heading' 		=> esc_html__( 'Icon', 'studiare' ),
			'param_name' 	=> 'icon',
			'description' 	=> esc_html__( 'Select icon from library.', 'studiare' ),
			'value' 		=> '',
			'dependency'    => array('element' => 'icon_style', 'value' => array('icon-font')),
		),
		array(
			'type'           => 'attach_image',
			'heading'        => esc_html__( 'Custom Image', 'studiare' ),
			'param_name'     => 'custom_icon',
			'dependency'  => array('element' => 'icon_style', 'value' => array('image')),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Icon Position', 'studiare' ),
			'param_name'  => 'icon_position',
			'value'       => array(
				esc_html__( 'Top', 'studiare' )             => 'top',
				esc_html__( 'Left', 'studiare' )            => 'left',
				esc_html__( 'Right', 'studiare' )           => 'right'
			),
			'description' => esc_html__( 'Set icon position where you want it to show.', 'studiare' ),
			'save_always' => true,
			'admin_label' => true
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Icon Style', 'studiare' ),
			'param_name'  => 'icon_type',
			'value'       => array(
				esc_html__( 'Normal', 'studiare' ) => 'normal',
				esc_html__( 'Circle', 'studiare' ) => 'circle',
				esc_html__( 'Square', 'studiare' ) => 'square'
			),
			'save_always' => true,
			'admin_label' => true,
			'description' => esc_html__( 'This attribute doesn\'t work when Icon Position is Top. In This case Icon Type is Normal','studiare' ),
			'dependency'  => array('element' => 'icon_style', 'value' => array('icon-font')),
			'group'       => esc_html__('Icon Settings', 'studiare'),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Icon Size', 'studiare' ),
			'param_name'  => 'icon_size',
			'value'       => array(
				esc_html__( 'Small', 'studiare' )      => 'icon-box-small',
				esc_html__( 'Medium', 'studiare' )     => 'icon-box-medium',
				esc_html__( 'Large', 'studiare' )      => 'icon-box-large'
			),
			'admin_label' => true,
			'save_always' => true,
			'description' => esc_html__( 'This attribute doesn\'t work when Icon Position is Top', 'studiare' ),
			'group'       => esc_html__('Icon Settings', 'studiare'),
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'Custom Icon Size (px)', 'studiare' ),
			'param_name' => 'custom_icon_size',
			'group'       => esc_html__('Icon Settings', 'studiare'),
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Icon Margin', 'studiare' ),
			'param_name'  => 'icon_margin',
			'value'       => '',
			'description' => esc_html__( 'Margin should be set in a top right bottom left format', 'studiare' ),
			'admin_label' => true,
			'group'       => esc_html__('Icon Settings', 'studiare'),
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Shape Size (px)', 'studiare' ),
			'param_name'  => 'shape_size',
			'description' => '',
			'admin_label' => true,
			'dependency'  => array(
				'element' => 'icon_type',
				'value' => array('circle', 'square')
			),
			'group'       => esc_html__('Icon Settings', 'studiare'),
		),
		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__( 'Icon Color', 'studiare' ),
			'param_name' => 'icon_color',
			'group'       => esc_html__('Icon Settings', 'studiare'),
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => esc_html__( 'Icon Background Color', 'studiare' ),
			'param_name'  => 'icon_background_color',
			'description' => esc_html__( 'Icon Background Color (only for square and circle icon type)', 'studiare' ),
			'dependency'  => array('element' => 'icon_type', 'value' => array('square', 'circle')),
			'group'       => esc_html__('Icon Settings', 'studiare'),
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__('Border radius', 'studiare'),
			'param_name'  => 'border_radius',
			'description' => esc_html__('Please insert border radius(Rounded corners) in px. For example: 4 ', 'studiare'),
			'dependency'  => array(
				'element' => 'icon_type',
				'value' => array('circle', 'square')
			),
			'group'       => esc_html__('Icon Settings', 'studiare'),
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => esc_html__( 'Icon Border Color', 'studiare' ),
			'param_name'  => 'icon_border_color',
			'description' => esc_html__( 'Only for Square and Circle Icon type', 'studiare' ),
			'dependency'  => array('element' => 'icon_type', 'value' => array('square', 'circle')),
			'group'       => esc_html__('Icon Settings', 'studiare'),
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Border Width', 'studiare' ),
			'param_name'  => 'icon_border_width',
			'description' => esc_html__( 'Only for Square and Circle Icon type', 'studiare' ),
			'dependency'  => array('element' => 'icon_type', 'value' => array('square', 'circle')),
			'group'       => esc_html__('Icon Settings', 'studiare'),
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Title', 'studiare' ),
			'param_name'  => 'title',
			'value'       => '',
			'admin_label' => true
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Title Tag', 'studiare' ),
			'param_name' => 'title_tag',
			'value'      => array(
				'h2' => 'h2',
				'h3' => 'h3',
				'h4' => 'h4',
				'h5' => 'h5',
				'h6' => 'h6',
			),
			'std'        => 'h4',
			'dependency' => array('element' => 'title', 'not_empty' => true),
			'group'      => esc_html__('Text Settings', 'studiare')
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Title Text Transform', 'studiare' ),
			'param_name'  => 'title_text_transform',
			'value'       => array_flip(studiare_get_text_transform_array(true)),
			'save_always' => true,
			'dependency' => array('element' => 'title', 'not_empty' => true),
			'group'      => esc_html__('Text Settings', 'studiare')
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Title Text Font Weight', 'studiare' ),
			'param_name'  => 'title_text_font_weight',
			'value'       => array_flip(studiare_get_font_weight_array(true)),
			'save_always' => true,
			'dependency' => array('element' => 'title', 'not_empty' => true),
			'group'      => esc_html__('Text Settings', 'studiare')
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'تراز متن عنوان', 'studiare' ),
			'param_name'  => 'title_text_font_align',
			'value'       => array(
				esc_html__( 'وسط', 'studiare' )      => 'center',
				esc_html__( 'راست', 'studiare' )     => 'right',
				esc_html__( 'چپ', 'studiare' )      => 'left'
			),
			'save_always' => true,
			'dependency' => array('element' => 'title', 'not_empty' => true),
			'group'      => esc_html__('Text Settings', 'studiare')
		),
		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__( 'Title Color', 'studiare' ),
			'param_name' => 'title_color',
			'dependency' => array('element' => 'title', 'not_empty' => true),
			'group'      => esc_html__('Text Settings', 'studiare')
		),
		array(
			'type'       => 'textarea_html',
			'holder'     => 'div',
			'heading'    => esc_html__( 'Text', 'studiare' ),
			'param_name' => 'content',
		),
		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__( 'Text Color', 'studiare' ),
			'param_name' => 'text_color',
			'dependency' => array('element' => 'text', 'not_empty' => true),
			'group'      => esc_html__('Text Settings', 'studiare')
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'Text Left Padding (px)', 'studiare' ),
			'param_name' => 'text_left_padding',
			'dependency' => array('element' => 'icon_position', 'value' => array('left')),
			'group'      => esc_html__('Text Settings', 'studiare')
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'Text Right Padding (px)', 'studiare' ),
			'param_name' => 'text_right_padding',
			'dependency' => array('element' => 'icon_position', 'value' => array('right')),
			'group'      => esc_html__('Text Settings', 'studiare')
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
	class WPBakeryShortCode_Cdb_Icon_Box_2 extends WPBakeryShortCode {}
}