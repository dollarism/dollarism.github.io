<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// search
class studiare_Widget_search extends Widget_Base {

   public function get_name() {
      return 'search';
   }

   public function get_title() {
      return esc_html__( 'Search', 'studiare-core' );
   }

   public function get_icon() {
        return 'eicon-search-bold';
   }

   public function get_categories() {
      return [ 'studiare-elements' ];
   }

   protected function register_controls() {

      $this->start_controls_section(
         'search_section',
         [
            'label' => esc_html__( 'Search', 'studiare-core' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'search_input',
         [
            'label' => __( 'متن نگه دارنده ی جستجو', 'herozh-core' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __( 'چی میخوای یاد بگیری..؟'),

         ]
      );

      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {

    // get our input from the widget settings.
    $settings = $this->get_settings_for_display(); ?>

	  <form class="ajax-search-form" id="head-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <input type="hidden" name="post_type" value="product" />
                        <div class="search-form-ajax">
                            <?php
                            $categories = get_terms("product_cat");
                             { ?>

                            <?php } ?>
                            <input autocomplete="off" data-swplive="true" name="s" type="text" class="form-control search-input" placeholder="<?php echo esc_html($settings['search_input']); ?>" required>
                            <div class="input-group-append">
                                <button class="btn btn-search" type="submit" aria-label="<?php echo __("جستجو", 'dina-kala'); ?>">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                        </form>

      <?php
   }
}

Plugin::instance()->widgets_manager->register_widget_type( new studiare_Widget_search );
