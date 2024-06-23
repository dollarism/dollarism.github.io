<?php
/**
 * The template for displaying the footer
 */

 use Elementor\Core\Files\CSS\Post_Preview;
 use Elementor\Group_Control_Image_Size;
 use Elementor\Icons_Manager;
 use Elementor\Plugin;
 use Elementor\Utils;
 use XTS\Elementor\Controls\Autocomplete;
 use XTS\Elementor\Controls\Google_Json;
 use XTS\Elementor\Controls\Buttons;


$prefix = '_studiare_';
$post_id = get_the_ID();

$footer_visiblity = true;
$footer_widgets_opt = true;
$footer_color_scheme = 'light';
$footer_coyprights_opt = true;
$back_to_top = true;

if ( class_exists('Redux')) {
    $footer_visiblity = codebean_option('footer_visibility');
	$footer_waves_visiblity = codebean_option('footer_waves_visiblity');
    $footer_widgets_opt = codebean_option('footer_widgets');
    $footer_color_scheme = codebean_option('footer_color_scheme');
	$footer_coyprights_opt = codebean_option('disable_copyrights');
	$back_to_top = codebean_option('scroll_top_btn');
	$header_button = codebean_option('header_button');
	$header_button_link = codebean_option('header_button_link');
	$header_type = codebean_option ('header_type');
  $footer_layout = codebean_option('footer_layout');
}

$header_button = true;
$header_button_link = 'account';
$account_link = get_permalink( get_option('woocommerce_myaccount_page_id') );
?>



<?php if ( studiare_needs_footer() ): ?>

    <?php if ( $footer_visiblity || ! get_post_meta($post_id, $prefix . 'footer_off', true) || ! get_post_meta($post_id, $prefix . 'copyrights_off', true) ) : ?>
		<?php if ( $footer_waves_visiblity ) : ?>
			<div class="ltx-overlay-main-waves"></div>
			<div class="ltx-overlay-black-waves"></div>
		<?php endif; ?>

		<footer id="footer" class="site-footer footer-color-<?php echo esc_attr( $footer_color_scheme ); ?>">

    <div class="container">
      <?php
      $content = Plugin::$instance->frontend->get_builder_content_for_display( $footer_layout );
      echo do_shortcode($content);
      ?>
    </div>

            <?php if ( $footer_widgets_opt && ! get_post_meta($post_id, $prefix . 'footer_off', true) ) {
                get_template_part( 'inc/templates/footer-widgets' );
            } ?>

            <?php if ( $footer_coyprights_opt && ! get_post_meta( $post_id, $prefix . 'copyrights_off', true ) ) {
                get_template_part( 'inc/templates/footer-copyrights' );
            } ?>

        </footer>
    <?php endif; ?>

<?php endif; ?>

</div> <!-- end .wrap -->


<?php if ( $back_to_top ) : ?>
    <a id="back-to-top" class="back-to-top">
        <i class="fal fa-angle-up"></i>
    </a>
<?php endif; ?>

<?php wp_footer(); ?>

<?php if ( ( $header_button ) && ( $header_button_link == 'account' ) ) : ?>
    <div class="modal">
        <div class="login-form-overlay"></div>
        <div class="login-form-modal">
            <div class="login-form-modal-inner">
                <div class="login-form-modal-box">
                    <a href="javascript:void(0)" class="close">
                        <?php get_template_part('/assets/images/close-icon.svg'); ?>
                    </a>
                    <div class="login-form-header">
                        <p class="login-title"><?php esc_html_e( 'Sign In', 'studiare' ); ?></p>
                    </div>
                    <div class="login-form-content">
                        <?php get_template_part('/inc/templates/login-modal' ); ?>
                        <?php printf(
	                        esc_html__( 'Not a member yet? %1$sSign Up%2$s', 'studiare' ),
	                        '<a href="' . esc_url( $account_link ) . '"><strong>',
                            '</strong></a>'
                        ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

</body>
</html>
