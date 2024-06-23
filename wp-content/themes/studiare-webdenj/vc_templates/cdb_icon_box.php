<?php

// Atts
if ( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );

// Element Class
$class_to_filter = "icon-box {$icon_size} icon-box-{$icon_position}";
$class_to_filter .= $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

// Link
$link = ( '||' === $link ) ? '' : $link;
$link = vc_build_link( $link );
$a_href = $link['url'];
$a_target = $link['target'];

if ( $icon_type != 'normal' ) {
	$css_class .= " style-{$icon_type}";
}

// Text Color Style
$text_styles = '';
if ( $text_color !== '' ) {
	$text_styles = 'color: '. $text_color .'';
}

// Title Styles
$title_styles = array();
if ( $title_color !== '' ) {
	$title_styles[] = 'color: '. $title_color  .'';
}

if ( $title_text_transform !== '' ) {
	$title_styles[] = 'text-transform: '. $title_text_transform .'';
}

if ( $title_text_font_weight !== '' ) {
	$title_styles[] = 'font-weight: '. $title_text_font_weight .'';
}

// Icon Styles
$icon_styles = array();
if ( $custom_icon_size !== '' ) {
	$icon_styles[] = 'font-size: '. $custom_icon_size .'px';
}

if ( $icon_color !== '' ) {
	$icon_styles[] = 'color: '. $icon_color .'';
}

// Shape Icon Styles
$icon_shape_styles = array();
if ( $icon_style && $icon_style !== 'normal' ) {

	if ( !empty($icon_border_color) && (isset($icon_border_width) && $icon_border_width !== '') ) {
		$icon_shape_styles[] = 'border-color: '. $icon_border_color .'';
		$icon_shape_styles[] = 'border-width: '. $icon_border_width .'px';
		$icon_shape_styles[] = 'border-style: solid';
	}

	if ( !empty($shape_size) ) {
		$icon_shape_styles[] = 'width: '. $shape_size .'px';
		$icon_shape_styles[] = 'height: '. $shape_size .'px';
	}

	if ( !empty($icon_background_color) ) {
		$icon_shape_styles[] = 'background-color: '. $icon_background_color .'';
	}

	if ( $icon_type == 'square' ) {
		if ( isset($border_radius) && $border_radius !== '') {
			$icon_shape_styles[] = 'border-radius: '. $border_radius .'px';
		}
	}
}

if (isset($icon_margin) && $icon_margin !== '') {
	$icon_shape_styles[] = 'margin: ' . $icon_margin;
}

// Get Content Styles
$icon_content_styles = array();
if ( $icon_position == 'left' && !empty($text_left_padding) ) {
	$icon_content_styles[] = 'padding-left: '. $text_left_padding .'px';
}

if ( $icon_position == 'right' && !empty($text_right_padding) ) {
	$icon_content_styles[] = 'padding-right: '. $text_right_padding .'px';
}

?>

<?php if ( !empty( $a_href ) ) : ?>
<a href="<?php echo esc_url( $a_href ); ?>" target="<?php echo esc_attr( $a_target ); ?>">
	<?php endif; ?>
	<div class="<?php echo esc_attr( $css_class ) . vc_shortcode_custom_css_class($css, ' '); ?>">
		<div class="icon-wrap">
			<?php if ( !empty($custom_icon) ) : ?>
				<div class="custom-icon-image">
					<?php echo wp_get_attachment_image($custom_icon, 'full'); ?>
				</div>
			<?php else : ?>
				<div class="icon-element">
					<div class="icon-element-inner" <?php studiare_inline_style($icon_shape_styles); ?>>
						<i class="icon-item <?php echo esc_attr( $icon ); ?>" <?php studiare_inline_style($icon_styles); ?>></i>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<div class="feature-content" <?php studiare_inline_style($icon_content_styles); ?>>
			<?php if ($title != ''){ ?>
			<div class="feature-content-title">
				<<?php echo esc_attr($title_tag);?> <?php studiare_inline_style($title_styles); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
		</div>
		<?php } ?>
		<?php if( !empty( $content )) { ?>
			<div class="feature-content-text">
				<p <?php studiare_inline_style($text_styles); ?>><?php echo do_shortcode( $content ); ?></p>
			</div>
		<?php } ?>
	</div>
	</div>
	<?php if ( !empty( $a_href ) ) : ?>
</a>
<?php endif; ?>
