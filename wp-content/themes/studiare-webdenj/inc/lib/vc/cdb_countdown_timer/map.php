<?php

vc_map( array(
	'base'             => 'cdb_countdown_timer',
	'name'             => esc_html__( 'Countdown timer', 'studiare' ),
	'description'      => esc_html__( 'Shows countdown timer', 'studiare' ),
	'category'         => esc_html__( 'Studiare', 'studiare' ),
	'params'           => array(
		array(
			'type'          => 'textfield',
			'heading'       => esc_html__( 'Date', 'studiare' ),
			'param_name'    => 'date',
			'admin_label'   => true,
			'description'   => esc_html__( 'Final date in the format Y/m/d. For example 2017/12/12', 'studiare' )
		),
		array(
			'type'          => 'dropdown',
			'heading'       => esc_html__( 'Size', 'studiare' ),
			'param_name'    => 'size',
			'value'         => array(
				esc_html__( 'Small', 'studiare' ) => 'small',
				esc_html__( 'Medium', 'studiare' ) => 'medium',
				esc_html__( 'Large', 'studiare' ) => 'large',
			),
			'admin_label'   => true,
		),
		array(
			'type'          => 'dropdown',
			'heading'       => esc_html__( 'Style', 'studiare' ),
			'param_name'    => 'style',
			'value'         => array(
				esc_html__( 'Standard', 'studiare' ) => 'standard',
				esc_html__( 'Transparent', 'studiare' ) => 'transparent',
			),
			'admin_label'   => true,
		),
		array(
			'type'       => 'checkbox',
			'heading'    => esc_html__( 'Light?', 'studiare' ),
			'param_name' => 'light',
			'admin_label' => true,
			'dependency' => array('element' => 'style', 'value' => array('transparent') ),
		),
		array(
			'type'          => 'dropdown',
			'heading'       => esc_html__( 'Align', 'studiare' ),
			'param_name'    => 'align',
			'value'         => array(
				esc_html__( 'left', 'studiare' ) => 'left',
				esc_html__( 'center', 'studiare' ) => 'center',
				esc_html__( 'right', 'studiare' ) => 'right',
			),
			'admin_label'   => true,
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'studiare' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'studiare' )
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
	class WPBakeryShortCode_Cdb_Countdown_Timer extends WPBakeryShortCode {}
}