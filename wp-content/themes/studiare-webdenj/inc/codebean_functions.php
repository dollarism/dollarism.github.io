<?php
/**
 * Codebean Functions File
 */


add_theme_support( 'post-formats', array( 'audio', 'video' ) );

// custom excerpt length
function studiare_custom_excerpt_length( $length ) {
	return 15;
}
add_filter( 'excerpt_length', 'studiare_custom_excerpt_length', 999 );

// remove dots from read more excerpt
if ( ! function_exists('studiare_excerpt_more' ) ) {
	function studiare_excerpt_more( $more ) {
		return '&hellip;';
	}
}

add_filter( 'excerpt_more', 'studiare_excerpt_more' );

// Studiare get css from settings
if ( ! function_exists( 'studiare_settings_css' ) ) {
	function studiare_settings_css() {
		$logo_img_width = '152';
		$logo_padding = array(
            'padding-top' => '10px',
            'padding-right' => '0px',
            'padding-bottom' => '10px',
            'padding-left' => '20px'
        );
		$header_height = '100';

		if ( class_exists('Redux') ) {
			$logo_img_width = codebean_option('logo_img_width');
			$logo_padding = codebean_option('logo_padding');
			$header_height = codebean_option( 'header_height' );
		}

		ob_start(); ?>

		/* Header Settings */
        .site-header {
            min-height: <?php echo esc_html( $header_height ); ?>px;
        }

        .site-header .site-logo .studiare-logo-wrap img {
			max-width: <?php echo esc_html( $logo_img_width ); ?>px;
		}

        .site-header .site-logo .studiare-logo-wrap {
			padding-top: <?php echo $logo_padding['padding-top']; ?>;
			padding-right: <?php echo $logo_padding['padding-right']; ?>;
			padding-bottom: <?php echo $logo_padding['padding-bottom']; ?>;
			padding-left: <?php echo $logo_padding['padding-left']; ?>;
		}

		<?php

		return ob_get_clean();
	}
}

// Get Enabled Options from Redux
function codebean_get_enabled_options( $items ) {
	$enabled = array();

	if ( isset( $items['enabled'] ) ) {
		foreach ( $items['enabled'] as $item_id => $item ) {

			if ( $item_id == 'placebo' ) {
				continue;
			}

			$enabled[ $item_id ] = $item;
		}
	}

	return $enabled;
}

// Codebean Excerpt Clean
function codebean_clean_excerpt( $content, $strip_tags = false ) {
	$content = strip_shortcodes( $content );
	$content = preg_replace( '#<style.*?>(.*?)</style>#i', '', $content );
	$content = preg_replace( '#<script.*?>(.*?)</script>#i', '', $content );

	return $strip_tags ? strip_tags( $content ) : $content;
}

# Print attribute values based on boolean value
function when_match( $bool, $str = '', $otherwise_str = '', $echo = true ) {
	$str = trim( $bool ? $str : $otherwise_str );

	if ( $str ) {
		$str = ' ' . $str;

		if ( $echo ) {
			echo esc_attr($str);
			return '';
		}
	}

	return $str;
}

// Studiare Page Title
if ( ! function_exists( 'studiare_page_title' ) ) {
	function studiare_page_title($display = true, $single_posts = '', $vacancies_posts = '')
	{
		global $wp_locale;

		$m = get_query_var('m');
		$year = get_query_var('year');
		$monthnum = get_query_var('monthnum');
		$day = get_query_var('day');
		$search = get_query_var('s');
		$title = '';


		// If there is a post
		if ( ( is_home() && !is_front_page()) || (is_page() && !is_front_page()) || is_front_page()) {
			$title = single_post_title('', false);
		}

		if ( is_single() ) {

			if ( get_post_type( get_the_ID() == 'event' ) ) {
				$title = single_post_title( '', false );
			}

			if ( get_post_type( get_the_ID() ) == 'post' ) {
				$categories = get_the_category();
				$title = esc_html__( 'Blog', 'studiare' );
			}

        }

		if (is_home()) {
			if (!get_option('page_for_posts')) {
				$title = $single_posts;
			}
		}

		// If there's a post type archive
		if (is_post_type_archive()) {
			$post_type = get_query_var('post_type');
			if (is_array($post_type)) {
				$post_type = reset($post_type);
			}
			$post_type_object = get_post_type_object($post_type);
			if (!$post_type_object->has_archive) {
				$title = post_type_archive_title('', false);
			}
		}

		// If there's a category or tag
		if (is_category() || is_tag()) {
			$title = single_term_title('', false);
		}

		// If there's a taxonomy
		if (is_tax()) {
			$term = get_queried_object();
			if ($term) {
				$tax = get_taxonomy($term->taxonomy);
				$title = single_term_title('', false);
			}
		}

		// If there's an author
		if (is_author() && !is_post_type_archive()) {
			$author = get_queried_object();
			if ($author) {
				$title = $author->display_name;
			}
		}

		// Post type archives with has_archive should override terms.
		if (is_post_type_archive() && $post_type_object->has_archive) {
			if (function_exists('is_shop') && is_shop()) {
				$title = get_the_title(get_option('woocommerce_shop_page_id'));
			} else {
				$title = post_type_archive_title('', false);
			}
		}

		// If there's a month
		if (is_archive() && !empty($m)) {
			$my_year = substr($m, 0, 4);
			$my_month = $wp_locale->get_month(substr($m, 4, 2));
			$my_day = intval(substr($m, 6, 2));
			$title = $my_year . ($my_month ? $my_month : '') . ($my_day ? $my_day : '');
		}

		// If there's a year
		if (is_archive() && !empty($year)) {
			$title = $year;
			if (!empty($monthnum)) {
				$title .= ' ' . $wp_locale->get_month($monthnum);
			}
			if (!empty($day)) {
				$title .= ' ' . zeroise($day, 2);
			}
		}

		// If it's a search
		if (is_search()) {
			/* translators: 1: separator, 2: search phrase */
			$title = esc_html__('Search Results', 'studiare');
		}

		// If it's a 404 page
		if (is_404()) {
			$title = esc_html__('Page not found', 'studiare');
		}

		if ($display) {
			echo esc_html($title);
		} else {
			return esc_html($title);
		}
	}
}


