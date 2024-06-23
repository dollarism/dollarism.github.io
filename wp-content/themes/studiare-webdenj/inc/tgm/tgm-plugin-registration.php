<?php

# Library
require_once get_parent_theme_file_path('/inc/tgm/class-tgm-plugin-activation.php');

add_action( 'tgmpa_register', 'studiare_register_required_plugins' );

function studiare_register_required_plugins( $return = false ) {

	$plugins = array(

		array(
			'name'               => esc_html__( 'WooCommerce', 'studiare' ),
			'slug'               => 'woocommerce',
			'required'           => true,
		),

		array(
			'name'      => esc_html__( 'المنتور', 'studiare' ),
			'slug'      => 'elementor',
			'required'  => true,
		),

		array(
			'name'      => esc_html__( 'Studiare Core', 'studiare' ),
			'slug'      => 'studiare-core',
			'source'    => get_template_directory() . '/inc/lib/plugins/studiare-core.zip',
			'required'  => true,
			'version'  				=> '3.2.0',
		),

		array(
			'name'     => esc_html__( 'Breadcrumb NavXT', 'studiare' ),
			'slug'     => 'breadcrumb-navxt',
			'required' => true
		),

		array(
			'name'      => esc_html__( 'MailChimp for WordPress', 'studiare' ),
			'slug'      => 'mailchimp-for-wp',
			'required'  => false,
		),

		array(
			'name'        => esc_html__( 'Portfolio Post Type', 'studiare' ),
			'slug'        => 'portfolio-post-type',
			'required'    => false,
		),

	);

	if($return) {
		return $plugins;
	} else {
		$config = array(
			'is_automatic' => true
		);

		tgmpa($plugins, $config);
	}
}
