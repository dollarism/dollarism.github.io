<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Title
class studiare_Widget_Steps extends Widget_Base {

   public function get_name() {
      return 'steps';
   }

   public function get_title() {
      return esc_html__( 'مراحل عمودی', 'studiare-core' );
   }

   public function get_icon() {
        return 'eicon-testimonial';
   }

   public function get_categories() {
      return [ 'studiare-elements' ];
   }

   protected function register_controls() {


     $this->start_controls_section(
        'step_section',
        [
           'label' => esc_html__( 'تنظیمات عمومی مراحل', 'studiare-core' ),
           'type' => Controls_Manager::SECTION,
        ]
     );

       $this->add_control(
          'image',
          [
             'label' => __( 'لوگوی اصلی', 'studiare-core' ),
             'type' => \Elementor\Controls_Manager::MEDIA,
             'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
             ],
          ]
       );

       $this->add_control(
			'steps_line_color',
			[
				'label'     => esc_html__( 'رنگ خط چین ها', 'studiare-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .steps-color ' => 'stroke: {{VALUE}}',
               '{{WRAPPER}} .top-part .more ' => 'border-color: {{VALUE}}',
               '{{WRAPPER}} .top-part .more i, span.step-subtitle ' => 'color: {{VALUE}}',
				],
			]
		);



     $this->end_controls_section();

