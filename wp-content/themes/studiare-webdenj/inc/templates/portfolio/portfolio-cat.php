<?php
    $categories = get_terms( 'portfolio_category' );
    if ( ! is_wp_error( $categories ) && ! empty( $categories ) ) { ?>
        <div class="widget widget_categories">
            <h2 class="widget-title"><?php esc_html_e( 'Filter Controls', 'studiare' ); ?></h2>
            <ul class="mixitup-controls">
                <li><a href="#" class="control" data-filter="all"><?php esc_html_e('All', 'studiare'); ?></a></li>
                <?php foreach ($categories as $key => $cateogry) { ?>
                    <li><a href="#" class="control" data-filter=".portfolio-cat-<?php echo esc_attr( $cateogry->slug ); ?>"><?php echo esc_html( $cateogry->name ); ?></a></li>
                <?php } ?>
            </ul>
        </div>
    <?php }
?>

<div class="widget widget_categories">
    <h2 class="widget-title"><?php esc_html_e( 'Sort Control', 'studiare' ); ?></h2>
    <ul class="mixitup-controls">
        <li><a href="#" class="control" data-sort="default"><?php esc_html_e( 'Default', 'studiare' ); ?></a></li>
        <li><a href="#" class="control" data-sort="default:asc"><?php esc_html_e( 'Ascending', 'studiare' ); ?></a></li>
        <li><a href="#" class="control" data-sort="default:desc"><?php esc_html_e( 'Descending', 'studiare' ); ?></a></li>
    </ul>
</div>