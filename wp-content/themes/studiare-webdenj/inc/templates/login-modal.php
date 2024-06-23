<?php
/**
 * Login From Modal Template File
 */

$account_link = get_permalink( get_option('woocommerce_myaccount_page_id') );
$redirect = false;

if ( class_exists('Redux' ) ) {
	$goo_app_id = codebean_option( 'goo_app_id' );
	$goo_app_secret = codebean_option( 'goo_app_secret' );
}

?>

<form method="post" class="login" action="<?php echo esc_url( $account_link ); ?>">

	<?php do_action( 'woocommerce_login_form_start' ); ?>

	<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide form-row-username">
        <label for="username"><?php esc_html_e( 'Username:', 'studiare' ); ?> <i class="fal fa-user-alt"></i></a>
		    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
        </label>
	</p>
	<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide form-row-password">
        <label for="password"><?php esc_html_e( 'Password:', 'studiare' ); ?> <i class="fal fa-lock-open"></i>
		    <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" />
        </label>
	</p>

	<?php do_action( 'woocommerce_login_form' ); ?>

    <div class="login-form-remember">
        <label class="remember-me-label inline">
            <input name="rememberme" type="checkbox" value="forever" /> <?php esc_html_e( 'Remember me', 'studiare' ); ?>
        </label>
        <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>" class="woocommerce-LostPassword lost_password"><?php esc_html_e( 'Lost your password?', 'studiare' ); ?></a>
    </div>

	<p class="form-row">
		<?php wp_nonce_field( 'woocommerce-login' ); ?>
		<?php if ( $redirect ): ?>
			<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />
		<?php endif ?>
		<input type="submit" class="woocommerce-Button button" name="login" value="<?php esc_attr_e( 'Sign In', 'studiare' ); ?>" />
	</p>

	<?php do_action( 'woocommerce_login_form_end' ); ?>

</form>