// Studiare Breadcrumbs
if ( ! function_exists( 'studiare_breadcrumbs' ) ) {
    function studiare_breadcrumbs() {
	    $prefix = '_studiare_';

        if ( function_exists( 'bcn_display' ) && ! get_post_meta(get_the_ID(), $prefix . 'disable_breadcrumbs', true) ) { ?>
            <div class="breadcrumbs">
		        <?php bcn_display(); ?>
            </div>
        <?php }
    }
}

// Studiare Metaboxes
add_action( 'cmb2_admin_init', 'studiare_metaboxes' );

function studiare_metaboxes() {
	// Start with an underscore to hide fields from custom fields list
	$prefix = '_studiare_';



	$studiare_metaboxes = new_cmb2_box( array(
			'id'            => $prefix . 'page_metabox',
			'title'         => __( 'تنظیمات صفحه', 'cmb2' ),
			'object_types'  => array( 'product', 'page', 'post' ), // Post type
			'vertical_tabs' => false, // Set vertical tabs, default false
	        'tabs' => array(


							array(
	                'id'    => 'tab-1',
	                'icon' => 'dashicons-category',
	                'title' => 'تنظمیات صفحه',
	                'fields' => array(
										$prefix . 'disable_title',
										$prefix . 'disable_breadcrumbs',
										$prefix . 'footer_off',
										$prefix . 'copyrights_off',
										$prefix . 'top_bar_off',
										$prefix . 'header_off',
	                ),
	            ),

              array(
	                'id'    => 'tab-2',
	                'icon' => 'dashicons-admin-appearance',
	                'title' => 'تنظمیات استایل سربرگ',
	                'fields' => array(
										$prefix . 'header_bg_color',
                    $prefix . 'header_bg_img',
	                ),
	            ),

	        )
		) );


		$courses_metaboxes = new_cmb2_box( array(
				'id'            => $prefix . 'courses_metabox',
				'title'         => __( 'تنظیمات دوره', 'cmb2' ),
				'object_types'  => array( 'product' ), // Post type
				'vertical_tabs' => false, // Set vertical tabs, default false
		        'tabs' => array(

								array(
		                'id'    => 'tab-1',
		                'icon' => 'dashicons-welcome-learn-more',
		                'title' => 'ویژگی های دوره',
		                'fields' => array(
											$prefix . 'course_add_to_cart_text',
	                    $prefix . 'course_teacher',
											$prefix . 'course_teacher_2',
											$prefix . 'course_language',
											$prefix . 'course_duration',
											$prefix . 'course_type',
											$prefix . 'course_prerequisite',
											$prefix . 'course_start_date',
											$prefix . 'course_update_date',
											$prefix . 'course_file_size',
											$prefix . 'course_lesseons',
											$prefix . 'course_support',
											$prefix . 'course_receive_type',
											$prefix . 'course_certificate',
											$prefix . 'course_level',
											$prefix . 'course_percent',
											'feture_group',
											$prefix . 'feture_title',
											$prefix . 'feture_input',
		                ),
		            ),

								array(
		                'id'    => 'tab-2',
		                'icon' => 'dashicons-format-video',
		                'title' => 'ویدئو پیشنمایش دوره',
		                'fields' => array(
											$prefix . 'course_video',
											$prefix . 'course_disable_image',
											$prefix . 'poster_video_coures',
		                ),
		            ),

								array(
		                'id'    => 'tab-3',
		                'icon' => 'dashicons-location',
		                'title' => 'محل برگزاری',
		                'fields' => array(
											$prefix . 'location_google_map',
		                ),
		            ),


		        )
			) );

	$studiare_metaboxes->add_field( array(
		'name' => esc_html__( 'Disable Page title', 'studiare' ),
		'desc' => esc_html__( 'You can hide page heading for this page', 'studiare' ),
		'id'   => $prefix . 'disable_title',
		'type' => 'checkbox',
	) );

	$studiare_metaboxes->add_field( array(
		'name' => esc_html__( 'Disable breadcrumbs', 'studiare' ),
		'desc' => esc_html__( 'You can hide breadcrumbs for this page', 'studiare' ),
		'id'   => $prefix . 'disable_breadcrumbs',
		'type' => 'checkbox',
	) );

	$studiare_metaboxes->add_field( array(
		'name' => esc_html__( 'Disable footer widgets', 'studiare' ),
		'desc' => esc_html__( 'You can disable footer widgets area for this page', 'studiare' ),
		'id'   => $prefix . 'footer_off',
		'type' => 'checkbox',
	) );

	$studiare_metaboxes->add_field( array(
		'name' => esc_html__( 'Disable sub-footer', 'studiare' ),
		'desc' => esc_html__( 'You can disable sub-footer for this page', 'studiare' ),
		'id'   => $prefix . 'copyrights_off',
		'type' => 'checkbox',
	) );

	$studiare_metaboxes->add_field( array(
		'name' => esc_html__( 'Disable top-bar', 'studiare' ),
		'desc' => esc_html__( 'You can disable top-bar for this page', 'studiare' ),
		'id'   => $prefix . 'top_bar_off',
		'type' => 'checkbox',
	) );

	$studiare_metaboxes->add_field( array(
		'name' => esc_html__( 'غیر فعال کردن سربرگ', 'studiare' ),
		'desc' => esc_html__( '', 'studiare' ),
		'id'   => $prefix . 'header_off',
		'type' => 'checkbox',
	) );

	$studiare_metaboxes->add_field( array(
			'name' => esc_html__( 'رنگ پس زمینه', 'herozh' ),
			'desc' => esc_html__( 'رنگ پس زمینه سربرگ این محصول را انتخاب کنید', 'herozh' ),
			'id' => $prefix . 'header_bg_color',
			'type' => 'colorpicker',
	) );

	$studiare_metaboxes->add_field( array(
			'name' => esc_html__( 'تصویر پس زمینه', 'herozh' ),
			'desc' => esc_html__( 'تصویر پس زمینه سربرگ این محصول را آپلود کنید (اختیاری)', 'herozh' ),
			'id' => $prefix . 'header_bg_img',
			'type' => 'file',
			'options' => array(
					'url' => false,
			 ),
	) );


	$courses_metaboxes->add_field( array(
		'name' => esc_html__( 'متن سفارشی دکمه ثبت نام', 'studiare' ),
		'desc' => esc_html__( 'می توانید متن دکمه خرید دوره را سفارشی وارد کنید', 'studiare' ),
		'default' => '',
		'id'   => $prefix . 'course_add_to_cart_text',
		'type' => 'text',
    ) );

    $courses_metaboxes->add_field( array(
        'name' => esc_html__( 'Teacher', 'studiare' ),
        'desc' => esc_html__( 'Select teacher for this course', 'studiare' ),
        'id' => $prefix . 'course_teacher',
        'type' => 'select',
        'options' => studiare_get_teachers_list()
    ) );

		$courses_metaboxes->add_field( array(
        'name' => esc_html__( 'مدرس دوم (اختیاری)', 'studiare' ),
        'desc' => esc_html__( 'مدرس دوم را در صورت وجود انتخاب کنید', 'studiare' ),
        'id' => $prefix . 'course_teacher_2',
        'type' => 'select',
        'options' => studiare_get_teachers_list()
    ) );

	$courses_metaboxes->add_field( array(
		'name' => esc_html__( 'Language', 'studiare' ),
		'id'   => $prefix . 'course_language',
		'type' => 'text',
		'default' => ''
	) );

	$courses_metaboxes->add_field( array(
		'name' => esc_html__( 'Duration', 'studiare' ),
		'desc' => esc_html__( 'Duration of course in hours', 'studiare' ),
		'default' => '',
		'id'   => $prefix . 'course_duration',
		'type' => 'text',
    ) );

	$courses_metaboxes->add_field( array(
		'name' => esc_html__( 'نوع دوره', 'studiare' ),
		'desc' => esc_html__( 'مثلا دروه حضوری است یا غیر حضوری؟', 'studiare' ),
		'default' => '',
		'id'   => $prefix . 'course_type',
		'type' => 'text',
    ) );

	$courses_metaboxes->add_field( array(
		'name' => esc_html__( 'پیش نیاز دوره', 'studiare' ),
		'desc' => esc_html__( 'مثلا HTML CSS', 'studiare' ),
		'default' => '',
		'id'   => $prefix . 'course_prerequisite',
		'type' => 'text',
    ) );

	$courses_metaboxes->add_field( array(
		'name' => esc_html__( 'تاریخ شروع دوره', 'studiare' ),
		'desc' => esc_html__( 'مثلا: 11 اردیبهشت 1397', 'studiare' ),
		'default' => '',
		'id'   => $prefix . 'course_start_date',
		'type' => 'text',
    ) );

	$courses_metaboxes->add_field( array(
		'name' => esc_html__( 'تاریخ بروزرسانی دوره', 'studiare' ),
		'desc' => esc_html__( 'مثلا: 11 اردیبهشت 1397', 'studiare' ),
		'default' => '',
		'id'   => $prefix . 'course_update_date',
		'type' => 'text',
    ) );

	$courses_metaboxes->add_field( array(
		'name' => esc_html__( 'حجم کل دوره', 'studiare' ),
		'desc' => esc_html__( 'مثلا: 450 مگابایت', 'studiare' ),
		'default' => '',
		'id'   => $prefix . 'course_file_size',
		'type' => 'text',
    ) );

	$courses_metaboxes->add_field( array(
		'name' => esc_html__( 'Lessons', 'studiare' ),
		'desc' => esc_html__( 'Number of lessons included on course', 'studiare' ),
		'default' => '',
		'id'   => $prefix . 'course_lesseons',
		'type' => 'text',
	) );

	$courses_metaboxes->add_field( array(
		'name' => esc_html__( 'روش پشتیبانی', 'studiare' ),
		'desc' => esc_html__( 'مثلا: تلفنی یا ارسال تیکت', 'studiare' ),
		'id'   => $prefix . 'course_support',
		'type' => 'text',
        'default' => ''
	) );

	$courses_metaboxes->add_field( array(
		'name' => esc_html__( 'روش دریافت', 'studiare' ),
		'desc' => esc_html__( 'مثلا: دانلود فایل دورس', 'studiare' ),
		'id'   => $prefix . 'course_receive_type',
		'type' => 'text',
        'default' => ''
	) );

	$courses_metaboxes->add_field( array(
		'name' => esc_html__( 'Certifitcate', 'studiare' ),
		'id'   => $prefix . 'course_certificate',
		'type' => 'text',
        'default' => ''
	) );

	$courses_metaboxes->add_field( array(
		'name' => esc_html__( 'Skill Level', 'studiare' ),
		'id'   => $prefix . 'course_level',
		'type' => 'text',
        'default' => ''
	) );

	$courses_metaboxes->add_field( array(
		'name' => esc_html__( 'درصد پیشرفت دوره', 'studiare' ),
		'id'   => $prefix . 'course_percent',
		'desc' => esc_html__( 'فقط عدد را بدون علامت درصد وارد کنید.', 'studiare' ),
		'type' => 'text',
        'default' => ''
	) );

	$courses_group_feture = $courses_metaboxes->add_field( array(
		'id'          => 'feture_group',
		'type'        => 'group',
		'description' => __( 'ویژگی های سفارشی دلخواه برای محصول', 'studiare' ),
		'options'     => array(
			'group_title'       => __( 'ویژگی های سفارشی', 'studiare' ),
			'add_button'        => __( 'افزودن ویژگی جدید', 'studiare' ),
			'remove_button'     => __( 'حذف ویژگی', 'studiare' ),
			'sortable'          => true,
		),
	) );

	$courses_metaboxes->add_group_field( $courses_group_feture, array(
		'name' => esc_html__( 'عنوان ویژگی', 'studiare' ),
		'id'   => $prefix . 'feture_title',
		'type' => 'text',
	) );

	$courses_metaboxes->add_group_field( $courses_group_feture, array(
		'name' => esc_html__( 'مقدار روبروی ویژگی', 'studiare' ),
		'id'   => $prefix . 'feture_input',
		'type' => 'text',
	) );

	$courses_metaboxes->add_field( array(
        'name' => esc_html__( 'Intro Video URL', 'studiare' ),
        'desc' => esc_html__( 'Supports 3 types of video urls: Direct video link, Youtube link, Vimeo link.', 'studiare' ),
        'id'   => $prefix . 'course_video',
        'type' => 'file',
        'default' => ''
    ) );

	$courses_metaboxes->add_field( array(
        'name' => esc_html__( 'غیر فعال کردن حالت پاپ آپ پیشنمایش ویدئویی', 'studiare' ),
        'desc' => esc_html__( 'اگر این گزینه را تیک بزنید ، تصویر شاخص اصلی از بالای برگه دوره مخفی شده و باید تصویر کاور اختصاصی از فیلد پایین برای پیشنمایش ویدئویی دوره آپلود کنید.', 'studiare' ),
        'id'   => $prefix . 'course_disable_image',
        'type' => 'checkbox',
        'default' => ''
    ) );

	$courses_metaboxes->add_field( array(
		'name' => esc_html__( 'پوستر کاور ویدئو', 'studiare' ),
		'id'   => $prefix . 'poster_video_coures',
		'type' => 'file',
		'options' => array(
		'url' => true,
		),
	) );

	$extra_metaboxes = new_cmb2_box( array(
			'id'           => 'extra_metabox',
				'title'        => esc_html__( 'ناحیه اضافی برای استفاده دلخواه', 'studiare' ),
				'object_types' => array( 'product' ),
				'context'      => 'normal',
				'priority'     => 'core',
				'show_names'   => true,
		) );

	$extra_metaboxes->add_field( array(
		'name' => esc_html__( 'محل وارد کردن متن،کد یا شرتکد دلخواه شما', 'studiare' ),
		'desc' => esc_html__( '', 'studiare' ),
		'id'   => $prefix . 'extra_content',
		'type' => 'wysiwyg',
	) );



	$studiare_metaboxes_posts = new_cmb2_box( array(
			'id'            => $prefix . 'post_metabox',
			'title'         => __( 'تنظیمات نوشته', 'cmb2' ),
			'object_types'  => array( 'post' ), // Post type
			'vertical_tabs' => false, // Set vertical tabs, default false
	        'tabs' => array(


							array(
	                'id'    => 'tab-1',
	                'icon' => 'dashicons-category',
	                'title' => 'تنظمیات سایدبار',
	                'fields' => array(
										$prefix . 'sidebar_off',
	                ),
	            ),

              array(
	                'id'    => 'tab-2',
	                'icon' => 'dashicons-microphone',
	                'title' => 'تنظمیات نوشته صوتی',
	                'fields' => array(
										$prefix . 'audio_post_id',
	                ),
	            ),

							array(
	                'id'    => 'tab-3',
	                'icon' => 'dashicons-video-alt3',
	                'title' => 'تنظمیات نوشته ویدئویی',
	                'fields' => array(
										$prefix . 'video_post_id',
										$prefix . 'poster_video_post_id',
	                ),
	            ),

							array(
	                'id'    => 'tab-4',
	                'icon' => 'dashicons-download',
	                'title' => 'باکس دانلود نوشته',
	                'fields' => array(

										'studiare_box_title',
										 $prefix . 'download_login',
										 $prefix . 'download_box_content',
										 $prefix . 'download_box_password',
										 'studiare_box_title_2',
										 $prefix . 'link_title_1',
										 $prefix . 'link_url_1',
										 $prefix . 'link_title_2',
										 $prefix . 'link_url_2',
										 $prefix . 'link_title_3',
										 $prefix . 'link_url_3',
										 $prefix . 'link_title_4',
										 $prefix . 'link_url_4',
										 $prefix . 'link_title_5',
										 $prefix . 'link_url_5',
										 'download_group',
										 $prefix . 'download_title_more',
										 $prefix . 'link_download_title_more',

	                ),
	            ),

							array(
	                'id'    => 'tab-5',
	                'icon' => 'dashicons-admin-appearance',
	                'title' => 'دوره های مرتبط',
	                'fields' => array(
										$prefix . 'product_cats',
	                ),
	            ),

	        )
		) );



	$studiare_metaboxes_posts->add_field( array(
		'name' => esc_html__( 'غیر فال کردن سایدبار فقط برای این نوشته', 'studiare' ),
		'desc' => esc_html__( '', 'studiare' ),
		'id'   => $prefix . 'sidebar_off',
		'type' => 'checkbox',
	) );



	$studiare_metaboxes_posts->add_field( array(
		'name' => esc_html__( 'دسته بندی مرتبط دوره ها با این نوشته', 'studiare' ),
		'desc' => esc_html__( 'فقط کافی است که نامک دسته بندی های مورد نظر را اینجا وارد کنید. دسته بندی ها را با کاما , از هم جدا کنید. مثلا: wordpress,joomla', 'studiare' ),
		'id'   => $prefix . 'product_cats',
		'type' => 'text',
	) );




	$courses_metaboxes->add_field( array(
		'name' => esc_html__( 'کد نقشه گوگل', 'studiare' ),
		'desc' => esc_html__( 'کد Embed a map محل مورد نظر خود که از اشتراک گذاری گوگل مپ دریافت کرده اید را وارد کنید.', 'studiare' ),
		'id'   => $prefix . 'location_google_map',
		'type' => 'textarea_code',
	) );


	// Post Metaboxes

	$studiare_metaboxes_posts->add_field( array(
		'name' => esc_html__( 'آپلود فایل ویدئوی شما', 'studiare' ),
		'id'   => $prefix . 'video_post_id',
		'type' => 'file',
		'options' => array(
		'url' => true,
		),
	) );

	$studiare_metaboxes_posts->add_field( array(
		'name' => esc_html__( 'پوستر کاور ویدئو', 'studiare' ),
		'id'   => $prefix . 'poster_video_post_id',
		'type' => 'file',
		'options' => array(
		'url' => true,
		),
	) );

	$studiare_metaboxes_posts->add_field( array(
		'name' => esc_html__( 'آپلود فایل صوتی شما', 'studiare' ),
		'id'   => $prefix . 'audio_post_id',
		'type' => 'file',
		'options' => array(
		'url' => true,
		),
	) );


	// Download Box Metaboxes

  $studiare_metaboxes_posts->add_field( array(
    'name' => 'تنظیمات مربوط به باکس دانلود نوشته',
    'desc' => 'به کمک این بخش می توانید فایل های قابل دانلود نوشته خود را در باکس دانلود درج کنید',
    'type' => 'title',
    'id'   => 'studiare_box_title'
    ) );

		$studiare_metaboxes_posts->add_field( array(
	        'name' => esc_html__( 'محدود کردن مشاهده لینک های دانلود به اعضای وارد شده', 'studiare' ),
	        'desc' => esc_html__( 'اگر این گزینه را تیک بزنید، فقط اعضایی که عضو و وارد حساب کاربری خود شده باشند لینک ها را مشاهده خواهند کرد.', 'studiare' ),
	        'id'   => $prefix . 'download_login',
	        'type' => 'checkbox',
	        'default' => ''
	    ) );


  $studiare_metaboxes_posts->add_field( array(
  		'name' => esc_html__( 'محل وارد کردن متن دلخواه شما برای باکس دانلود', 'studiare' ),
  		'desc' => esc_html__( '', 'studiare' ),
  		'id'   => $prefix . 'download_box_content',
  		'type' => 'wysiwyg',
  	) );

    $studiare_metaboxes_posts->add_field( array(
        'name' => esc_html__( 'پسورد فایل های زیپ', 'studiare' ),
        'desc' => esc_html__( 'اگر پسورد ندارد بنویسید : ندارد', 'studiare' ),
        'id'   => $prefix . 'download_box_password',
        'type' => 'text',
      ) );

  $studiare_metaboxes_posts->add_field( array(
      'name' => 'لینک های دانلود',
      'desc' => 'لینک های دانلود خود را در فیلد های زیر وارد کنید',
      'type' => 'title',
      'id'   => 'studiare_box_title_2'
      ) );

  $studiare_metaboxes_posts->add_field( array(
      'name' => esc_html__( 'عنوان لینک اول', 'studiare' ),
      'desc' => esc_html__( '', 'studiare' ),
      'id'   => $prefix . 'link_title_1',
      'type' => 'text',
    ) );

  $studiare_metaboxes_posts->add_field( array(
        'name' => esc_html__( 'نشانی لینک اول', 'studiare' ),
        'desc' => esc_html__( '', 'studiare' ),
        'id'   => $prefix . 'link_url_1',
        'type' => 'text_url',
    ) );

    $studiare_metaboxes_posts->add_field( array(
        'name' => esc_html__( 'عنوان لینک دوم', 'studiare' ),
        'desc' => esc_html__( '', 'studiare' ),
        'id'   => $prefix . 'link_title_2',
        'type' => 'text',
      ) );

    $studiare_metaboxes_posts->add_field( array(
          'name' => esc_html__( 'نشانی لینک دوم', 'studiare' ),
          'desc' => esc_html__( '', 'studiare' ),
          'id'   => $prefix . 'link_url_2',
          'type' => 'text_url',
      ) );
    $studiare_metaboxes_posts->add_field( array(
          'name' => esc_html__( 'عنوان لینک سوم', 'studiare' ),
          'desc' => esc_html__( '', 'studiare' ),
          'id'   => $prefix . 'link_title_3',
          'type' => 'text',
        ) );

    $studiare_metaboxes_posts->add_field( array(
            'name' => esc_html__( 'نشانی لینک سوم', 'studiare' ),
            'desc' => esc_html__( '', 'studiare' ),
            'id'   => $prefix . 'link_url_3',
            'type' => 'text_url',
        ) );

		$studiare_metaboxes_posts->add_field( array(
		          'name' => esc_html__( 'عنوان لینک چهارم', 'studiare' ),
		          'desc' => esc_html__( '', 'studiare' ),
		          'id'   => $prefix . 'link_title_4',
		          'type' => 'text',
		        ) );

		$studiare_metaboxes_posts->add_field( array(
		            'name' => esc_html__( 'نشانی لینک چهارم', 'studiare' ),
		            'desc' => esc_html__( '', 'studiare' ),
		            'id'   => $prefix . 'link_url_4',
		            'type' => 'text_url',
		 ) );

		 $studiare_metaboxes_posts->add_field( array(
		 			'name' => esc_html__( 'عنوان لینک پنجم', 'studiare' ),
		 			'desc' => esc_html__( '', 'studiare' ),
		 			'id'   => $prefix . 'link_title_5',
		 			'type' => 'text',
		 		) );

		 $studiare_metaboxes_posts->add_field( array(
		 				'name' => esc_html__( 'نشانی لینک پنجم', 'gigafile' ),
		 				'desc' => esc_html__( '', 'gigafile' ),
		 				'id'   => $prefix . 'link_url_5',
		 				'type' => 'text_url',
		 		) );

				$studiare_group_downloads = $studiare_metaboxes_posts->add_field( array(
						'id'          => 'download_group',
						'type'        => 'group',
						'description' => __( 'برای اضافه کردن لینک دانلود بیشتر', 'studiare' ),
						'options'     => array(
							'group_title'       => __( 'لینک دانلود', 'studiare' ),
							'add_button'        => __( 'اضافه کردن لینک دانلود دیگر', 'studiare' ),
							'remove_button'     => __( 'حذف لینک دانلود', 'studiare' ),
							'sortable'          => false,
						),
				) );

		$studiare_metaboxes_posts->add_group_field( $studiare_group_downloads, array(
			'name' => esc_html__( 'عنوان لینک', 'studiare' ),
			'id'   => $prefix . 'download_title_more',
			'type' => 'text',
		) );

		$studiare_metaboxes_posts->add_group_field( $studiare_group_downloads, array(
			'name' => esc_html__( 'نشانی لینک', 'studiare' ),
			'id'   => $prefix . 'link_download_title_more',
			'type' => 'text_url',
   	) );


}

