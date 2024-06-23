<?php
/**
 * The template used for displaying Test Questions
 * @package unified-quiz-maker
 */
if (!defined('ABSPATH'))
{
    die("Access denied!");
}
if (!defined('HTQ_SLUG'))
{
    wp_die(__("Please install the Unified Quiz Maker plugin.", 'htq'), __('Error', 'htq'));
}

global $post;
$user_id = get_current_user_id();
$user = wp_get_current_user();
$test_obj = $post;
$test_id = $test_obj->ID;
/**
 * The header for our theme
 */
get_header();
?>
<div id="page" class="site htq_class">
    <div class="inner-wrapper">
        <div id="content" class="site-content">
            <div class="container">
                <div id="primary" class="content-area-quiz">
                    <main id="main" class="site-main site-content-inner vc-container" role="main">
                        <div class="row">
                            <div class="col-md-10 htq_test_col">
                                <div class="post-wrapper">
                                    <div class="row">
                                        <div id="run_<?php echo get_the_ID() ?>" class="col-md-12">
                                            <?php
                                            $errors = array();
                                            $err_status = false;
                                            if ($test_id)
                                            {
                                                $test = htq_get_test($test_id);
                                                $result = HTQ_Test_Utility::get_test_check_befor_start($test_id);

                                                $errors = $result['errors'];
                                                $err_status = $result['err_status'];
                                                $all_books = $result['all_books'];
                                                $questions_list = $result['questions_list'];
                                                $time_in_second = $result['time_in_second'];
                                                $all_questions_count = $result['all_questions_count'];
                                                $allowed_run = $result['allowed_run'];
                                                $run_count = $result['run_count'];

                                                if ($err_status == false)
                                                {
                                                    //check date limit
                                                    $check_date_limit = HTQ_Test_Utility::check_date_limit($test, $user_id);

                                                    $err_status = $check_date_limit['status'];

                                                    if ($err_status)
                                                    {
                                                        $errors[] = $check_date_limit['error'];
                                                    }

                                                    if ($err_status == false)
                                                    {
                                                        // timer countdown
                                                        $all_seconds = $time_in_second;

                                                        $timer_reasult = htq_start_test_step_timer($test_id, $all_questions_count, $all_seconds);

                                                        $array_metas = $timer_reasult['array_meta'];
                                                        $last_test_id = $timer_reasult['last_test_id'];

                                                        //Get the current timestamp.
                                                        $now = time();
                                                        //Calculate how many seconds have passed since
                                                        //the countdown began.
                                                        $timeSince = $now - $array_metas['time_started'];
                                                        $remainingSeconds = ($array_metas['countdown'] - $timeSince);

                                                        //Check if the countdown has finished.
                                                        if ($remainingSeconds < 1)
                                                        {
                                                            //Finished! Do something.
                                                        }

                                                        ob_start();
                                                        ?>
                                                        <script type="text/javascript">
                                                            jQuery(document).ready(function ()
                                                            {
                                                                window.history.pushState(null, "", window.location.href);
                                                                window.onpopstate = function () {
                                                                    window.history.pushState(null, "", window.location.href);
                                                                };
                                                                htq_clock(<?php echo $remainingSeconds; ?>);
                                                            });
                                                        </script>
                                                        <div class="htq_all_questions htq_class">

                                                            <?php
                                                            $test_result_link = htq_get_page('test_result');
                                                            global $is_test_template;
                                                            if (!isset($is_test_template))
                                                            {
                                                                unset($is_test_template);
                                                                if (!isset($param_shortcode['id']))
                                                                {
                                                                    ?>
                                                                    <haeder class="htq_book_name">
                                                                        <h3 style="text-align: center" class="htq_name">برگزاری آزمون</h3>
                                                                        <h2 class="htq_name"><?php echo $test->get_title(); ?></h2>
                                                                    </haeder>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                            <form id="htq_questions_form" method="POST" action="<?php echo add_query_arg(array('test_id' => $test_id), $test_result_link); ?>">
                                                                <?php
                                                                do_action('htq_quiz_form_start', $test_id);
                                                                ?>
                                                                <input name="action" type="hidden" value="htq_test_run" />
                                                                <input name="test_id" type="hidden" value="<?php echo $test_id ?>" /> 

                                                                <?php
                                                                 $indexing_all = 0;
                                                                foreach ($test->get_books() as $book)
                                                                {
                                                                    $direction_name = $book->get_direction();
                                                                    ?>
                                                                    <div class="books_container">

                                                                        <div class="book-title clearfix"> 
                                                                            <i class="icon-book" aria-hidden="true"></i>
                                                                            <div class="book-title">
                                                                                <h3><?php echo $book->get_title() ?></h3>
                                                                            </div>
                                                                        </div>
                                                                        <style type="text/css">

                                                                            .htq_questions_table
                                                                            {
                                                                                <?php
                                                                                if ($direction_name == "rtl")
                                                                                {
                                                                                    $direction2 = 'direction: rtl; text-align: right;';
                                                                                } elseif ($direction_name == "ltr")
                                                                                {
                                                                                    $direction2 = 'direction: ltr; text-align: left;';
                                                                                }
                                                                                ?>

                                                                            }
                                                                            
                                                                            html[dir="rtl"] .style_rtl .checkmark
                                                                            {
                                                                                right: 0 !important;
                                                                                left: unset !important;
                                                                            } 
                                                                            html .style_ltr .checkmark
                                                                            {
                                                                                right: unset !important;
                                                                                left:0 !important;
                                                                            } 
                                                                        </style>
                                                                        <table class="htq_questions_table dir_<?php echo $direction_name ?>" style="direction: <?php echo $direction_name . '; ' . $direction2 ?>">
                                                                            <?php
                                                                            $index = 0;
                                                                            foreach ($questions_list['book_' . $book->get_id()] as $question)
                                                                            {
                                                                                $indexing_all++;
                                                                                $index = $test->get_indexing_mode() == 1 ? $indexing_all : ($index + 1);
                                                                                $test->draw_question($question, $index, $book->get_id());
                                                                            }
                                                                            ?>
                                                                        </table>
                                                                    </div>
                                                                    <?php
                                                                }
                                                                $answord = 0;
                                                                ?>
                                                                <p>&nbsp;</p>
                                                                <br>



                                                                <div class="htq_btn_bar_floating">

                                                                    <div title="<?php _e('Number of questions and answers', 'htq'); ?>" class="actionbutton btn btn-success htq_qans htq_br-4">
                                                                        <i class="fa fa-check-circle" aria-hidden="true"> </i>
                                                                        <label id="htq_qans_lbl"><?php echo printf(__('%s out of %s', 'htq'), $answord, $all_questions_count) ?></label>
                                                                    </div>

                                                                    <div class="actionbutton btn btn-primary htq_br-4">
                                                                        <i class="fa fa-user-circle" aria-hidden="true"> </i><?php echo $user->user_firstname . ' ' . $user->user_lastname ?>
                                                                    </div>

                                                                    <div class="actionbutton htq_timer">
                                                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                                                        <label id="htq_timer_lbl">00:00:00</label>
                                                                    </div>

                                                                    <button id="htq_submit_test" type="button" class="actionbutton btn btn-filled btn-submit"><i class="fa fa-check" aria-hidden="true"></i>
                                                                        <?php _e('Final Submit', 'htq'); ?>
                                                                    </button>
                                                                </div>
                                                                <?php
                                                                do_action('htq_quiz_form_end', $test_id);
                                                                ?>
                                                            </form>

                                                        </div>
                                                        <?php
                                                        $output = ob_get_clean(); //Get current buffer contents and delete current output buffer
                                                    }
                                                }
                                                if (count($errors) == 0)
                                                {
                                                    $check_num = get_run_test_count($user_id, $test_id, 0);

                                                    if (intval($check_num) == 0 || (intval($run_count) <= $allowed_run || $allowed_run == -1))
                                                    {
                                                        $last_res_id = htq_add_new_parent_result($user_id, $test_id);
                                                    }

                                                    echo HTQ_Test_Utility::start_test_step_js_code($test_id, $all_questions_count);
                                                    echo do_shortcode($output);
                                                } else
                                                {
                                                    echo $errors[0];
                                                    echo '<p><br><br></p>';
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div><!--post-wrapper-->
                            </div>
                        </div>
                    </main><!-- #main -->
                </div><!-- #primary -->
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
