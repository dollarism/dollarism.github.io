<?php

global $client_logo_index, $hover_style, $img_size;

// Atts
if ( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );

// Element Class
$class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );

// If no image return empty
if ( ! $image ) {
	return;
}

$image = wpb_getImageBySize( array( 'attach_id' => $image, 'thumb_size' => $img_size, 'class' => 'partner-logo-image' ) );

$link = vc_build_link( $link );

// Item Class
$item_class = array( 'partner-logo-item' );

if ( $link['url'] ) {
	$item_class[] = 'has-link';
}

if ( $hover_style == 'color' ) {
    $item_class[] = 'img-hover';
}

?>
<div class="<?php echo implode( ' ', $item_class ); ?>">

	<div class="partner-logo-inner">
		<?php if ( $link['url'] ) : ?>
            <a href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target']); ?>"><?php echo codebean_kses_img($image['thumbnail']); ?></a>
		<?php else: ?>
			<?php echo codebean_kses_img($image['thumbnail']); ?>
        <?php endif; ?>

        <?php if ( $hover_style == 'bg-hover') : ?>
            <div class="hover-mask">
                <div class="hover-mask-info">
                    <h4>
	                    <?php if ( $link['url'] ) : ?>
                            <a href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>"><?php echo esc_html( $title ); ?></a>
	                    <?php else: ?>
		                    <?php echo esc_attr( $title ); ?>
	                    <?php endif; ?>
                    </h4>
	                <?php if ( $description ) : ?>
                        <div class="desc">
			                <?php echo codebean_esc_script( wpautop( $description ) ); ?>
                        </div>
	                <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
	</div>

</div>

<?php $client_logo_index++;