<?php
/**
 * The Teacher Custom Post Type
 */

if ( !defined( 'ABSPATH' ) )
	die( '-1' );

if ( ! class_exists( 'Studiare_Teacher' ) ) {

	class Studiare_Teacher {

		public static $instance;

		// Setup a single instance using the singleton pattern
		public static function init() {

			if ( is_null( self::$instance ) ) {
				self::$instance = new Studiare_Teacher();
			}
			return self::$instance;

		}

		function __construct() {

			add_action( 'init', array($this, 'register_post_type' ), 5 );
			add_action( 'cmb2_admin_init', array($this,'register_meta_boxes' ));

			if( is_admin() ) {

				add_filter( 'manage_edit-teacher_columns' , array( $this,'add_teacher_columns' ) );
				add_action( 'manage_teacher_posts_custom_column' , array( $this,'set_teacher_columns_content' ), 10, 2 );

			}
		}

		function register_post_type() {

			$options = get_option( 'studiare-core-options' );

			if ( post_type_exists( 'teacher' ) ) {
				return;
			}

			$labels = array(
				'name'                => _x( 'Teachers', 'Post Type General Name', 'studiare-core' ),
				'singular_name'       => _x( 'Teacher', 'Post Type Singular Name', 'studiare-core' ),
				'menu_name'           => __( 'مدرسین', 'studiare-core' ),
				'parent_item_colon'   => __( 'Parent Teacher:', 'studiare-core' ),
				'all_items'           => __( 'All Teachers', 'studiare-core' ),
				'view_item'           => __( 'View Teacher', 'studiare-core' ),
				'add_new_item'        => __( 'Add New Teacher', 'studiare-core' ),
				'add_new'             => __( 'Add New', 'studiare-core' ),
				'edit_item'           => __( 'Edit Teacher', 'studiare-core' ),
				'update_item'         => __( 'Update Teacher', 'studiare-core' ),
				'search_items'        => __( 'Search Teacher', 'studiare-core' ),
				'not_found'           => __( 'Not found', 'studiare-core' ),
				'not_found_in_trash'  => __( 'Not found in Trash', 'studiare-core' ),
			);

		
			$args = array(
				'label'               => __( 'teacher', 'studiare-core' ),
				'description'         => __( 'Teacher Post Type', 'studiare-core' ),
				'labels'              => $labels,
				'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
				'hierarchical'        => false,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'show_in_nav_menus'   => false,
				'show_in_admin_bar'   => true,
				'menu_position'       => 20,
				'can_export'          => true,
				'has_archive'         => true,
				'exclude_from_search' => false,
				'publicly_queryable'  => true,
				'query_var'           => true,
				'rewrite' => array('slug' => 'teacher','with_front' => false),
				'menu_icon'           => 'dashicons-awards',
				'capability_type'     => 'post',
			);

			register_post_type( 'teacher', $args );

		}

		function register_meta_boxes() {

			$prefix = '_studiare_';

			$teacher_metaboxes = new_cmb2_box( array(
				'id'           => 'teacher_metabox',
				'title'        => esc_html__( 'Teacher Details', 'studiare' ),
				'object_types' => array( 'teacher' ),
				'context'      => 'normal',
				'priority'     => 'high',
				'show_names'   => true,
			) );

			$teacher_metaboxes->add_field( array(
				'name' => esc_html__( 'Job Title', 'studiare' ),
				'default' => 'Senior Software Developer',
				'id'   => $prefix . 'teacher_job_title',
				'type' => 'text',
			) );

			$teacher_metaboxes->add_field( array(
				'name' => esc_html__( 'Facebook', 'studiare' ),
				'id' => 'facebook',
				'type' => 'text',
			) );

			$teacher_metaboxes->add_field( array(
				'name' => esc_html__( 'Twitter', 'studiare' ),
				'id' => 'twitter',
				'type' => 'text',
			) );

			$teacher_metaboxes->add_field( array(
				'name' => esc_html__( 'Google +', 'studiare' ),
				'id' => 'google-plus',
				'type' => 'text',
			) );

			$teacher_metaboxes->add_field( array(
				'name' => esc_html__( 'LinkedIn', 'studiare' ),
				'id' => 'linkedin',
				'type' => 'text',
			) );

			$teacher_metaboxes->add_field( array(
				'name' => esc_html__( 'Youtube', 'studiare' ),
				'id' => 'youtube-play',
				'type' => 'text',
			) );
		}

		function add_teacher_columns( $cols ) {

			$cols = array(
				'cb'        =>   '<input type="checkbox" />',
				'title'     => __( 'Title', 'studiare-core' ),
				'thumbnail' => __( 'Thumbnail', 'studiare-core')
			);

			return $cols;

		}

		function set_teacher_columns_content( $column, $post_id ) {

			$width = (int) 35;
			$height = (int) 35;

			switch( $column ) {

				case 'thumbnail' :
					$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
					$attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );

					if ( $thumbnail_id ) {
						$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
					} elseif ( $attachments ) {
						foreach ( $attachments as $attachment_id => $attachment ) {
							$thumb = wp_get_attachment_image( $attachment_id, array($width, $height), true );
						}
					}

					if ( isset( $thumb ) && $thumb ) {
						echo wp_kses_post( $thumb );
					} else {
						echo __('None', 'educa-addons');
					}

					break;

			}

		}

	}

	Studiare_Teacher::init();
}
