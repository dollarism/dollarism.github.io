<?php

vc_map( array(
	'base'             => 'cdb_std_counter',
	'name'             => esc_html__( 'آمار و ارقام', 'studiare' ),
	'description'      => esc_html__( 'نمایش خالاقانه آمار و ارقام سایت', 'studiare' ),
	'category'         => esc_html__( 'Studiare', 'studiare' ),
	'params'           => array(

		array(
				'type'			=> 'textfield',
				'heading'		=> __( 'مجموع ساعت آموزش', 'studiare' ),
				'param_name' 	=> 'course_hours',
				'description'	=> __( 'مجموع ساعات آموزشی را وارد کنید.', 'studiare' ),
			),


	)
) );

if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Cdb_Std_Counter extends WPBakeryShortCode {}
}
