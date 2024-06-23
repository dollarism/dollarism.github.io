<?php

$blog_grid_columns = 'two';
$blog_desc_text = false;

if ( class_exists('Redux') ) {
	$blog_grid_columns = codebean_option('blog_grid_columns');
	$blog_thumbnails_size = codebean_option('blog_thumbnails_size');
	$blog_desc_text = codebean_option('blog_desc_text');
}

$categories = get_the_category();

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-inner">

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="post-thumbnail">
				<a href="<?php the_permalink(); ?>">
					<?php if ( $blog_thumbnails_size == 'square' ) : ?>
						<?php the_post_thumbnail('studiare-image-400x400-croped'); ?>
					<?php elseif ( $blog_thumbnails_size == 'rectangle' ) : ?>
						<?php the_post_thumbnail('studiare-image-420x294-croped'); ?>
					<?php endif; ?>
				</a>
			</div>
		<?php endif; ?>

		<div class="post-content">

			<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

			<?php if ( $blog_desc_text ) : ?>
				<div class="the-excerpt gird-excerpt">
					<?php
						if( has_excerpt() ){
        			$content = the_excerpt();
    				} else {
      				echo wp_trim_words( get_the_content(), 15, '...' );
    				}
				 ?>
				</div>
			<?php endif; ?>


		</div>
		<div class="read_more_btn">
            <a class="read_more" title="بیشتر بخوانید" href="<?php the_permalink(); ?>">بیشتر بخوانید</a>
        </div>
	</div>
</article>
