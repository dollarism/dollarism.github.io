<?php

# Testimonials Parent
vc_map( array(
	'base'             => 'cdb_testimonials',
	'name'             => esc_html__( 'Testimonials', 'studiare' ),
	'description'      => esc_html__( 'User testimonials slider or grid', 'studiare' ),
	'as_parent'        => array('only' => 'cdb_testimonial_item'),
	'category'         => esc_html__( 'Studiare', 'studiare' ),
	'params'           => array(
		array(
			'type'          => 'checkbox',
			'heading'       => esc_html__( 'Show Pagination', 'studiare' ),
			'param_name'    => 'show_pagination_control',
			'description'   => esc_html__( 'If "YES" pagination control will be added', 'studiare' ),
		),
		array(
			'type'          => 'checkbox',
			'heading'       => esc_html__( 'Slider Loop', 'studiare' ),
			'param_name'    => 'wrap',
			'description'   => esc_html__( 'Enables loop mode for slider', 'studiare' ),
		),

		array(
		'type' => 'dropdown',
		'heading' => esc_html__( 'تعداد ستون ها', 'studiare' ),
		'param_name' => 'slides_per_view',
		'value' => array(
			1,2
		),
		'std' => 2,
	),

	array(
		'type'          => 'checkbox',
		'heading'       => esc_html__( 'اجرای خودکار اسلایدر', 'studiare' ),
		'param_name'    => 'autoplay',
		'description'   => esc_html__( 'فعالسازی حالت اجرای خودکار کروسل', 'studiare' ),
	),

		array(
			'type'          => 'textfield',
			'heading'       => esc_html__( 'Extra class name', 'studiare' ),
			'param_name'    => 'el_class',
			'description'   => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'studiare' )
		),
		array(
			'type'       => 'css_editor',
			'heading'    => 'Css',
			'param_name' => 'css',
			'group'      => esc_html__( 'Design options', 'studiare' ),
		)
	),
	'js_view'          => 'VcColumnView'
) );

# Testimonials Child
vc_map( array(
	'base'             => 'cdb_testimonial_item',
	'name'             => esc_html__( 'Testimonial', 'studiare' ),
	'description'      => esc_html__( 'User testimonial', 'studiare' ),
	'as_child'         => array('only' => 'cdb_testimonials'),
	'category'         => esc_html__( 'Studiare', 'studiare' ),
	'params'           => array(
		array(
			'type'          => 'textfield',
			'heading'       => esc_html__( 'Name', 'studiare' ),
			'param_name'    => 'name',
			'description'   => esc_html__( 'User name', 'studiare' )
		),
		array(
			'type'          => 'textfield',
			'heading'       => esc_html__( 'User Role', 'studiare' ),
			'param_name'    => 'user_role',
			'description'   => esc_html__( 'User role', 'studiare' )
		),
		array(
			'type'          => 'attach_image',
			'heading'       => esc_html__( 'User Avatar', 'studiare' ),
			'param_name'    => 'image',
			'value'         => '',
			'description'   => esc_html__( 'Select image from media library.', 'studiare' )
		),
		array(
			'type'          => 'textfield',
			'heading'       => esc_html__( 'Image size', 'studiare' ),
			'param_name'    => 'img_size',
			'description'   => esc_html__( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'studiare' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'ویدئوی دانشجو', 'studiare' ),
			'description' => esc_html__('این یک دکمه برای نمایش پاپ آپ ویدئوی دانشجوی شما می باشد(اختیاری)', 'studiare'),
			'param_name' => 'preview_video_testimonial',
		),
		array(
			'type'          => 'textarea_html',
			'holder'        => 'blockquote',
			'heading'       => esc_html__( 'Text', 'studiare' ),
			'param_name'    => 'content'
		),
		array(
			'type'          => 'textfield',
			'heading'       => esc_html__( 'Extra class name', 'studiare' ),
			'param_name'    => 'el_class',
			'description'   => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'studiare' )
		),
	)
) );

if ( class_exists('WPBakeryShortCodesContainer') ) {
	class WPBakeryShortCode_Cdb_Testimonials extends WPBakeryShortCodesContainer {}
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Cdb_Testimonial_Item extends WPBakeryShortCode {}
}
