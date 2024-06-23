<?php
/**
 * Codebean Actions File
 */

# After setup theme
function studiare_after_setup_theme() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentyseventeen
	 * If you're building a theme based on Twenty Seventeen, use a find and replace
	 * to change 'twentyseventeen' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'studiare', STUDIARE_THEMEDIR . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Add support Woocommerce
	add_theme_support( 'woocommerce' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	add_image_size('studiare-image-420x294-croped', 420, 294, true);
	add_image_size('studiare-image-400x400-croped', 400, 400, true);
	add_image_size('studiare-course-thumb', 370, 270, true);
	add_image_size('img-120-120', 120, 120, true );

	add_image_size('metro_first', 820, 548,true);
	add_image_size('metro_others', 410, 259,true);

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus(
		array(
			'main-menu' => esc_html__( 'Main Header Menu', 'studiare' ),
			'mobile-menu' => esc_html__('Mobile Side Menu', 'studiare' ),
			'top-bar-menu' => esc_html__('Top Bar Right Menu', 'studiare' ),
			'cat-menu' => esc_html__('منوی دسته بندی دوره ها', 'studiare' ),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

}

# Base Functionality
if ( ! function_exists( 'studiare_init') ) {

	function studiare_init() {
		global $theme_version;

		$theme_obj     = wp_get_theme();
		$theme_version = $theme_obj->get( 'Version' );

		if ( is_child_theme() ) {
			$template_dir     = basename( get_theme_file_path() );
			$theme_obj        = wp_get_theme( $template_dir );
			$theme_version    = $theme_obj->get( 'Version' );
		}

		# Styles
		wp_register_style( 'studiare-main', get_theme_file_uri( 'assets/css/studiare.css' ), null, $theme_version );
		// Theme stylesheet.
		wp_enqueue_style( 'studiare-style', get_stylesheet_uri() );
		wp_enqueue_style( 'font-awesome-pro', get_theme_file_uri( 'assets/css/fontawesome.min.css' ) );

		// Inlise style from settings
		wp_add_inline_style( 'studiare-style', studiare_settings_css() );

		wp_deregister_style( 'yith-wcwl-font-awesome' );
		wp_dequeue_style( 'yith-wcwl-font-awesome' );
	}
}

function studiare_elementor_enqueue_editor_styles() {
	wp_enqueue_style( 'studiare-etitor', get_theme_file_uri( 'assets/css/editor.css' ), array( 'elementor-editor' ) );
}

add_action( 'elementor/editor/before_enqueue_styles', 'studiare_elementor_enqueue_editor_styles' );

# Enqueue Scritps and other stuff
if ( ! function_exists( 'studiare_wp_enqueue_scripts' ) ) {

	function studiare_wp_enqueue_scripts() {

		# Styles
		wp_enqueue_style( array( 'studiare-main') );

		# Scripts
		$google_api_key = '';

		if ( class_exists( 'Redux' ) ) {
		    $google_api_key = codebean_option( 'google_api_key' );
        }

		if( !empty($google_api_key) ) {
			$google_api_map = 'https://maps.googleapis.com/maps/api/js?key='.$google_api_key.'&';
		} else {
			$google_api_map = 'https://maps.googleapis.com/maps/api/js?';
		}

		wp_register_script('gmaps', $google_api_map . '&language=' . get_bloginfo( 'language' ), array( 'jquery' ), '', true );
		wp_enqueue_script( 'studiare-theme', get_theme_file_uri( 'assets/js/global.js' ), array( 'jquery' ), '',true );
		wp_enqueue_script( 'studiare-js', get_theme_file_uri( 'assets/js/vendor/alljs.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'theia-sticky-sidebar', get_theme_file_uri( 'assets/js/vendor/theia-sticky-sidebar.min.js' ), array( 'jquery' ), '', true );


		$translations = array(
			'countdown_days' => esc_html__('days', 'studiare'),
			'countdown_hours' => esc_html__('hours', 'studiare'),
			'countdown_mins' => esc_html__('minutes', 'studiare'),
			'countdown_sec' => esc_html__('seconds', 'studiare'),
		);

		wp_localize_script( 'studiare-theme', 'studiare_options', $translations );

		if ( is_single() ) {
				wp_enqueue_script( 'comment-reply' );
        }

	}
}

# Enqueue admin styles
function studiare_enqueue_admin_styles() {

	if ( is_admin() ) {
		wp_enqueue_style( 'studiare-admin-style', get_theme_file_uri('/assets/css/theme-admin.css' ));
	}
}

add_action( 'admin_enqueue_scripts', 'studiare_enqueue_admin_styles' );

# Register widget area.
function studiare_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Blog Sidebar', 'studiare' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'studiare' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'ناحیه ابزارک نوشته تکی', 'studiare' ),
			'id'            => 'single_blog_ads',
			'description'   => esc_html__( 'ابزارک های دلخواه خود برای نمایش در ناحیه تبایغاتی برگه نوشته های تکی را در اینجا قرار دهید', 'studiare' ),
			'before_widget' => '<div class="post-inner"><div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'سایدبار صفحات', 'studiare' ),
			'id'            => 'sidebar_page',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'studiare' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'ابزارک برگه دوره ها 1', 'studiare' ),
			'id'            => 'course_page_1',
			'description'   => esc_html__( 'ابزارکی که میخواهید در سایدبار برگه دوره تکی نمایش داده شود اینجا قرار دهید', 'studiare' ),
			'before_widget' => '<div class="product-info-box"><div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'ابزارک برگه دوره ها 2', 'studiare' ),
			'id'            => 'course_page_2',
			'description'   => esc_html__( 'ابزارکی که میخواهید در سایدبار برگه دوره تکی نمایش داده شود اینجا قرار دهید', 'studiare' ),
			'before_widget' => '<div class="product-info-box"><div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'ابزارک برگه دوره در موبایل', 'studiare' ),
			'id'            => 'course_page_mobile',
			'description'   => esc_html__( 'ابزارکی که میخواهید در برگه دوره در حالت موبایل نمایش داده شود در اینجا قرار دهید', 'studiare' ),
			'before_widget' => '<div class="product-info-box"><div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		)
	);

	for ($footer = 1; $footer < 5; $footer++) {
		register_sidebar(array(
			'id'            => 'studiare-footer-' . $footer,
			'name'          => esc_html__('Footer ', 'studiare') . $footer,
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		));
	}

	if ( class_exists( 'WooCommerce' ) ) {
		register_sidebar( array(
			'id'            => 'sidebar_shop',
			'name'          => esc_html__('Shop - Sidebar', 'studiare'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		) );
	}

	if ( class_exists( 'WPEMS') ) {
	    register_sidebar( array(
            'id'            => 'sidebar_events',
            'name'          => esc_html__( 'Events - Sidebar', 'studiare' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h5 class="widget-title">',
            'after_title'   => '</h5>',
        ) );
    }

}

add_action( 'widgets_init', 'studiare_widgets_init' );

# Post Navigation
function studiare_post_nav() {
	$prev = get_previous_post();
	$next = get_next_post();

	?>
	<div class="post-nav">
		<div class="post-nav-btn prev-btn">
			<?php if ($prev) { ?>
				<a href="<?php echo esc_url( get_permalink($prev->ID) ); ?>" class="post-nav-link prev">
					<?php get_template_part( 'assets/images/arrow-prev.svg' ); ?>
					<span><?php esc_html_e('قدیمی تر', 'studiare'); ?></span>
					<strong><?php echo esc_html($prev->post_title); ?></strong>
				</a>
			<?php } ?>
		</div>

		<div class="post-nav-btn next-btn">
			<?php if ($next) { ?>
				<a href="<?php echo esc_url( get_permalink($next->ID) ); ?>" class="post-nav-link next">
					<?php get_template_part( 'assets/images/arrow-next.svg' ); ?>
					<span><?php esc_html_e('جدیدتر', 'studiare'); ?></span>
					<strong><?php echo esc_attr($next->post_title); ?></strong>
				</a>
			<?php } ?>
		</div>
	</div>
	<?php

}

add_action( 'studiare_post_nav', 'studiare_post_nav', 3, 3 );

# Third party plugins
add_action('tgmpa_register', 'studiare_register_plugins');
function studiare_register_plugins() {
	$plugins = array(





	);

	$config = array(
		'default_path'    => '',
		'menu'            => 'tgmpa-install-plugins',
		'has_notices'     => true,
		'dismissable'     => true,
		'dismiss_msg'     => '',
		'is_automatic'    => false,
		'message'         => '',
	);

	tgmpa( $plugins, $config );
}

# Pre-loader
if ( ! function_exists( 'studiare_preloader' ) ) {
    function studiare_preloader() {
        $preloader = false;

        if ( class_exists('Redux' ) ) {
            $preloader = codebean_option('studiare_preloader');
						$custom_preloader = codebean_option('studiare_custom_preloader');
						$preloader_uploaded = codebean_option('custom_preload_image');
						if(isset($preloader_uploaded['url']) && $preloader_uploaded['url'] != '') {
							$custom_preloader_image = $preloader_uploaded['url'];
						}
        }

				?>
				<?php if ( $preloader ) : ?>

					 <?php if ( $custom_preloader ) : ?>
						 <div class="studiare-preloader">
						 <img src="<?php echo esc_url( $custom_preloader_image ); ?>">
						 </div>


				 <?php else : ?>

        <div class="studiare-preloader">
            <?php studiare_preloader_icon(); ?>
        </div>

				<?php endif; ?>

        <?php endif; ?>

				<?php

    }

    add_action( 'studiare_before_body', 'studiare_preloader', 10 );
}

# Pre-loader icon
if ( ! function_exists( 'studiare_preloader_icon' ) ) {
    function studiare_preloader_icon() {
        $loading_icon = '';

        if ( class_exists('Redux' ) ) {
            $loading_icon = codebean_option('preloader_icon');

        }

	    echo '<div class="studiare-preloader-icon">';

	    switch ( $loading_icon ) {
		    case 'custom-image':
		        $loading_image = '';

		        if ( class_exists('Redux' ) ) {
			        $loading_image = codebean_option('custom_preloader_image');
                }

			    if ( $loading_image ) {
				    include locate_template( 'inc/templates/preloader/' . $loading_icon . '.php' );
			    }
			    break;
		    default:
			    include locate_template( 'inc/templates/preloader/' . $loading_icon . '.php' );
			    break;
	    }

	    echo '</div>';

    }
}

# Mobile Navigation
if ( ! function_exists( 'studiare_mobile_nav' ) ) {
    function studiare_mobile_nav() {
        get_template_part( 'inc/templates/mobile-nav' );
    }

    add_action( 'studiare_before_body', 'studiare_mobile_nav', 20 );
}

/**
 * ------------------------------------------------------------------------------------------------
 * Enqueue google fonts
 * ------------------------------------------------------------------------------------------------
 */
if( ! function_exists( 'codebean_enqueue_google_fonts' ) ) {
	add_action( 'wp_enqueue_scripts', 'codebean_enqueue_google_fonts', 10000 );

	function codebean_enqueue_google_fonts() {
		$default_google_fonts = 'Nunito:200,300,400,500,600,700';

		if( ! class_exists('Redux') )
			wp_enqueue_style( 'codebean-google-fonts', codebean_get_fonts_url( $default_google_fonts ), array(), '1.0.0' );
	}
}

/**
 * ------------------------------------------------------------------------------------------------
 * Get google fonts URL
 * ------------------------------------------------------------------------------------------------
 */
if( ! function_exists( 'codebean_get_fonts_url') ) {
	function codebean_get_fonts_url( $fonts ) {
		$font_url = '';

		$font_url = add_query_arg( 'family', urlencode( $fonts ), "//fonts.googleapis.com/css" );

		return $font_url;
	}
}

/**
 * Studiare Favicon
 */
function studiare_favicon() {

	if ( function_exists( 'has_site_icon' ) && has_site_icon() ) return '';

	// Get the favicon.
	$favicon = get_parent_theme_file_uri('assets/images/icons/favicon.png' );

	// Get the custom touch icon.
	$touch_icon = get_parent_theme_file_uri('assets/images/icons/apple-touch-icon.png' );

	if ( class_exists('Redux') ) {

		$fav_uploaded = codebean_option('favicon');
		if(isset($fav_uploaded['url']) && $fav_uploaded['url'] != '') {
			$favicon = $fav_uploaded['url'];
		}

		$fav_uploaded_retina = codebean_option( 'favicon_retina' );
		if(isset($fav_uploaded_retina['url']) && $fav_uploaded_retina['url'] != '') {
			$touch_icon = $fav_uploaded_retina['url'];
		}

	}

	?>
    <link rel="shortcut icon" href="<?php echo esc_url($favicon); ?>">
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo esc_url($touch_icon); ?>">
	<?php
}

add_action( 'wp_head', 'studiare_favicon' );

/**
 * After Content Import
 */
if ( ! function_exists( 'studiare_after_content_import' ) ) {
	function studiare_after_content_import( $demo_active_import , $demo_directory_path ) {

		reset( $demo_active_import );
		$current_key = key( $demo_active_import );

		$locations = get_theme_mod('nav_menu_locations');
		$menus  = wp_get_nav_menus();

		if(!empty($menus)) {
			foreach($menus as $menu)
			{
				if(is_object($menu) && $menu->name == 'Main Header Menu')
				{
					$locations['main-menu'] = $menu->term_id;
				}
				if(is_object($menu) && $menu->name == 'Mobile Side Menu')
				{
					$locations['mobile-menu'] = $menu->term_id;
				}
			}
		}

		set_theme_mod('nav_menu_locations', $locations);

		update_option( 'show_on_front', 'page' );

		$front_page = get_page_by_title( 'Home' );
		if ( isset( $front_page->ID ) ) {
			update_option( 'page_on_front', $front_page->ID );
		}

		$blog_page = get_page_by_title( 'Blog' );
		if ( isset( $blog_page->ID ) ) {
			update_option( 'page_for_posts', $blog_page->ID );
		}

		if ( class_exists( 'RevSlider' ) ) {

			$wbc_sliders_array = array(
				'demo' => 'studiare-slider.zip',
			);
			if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_sliders_array ) ) {
				$wbc_slider_import = $wbc_sliders_array[$demo_active_import[$current_key]['directory']];
				if ( file_exists( $demo_directory_path.$wbc_slider_import ) ) {
					$slider = new RevSlider();
					$slider->importSliderFromPost( true, true, $demo_directory_path.$wbc_slider_import );
				}
			}
		}

	}

	add_action( 'wbc_importer_after_content_import', 'studiare_after_content_import', 10, 2 );
}
