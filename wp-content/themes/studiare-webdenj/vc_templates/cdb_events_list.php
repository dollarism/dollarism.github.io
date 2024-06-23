<?php

// Atts
if ( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );

$paged = get_query_var( 'paged', 1 );

$events = new WP_Query( array( 'post_type' => 'tp_event', 'posts_per_page' => $per_page ,'paged' => $paged ) );

?>
<?php if ( $events->have_posts() ) : ?>
    <div class="events-archive">
        <?php while($events->have_posts()): $events->the_post(); ?>
            <div id="event-<?php the_ID(); ?>" <?php post_class( 'studiare-event-item' ); ?>>
                <div class="studiare-event-item-holder">
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
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
