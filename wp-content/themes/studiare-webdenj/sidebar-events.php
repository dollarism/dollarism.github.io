<?php
/**
 * The Sidebar containing widgets on events page
 *
 */

if ( ! is_active_sidebar( 'sidebar_events' ) ) {
	return;
}
?>

<div class="main-sidebar-holder">
	<div class="sidebar-widgets-wrapper">
		<?php if ( ! dynamic_sidebar( 'sidebar_events' ) ) :
			dynamic_sidebar( 'sidebar_events' );
		endif; ?>
	</div>
</div>
