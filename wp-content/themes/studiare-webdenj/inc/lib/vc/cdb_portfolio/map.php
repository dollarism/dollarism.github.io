<?php

vc_map( array(
	'name'        => esc_html__( 'Portfolio', 'studiare' ),
	'base'        => 'cdb_portfolio',
	'description'      => esc_html__( 'Show portfolio items', 'studiare' ),
	'category'    => esc_html__( 'Studiare', 'studiare' ),
	'params'      => array(
		array(
			'type' => 'loop',
			'heading' => esc_html__( 'Portfolio Items', 'studiare' ),
			'param_name' => 'portfolio_query',
			'settings' => array(
				'size' => array('hidden' => false, 'value' => 4 * 3),
				'order_by' => array('value' => 'date'),
				'post_type' => array('value' => 'portfolio', 'hidden' => false)
			),
			'description' => esc_html__( 'Create WordPress loop, to populate content from your site.', 'studiare' )
		),
		array(
			'type'           => 'dropdown',
			'heading'        => esc_html__( 'Category Filter', 'studiare' ),
			'param_name'     => 'category_filter',
			'value'          => array(
				esc_html__( 'Yes', 'studiare' ) => 'yes',
				esc_html__( 'No', 'studiare' )  => 'no',
			),
			'description'    => esc_html__('Show category filter above the portfolio items.', 'studiare' ),
			'admin_label'    => true
		),
		array(
			'type'           => 'dropdown',
			'heading'        => esc_html__( 'Columns', 'studiare' ),
			'param_name'     => 'columns_count',
			'std'            => '4',
			'value'          => array(
				esc_html__( '2 Items per Row', 'studiare' )    => 'two',
				esc_html__( '3 Items per Row', 'studiare' )    => 'three',
				esc_html__( '4 Items per Row', 'studiare' )    => 'four',
				esc_html__( '5 Items per Row', 'studiare' )    => 'five',
				esc_html__( '6 Items per Row', 'studiare' )    => 'six',
			),
			'description' => esc_html__( 'Number of columns to show portfolio items.', 'studiare' ),
			'admin_label'    => true
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
	class WPBakeryShortCode_Cdb_Portfolio extends WPBakeryShortCode {}
}