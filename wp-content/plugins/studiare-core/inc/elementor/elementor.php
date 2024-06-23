<?php

if ( ! defined( 'ABSPATH' ) ) exit;


// get posts dropdown
function studiare_get_posts_dropdown_array($args = [], $key = 'ID', $value = 'post_title') {
  $options = [];
  $posts = get_posts($args);
  foreach ((array) $posts as $term) {
    $options[$term->{$key}] = $term->{$value};
  }
  return $options;
}

// get terms dropdown
function studiare_get_terms_dropdown_array($args = [], $key = 'term_id', $value = 'name') {
  $options = [];
  $terms = get_terms($args);

  if (is_wp_error($terms)) {
    return [];
  }

  foreach ((array) $terms as $term) {
    $options[$term->{$key}] = $term->{$value};
  }

  return $options;
}


function studiare_add_elementor_widget_categories( $elements_manager ) {

	$elements_manager->add_category(
		'studiare-elements',
		[
			'title' => esc_html__( 'عناصر قالب استادیار', 'studiare-core' ),
			'icon' => 'fa fa-plug',
		]
	);

}
add_action( 'elementor/elements/categories_registered', 'studiare_add_elementor_widget_categories' );

//Elementor init

class studiare_ElementorCustomElement {

   private static $instance = null;

   public static function get_instance() {
      if ( ! self::$instance )
         self::$instance = new self;
      return self::$instance;
   }

   public function init(){
      add_action( 'elementor/widgets/widgets_registered', array( $this, 'widgets_registered' ) );
   }


   public function widgets_registered() {

    // We check if the Elementor plugin has been installed / activated.
    if(defined('ELEMENTOR_PATH') && class_exists('Elementor\Widget_Base')){
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-ajax-search.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-blog.php');
		     include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-blog-carousel.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-blog-metro.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-blog-podcast.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-blog-video.php');
         //include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-counter.php');//
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-download.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-lessons.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-steps.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-products.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-products-teacher.php');
		     include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-products-carousel.php');
         //include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-products-swiper.php');//
         //include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-team.php');//
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-testimonials.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-portfolios.php');
         //include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-price-tables.php');

         ############### ham3da #############
        if (defined('HTQ_SLUG'))
        {
            include_once(plugin_dir_path(__FILE__) . '/widgets/widget-tests.php');
            include_once(plugin_dir_path(__FILE__) . '/widgets/widget-test-carousel.php');
        }
        ############### ham3da #############
      }
	}

}

studiare_ElementorCustomElement::get_instance()->init();
