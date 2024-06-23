<?php
/**
 * Nuovo WordPress Theme
 *
 * Codebean.co
 * www.codebean.co
 */

vc_map( array(
	'base'             => 'cdb_social_networks',
	'name'             => esc_html__( 'Social Networks', 'studiare' ),
	'description'      => esc_html__( 'Social network links', 'studiare' ),
	'category'         => esc_html__( 'Studiare', 'studiare' ),
	'params'           => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Display type', 'studiare' ),
			'param_name' => 'display_type',
			'value' => array(
				esc_html__( 'Rounded Icon', 'studiare' ) => 'rounded',
				esc_html__( 'Icon Only', 'studiare' ) => 'icon-only',
			),
			'description' => esc_html__( 'Select style of social network links.', 'studiare' ),
			'admin_label' => true
		),
		array(
			'type'       => 'checkbox',
			'heading'    => esc_html__( 'Light?', 'studiare' ),
			'param_name' => 'light',
			'admin_label' => true,
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
	class WPBakeryShortCode_Cdb_Social_Networks extends WPBakeryShortCode {}
}