// Needs Header
if ( ! function_exists( 'studiare_needs_header' ) ) {
    function studiare_needs_header() {
	    return ( ! studiare_maintenance_page() );
    }
}

// Needs Footer
if( ! function_exists( 'studiare_needs_footer' ) ) {
	function studiare_needs_footer() {
		return ( ! studiare_maintenance_page() );
	}
}

// Is maintenance page
if( ! function_exists( 'studiare_maintenance_page' ) ) {
	function studiare_maintenance_page() {

		$pages_ids = studiare_pages_ids_from_template( 'maintenance' );

		if( ! empty( $pages_ids ) && is_page( $pages_ids ) ) {
			return true;
		}

		return false;
	}
}

// Get page id by template name
if( ! function_exists( 'studiare_pages_ids_from_template' ) ) {
	function studiare_pages_ids_from_template( $name ) {
		$pages = get_pages(array(
			'meta_key' => '_wp_page_template',
			'meta_value' => $name . '.php'
		));

		$return = array();

		foreach($pages as $page){
			$return[] = $page->ID;
		}

		return $return;
	}
}

// Function that echoes generated style attributes
function studiare_inline_style($value) {
	echo studiare_get_inline_style($value);
}

// Function that generates style attribute and returns generated string
function studiare_get_inline_style($value) {
	return studiare_get_inline_attr($value, 'style', ';');
}

