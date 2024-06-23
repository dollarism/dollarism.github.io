<?php

vc_map( array(
	'name'        => esc_html__( 'Teachers Grid', 'studiare' ),
	'base'        => 'cdb_teachers_grid',
	'category'    => esc_html__( 'Studiare', 'studiare' ),
	'description' => esc_html__( 'Show teachers grid', 'studiare' ),
	'params'      => array(
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'Teacher per page', 'studiare' ),
			'param_name' => 'per_page',
			'default'	 => '8',
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
			'description' => esc_html__( 'Number of columns to show teacher items.', 'studiare' ),
			'admin_label'    => true
		),
		array(
			'type'           => 'textfield',
			'heading'        => esc_html__( 'Extra class name', 'studiare' ),
			'param_name'     => 'el_class',
			'description'    => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'studiare' ),
		),
		array(
			'type'       => 'css_editor',
			'heading'    => esc_html__( 'Css', 'studiare' ),
			'param_name' => 'css',
			'group'      => esc_html__( 'Design options', 'studiare' )
		)
	)
) );

if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Cdb_Teachers_Grid extends WPBakeryShortCode {}
}