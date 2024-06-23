<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Download
class studiare_Widget_download extends Widget_Base {

   public function get_name() {
      return 'download';
   }

   public function get_title() {
      return esc_html__( 'Download', 'studiare-core' );
   }

   public function get_icon() {
        return 'eicon-gallery-masonry';
   }

   public function get_categories() {
      return [ 'studiare-elements' ];
   }

   protected function register_controls() {

      $this->start_controls_section(
         'download_section',
         [
            'label' => esc_html__( 'Download', 'studiare-core' ),
            'type' => Controls_Manager::SECTION,
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
         'filter',
         [
            'label' => __( 'Filter', 'studiare-core' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __( 'Yes', 'studiare-core' ),
            'label_off' => __( 'No', 'studiare-core' ),
            'return_value' => 'yes',
            'default' => 'yes'
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
               'size' => 9,
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
         <?php if ( 'yes' == $settings['filter'] ) {?>
            <div class="download-filter">
               <ul class="list-inline">
                  <li class="select-cat list-inline-item product-filter" data-product-cat="<?php foreach ( $settings['category'] as $category ) { echo esc_attr( get_term_by('id', $category, 'product_cat')->slug ).','; } ?>"><?php echo esc_html__( 'All Items', 'studiare-core' ) ?></li>

                  <?php

                  if ( $settings['category'] ) {

                     foreach ( $settings['category'] as $category ) { ?>

                     <li class="list-inline-item product-filter" data-product-cat="<?php echo esc_attr( get_term_by('id', $category, 'product_cat')->slug ) ?>"><?php echo esc_html( get_term_by('id', $category, 'product_cat')->name ) ?></li>

                     <?php }
                  } ?>
               </ul>
            </div>
            <div class="loader"></div>
         <?php } ?>

         <div class="elementor-products products download_items row justify-content-center">
            <div class="loader"></div>
            <?php

        $cat_include = $settings['category'];

   		  $args = array(
               'post_type' => 'product',
               'posts_per_page' => $settings['ppp']['size'],
               'order' => $settings['order'],
               'tax_query' => array(
                   'relation' => 'AND',
                   array(
                      'taxonomy' =>   'product_visibility',
                      'field'    =>   'name',
                      'terms'    =>   array('exclude-from-search', 'exclude-from-catalog'),
                      'operator' =>   'NOT IN'
                   )

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

            $download = new \WP_Query($args);

            /* Start the Loop */
            while ( $download->have_posts() ) : $download->the_post(); ?>
               <!-- Item -->
               <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
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

Plugin::instance()->widgets_manager->register_widget_type( new studiare_Widget_download );