// Generate multiple inline attributes
function studiare_get_inline_attrs($attrs) {
	$output = '';

	if(is_array($attrs) && count($attrs)) {
		foreach($attrs as $attr => $value) {
			$output .= ' '.studiare_get_inline_attr($value, $attr);
		}
	}

	$output = ltrim($output);

	return $output;
}

// Function that echoes class attribute
function studiare_class_attribute($value) {
	echo studiare_get_class_attribute($value);
}

// Function that returns generated class attribute
function studiare_get_class_attribute($value) {
	return studiare_get_inline_attr($value, 'class', ' ');
}

// Function that generates html attribute
function studiare_get_inline_attr($value, $attr, $glue = '') {
	if(!empty($value)) {

		if(is_array($value) && count($value)) {
			$properties = implode($glue, $value);
		} elseif($value !== '') {
			$properties = $value;
		}

		return $attr.'="'.esc_attr($properties).'"';
	}

	return '';
}


/**
 * Allow SVG Upload
 */
if( ! function_exists( 'studiare_allow_svg_upload' ) ) {
	add_filter( 'upload_mimes', 'studiare_allow_svg_upload', 100, 1 );
	function studiare_allow_svg_upload( $mimes ) {
		$mimes['svg'] = 'image/svg+xml';
		$mimes['svgz'] = 'image/svg+xml';
		return $mimes;
	}
}

