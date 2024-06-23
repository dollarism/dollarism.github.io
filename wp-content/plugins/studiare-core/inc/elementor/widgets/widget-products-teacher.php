<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Products
class studiare_Widget_products_teacher extends Widget_Base {

   public function get_name() {
      return 'Products-teacher';
   }

   public function get_title() {
      return esc_html__( 'دوره ها بر اساس مدرس', 'studiare-core' );
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
            'label' => esc_html__( 'Products', 'studiare-core' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'columns',
         [
            'label' => __( 'Columns', 'studiare-core' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'col-md-4',
            'options' => [
               'col-md-12'  => __( 'Column 1', 'studiare-core' ),
               'col-md-6' => __( 'Column 2', 'studiare-core' ),
               'col-md-4' => __( 'Column 3', 'studiare-core' ),
               'col-md-3' => __( 'Column 4', 'studiare-core' ),
               'col-md-2' => __( 'Column 6', 'studiare-core' ),
               'col-md-1' => __( 'Column 12', 'studiare-core' ),
            ],
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
			'ids',
			[
				'label'     => esc_html_x( 'انتخاب استاد', 'studiare-core' ),
				'description' => esc_html_x('دوره ها را فقط از اساتید انتخاب شده نمایش بده', 'studiare-core' ),
				'type'      =>  Controls_Manager::SELECT2,
				'default'    =>  "",
				'multiple' => false,
				"options"    => webdenj_studiare_teacher_list(),
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

      $settings = $this->get_settings_for_display(); ?>

      <div class="elementor-products products row justify-content-center">
         <?php

         $prefix = '_studiare_';
         $teacher_id = get_post_meta( get_the_ID(), $prefix . 'course_teacher', true );

         $cat_include = $settings['category'];
         $ids = ! empty( $settings["ids"] ) ? $settings["ids"] : 'All';

         $meta_query[] = array(
                'relation' => 'OR',
                   array(
                      'key'     => '_studiare_course_teacher',
                      'value' => $ids
                    ),
                  array(
                      'key'     => '_studiare_course_teacher_2',
                      'value' => $ids
                    ),
            );

   		  $args = array(
               'post_type' => 'product',
               'post_status' => array( 'publish'),
               'posts_per_page' => $settings['ppp']['size'],
               'order' => $settings['order'],
               'post_status' => 'publish',
               'tax_query' => array(
                   'relation' => 'AND',
               ),
               'meta_query' => $meta_query
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

         /* Start the Loop */
         while ( $products->have_posts() ) : $products->the_post(); ?>
            <!-- Item -->
            <div class="<?php echo esc_attr($settings['columns']) ?>">
             <?php get_template_part( 'woocommerce/content-product-carousel' ); ?>
            </div>

         <?php
         endwhile;
      wp_reset_postdata();
      ?>
      </div>
   <?php
   }

}

Plugin::instance()->widgets_manager->register_widget_type( new studiare_Widget_products_teacher );
