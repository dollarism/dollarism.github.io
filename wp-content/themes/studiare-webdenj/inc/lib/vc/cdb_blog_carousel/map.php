<?php

	vc_map( array(
		'base'             => 'cdb_blog_carousel',
		'name'             => esc_html__( 'کروسل نوشته های بلاگ', 'studiare' ),
		'description'      => esc_html__( 'نمایش اسلایدر نوشته های بلاگ', 'studiare' ),
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
			'heading' => esc_html__( 'تعداد ستون های کروسل', 'studiare' ),
			'param_name' => 'slides_per_view',
			'value' => array(
				1,2,3,4,5,6
			),
			'std' => 4,
			'group' => esc_html__( 'تنظیمات کروسل', 'studiare' )
		),

		array(
			'type'          => 'checkbox',
			'heading'       => esc_html__( 'اجرای خودکار اسلایدر', 'studiare' ),
			'param_name'    => 'autoplay',
			'description'   => esc_html__( 'فعالسازی حالت اجرای خودکار کروسل', 'studiare' ),
			'group' => esc_html__( 'تنظیمات کروسل', 'studiare' )
		),

		array(
			'type'          => 'checkbox',
			'heading'       => esc_html__( 'نمایش نقطه های صفحه گذاری', 'studiare' ),
			'param_name'    => 'show_pagination_control',
			'description'   => esc_html__( 'اگر فعال کنید ، نقطه های صفحه گذاری نمایش داده خواهد شد.', 'studiare' ),
			'group' => esc_html__( 'تنظیمات کروسل', 'studiare' )
		),

		array(
			'type'          => 'checkbox',
			'heading'       => esc_html__( 'نمایش دکمه های قبلی/بعدی', 'studiare' ),
			'param_name'    => 'show_prev_next_buttons',
			'description'   => esc_html__( 'اگر تیک بزنید ، دکمه های ناوبری قبلی و بعدی اضافه خواهند شد.', 'studiare' ),
			'group' => esc_html__( 'تنظیمات کروسل', 'studiare' )
		),

		array(
			'type'          => 'checkbox',
			'heading'       => esc_html__( 'حلقه کروسل', 'studiare' ),
			'param_name'    => 'wrap',
			'description'   => esc_html__( 'فعالسازی حلقه برای کروسل', 'studiare' ),
			'dependency'  => array('element' => 'portfolio_type', 'value' => array('carousel')),
			'group' => esc_html__( 'تنظیمات کروسل', 'studiare' )
		),

		)
	) );

	if ( class_exists('WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Cdb_Blog_Carousel extends WPBakeryShortCode {}
	}
