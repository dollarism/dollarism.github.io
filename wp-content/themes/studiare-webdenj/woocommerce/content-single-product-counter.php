<?php



?>

<div class="product-info-box">

	<div class="std-box-view">
<?php
	global $post;
	$visitor_count = get_post_meta( $post->ID, '_post_views_count', true);
	if( $visitor_count == '' ){ $visitor_count = 0; }
	if( $visitor_count >= 1000 ){
	$visitor_count = round( ($visitor_count/1000), 2 );
	$visitor_count = $visitor_count.'k';
	}
	echo '<span class="product-views">';
	echo '<i class="fal fa-eye"></i> ';
	echo esc_attr($visitor_count);
	echo ' بازدید';
	echo '</span>';

?>
<?php
global $product;

$rating_count = $product->get_rating_count();
$review_count = get_comments_number();
$average      = $product->get_average_rating();

echo '<span class="product-reviews-count">';
echo '<i class="fal fa-comments-alt"></i> ';
echo esc_attr($review_count);
echo ' دیدگاه';
echo '</span>';
?>

	</div>


</div>
