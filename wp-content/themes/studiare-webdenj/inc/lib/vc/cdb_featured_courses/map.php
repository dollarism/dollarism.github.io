<?php

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || codebean_is_plugin_active_for_network( 'woocommerce/woocommerce.php' ) ) {

	vc_map( array(
		'base'             => 'cdb_featured_courses',
		'name'             => esc_html__( 'Featured Courses', 'studiare' ),
		'description'      => esc_html__( 'Show featured courses', 'studiare' ),
		'category'         => esc_html__( 'Studiare', 'studiare' ),
		'params'           => array(
			array(
				'type' => 'loop',
				'heading' => esc_html__( 'Products Query', 'studiare' ),
				'param_name' => 'products_query',
				'admin_label' => true,
				'settings' => array(
					'size' => array('hidden' => false, 'value' => 12),
					'order_by' => array('value' => 'date'),
					'post_type' => array('value' => 'product', 'hidden' => false)
				),
				'description' => esc_html__( 'Create WordPress loop, to populate products from your site.', 'studiare' )
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Columns', 'studiare' ),
				'param_name' => 'columns',
				'admin_label' => true,
				'std' => 4,
				'value' => array(
					esc_html__( '4 Columns', 'studiare' )  => 4,
					esc_html__( '3 Columns', 'studiare' )  => 3,
					esc_html__( '2 Columns', 'studiare' )  => 2,
				),
				'description' => esc_html__( 'Select number of columns to show products.', 'studiare' )
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
		class WPBakeryShortCode_Cdb_Featured_Courses extends WPBakeryShortCode {}
	}

}