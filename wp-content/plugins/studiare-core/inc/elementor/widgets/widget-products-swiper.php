<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Products
class studiare_Widget_products_swiper extends Widget_Base {

   public function get_name() {
      return 'Swiper_Products';
   }

   public function get_title() {
      return esc_html__( '3D Slider Products', 'studiare-core' );
   }

   public function get_icon() {
        return 'eicon-form-vertical';
   }

   public function get_categories() {
      return [ 'studiare-elements' ];
   }

   protected function register_controls() {

      $this->start_controls_section(
         'products_section',
         [
            'label' => esc_html__( 'Carousel Products', 'studiare-core' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'columns',
         [
            'label' => __( 'Columns', 'studiare-core' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => '2',
            'options' => [
               '4'  => __( '4 ستونه', 'studiare-core' ),
               '3' => __( '3 ستونه', 'studiare-core' ),
               '2' => __( '2 ستونه', 'studiare-core' ),
            ],
         ]
      );

	  $this->add_control(
         'pagination',
         [
            'label' => __( 'صفحه گذاری اسلایدر', 'studiare-core' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'yes',

         ]
      );

	  $this->add_control(
         'navigation',
         [
            'label' => __( 'فلش های ناوبری', 'studiare-core' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'yes',

         ]
      );

	  $this->add_control(
         'loop',
         [
            'label' => __( 'حلقه کروسل', 'studiare-core' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'yes',

         ]
      );

	  $this->add_control(
         'autoplay',
         [
            'label' => __( 'اجرای خودکار اسلایدر', 'studiare-core' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'yes',

         ]
      );

      $this->add_control(
         'category',
         [
            'label' => esc_html__( 'Category', 'studiare-core' ),
            'type' => Controls_Manager::SELECT2,
            'title' => esc_html__( 'Select a category', 'studiare-core' ),
            'multiple' => true,
            'options' => studiare_get_terms_dropdown_array([
               'taxonomy' => 'product_cat',
               'hide_empty' => false,
            ]),
         ]
      );

      $this->add_control(
         'ppp',
         [
            'label' => __( 'Number of Items', 'studiare-core' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
               'no' => [
                  'min' => 0,
                  'max' => 100,
                  'step' => 1,
               ],
            ],
            'default' => [
               'size' => 3,
            ]
         ]
      );

      $this->add_control(
         'order',
         [
            'label' => __( 'order', 'studiare-core' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'DESC',
            'options' => [
               'ASC'  => __( 'Ascending', 'studiare-core' ),
               'DESC' => __( 'Descending', 'pelleh' )
            ],
         ]
      );

      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {

      // get our input from the widget settings.

      $settings = $this->get_settings_for_display();
	  $carousel_data = array();
	  $carousel_data['data-slider-items'] = $settings['columns'];
	  $carousel_data['data-pagination'] = $settings['pagination'];
	  $carousel_data['data-navigation'] = $settings['navigation'];
	  $carousel_data['data-loop'] = $settings['loop'];
	  $carousel_data['data-autoplay'] = $settings['autoplay'];

	  ?>




    <div class="products courses-holder medium swiper-holder">
	<div class="swiper-container-5">

			<div class="swiper-wrapper">

				<?php

        $cat_include = $settings['category'];

  		  $args = array(
              'post_type' => 'product',
              'posts_per_page' => $settings['ppp']['size'],
              'order' => $settings['order'],
              'post_status' => 'publish',
              'tax_query' => array(
                  'relation' => 'AND',
              ),
          );


          if (!empty($settings['category'])) {
              $cat_include = array();
              foreach ($settings['category'] as $category) {
                  $term = term_exists($category, 'product_cat');
                  if ($term !== 0 && $term !== null) {
                      $cat_include[] = $term['term_id'];
                  }
              }
              if (!empty($cat_include)) {
                  $args['tax_query'][] = array(
                      'taxonomy' => 'product_cat',
                      'terms' => $cat_include,
                      'operator' => 'IN',
                  );
              }
          }

        $products = new \WP_Query($args);

         while( $products->have_posts() ) : $products->the_post();


         ?>
					<?php get_template_part( 'woocommerce/content', 'product-swiper' );?>
				<?php $i++; endwhile; ?>
			</div>

	</div>
	<!-- Add Pagination -->
	 <div class="swiper-pagination"></div>
	 <!-- Add Arrows -->
	 <div class="swiper-button-next"></div>
	 <div class="swiper-button-prev"></div>
</div>
<?php wp_reset_postdata(); ?>


   <?php
   }

}

Plugin::instance()->widgets_manager->register_widget_type( new studiare_Widget_products_swiper);
