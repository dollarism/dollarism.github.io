<?php

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || codebean_is_plugin_active_for_network( 'woocommerce/woocommerce.php' ) ) {

	vc_map( array(
		'base'             => 'cdb_courses_carousel',
		'name'             => esc_html__( 'کروسل دوره ها', 'studiare' ),
		'description'      => esc_html__( 'نمایش اسلایدر دوره ها', 'studiare' ),
		'category'         => esc_html__( 'Studiare', 'studiare' ),
		'params'           => array(

			array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'نوع دوره', 'studiare' ),
			'param_name' => 'courses_type',
			'value' => array(
				esc_html__( 'همه دوره ها', 'studiare' ) => 'all',
				esc_html__( 'دوره های تخفیف خورده', 'studiare' ) => 'onsale',
				esc_html__( 'دوره های شاخص', 'studiare' ) => 'featured'
			),
			'admin_label' => true
		),

			array(
				'type' => 'textfield',
				'heading' => esc_html__('تعداد کل آیتم ها', 'studiare' ),
				'param_name' => 'posts_per_page',
				'std' => 6,
			),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'مرتب سازی بر اساس', 'studiare' ),
			'param_name' => 'orderby',
			'value' => array(
				esc_html__( 'جدیدترین', 'studiare' ) => 'date',
				esc_html__( 'آخرین بروزرسانی', 'studiare' ) => 'modified',
				esc_html__( 'بیشترین فروش', 'studiare' ) => 'sales',
				esc_html__( 'تصادفی', 'studiare' ) => 'rand',
				esc_html__( 'قیمت', 'studiare' ) => 'price',
			),
			),

			array(
					'type'			=> 'textfield',
					'heading'		=> __( 'شامل دوره های از دسته بندی', 'studiare' ),
					'param_name' 	=> 'courses_cat_include',
					'description'	=> __( 'نامک دسته بندی های مورد نظر خود را وارد کرده و با کاما "," از هم جدایشان کنید.', 'studiare' ),
								),

			array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'تعداد ستون های کروسل', 'studiare' ),
			'param_name' => 'slides_per_view',
			'value' => array(
				1,2,3,4,5,6
			),
			'std' => 3,
			'group' => esc_html__( 'تنظیمات کروسل', 'studiare' )
		),

		array(
			'type'          => 'checkbox',
			'heading'       => esc_html__( 'اجرای خودکار اسلایدر', 'studiare' ),
			'param_name'    => 'autoplay',
			'description'   => esc_html__( 'فعالسازی حالت اجرای خودکار کروسل', 'studiare' ),
			'dependency'  => array('element' => 'portfolio_type', 'value' => array('carousel')),
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
		class WPBakeryShortCode_Cdb_Courses_Carousel extends WPBakeryShortCode {}
	}

}
