<?php

/**
 * Prepare CSS selectors for theme settions (colors, borders, typography etc.)
 */

return apply_filters( 'goseowp_codebean_get_selectors', array(

	'primary_color' => array(

		'color' => studiare_text2line( '.breadcrumbs a:hover, .woocommerce-breadcrumb a:hover, .comment-content a, a.testimonial-video .fal, .sidebar-widgets-wrapper .widget_nav_menu ul li.current-menu-item a, .button_download .link-not, .amarbox i, .highlight, .pricing-table .pricing-price, .course-section .panel-group .course-panel-heading:hover .panel-heading-left .course-lesson-icon i, .course-section .panel-group .course-panel-heading.active .panel-heading-left .course-lesson-icon i, .countdown-timer-holder.standard .countdown-unit .number, .studiare-event-item .studiare-event-item-holder .event-inner-content .event-meta .event-meta-piece i, .event-single-main .event-meta-info .box-content .icon, .countdown-amount, .products .course-item .course-item-inner .course-content-holder .course-content-bottom .course-price, .product_list_widget li > .amount, .product_list_widget li ins .amount, .amarboxim h3' ),

		'background-color' => studiare_text2line( '.header-category-menu .header-category-dropdown-wrap ul li:hover > a, .pelleh-podcast .mejs-controls .mejs-time-rail .mejs-time-current, .blog-slider__pagination .swiper-pagination-bullet-active, .mini-cart-opener .studiare-cart-number, .download-filter ul li.select-cat, .ajax-search-form button, .site-header-inner span.digits-login-modal, .footer-widgets .widget-title:before, .blog-posts .row>div.first-post a .blog-posts-inner .category ul li:before, .blog-posts .row>div a:hover:after, .button_download .link-not:hover, .box_download span, .box_help span, .sidebar-widgets-wrapper .widget_nav_menu ul li:hover:before, .amarleft, .sk-cube-grid .sk-cube, .login-user:before, .main-sidebar-holder .widget .widget-title:before, .page-pagination > span, .btn-filled, .top-bar-cart .dropdown-cart .woocommerce-mini-cart__buttons a:first-child, input[type="button"], input[type="reset"], input[type="submit"], .button, .button-secondary, .woocommerce_message .button, .woocommerce-message .button, .studiare-social-links.rounded li a.custom:hover, ul.page-numbers .page-numbers.current, ul.page-numbers .page-numbers:hover, .page-numbers.studiare_wp_link_pages > .page-number, .studiare-event-item .studiare-event-item-holder .event-inner-content .date-holder .date:before, .studiare-event-item .studiare-event-item-holder .event-inner-content .date-holder .date:after, .product-reviews .product-review-title .inner:after, .product-reviews-stats .detailed-ratings .detailed-ratings-inner .course-rating .bar .bar-fill, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle, .owl-dots .owl-dot.active span, .double-bounce1, .double-bounce2, .wmt-smart-tabs ul.wmt-tabs-header a:after, .wmt-pagination a.next-visible:hover, .wmt-pagination a.previous-visible:hover, .post-inner:hover a.read_more, .ltx-overlay-main-waves, .widget_categories ul li:hover:before, ul.product-categories li:hover:before, ul.product_list_widget li:hover:before, .widget_nav_menu ul li:hover:before, h4.article-box-title:before, .studiare-navigation ul.menu>li ul li>a:hover, .studiare-navigation .menu>ul>li ul li>a:hover' ),

		'border-color' => studiare_text2line( '.button_download .link-not, ul.menu .emallshop-megamenu-wrapper, .studiare-social-links.rounded li a.custom:hover, .studiare-event-item .studiare-event-item-holder .event-inner-content .date-holder .date' ),

		'border-bottom-color' => studiare_text2line( '.studiare-navigation ul.menu li.emallshop-megamenu-menu:before' )
	),

	'secondary_color' => array(

		'color' => studiare_text2line( 'a:hover, .product-single-content a, .blog-loop-inner.post-single .entry-content a, .article_related ul li:hover h6, .top-bar-cart .dropdown-cart .cart-item-content .product-title:hover, .btn-border, .studiare-navigation ul.menu li.current_page_item>a, .studiare-navigation ul.menu li.current-menu-ancestor>a, .studiare-navigation ul.menu li.current-menu-parent>a, .studiare-navigation ul.menu li.current-menu-item>a, .studiare-navigation .menu>ul li.current_page_item>a, .studiare-navigation .menu>ul li.current-menu-ancestor>a, .studiare-navigation .menu>ul li.current-menu-parent>a, .studiare-navigation .menu>ul li.current-menu-item>a .event-single-side a.event_register_submit, .event_register_submit, .cart-page-inner .woocommerce-cart-form td.actions .button_update_cart, .cart-collaterals .shop_table tr.shipping .button, .btn-link, .course-section .panel-group .panel-content a, .cart-collaterals .shop_table tr.shipping .shipping-calculator-button, .not-found .not-found-icon-wrapper .error-page, .products .course-item .course-item-inner .course-content-holder .course-content-main .course-rating-teacher .course-loop-teacher, .product-single-main .product-single-top-part .before-gallery-unit .icon, .bbpress #bbpress-forums .bbp-author-name, .blog-loop-inner .post.sticky .entry-title a, .page .commentlist .comment .reply .comment-reply-link, .single-post .commentlist .comment .reply .comment-reply-link, .page .commentlist .comment .vcard .fn a:hover, .single-post .commentlist .comment .vcard .fn a:hover, .leading button' ),

		'background-color' => studiare_text2line( '.widget_tag_cloud .tag-cloud-link, .cart-top-bar .off-canvas-cart .cart-icon-link .studiare-cart-number, .off-canvas-navigation .off-canvas-cart .cart-icon-link .studiare-cart-number, .back-to-top:hover, .btn-border:hover, .event-single-side a.event_register_submit:hover, .event_register_submit:hover, .cart-page-inner .woocommerce-cart-form td.actions .button_update_cart:hover, .cart-collaterals .shop_table tr.shipping .button:hover, .course-section .panel-group .course-panel-heading .preview-button, .partners-logos .partner-logo-item .partner-logo-inner .hover-mask:after, .portfolio-entry .portfolio-entry-thumb .overlay-icon, .portfolio-list-cat ul li a.mixitup-control-active, .courses-holder .courses-top-bar .layout-switcher > a.active, .select2-container--default .select2-selection--single:hover, .select2-container--default.select2-container--open.select2-container--above .select2-selection--single, .select2-container--default.select2-container--open.select2-container--below .select2-selection--single' ),

		'border-color' => studiare_text2line( '.btn-border, .event-single-side a.event_register_submit, .event_register_submit, .cart-page-inner .woocommerce-cart-form td.actions .button_update_cart, .cart-collaterals .shop_table tr.shipping .button, .portfolio-list-cat ul li a.mixitup-control-active, .courses-holder .courses-top-bar .layout-switcher > a.active, .select2-container--default .select2-selection--single:hover, .select2-container--default.select2-container--open.select2-container--above .select2-selection--single, .select2-container--default.select2-container--open.select2-container--below .select2-selection--single, .blog-loop-inner .post.sticky .entry-title a' )
	),

	'header_text_color' => array(

		'color' => studiare_text2line( '.page-title .title-page, .woocommerce-breadcrumb, .breadcrumbs, .woocommerce-breadcrumb a, .breadcrumbs a' ),

	),

	'vertical_menu_color' => array(

		'background-color' => studiare_text2line( '.categories-menu-link, .categories-menu-navigation:before, .categories-menu-navigation>ul>li, .categories-menu-navigation>ul>li>a' ),

	),

	'vertical_menu_color2' => array(

		'background-color' => studiare_text2line( '.categories-menu-navigation>ul>li>a:hover, .categories-menu-navigation>ul>li.active>a, .categories-menu-navigation[data-action=hover]>ul>li:hover>a, .categories-menu-navigation' ),

	),


) );
