<?php
if (!defined('HTQ_SLUG'))
{
    return;
}

/**
 * The template for displaying inner content on single posts
 */
$separate_meta = esc_html__(', ', 'studiare');

// Get Categories for posts.
$categories_list = get_the_term_list(get_the_ID(), 'test_category', '', $separate_meta, '');

// Get Tags for posts.
$tags_list = get_the_term_list(get_the_ID(), 'test_tag', '', $separate_meta, '');

$blog_post_share = false;
$article_author = true;
$blog_related = true;
$blog_featured_img = true;

if (class_exists('Redux'))
{
    $blog_post_share = codebean_option('blog_share_story');
    $article_author = codebean_option('article_author');
    $blog_share_story = codebean_option('blog_share_story');
    $blog_related = codebean_option('blog_related');
    $blog_meta_data = codebean_option('blog_meta_data');
    $blog_featured_img = codebean_option('blog_featured_img');
}

$user_id = get_current_user_id();
$test_id = get_the_ID();
$test_questions_link = htq_get_page('test_questions');
$test_pay = htq_get_page('test_pay');
?>
<article style="padding: 0;" id="post-<?php the_ID(); ?>" <?php post_class('post type-post'); ?> role="article">
    <?php
    while (have_posts()) : the_post();

        $test_tilte = single_post_title('', false);
        $test_price = htq_get_test_price($test_id);
        ?>

        <div class="post-inner">

            <header class="entry-header">
                <?php
                the_title('<h1 class="entry-title">', '</h1>');
                ?>
                <?php if ($blog_meta_data) : ?>
                    <?php
                    //get_template_part('/inc/templates/blog/blog-meta-data', 'test'); 
                    ?>
                <?php endif; ?>

            </header>
            <?php if ($blog_featured_img) : ?>
                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail">
                        <?php echo the_post_thumbnail('full'); ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <div class="entry-content">
                <?php
                the_content();

                $test_ids_str = get_post_meta($test_id, 'test_ids', true);
                $test_ids = array();
                if (!empty($test_ids_str))
                {
                    $test_ids = explode(',', $test_ids_str);
                }

                if (!empty($test_ids_str))
                {
                    $all_books = get_list_of_books2($test_ids_str, 1);
                } else
                {
                    $all_books = array();
                }

                if ($all_books != null && count($all_books) > 0)
                {

                    if (count($all_books) == 1)
                    {
                        $colomn = "one";
                    } elseif (count($all_books) == 2)
                    {
                        $colomn = "two";
                    } else
                    {
                        $colomn = "three";
                    }


                    /* Start the Loop */
                    ?>
                    <div class="wpb_wrapper">
                        <br>
                        <h4><i class="fa fa-book"></i>&nbsp; <?= __("Test Books", 'htq') ?></h4><br>

                        <div class="blog-loop-inner blog-loop-view-grid <?php echo $colomn ?>-columns">
                            <?php
                            /////////////////////////

                            $test_price = htq_get_test_price($test_id);

                            $test_des = ($post->post_content);

                            $run_count = get_run_test_count($user_id, $test_id, '1');
                            $is_payed = htq_is_payed($user_id, $test_id);


                            $link_href = "";

                            if (!$is_payed && $test_price > 0)
                            {
                                $check_pay_mark = ' <i class="fa fa-credit-card" aria-hidden="true"></i>';
                                $text_btn = __('Purchase subscription', 'htq');

                                $test_pay_link = htq_get_pay_url($test_id);

                                $link_href = $test_pay_link;
                            } else
                            {
                                $check_pay_mark = '<i class="fa fa-check" aria-hidden="true"></i>'; //<i class="fa fa-star" aria-hidden="true"></i>
                                $text_btn = __('Start the test', 'htq');
                                $link_href = add_query_arg(array('start-test' => 1), get_permalink());
                            }


                            if (intval($run_count) > 0)
                            {
                                $link_href = "";
                                $link_style = "pointer-events: none;";
                                $link_title = __("You have tried", 'htq');
                                $text_btn = $link_title;
                            } else
                            {
                                $link_style = "";
                            }

                            foreach ($all_books as $book)
                            {
                                $count_to_load = $book->ql_count;
                                $total_q = get_question_count2($book->id, 1);
                                ?>
                                <div id="book-<?php echo $book->id; ?>" class="post test-book book-<?php echo $book->id ?>">
                                    <div class="post-inner post-inner2">
                                        <div class="post-thumbnail">
                                            <a title="<?php echo $link_title ?>" 
                                               href="<?php echo $link_href ?>">
                                                <img src="<?php echo $book->image ?>" class="attachment-studiare-image-420x294-croped size-studiare-image-420x294-croped" 
                                                     alt="" sizes="(max-width: 420px) 100vw, 420px" width="420" height="294">
                                            </a>
                                        </div>

                                        <div class="post-content">
                                            <h2 class="entry-title"><a href="<?php echo $link_href ?>"><?php echo $book->Name ?></a></h2>
                                            <?php echo stripslashes(html_entity_decode($book->description)) ?>

                                            <div class="details">

                                                <i class="fa fa-th-list" aria-hidden="true"></i>
                                                <?php
                                                printf(_n('%s question', '%s questions', $count_to_load, 'htq'), $count_to_load);
                                                ?>
                                                &nbsp;&nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i>
                                                <?php
                                                $second_per_q = intval($book->second_pq);
                                                $all_seconds = $second_per_q * $count_to_load;
                                                $time = htq_format_time($all_seconds);
                                                printf(__('Time: %s', 'htq'), $time);
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                            <p style="width: 100%; text-align: center; margin-right: 15px; margin-left: 15px;" class="test_btn_div">

                                <a style="color: white; position: relative; height: 50px; display: block; overflow: hidden;width: 100%;" class="woocommerce-Button button <?php echo empty($link_href) ? 'disabled' : ''; ?>" href="<?php echo $link_href ?>"><?php echo $text_btn . '&nbsp;' . $check_pay_mark ?></a>

                            </p>
                        </div>
                    </div>
                    <?php
                }
                wp_link_pages(array(
                    'before' => '<div class="page-pagination"><div class="page-links-title">' . esc_html__('Pages:', 'studiare') . '</div>',
                    'after' => '</div>',
                    'link_before' => '<span>', 'link_after' => '</span>'
                ));
                ?>
            </div>

            <div class="entry-tag-share">
                <?php if ($blog_share_story) : ?>
                    <?php
                    get_template_part('/inc/templates/sharing-blog');
                    ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="post-inner">
            <span class="tagged_as">
                <i class="fal fa-tags"></i>&nbsp;<?php esc_html_e('Tags:', 'studiare'); ?>
                <?php echo wp_kses_post($tags_list); ?>
            </span>
        </div>


        <?php if ($article_author == '1' && get_the_author_meta('description') !== '') : ?>
            <div class="post-inner">
                <div class="post-author-box">
                    <?php
                    $author_bio_avatar_size = apply_filters('goseowp_author_bio_avatar_size', 130);

                    echo get_avatar(get_the_author_meta('user_email'), $author_bio_avatar_size);
                    ?>
                    <div class="author-content">
                        <h5 class="author-title"><?php printf(esc_html__('About %s', 'studiare'), get_the_author()); ?></h5>
                        <p class="author-bio">
                            <?php the_author_meta('description'); ?>
                        </p>
                        <a class="author-link btn btn-border btn-small" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" rel="author">
                            <?php printf(esc_html__('More Posts by %s', 'studiare'), get_the_author()); ?>
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php
        dynamic_sidebar('single_blog_ads');
        ?>

        <?php if ($blog_related) : ?>
            <?php
            get_template_part('/inc/templates/blog/related', 'test');
            ?>
        <?php endif; ?>

    <?php endwhile; ?>
</article>