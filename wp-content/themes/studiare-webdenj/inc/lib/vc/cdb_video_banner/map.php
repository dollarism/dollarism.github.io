<?php

vc_map( array(
	'base'             => 'cdb_video_banner',
	'name'             => esc_html__( 'Video Banner', 'studiare' ),
	'description'      => esc_html__( 'Show your video banner', 'studiare' ),
	'category'         => esc_html__( 'Studiare', 'studiare' ),
	'params'           => array(
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__('Video Link', 'studiare'),
			'param_name'  => 'video_link',
			'value'       => '',
			'description' => esc_html__( 'Put your youtube, vimeo link here.', 'studiare' ),
			'admin_label' => true
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__('Title', 'studiare'),
			'param_name'  => 'title',
			'save_always' => true,
			'admin_label' => true
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Title Tag', 'studiare' ),
			'param_name' => 'title_tag',
			'value'      => array(
				'h2' => 'h2',
				'h3' => 'h3',
				'h4' => 'h4',
				'h5' => 'h5',
				'h6' => 'h6',
			),
			'std'        => 'h4',
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__('Subtitle', 'studiare'),
			'param_name'  => 'subtitle',
			'save_always' => true,
			'admin_label' => true
		),
		array(
			'type'        => 'attach_image',
			'heading'     => esc_html__('Video Banner', 'studiare'),
			'param_name'  => 'video_banner',
			'value'       => '',
			'save_always' => true,
			'admin_label' => true
		),

	)
) );

if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Cdb_Video_Banner extends WPBakeryShortCode {}
}