<?php

vc_map( array(
	'name'        => esc_html__( 'Teacher Details', 'studiare' ),
	'base'        => 'cdb_teacher_detail',
	'description' => esc_html__('Only on expert page', 'studiare'),
	'category'    => esc_html__( 'Studiare', 'studiare' ),
	'params'      => array(
		array(
			'type'       => 'css_editor',
			'heading'    => esc_html__( 'Css', 'studiare' ),
			'param_name' => 'css',
			'group'      => esc_html__( 'Design options', 'studiare' )
		)
	)
) );

if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Cdb_Teacher_Detail extends WPBakeryShortCode {}
}