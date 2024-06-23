<?php

$portfolio_filters = 'left';
$portfolio_col = 'three';
$portfolio_orderby = 'date';
$portfolio_order = 'DESC';
$portfolio_pagination = true;

if ( class_exists('Redux' ) ) {
	$portfolio_filters = codebean_option( 'portfolio_filters' );
	$portfolio_col = codebean_option( 'portfolio_columns' );
	$portfolio_pagination = codebean_option( 'portfolio_nav' );
	$posts_per_page = codebean_option( 'portfolio_per_page' );
}

$portfolio_holder_class = array('portfolio-holder portfolio-masonry');
$portfolio_holder_class[] = 'portfolio-' . $portfolio_col . '-col';

$paged = get_query_var( 'paged', 1 );

$args = array(
	'post_type' => 'portfolio',
	'orderby' => $portfolio_orderby,
	'order' => $portfolio_order,
	'paged' => $paged
);

//$i = 0;

$portfolio_query = new WP_Query( $args );

?>
<div class="main-page-content default-margin" id="content">
    <div class="site-content-inner container" role="main">

        <?php if ( $portfolio_query->have_posts() ) : ?>

            <div class="portfolio-archive <?php echo esc_attr( $portfolio_filters ); ?>-sidebar">

                <!-- Portfolio Loop -->
                <div class="portfolio-items-holder">
                    <div class="<?php echo implode( ' ', apply_filters( 'studiare_portfolio_holder_class', $portfolio_holder_class ) ); ?>">

		                <?php while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post(); ?>

			                <?php get_template_part( 'inc/templates/portfolio/portfolio-item' ); ?>

		                <?php  endwhile; ?>

                    </div>

	                <?php if ( $portfolio_pagination ) {
		                echo paginate_links( array(
			                'type'      => 'list',
			                'total'     => $portfolio_query->max_num_pages,
			                'prev_text' => '<i class="fa fa-angle-left"></i>',
			                'next_text' => '<i class="fa fa-angle-right"></i>',
		                ) );
	                } ?>
                </div>

	            <?php if ( $portfolio_filters !== 'no' ) : ?>

                    <aside class="main-sidebar-holder sticky-sidebar">
					<div class="theiaStickySidebar">
                        <div class="sidebar-widgets-wrapper portfolio-controls">
				            <?php get_template_part( 'inc/templates/portfolio/portfolio-cat' ); ?>
					</div>
                        </div>
                    </aside>

	            <?php endif; ?>

            </div>

        <?php else : ?>

            <?php get_template_part( 'inc/templates/not-found' ); ?>

        <?php endif; ?>

    </div>
</div>
