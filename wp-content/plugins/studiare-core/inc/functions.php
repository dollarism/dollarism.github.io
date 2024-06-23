<?php

// Enqueue script
function studiare_plugin_enqueue_script() {

	// CSS
  wp_enqueue_style('studiare-plugns', plugin_dir_url( __FILE__ ) . '../assets/css/plugins.css');
  wp_enqueue_style('studiare-plugn', plugin_dir_url( __FILE__ ) . '../assets/css/plugin.css');

	// JS
  wp_enqueue_script( 'studiare-plugins', plugin_dir_url( __FILE__ ) . '../assets/js/plugins.js', array('jquery'), wp_get_theme()->get( 'Version' ), true );
  wp_enqueue_script( 'studiare-plugin', plugin_dir_url( __FILE__ ) . '../assets/js/plugin.js', array('jquery'), wp_get_theme()->get( 'Version' ), true );
  wp_enqueue_script( 'bootstrap', plugin_dir_url( __FILE__ ) . '../assets/js/bootstrap.min.js', array('jquery'), wp_get_theme()->get( 'Version' ), true );
}
add_action('wp_enqueue_scripts', 'studiare_plugin_enqueue_script');



if( ! function_exists("webdenj_studiare_teacher_list") ){
	/**
	 * Get Teacher List
	 * @return array $staff_array
	 */
	function webdenj_studiare_teacher_list(){

		$staff_query  = query_posts('posts_per_page=-1&post_type=teacher&orderby=title&order=ASC'); // Products
		$staff_array = array();

		if(is_array($staff_array)){
			foreach ($staff_query as $staff ) {	// add product posts to the list
				$staff_array[$staff->ID] = $staff->post_title;
			}
		}

		wp_reset_query();
		return $staff_array;
	}
}
