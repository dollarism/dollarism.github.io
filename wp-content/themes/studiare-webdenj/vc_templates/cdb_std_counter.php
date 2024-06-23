<?php

// Atts
if ( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );

// Element Class
$count_courses = wp_count_posts( 'product' )->publish;
$count_teacher = wp_count_posts( 'teacher' )->publish;

$user_count_data = count_users();
$total_users = $user_count_data['total_users'];
?>


<div class="amar">
	<div class="amarboxnew">
			<div class="amarbox">
				<i class="fal fa-books"></i>
				<div class="amarboxim">
					<h3><?php echo $count_courses ; ?> <br>
						<strong>دوره آموزشی</strong>
					</h3>
				</div>
			</div>
	</div>


	<div class="amarboxnew">
			<div class="amarbox amarleft">
					<i class="fal fa-user-graduate"></i>
					<div class="amarboxim">
						<h3><?php echo $total_users ; ?>  <br> <strong>دانشجو</strong>
						</h3>
					</div>
			</div>
	</div>

<div class="amarboxnew">
<div class="amarbox">
<i class="fal fa-alarm-clock"></i>
<div class="amarboxim">
<h3><?php echo $course_hours ; ?> ساعت<br>
<strong>ساعت آموزش</strong>
</h3></div>
</div></div>


<div class="amarboxnew">
<div class="amarbox">
<i class="fas fa-chalkboard-teacher"></i>
<div class="amarboxim">
<h3><?php echo $count_teacher ; ?><br>
<strong>تعداد اساتید</strong>
</h3></div>
</div></div>

</div>
