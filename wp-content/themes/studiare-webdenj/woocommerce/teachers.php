

<?php

$prefix = '_studiare_';
$teacher_id = get_post_meta( get_the_ID(), $prefix . 'course_teacher', true );
$teacher_2_id = get_post_meta( get_the_ID(), $prefix . 'course_teacher_2', true );

$teacher_post = get_post( $teacher_id );
$teacher_job_title = get_post_meta( $teacher_id, $prefix . 'teacher_job_title', true );
?>


<div class="course-teacher-details">
    <div class="top-part">
        <?php $teacher_image = wp_get_attachment_image_src(get_post_thumbnail_id( $teacher_id ), 'img-120-120', false); ?>
        <?php if(!empty($teacher_image[0])): ?>
            <a href="<?php echo esc_url( get_permalink( $teacher_post ) ); ?>" ><img class="img-fluid" src="<?php echo esc_url($teacher_image[0]); ?>" alt="<?php echo esc_attr( get_the_title( $teacher_id ) ); ?>"></a>
        <?php endif; ?>
        <div class="name">
             <a href="<?php echo esc_url( get_permalink( $teacher_post ) ); ?>" class="btn-link"><h6><?php echo esc_attr(get_the_title($teacher_id)); ?></h6></a>
            <?php if(!empty($teacher_job_title)): ?>
                <span class="job-title"><?php echo esc_attr($teacher_job_title); ?></span>
            <?php endif; ?>
        </div>
    </div>
    <div class="content">
        <p><?php echo esc_attr( $teacher_post->post_excerpt ); ?></p>
    </div>



    <?php if ( !empty( $teacher_2_id ) && $teacher_2_id != 'no-teacher' ) : ?>
          <?php

          $teacher_post = get_post( $teacher_2_id );
          $teacher_job_title = get_post_meta( $teacher_2_id, $prefix . 'teacher_job_title', true );
          ?>


              <div class="top-part">
                  <?php $teacher_image = wp_get_attachment_image_src(get_post_thumbnail_id( $teacher_2_id ), 'img-120-120', false); ?>
                  <?php if(!empty($teacher_image[0])): ?>
                      <a href="<?php echo esc_url( get_permalink( $teacher_post ) ); ?>" ><img class="img-fluid" src="<?php echo esc_url($teacher_image[0]); ?>" alt="<?php echo esc_attr( get_the_title( $teacher_id ) ); ?>"></a>
                  <?php endif; ?>
                  <div class="name">
                       <a href="<?php echo esc_url( get_permalink( $teacher_post ) ); ?>" class="btn-link"><h6><?php echo esc_attr(get_the_title($teacher_2_id)); ?></h6></a>
                      <?php if(!empty($teacher_job_title)): ?>
                          <span class="job-title"><?php echo esc_attr($teacher_job_title); ?></span>
                      <?php endif; ?>
                  </div>
              </div>
              <div class="content">
                  <p><?php echo esc_attr( $teacher_post->post_excerpt ); ?></p>
              </div>

<?php endif; ?>
</div>
