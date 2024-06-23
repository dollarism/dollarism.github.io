<?php

$classes[] = 'portfolio-entry mix';

$categories = get_the_term_list( get_the_ID(), 'portfolio_category', '', ', ', '' );
if ($categories !== '') {
	$categories = strip_tags($categories);
}

$terms = get_the_terms( get_the_ID(), 'portfolio_category' );

if ( !empty( $terms ) ) {
	foreach ( $terms as $key => $term ) {
		$classes[] = 'portfolio-cat-' . $term->slug;
	}
}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
    <div class="portfolio-entry-inner">

	    <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
            <div class="portfolio-entry-thumb">
                <a href="<?php echo esc_url( get_permalink() ); ?>" class="portfolio-link"></a>
                <figure class="thumb-inner">
                    <a href="<?php echo esc_url( get_permalink() ); ?>" class="portfolio-thumb-link">
			            <?php the_post_thumbnail('studiare-image-420x294-croped' ); ?>
                    </a>
                </figure>
                <div class="overlay-icon">
                    <?php get_template_part( 'assets/images/arrow-next.svg' ); ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="portfolio-infos">
            <h4 class="portfolio-entry-title"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h4>
	        <?php
	        if ( !empty($categories) ) { ?>
                <div class="portfolio-entry-terms"><?php echo esc_html($categories); ?></div>
	        <?php }
	        ?>
        </div>

    </div>
</article>
