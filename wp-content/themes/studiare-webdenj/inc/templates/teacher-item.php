<?php

$prefix = '_studiare_';

$job_role = get_post_meta( get_the_ID(), $prefix . 'teacher_job_title', true );
$image_id = get_post_thumbnail_id(get_the_ID());
$image_url = wp_get_attachment_image_src($image_id, 'full');

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'teacher-item' ); ?>>
	<div class="teacher-item-inner">
        <span class="teacher-bg" style="background-image: url(<?php echo esc_url($image_url[0]); ?>);"></span>
        <a href="<?php echo esc_url( get_permalink() ); ?>" class="teacher-link"></a>
        <div class="hover-mask">
            <h4 class="teacher-name"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h4>
            <span class="teacher-role"><?php echo esc_attr( $job_role ); ?></span>
        </div>
    </div>
</article>