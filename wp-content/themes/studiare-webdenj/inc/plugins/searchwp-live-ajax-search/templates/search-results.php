<?php
/**
 * Search results are contained within a div.searchwp-live-search-results
 * which you can style accordingly as you would any other element on your site
 *
 * Some base styles are output in wp_footer that do nothing but position the
 * results container and apply a default transition, you can disable that by
 * adding the following to your theme's functions.php:
 *
 * add_filter( 'searchwp_live_search_base_styles', '__return_false' );
 *
 * There is a separate stylesheet that is also enqueued that applies the default
 * results theme (the visual styles) but you can disable that too by adding
 * the following to your theme's functions.php:
 *
 * wp_dequeue_style( 'searchwp-live-search' );
 *
 * You can use ~/searchwp-live-search/assets/styles/style.css as a guide to customize
 */
?>

<?php
global $di_data;
if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<?php $post_type = get_post_type(); ?>
		<div class="searchwp-live-search-result" role="option" id="" aria-selected="false">
			<p><a href="<?php echo esc_url( get_permalink() ); ?>">
                <span class="re-img">
                    <?php if ( has_post_thumbnail()) :  ?>
                        <?php the_post_thumbnail( 'thumbnail' ); ?>
                        <?php else: ?>
                        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/mtumb.png" class="post-tumb"/>
                    <?php endif; ?>
                </span>
                <span class="re-desc">
                <span class="re-title"><?php the_title(); ?></span>
                <?php
                $product = new WC_Product(get_the_ID());
                $in_stock = $product->is_in_stock(); ?>
                <?php if($in_stock) { ?>
                    <span class="re-price">
                    <?php echo $product->get_price_html(); ?>
                    </span>
                <?php } else { ?>
                    <span class="re-nstock">
                    <?php _e( 'ناموجود', 'studiare' ); ?>
                    </span>
                <?php } ?>
                </span>
			</a></p>
		</div>
    <?php endwhile; ?>
<span class="search-result-more" onclick="document.getElementById('head-search').submit();">
<?php _e('مشاهده همه نتایج', 'studiare') ?>
<i class="fal fa-chevron-left" aria-hidden="true"></i>
</span>
<?php else : ?>
	<p class="searchwp-live-search-no-results" role="option">
		<?php echo __('نتیجه ای پیدا نشد!','studiare'); ?>
	</p>
<?php endif; ?>
