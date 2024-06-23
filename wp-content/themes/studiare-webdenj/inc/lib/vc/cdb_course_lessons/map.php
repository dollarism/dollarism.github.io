<?php

vc_map( array(
	'base'             => 'cdb_course_lessons',
	'name'             => esc_html__( 'Course Lessons', 'studiare' ),
	'as_parent'        => array('only' => 'cdb_course_lesson'),
	'description'      => esc_html__( 'Show curriculum for course', 'studiare' ),
	'category'         => esc_html__( 'Studiare', 'studiare' ),
	'params'           => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Section Title', 'studiare' ),
			'param_name' => 'title',
			'holder'	=> 'div'
		),
		array(
			'type'	 => 'checkbox',
			'heading' => esc_html__('قابلیت باز و بسته شدن بخش', 'studiare'),
			'param_name' => 'arrow_sections',
		),
		array(
			'type'          => 'textfield',
			'heading'       => esc_html__( 'Extra class name', 'studiare' ),
			'param_name'    => 'el_class',
			'description'   => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'studiare' )
		),
		array(
			'type'       => 'css_editor',
			'heading'    => esc_html__( 'Css', 'studiare' ),
			'param_name' => 'css',
			'group'      => esc_html__( 'Design options', 'studiare' )
		)
	),
	'js_view' => 'VcColumnView'
) );

vc_map( array(
	'base'             => 'cdb_course_lesson',
	'name'             => esc_html__( 'Lesson', 'studiare' ),
	'description'      => esc_html__( 'Course lesson', 'studiare' ),
	'as_child'         => array('only' => 'cdb_course_lessons'),
	'category'         => esc_html__( 'Studiare', 'studiare' ),
	'params'           => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Lesson title', 'studiare' ),
			'param_name' => 'title',
			'holder'	=> 'div'
		),
		array(
			'description' => esc_html__('If this is video you can put video length or any other detail as short description', 'studiare'),
			'type' => 'textfield',
			'heading' => esc_html__( 'Lesson subtitle', 'studiare' ),
			'param_name' => 'subtitle',
			'holder'	=> 'div',
		),
		array(
			'type'	 => 'checkbox',
			'heading' => esc_html__('Private', 'studiare'),
			'param_name' => 'private_lesson',
		),
		array(
			'type' 				=> 'iconpicker',
			'heading' 			=> esc_html__( 'Icon', 'studiare' ),
			'param_name' 		=> 'icon',
			'value'				=> ''
		),
		array(
			'type'	=> 'textarea_html',
			'param_name' => 'content',
			'holder'	=> 'div',
			'group'	=> esc_html__('Tab Text', 'studiare' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Lesson badge', 'studiare' ),
			'param_name' => 'badge',
			'value' => array(
				esc_html__( 'Choose Badge', 'studiare' )	=> 'no_badge',
				esc_html__( 'Video', 'studiare' )	=> 'video',
				esc_html__( 'Exam', 'studiare' )		=> 'exam',
				esc_html__( 'Quiz', 'studiare' )		=> 'quiz',
				esc_html__( 'Lecture', 'studiare' )   => 'lecture',
				esc_html__( 'Free', 'studiare' )		=> 'free',
				esc_html__( 'Practice', 'studiare' )  => 'practice',
				esc_html__( 'فایل های ضمیمه', 'studiare' )  => 'attachments',
				esc_html__( 'فایل صوتی', 'studiare' )  => 'sound',
			),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Preview video', 'studiare' ),
			'description' => esc_html__('This video will be opened in popup by clicking "Preview" button (just insert link to the video), it may be youtube or vimeo link.', 'studiare'),
			'param_name' => 'preview_video',
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'لینک فایل دانلودی', 'studiare' ),
			'description' => esc_html__('اگر لینک دانلود فایل درس را به صورت خصوصی میخواستید نمایش دهید می توانید از این گزینه استفاده کنید.', 'studiare'),
			'param_name' => 'download_lesson',
		),
	)
) );

if ( class_exists('WPBakeryShortCodesContainer') ) {
	class WPBakeryShortCode_Cdb_Course_Lessons extends WPBakeryShortCodesContainer {}
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Cdb_Course_Lesson extends WPBakeryShortCode {}
}