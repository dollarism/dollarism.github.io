<?php

vc_map( array(
	'base'             => 'cdb_blog_posts',
	'name'             => esc_html__( 'Blog Posts', 'studiare' ),
	'description'      => esc_html__( 'Show blog posts', 'studiare' ),
	'category'         => esc_html__( 'Studiare', 'studiare' ),
	'params'           => array(
		array(
			"type" => "loop",
			"heading" => esc_html__( "Blog Query", "studiare" ),
			"param_name" => "blog_query",
			'settings' => array(
				'size' => array('hidden' => false, 'value' => 3),
				'order_by' => array('value' => 'date'),
				'post_type' => array('value' => 'post', 'hidden' => false)
			),
			"description" => esc_html__( "Create WordPress loop, to populate only blog posts from your site.", "studiare" )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Columns', 'studiare' ),
			'param_name' => 'columns',
			'std' => '3',
			'admin_label' => true,
			'value' => array(
				esc_html__( '1 Column', 'studiare' )    => 'one',
				esc_html__( '2 Columns', 'studiare' )   => 'two',
				esc_html__( '3 Columns', 'studiare' )   => 'three',
				esc_html__( '4 Columns', 'studiare' )   => 'four',
			),
			'description' => esc_html__( 'Set number of columns to separate blog posts.', 'studiare' )
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

if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Cdb_Blog_Posts extends WPBakeryShortCode {}
}