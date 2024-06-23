<?php
/**
 * Default Single Portfolio Post Template
 */

$post_nav = true;

if ( class_exists('Redux' ) ) {
    $post_nav = codebean_option('portfolio_nav');
}

get_header(); ?>

<div class="main-page-content default-margin" id="content">
	<div class="site-content-inner container" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<div class="portfolio-single-wrapper">
				<div class="portfolio-single-inner">
					<?php the_content(); ?>
				</div>

				
			</div>

		<?php endwhile; ?>

	</div>
</div>

<?php get_footer(); ?>