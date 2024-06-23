<?php
/**
 * Page template for search results
 */
?>

<div class="main-page-content default-margin" id="content">
	<div class="site-content-inner container" role="main">
		<div class="search-results-wrapper">

			<div class="search-results-main">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<div class="search-result-box">
						<?php if ( has_post_thumbnail() ) :?>
                            <div class="result-thumbnail">
                                <a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail('studiare-image-400x400-croped'); ?>
                                </a>
                            </div>
						<?php endif; ?>
						<div class="search-content">
                            <h3 class="result-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <p><?php echo strip_shortcodes( get_the_excerpt() ); ?></p>
                            <a href="<?php the_permalink(); ?>" class="read-more"><?php esc_html_e( 'Read More', 'studiare' ); ?></a>
                        </div>
					</div>
				<?php endwhile;

				    echo paginate_links( array(
						'type'      => 'list',
						'prev_text' => '<i class="fa fa-angle-left"></i>',
						'next_text' => '<i class="fa fa-angle-right"></i>',
					) );

				else :

					get_template_part( '/inc/templates/not-found' );

				endif; ?>
			</div>

			<aside class="main-sidebar-holder sticky-sidebar">
			<div class="theiaStickySidebar">
				<?php get_sidebar(); ?>
			</div>
			</aside>

		</div>
	</div>
</div>