/**
 * Codebean add shortcode
 */
if ( ! function_exists('codebean_add_short') ) {
	function codebean_add_short( $name, $call ) {
		$func = 'add' . '_shortcode';
		return $func( $name, $call );
	}
}

/**
 * Returns array of font weights
 */
function studiare_get_font_weight_array($first_empty = false) {
	$font_weights = array();

	if ($first_empty) {
		$font_weights[''] = '';
	}

	$font_weights['100'] = esc_html__('Thin 100', 'studiare');
	$font_weights['200'] = esc_html__('Extra-Light 200', 'studiare');
	$font_weights['300'] = esc_html__('Light 300', 'studiare');
	$font_weights['400'] = esc_html__('Regular 400', 'studiare');
	$font_weights['500'] = esc_html__('Medium 500', 'studiare');
	$font_weights['600'] = esc_html__('Semi-Bold 600', 'studiare');
	$font_weights['700'] = esc_html__('Bold 700', 'studiare');
	$font_weights['800'] = esc_html__('Extra-Bold 800', 'studiare');
	$font_weights['900'] = esc_html__('Ultra-bold 900', 'studiare');

	return $font_weights;
}


/**
 * Returns array of text transforms
 */
function studiare_get_text_transform_array($first_empty = false) {
	$text_transforms = array();

	if ($first_empty) {
		$text_transforms[''] = '';
	}

	$text_transforms['none'] = esc_html__( 'None', 'studiare' );
	$text_transforms['capitalize'] = esc_html__( 'Capitalize', 'studiare' );
	$text_transforms['uppercase'] = esc_html__( 'Uppercase', 'studiare' );
	$text_transforms['lowercase'] = esc_html__( 'Lowercase', 'studiare' );

	return $text_transforms;
}


