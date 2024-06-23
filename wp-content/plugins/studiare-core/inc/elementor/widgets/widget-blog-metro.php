<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// blog
class studiare_Widget_Blog_Metro extends Widget_Base {

   public function get_name() {
      return 'blog-metro';
   }

   public function get_title() {
      return esc_html__( 'Blog Metro', 'studiare-core' );
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
            'posts_per_page' => 1,
            'ignore_sticky_posts' => true,
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





       $args2 = array(
             'post_type' => 'post',
             'posts_per_page' => 2,
             'offset' => 1,
             'ignore_sticky_posts' => true,
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
    				$args2['tax_query'][] = array(
    					'taxonomy'  => 'category',
    					'terms'     => $cat_include,
    					'operator'  => 'IN',
    				);

    			}

    		 }

      ?>






      <div class="blog-posts">
	<div class="row">
		<div class="col-lg-8 col-md-9 col-sm-12 col-xs-7 first-post">
			<?php $loop_metro = new \WP_Query($args);
        ?>
					<?php while ($loop_metro -> have_posts()) : $loop_metro -> the_post(); ?>
						<a href="<?php the_permalink() ?>">
							<figure><?php the_post_thumbnail( 'metro_first' ); ?></figure>
							<div class="blog-posts-inner">
								<div class="category">
									<ul>
										<li> <?php print get_the_category(get_the_ID())[0]->name; ?></li>
									</ul>
								</div>
								<h2><?php the_title(); ?></h2>
							</div>
						</a>
						<?php
					endwhile;
					wp_reset_postdata();
					?>
		</div>

		<div class="col-lg-4 col-md-3 col-sm-12 col-xs-5 another-posts">
			<?php $loop_metro_2 = new \WP_Query($args2);
      ?>
			<?php while ($loop_metro_2 -> have_posts()) : $loop_metro_2 -> the_post(); ?>
				<a href="<?php the_permalink() ?>">
					<figure><?php the_post_thumbnail( 'metro_others' ); ?></figure>
					<div class="blog-posts-inner">
						<div class="category">
							<ul>
								<li> <?php print get_the_category(get_the_ID())[0]->name; ?></li>
							</ul>
						</div>
						<h2><?php the_title(); ?></h2>
					</div>
				</a>
				<?php
			endwhile;
			wp_reset_postdata();
			?>
		</div>
	</div>
</div>
      <?php
   }

}
Plugin::instance()->widgets_manager->register_widget_type( new studiare_Widget_Blog_Metro );
