<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Title
class studiare_Widget_Testimonials extends Widget_Base {

   public function get_name() {
      return 'testimonials';
   }

   public function get_title() {
      return esc_html__( 'Testimonials', 'studiare-core' );
   }

   public function get_icon() {
        return 'eicon-testimonial';
   }

   public function get_categories() {
      return [ 'studiare-elements' ];
   }

   protected function register_controls() {

      $this->start_controls_section(
         'testimonials_section',
         [
            'label' => esc_html__( 'Testimonials', 'studiare-core' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $repeater = new \Elementor\Repeater();

      $repeater->add_control(
         'image',
         [
            'label' => __( 'Choose Photo', 'studiare-core' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
         ]
      );

      $repeater->add_control(
         'name',
         [
            'label' => __( 'Name', 'studiare-core' ),
            'type' => \Elementor\Controls_Manager::TEXT,

         ]
      );

      $repeater->add_control(
         'designation',
         [
            'label' => __( 'Designation', 'studiare-core' ),
            'type' => \Elementor\Controls_Manager::TEXT
         ]
      );

      $repeater->add_control(
         'testimonial',
         [
            'label' => __( 'Testimonial', 'studiare-core' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA
         ]
      );

	  $repeater->add_control(
          'videoicon',
          [
             'label' => __( 'استفاده از دکمه اجرای ویدئو؟', 'studiare-core' ),
             'type' => \Elementor\Controls_Manager::SWITCHER,
             'label_on' => esc_html_x("بله", 'studiare-core'),
			 'label_off' => esc_html_x("خیر", 'studiare-core'),
             'default' => 'yes'

          ]
       );

      $repeater->add_control(
         'video',
         [
            'label' => __( 'ویدئوی نظر مشتری', 'studiare-core' ),
            'type' => \Elementor\Controls_Manager::URL,
			'condition'   => [
					'videoicon' => 'yes',
				],
         ]
      );


      $this->add_control(
         'testimonial_list',
         [
            'label' => __( 'Testimonial List', 'studiare-core' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'title_field' => '{{{name}}}',

         ]
      );

      $this->end_controls_section();


      $this->start_controls_section(
         'testimonials__carousel_section',
         [
            'label' => esc_html__( 'تنظیمات کروسل', 'studiare-core' ),
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
               '3' => __( '3 ستونه', 'studiare-core' ),
               '2' => __( '2 ستونه', 'studiare-core' ),
               '1' => __( '1 ستونه', 'studiare-core' ),
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


      $this->end_controls_section();


   }

   protected function render( $instance = [] ) {

      // get our input from the widget settings.
      $settings = $this->get_settings_for_display();
      $slider_data = array();
      $slider_data['data-slider-items'] = $settings['columns'];
      $slider_data['data-loop'] = $settings['loop'];
      $slider_data['data-pagination'] = $settings['pagination'];
      $slider_data['data-navigation'] = $settings['navigation'];
      $slider_data['data-autoplay'] = $settings['autoplay'];


      ?>

      <div class="testimonials-wrapper row align-items-center">

            <div class="testimonials-carousel owl-carousel" <?php echo studiare_get_inline_attrs( $slider_data ); ?>>
              <?php foreach (  $settings['testimonial_list'] as $testimonial_single ): ?>
                <div class="testimonial-item">
                <div class="testimonial-inner">
		                 <div class="testimonial-content">
			                    <blockquote>
				                        <?php echo esc_html($testimonial_single['testimonial']); ?>
						              </blockquote>
		                 </div>

                     <div class="testimonial-author">
                        <div class="testimonial-avatar">
					                     <img src="<?php echo esc_url( $testimonial_single['image']['url'] ); ?>" alt="<?php echo esc_html($testimonial_single['name']); ?>">
                        </div>

                       <div class="testimonial-author-main">
                                <h5 class="testimonial-author-name"><?php echo esc_html($testimonial_single['name']); ?></h5>
                               <span class="testimonial-author-role"><?php echo esc_html($testimonial_single['designation']); ?></span>
                       </div>
								<?php if (  'yes' == $testimonial_single['videoicon'] ) : ?>
							         <div class="testimonial-author-video">
								                   <a class="testimonial-video" href="<?php echo esc_url($testimonial_single['video']['url']); ?>"> <i class="fal fa-play-circle"></i>
									                     <p class="sdfds">مشاهده ویدئو</p>
								                    </a>
	                     </div>
						 <?php endif; ?>
                  </div>

	            </div>
              </div>
              <?php endforeach; ?>
            </div>


      </div>

   <?php }

}

Plugin::instance()->widgets_manager->register_widget_type( new studiare_Widget_Testimonials );
