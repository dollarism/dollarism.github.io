<?php
/**
 * Template for displaying search forms in Studiare
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<span class="screen-reader-text"><?php echo esc_html__( 'Search for:', 'studiare' ) ?></span>
	<input type="search" class="search-field"
	       placeholder="<?php echo esc_attr__( 'Enter keyword...', 'studiare' ) ?>"
	       value="<?php echo get_search_query() ?>" name="s"
	       title="<?php echo esc_attr__( 'Search for:', 'studiare' ) ?>" />
	<button type="submit" class="search-submit"><?php get_template_part('/assets/images/search-icon.svg'); ?></button>
</form>