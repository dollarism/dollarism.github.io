<?php

vc_map( array(
	'base'             => 'cdb_button',
	'name'             => esc_html__( 'Button', 'studiare' ),
	'description'      => esc_html__( 'Eye catching button', 'studiare' ),
	'category'         => esc_html__( 'Studiare', 'studiare' ),
	'params'           => array(
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__( 'Title', 'studiare' ),
			'param_name' 	=> 'title',
			'description'	=> esc_html__( 'Enter a button title.', 'studiare' ),
			'value' 		=> esc_html__( 'Button with Text', 'studiare' ),
			'admin_label'   => true
		),
		array(
			'type'			=> 'vc_link',
			'heading'		=> esc_html__( 'URL (Link)', 'studiare' ),
			'param_name'	=> 'link',
			'description'	=> esc_html__( 'Set a button link.', 'studiare' )
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__( 'Style', 'studiare' ),
			'param_name'	=> 'style',
			'description'	=> esc_html__( 'Select button style.', 'studiare' ),
			'value' 		=> array(
				esc_html__( 'Filled', 'studiare' ) => 'filled',
				esc_html__( 'Border', 'studiare' ) => 'border',
				esc_html__( 'Link', 'studiare' ) => 'link'
			),
			'std'			=> 'filled',
			'admin_label'   => true
		),
		array(
			'type' 			=> 'colorpicker',
			'heading' 		=> esc_html__( 'Color', 'studiare' ),
			'param_name' 	=> 'color',
			'description'	=> esc_html__( 'Button color.', 'studiare' )
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__( 'Size', 'studiare' ),
			'param_name'	=> 'size',
			'description'	=> esc_html__( 'Select button size.', 'studiare' ),
			'value'			=> array(
				esc_html__( 'Large', 'studiare' ) => 'lg',
				esc_html__( 'Medium', 'studiare' )	=> 'md',
				esc_html__( 'Small', 'studiare' ) => 'sm',
			),
			'std' 			=> 'lg'
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__( 'Align', 'studiare' ),
			'param_name'	=> 'align',
			'description'	=> esc_html__( 'Select button alignment.', 'studiare' ),
			'value'			=> array(
				esc_html__( 'Left', 'studiare' ) => 'left',
				esc_html__( 'Center', 'studiare' )	=> 'center',
				esc_html__( 'Right', 'studiare' ) => 'right',
				esc_html__( 'Full', 'studiare' ) => 'full',
			),
			'std' 			=> 'left',
			'admin_label'   => true
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

if ( class_exists('WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_CDB_button extends WPBakeryShortCode {}
}