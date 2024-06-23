<?php ?>

<div class="article_related">
    <div class="post-inner">	
        <h5 class="author-title"><?php printf(esc_html__('آزمون‌های زیر را حتماً ببنید', 'studiare'), get_the_author()); ?></h5>
        <ul>
            <?php
            $category__in = wp_get_object_terms(get_the_ID(), 'test_category', array('fields' => 'ids'));



            $args2 = array(
                'post_type' => 'test',
                'exclude'   => array(get_the_ID()),
                'tax_query' => array(
                    array(
                        'taxonomy' => 'test_category',
                        'field'    => 'term_id',
                        'terms'    => $category__in
                    )
                )
            );

            $related = get_posts($args2);


            if ($related)
            {
                foreach ($related as $post)
                {
                    setup_postdata($post);
                    ?>
                    <li class="col-xs-12 col-md-6">
                        <article>
                            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
                                <?php the_post_thumbnail('thumbnail'); ?>
                                <h6><?php the_title(); ?></h6>
                                <p>
                                    <i class="fa fa-eye"></i>
                                    <?php
                                    global $post;
                                    $visitor_count = get_post_meta($post->ID, '_post_views_count', true);
                                    if ($visitor_count == '')
                                    {
                                        $visitor_count = 0;
                                    }
                                    if ($visitor_count >= 1000)
                                    {
                                        $visitor_count = round(($visitor_count / 1000), 2);
                                        $visitor_count = $visitor_count . 'k';
                                    }
                                    echo esc_attr($visitor_count);
                                    echo ' بازدید';
                                    ?>
                                </p>
                            </a>
                        </article>
                    </li>
                    <?php
                }
                wp_reset_postdata();
            }
            ?>
        </ul> 
    </div>
</div>