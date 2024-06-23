<?php

if ( ! is_active_sidebar( 'studiare-footer-1' ) ) {
	return;
}

$footer_columns = 'three';

if ( class_exists('Redux') ) {
	$footer_columns = codebean_option( 'footer_columns' );
}

?>
<div class="container">
	<div class="footer-widgets footer-<?php echo esc_attr( $footer_columns ); ?>-col">
		<div class="footer-widgets-inner">

			<?php if ($footer_columns == 'four') { ?>
				<div class="footer-widget-col">
					<?php dynamic_sidebar('studiare-footer-1'); ?>
				</div>
				<div class="footer-widget-col">
					<?php dynamic_sidebar('studiare-footer-2'); ?>
				</div>
				<div class="footer-widget-col">
					<?php dynamic_sidebar('studiare-footer-3'); ?>
				</div>
				<div class="footer-widget-col">
					<?php dynamic_sidebar('studiare-footer-4'); ?>
				</div>
			<?php } else if ($footer_columns == 'three') { ?>
				<div class="footer-widget-col">
					<?php dynamic_sidebar('studiare-footer-1'); ?>
				</div>
				<div class="footer-widget-col">
					<?php dynamic_sidebar('studiare-footer-2'); ?>
				</div>
				<div class="footer-widget-col">
					<?php dynamic_sidebar('studiare-footer-3'); ?>
				</div>
			<?php } else if ($footer_columns == 'two') { ?>
				<div class="footer-widget-col">
					<?php dynamic_sidebar('studiare-footer-1'); ?>
				</div>
				<div class="footer-widget-col">
					<?php dynamic_sidebar('studiare-footer-2'); ?>
				</div>
			<?php } else if ($footer_columns == 'doubleleft') { ?>
				<div class="footer-widget-col double">
					<?php dynamic_sidebar('studiare-footer-1'); ?>
				</div>
				<div class="footer-widget-col">
					<?php dynamic_sidebar('studiare-footer-2'); ?>
				</div>
				<div class="footer-widget-col">
					<?php dynamic_sidebar('studiare-footer-3'); ?>
				</div>
			<?php } else if ($footer_columns == 'doubleright') { ?>
				<div class="footer-widget-col">
					<?php dynamic_sidebar('studiare-footer-1'); ?>
				</div>
				<div class="footer-widget-col">
					<?php dynamic_sidebar('studiare-footer-2'); ?>
				</div>
				<div class="footer-widget-col double">
					<?php dynamic_sidebar('studiare-footer-3'); ?>
				</div>
			<?php } else if ($footer_columns == 'one') { ?>
				<div class="footer-widget-col">
					<?php dynamic_sidebar('studiare-footer-1'); ?>
				</div>
			<?php } ?>

		</div>
	</div>
</div>
