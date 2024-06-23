<?php
/**
 * Download box links
 */
$prefix = '_studiare_';
 $link_title_1 = get_post_meta(get_the_ID(), $prefix . 'link_title_1', true);
 $link_title_2 = get_post_meta(get_the_ID(), $prefix . 'link_title_2', true);
 $link_title_3 = get_post_meta(get_the_ID(), $prefix . 'link_title_3', true);
 $link_title_4 = get_post_meta(get_the_ID(), $prefix . 'link_title_4', true);
 $link_title_5 = get_post_meta(get_the_ID(), $prefix . 'link_title_5', true);

 $link_url_1 = get_post_meta(get_the_ID(), $prefix . 'link_url_1', true);
 $link_url_2 = get_post_meta(get_the_ID(), $prefix . 'link_url_2', true);
 $link_url_3 = get_post_meta(get_the_ID(), $prefix . 'link_url_3', true);
 $link_url_4 = get_post_meta(get_the_ID(), $prefix . 'link_url_4', true);
 $link_url_5 = get_post_meta(get_the_ID(), $prefix . 'link_url_5', true);

?>


<?php if ( !empty($link_title_1) ) : ?>
  <a href="<?php echo ($link_url_1); ?>"><i class="fa fa-download"></i><?php echo ($link_title_1); ?></a>
<?php endif; ?>

<?php if ( !empty($link_title_2) ) : ?>
  <a href="<?php echo ($link_url_2); ?>"><i class="fa fa-download"></i><?php echo ($link_title_2); ?></a>
<?php endif; ?>

<?php if ( !empty($link_title_3) ) : ?>
  <a href="<?php echo ($link_url_3); ?>"><i class="fa fa-download"></i><?php echo ($link_title_3); ?></a>
<?php endif; ?>

<?php if ( !empty($link_title_4) ) : ?>
  <a href="<?php echo ($link_url_4); ?>"><i class="fa fa-download"></i><?php echo ($link_title_4); ?></a>
<?php endif; ?>

<?php if ( !empty($link_title_5) ) : ?>
  <a href="<?php echo ($link_url_5); ?>"><i class="fa fa-download"></i><?php echo ($link_title_5); ?></a>
<?php endif; ?>

<?php
 $entries = get_post_meta( get_the_ID(), 'download_group', true );

if ( $entries ) {
		  foreach (  $entries as $key => $entry ) { ?>
        <a href="<?php echo esc_html( $entry[$prefix . 'link_download_title_more'] ); ?>"><i class="fa fa-download"></i><?php echo esc_html( $entry[$prefix . 'download_title_more'] ); ?></a>

<?php }
		} ?>
