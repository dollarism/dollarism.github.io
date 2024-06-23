<?php

$copyrights_style = 'centered';
$copyrights_text = '';
$copyrights_text2 = '';

if ( class_exists('Redux') ) {
    $copyrights_style = codebean_option('copyrights-layout');
    $copyrights_text = codebean_option('copyrights');
	$copyrights_text2 = codebean_option('copyrights2');
}

?>
<div class="footer-copyright copyrights-layout-<?php echo esc_attr( $copyrights_style ); ?>">
    <div class="container">
        <div class="copyright-inner">

            <div class="copyright-cell">
	            <?php if ( $copyrights_text != ''): ?>
		            <?php echo do_shortcode( $copyrights_text ); ?>
	            <?php else: ?>
                    <div class="site-info">&copy; <?php echo date( 'Y ' ); bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved', 'studiare' ) ?></div>
	            <?php endif ?>
            </div>

	        <?php if ( $copyrights_text2 != ''): ?>
                <div class="copyright-cell">
                    <?php echo do_shortcode( $copyrights_text2 ); ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>
