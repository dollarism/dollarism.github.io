<?php
$separate_meta = esc_html__( ' ، ', 'studiare' );
$categories_list = get_the_category_list( $separate_meta );
?>

				<div class="post-meta date"><i class="fal fa-clock"></i><?php echo get_the_date(); ?></div>
				<div class="post-meta author">
                    <i class="fal fa-user-alt"></i>
					<?php esc_html_e('Posted by', 'studiare'); ?>
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php echo get_the_author(); ?></a>
				</div>
				<div class="post-meta category">
                    <i class="fal fa-folders"></i>
					<?php echo wp_kses_post( $categories_list ); ?>
				</div>
				<div class="post-meta hit">
                    <i class="fal fa-eye"></i>
					<?php
				global $post;
$visitor_count = get_post_meta( $post->ID, '_post_views_count', true);
if( $visitor_count == '' ){ $visitor_count = 0; }
if( $visitor_count >= 1000 ){
	$visitor_count = round( ($visitor_count/1000), 2 );
	$visitor_count = $visitor_count.'k';
}
echo esc_attr($visitor_count);
echo ' بازدید';

?>
				</div>
