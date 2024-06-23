<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header();

$blog_layout = 'grid';
$blog_sidebar = 'right';

if ( class_exists('Redux') ) {
    $blog_sidebar = codebean_option('sidebar_position');
    $blog_layout = codebean_option('blog_post_style');
}

$sidebar_position = isset($_GET['sidebar']) ? $_GET['sidebar'] : $blog_sidebar;

$blog_container_classes = array('blog-archive');

if ( $sidebar_position == 'left' || $sidebar_position == 'right' ) {
    $blog_container_classes[] = 'has-sidebar';
}

if ( $sidebar_position == 'left' ) {
    $blog_container_classes[] = 'sidebar-left';
} elseif ( $sidebar_position == 'right' ) {
    $blog_container_classes[] = 'sidebar-right';
}

?>

<div class="main-page-content default-margin" id="content">

	<div class="site-content-inner container" role="main">

		<div class="<?php echo esc_attr( implode( ' ', $blog_container_classes ) ); ?>">

            <div class="blog-main-loop">
			
	            <?php
                    $blog_style = isset($_GET['blog_layout']) ? $_GET['blog_layout'] : $blog_layout;
                    get_template_part( '/inc/templates/blog/'.$blog_style );
	            ?>
				<?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>
            </div> <!-- end .blog-main-loop -->

            <?php if ( $sidebar_position !== 'none' ) : ?>
                <aside class="main-sidebar-holder sticky-sidebar">
				<div class="theiaStickySidebar">
                    <?php get_sidebar(); ?>
				</div>
                </aside>
            <?php endif; ?>

        </div>

	</div>

</div>

<?php get_footer(); ?>
