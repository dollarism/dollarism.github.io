<?php

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || codebean_is_plugin_active_for_network( 'woocommerce/woocommerce.php' ) ) {

	vc_map( array(
		'base'             => 'cdb_course_categories',
		'name'             => esc_html__( 'Course Categories', 'studiare' ),
		'description'      => esc_html__( 'Show course categories grid', 'studiare' ),
		'category'         => esc_html__( 'Studiare', 'studiare' ),
		'params'           => array(
			array(
				'type'			=> 'dropdown',
				'holder'		=> 'div',
				'class' 		=> 'hide_in_vc_editor',
				'admin_label' 	=> false,
				'heading'		=> esc_html__( 'Categories Display', 'studiare' ),
				'param_name'	=> 'parent',
				'value'			=> array(
					esc_html__( 'Parent Categories Only', 'studiare' )				    => '0',
					esc_html__( 'Parent Categories + Subcategories', 'studiare' )		=> '999'
				),
			),
			array(
				'type'			=> 'textfield',
				'holder'		=> 'div',
				'class' 		=> 'hide_in_vc_editor',
				'admin_label' 	=> true,
				'heading'		=> esc_html__('How many product categories to display?', 'studiare' ),
				'param_name'	=> 'number',
				'value'			=> '',
			),
			array(
				'type'			=> 'dropdown',
				'holder'		=> 'div',
				'class' 		=> 'hide_in_vc_editor',
				'admin_label' 	=> false,
				'heading'		=> esc_html__( 'Alphabetical Order', 'studiare' ),
				'param_name'	=> 'order',
				'value'			=> array(
					esc_html__( 'Ascending', 'studiare' )		=> 'asc',
					esc_html__( 'Descending', 'studiare' )	    => 'desc'
				),
			),
			array(
				'type'			=> 'dropdown',
				'holder'		=> 'div',
				'class'			=> 'hide_in_vc_editor',
				'heading'		=> esc_html__( 'Hide Empty', 'studiare' ),
				'param_name'	=> 'hide_empty',
				'value'			=> array(
					esc_html__( 'Yes', 'studiare' )	=> '1',
					esc_html__( 'No', 'studiare' )	=> '0'
				),
				'admin_label' 	=> true
			)
		)
	) );

	if ( class_exists('WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Cdb_Course_Categories extends WPBakeryShortCode {}
	}

}