<?php

$prefix = '_studiare_';

$post_id = get_the_ID();
$is_shop        = false;
$is_product     = false;
$page_for_posts = get_option( 'page_for_posts' );

if ( is_home() || is_category() || is_search() || is_tag() || is_tax() || is_shop() || is_product_category() ) {
	$post_id = $page_for_posts;
}

if ( class_exists( 'Redux') ) {
	$single_post_title_text = codebean_option('single_post_title_text');
}

$bg_img = get_post_meta( get_the_ID(), $prefix . 'header_bg_img', true );
$bg_color = get_post_meta( get_the_ID(), $prefix . 'header_bg_color', true );

$style = '';

if ( $bg_color != '' ) {
		$style .= 'background-color: ' . $bg_color . ';';
	}
if ( $bg_img != '' ) {
		$style .= 'background-image: url(' . $bg_img . ');';
	}

?>
<?php if ( ! get_post_meta( $post_id,  $prefix . 'disable_title', true ) || ! get_post_meta( $post_id, $prefix. 'disable_breadcrumbs', true ) ): ?>
    <div class="page-title" style="<?php  if ( is_singular( 'product' ) || is_singular( 'post' ) ||  is_page() ) { echo esc_attr( $style ); } ?>">


        <div class="container">
			<?php if ( is_singular( 'post' ) ): ?>
					<p class="title-page"><?php echo ($single_post_title_text); ?></p>
            <?php elseif ( ! get_post_meta( $post_id, $prefix . 'disable_title', true ) ): ?>
                <?php if( studiare_page_title( false, esc_html__( 'News', 'studiare' ) ) ): ?>
                    <h1 class="title-page"><?php echo studiare_page_title( false, esc_html__( 'News', 'studiare' ) ); ?></h1>
                <?php endif; ?>
            <?php endif; ?>

	        <?php
	        if ( ! get_post_meta( $post_id, $prefix . 'disable_breadcrumbs', true ) && ! studiare_is_shop_archive() ) {
		        studiare_breadcrumbs();
	        } else if ( studiare_is_shop_archive() ) {
							 woocommerce_breadcrumb();
            }
	        ?>
        </div>


    </div>
<?php endif; ?>
