<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Products
class studiare_Widget_products extends Widget_Base {

   public function get_name() {
      return 'Products';
   }

   public function get_title() {
      return esc_html__( 'Products', 'studiare-core' );
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
            'default' => 'col-lg-4 col-md-4 col-sm-6 col-xs-12',
            'options' => [
               'col-md-12'  => __( 'Column 1', 'studiare-core' ),
               'col-md-6 col-sm-6 col-xs-12' => __( 'Column 2', 'studiare-core' ),
               'col-lg-4 col-md-4 col-sm-6 col-xs-12' => __( 'Column 3', 'studiare-core' ),
               'col-lg-3 col-md-3 col-sm-6 col-xs-12' => __( 'Column 4', 'studiare-core' ),
               'col-md-2 col-sm-6 col-xs-12' => __( 'Column 6', 'studiare-core' ),
               'col-md-1 col-sm-6 col-xs-12' => __( 'Column 12', 'studiare-core' ),
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

      <div class="container">

      <div class="elementor-products products row justify-content-center">
         <?php

         //Inline Editing
         $this->add_inline_editing_attributes( 'ppp', 'basic' );

         $cat_include = $settings['category'];

         $args = array(
                'post_type' => 'product',
                'post_status' => array( 'publish'),
                'posts_per_page' => $settings['ppp']['size'],
                'order' => $settings['order'],
                'tax_query' => array(
                    'relation' => 'AND',
                ),
            );
         
         if (!empty($cat_include)) {
          $category = array();
          foreach ($settings['category'] as $category) {
            $term = term_exists($category, $taxonomy = 'product_cat');
            if ($term !== 0 && $term !== null) {
              $cat_include[] = $term['term_id'];
            }
          }
         
         if (!empty($cat_include)) {
           $args['tax_query'][] = array(
             'taxonomy'  => 'product_cat',
             'terms'     => $cat_include,
             'operator'  => 'IN',
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
    </div>
   <?php
   }

}

Plugin::instance()->widgets_manager->register_widget_type( new studiare_Widget_products );
