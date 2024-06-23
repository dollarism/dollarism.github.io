<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$content_log_reg = '';

if ( class_exists('Redux' ) ) {
    $content_log_reg = codebean_option('content_log_reg');
}
?>

<?php wc_print_notices(); ?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

<div class="login-user-back">
<div class="login-user">
<div class="row login-wrapper">

	<div class="col-md-6 col-sm-12 col-xs-12">

	<div class="u-column1 col-1 stu-login">

<?php endif; ?>

		<h2 class="login-title">ورود به حساب کاربری</h2>

		<div class="leading">
				<span>کاربر جدید هستید؟</span>
				<button class="login-btn">ثبت&zwnj;نام</button>
			</div>

		<form class="woocommerce-form woocommerce-form-login login" method="post">

			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<i class="fal fa-user-alt"></i>
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" placeholder="نام کاربری یا آدرس ایمیل *" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
			</p>
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<i class="fal fa-lock-open"></i>
				<input class="woocommerce-Input woocommerce-Input--text input-text" placeholder="رمز عبور *" type="password" name="password" id="password" autocomplete="current-password" />
			</p>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<p class="form-row">
				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
				<button type="submit" class="woocommerce-Button button" name="login" value="<?php esc_attr_e( 'Log in', 'studiare' ); ?>"><?php esc_html_e( 'Log in', 'studiare' ); ?></button>
			</p>
			<p class="woocommerce-LostPassword lost_password password-remember">
                <label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">
                    <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'studiare' ); ?></span>
                </label>
				<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'studiare' ); ?></a>
			</p>

			<?php do_action( 'woocommerce_login_form_end' ); ?>

		</form>
		


<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

	</div>



	<div class="u-column2 col-2 stu-reg">


			<h2 class="login-title">عضویت در سایت</h2>

			<div class="leading">
			<span>قبلا ثبت‌نام کرده‌اید؟</span>
            <button class="reg-btn">وارد شوید</button>
		</div>

			<form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

				<?php do_action( 'woocommerce_register_form_start' ); ?>

				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<i class="fal fa-user-alt"></i>
						<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" placeholder="نام کاربری *" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
					</p>

				<?php endif; ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<i class="fal fa-envelope"></i>
					<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" placeholder="آدرس ایمیل *" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
				</p>

				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<i class="fal fa-lock-open"></i>
						<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" placeholder="رمز عبور *" name="password" id="reg_password" autocomplete="new-password" />
					</p>

				<?php else : ?>

				<p><?php esc_html_e( 'A password will be sent to your email address.', 'woocommerce' ); ?></p>

				<?php endif; ?>

				<?php do_action( 'woocommerce_register_form' ); ?>

				<p class="woocommerce-FormRow form-row">
					<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
					<button type="submit" class="woocommerce-Button button" name="register" value="<?php esc_attr_e( 'Register', 'studiare' ); ?>"><?php esc_html_e( 'Register', 'studiare' ); ?></button>
				</p>

				<?php do_action( 'woocommerce_register_form_end' ); ?>

			</form>

			

	</div>



	</div>


	<div class="col-md-6 col-sm-12 col-xs-12 dis-login-section">
		<div class="login-user-dis">
			<?php if ( $content_log_reg != '' ) : ?>
				<?php echo do_shortcode( $content_log_reg ); ?>
			<?php endif; ?>
		</div>
	</div>
</div>
</div>
</div>


<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