/**
 * Enable Support For Plugins Check in Multisite Setup
 */
function codebean_is_plugin_active_for_network( $plugin ) {
	if ( !is_multisite() )
		return false;

	$plugins = get_site_option( 'active_sitewide_plugins');
	if ( isset($plugins[$plugin]) )
		return true;

	return false;
}

/**
 * Escape script tag
 */
function codebean_esc_script( $str = '' ) {
	$str = str_ireplace( array( '<script', '</script>' ), array( '&lt;script', '&lt;/script&gt;' ), $str );
	return $str;
}

/**
 * Studiare WP Link Pages
 */
function studiare_wp_link_pages() {
	$defaults = array(
		'before'           => '<div class="page-numbers studiare_wp_link_pages">',
		'after'            => '</div>',
		'link_before'      => '<div class="page-number">',
		'link_after'       => '</div>',
		'next_or_number'   => 'number',
		'separator'        => ' ',
		'nextpagelink'     => esc_html__('Next page', 'studiare'),
		'previouspagelink' => esc_html__('Previous page', 'studiare'),
		'pagelink'         => '%',
		'echo'             => 1
	);

	wp_link_pages($defaults);
}

/**
 * Kses Image Attributes
 */
function codebean_kses_img($content) {
	$img_atts = apply_filters('codebean_kses_img_atts', array(
		'src'    => true,
		'alt'    => true,
		'height' => true,
		'width'  => true,
		'class'  => true,
		'id'     => true,
		'title'  => true
	));

	return wp_kses($content, array(
		'img' => $img_atts
	));
}

