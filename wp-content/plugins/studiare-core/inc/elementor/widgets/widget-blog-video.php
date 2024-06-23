<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// blog
class studiare_Widget_Blog_Video extends Widget_Base {

   public function get_name() {
      return 'blog-video';
   }

   public function get_title() {
      return esc_html__( 'Latest Blog Videos', 'studiare-core' );
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

      //Inline Editing
      $this->add_inline_editing_attributes( 'ppp', 'basic' );

      $cat_include = $settings['category'];

      $args = array(
            'post_type' => 'post',
            'posts_per_page' => $settings['pppp']['size'],
            'ignore_sticky_posts' => true,
            'order' => $settings['order'],
            'tax_query' => array(
                'relation' => 'AND',

                array(
                  'taxonomy' => 'post_format',
                  'field' => 'slug',
                  'terms' => 'post-format-video'
                )

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

      ?>



        <?php
        $query = new \WP_Query($args);

        ?>


        <div class="ts-grid-box">

                    <div class="featured-col">
                        <div class="tab-content featured-post" id="nav-tabContent">
                            <?php $i = 0; while ($query->have_posts()) : $query->the_post(); $i++; ?>
                                <div class="tab-pane ts-overlay-style fade <?php echo esc_attr(($i == 1) ? 'show active' : ''); ?>" id="nav-post-tab-<?php echo esc_attr($this->get_id()); ?>-<?php echo esc_attr($i); ?>" role="tabpanel" aria-labelledby="nav-<?php echo esc_attr($this->get_id()); ?>-<?php echo esc_attr($i); ?>-tab">
                                  <?php

                                  $prefix = '_studiare_';
                                  $video_post_id = get_post_meta(get_the_ID(), $prefix . 'video_post_id', true);
                                  $poster_video_post_id = get_post_meta(get_the_ID(), $prefix . 'poster_video_post_id', true);

					$attr =  array(
						'mp4'      => $video_post_id,
						'poster'   => $poster_video_post_id,
						'preload'  => 'auto',
						'width'    => '800',
						'height'   => '400'
					);
					echo wp_video_shortcode(  $attr );
				?>
                                </div>
                            <?php endwhile;
                            wp_reset_query(); ?>
                        </div>
                    </div>
                    <div class="playlist-col">
						             <div class="nav post-list-box" id="nav-tab" role="tablist">
                            <?php $i = 0; while ($query->have_posts()) : $query->the_post(); $i++; ?>
                                <a class="nav-item nav-link <?php echo esc_attr(($i == 1) ? 'active' : ''); ?>" id="nav-<?php echo esc_attr($this->get_id()); ?>-<?php echo esc_attr($i); ?>-tab" data-toggle="tab" href="#nav-post-tab-<?php echo esc_attr($this->get_id()); ?>-<?php echo esc_attr($i); ?>" role="tab" aria-controls="nav-post-tab-<?php echo esc_attr($this->get_id()); ?>-<?php echo esc_attr($i); ?>"
                                    aria-selected="true">
                                    <div class="post-content media">
                                      <?php the_post_thumbnail( 'metro_others' ); ?>
                                        <div class="media-body align-self-center">
                                            <h4 class="post-title"><?php the_title(); ?></h4>
                                            <span class="post-date-info">
                                                <i class="fa fa-clock-o"></i>
                                                <?php echo get_the_date(); ?>
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            <?php endwhile;
                            wp_reset_query(); ?>

                        </div>
                    </div>

            </div>

      <?php
   }

}
Plugin::instance()->widgets_manager->register_widget_type( new studiare_Widget_Blog_Video );
