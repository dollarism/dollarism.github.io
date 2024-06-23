<?php
/**
 * The header for our theme
 */
?> <!DOCTYPE html>
<html itemscope itemtype="http://schema.org/WebPage" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php do_action( 'studiare_before_body' ); ?>

<?php

$header_button = true;
$header_button_link = 'account';
$account_link = get_permalink( get_option('woocommerce_myaccount_page_id') );

if ( class_exists('Redux') ) {
	$header_button = codebean_option('header_button');
	$header_button_link = codebean_option('header_button_link');
	$header_type = codebean_option ('header_type');
} ?>


	<div class="video_popup_wrrapper">
	<div class="video_popup_overlay"></div>
		<div class="video_popup_inner"></div>
	</div>
<div class="wrap">

    <?php if ( studiare_needs_header() ): ?>
	
	<?php if ( $header_type == 'h_v1' ) : ?>

        <?php get_template_part('/inc/templates/header/top-bar' ); ?>
        <?php get_template_part( '/inc/templates/header/header-main' ); ?>
        <?php get_template_part('/inc/templates/page-title'); ?>
	
	<?php elseif ( $header_type == 'h_v2' ) : ?>
	
		<?php get_template_part('/inc/templates/header/top-bar-2' ); ?>
		<?php get_template_part( '/inc/templates/header/header-main-2' ); ?>
		<?php get_template_part('/inc/templates/page-title'); ?>

    <?php endif; ?>
	<?php endif; ?>