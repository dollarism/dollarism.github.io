<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// tests
class studiare_Widget_Tests extends Widget_Base {

   public function get_name() {
      return 'tests';
   }

   public function get_title() {
      return esc_html__( 'Latest Tests', 'studiare-core' );
   }

   public function get_icon() {
        return 'eicon-posts-carousel';
   }

   public function get_categories() {
      return [ 'studiare-elements' ];
   }
   protected function register_controls() {
      $this->start_controls_section(
         'blog_section',
         [
            'label' => esc_html__( 'Tests', 'studiare-core' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

	  $this->add_control(
         'pppp',
         [
            'label' => __( 'Number of Items', 'studiare-core' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
               'no' => [
                  'min' => 1,
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
               'taxonomy' => 'test_category',
               'hide_empty' => false,
            ]),
         ]
      );

	  $this->add_control(
         'order',
         [
            'label' => __( 'Order', 'studiare-core' ),
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

      $cat_include = $settings['category'];
      $this->add_inline_editing_attributes( 'pppp', 'basic' );

      $args = array(
            'post_type' => 'test',
            'posts_per_page' => $settings['pppp']['size'],
            'ignore_sticky_posts' => true,
            'order' => $settings['order'],
            'tax_query' => array(
                'relation' => 'AND',
            ),

        );


        if (!empty($cat_include)) {
         $category = array();
         foreach ($settings['category'] as $category) {
           $term = term_exists($category, $taxonomy = 'test_category');
           if ($term !== 0 && $term !== null) {
             $cat_include[] = $term['term_id'];
           }
         }

        if (!empty($cat_include)) {
          $args['tax_query'][] = array(
            'taxonomy'  => 'test_category',
            'terms'     => $cat_include,
            'operator'  => 'IN',
          );

        }

       }



      ?>

      <div class="container blog-grid-elementor">
         <div class="row justify-content-center elementor-blog blog-loop-inner blog-loop-view-grid">
            <?php
            $blog = new \WP_Query($args);
            /* Start the Loop */
            while ( $blog->have_posts() ) : $blog->the_post();
            ?>
            <!-- blog -->
            <div class="<?php echo esc_attr($settings['columns']) ?>">
               <?php get_template_part( '/inc/templates/blog/grid-postbit', 'test' ); ?>
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
Plugin::instance()->widgets_manager->register_widget_type( new studiare_Widget_Tests() );
