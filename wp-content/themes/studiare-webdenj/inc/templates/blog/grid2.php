<?php
/**
 * Page template for grid style on blog
 */

$blog_grid_columns = 'two';

if ( class_exists('Redux') ) {
    $blog_grid_columns = codebean_option('blog_grid_columns');
}

$blog_cols = isset($_GET['blog_columns']) ? $_GET['blog_columns'] : $blog_grid_columns;

?>
<div class="blog-loop-inner blog-loop-view-grid grid-2 <?php echo esc_attr( $blog_cols ); ?>-columns">

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post();

		get_template_part( '/inc/templates/blog/grid-postbit-2' );

	endwhile; else :

		get_template_part( '/inc/templates/not-found' );

	endif; ?>

</div>

<?php echo paginate_links( array(
	'type'      => 'list',
	'prev_text' => '<i class="fa fa-angle-left"></i>',
	'next_text' => '<i class="fa fa-angle-right"></i>',
) ); ?>
