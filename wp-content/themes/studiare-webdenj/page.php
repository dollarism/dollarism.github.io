<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 */

get_header();

// Check if is default container
$is_vc_content = preg_match( "/\[vc_row.*?\]/i", $post->post_content );

// Password protected page doesn't use vc container
if ( post_password_required() ) {
	$is_vc_content = false;
}

// Container start
$site_inner = array('site-content-inner');
$container = array('main-page-content');

if ( $is_vc_content ) {
	$site_inner[] = 'vc-container';
} else {
	$site_inner[] = 'container';
	$container[] = 'default-margin';

} ?>



<div class="<?php echo esc_attr( implode( ' ', $container ) ); ?>" id="content">

	<div class="<?php echo esc_attr( implode( ' ', $site_inner ) ); ?>" role="main">

		<?php /* The loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<div class="entry-content">
					<?php the_content(); ?>
				</div>

				<?php studiare_wp_link_pages(); ?>

			</article><!-- #post -->

			<?php
                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
			?>

		<?php endwhile; ?>

	</div>

</div>

<?php get_footer(); ?>
