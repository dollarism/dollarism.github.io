<?php

// Atts
if ( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );

// Element Class
$class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );

$css_class = "pricing-table";

$img_id = preg_replace( '/[^\d]/', '', $image );

$img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => $img_size, 'class' => 'pricing-table-icon' ) );

// Link
$button_link = vc_build_link($button_link);

?>
<div class="<?php echo esc_attr( $css_class ) . vc_shortcode_custom_css_class($css, ' '); ?>">
    <div class="pricing-table-inner">

        <div class="pricing-header">
					<?php if ( $img['thumbnail'] != '') { ?>
		                <div class="pricing-table-image">
							<?php echo wp_kses_post( $img['thumbnail'] ); ?>
		                </div>
					<?php } ?>
            <h4 class="pricing-title"><?php echo esc_html( $title ); ?></h4>
	        <?php if ( !empty( $subtitle ) ) { ?>
                <p class="pricing-subtitle"><?php echo esc_html( $subtitle ); ?></p>
	        <?php } ?>

	        <?php if ( !empty( $price ) ) { ?>
                <div class="pricing-price">
                    <span class="price-number"><?php echo esc_html( $price ); ?></span>
					<?php if ( !empty( $currency ) ) { ?>
                        <span class="currency"><?php echo esc_html( $currency ); ?></span>
	                <?php } ?>
                </div>
            <?php } ?>
        </div>

        <div class="pricing-content">
	        <?php echo do_shortcode(preg_replace('#^<\/p>|<p>$#', '', $content)); ?>
        </div>

	    <?php if ( $show_button !== 'no' ) { ?>
            <div class="pricing-button">
                <a href="<?php echo esc_url( $button_link['url'] ); ?>" class="btn btn-border" target="<?php echo esc_attr( $button_link['target'] ); ?>" title="<?php echo esc_attr( $button_link['title'] ); ?>">
                    <span><?php echo esc_html( $button_text ); ?></span>
                </a>
            </div>
        <?php } ?>
    </div>
</div>