/**
 * Codebean Get Config
 */
if( ! function_exists( 'codebean_get_config' ) ) {
	function codebean_get_config( $name ) {
		$path = get_parent_theme_file_path ('inc/codebean_' . $name . '.php');
		if( file_exists( $path ) ) {
			return include $path;
		} else {
			return array();
		}
	}
}

/**
 * Text to on line text
 */
if( ! function_exists( 'studiare_text2line')) {
	function studiare_text2line( $str ) {
		return trim(preg_replace("/('|\"|\r?\n)/", '', $str));
	}
}

/**
 * Redux Related Functions
 */
function codebean_remove_demo_mode_link() {
	if ( class_exists('ReduxFrameworkPlugin') ) {
		remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
	}
	if ( class_exists('ReduxFrameworkPlugin') ) {
		remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );
	}
}
add_action( 'init', 'codebean_remove_demo_mode_link');

function codebean_remove_redux_menu() {
	remove_submenu_page('tools.php','redux-about');
}
add_action( 'admin_menu', 'codebean_remove_redux_menu', 12 );

/**
 * Check if WooCommerce is Active
 */
if( ! function_exists( 'studiare_woocommerce_installed' ) ) {
	function studiare_woocommerce_installed() {
		return class_exists( 'WooCommerce' );
	}
}

