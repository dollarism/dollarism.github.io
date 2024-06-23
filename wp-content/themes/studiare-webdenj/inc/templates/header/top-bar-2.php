<?php
/**
 * Template for top bar header
 */

$prefix = '_studiare_';

$topbar_display = get_post_meta( get_the_ID(), $prefix . 'top_bar_off', true );
$topbar_left_text = '';
$topbar_display_opt = true;
$topbar_color = 'light';
$top_bar_phone = '';
$top_bar_email = '';
$cart_icon = true;
$pup_up_button = true;

if ( class_exists('Redux') ) {
	$topbar_left_text = codebean_option( 'topbar_text' );
	$topbar_display_opt = codebean_option( 'topbar_display_opt' );
	$topbar_color = codebean_option( 'topbar_color' );
	$top_bar_phone = codebean_option( 'top_bar_phone' );
	$top_bar_email = codebean_option( 'top_bar_email' );
	$header_button = codebean_option('header_button');
	$header_button_link = codebean_option('header_button_link');
	$header_button_custom_link = codebean_option('header_button_custom_link');
	$header_button_custom_text = codebean_option('header_button_custom_text');
	$cart_icon = codebean_option('topbar_cart');
	$pup_up_button = codebean_option('pup_up_button');

}
?>
<?php if ( $topbar_display_opt && !$topbar_display ) : ?>
<div class="top-bar top-bar-color-<?php echo esc_attr( $topbar_color ); ?>">
    <div class="container">
        <div class="row">
            <div class="top-bar-col">
                <?php if ( $top_bar_phone || $top_bar_email ) : ?>
                    <ul class="top-bar-contact-info">
	                    <?php if( $top_bar_phone ){ ?>
                            <li><a href="tel:<?php echo esc_html( $top_bar_phone ); ?>"><i class="fa fa-phone"></i> <?php echo esc_html( $top_bar_phone ); ?></a></li>
	                    <?php } ?>
	                    <?php if( $top_bar_email ){ ?>
                            <li><a href="mailto:<?php echo esc_html( $top_bar_email ); ?>"><i class="fa fa-envelope"></i> <?php echo esc_html( $top_bar_email ); ?></a></li>
	                    <?php } ?>
                    </ul>
                <?php endif; ?>


            </div>
            <div class="top-bar-col top-bar-right">
                <?php get_template_part( 'inc/templates/header/top-bar-links' ); ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
