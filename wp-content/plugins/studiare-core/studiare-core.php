<?php
/*
Plugin Name: Studiare Core
Plugin URI: http://webdenj.com
Description: Studiare core needed for Studiare theme.
Version: 3.2.0
Author: webdenj
Author URI: http://www.webdenj.com
*/

// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Studiare_Core') ) {

	class Studiare_Core {

		/**
		 * PHP5 constructor method.
		 *
		 * @since  1.0
		 * @access public
		 */
		public function __construct() {

			/* Set the constants needed by the plugin. */
			add_action( 'plugins_loaded', array( $this, 'constants' ), 1 );

			/* Internationalize the text strings used. */
			add_action( 'plugins_loaded', array( $this, 'i18n' ), 2 );

			/* Load the functions files. */
			add_action( 'plugins_loaded', array( $this, 'includes' ), 3 );

		}

		/**
		 * Defines constants used by the plugin.
		 *
		 * @since  1.0
		 * @access public
		 */
		public function constants() {

			/* Set constant path to the plugin directory. */
			define( 'STUDIARE_CORE_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );

			/* Set the constant path to the plugin directory URI. */
			define( 'STUDIARE_CORE_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );

			/* Set the constant path to the includes directory. */
			define( 'STUDIARE_CORE_INCLUDES', STUDIARE_CORE_DIR . trailingslashit( 'includes' ) );

		}

		/**
		 * Loads the initial files needed by the plugin.
		 *
		 * @since  1.0
		 * @access public
		 */
		public function includes() {

			/* Load the teacher custom post type. */
			require_once STUDIARE_CORE_INCLUDES . 'post-types/teacher/class-studiare-teacher.php';
			require_once STUDIARE_CORE_INCLUDES . 'post-types/footer/class-studiare-footer.php';

		}

		/**
		 * Loads the translation files.
		 *
		 * @since  1.0
		 * @access public
		 */
		public function i18n() {

			/* Load the translation of the plugin. */
			load_plugin_textdomain( 'studiare-core', false, basename( dirname( __FILE__ ) ) . '/languages/' );
		}

	}

	new Studiare_Core();
}


include_once(dirname( __FILE__ ). '/inc/functions.php');
include_once(dirname( __FILE__ ). '/inc/elementor/elementor.php');
include_once(dirname( __FILE__ ). '/inc/ajax-woo-products/ajax.php');
