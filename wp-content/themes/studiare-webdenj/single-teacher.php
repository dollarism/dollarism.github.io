<?php
/**
 * Default Single Teacher Post Template
 */

get_header();

// Container start
$site_inner = array('site-content-inner container');
$container = array('main-page-content default-margin');

?>
<div class="<?php echo esc_attr( implode( ' ', $container ) ); ?>" id="content">

	<div class="<?php echo esc_attr( implode( ' ', $site_inner ) ); ?>" role="main">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div class="teacher-single">

				<?php the_content(); ?>

			</div>
		<?php endwhile; endif; ?>

	</div>

</div>

<?php get_footer(); ?>