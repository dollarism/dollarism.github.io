<?php

vc_map( array(
	'base'             => 'cdb_blog_metro',
	'name'             => esc_html__( 'بلاگ استایل کاشی', 'studiare' ),
	'description'      => esc_html__( 'نمایش نوشته های بلاگ', 'studiare' ),
	'category'         => esc_html__( 'Studiare', 'studiare' ),
	'params'           => array(


		array(
				'type'			=> 'textfield',
				'heading'		=> __( 'شامل نوشته ها از دسته های:', 'studiare' ),
				'param_name' 	=> 'metro_cat_include',
				'description'	=> __( 'نامک دسته بندی های مورد نظر خود را وارد کرده و با کاما "," از هم جدایشان کنید.', 'studiare' ),
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
	class WPBakeryShortCode_Cdb_Blog_Metro extends WPBakeryShortCode {}
}
