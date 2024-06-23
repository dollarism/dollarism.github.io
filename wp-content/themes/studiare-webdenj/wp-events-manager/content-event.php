<?php
/**
 * The template for displaying room content event in room page.
 *
 * Override this template by copying it to yourtheme/wp-events-manager/content-event.php
 *
 * @version     2.1
 * @package     WPEMS/Templates
 * @category    Templates
 * @author      Thimpress, leehld
 */

/**
 * Prevent loading this file directly
 */

defined( 'ABSPATH' ) || exit;

/**
 * tp_event_before_loop_event hook
 *
 */
do_action( 'tp_event_before_loop_event' );
?>

<?php
if ( post_password_required() ) {
	echo get_the_password_form();

	return;
}
?>

	<div id="event-<?php the_ID(); ?>" <?php post_class( 'studiare-event-item' ); ?>>
        <div class="studiare-event-item-holder">

            <?php
            /**
             * tp_event_before_loop_event_summary hook
             *
             * @hooked tp_event_show_event_sale_flash - 10
             * @hooked tp_event_show_event_images - 20
             */
            do_action( 'tp_event_before_loop_event_item' );
            ?>

            <div class="event-inner-content">

                <div class="top-part">

                    <div class="date-holder">
                        <div class="date">
                            <span class="date-day"><?php echo( wpems_event_start( 'd' ) ); ?></span>
                            <span class="date-month"><?php echo( wpems_event_start( 'M' ) ); ?></span>
                        </div>
                    </div>

                    <div class="content">
                        <div class="event-meta">
                        <span class="event-meta-piece start-time">
							<i class="material-icons">access_time</i> <?php echo( wpems_event_start( 'g:i a' ) ); ?> - <?php echo( wpems_event_end( 'g:i a' ) ); ?>
						</span>
			                <?php if ( wpems_event_location() ) { ?>
                                <span class="event-meta-piece location">
								<i class="material-icons">location_on</i> <?php echo( wpems_event_location() ); ?>
							</span>
			                <?php } ?>
                        </div>
                        <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    </div>

                </div> <!-- /.top-part -->

	            <?php if ( has_post_thumbnail() ) : ?>
                    <div class="event-thumbnail">
                        <?php do_action( 'tp_event_single_event_thumbnail' ); ?>
                    </div>
	            <?php endif; ?>

            </div>

            <?php
            /**
             * tp_event_after_loop_event_item hook
             *
             * @hooked tp_event_show_event_sale_flash - 10
             * @hooked tp_event_show_event_images - 20
             */
            do_action( 'tp_event_after_loop_event_item' );
            ?>

        </div>

	</div>

<?php do_action( 'tp_event_after_loop_event' ); ?>