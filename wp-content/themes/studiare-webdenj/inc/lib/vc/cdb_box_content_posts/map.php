<?php

vc_map( array(
	'base'             => 'cdb_box_content_posts',
	'name'             => esc_html__( 'جعبه محتوا2', 'studiare' ),
	'description'      => esc_html__( 'نوشته ها را داخل این باکس قرار دهید', 'studiare' ),
	'as_parent'        => array('except' => 'vc_tabs'),
	'content_element'  => true,
	'show_settings_on_create'   => false,
	'js_view'          => 'VcColumnView',
	'category'         => esc_html__( 'Studiare', 'studiare' ),
	'params'           => array(
		
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'عنوان جعبه', 'studiare' ),
			'param_name' => 'title',
			'holder'	=> 'div'
		),	
		array(
			'type' 				=> 'iconpicker',
			'heading' 			=> esc_html__( 'آیکون کنار عنوان', 'studiare' ),
			'param_name' 		=> 'icon',
			'value'				=> ''
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


if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_cdb_box_content_posts extends WPBakeryShortCodesContainer {}
}