<div class="courses-top-bar">

    <div class="courses-top-bar-inner">

        <div class="courses-top-bar-left">
            <div class="layout-switcher switch-courses-layout" data-layout="grid-view">
                <a href="#" class="switcher-view-grid active">
                    <?php get_template_part('assets/images/grid.svg' ); ?>
                </a>
                <a href="#" class="switcher-view-list">
	                <?php get_template_part('assets/images/list.svg' ); ?>
                </a>
            </div>
            <div class="results-count">
                <?php woocommerce_catalog_ordering(); ?>
            </div>
        </div> <!-- end .courses-top-bar-left -->

        <div class="courses-top-bar-right">
            <div class="courses-search">
                <?php get_product_search_form(); ?>
            </div>
        </div> <!-- end .courses-top-bar-right -->

    </div> <!-- end .courses-top-bar-inner -->

</div> <!-- end .courses-top-bar -->