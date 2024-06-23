<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// blog
class studiare_Widget_Blog_Carousel extends Widget_Base {

   public function get_name() {
      return 'blog-carousel';
   }

   public function get_title() {
      return esc_html__( 'Carousel Latest Blog', 'studiare-core' );
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
            'label' => esc_html__( 'Blog', 'studiare-core' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'style-grid',
         [
            'label' => __( 'استایل نوشته ها', 'studiare-core' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'grid',
            'options' => [
               'grid'  => __( 'استایل 1', 'studiare-core' ),
               'grid-2' => __( 'استایل 2', 'studiare-core' ),
            ],
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
               'taxonomy' => 'category',
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
	  $carousel_data = array();
	  $carousel_data['data-slider-items'] = $settings['columns'];
	  $carousel_data['data-pagination'] = $settings['pagination'];
	  $carousel_data['data-navigation'] = $settings['navigation'];
	  $carousel_data['data-loop'] = $settings['loop'];
	  $carousel_data['data-autoplay'] = $settings['autoplay'];

	  $cat_include = $settings['category'];

    $args = array(
          'post_type' => 'post',
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
 				 $term = term_exists($category, $taxonomy = 'category');
 				 if ($term !== 0 && $term !== null) {
 					 $cat_include[] = $term['term_id'];
 				 }
 			 }

 			if (!empty($cat_include)) {
 				$args['tax_query'][] = array(
 					'taxonomy'  => 'category',
 					'terms'     => $cat_include,
 					'operator'  => 'IN',
 				);

 			}

 		 }

      //Inline Editing
      $this->add_inline_editing_attributes( 'ppp', 'basic' );
      ?>


         <div class="blog-posts-holder">
			<div class="owl-carousel" <?php echo studiare_get_inline_attrs( $carousel_data ); ?>>
            <?php
            $blog = new \WP_Query($args);

            while ( $blog->have_posts() ) : $blog->the_post();
            ?>
			<div class="blog-loop-inner <?php echo esc_attr($settings['style-grid']) ?>">
        <?php if ( $settings['style-grid'] !== 'grid-2' ) : ?>
         <?php get_template_part( '/inc/templates/blog/grid-postbit', get_post_format() ); ?>
       <?php elseif ($settings['style-grid'] !== 'grid') : ?>
         <?php get_template_part( '/inc/templates/blog/grid-postbit-2' ); ?>
       <?php endif; ?>
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
Plugin::instance()->widgets_manager->register_widget_type( new studiare_Widget_Blog_Carousel );
