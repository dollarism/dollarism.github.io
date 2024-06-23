<?php

// Atts
if ( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}



extract($atts);
// print_r($atts);
// Get current user and check if he bought current course
$bought_course = false;
$current_user = wp_get_current_user();
if( !empty($current_user->user_login) and !empty($current_user->ID) ) {
	if ( wc_customer_bought_product( $current_user->user_login, $current_user->ID, get_the_id() ) ) {
		$bought_course = true;
	}
}
global $product;
$current_user = wp_get_current_user();
?>
<div class="course-panel-heading">
    <div class="panel-heading-left">
	    <?php if(!empty($icon)): ?>
            <div class="course-lesson-icon">
                <i class="<?php echo esc_attr($icon); ?>"></i>
            </div>
	    <?php endif; ?>
	    <?php if(!empty($title)): ?>
            <div class="title">
                <h4><?php echo esc_attr($title); ?>
                    <?php if(!empty($badge) and $badge != 'no_badge'): ?>
                        <span class="badge-item <?php echo esc_attr($badge); ?>"><?php  echo add_class_value_in_any_lang($badge); ?></span>
	                <?php endif; ?>
                </h4>
                <?php if(!empty($subtitle)) : ?><p class="subtitle"><?php echo esc_attr($subtitle); ?></p><?php endif; ?>
            </div>

        <?php endif; ?>
    </div>

    <?php if ( ( !empty( $preview_video ) ) || !empty( $private_lesson ) ) : ?>
        <div class="panel-heading-right">
            <?php 
            if(!empty($preview_video)): 
                 $preview_video = apply_filters('wcpl_download_lesson', $preview_video);
                ?>
                <a class="video-lesson-preview preview-button" href="<?php echo esc_url( $preview_video ); ?>"><i class="fa fa-play-circle"></i><?php esc_html_e( 'Preview', 'studiare' ); ?></a>
				<a class="video-lesson-preview preview-button for-mobile" href="<?php echo esc_url( $preview_video ); ?>"><i class="fa fa-play-circle"></i></a>
            <?php endif; ?>
			
                
			<?php 
                        $download_lesson = apply_filters('wcpl_download_lesson', $download_lesson);
                        if(!empty($download_lesson)): 
                            ?>
				<?php if($bought_course): ?>
                                <a class="download-button" href="<?php echo esc_url( $download_lesson ); ?>"><i class="fa fa-download"></i></a>
				<?php else: ?>
					<div class="download-button gray"><i class="fa fa-download"></i></div>
				<?php endif; ?>
			<?php endif; ?>
			
			
	        <?php if(!empty($private_lesson)): ?>
                <div class="private-lesson">
				<?php
							if ( wc_customer_bought_product( $current_user->user_ID, $current_user->ID, get_the_id())) {
								echo '<i class="fa fa-unlock green-lock"></i>';
								}
							else {
								echo '<i class="fa fa-lock"></i>';
							}
				?>
					<span>
						<?php
							if ( wc_customer_bought_product( $current_user->user_ID, $current_user->ID, get_the_id())) {
								esc_html_e('در دسترس', 'studiare');
								}
							else {
								esc_html_e('Private', 'studiare');
							}

						?>
					</span></div>
	        <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<?php if(!empty($content)): ?>
    <div class="panel-content">
        <div class="panel-content-inner">
	        <?php
	        // Check for private content only on course page
	        if(!empty($private_lesson) and $private_lesson){
		        if($bought_course) {
		            echo do_shortcode( $content );
		        } else {
			        // placeholder
			        if(!empty($private_placeholder)) {
				        echo balancetags($private_placeholder);
			        } else {
				        esc_html_e( 'This lesson is private, for full access to all lessons you need to buy this course.', 'studiare' );
			        }
		        }
	        } else {
		        echo do_shortcode( $content );
	        }
	        ?>
        </div>
    </div>
<?php endif; ?>