      $this->start_controls_section(
         'steps_section',
         [
            'label' => esc_html__( 'مراحل', 'studiare-core' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $repeater = new \Elementor\Repeater();

      $repeater->add_control(
         'image_step',
         [
            'label' => __( 'تصویر مرحله', 'studiare-core' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
         ]
      );

      $repeater->add_control(
           'titlestep',
           [
              'label' => __( 'عنوان مرحله', 'studiare-core' ),
              'type' => \Elementor\Controls_Manager::TEXT,

           ]
        );


        $repeater->add_control(
           'titlestep_sub',
           [
              'label' => __( 'زیرنویس عنوان', 'learn-soogh' ),
              'type' => \Elementor\Controls_Manager::TEXT,

           ]
        );


      $repeater->add_control(
         'btn_url_step',
         [
            'label' => __( 'لینک دکمه مرحله', 'studiare-core' ),
            'type' => \Elementor\Controls_Manager::URL
         ]
      );
      $repeater->add_control(
         'btn_txt_step',
         [
            'label' => __( 'متن دکمه مرحله', 'learn-soogh' ),
            'type' => \Elementor\Controls_Manager::TEXT,

         ]
      );


      $repeater->add_control(
         'step_content',
         [
            'label' => __( 'محتوای مرحله', 'studiare-core' ),
            'type' => \Elementor\Controls_Manager::WYSIWYG
         ]
      );


      $this->add_control(
         'steps_list',
         [
            'label' => __( 'لیست مراحل', 'studiare-core' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'title_field' => '{{{titlestep}}}',

         ]
      );

      $this->end_controls_section();





   }

   protected function render( $instance = [] ) {

      // get our input from the widget settings.
      $settings = $this->get_settings_for_display();



      ?>

<ul class="circles-area">
   
<?php foreach (  $settings['steps_list'] as $step_single ): ?>
   <li class="row picsingle">
        <div class="col-md-10">
            <?php echo '<img class="single-circleimg" src="' . $step_single['image_step']['url'] . '">'; ?>
            <svg class="single-circsvg">
                <circle class="steps-color" fill="transparent" cx="160" cy="160" stroke="#EC406A" stroke-width="1" stroke-dasharray="5, 7" r="159">
                    <animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 160 160" to="360 160 160" dur="30s" repeatCount="indefinite"></animateTransform>
                </circle>
            </svg>
            <?php if ( !empty($settings['image']['url']) ) : echo '<img class="logo-small" src="' . $settings['image']['url'] . '">'; ?> <?php endif; ?>
            <svg class="single-linesvg" width="580" height="250">
               <circle class="steps-color" fill="transparent" cx="40" cy="32" r="30" stroke="#EC406A" stroke-width="1" stroke-dashoffset="143" stroke-linejoin="round" stroke-dasharray="190" transform="rotate(180 40 32)"></circle>
               <circle fill="transparent" cx="40" cy="32" stroke="#fff" stroke-width="2" stroke-dasharray="7, 5" r="30" stroke-dashoffset="10">
                  <animateTransform attributeType="xml" attributeName="transform" type="rotate" from="360 40 32" to="0 40 32" dur="12s" repeatCount="indefinite"></animateTransform>
               </circle>
               <circle  class="steps-color" fill="transparent" cx="40" cy="212" r="30" stroke="#EC406A" stroke-width="1" stroke-dashoffset="145" stroke-linejoin="round" stroke-dasharray="190" transform="rotate(90 40 212)"></circle>
               <circle fill="transparent" cx="40" cy="212" stroke="#fff" stroke-width="2" stroke-dasharray="7, 5" r="30" stroke-dashoffset="5">
                  <animateTransform attributeType="xml" attributeName="transform" type="rotate" from="360 40 212" to="0 40 212" dur="12s" repeatCount="indefinite"></animateTransform>
               </circle>
               <line class="svgline2-animate steps-color" x1="10" y1="32" x2="10" y2="214" stroke="#EC406A" stroke-width="1.2" stroke-dasharray="5, 7"></line>
               <line class="svgline-animate steps-color" x1="40" y1="2" x2="580" y2="2" stroke="#EC406A" stroke-width="1.2" stroke-dasharray="5, 7"></line>
            </svg>
        </div>

        <div class="col-md-14">
            <div class="content">
                <div class="top-part">
                    <h3 class="step-title"> <?php echo $step_single['titlestep']; ?></h3>
                    <span class="step-subtitle"> <?php echo $step_single['titlestep_sub']; ?></span>
                    <a href="<?php echo $step_single['btn_url_step']['url']; ?>" class="more" target="blank">
                    <i class="fal fa-angles-left"></i> <span><?php echo $step_single['btn_txt_step']; ?></span>
                    </a>
                </div>
                <?php echo $step_single['step_content']; ?>
            </div>
            <svg class="single-linesvg2" width="580" height="250">
               <circle class="steps-color" fill="transparent" cx="540" cy="32" r="30" stroke="#1ea0a8" stroke-width="1" stroke-dashoffset="143" stroke-linejoin="round" stroke-dasharray="190" transform="rotate(270 540 32)"></circle>
               <circle fill="transparent" cx="540" cy="32" stroke="#fff" stroke-width="2" stroke-dasharray="7, 5" r="30" stroke-dashoffset="10">
                  <animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 540 32" to="360 540 32" dur="12s" repeatCount="indefinite"></animateTransform>
               </circle>
               <circle class="steps-color" fill="transparent" cx="540" cy="212" r="30" stroke="#1ea0a8" stroke-width="1" stroke-dashoffset="145" stroke-linejoin="round" stroke-dasharray="190" transform="rotate(5 540 212)"></circle>
               <circle fill="transparent" cx="540" cy="212" stroke="#fff" stroke-width="2" stroke-dasharray="7, 5" r="30" stroke-dashoffset="5">
                  <animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 540 212" to="360 540 212" dur="12s" repeatCount="indefinite"></animateTransform>
               </circle>
               <line class="svgline2-animate steps-color" x1="0" y1="2" x2="540" y2="2" stroke="#1ea0a8" stroke-width="1.2" stroke-dasharray="5, 7"></line>
               <line class="svgline2-animate steps-color" x1="570" y1="32" x2="570" y2="214" stroke="#1ea0a8" stroke-width="1.2" stroke-dasharray="5, 7"></line>
            </svg>
        </div>
   </li>
<?php endforeach; ?>
</ul>






   <?php }

}

Plugin::instance()->widgets_manager->register_widget_type( new studiare_Widget_Steps );
