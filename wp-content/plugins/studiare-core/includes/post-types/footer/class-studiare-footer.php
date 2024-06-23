<?php
/**
 * The Teacher Custom Post Type
 */

if ( !defined( 'ABSPATH' ) )
	die( '-1' );

if ( ! class_exists( 'Studiare_Footer' ) ) {

	class Studiare_Footer {

		public static $instance;

		// Setup a single instance using the singleton pattern
		public static function init() {

			if ( is_null( self::$instance ) ) {
				self::$instance = new Studiare_Footer();
			}
			return self::$instance;

		}

		function __construct() {

			add_action( 'init', array($this, 'register_post_type' ), 5 );


		}

		function register_post_type() {

			$options = get_option( 'studiare-core-options' );

			if ( post_type_exists( 'footer' ) ) {
				return;
			}

			$labels = array(
				'name'                => _x( 'فوترها', 'Post Type General Name', 'studiare-core' ),
				'singular_name'       => _x( 'فوتر', 'Post Type Singular Name', 'studiare-core' ),
				'menu_name'           => __( 'فوترها', 'studiare-core' ),
				'parent_item_colon'   => __( 'فوتر والد:', 'studiare-core' ),
				'all_items'           => __( 'همه فوترها', 'studiare-core' ),
				'view_item'           => __( 'مشاهده فوتر', 'studiare-core' ),
				'add_new_item'        => __( 'افزودن فوتر جدید', 'studiare-core' ),
				'add_new'             => __( 'افزودن جدید', 'studiare-core' ),
				'edit_item'           => __( 'ویرایش فوتر', 'studiare-core' ),
				'update_item'         => __( 'بروزرسانی فوتر', 'studiare-core' ),
				'search_items'        => __( 'جستجوی فوتر', 'studiare-core' ),
				'not_found'           => __( 'یافت نشد', 'studiare-core' ),
				'not_found_in_trash'  => __( 'Not found in Trash', 'studiare-core' ),
			);


			$args = array(
				'label'               => __( 'footer', 'studiare-core' ),
				'description'         => __( 'نوشته نوع فوتر', 'studiare-core' ),
				'labels'              => $labels,
				'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
				'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 20,
        'show_in_nav_menus'   => false,
        'publicly_queryable'  => true,
        'exclude_from_search' => true,
        'has_archive'         => true,
        'query_var'           => true,
        'can_export'          => true,
        'rewrite'             => true,
        'capability_type'     => 'post',
        'map_meta_cap'        => true
			);

			register_post_type( 'footer', $args );

		}

	}

	Studiare_Footer::init();
}
