<?php

vc_map( array(
	'base'             => 'cdb_gallery_carousel',
	'name'             => esc_html__( 'Gallery Carosuel', 'studiare' ),
	'description'      => esc_html__( 'Show gallery in carousel', 'studiare' ),
	'category'         => esc_html__( 'Studiare', 'studiare' ),
	'params'           => array(
		array(
			'type'           => 'attach_images',
			'heading'        => esc_html__( 'Images', 'studiare' ),
			'param_name'     => 'images',
			'value'          => '',
			'description'    => esc_html__( 'Select images from media library.', 'studiare' )
		),
		array(
			'type'           => 'textfield',
			'heading'        => esc_html__( 'Image Size', 'studiare' ),
			'param_name'     => 'img_size',
			'value'          => '',
			'description'    => esc_html__( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'studiare' )
		),
		array(
		'type' => 'dropdown',
		'heading' => esc_html__( 'تعداد ستون های کروسل', 'studiare' ),
		'param_name' => 'slides_per_view',
		'value' => array(
			1,2,3,4,5,6,7,8
		),
		'std' => 6,
		'group'         => esc_html__( 'Carousel', 'studiare' ),
  	),
		array(
			'type'          => 'checkbox',
			'heading'       => esc_html__( 'Show Pagination', 'studiare' ),
			'param_name'    => 'show_pagination_control',
			'description'   => esc_html__( 'If "YES" pagination control will be added', 'studiare' ),
			'dependency'    => array( 'element' => 'view', 'value' => array('carousel') ),
			'group'         => esc_html__( 'Carousel', 'studiare' ),
		),
		array(
			'type'          => 'checkbox',
			'heading'       => esc_html__( 'Show Prev/Next Buttons', 'studiare' ),
			'param_name'    => 'show_prev_next_buttons',
			'description'   => esc_html__( 'If "YES" prev/next control will be added', 'studiare' ),
			'dependency'    => array( 'element' => 'view', 'value' => array('carousel') ),
			'group'         => esc_html__( 'Carousel', 'studiare' ),
		),
		array(
			'type'          => 'checkbox',
			'heading'       => esc_html__( 'Carousel Loop', 'studiare' ),
			'param_name'    => 'wrap',
			'description'   => esc_html__( 'Enables loop mode for carousel', 'studiare' ),
			'dependency'    => array( 'element' => 'view', 'value' => array('carousel') ),
			'group'         => esc_html__( 'Carousel', 'studiare' ),
		),
		array(
			'type'           => 'dropdown',
			'heading'        => esc_html__( 'On click action', 'studiare' ),
			'param_name'     => 'on_click',
			'value'          => array(
				esc_html__('Lightbox','studiare') => 'lightbox',
				esc_html__('Custom link', 'studiare') => 'links',
				esc_html__('None', 'studiare') => 'none'
			),
			'group'         => esc_html__( 'Settings', 'studiare' ),
		),
		array(
			'type'           => 'exploded_textarea_safe',
			'heading'        => esc_html__( 'Custom links', 'studiare' ),
			'param_name'     => 'custom_links',
			'description'    => esc_html__( 'Enter links for each slide (Note: divide links with linebreaks (Enter)).', 'studiare' ),
			'dependency'     => array(
				'element' => 'on_click',
				'value' => array( 'links' ),
			),
			'group'         => esc_html__( 'Settings', 'studiare' ),
		),
		array(
			'type'           => 'checkbox',
			'heading'        => esc_html__( 'Open in new tab', 'studiare' ),
			'save_always'    => true,
			'param_name'     => 'target_blank',
			'value'          => array( esc_html__( 'Yes, please', 'studiare' ) => 'yes' ),
			'default'        => 'yes',
			'dependency'     => array(
				'element' => 'on_click',
				'value' => array( 'links' ),
			),
			'group'         => esc_html__( 'Settings', 'studiare' ),
		),
		array(
			'type'          => 'textfield',
			'heading'       => esc_html__( 'Extra class name', 'studiare' ),
			'param_name'    => 'el_class',
			'description'   => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'studiare' )
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
	class WPBakeryShortCode_Cdb_Gallery_Carousel extends WPBakeryShortCode {}
}
