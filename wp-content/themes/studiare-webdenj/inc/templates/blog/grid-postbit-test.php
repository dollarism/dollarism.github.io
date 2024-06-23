<?php
if (!defined('HTQ_SLUG'))
{
    return;
}

$blog_grid_columns = 'two';
if (class_exists('Redux'))
{
    $blog_grid_columns = codebean_option('blog_grid_columns');
    $blog_thumbnails_size = codebean_option('blog_thumbnails_size');
    $blog_desc_text = codebean_option('blog_desc_text');
}

$categories = get_the_terms(get_the_ID(), "test_category");


$user_id = get_current_user_id();

$test_price = htq_get_test_price(get_the_ID());
$is_payed = htq_is_payed($user_id, get_the_ID());
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post type-post'); ?>>
    <div class="post-inner">
        <?php if (has_post_thumbnail()) : ?>
            <div class="post-thumbnail">
                <a href="<?php the_permalink(); ?>">

                    <?php if ($blog_thumbnails_size == 'square') : ?>
                        <?php the_post_thumbnail('studiare-image-400x400-croped'); ?>
                    <?php elseif ($blog_thumbnails_size == 'rectangle') : ?>
                        <?php the_post_thumbnail('studiare-image-420x294-croped'); ?>
                    <?php endif; ?>

                </a>
            </div>
        <?php endif; ?>
        <div class="post-content">
            <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <p class="subs_box">
                <?php
                echo '<b>' . __('Subscription status:', 'htq') . '</b>';

                if ($test_price > 0 && $is_payed)
                {
                    echo '<span class="test-buyed"> ' . __('Subscribed', 'htq') . ' <i class="fa fa-check-square-o" aria-hidden="true"></i></span>';
                } else
                {
                    if ($test_price > 0)
                    {
                        echo '<span class="test-not-buyed"> ' . __('Not subscribed', 'htq') . ' <i class="fa fa-clock-o" aria-hidden="true"></i></span>';
                    } else
                    {
                        echo '<span class="test-buyed"> اشتراک رایگان <i class="fa fa-check-square-o" aria-hidden="true"></i></span>';
                    }
                }
                ?>
            </p>
            <p class="price_box">
                <span class="price_value"><?php echo $test_price > 0 ? htq_format_money($test_price) : __('Free', 'htq'); ?></span> 
                <span class="currency"><?php echo $test_price > 0 ? htq_currency_symbole() : '' ?>
                </span>
            </p>

            <?php
            $check_pay_mark = '<i class="fa fa-check" aria-hidden="true"></i>'; //<i class="fa fa-star" aria-hidden="true"></i>
            $text_btn = __('Take a test', 'htq');

            $run_count = get_run_test_count($user_id, get_the_ID(), '1');
            $link_href = get_permalink();
            $link_style = "";

            if (intval($run_count) > 0)
            {
                $link_href = "";
                $link_style = "pointer-events: none;";
                $link_title = __("You have tried", 'htq');
                $text_btn = $link_title;
            }
            ?>
        </div>
        <div class="read_more_btn">
            <a class="read_more <?php echo empty($link_href) ? 'disabled' : ''; ?>" href="<?php echo $link_href ?>" style="<?php $link_style ?>"><?php echo $text_btn . '&nbsp;' . $check_pay_mark ?></a>
        </div>
    </div>
</article>