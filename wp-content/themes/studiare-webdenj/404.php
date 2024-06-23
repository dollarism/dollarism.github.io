<?php
/**
 * The template for displaying 404 pages (not found)
 */

get_header(); ?>

<div class="main-page-content default-margin" id="content">

	<div class="site-content-inner container" role="main">

		<section class="error-404 not-found">
            <div class="not-found-icon-wrapper">
                <span class="error-page">404</span>
            </div>
            <div class="not-found-content">
                <h1><?php esc_html_e( 'This page doesn’t exist', 'studiare' ); ?></h1>
                <p><?php esc_html_e( 'At least not in this universe.', 'studiare' ); ?></p>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-border"><?php esc_html_e('Back to home', 'studiare'); ?></a>
            </div>
        </section>

	</div>

</div>

<?php get_footer();