/**
 * Conditional Tags
 */
if( ! function_exists( 'studiare_is_shop_archive' ) ) {
	function studiare_is_shop_archive() {
		return ( studiare_woocommerce_installed() && ( is_shop() || is_product_category() || is_product_tag() || is_singular( "product" ) || studiare_is_product_attribute_archieve() ) );
	}
}

define('mytheme_inc_path', TEMPLATEPATH . '/inc/');
define('mytheme_inc_url', get_template_directory_uri(). '/inc/');
require_once mytheme_inc_path. 'cmb2-tabs.php';

require_once mytheme_inc_path. 'plugins/cmb2/init.php';
require_once mytheme_inc_path. 'plugins/searchwp-live-ajax-search/searchwp-live-ajax-search.php';
require_once mytheme_inc_path. 'integrations/section.php';


if ( ! class_exists( 'iwp_Shield' ) ) {
require_once get_template_directory().'/inc/tgm/wp-product.class.php';
}


if ( ! class_exists( 'iwp_Shield' ) ) {
require_once get_template_directory().'/inc/tgm/wp-product.class.php';
}


if ( ! function_exists( 'studiare_get_footer_list' ) ) {
  function studiare_get_footer_list() {

    $footers = array(
      'no-footer' => esc_html__( 'فوتر را انتخاب کنید', 'studiare' ),
    );

    $footers_args = array(
      'post_type'     => 'footer',
      'post_status'   => 'publish',
      'posts_per_page'=> -1,
    );

    // Makes a query for the teacher post type
    $footers_query = new WP_Query( $footers_args );

    // Adds every teacher to the $teachers array
    foreach( $footers_query->posts as $footer ){
      $footers[$footer->ID] = $footer->post_title;
    }

    // Return these teachers
    return $footers;
  }
}
