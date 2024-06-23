<?php
/**
 * Nuovo WordPress Theme
 *
 * Codebean.co
 * www.codebean.co
 */

// Atts
if ( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );

$image_url = wp_get_attachment_image_src($video_banner, 'full');
$aspect_ratio = $video_banner ? (($image_url[2] / $image_url[1]) * 100).'%' : '100%';

?>
<?php if ( !empty( $video_link ) ) : ?>
	<div class="video-banner">
        <div class="video-button">
            <a href="<?php echo esc_url($video_link); ?>" class="cdb-video-icon video-thumbnail"></a>
        </div>
		<div class="video-banner-image" style="<?php echo esc_attr('padding-bottom: '.$aspect_ratio.';'); ?>">
            <?php if ( !empty( $video_banner ) ) : ?>
			    <?php echo wp_get_attachment_image($video_banner, 'full'); ?>
            <?php endif; ?>
		</div>
        <?php if ( !empty( $title ) || !empty( $subtitle) ) : ?>
            <div class="video-banner-info">
                <?php if ( !empty( $title ) ) : ?>
                    <<?php echo esc_attr($title_tag);?> class="title"><?php echo esc_html( $title ); ?></<?php echo esc_attr($title_tag);?>>
                <?php endif; ?>
	            <?php if ( !empty( $subtitle ) ) : ?>
                    <span class="subtitle"><?php echo esc_html( $subtitle ); ?></span>
	            <?php endif; ?>
            </div>
        <?php endif; ?>
	</div>
<?php endif; ?>
