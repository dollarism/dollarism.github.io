<?php

if ( ! class_exists( 'Redux' ) )  {
	return;
}

// This is your option name where all the Redux data is stored.
$opt_name = "codebean_option";

$studiare_selectors = codebean_get_config('selectors');

/**
 * ---> SET ARGUMENTS
 * All the possible arguments for Redux.
 * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
 * */

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$codebean_social_networks_shortcode = "
<code style='font-size: 10px; display: inline-block; margin-top: 10px;'>[social_networks]</code><br>
<code style='font-size: 10px; display: inline-block; margin-top: 10px;'>[social_networks rounded]</code><br>
<code style='font-size: 10px; display: inline-block; margin-top: 10px;'>[social_networks light]</code><br>";

$args = array(
	'opt_name'             => $opt_name,
	'display_name'         => $theme->get( 'Name' ),
	'display_version'      => $theme->get( 'Version' ),
	'menu_type'            => 'menu',
	'allow_sub_menu'       => true,
	'menu_title'           => esc_html__( 'Theme Settings', 'studiare' ),
	'page_title'           => esc_html__( 'Theme Settings', 'studiare' ),
	'google_api_key'       => '',
	'google_update_weekly' => false,
	'async_typography'     => false,
	'admin_bar'            => true,
	'admin_bar_icon'       => 'dashicons-laptop',
	'admin_bar_priority'   => 50,
	'global_variable'      => '',
	'dev_mode'             => false,
	'show_options_object'  => false,
	'update_notice'        => true,
	'customizer'           => true,
	'disable_tracking'     => true,

	// OPTIONAL -> Give you extra features
	'page_priority'        => 61,
	'page_parent'          => 'themes.php',
	'page_permissions'     => 'manage_options',
	'menu_icon'            => 'dashicons-laptop',
	'last_tab'             => '',
	'page_icon'            => 'icon-themes',
	'page_slug'            => 'theme-options',
	'save_defaults'        => true,
	'default_show'         => false,
	'default_mark'         => '',
	'show_import_export'   => true,

	// CAREFUL -> These options are for advanced use only
	'transient_time'       => 60 * MINUTE_IN_SECONDS,
	'output'               => true,
	'output_tag'           => true,
	'database'             => '',
	'use_cdn'              => true,
	// HINTS
	'hints'                => array(
		'icon'          => 'el-question-sign',
		'icon_position' => 'right',
		'icon_color'    => 'lightgray',
		'icon_size'     => 'normal',
		'tip_style'     => array(
			'color'   => 'red',
			'shadow'  => true,
			'rounded' => false,
			'style'   => '',
		),
		'tip_position'  => array(
			'my' => 'top left',
			'at' => 'bottom right',
		),
		'tip_effect'    => array(
			'show' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'mouseover',
			),
			'hide' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'click mouseleave',
			),
		),
	)

);

Redux::setArgs( $opt_name, $args );

/*
 * ---> END ARGUMENTS
 */


/*
 *
 * ---> START SECTIONS
 *
 */

# General Settings
Redux::setSection( $opt_name, array(
	'title'             => esc_html__( 'General', 'studiare' ),
	'id'                => 'codebean_general',
	'desc'              => '',
	'customizer_width'  => '400px',
	'submenu'           => true,
	'icon'              => 'el-icon-home',
	'fields' => array(
		array (
			'id' => 'favicon',
			'type' => 'media',
			'desc' => esc_html__( 'Upload image: png, ico', 'studiare' ),
			'operator' => 'and',
			'title' => esc_html__( 'Favicon image', 'studiare' ),
		),
		array (
			'id' => 'favicon_retina',
			'type' => 'media',
			'desc' => esc_html__( 'Upload image: png, ico', 'studiare' ),
			'operator' => 'and',
			'title' => esc_html__( 'Favicon retina image', 'studiare' )
		),
		array(
			'id'       => 'studiare_preloader',
			'type'     => 'switch',
			'title'    => esc_html__('Enable Preloader', 'studiare'),
			'default'  => false
		),
		array(
			'id'       => 'preloader_icon',
			'type'     => 'select',
			'title'    => esc_html__('Enable Preloader', 'studiare'),
			'default'  => 'circle',
			'options'   => array(
				'circle' => esc_html__( 'Circle', 'studiare' ),
				'square-boxes' => esc_html__( 'Square Boxes', 'studiare' )
			),
			'required' => array('studiare_preloader', '=', true),
			'select2'   => array('allowClear' => false)
		),


		array(
			'id'       => 'studiare_custom_preloader',
			'type'     => 'switch',
			'title'    => esc_html__('فعالسازی تصویر بارگیری دلخواه', 'studiare'),
			'default'  => false,
			'required' => array('studiare_preloader', '=', true),
		),

		array(
			'id' => 'custom_preload_image',
			'type' => 'media',
			'desc' => esc_html__('نصویر بارگیری دلخواه خود را آپلود کنید', 'studiare'),
			'operator' => 'and',
			'title' => esc_html__('تصویر بارگیری دلخواه', 'studiare'),
			'required' => array('studiare_custom_preloader', '=', true),
		),

		array(
			'id'        => 'google_api_key',
			'type'      => 'text',
			'title'     => esc_html__( 'Google API Key', 'studiare' ),
			'description' => esc_html__( 'Enter here the secret api key you have created on Google APIs', 'studiare' )
		)
	)
) );


# Header Settings
Redux::setSection( $opt_name, array(
	'title' => esc_html__( 'تنظیمات عمومی سربرگ', 'studiare' ),
	'id' => 'header',
	'icon' => 'el-icon-wrench'
) );


Redux::setSection( $opt_name, array(
	'title' => esc_html__( 'تنظیمات عمومی', 'studiare' ),
	'id' => 'header_general',
	'subsection' => true,
	'fields' => array(

		array(
			'id'        => 'header_type',
			'type'      => 'select',
			'title'     => esc_html__('نوع سربرگ', 'studiare'),
			'subtitle'  => esc_html__( 'انتخاب کنید کدام نوع سربرگ می خواهید نمایش داده شود', 'studiare' ),
			'default'   => 'h_v1',
			'options'   => array(
				'h_v1' => esc_html__( 'ورژن 1', 'studiare' ),
				'h_v2'  => esc_html__( 'ورژن 2', 'studiare' ),
			),
		),

		array(
			'id'       => 'header_full_width',
			'type'     => 'switch',
			'title'    => esc_html__( 'تمام عرض', 'studiare' ),
			'subtitle' => esc_html__( 'سربرگ را تمام عرض کنید.', 'studiare' ),
			'default'  => false,
		),

		array(
			'id'       => 'header_sticky_menu',
			'type'     => 'switch',
			'title'    => esc_html__( 'منوی چسبان', 'studiare' ),
			'subtitle' => esc_html__( 'فعال و غیر فعال کردن منوی سربرگ چسبان', 'studiare' ),
			'default'  => true,
		),

		array(
			'id' => 'custom_logo_image',
			'type' => 'media',
			'desc' => esc_html__('Upload image: png, jpg or gif file', 'studiare'),
			'operator' => 'and',
			'title' => esc_html__('Logo image', 'studiare'),
		),
		array(
			'id'        => 'logo_img_width',
			'type'      => 'slider',
			'title'     => esc_html__('Logo image maximum width (px)', 'studiare'),
			'desc'      => esc_html__('Set maximum width for logo image in the header. In pixels', 'studiare'),
			"default"   => 200,
			"min"       => 50,
			"step"      => 1,
			"max"       => 600,
			'display_value' => 'label',
			'tags'     => 'logo width logo size'
		),
		array(
			'id'             => 'logo_padding',
			'type'           => 'spacing',
			'mode'           => 'padding',
			'units'          => array('px'),
			'units_extended' => 'false',
			'title'          => esc_html__('Logo image padding', 'studiare'),
			'desc'           => esc_html__('Add some spacing around your logo image', 'studiare'),
			'default'            => array(
				'padding-top'     => '10px',
				'padding-right'   => '20px',
				'padding-bottom'  => '10px',
				'padding-left'    => '0px',
				'units'          => 'px',
			),
			'tags'     => 'logo padding logo spacing',
			'select2'   => array('allowClear' => false)
		),

	),
) );


