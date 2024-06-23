<?php
/**
 * The template for displaying all single posts
 */

get_header();

$prefix = '_studiare_';
$sidebar_display = get_post_meta( get_the_ID(), $prefix . 'sidebar_off', true );

$blog_sidebar = 'right';
$post_nav = true;

if ( class_exists('Redux') ) {
	$blog_sidebar = codebean_option('sidebar_position_single');
	$post_nav = codebean_option('blog_navigation');
}

$sidebar_position_single = isset($_GET['sidebar']) ? $_GET['sidebar'] : $blog_sidebar;

$blog_container_classes = array('blog-archive');

if ( $sidebar_position_single == 'left' || $sidebar_position_single == 'right' ) {
	$blog_container_classes[] = 'has-sidebar';
}

if ( $sidebar_position_single == 'left' ) {
	$blog_container_classes[] = 'sidebar-left';
} elseif ( $sidebar_position_single == 'right' ) {
	$blog_container_classes[] = 'sidebar-right';
}

if ( $sidebar_display ) {
	$blog_container_classes[] = 'no-sidebar';
}


?>

<div class="main-page-content default-margin" id="content">

	<div class="site-content-inner container" role="main">

		<div class="<?php echo esc_attr( implode( ' ', $blog_container_classes ) ); ?>">

			<div class="blog-main-loop">

                <div class="blog-loop-inner post-single">
				    <?php get_template_part( '/inc/templates/blog/single', get_post_format() ); ?>

                </div>

				<?php if ( $post_nav ) {
					do_action( 'studiare_post_nav' );
				} ?>

				<?php if ( comments_open() || get_comments_number() ) : ?>
                    <!-- start #comments -->
					<?php comments_template('', true); ?>
                    <!-- end #comments -->
				<?php endif; ?>
			</div> <!-- end .blog-main-loop -->

			<?php if ( $sidebar_position_single !== 'none' ) : ?>
				<?php if ( !$sidebar_display ) : ?>
				<aside class="main-sidebar-holder sticky-sidebar">
				<div class="theiaStickySidebar">
					<?php get_sidebar(); ?>
				</div>
				</aside>
					<?php endif; ?>
			<?php endif; ?>

		</div>

	</div>

</div>

<?php get_footer(); ?>
