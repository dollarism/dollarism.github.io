<?php

// Atts
if ( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );

// Element Class
$class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );

$css_class = 'section-heading';

$title_color_style = array();
$subtitle_color_style = array();

if ( $title_color !== '' ) {
	$title_color_style[] = 'color:' . $title_color;
}

if ( $subtitle_color !== '' ) {
	$subtitle_color_style[] = 'color:' . $subtitle_color;
}

// Link
$button_link = vc_build_link($button_link);

if ( !empty( $title ) ) : ?>
<div class="<?php echo esc_attr( $css_class ) . vc_shortcode_custom_css_class($css, ' '); ?>">
	<?php if ( !empty( $title ) ) : ?>
		<h2 class="section-title" <?php studiare_inline_style( $title_color_style ); ?>><?php echo esc_html( $title ); ?></h2>
	<?php endif; ?>
	<?php if ( !empty( $subtitle ) ) : ?>
        <span class="section-subtitle" <?php studiare_inline_style( $subtitle_color_style ); ?>><?php echo esc_html( $subtitle ); ?></span>
	<?php endif; ?>

</div>

<?php if ( $show_button !== 'no' ) { ?>
			<div class="section-button">
					<a href="<?php echo esc_url( $button_link['url'] ); ?>" class="btn btn-border" target="<?php echo esc_attr( $button_link['target'] ); ?>" title="<?php echo esc_attr( $button_link['title'] ); ?>">
							<span><?php echo esc_html( $button_text ); ?></span>
					</a>
			</div>
	<?php } ?>
	<div class="clearfix"> </div>
<?php endif; ?>
