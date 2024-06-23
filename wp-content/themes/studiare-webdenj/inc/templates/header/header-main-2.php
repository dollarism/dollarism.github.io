<?php
/**
 * Template File for Main Header
 */

$prefix = '_studiare_';

$header_display = get_post_meta( get_the_ID(), $prefix . 'header_off', true );
$custom_logo_image = get_theme_file_uri('assets/images/logo_default.svg');
$search_header = true;
$header_button = false;
$header_button_link = 'account';
$header_button_custom_link = null;
$header_button_custom_text = null;
$header_sticky_menu = false;

if ( class_exists( 'Redux') ) {
	$header_sticky_menu = codebean_option( 'header_sticky_menu' );
	$search_header = codebean_option('topbar_search');
	$logo_uploaded = codebean_option('custom_logo_image');
	if(isset($logo_uploaded['url']) && $logo_uploaded['url'] != '') {
		$custom_logo_image = $logo_uploaded['url'];
	}
	$header_button = codebean_option('header_button');
	$header_button_link = codebean_option('header_button_link');
	$header_button_custom_link = codebean_option('header_button_custom_link');
	$header_button_custom_text = codebean_option('header_button_custom_text');
	$vertical_menu_text = codebean_option('vertical_menu_text');
	$header_button_custom_text_after_login = codebean_option('header_button_custom_text_after_login');
	$header_button_custom_link_after_login = codebean_option('header_button_custom_link_after_login');

}

$menu = wp_nav_menu( array(
    'theme_location'  => 'main-menu',
    'container'       => false,
    'menu_class'      => 'menu',
    'echo'            => false,
	'walker' 			=> new EmallShopFrontendWalker(),
) );

$cat_menu = wp_nav_menu( array(
	    'theme_location'  => 'cat-menu',
	    'container'       => false,
	    'menu_class'      => 'header-category-dropdown',
			'menu_id'      => 'cat-dropdown',
	    'echo'            => false,
) );

$downloads = 'downloads';
$logout = 'customer-logout'

