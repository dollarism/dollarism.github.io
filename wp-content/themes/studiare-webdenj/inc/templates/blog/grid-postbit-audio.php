<?php

$blog_grid_columns = 'two';
$blog_desc_text = false;

if ( class_exists('Redux') ) {
	$blog_grid_columns = codebean_option('blog_grid_columns');
	$blog_thumbnails_size = codebean_option('blog_thumbnails_size');
	$blog_desc_text = codebean_option('blog_desc_text');
}

$categories = get_the_category();
$prefix = '_studiare_';
$audio_post_id = get_post_meta(get_the_ID(), $prefix . 'audio_post_id', true);

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-inner audio-inner">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="post-thumbnail">
				<a href="<?php the_permalink(); ?>" class="audio-icon">
				<i class="fal fa-microphone-alt"></i>

				<?php if ( $blog_thumbnails_size == 'square' ) : ?>
					<?php the_post_thumbnail('studiare-image-400x400-croped'); ?>
				<?php elseif ( $blog_thumbnails_size == 'rectangle' ) : ?>
					<?php the_post_thumbnail('studiare-image-420x294-croped'); ?>
				<?php endif; ?>

				</a>
				<div class="audio_post_thumb">
			<?php
					$attr =  array(
						'mp3'      => $audio_post_id,
					);
					echo wp_audio_shortcode(  $attr );
				?>
				</div>
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
		<div class="clearfix"></div>
		<div class="read_more_btn audio_btn">
            <a class="read_more" title="گوش کنید" href="<?php the_permalink(); ?>">گوش کنید</a>
        </div>
	</div>
</article>
