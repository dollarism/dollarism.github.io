<?php

// Atts
if ( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );

// Element Class
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $this->settings['base'], $atts );

$css_class = "teacher-single-details";

$prefix = '_studiare_';

$job_role = get_post_meta( get_the_ID(), $prefix . 'teacher_job_title', true );
$origin_socials = array(
	'facebook',
	'linkedin',
	'twitter',
	'instagram',
	'youtube-play',
);

?>
<div class="<?php echo esc_attr( $css_class ) . vc_shortcode_custom_css_class($css, ' '); ?>">
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="teacher-single-thumbnail">
	        <?php the_post_thumbnail('teacher-single-thumb' ); ?>
            <div class="teacher-single-socials">
                <ul class="studiare-social-links rounded">
	                <?php foreach($origin_socials as $social): ?>
		                <?php $current_social = get_post_custom_values($social, get_the_id()); ?>
	                    <?php if(!empty($current_social[0])): ?>
                            <li>
                                <a class="<?php echo esc_attr($social); ?>" href="<?php echo esc_url(($current_social[0])); ?>" target="_blank" title="<?php echo esc_attr__('View teacher on', 'studiare').' '.$social ?>">
                                    <i class="fa fa-<?php echo esc_attr($social); ?>"></i>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    <?php else: ?>
        <h5 class="teacher-no-thumb"><?php esc_html_e( 'This post is missing thumbnail.', 'studiare' ); ?></h5>
    <?php endif; ?>
</div>
