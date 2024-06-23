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

// Element Class
$class = "testimonial-item";
$class .= $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );

$img_id = preg_replace( '/[^\d]/', '', $image );

$img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => $img_size, 'class' => 'testimonial-avatar-image' ) );

?>
<div class="<?php echo esc_attr( $css_class ); ?>">
	<div class="testimonial-inner">
		<div class="testimonial-content">
			<blockquote>
				<?php echo do_shortcode( $content ); ?>
						</blockquote>
		</div>
        <div class="testimonial-author">
			<?php if ( $img['thumbnail'] != '') { ?>
                <div class="testimonial-avatar">
					<?php echo wp_kses_post( $img['thumbnail'] ); ?>
                </div>
			<?php } ?>
            <div class="testimonial-author-main">
				<?php if ( $name !== '' ) { ?>
                    <h5 class="testimonial-author-name"><?php echo esc_html( $name ); ?></h5>
				<?php } ?>

				<?php if ( $user_role !== '' ) { ?>
                    <span class="testimonial-author-role"><?php echo esc_html( $user_role ); ?></span>
				<?php } ?>
            </div>

						<?php if(!empty($preview_video_testimonial)): ?>

							<div class="testimonial-author-video">
								<a class="testimonial-video" href="<?php echo esc_url( $preview_video_testimonial ); ?>">
									<i class="fal fa-play-circle"></i>
									<p class="sdfds">مشاهده ویدئو</p>
								</a>
	            </div>
            <?php endif; ?>


        </div>

	</div>
</div>