?>
<?php if ( !$header_display ) : ?>
<header class="header-v2 site-header<?php echo esc_attr( $header_sticky_menu ) ? " cdb-header-fixed-2": ''; ?>">

    <div class="container">

        <div class="site-header-inner">

            <div class="navigation-left">

                <div class="site-logo">
                    <div class="studiare-logo-wrap">
                        <a href="<?php echo esc_url( home_url('/') ); ?>" class="studiare-logo studiare-main-logo" rel="home">
                            <img src="<?php echo esc_url( $custom_logo_image ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                        </a>
                    </div>
                </div>

								<div class="header-category-menu">
						       <a href="#" class="header-icon category-menu-toggle">
						           <div class="category-toggle-icon">
						                <svg width="18px" height="18px" viewBox="0 0 18 18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
						                  <g stroke="none" stroke-width="1" fill="#000000" fill-rule="evenodd" class="cat-menu-icon">
						                    <path d="M2,14 C3.1045695,14 4,14.8954305 4,16 C4,17.1045695 3.1045695,18 2,18 C0.8954305,18 0,17.1045695 0,16 C0,14.8954305 0.8954305,14 2,14 Z M9,14 C10.1045695,14 11,14.8954305 11,16 C11,17.1045695 10.1045695,18 9,18 C7.8954305,18 7,17.1045695 7,16 C7,14.8954305 7.8954305,14 9,14 Z M16,14 C17.1045695,14 18,14.8954305 18,16 C18,17.1045695 17.1045695,18 16,18 C14.8954305,18 14,17.1045695 14,16 C14,14.8954305 14.8954305,14 16,14 Z M2,7 C3.1045695,7 4,7.8954305 4,9 C4,10.1045695 3.1045695,11 2,11 C0.8954305,11 0,10.1045695 0,9 C0,7.8954305 0.8954305,7 2,7 Z M9,7 C10.1045695,7 11,7.8954305 11,9 C11,10.1045695 10.1045695,11 9,11 C7.8954305,11 7,10.1045695 7,9 C7,7.8954305 7.8954305,7 9,7 Z M16,7 C17.1045695,7 18,7.8954305 18,9 C18,10.1045695 17.1045695,11 16,11 C14.8954305,11 14,10.1045695 14,9 C14,7.8954305 14.8954305,7 16,7 Z M2,0 C3.1045695,0 4,0.8954305 4,2 C4,3.1045695 3.1045695,4 2,4 C0.8954305,4 0,3.1045695 0,2 C0,0.8954305 0.8954305,0 2,0 Z M9,0 C10.1045695,0 11,0.8954305 11,2 C11,3.1045695 10.1045695,4 9,4 C7.8954305,4 7,3.1045695 7,2 C7,0.8954305 7.8954305,0 9,0 Z M16,0 C17.1045695,0 18,0.8954305 18,2 C18,3.1045695 17.1045695,4 16,4 C14.8954305,4 14,3.1045695 14,2 C14,0.8954305 14.8954305,0 16,0 Z"></path>
						                  </g>
						                </svg>
						           </div>
						           <div class="category-toggle-text"><?php echo ($vertical_menu_text); ?></div>
						      </a>
						      <nav class="header-category-dropdown-wrap">
						        <?php echo wp_kses_post($cat_menu); ?>
						      </nav>
						  </div>



            </div>

						<?php if ( function_exists('WC' ) ) : ?>
				        <div class="header-cart-icon">
				            <a href="<?php echo wc_get_cart_url(); ?>" class="mini-cart-opener">
				                <span class="bag-icon">
				                    <i class="fal fa-shopping-bag"></i>
				                </span>
					            <?php studiare_cart_count(); ?>
				            </a>

				        </div>
				    <?php endif; ?>

            <?php if ( $header_button ) : ?>
							<div class="header-button-link">
									<?php	if ( is_plugin_active( 'digits/digit.php' ) || is_plugin_active( 'digit_ippanel/digit_ippanel.php' ) ) : ?>

										<?php if ( is_user_logged_in() ) : ?>
											<?php
												get_template_part( '/inc/templates/header/user-menu' );
											?>
											<?php else : ?>
										<?php echo do_shortcode ('[dm-modal]'); ?>
										<?php endif; ?>
									<?php else : ?>
										<?php if ( $header_button_link == 'account' ) : ?>
												<?php $account_link = get_permalink( get_option('woocommerce_myaccount_page_id') );

												if ( is_user_logged_in() ) { ?>
													<?php
														get_template_part( '/inc/templates/header/user-menu' );
													?>

												<?php } else { ?>
														<a href="#" class="register-modal-opener login-button btn btn-filled"><i class="fal fa-user-lock"></i><p class="login-btn-txt"><?php esc_html_e( 'Get Started', 'studiare' ); ?></p></a>
												<?php } ?>

										<?php else: ?>
												<?php if ( is_user_logged_in() ) : ?>
                    								<a href="<?php echo esc_url($header_button_custom_link_after_login); ?>" class="btn btn-filled custom-btn" rel="nofollow"><?php echo esc_html($header_button_custom_text_after_login); ?></a>
                    							<?php else: ?>
                    								<a href="<?php echo esc_url($header_button_custom_link); ?>" class="btn btn-filled custom-btn" rel="nofollow"><?php echo esc_html($header_button_custom_text); ?></a>
                    							<?php endif; ?>

										<?php endif; ?>
									<?php endif; ?>
								</div>

            <?php endif; ?>

            <a href="#" class="mobile-nav-toggle">
                <span class="the-icon"></span>
            </a>

        </div>

        <?php if ( $search_header && ! get_post_meta( get_the_ID(), $prefix . 'top_bar_off', true ) ) : ?>
            <div class="site-search-wrapper">
                <form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <input type="search" class="search-input" placeholder="<?php esc_attr_e( 'Type in keyword', 'studiare' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
                    <button type="submit" class="submit">
                        <?php get_template_part( 'assets/images/search-icon.svg' ); ?>
                    </button>
                </form>
            </div>
        <?php endif; ?>


		</div>

		<div class="menu_wrapper">
			<div class="container">
				<div class="menu_wrapper_iner">

					<div class="site-navigation studiare-navigation" role="navigation">
						<?php echo wp_kses_post($menu); ?>
					</div>

				</div>
			</div>
		</div>




</header>
<?php endif; ?>

<?php if ( $search_header && ! get_post_meta( get_the_ID(), $prefix . 'top_bar_off', true ) ) : ?>
    <div class="search-capture-click"></div>
<?php endif; ?>
