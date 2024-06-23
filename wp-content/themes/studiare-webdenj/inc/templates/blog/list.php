<?php
/**
 * Page template for list style on blog
 */
?>
<div class="blog-loop-inner blog-masonry blog-loop-view-list">

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post();

		get_template_part( '/inc/templates/blog/list-postbit' );

	endwhile; else :

		get_template_part( '/inc/templates/not-found' );

	endif; ?>

</div>

<?php echo paginate_links( array(
	'type'      => 'list',
	'prev_text' => '<i class="fa fa-angle-left"></i>',
	'next_text' => '<i class="fa fa-angle-right"></i>',
) ); ?>