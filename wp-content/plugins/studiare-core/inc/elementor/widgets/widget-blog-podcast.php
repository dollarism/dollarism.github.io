<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// blog
class studiare_Widget_Blog_Podcast extends Widget_Base {

   public function get_name() {
      return 'blog-podcast';
   }

   public function get_title() {
      return esc_html__( 'Latest Blog Podcasts', 'studiare-core' );
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
                  'terms' => 'post-format-audio'
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



     <div class="blog-slider">
      <div class="blog-slider__wrp swiper-wrapper">

    <?php
    $blog = new \WP_Query($args);

    while ( $blog->have_posts() ) : $blog->the_post();
    ?>
    <div class="blog-slider__item swiper-slide">
      <div class="blog-slider__img">
        <?php the_post_thumbnail('studiare-image-400x400-croped'); ?>
      </div>
      <div class="blog-slider__content">
        <span class="blog-slider__code"><i class="fal fa-clock"></i><?php echo get_the_date(); ?></span>
        <div class="blog-slider__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
        <div class="blog-slider__text">
          <?php
						if( has_excerpt() ){
        			$content = the_excerpt();
    				} else {
      				echo wp_trim_words( get_the_content(), 15, '...' );
    				}
				 ?>
        </div>
        <div class="pelleh-podcast">
			<?php
      $prefix = '_studiare_';
      $audio_post_id = get_post_meta(get_the_ID(), $prefix . 'audio_post_id', true);
					$attr =  array(
						'mp3'      => $audio_post_id,
					);
					echo wp_audio_shortcode(  $attr );
				?>
				</div>


      </div>
    </div>

    <?php
    endwhile;
    wp_reset_postdata();
    ?>

  </div>
  <div class="blog-slider__pagination"></div>

</div>

      <?php
   }

}
Plugin::instance()->widgets_manager->register_widget_type( new studiare_Widget_Blog_Podcast );
