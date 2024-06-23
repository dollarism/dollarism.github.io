<?php

vc_map( array(
	'base'             => 'cdb_clients',
	'name'             => esc_html__( 'Clients', 'studiare' ),
	'description'      => esc_html__( 'Partners/clients logos', 'studiare' ),
	'as_parent'        => array('only' => 'cdb_client_item'),
	'category'         => esc_html__( 'Studiare', 'studiare' ),
	'params'           => array(
		array(
			'type'           => 'dropdown',
			'heading'        => esc_html__( 'Clients per Row', 'studiare' ),
			'param_name'     => 'columns_count',
			'std'            => '4',
			'value'          => array(
				esc_html__( '2 Logos per Row', 'studiare' )    => 'two',
				esc_html__( '3 Logos per Row', 'studiare' )    => 'three',
				esc_html__( '4 Logos per Row', 'studiare' )    => 'four',
				esc_html__( '5 Logos per Row', 'studiare' )    => 'five',
				esc_html__( '6 Logos per Row', 'studiare' )    => 'six',
			),
			'description' => esc_html__( 'Set number of columns for clients/partners logos.', 'studiare' )
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Spacing', 'studiare' ),
			'param_name' => 'column_spacing',
			'std'		 => 'no',
			'value'      => array(
				esc_html__( 'No spacing', 'studiare' )             => 'no',
				esc_html__( 'Apply default spacing', 'studiare' )  => 'yes',
			),
			'description' => esc_html__( 'Set spacing for logo columns.', 'studiare' )
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Image Borders','studiare' ),
			'param_name' => 'image_borders',
			'std'		 => 'yes',
			'value'      => array(
				esc_html__( 'No', 'studiare' )     => 'no',
				esc_html__( 'Yes', 'studiare' )    => 'yes',
			),
			'description' => esc_html__('Add borders to logo items.', 'studiare' ),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Hover Style', 'studiare' ),
			'param_name' => 'hover_style',
			'std'		 => 'bg-hover',
			'value'      => array(
				esc_html__( 'None', 'studiare' )                  => 'none',
				esc_html__( 'Background hover', 'studiare' )      => 'bg-hover',
				esc_html__( 'Image Color', 'studiare' )             => 'color',
			),
			'description' => esc_html__( 'Select hover effect style to apply for client logos.', 'studiare' )
		),
		array(
			'type'           => 'textfield',
			'heading'        => esc_html__( 'Image size', 'studiare' ),
			'param_name'     => 'img_size',
			'description'    => esc_html__( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'studiare' )
		),
		array(
			'type'          => 'textfield',
			'heading'       => esc_html__( 'Extra class name', 'studiare' ),
			'param_name'    => 'el_class',
			'description'   => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'studiare' )
		),
		array(
			'type'       => 'css_editor',
			'heading'    => 'Css',
			'param_name' => 'css',
			'group'      => esc_html__( 'Design options', 'studiare' ),
		)
	),
	'js_view'          => 'VcColumnView'
) );

vc_map( array(
	'base'             => 'cdb_client_item',
	'name'             => esc_html__( 'Client Logo', 'studiare' ),
	'description'      => esc_html__( 'Add client infos', 'studiare' ),
	'as_child'         => array('only' => 'cdb_clients'),
	'category'         => esc_html__( 'Studiare', 'studiare' ),
	'params'           => array(
		array(
			'type'           => 'attach_image',
			'heading'        => esc_html__( 'Image', 'studiare' ),
			'param_name'     => 'image',
			'value'          => '',
			'description'    => esc_html__( 'Add logo image here.', 'studiare' ),
		),
		array(
			'type'           => 'textfield',
			'heading'        => esc_html__( 'Title', 'studiare' ),
			'param_name'     => 'title',
			'admin_label'	 => true,
			'description'    => esc_html__( 'Title of the client/partner (shown on hover).', 'studiare' ),
		),
		array(
			'type'           => 'textarea',
			'heading'        => esc_html__( 'Description', 'studiare' ),
			'param_name'     => 'description',
			'description'    => esc_html__( 'Small description about the client/partner, this text area supports HTML too (shown on hover).', 'studiare' ),
		),
		array(
			'type'           => 'vc_link',
			'heading'        => esc_html__( 'Link', 'studiare' ),
			'param_name'     => 'link',
			'description'    => esc_html__( 'Make client logo clickable (Optional).', 'studiare' ),
		),
		array(
			"type"           => "textfield",
			"heading"        => esc_html__( "Extra class name", 'studiare' ),
			"param_name"     => "el_class",
			"description"    => esc_html__( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'studiare' ),
		)
	)
) );

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Cdb_Clients extends WPBakeryShortCodesContainer {}
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Cdb_Client_Item extends WPBakeryShortCode {}
}