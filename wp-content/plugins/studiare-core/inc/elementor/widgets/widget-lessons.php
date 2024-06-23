<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Title
class studiare_Widget_Lessons extends Widget_Base {

   public function get_name() {
      return 'lessons';
   }

   public function get_title() {
      return esc_html__( 'درس ها', 'studiare-core' );
   }

   public function get_icon() {
        return 'eicon-testimonial';
   }

   public function get_categories() {
      return [ 'studiare-elements' ];
   }

   protected function register_controls() {


     $this->start_controls_section(
        'lesson_section',
        [
           'label' => esc_html__( 'تنظیمات فصل', 'studiare-core' ),
           'type' => Controls_Manager::SECTION,
        ]
     );

       $this->add_control(
          'image',
          [
             'label' => __( 'آیکون فصل(اختیاری)', 'studiare-core' ),
             'type' => \Elementor\Controls_Manager::MEDIA,
             'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
             ],
          ]
       );

       $this->add_control(
          'titlelesson',
          [
             'label' => __( 'عنوان فصل دوره', 'studiare-core' ),
             'type' => \Elementor\Controls_Manager::TEXT,

          ]
       );

       $this->add_control(
          'subtitlelesson',
          [
             'label' => __( 'زیرنویس عنوان فصل دوره', 'studiare-core' ),
             'type' => \Elementor\Controls_Manager::TEXTAREA,

          ]
       );


       $this->add_control(
          'arrowsection',
          [
             'label' => __( 'قابلیت باز و بسته شدن؟', 'studiare-core' ),
             'type' => \Elementor\Controls_Manager::SWITCHER,
             'label_on' => esc_html_x("بله", 'pelleh'),
				     'label_off' => esc_html_x("خیر", 'pelleh'),
             'default' => 'yes'

          ]
       );


     $this->end_controls_section();

