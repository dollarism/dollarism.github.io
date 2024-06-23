<?php
/**
 * The template for displaying inner content on single posts
 */

$separate_meta = esc_html__( ', ', 'studiare' );

// Get Categories for posts.
$categories_list = get_the_category_list( $separate_meta );

// Get Tags for posts.
$tags_list = get_the_tag_list( '' );

$blog_post_share = false;
$article_author = true;
$blog_related = true;

if ( class_exists('Redux') ) {
	$blog_post_share = codebean_option('blog_share_story');
	$article_author = codebean_option('article_author');
	$blog_share_story = codebean_option('blog_share_story');
	$blog_related = codebean_option('blog_related');
	$blog_meta_data = codebean_option('blog_meta_data');
	$report_form = codebean_option('report_form');
	$related_blog_layout = codebean_option('related-blog_post_style');
}

$prefix = '_studiare_';
$video_post_id = get_post_meta(get_the_ID(), $prefix . 'video_post_id', true);
$poster_video_post_id = get_post_meta(get_the_ID(), $prefix . 'poster_video_post_id', true);

$download_box_content = get_post_meta(get_the_ID(), $prefix . 'download_box_content', true);
$download_box_password = get_post_meta(get_the_ID(), $prefix . 'download_box_password', true);
$download_login = get_post_meta(get_the_ID(), $prefix . 'download_login', true);
$related_blog_layout = codebean_option('related-blog_post_style');
$product_cats = get_post_meta(get_the_ID(), $prefix . 'product_cats', true);

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
	<?php while ( have_posts() ) : the_post(); ?>

		<div class="post-inner">

			<header class="entry-header">
			<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
			<?php if ( $blog_meta_data ) : ?>
				<?php get_template_part( '/inc/templates/blog/blog-meta-data' ); ?>
			<?php endif; ?>

			</header>

				<div class="post-thumbnail">
				<?php
					$attr =  array(
						'mp4'      => $video_post_id,
						'poster'   => $poster_video_post_id,
						'preload'  => 'auto',
						'width'    => '1200',
						'height'   => '600'
					);
					echo wp_video_shortcode(  $attr );
				?>
				</div>


			<div class="entry-content">
				<?php the_content(); ?>
				<?php wp_link_pages(array(
					'before' => '<div class="page-pagination"><div class="page-links-title">' . esc_html__('Pages:', 'studiare') . '</div>',
					'after' => '</div>',
					'link_before' => '<span>', 'link_after' => '</span>'
				)); ?>
			</div>



			<?php if ( $blog_share_story ) : ?>
				<?php
					get_template_part( '/inc/templates/sharing-blog' );
				?>
			<?php endif; ?>



		</div>

		<?php if ( !empty($download_box_content) ) : ?>
		<div class="post-inner">



			<?php if ( !empty($download_box_content) ) : ?>
				<div class="help_download">
					<?php echo ($download_box_content); ?>
				</div>
			<?php endif; ?>

			<div class="box_download">

  			<span><i class="fa fa-folder-open-o"></i> دانلود فایل </span>
				<div class="box_content">
					<?php if ( is_user_logged_in() ) : ?>
						<?php get_template_part( '/inc/templates/blog/download-links' ); ?>
					<?php elseif ( $download_login ) : ?>
						<p class="msg-box-download">برای مشاهده لینک دانلود لطفا وارد حساب کاربری خود شوید!</p>
						<?php	if ( is_plugin_active( 'digits/digit.php' ) ) : ?>
							<?php echo do_shortcode ('[dm-modal]'); ?>
						<?php else : ?>
						<a href="#" class="register-modal-opener login-box-download-btn"><i class="fal fa-user-lock"></i>وارد شوید</a>
						<?php endif; ?>
					<?php else: ?>
						<?php get_template_part( '/inc/templates/blog/download-links' ); ?>
					<?php endif; ?>
				</div>
			</div>

			<p class="button_download">
  			<span class="password" id="password" data-toggle="tooltip" data-placement="top" title="" data-original-title="جهت کپی پسورد کلیک کنید">پسورد فایل : <em id="password_copy"><?php echo ($download_box_password); ?></em></span>
  			<a class="link-not" type="button" data-toggle="collapse" data-target="#report" aria-expanded="false" aria-controls="report">گزارش خرابی لینک</a>
  		</p>

			<div class="collapse">
    		<div class="well">
				<?php echo do_shortcode ($report_form); ?>
				</div>
			</div>

		</div>
		<?php endif; ?>

		<?php if ( $tags_list && ! is_wp_error( $tags_list ) ) : ?>
		<div class="post-inner">

					<div class="post-tags">
						<span><i class="fal fa-tags"></i><?php esc_html_e( 'Tags:', 'studiare' ); ?></span>
						<?php echo wp_kses_post( $tags_list ); ?>
					</div>
		</div>
		<?php endif; ?>



		<?php if ( $article_author == '1' && get_the_author_meta( 'description') !== '' ) : ?>
		<div class="post-inner">
                <div class="post-author-box">
					<?php
					$author_bio_avatar_size = apply_filters( 'goseowp_author_bio_avatar_size', 130 );

					echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
					?>
                    <div class="author-content">
                        <h5 class="author-title"><?php printf( esc_html__( 'About %s', 'studiare' ), get_the_author() ); ?></h5>
                        <p class="author-bio">
							<?php the_author_meta( 'description' ); ?>
                        </p>
                        <a class="author-link btn btn-border btn-small" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
							<?php printf( esc_html__( 'More Posts by %s', 'studiare' ), get_the_author() ); ?>
                        </a>
                    </div>
                </div>
				</div>
            <?php endif; ?>

			<?php get_template_part( '/inc/templates/blog/social-links' ); ?>
			<?php dynamic_sidebar('single_blog_ads'); ?>

			<?php if ( $blog_related ) : ?>

			<?php
						$related_blog_style = isset($_GET['related_blog_layout']) ? $_GET['related_blog_layout'] : $related_blog_layout;
						get_template_part( '/inc/templates/blog/'.$related_blog_style );
			?>
			<?php endif; ?>

			<?php $related_product_post = new WP_Query(
							array(
								'post_type' => 'product',
								'posts_per_page' => 5,
								'product_cat' => $product_cats
							));
			?>

<?php if ( !empty($product_cats) ) : ?>
		<div class="product-reviews">
				<div class="product-review-title">
          <i class="fal fa-user-graduate"></i>  <h3 class="inner">دوره های آموزشی مرتبط</h3>
        </div>
				<div class="product-reviews-inner">

					<div class="products courses-holder">
						<div class="owl-carousel" data-autoplay="false" data-slider-items="3" data-pagination="true" data-navigation="true" data-loop="false">
							<?php while ( $related_product_post->have_posts() ) : $related_product_post->the_post(); ?>
								<?php get_template_part( 'woocommerce/content', 'product-carousel' ); ?>
							<?php endwhile; // end of the loop.

							wp_reset_postdata();

							 ?>

						</div>
					</div>

				</div>
    </div>
<?php endif; ?>

	<?php endwhile; ?>
</article>