Redux::setSection( $opt_name, array(
	'title' => esc_html__( 'Header Layout', 'studiare' ),
	'id' => 'branding',
	'subsection' => true,
	'fields' => array(
		array(
			'id'        => 'header_height',
			'type'      => 'slider',
			'title'     => esc_html__('Header height', 'studiare'),
			"default"   => 112,
			"min"       => 40,
			"step"      => 1,
			"max"       => 220,
			'display_value' => 'label',
			'tags'     => 'header size logo height logo size'
		),


		array(
			'id'        => 'header_button',
			'type'      => 'switch',
			'title'     => esc_html__( 'Button on header', 'studiare' ),
			'subtitle'  => esc_html__( 'Show/hide button on header right', 'studiare' ),
			'default'   => true,
		),
		array(
			'id'        => 'header_button_link',
			'type'      => 'select',
			'title'     => esc_html__( 'Button Link', 'studiare' ),
			'subtitle'  => esc_html__( 'Choose link you want to add on button', 'studiare' ),
			'default'   => 'account',
			'options'   => array(
				'account' => esc_html__( 'Link to account', 'studiare' ),
				'custom'  => esc_html__( 'Custom link', 'studiare' ),
			),
			'required'  => array('header_button', '=', true),
			'select2'   => array('allowClear' => false)
		),

		array(
			'id'        => 'header_button_custom_text',
			'type'      => 'text',
			'title'     => esc_html__( 'Custom button text', 'studiare' ),
			'required'  => array('header_button_link', '=', 'custom'),
		),
		array(
			'id'        => 'header_button_custom_link',
			'type'      => 'text',
			'title'     => esc_html__( 'Custom button link', 'studiare' ),
			'required'  => array('header_button_link', '=', 'custom'),
		),
		array(
			'id'        => 'header_button_custom_text_after_login',
			'type'      => 'text',
			'title'     => esc_html__( 'متن دکمه سربرگ بعد از لاگین', 'studiare' ),
			'default'   => 'حساب کاربری',
			'required'  => array('header_button_link', '=', 'custom'),
		),
		array(
			'id'        => 'header_button_custom_link_after_login',
			'type'      => 'text',
			'title'     => esc_html__( 'لینک دکمه سربرگ بعد از لاگین کاربر', 'studiare' ),
			'default'   => 'حساب کاربری',
			'required'  => array('header_button_link', '=', 'custom'),
		),
	),
) );


Redux::setSection( $opt_name, array(
	'title' => esc_html__( 'ناحیه عنوان صفحات', 'studiare' ),
	'id' => 'header-title',
	'subsection' => true,
	'fields' => array(

		array(
			'id'       => 'header_text_color',
			'type'     => 'color',
			'title'    => esc_html__( 'رنگ متن ناحیه عنوان سربرگ', 'studiare' ),
			'validate' => 'color',
			'transparent' => false,
			'output'   => $studiare_selectors['header_text_color'],
			'default'  => '#0a0909'
		),

		array(
			'id'        => 'header_title_bg',
			'type'      => 'background',
			'title'     => esc_html__( 'رنگ پس زمینه ناحیه عنوان صفحات', 'studiare' ),
			'background-image' => true,
			'background-position' => true,
			'background-attachment' => true,
			'background-size' => true,
			'background-repeat' => true,
			'preview' => true,
			'output'   => '.page-title',
			'default'  => array(
				'background-color' => '#ebeef1'
			),

		),



	)
) );

