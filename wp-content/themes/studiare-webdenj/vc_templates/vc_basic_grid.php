<?php
if (!defined('ABSPATH'))
{
    die('-1');
}
/**
 * Shortcode attributes
 * @var $atts array
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Basic_Grid
 */
$this->post_id = false;
$this->items = array();
$css = $el_class = '';
$posts = $filter_terms = array();
$this->buildAtts($atts, $content);

$css = isset($atts['css']) ? $atts['css'] : '';
$el_class = isset($atts['el_class']) ? $atts['el_class'] : '';

$class_to_filter = 'vc_grid-container vc_clearfix wpb_content_element ' . $this->shortcode;
$class_to_filter .= vc_shortcode_custom_css_class($css, ' ') . $this->getExtraClass($el_class);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);

wp_enqueue_script('prettyphoto');
wp_enqueue_style('prettyphoto');

if ('true' === $this->atts['btn_add_icon'])
{
    vc_icon_element_fonts_enqueue($this->atts['btn_i_type']);
}

$this->buildGridSettings();
if (isset($this->atts['style']) && 'pagination' === $this->atts['style'])
{
    wp_enqueue_script('twbs-pagination');
}
if (!empty($atts['page_id']))
{
    $this->grid_settings['page_id'] = (int) $atts['page_id'];
}
$this->enqueueScripts();

$animation = isset($this->atts['initial_loading_animation']) ? $this->atts['initial_loading_animation'] : 'zoomIn';

$wrapper_attributes = array();
// Used for preload first page
if (!vc_is_page_editable())
{
    if (in_array($this->atts['style'], array(
                'load-more',
                'lazy',
                'all',
            )) && in_array($this->settings['base'], array('vc_basic_grid')))
    {
        $this->atts['max_items'] = 'all' === $this->atts['style'] || $this->atts['items_per_page'] > $this->atts['max_items'] ? $this->atts['max_items'] : $this->atts['items_per_page'];
        $this->buildItems();
    }
}

if (!empty($atts['el_id']))
{
    $wrapper_attributes[] = 'id="' . esc_attr($atts['el_id']) . '"';
}

if (defined('HTQ_SLUG') && $this->atts['post_type'] == 'test')
{
    //test_tag
    if (!empty($this->atts['taxonomies']))
    {

        $terms = explode(',', $this->atts['taxonomies']);
        if (count($terms) > 1)
        {
            $tax_query = array(
                'relation' => 'OR',
                array(
                    'taxonomy' => 'test_category',
                    'field' => 'term_id',
                    'terms' => $terms,
                    'operator' => 'IN'),
                array(
                    'taxonomy' => 'test_tag',
                    'field' => 'term_id',
                    'terms' => $terms,
                    'operator' => 'IN')
            );
        } else
        {
            $tax_query = array(
                'relation' => 'OR',
                array(
                    'taxonomy' => 'test_category',
                    'field' => 'term_id',
                    'terms' => $this->atts['taxonomies'],
                ),
                array(
                    'taxonomy' => 'test_tag',
                    'field' => 'term_id',
                    'terms' => $this->atts['taxonomies'],
                )
            );
        }

        $quer_arg = array(
            'post_type' => 'test',
            'post_status' => 'publish',
            'order' => $this->atts['order'],
            'orderby' => $this->atts['orderby'],
            'posts_per_page' => $this->atts['items_per_page'],
            'tax_query' => $tax_query,
        );
    } else
    {
        $quer_arg = array(
            'post_type' => 'test',
            'post_status' => 'publish',
            'order' => $this->atts['order'],
            'orderby' => $this->atts['orderby'],
            'posts_per_page' => $this->atts['items_per_page'],
        );
    }



    global $test_query;
    $test_query = new WP_Query($quer_arg);
    $columns = 'three';
    switch ($this->atts['element_width'])
    {
        case 12:
            $columns = 'one';
            break;
        case 6:
            $columns = 'two';
            break;
        case 4:
            $columns = 'three';
            break;
        case 3:
            $columns = 'four';
            break;
        case 2:
            $columns = 'six';
            break;
    }

    $css_class = "blog-loop-inner blog-loop-view-grid {$columns}-columns";
    ?>
    <div class="<?php echo esc_attr($css_class) . vc_shortcode_custom_css_class($css, ' '); ?>">

    <?php if ($test_query->have_posts()) : $i = 0; ?>

        <?php while ($test_query->have_posts()) : $test_query->the_post(); ?>
            <?php
            get_template_part('/inc/templates/blog/grid-postbit', 'test');
            ?>

                <?php
            endwhile;
        else :
            ?>

            <?php get_template_part('/inc/templates/not-found'); ?>

        <?php endif; ?>

    </div>

        <?php
        wp_reset_postdata();
    } else
    {
        ?><!-- vc_grid ham3da start -->
    <div class="vc_grid-container-wrapper vc_clearfix" <?php echo implode(' ', $wrapper_attributes); ?>>
        <div class="<?php echo esc_attr($css_class) ?>" data-initial-loading-animation="<?php echo esc_attr($animation); ?>" data-vc-<?php echo esc_attr($this->pagable_type); ?>-settings="<?php echo esc_attr(json_encode($this->grid_settings)); ?>" data-vc-request="<?php echo esc_attr(apply_filters('vc_grid_request_url', admin_url('admin-ajax.php'))); ?>" data-vc-post-id="<?php echo esc_attr(get_the_ID()); ?>" data-vc-public-nonce="<?php echo vc_generate_nonce('vc-public-nonce'); ?>">
    <?php
    // preload first page
    echo $this->renderItems();
    ?>
        </div>
    </div><!-- vc_grid end ham3da -->
            <?php
        }
