<?php

vc_map( array(
	'name'        => esc_html__( 'Events List', 'studiare' ),
	'base'        => 'cdb_events_list',
	'description'      => esc_html__( 'Show events list', 'studiare' ),
	'category'    => esc_html__( 'Studiare', 'studiare' ),
	'params'      => array(
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'Events per page', 'studiare' ),
			'param_name' => 'per_page',
			'default'	 => '8',
			'admin_label' => true,
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'studiare' ),
			'param_name' => 'el_class',
			'value' => '',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'studiare' )
		),
		array(
			'type' => 'css_editor',
			'heading' => esc_html__( 'Css', 'studiare' ),
			'param_name' => 'css',
			'group' => esc_html__( 'Design options', 'studiare' )
		)
	)
) );

if ( class_exists('WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Cdb_Events_List extends WPBakeryShortCode {}
}