Redux::setSection( $opt_name, array(
	'title' => esc_html__( 'Top bar', 'studiare' ),
	'id' => 'header-topbar',
	'subsection' => true,
	'fields' => array(
		array(
			'id'        => 'topbar_display_opt',
			'type'      => 'switch',
			'title'     => esc_html__( 'Top Bar', 'studiare' ),
			'subtitle'  => esc_html__( 'Information about the header', 'studiare' ),
			'default'   => true,
		),
		array(
			'id'        => 'topbar_color',
			'type'      => 'select',
			'title'     => esc_html__( 'Top bar text color', 'studiare' ),
			'default'   => 'light',
			'options'   => array(
				'dark' => esc_html__( 'Dark', 'studiare' ),
				'light'  => esc_html__( 'Light', 'studiare' )
			),
			'required'  => array('topbar_display_opt', '=', '1'),
			'select2'   => array('allowClear' => false)
		),
		array(
			'id'       => 'top-bar-bg',
			'type'     => 'background',
			'title'    => esc_html__( 'Top bar background', 'studiare' ),
			'background-image' => false,
			'background-position' => false,
			'background-attachment' => false,
			'background-size' => false,
			'background-repeat' => false,
			'transparent' => false,
			'preview' => false,
			'output'   => '.top-bar',
			'default'  => array(
				'background-color' => '#2e3e77'
			),
			'required'  => array('topbar_display_opt', '=', '1'),
		),
		array(
			'id'      => 'top_bar_phone',
			'type'    => 'text',
			'title'   => esc_html__( 'Phone Number', 'studiare' ),
		),
		array(
			'id'      => 'top_bar_email',
			'type'    => 'text',
			'title'   => esc_html__( 'Email Address', 'studiare' ),
		),
		array(
			'id'        => 'topbar_search',
			'type'      => 'switch',
			'title'     => esc_html__( 'Show/hide search', 'studiare' ),
			'default'   => true,
		),
		array(
			'id'        => 'topbar_cart',
			'type'      => 'switch',
			'title'     => esc_html__( 'Show/hide cart', 'studiare' ),
			'default'   => true,
		),
		array(
			'id'        => 'pup_up_button',
			'type'      => 'switch',
			'title'     => esc_html__( 'پاپ آپ ورود به حساب کاربری در حالت موبایل', 'studiare' ),
			'default'   => true,
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title' => esc_html__( 'Mobile Navigation', 'studiare' ),
	'id' => 'mobile-nav',
	'subsection' => true,
	'fields' => array(
		array(
			'id' => 'off_canvas_search',
			'type' => 'switch',
			'title' => esc_html__( 'Search on mobile', 'studiare' ),
			'subtitle' => esc_html__( 'Show/hide search form on mobile navigation', 'studiare' ),
			'default' => true
		),
		array(
			'id' => 'off_canvas_cart',
			'type' => 'switch',
			'title' => esc_html__( 'Shopping cart on mobile', 'studiare' ),
			'subtitle' => esc_html__( 'Show/hide shopping cart on mobile navigation', 'studiare' ),
			'default' => true
		),
		array(
			'id' => 'off_canvas_footer',
			'type' => 'editor',
			'title' => esc_html__( 'Text or shortcode on mobile', 'studiare' ),
			'subtitle' => esc_html__( 'Place here text you want to see in the mobile nav footer area. You can use shortocdes. Ex.: [social_buttons]', 'studiare' )
		),
	)
) );




# Header V2 Settings
Redux::setSection( $opt_name, array(
	'title' => esc_html__( 'سربرگ ورژن دو', 'studiare' ),
	'id' => 'header-v2',
	'icon' => 'el-icon-wrench'
) );


Redux::setSection( $opt_name, array(
	'title' => esc_html__( 'منوی عمودی', 'studiare' ),
	'id' => 'vertical_menu',
	'subsection' => true,
	'fields' => array(

		array(
			'id'      => 'vertical_menu_text',
			'type'    => 'text',
			'default'  => 'دسترسی سریع',
			'title'   => esc_html__( 'متن دکمه منوی عمودی', 'studiare' ),
		),

		array(
			'id'       => 'vertical_menu_color',
			'type'     => 'color',
			'title'    => esc_html__( 'رنگ منوی عمودی', 'studiare' ),
			'validate' => 'color',
			'transparent' => false,
			'output'   => $studiare_selectors['vertical_menu_color'],
			'default'  => '#505358'
		),

		array(
			'id'       => 'vertical_menu_color2',
			'type'     => 'color',
			'title'    => esc_html__( 'رنگ ثانویه منوی عمودی', 'studiare' ),
			'validate' => 'color',
			'transparent' => false,
			'output'   => $studiare_selectors['vertical_menu_color2'],
			'default'  => '#404348'
		),


	),
) );




# Styling
Redux::setSection( $opt_name, array(
	'title' => esc_html__( 'Styling', 'studiare' ),
	'id' => 'colors',
	'icon' => 'el-icon-brush',
	'fields' => array(
		array(
			'id'       => 'primary_color',
			'type'     => 'color',
			'title'    => esc_html__( 'Primary Color', 'studiare' ),
			'validate' => 'color',
			'transparent' => false,
			'output'   => $studiare_selectors['primary_color'],
			'default'  => '#f9a134'
		),
		array(
			'id'       => 'secondary_color',
			'type'     => 'color',
			'title'    => esc_html__( 'Secondary Color', 'studiare' ),
			'validate' => 'color',
			'transparent' => false,
			'output'   => $studiare_selectors['secondary_color'],
			'default'  => '#1e83f0'
		)
	)
) );

# Typography
Redux::setSection( $opt_name, array(
	'title' => esc_html__('Typography', 'studiare'),
	'id' => 'typography',
	'icon' => 'el-icon-fontsize',
	'fields' => array(
		array(
			'id'             => 'font_body',
			'type'           => 'typography',
			'title'          => esc_html__( 'Body', 'studiare' ),
			'compiler'       => true,
			'google'         => true,
			'font-backup'    => false,
			'font-weight'    => true,
			'all_styles'     => true,
			'text-align'     => true,
			'font-style'     => false,
			'subsets'        => false,
			'font-size'      => true,
			'line-height'    => true,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => true,
			'preview'        => true,
			'output'         => array( 'body' ),
			'units'          => 'px',
			'subtitle'       => esc_html__( 'Select custom font for your main body text.', 'studiare' ),
			'default'        => array(
				'color'       => "#7d7e7f",
				'font-size'   => '15px',
				'line-height' => '24px',
				'font-family' => 'Iransans',
				'google'      => true,
				'font-backup' => "'MS Sans Serif', Geneva, sans-serif"
			)
		),
		array(
			'id'             => 'menu_heading',
			'type'           => 'typography',
			'title'          => esc_html__( 'Menu', 'studiare' ),
			'compiler'       => true,
			'google'         => true,
			'font-backup'    => false,
			'font-weight'    => true,
			'all_styles'     => true,
			'text-align'     => true,
			'font-style'     => false,
			'subsets'        => false,
			'font-size'      => true,
			'line-height'    => true,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => true,
			'preview'        => true,
			'output'         => array( '.studiare-navigation ul.menu>li>a, .studiare-navigation .menu>ul>li>a' ),
			'units'          => 'px',
			'subtitle'       => esc_html__( 'Select custom font for menu', 'studiare' ),
			'default'        => array(
				'font-family' => 'Iransans',
				'font-weight' => '400',
				'font-size'   => '16px'
			)
		),
		array(
			'id'             => 'submenu_font',
			'type'           => 'typography',
			'title'          => esc_html__( 'Sub Menu', 'studiare' ),
			'compiler'       => true,
			'google'         => true,
			'font-backup'    => false,
			'font-weight'    => true,
			'all_styles'     => true,
			'text-align'     => true,
			'font-style'     => false,
			'subsets'        => false,
			'font-size'      => true,
			'line-height'    => true,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => true,
			'preview'        => true,
			'output'         => array( '.studiare-navigation ul.menu>li ul li>a, .studiare-navigation .menu>ul>li ul li>a' ),
			'units'          => 'px',
			'subtitle'       => esc_html__( 'Select custom font for sub menu', 'studiare' ),
			'default'        => array(
				'font-family' => 'Iransans',
				'font-size' => '14px',
				'font-weight' => '400',
			)
		),
		array(
			'id'             => 'h1_params',
			'type'           => 'typography',
			'title'          => esc_html__( 'H1', 'studiare' ),
			'compiler'       => true,
			'google'         => true,
			'font-backup'    => false,
			'font-weight'    => true,
			'all_styles'     => true,
			'text-align'     => true,
			'font-style'     => false,
			'subsets'        => false,
			'font-size'      => true,
			'line-height'    => true,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => true,
			'preview'        => true,
			'output'         => array( 'h1,.h1' ),
			'units'          => 'px',
			'default'        => array(
				'font-size' => '26px',
				'font-weight' => '400',
				'color'       => '#464749',
				'font-family' => 'Iransans',
				'google'      => true,
			)
		),
		array(
			'id'             => 'h2_params',
			'type'           => 'typography',
			'title'          => esc_html__( 'H2', 'studiare' ),
			'compiler'       => true,
			'google'         => true,
			'font-backup'    => false,
			'font-weight'    => true,
			'all_styles'     => true,
			'text-align'     => true,
			'font-style'     => false,
			'subsets'        => false,
			'font-size'      => true,
			'line-height'    => true,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => true,
			'preview'        => true,
			'output'         => array( 'h2,.h2' ),
			'units'          => 'px',
			'default'        => array(
				'font-size' => '24px',
				'font-weight' => '400',
				'color'       => '#464749',
				'font-family' => 'Iransans',
				'google'      => true,
			)
		),
		array(
			'id'             => 'h3_params',
			'type'           => 'typography',
			'title'          => esc_html__( 'H3', 'studiare' ),
			'compiler'       => true,
			'google'         => true,
			'font-backup'    => false,
			'font-weight'    => true,
			'all_styles'     => true,
			'text-align'     => true,
			'font-style'     => false,
			'subsets'        => false,
			'font-size'      => true,
			'line-height'    => true,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => true,
			'preview'        => true,
			'output'         => array( 'h3,.h3' ),
			'units'          => 'px',
			'default'        => array(
				'font-size' => '22px',
				'font-weight' => '400',
				'color'       => '#464749',
				'font-family' => 'Iransans',
				'google'      => true,
			)
		),
		array(
			'id'             => 'h4_params',
			'type'           => 'typography',
			'title'          => esc_html__( 'H4', 'studiare' ),
			'compiler'       => true,
			'google'         => true,
			'font-backup'    => false,
			'font-weight'    => true,
			'all_styles'     => true,
			'text-align'     => true,
			'font-style'     => false,
			'subsets'        => false,
			'font-size'      => true,
			'line-height'    => true,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => true,
			'preview'        => true,
			'output'         => array( 'h4,.h4' ),
			'units'          => 'px',
			'default'        => array(
				'font-size' => '18px',
				'font-weight' => '500',
				'color'       => '#464749',
				'font-family' => 'Iransans',
				'google'      => true,
			)
		),
		array(
			'id'             => 'h5_params',
			'type'           => 'typography',
			'title'          => esc_html__( 'H5', 'studiare' ),
			'compiler'       => true,
			'google'         => true,
			'font-backup'    => false,
			'font-weight'    => true,
			'all_styles'     => true,
			'text-align'     => true,
			'font-style'     => false,
			'subsets'        => false,
			'font-size'      => true,
			'line-height'    => true,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => true,
			'preview'        => true,
			'output'         => array( 'h5,.h5' ),
			'units'          => 'px',
			'default'        => array(
				'font-size' => '18px',
				'font-weight' => '500',
				'color'       => '#464749',
				'font-family' => 'Iransans',
				'google'      => true,
			)
		),
		array(
			'id'             => 'h6_params',
			'type'           => 'typography',
			'title'          => esc_html__( 'H6', 'studiare' ),
			'compiler'       => true,
			'google'         => true,
			'font-backup'    => false,
			'font-weight'    => true,
			'all_styles'     => true,
			'text-align'     => true,
			'font-style'     => false,
			'subsets'        => false,
			'font-size'      => true,
			'line-height'    => true,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => true,
			'preview'        => true,
			'output'         => array( 'h6,.h6' ),
			'units'          => 'px',
			'default'        => array(
				'font-size' => '16px',
				'font-weight' => '500',
				'color'       => '#464749',
				'font-family' => 'Iransans',
				'google'      => true,
			)
		),
	)
) );

# Blog Settings
Redux::setSection( $opt_name, array(
	'title' => esc_html__( 'Blog', 'studiare' ),
	'id' => 'blog',
	'icon' => 'el-icon-pencil',

) );

Redux::setSection( $opt_name, array(
	'title'            => esc_html__( 'Blog Settings', 'studiare' ),
	'id'               => 'blog_settings',
	'subsection'       => true,
	'fields'           => array(
		array(
			'id'        => 'blog_post_style',
			'type'      => 'button_set',
			'title'     => esc_html__( 'Blog Posts Layout', 'studiare' ),
			'subtitle'  => esc_html__( 'Choose the form you want to show blog posts', 'studiare' ),
			'default'   => 'list',
			'options'   => array(
				'list' => esc_html__( 'List View', 'studiare' ),
				'grid' => esc_html__( 'Grid View', 'studiare' ),
				'grid2' => esc_html__( 'جدولی 2', 'studiare' ),
			)
		),
		array(
			'id'      => 'single_post_title_text',
			'type'    => 'text',
			'default'  => 'بلاگ',
			'title'   => esc_html__( 'عنوان سفارشی نوشته های تکی', 'studiare' ),
		),

		array(
			'id' => 'blog_grid_columns',
			'type' => 'select',
			'title' => esc_html__( 'Blog Grid Columns', 'studiare' ),
			'subtitle' => esc_html__( 'How many columns you want in a row', 'studiare' ),
			'default' => 'three',
			'options' => array(
				'one' => esc_html__( 'One Column', 'studiare' ),
				'two' => esc_html__( 'Two Columns', 'studiare' ),
				'three' => esc_html__( 'Three Columns', 'studiare' ),
				'four' => esc_html__( 'Four Columns', 'studiare' )
			),
			'select2'   => array('allowClear' => false),
		),

		array(
			'id' => 'blog_thumbnails_size',
			'type' => 'select',
			'title' => esc_html__( 'ابعاد تصویر بندانگشتی', 'studiare' ),
			'subtitle' => esc_html__( 'نسبت ابعاد تصویر بندانشگتی نوشته های بلاگ را انتخاب کنید.', 'studiare' ),
			'default' => 'square',
			'options' => array(
				'square' => esc_html__( 'مربعی', 'studiare' ),
				'rectangle' => esc_html__( 'مستطیلی', 'studiare' )
			),
			'select2'   => array('allowClear' => false),
		),

		array(
			'id'        => 'sidebar_position',
			'type'      => 'image_select',
			'title'     => esc_html__( 'موقعیت سایدبار آرشیو نوشته ها', 'studiare' ),
			'subtitle'  => esc_html__( 'Set blog sidebar position or hide it', 'studiare' ),
			'default'   => 'right',
			'options'   => array(
				'none'      => array(
					'alt'   => esc_html__( 'No Sidebar', 'studiare' ),
					'img'   => get_template_directory_uri() . '/inc/plugins/redux-framework/redux-core/assets/img/1col.png'
				),
				'left'      => array(
					'alt'   => esc_html__( 'Sidebar Left', 'studiare' ),
					'img'   => get_template_directory_uri() . '/inc/plugins/redux-framework/redux-core/assets/img/2cl.png'
				),
				'right'      => array(
					'alt'   => esc_html__( 'Sidebar Right', 'studiare' ),
					'img'  => get_template_directory_uri() . '/inc/plugins/redux-framework/redux-core/assets/img/2cr.png'
				),
			)
		),
		array(
			'id'        => 'sidebar_position_single',
			'type'      => 'image_select',
			'title'     => esc_html__( 'موقعیت سایدبار نوشته های تکی', 'studiare' ),
			'subtitle'  => esc_html__( 'Set blog sidebar position or hide it', 'studiare' ),
			'default'   => 'right',
			'options'   => array(
				'none'      => array(
					'alt'   => esc_html__( 'No Sidebar', 'studiare' ),
					'img'   => get_template_directory_uri() . '/inc/plugins/redux-framework/redux-core/assets/img/1col.png'
				),
				'left'      => array(
					'alt'   => esc_html__( 'Sidebar Left', 'studiare' ),
					'img'   => get_template_directory_uri() . '/inc/plugins/redux-framework/redux-core/assets/img/2cl.png'
				),
				'right'      => array(
					'alt'   => esc_html__( 'Sidebar Right', 'studiare' ),
					'img'  => get_template_directory_uri() . '/inc/plugins/redux-framework/redux-core/assets/img/2cr.png'
				),
			)
		),

		array(
			'id'        => 'blog_desc_text',
			'type'      => 'switch',
			'title'     => esc_html__( 'نمایش یا مخفی کردن خلاصه نوشته در نمایش شبکه ای؟', 'studiare' ),
			'subtitle'  => esc_html__( 'می توانید مقداری از خلاصه متن نوشته را در حالت شبکه ای نمایش دهید.', 'studiare' ),
			'default'   => false,
		),

		array(
			'id'        => 'article_author',
			'type'      => 'switch',
			'title'     => esc_html__( 'Display Author Info?', 'studiare' ),
			'subtitle'  => esc_html__( 'Displays author information at the bottom. Will only be displayed if the author description is filled.', 'studiare' ),
			'default'   => true,
		),
		array(
			'id'        => 'blog_navigation',
			'type'      => 'switch',
			'title'     => esc_html__( 'Display Article Navigation?', 'studiare' ),
			'subtitle'  => esc_html__( 'Displays article navigation after post content.', 'studiare' ),
			'default'   => true,
		),
		array(
			'id'        => 'blog_related',
			'type'      => 'switch',
			'title'     => esc_html__( 'نمایش نوشته های مرتبط؟', 'studiare' ),
			'subtitle'  => esc_html__( 'انتخاب کنید که آیا نوشته های مرتبط بعد از محتوای نوشته نمایش داده شود؟', 'studiare' ),
			'default'   => true,
		),

		array(
			'id'        => 'related-blog_post_style',
			'type'      => 'button_set',
			'title'     => esc_html__( 'استایل نوشته های مرتبط', 'studiare' ),
			'subtitle'  => esc_html__( 'انتخاب کنید که نوشته های مرتبط در چه شکلی ظاهر شوند', 'studiare' ),
			'default'   => 'related-carousel',
			'options'   => array(
				'related-list' => esc_html__( 'لیستی', 'studiare' ),
				'related-carousel' => esc_html__( 'کروسلی', 'studiare' ),
			)
		),

		array(
			'id'        => 'blog_meta_data',
			'type'      => 'switch',
			'title'     => esc_html__( 'نمایش اطلاعات نوشته تکی؟', 'studiare' ),
			'subtitle'  => esc_html__( 'انتخاب کنید که آیا اطلاعات نوشته مثل تاریخ و دسته بندی و آماز بازدید نمایش داده شود یا خیر', 'studiare' ),
			'default'   => true,
		),

		array(
			'id'        => 'blog_featured_img',
			'type'      => 'switch',
			'title'     => esc_html__( 'نمایش تصویر شاخص نوشته های بلاگ؟', 'studiare' ),
			'subtitle'  => esc_html__( 'انتخاب کنید که می خواهید تصویر شاخص نوشته های بلاگ در صفحه نوشته تکی نمایش داده شود یا خیر؟', 'studiare' ),
			'default'   => true,
		),

		array(
			'id'      => 'report_form',
			'type'    => 'text',
			'title'   => esc_html__( 'شرتکد فرم گزارش مشکل دانلود', 'studiare' ),
			'subtitle' => esc_html__( 'یک فرم با فرم ساز دلخواه خود بسازید و شرتکد آن را جهت نمایش در اینجا قرار دهید.', 'studiare' ),
		),

	)
) );

$share_story_networks = array(
	'enabled' => array(
		'placebo'	=> 'placebo',
		'fb'   	 	=> 'Facebook',
		'tw'   	 	=> 'Twitter',
		'lin'       => 'LinkedIn',
		'tlr'       => 'Tumblr',
		'gp'       	=> 'Google Plus',
	),
	'disabled' => array(
		'placebo'   => 'placebo',
		'pi'       	=> 'Pinterest',
		'em'       	=> 'Email',
		'vk'       	=> 'VKontakte',
	),
);

Redux::setSection( $opt_name, array(
	'title'            => esc_html__( 'Sharing Settings', 'studiare' ),
	'id'               => 'sharing_settings',
	'subsection'       => true,
	'fields'           => array(
		array(
			'id'       => 'blog_share_story',
			'title'    => esc_html__( 'Share Story', 'studiare' ),
			'subtitle' => esc_html__( 'Enable or disable sharing blog post on social networks', 'studiare' ),
			'type'     => 'switch',
			'default'  => true,
			'on'       => esc_html__( 'Allow Share', 'studiare' ),
			'off'      => esc_html__( 'No', 'studiare' ),
		),

	)
) );

# Footer Settings
Redux::setSection( $opt_name, array(
	'title'             => esc_html__( 'Footer', 'studiare' ),
	'id'                => 'footer_settings',
	'desc'              => esc_html__( 'Every footer option is included here.', 'studiare' ),
	'customizer_width'  => '400px',
	'icon'              => 'el-icon-photo',
	'fields'            => array(

		array(
			'id' 			=> 'footer_layout',
			'title'     => esc_html__( 'انتخاب فوتر المنتوری', 'studiare' ),
			'type' 		=> 'select',
			'options' 	=> studiare_get_footer_list(),
			'default' 	=> 'no-footer'
	 	),

		array(
			'id'        => 'footer_visibility',
			'type'      => 'switch',
			'title'     => esc_html__( 'Footer Visibility', 'studiare' ),
			'subtitle'  => esc_html__( 'Show or hide footer globally', 'studiare' ),
			'default'   => true,
		),
		array(
			'id'        => 'footer_waves_visiblity',
			'type'      => 'switch',
			'title'     => esc_html__( 'موج های بالای فوتر', 'studiare' ),
			'subtitle'  => esc_html__( 'نمایش یا مخفی کردن موج های بالای فوتر', 'studiare' ),
			'default'   => true,
		),
		array(
			'id'        => 'footer_color_scheme',
			'type'      => 'select',
			'title'     => esc_html__( 'Footer text color', 'studiare' ),
			'subtitle'  => esc_html__( 'Choose your footer color scheme', 'studiare' ),
			'default'   => 'light',
			'options'   => array(
				'dark' => esc_html__( 'Dark', 'studiare' ),
				'light'  => esc_html__( 'Light', 'studiare' )
			),
			'select2'   => array('allowClear' => false)
		),
		array(
			'id'       => 'footer-widgets-bg',
			'type'     => 'background',
			'title'    => esc_html__( 'Footer background', 'studiare' ),
			'output'   => '.site-footer, .ltx-overlay-black-waves',
			'default'  => array(
				'background-color' => '#2e3e77'
			)
		),
		array(
			'id'        => 'footer_widgets',
			'type'      => 'switch',
			'required'  => array('footer_visibility', '=' , '1'),
			'title'     => esc_html__( 'Footer Widgets', 'studiare' ),
			'subtitle'  => esc_html__( 'Show or hide footer widgets', 'studiare' ),
			'default'   => true,
		),
		array(
			'id'        => 'footer_columns',
			'type'      => 'image_select',
			'required'  => array('footer_widgets', '=', '1'),
			'title'     => esc_html__( 'Footer Columns', 'studiare' ),
			'subtitle'  => esc_html__( 'Set columns layout for footer to split widgets.', 'studiare' ),
			'default'   => 'three',
			'options'   => array(
				'four'   => array(
					'alt'   => '4 Columns',
					'img' => get_parent_theme_file_uri('assets/images/admin/footer-4.png' ),
				),
				'three'  => array(
					'alt'   => '3 Columns',
					'img' => get_parent_theme_file_uri('assets/images/admin/footer-3.png' ),
				),
				'two'    => array(
					'alt'   => '2 Columns',
					'img' => get_parent_theme_file_uri('assets/images/admin/footer-2.png' ),
				),
				'doubleleft'    => array(
					'alt'   => 'Double Left',
					'img' => get_parent_theme_file_uri('assets/images/admin/footer-double-left.png'),
				),
				'doubleright'   => array(
					'alt'   => 'Double Right',
					'img' => get_parent_theme_file_uri('assets/images/admin/footer-double-right.png'),
				),
				'one'     => array(
					'alt'   => '1 Column',
					'img' => get_parent_theme_file_uri('assets/images/admin/footer-1.png'),
				),
			),
		),
		array(
			'id'       => 'disable_copyrights',
			'type'     => 'switch',
			'title'    => esc_html__('Copyrights', 'studiare'),
			'default' => true
		),
		array(
			'id'       => 'copyrights-layout',
			'type'     => 'select',
			'title'    => esc_html__('Copyrights layout', 'studiare'),
			'options'  => array(
				'two-columns' => esc_html__('Two columns', 'studiare'),
				'centered' => esc_html__('Centered', 'studiare'),
			),
			'default' => 'two-columns'
		),
		array(
			'id'       => 'copyrights-layout',
			'type'     => 'select',
			'title'    => esc_html__('Copyrights layout', 'studiare'),
			'options'  => array(
				'default' => esc_html__('Two columns', 'studiare'),
				'centered' => esc_html__('Centered', 'studiare'),
			),
			'default' => 'default',
			'select2'   => array('allowClear' => false)
		),
		array(
			'id'       => 'copyrights',
			'type'     => 'text',
			'title'    => esc_html__('Copyrights text', 'studiare'),
			'subtitle' => esc_html__('Place here text you want to see in the copyrights area. You can use shortocdes. Ex.: [social_networks]', 'studiare'),
		),
		array(
			'id'       => 'copyrights2',
			'type'     => 'text',
			'title'    => esc_html__('Text next to copyrights', 'studiare'),
			'subtitle' => esc_html__('You can use shortcodes. Ex.: [social_networks]', 'studiare'),
		),
		array(
			'id'       => 'scroll_top_btn',
			'type'     => 'switch',
			'title'    => esc_html__( 'Scroll to top button', 'studiare' ),
			'default' => true
		),
	)
) );

# My Account Settings
Redux::setSection( $opt_name, array(
	'title' => esc_html__( 'ثبت نام و ورود', 'studiare' ),
	'id' => 'log_reg',
	'icon' => 'el el-user',

) );

Redux::setSection( $opt_name, array(
	'title'            => esc_html__( 'تنظیمات عضویت و ورود', 'studiare' ),
	'id'               => 'log_reg_settings',
	'subsection'       => true,
	'fields' => array(

		array(
			'id' => 'content_log_reg',
			'type' => 'editor',
			'title' => esc_html__( 'محتوای کنار فرم عضویت و ورود', 'studiare' ),
		)

	)

) );

Redux::setSection( $opt_name, array(
	'title'            => esc_html__( 'تنظیمات حساب کاربری', 'studiare' ),
	'id'               => 'account_settings',
	'subsection'       => true,
	'fields' => array(


		array(
			'id'       => 'nav-account-bg',
			'type'     => 'background',
			'title'    => esc_html__( 'رنگ پس زمینه منوی حساب کاربری', 'studiare' ),
			'background-image' => false,
			'background-position' => false,
			'background-attachment' => false,
			'background-size' => false,
			'background-repeat' => false,
			'transparent' => false,
			'preview' => false,
			'output'   => '.woocommerce-MyAccount-navigation',
			'default'  => array(
				'background-color' => '#35373a'
			),
			
		),

		array(
			'id' => 'instagram_link',
			'type' => 'text',
			'title' => esc_html__( 'لینک اینستاگرام شما', 'studiare' ),
		),

		array(
			'id' => 'telegram_link',
			'type' => 'text',
			'title' => esc_html__( 'لینک کانال تلگرام شما', 'studiare' ),
		),

		array(
			'id' => 'youtube_link',
			'type' => 'text',
			'title' => esc_html__( 'لینک چنل یوتوب شما', 'studiare' ),
		),

		array(
			'id' => 'aparat_link',
			'type' => 'text',
			'title' => esc_html__( 'لینک کانال آپارات شما', 'studiare' ),
		),

	)

) );



# Courses Settings
Redux::setSection( $opt_name, array(
	'title' => esc_html__( 'Courses', 'studiare' ),
	'id' => 'courses',
	'icon' => 'el-icon-shopping-cart',

) );


Redux::setSection( $opt_name, array(
	'title'            => esc_html__( 'Course Settings', 'studiare' ),
	'id'               => 'course_settings',
	'subsection'       => true,
	'fields' => array(
		array(
			'id'        => 'shop_sidebar',
			'type'      => 'image_select',
			'title'     => esc_html__( 'Sidebar Position', 'studiare' ),
			'subtitle'  => esc_html__( 'Set shop sidebar position or hide it', 'studiare' ),
			'default'   => 'right',
			'options'   => array(
				'none'      => array(
					'alt'   => esc_html__( 'No Sidebar', 'studiare' ),
					'img'   => get_template_directory_uri() . '/inc/plugins/redux-framework/redux-core/assets/img/1col.png'
				),
				'left'      => array(
					'alt'   => esc_html__( 'Sidebar Left', 'studiare' ),
					'img'   => get_template_directory_uri() . '/inc/plugins/redux-framework/redux-core/assets/img/2cl.png'
				),
				'right'      => array(
					'alt'   => esc_html__( 'Sidebar Right', 'studiare' ),
					'img'  => get_template_directory_uri() . '/inc/plugins/redux-framework/redux-core/assets/img/2cr.png'
				),
			)
		),
		array(
			'id'        => 'courses_columns',
			'type'      => 'select',
			'title'     => esc_html__( 'Courses Columns', 'studiare' ),
			'subtitle'  => esc_html__( 'Choose columns for courses grid', 'studiare' ),
			'options'   => array(
				'2' => esc_html__( 'Two Columns', 'studiare' ),
				'3' => esc_html__( 'Three Columns', 'studiare' ),
				'4' => esc_html__( 'Four Columns', 'studiare' ),
			),
			'default'   => '3',
			'select2'   => array('allowClear' => false)
		),
		array(
			'id'       => 'shop_per_page',
			'type'     => 'text',
			'title'    => esc_html__( 'Courses per page', 'studiare' ),
			'subtitle' => esc_html__( 'Number of courses per page', 'studiare' ),
			'default'  => '8',
			'min'      => '1',
			'max'      => '20',
		),

		array(
			'id'       => 'course_video_loop',
			'title'    => esc_html__( 'نمایش ویدئوی پیشنمایش دوره در آرشیو دوره ها', 'studiare' ),
			'subtitle' => esc_html__( 'با فعال کردن این گزینه، ویدئوی پیشنمایش دوره ها در صفحه آرشیو دوره ها قابل اجرا روی تصویر کاور خواهد بود', 'studiare' ),
			'type'     => 'switch',
			'default'  => false,
			'on'       => esc_html__( 'فعال', 'studiare' ),
			'off'      => esc_html__( 'غیر فعال', 'studiare' )
		),

		array(
			'id'       => 'courses_rating_loop',
			'title'    => esc_html__( 'امتیاز ستاره ای آرشیو دوره ها', 'studiare' ),
			'subtitle' => esc_html__( 'با این گزینه می توانید ستاره ای در آرشیو دوره ها را مخفی کنید یا نمایش دهید.', 'studiare' ),
			'type'     => 'switch',
			'default'  => true,
			'on'       => esc_html__( 'فعال', 'studiare' ),
			'off'      => esc_html__( 'غیر فعال', 'studiare' )
		),

		array(
			'id'       => 'courses_teacher_loop',
			'title'    => esc_html__( 'نام مدرس در آرشیو دوره ها', 'studiare' ),
			'subtitle' => esc_html__( 'با این گزینه می توانید نام مدرس دوره را در آرشیو دوره ها مخفی کنید یا نمایش دهید.', 'studiare' ),
			'type'     => 'switch',
			'default'  => true,
			'on'       => esc_html__( 'فعال', 'studiare' ),
			'off'      => esc_html__( 'غیر فعال', 'studiare' )
		),

		array(
			'id'       => 'courses_cart_loop',
			'title'    => esc_html__( 'دکمه خرید آرشیو دوره ها', 'studiare' ),
			'subtitle' => esc_html__( 'با این گزینه می توانید نام مدرس دوره را در آرشیو دوره ها مخفی کنید یا نمایش دهید.', 'studiare' ),
			'type'     => 'switch',
			'default'  => true,
			'on'       => esc_html__( 'فعال', 'studiare' ),
			'off'      => esc_html__( 'غیر فعال', 'studiare' )
		),

	)
) );
Redux::setSection( $opt_name, array(
	'title'            => esc_html__( 'صفحه دوره', 'studiare' ),
	'id'               => 'course_page_settings',
	'subsection'       => true,
	'fields' => array(


		array(
			'id'      => 'add_to_cart_text',
			'type'    => 'text',
			'default'  => 'ثبت نام دوره',
			'title'   => esc_html__( 'متن دکمه ثبت نام دوره', 'studiare' ),
		),

		array(
			'id'      => 'course_student_text',
			'type'    => 'text',
			'default'  => 'دانشجوی دوره هستید',
			'title'   => esc_html__( 'متن دانشجوی دوره هستید بعد از ثبت نام دانشجو', 'studiare' ),
		),

		array(
			'id'        => 'course_single_sidebar_position',
			'type'      => 'image_select',
			'title'     => esc_html__( 'موقعیت سایدبار صفحه دوره تکی', 'studiare' ),
			'subtitle'  => esc_html__( 'موقعیت سایدبار برگه دوره تکی را انتخاب کنید.', 'studiare' ),
			'default'   => 'right',
			'options'   => array(
				'left'      => array(
					'alt'   => esc_html__( 'Sidebar Left', 'studiare' ),
					'img'   => get_template_directory_uri() . '/inc/plugins/redux-framework/redux-core/assets/img/2cl.png'
				),
				'right'      => array(
					'alt'   => esc_html__( 'Sidebar Right', 'studiare' ),
					'img'  => get_template_directory_uri() . '/inc/plugins/redux-framework/redux-core/assets/img/2cr.png'
				),
			)
		),

		array(
			'id'       => 'course_purchase',
			'title'    => esc_html__( 'جلوگیری از خرید مجدد دوره', 'studiare' ),
			'subtitle' => esc_html__( 'فعال و غیر فعال کردن جلوگیری از خرید مجدد دوره', 'studiare' ),
			'type'     => 'switch',
			'default'  => true,
			'on'       => esc_html__( 'فعال', 'studiare' ),
			'off'      => esc_html__( 'غیرفعال', 'studiare' )
		),

		array(
			'id'       => 'course_downloads',
			'title'    => esc_html__( 'دریافت فایل های دوره', 'studiare' ),
			'subtitle' => esc_html__( 'نمایش و مخفی کردن بخش دریافت فایل های دوره', 'studiare' ),
			'type'     => 'switch',
			'default'  => false,
			'on'       => esc_html__( 'نمایش', 'studiare' ),
			'off'      => esc_html__( 'مخفی', 'studiare' )
		),

		array(
			'id'       => 'course_students',
			'title'    => esc_html__( 'تعداد دانشجویان دوره', 'studiare' ),
			'subtitle' => esc_html__( 'نمایش یا مخفی کردن تعداد دانشجویان دوره', 'studiare' ),
			'type'     => 'switch',
			'default'  => true,
			'on'       => esc_html__( 'نمایش', 'studiare' ),
			'off'      => esc_html__( 'مخفی', 'studiare' )
		),
		array(
			'id'       => 'course_counters',
			'title'    => esc_html__( 'آمار بازدید و تعداد نظرات', 'studiare' ),
			'subtitle' => esc_html__( 'نمایش و مخفی کردن بخش تعداد بازدید و نظرات دوره', 'studiare' ),
			'type'     => 'switch',
			'default'  => true,
			'on'       => esc_html__( 'نمایش', 'studiare' ),
			'off'      => esc_html__( 'مخفی', 'studiare' )
		),

		array(
			'id'       => 'course_detail_reviews',
			'title'    => esc_html__( 'آمار خلاصه امتیاز دانشجویان', 'studiare' ),
			'subtitle' => esc_html__( 'نمایش و مخفی کردن باکس خلاصه امتیازات دانشجویان', 'studiare' ),
			'type'     => 'switch',
			'default'  => false,
			'on'       => esc_html__( 'نمایش', 'studiare' ),
			'off'      => esc_html__( 'مخفی', 'studiare' )
		),


		array(
			'id'       => 'related_courses_display',
			'title'    => esc_html__( 'نمایش / مخی کردن دوره های مرتبط', 'studiare' ),
			'subtitle' => esc_html__( 'با استفاده از این گزینه می توانید دروه های مرتبط در برگه دوره ها را خاموش و روشن کنید.', 'studiare' ),
			'type'     => 'switch',
			'default'  => true,
			'on'       => esc_html__( 'نمایش', 'studiare' ),
			'off'      => esc_html__( 'مخفی', 'studiare' )
		),
		array(
			'id'       => 'course_per_page',
			'type'     => 'text',
			'title'    => esc_html__( 'تعداد دوره های مرتبط', 'studiare' ),
			'subtitle' => esc_html__( 'تعداد دوره های مرتبط در صفحه دوره', 'studiare' ),
			'default'  => '6',
			'min'      => '1',
			'max'      => '10',
		),

		array(
			'id' => 'content_review_rules',
			'type' => 'editor',
			'title' => esc_html__( 'محتوای بلوک قوانین ثبت نظر در برگه دوره', 'studiare' ),
		)

	)
) );



Redux::setSection( $opt_name, array(
	'title'            => esc_html__( 'پاپ آپ مشاوره', 'studiare' ),
	'id'               => 'course_page_advice',
	'subsection'       => true,
	'fields' => array(

		array(
			'id'       => 'course_advice',
			'title'    => esc_html__( 'بخش درخواست مشاوره', 'studiare' ),
			'subtitle' => esc_html__( 'فعال یا غیر فعال کردن بخش درخواست مشاوره در صفحه دوره', 'studiare' ),
			'type'     => 'switch',
			'default'  => true,
			'on'       => esc_html__( 'نمایش', 'studiare' ),
			'off'      => esc_html__( 'مخفی', 'studiare' )
		),
		array(
			'id'      => 'advice_phone',
			'type'    => 'text',
			'title'   => esc_html__( 'شماره تلفن داخل پاپ آپ', 'studiare' ),
		),
		array(
			'id'      => 'advice_form',
			'type'    => 'text',
			'title'   => esc_html__( 'شرتکد فرم درخواست تماس', 'studiare' ),
			'subtitle' => esc_html__( 'شما می توانید هر فرم دلخواهی که ساخته اید را در این بخش وارد کنید', 'studiare' ),
		),

		array(
			'id'       => 'advice_bg',
			'type'     => 'background',
			'title'    => esc_html__( 'تصویر پسزمینه بلوک درخواست مشاوره', 'studiare' ),
			'output'   => '#course-advice .advice .advice-inner',
			'default'  => array(
				'background-color' => '#fff'
			)
		),

	)
) );


Redux::setSection( $opt_name, array(
	'title'            => esc_html__( 'Sharing Settings', 'studiare' ),
	'id'               => 'course_sharing_settings',
	'subsection'       => true,
	'fields'           => array(
		array(
			'id'       => 'course_share_story',
			'title'    => esc_html__( 'Share Course', 'studiare' ),
			'subtitle' => esc_html__( 'Enable or disable sharing course on social networks', 'studiare' ),
			'type'     => 'switch',
			'default'  => true,
			'on'       => esc_html__( 'Allow Share', 'studiare' ),
			'off'      => esc_html__( 'No', 'studiare' )
		)
	)
) );

# Portfolio Settings
Redux::setSection( $opt_name, array(
	'title'             => esc_html__( 'Portfolio', 'studiare' ),
	'id'                => 'portfolio_settings',
	'icon'              => 'el-icon-th',
	'fields'            => array(
		array(
			'id'       => 'portfolio_columns',
			'type'     => 'button_set',
			'title'    => esc_html__('Projects columns', 'studiare'),
			'subtitle' => esc_html__('How many projects you want to show per row', 'studiare'),
			'options'  => array(
				'two'  => esc_html__( 'Two Columns', 'studiare' ),
				'three'  => esc_html__( 'Three Columns', 'studiare' ),
				'four'  => esc_html__( 'Four Columns', 'studiare' ),
			),
			'default' => 'three'
		),
		array(
			'id'        => 'portfolio_filters',
			'type'      => 'button_set',
			'title'     => esc_html__( 'Portfolio Filters', 'studiare' ),
			'subtitle'  => esc_html__( 'Show/hide portfolio filters on side', 'studiare' ),
			'options'   => array(
				'left'  => esc_html__( 'On Left', 'studiare' ),
				'right' => esc_html__( 'On Right', 'studiare' ),
				'no'    => esc_html__( 'None', 'studiare' )
			),
			'default'   => 'left'
		),
		array(
			'id'       => 'portfolio_per_page',
			'type'     => 'text',
			'title'    => esc_html__( 'Portfolio per page', 'studiare' ),
			'subtitle' => esc_html__( 'Number of portfolio per page', 'studiare' ),
			'default'  => '9',
			'min'      => '1',
			'max'      => '20',
		),
		array(
			'id'        => 'portfolio_nav',
			'type'      => 'switch',
			'title'     => esc_html__( 'Display Portfolio Navigation?', 'studiare' ),
			'subtitle'  => esc_html__( 'Displays portfolio item navigation after content.', 'studiare' ),
			'default'   => true,
		)
	)
) );


# Social Media Links
$social_networks_ordering = array(
	'enabled' => array (
		'placebo'	=> 'placebo',
		'fb'   	 	=> 'Facebook',
		'tw'   	 	=> 'Twitter',
		'ig'        => 'Instagram',
		'vm'        => 'Vimeo',
		'be'        => 'Behance',
		'fs'        => 'Foursquare',
		'tlg'		=> 'Telegram',
		'wpp'		=> 'Whatsapp',
		'custom'    => 'Custom Link',
	),
	'disabled' => array (
		'placebo'   => 'placebo',
		'gp'        => "Google+",
		'lin'       => 'LinkedIn',
		'yt'        => 'YouTube',
		'drb'       => 'Dribbble',
		'pi'        => 'Pinterest',
		'vk'        => 'VKontakte',
		'da'        => 'DeviantArt',
		'fl'        => 'Flickr',
		'vi'        => 'Vine',
		'tu'        => 'Tumblr',
		'sk'        => 'Skype',
		'gh'        => 'GitHub',
		'hz'        => 'Houzz',
		'px'        => '500px',
		'xi'        => 'Xing',
		'sn'        => 'Snapchat',
		'em'        => 'Email',
		'yp'        => 'Yelp',
		'ta'        => 'TripAdvisor',
		'aparat'    => 'آپارات',
	),
);

Redux::setSection( $opt_name, array(
	'title'             => esc_html__( 'Social Networks', 'studiare' ),
	'id'                => 'social_networks',
	'desc'              => '',
	'customizer_width'  => '400px',
	'submenu'           => true,
	'icon'              => 'fa fa-share-alt',
	'fields'            => array(
		// Social Networks Ordering
		array(
			'id'        => 'social_order',
			'type'      => 'sorter',
			'title'     => esc_html__( 'Social Networks Ordering', 'studiare' ),
			'subtitle'  => "Set the appearing order of social networks in the footer. To use social networks links list copy this shortcode:<br><br> " . $codebean_social_networks_shortcode,
			'options'   => $social_networks_ordering,
		),
		array(
			'id'        => 'social_networks_target_attr',
			'type'      => 'select',
			'title'     => esc_html__( 'Link Target', 'studiare' ),
			'subtitle'  => esc_html__( 'Open social links in new window or current window', 'studiare' ),
			'default'   => '_blank',
			'options'   => array(
				'_self' => esc_html__( 'Same Window', 'studiare' ),
				'_blank' => esc_html__( 'New Window', 'studiare' ),
			),
			'select2'   => array('allowClear' => false)
		),
		array(
			'id'       => 'social_network_link_aparat',
			'type'     => 'text',
			'title'    => 'آپارات',
			'placeholder' => 'https://www.aparat.com/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_aparat_link_icon',
			'type'     => 'text',
			'title'    => 'نام آیکون آپارات',
			'desc'     => 'بنویسید: aparat',
			'placeholder' => 'مثلا: aparat',
			'default'  => 'aparat',
		),

		array(
			'id'       => 'social_network_link_fb',
			'type'     => 'text',
			'title'    => 'Facebook',
			'placeholder' => 'https://facebook.com/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_tlg',
			'type'     => 'text',
			'title'    => 'Telegram',
			'placeholder' => 'https://t.me/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_wpp',
			'type'     => 'text',
			'title'    => 'whatsapp',
			'placeholder' => 'لینک واتساپ',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_tw',
			'type'     => 'text',
			'title'    => 'Twitter',
			'placeholder' => 'https://twitter.com/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_lin',
			'type'     => 'text',
			'title'    => 'Linkedin',
			'placeholder' => 'https://linkedin.com/in/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_yt',
			'type'     => 'text',
			'title'    => 'YouTube',
			'placeholder' => 'https://youtube.com/user/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_vm',
			'type'     => 'text',
			'title'    => 'Vimeo',
			'placeholder' => 'https://vimeo.com/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_drb',
			'type'     => 'text',
			'title'    => 'Dribbble',
			'placeholder' => 'https://dribbble.com/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_ig',
			'type'     => 'text',
			'title'    => 'Instagram',
			'placeholder' => 'https://instagram.com/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_pi',
			'type'     => 'text',
			'title'    => 'Pinterest',
			'placeholder' => 'https://pinterest.com/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_gp',
			'type'     => 'text',
			'title'    => 'Google Plus',
			'placeholder' => 'https://plus.google.com/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_vk',
			'type'     => 'text',
			'title'    => 'VKontakte',
			'placeholder' => 'https://vk.com/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_da',
			'type'     => 'text',
			'title'    => 'DeviantArt',
			'placeholder' => 'https://username.deviantart.com/',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_tu',
			'type'     => 'text',
			'title'    => 'Tumblr',
			'placeholder' => 'https://username.tumblr.com/',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_vi',
			'type'     => 'text',
			'title'    => 'Vine',
			'placeholder' => 'https://vine.com/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_be',
			'type'     => 'text',
			'title'    => 'Behance',
			'placeholder' => 'https://behance.com/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_fl',
			'type'     => 'text',
			'title'    => 'Flickr',
			'placeholder' => 'https://flickr.com/photos/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_fs',
			'type'     => 'text',
			'title'    => 'Foursquare',
			'placeholder' => 'https://foursquare.com/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_sk',
			'type'     => 'text',
			'title'    => 'Skype',
			'placeholder' => 'skype:username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_gh',
			'type'     => 'text',
			'title'    => 'GitHub',
			'placeholder' => 'https://github.com/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_hz',
			'type'     => 'text',
			'title'    => 'Houzz',
			'placeholder' => 'https://houzz.com/user/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_px',
			'type'     => 'text',
			'title'    => '500px',
			'placeholder' => 'https://500px.com/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_vi',
			'type'     => 'text',
			'title'    => 'Xing',
			'placeholder' => 'https://xing.com/profile/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_sn',
			'type'     => 'text',
			'title'    => 'Snapchat',
			'placeholder' => 'https://snapchat.com/add/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_yp',
			'type'     => 'text',
			'title'    => 'Yelp',
			'placeholder' => 'https://yelp.com/biz/alias',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_ta',
			'type'     => 'text',
			'title'    => 'Trip Advisor',
			'placeholder' => 'https://tripadvisor.com',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_em',
			'type'     => 'text',
			'title'    => 'Contact Email',
			'placeholder' => 'john.doe@email.com',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_em_subject',
			'type'     => 'text',
			'title'    => 'Contact Subject',
			'placeholder' => 'Hello!',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_custom_link_title',
			'type'     => 'text',
			'title'    => 'Custom Link',
			'placeholder' => 'Custom Link Title',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_custom_link_link',
			'type'     => 'text',
			'title'    => 'Link',
			'placeholder' => 'https://www.mywebsite.com/',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_custom_link_icon',
			'type'     => 'text',
			'title'    => 'Custom Link Icon',
			'desc'     => 'Icon (optional)<br><small>Note: If you want to set custom icon, enter icon alias from <a href="http://fontawesome.io/icons/" target="_blank">Font Awesome</a> icon collection.</small>',
			'placeholder' => 'Example: bookmark',
			'default'  => '',
		),

	)
) );
/*
 * <--- END SECTIONS
 */

// Function used to retrieve theme option values
if ( ! function_exists( 'codebean_option' ) ) {
	function codebean_option( $id, $fallback = false, $param = false ) {
		global $codebean_option;
		if ( $fallback == false ) $fallback = '';
		$output = ( isset( $codebean_option[$id] ) && $codebean_option[$id] !== '' ) ? $codebean_option[$id] : $fallback;
		if ( !empty( $codebean_options[$id] ) && $param ) {
			$output = $codebean_options[$id][$param];
		}
		return $output;
	}
}
