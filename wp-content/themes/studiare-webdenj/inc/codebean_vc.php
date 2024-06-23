<?php

// If its not active disable these functions
$active_plugins = apply_filters('active_plugins', get_option('active_plugins'));

if (is_array($active_plugins) && !in_array('js_composer/js_composer.php', $active_plugins) && function_exists('vc_map') == false) {
    return;
} else if (function_exists('vc_map') == false) {
    return;
}

// Set Visual Composer As Theme Mode
function codebean_visual_composer_init() {
    vc_set_as_theme();
}

add_action('vc_before_init', 'codebean_visual_composer_init');

// Default Post Types
function codebean_vc_default_post_types() {

    if (function_exists('vc_set_default_editor_post_types')) {
        $list = array('page', 'portfolio');
        vc_set_default_editor_post_types($list);
    }
}

add_action('vc_before_init', 'codebean_vc_default_post_types');

// Support for Shortcodes
$codebean_vc_templates_path = get_parent_theme_file_path('inc/lib/vc/');

$codebean_vc_shortcodes = array(
    // Other
    'cdb_course_categories',
    'cdb_button',
    'cdb_icon_boxes',
    'cdb_icon_boxes_2',
    'cdb_animated_counter',
    'cdb_section_heading',
    'cdb_featured_courses',
    'cdb_courses_carousel',
    'cdb_blog_carousel',
    'cdb_video_banner',
    'cdb_events_list',
    'cdb_blog_posts',
    'cdb_blog_metro',
    'cdb_testimonials',
    'cdb_pricing_table',
    'cdb_course_lessons',
    'cdb_clients',
    'cdb_portfolio',
    'cdb_teachers_grid',
    'cdb_teacher_detail',
    'cdb_gallery_carousel',
    'cdb_box_content',
    'cdb_box_content_posts',
    'cdb_countdown_timer',
    'cdb_social_networks',
    'cdb_google_map',
    'cdb_std_counter',
    "cdb_blog_tests",
    'cdb_test_carousel'
);

foreach ($codebean_vc_shortcodes as $shortcode_template) {
    require_once $codebean_vc_templates_path . $shortcode_template . '/map.php';
}
