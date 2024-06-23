<?php

$teachers_holder_class = array('teachers-wrapper three-cols');

$paged = get_query_var( 'paged', 1 );

$args = array(
	'post_type' => 'teacher',
	'paged' => $paged
);

$teacher_query = new WP_Query( $args );

?>
<div class="main-page-content default-margin" id="content">
	<div class="site-content-inner container" role="main">

		<?php if ( $teacher_query->have_posts() ) : ?>

			<div class="<?php echo implode( ' ', apply_filters( 'studiare_teachers_holder_class', $teachers_holder_class ) ); ?>">

				<?php while ( $teacher_query->have_posts() ) : $teacher_query->the_post(); ?>

					<?php get_template_part( 'inc/templates/teacher-item' ); ?>

				<?php  endwhile; ?>

			</div>

			<?php
                echo paginate_links( array(
                    'type'      => 'list',
                    'total'     => $teacher_query->max_num_pages,
                    'prev_text' => '<i class="fa fa-angle-left"></i>',
                    'next_text' => '<i class="fa fa-angle-right"></i>',
                ) );
			?>

		<?php else: ?>

			<?php get_template_part( 'inc/templates/not-found' ); ?>

		<?php endif; ?>

	</div>
</div>
