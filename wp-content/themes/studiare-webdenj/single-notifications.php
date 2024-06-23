
<?php
/**
 * The template for displaying all single posts
 */

get_header();
?>
<div class="main-page-content default-margin" id="content">

	<div class="site-content-inner container" role="main">     
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
            <i class="fa fa-calendar"></i> </i><?php the_time('d / m / Y'); ?>
			<h3 class="notification-title"><?php the_title(); ?>  </h3>
			<div class="notification-content">
				<?php the_content(); ?>
			</div>
		<?php endwhile; else: ?>
		<?php endif; ?>	
	</div>

<?php get_footer(); ?>