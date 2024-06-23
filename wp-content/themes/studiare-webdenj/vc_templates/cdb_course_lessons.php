<?php

// Atts
if ( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );

// Element Class
$class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );

$css_class = "course-section";
$arrow_section = "<i class='fal fa-chevron-down'></i>";


?>
<div class="<?php echo esc_attr( $css_class ) . vc_shortcode_custom_css_class($css, ' '); ?>">
	
	<?php if(!empty($title)): ?>
		<h5 class="course-section-title <?php if (  !empty( $arrow_sections ) ) : echo('cursor-pointer'); ?><?php endif; ?>"><?php echo esc_attr($title); ?><?php if (  !empty( $arrow_sections ) ) : echo($arrow_section); ?><?php endif; ?></h5>
	<?php endif; ?>
    <div class="panel-group <?php if (  !empty( $arrow_sections ) ) : echo('deactive'); ?><?php endif; ?>">
	    <?php echo wpb_js_remove_wpautop($content); ?>
    </div>
</div>
