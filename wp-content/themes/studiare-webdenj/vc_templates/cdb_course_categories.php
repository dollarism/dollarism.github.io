<?php

// Atts
if ( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );

$hide_empty = ( $hide_empty == true && $hide_empty == 1 ) ? 1 : 0;

$args = array(
    'orderby'    => 'title',
    'order'      => $order,
    'hide_empty' => $hide_empty,
    'pad_counts' => true,
);

$product_categories = get_terms( 'product_cat', $args );

if ( $parent == "0" ) {
	$product_categories = wp_list_filter( $product_categories, array( 'parent' => $parent ) );
}

if ( $hide_empty ) {
	foreach ( $product_categories as $key => $category ) {
		if ( $category->count == 0 ) {
			unset( $product_categories[ $key ] );
		}
	}
}

if ( $number ) {
	$product_categories = array_slice( $product_categories, 0, $number );
}

$cat_counter = 0;

$cat_number = count($product_categories);

if ( $product_categories ) : ?>

    <div class="course-categories">

        <?php foreach ( $product_categories as $category ) {

	        $thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
	        $image = wp_get_attachment_url( $thumbnail_id );
            $cat_class = "";
            $cat_counter++;

            switch ($cat_number) {
                default:
                    if ($cat_counter < 6) {
                        $cat_class = $cat_counter;
                    } else {
                        $cat_class = "default";
                    }
            }

        ?>
        <div class="course-grid-box course_cat_<?php echo esc_attr( $cat_class ); ?>">
            <div class="category-holder">
                <div class="category-holder-inner">
                    <a href="<?php echo esc_url( get_term_link( $category->slug, 'product_cat' ) ); ?>" class="category_link"></a>
                    <span class="category-bg" style="background-image:url(<?php echo esc_url($image); ?>)"></span>
                    <div class="info-on-hover">
                        <h4 class="category-title"><a href="<?php echo esc_url( get_term_link( $category->slug, 'product_cat' ) ); ?>"><?php echo esc_html($category->name); ?></a></h4>
                        <span class="category-count"><?php echo sprintf( _n( '%s Course', '%s Courses', $category->count, 'studiare' ), $category->count ); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <?php } ?>

    </div>

<?php endif; ?>