      $this->start_controls_section(
         'lessons_section',
         [
            'label' => esc_html__( 'درس ها', 'studiare-core' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $repeater = new \Elementor\Repeater();



        $repeater->add_control(
           'private_lesson',
           [
              'label' => __( 'دوره خصوصی است؟', 'studiare-core' ),
              'type' => \Elementor\Controls_Manager::SELECT,
              'default' => 'no',
              'options' => [
                 'yes' => __( 'بله', 'studiare-core' ),
                 'no' => __( 'خیر', 'studiare-core' ),
              ],
           ]
        );


        $repeater->add_control(
           'subtitlelesson',
           [
              'label' => __( 'عنوان درس', 'studiare-core' ),
              'type' => \Elementor\Controls_Manager::TEXT,

           ]
        );

        $repeater->add_control(
           'subtitlelesson_sub',
           [
              'label' => __( 'زیرنویس عنوان', 'learn-soogh' ),
              'type' => \Elementor\Controls_Manager::TEXT,

           ]
        );

      $repeater->add_control(
         'icon',
         [
            'label' => __( 'آیکون درس', 'studiare-core' ),
            'type' => \Elementor\Controls_Manager::ICON,

         ]
      );

      $repeater->add_control(
         'label_lesson',
         [
            'label' => __( 'لیبل درس', 'studiare-core' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => '',
            'options' => [
               'free' => __( 'رایگان', 'studiare-core' ),
               'video' => __( 'ویدئو', 'studiare-core' ),
               'exam' => __( 'آزمون', 'studiare-core' ),
               'quiz' => __( 'کوئیز', 'studiare-core' ),
               'lecture' => __( 'مقاله', 'studiare-core' ),
               'practice' => __( 'تمرین', 'studiare-core' ),
               'attachments' => __( 'فایل ضمیمه', 'studiare-core' ),
               'sound' => __( 'صوت', 'studiare-core' ),
            ],
         ]
      );


      $repeater->add_control(
         'preview_video',
         [
            'label' => __( 'پیشنمایش ویدئویی', 'studiare-core' ),
            'type' => \Elementor\Controls_Manager::URL
         ]
      );

      $repeater->add_control(
         'download_lesson',
         [
            'label' => __( 'لینک فایل خصوصی درس', 'studiare-core' ),
            'type' => \Elementor\Controls_Manager::URL
         ]
      );

      $repeater->add_control(
         'lesson_content',
         [
            'label' => __( 'محتوای دوره', 'studiare-core' ),
            'type' => \Elementor\Controls_Manager::WYSIWYG
         ]
      );


      $this->add_control(
         'lessons_list',
         [
            'label' => __( 'لیست دروس', 'studiare-core' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'title_field' => '{{{subtitlelesson}}}',

         ]
      );

      $this->end_controls_section();





   }

   protected function render( $instance = [] ) {

      // get our input from the widget settings.
      $settings = $this->get_settings_for_display();
      $bought_course = false;
      $current_user = wp_get_current_user();





      if( !empty($current_user->user_login) and !empty($current_user->ID) ) {
      	if ( wc_customer_bought_product( $current_user->user_login, $current_user->ID, get_the_id() )  ) {
      		$bought_course = true;
      	}
      }
      global $product;
      $arrow_section = "<i class='fal fa-chevron-down'></i>";


      ?>





<div class="elementory-section">
<div class="course-section">

  <div class="course-section-title-elementory <?php if (  'yes' == $settings['arrowsection'] ) : echo('cursor-pointer'); ?><?php endif; ?>" >
    <?php echo '<img src="' . $settings['image']['url'] . '">'; ?>
    <div class="gheadlinel">
      <span><?php echo $settings['titlelesson']; ?></span>
      <p class="subtitle-lesson"><?php echo $settings['subtitlelesson']; ?> </p>
    </div>
    <?php if (  'yes' == $settings['arrowsection'] ) : echo($arrow_section); ?><?php endif; ?>
  </div>

  <div class="panel-group <?php if (  'yes' == $settings['arrowsection'] ) : echo('deactive'); ?><?php endif; ?>">
  <?php foreach (  $settings['lessons_list'] as $lesson_single ): ?>
    <div class="course-panel-heading">
      <div class="panel-heading-left">
        <div class="course-lesson-icon">
          <?php echo '<i class="' . $lesson_single['icon'] . '" aria-hidden="true"></i>'; ?>
        </div>

        <div class="title">
          <h4>  <?php echo $lesson_single['subtitlelesson']; ?>
            <?php
            $badge = $lesson_single['label_lesson'];
             if(!empty($badge) ): ?>
              <span class="badge-item <?php echo $lesson_single['label_lesson']; ?>"><?php echo add_class_value_in_any_lang($badge); ?></span>
            <?php endif; ?>
          </h4>
          <p class="subtitle"> <?php echo $lesson_single['subtitlelesson_sub']; ?></p>
        </div>

      </div>

      <div class="panel-heading-right">

        <?php
        $preview_video = $lesson_single['preview_video']['url'];
        if(!empty($preview_video)): ?>
        <a class="video-lesson-preview preview-button" href="<?php echo esc_url( $preview_video ); ?>"><i class="fa fa-play-circle"></i><?php esc_html_e( 'Preview', 'studiare' ); ?></a>
        <a class="video-lesson-preview preview-button for-mobile" href="<?php echo esc_url( $preview_video ); ?>"><i class="fa fa-play-circle"></i></a>
        <?php endif; ?>




        <?php
              $download_lesson = $lesson_single['download_lesson']['url'];
              $download_lesson = apply_filters('wcpl_download_lesson', $download_lesson);
                if(!empty($download_lesson)):
        ?>
  			<?php if($bought_course): ?>
          <a class="download-button" href="<?php echo esc_url( $download_lesson ); ?>"><i class="fa fa-download"></i></a>
  			<?php elseif ($lesson_single["private_lesson"] !== "yes") : ?>
          <a class="download-button" href="<?php echo esc_url( $download_lesson ); ?>"><i class="fa fa-download"></i></a>
        <?php elseif ($lesson_single["private_lesson"] !== "no") : ?>
  				<div class="download-button gray"><i class="fa fa-download"></i></div>
  			<?php endif; ?>
  			<?php endif; ?>







        <?php if( $lesson_single["private_lesson"] !== "no" ): ?>
              <div class="private-lesson">

			  <?php if($bought_course): ?>
				<?php echo '<i class="fa fa-unlock green-lock"></i>'; ?>
				<?php  else : ?>
					<?php echo '<i class="fa fa-lock"></i>'; ?>
			  <?php endif; ?>


        <span>
		<?php if($bought_course): ?>
          <?php esc_html_e('در دسترس', 'studiare'); ?>
           <?php else : ?>
            <?php  esc_html_e('Private', 'studiare'); ?>
		  <?php endif; ?>
        </span>

		</div>
        <?php endif; ?>

      </div>

  </div>

  <div class="panel-content">
    <div class="panel-content-inner">

      <?php
      if( $lesson_single["private_lesson"] !== "no" ) {
      if($bought_course) {
       echo $lesson_single['lesson_content'];
     } else {
       esc_html_e( 'This lesson is private, for full access to all lessons you need to buy this course.', 'studiare' );
     }
   } elseif ( $lesson_single["private_lesson"] !== "yes" ) {
       echo $lesson_single['lesson_content'];
   }
       ?>

    </div>
  </div>



<?php endforeach; ?>
</div>
</div>
</div>

   <?php }

}

Plugin::instance()->widgets_manager->register_widget_type( new studiare_Widget_Lessons );
