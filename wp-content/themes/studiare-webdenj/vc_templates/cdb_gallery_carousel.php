<?php

// Atts
if ( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );

// Element Class
$class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );

$css_class = "gallery-wrapper";

$images = explode(',', $images);

if ( 'links' === $on_click ) {
	$custom_links = vc_value_from_safe( $custom_links );
	$custom_links = explode( ',', $custom_links );
}

$carousel_data = array();
$carousel_data['data-pagination'] = $show_pagination_control;
$carousel_data['data-navigation'] = $show_prev_next_buttons;
$carousel_data['data-loop'] = $wrap;
if ( $slides_per_view !== '' ) {
	$carousel_data['data-slider-items'] = $slides_per_view;
}

?>
<div class="<?php echo esc_attr( $css_class ) . vc_shortcode_custom_css_class($css, ' '); ?>">
	<div class="gallery-carousel-inner owl-carousel" <?php echo studiare_get_inline_attrs( $carousel_data ); ?>>

        <?php if ( $images ) : ?>
            <?php $i = 0; foreach ($images as $img_id) : ?>
		        <?php
                    $i++;
                    $attachment = get_post( $img_id );
                    $title = trim( strip_tags( $attachment->post_title ) );
                    $img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => $img_size) );
                    $link = $img['p_img_large']['0'];
                    if( 'links' === $on_click ) {
                        $link = (isset( $custom_links[$i-1] ) ? $custom_links[$i-1] : '' );
                    }
		        ?>
                <div class="gallery-entry-unit">
	                <?php if ( $on_click != 'none' ): ?>
                    <a href="<?php echo esc_url( $link ); ?>" <?php if ( $target_blank ) { ?>target="_blank"<?php } ?> <?php if ( 'lightbox' === $on_click ) { ?>class="gallery-lightbox-link"<?php } ?>>
                    <?php endif; ?>
                        <?php echo codebean_kses_img( $img['thumbnail'] );?>
                    <?php if ( $on_click != 'none' ): ?>
                    </a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

	</div>
</div>
