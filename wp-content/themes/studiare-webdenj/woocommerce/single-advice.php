<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$advice_phone = '';
if ( class_exists('Redux') ) {
	$advice_phone = codebean_option('advice_phone');
	$advice_form = codebean_option('advice_form');
}
?>

<div id="course-advice">
<div class="row">
<div class="advice col-md-12">
<div class="advice-inner">
<div class="col-md-6 advice-space"></div>
<div class="col-md-6 advice-content">
<h3>درخواست مشاوره</h3>
<p>برای کسب اطلاعات بیشتر درباره این دوره درخواست مشاوره خود را ارسال کنید و یا با ما در تماس باشید.</p>
<a href="" class="advice-modal-opener">درخواست مشاوره</a>
</div>

<div class="modal2">
        <div class="advice-form-overlay"></div>
        <div class="advice-modal-content">
		<a href="javascript:void(0)" class="close">
                        <?php get_template_part('/assets/images/close-icon.svg'); ?>
                    </a>
			<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 advice-contact">
<div class="tel"></div>
<div class="tel-number">
<a href="tel:<?php echo $advice_phone; ?>"><?php echo esc_html( $advice_phone ); ?></a>
</div>
<h3>نیاز به مشاوره دارید؟</h3>
<p>در صورتی که نیاز به مشاوره دارید می توانید فرم را تکمیل نمایید و یا با ما در تماس باشید</p>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 advice-form">
<h3>درخواست مشاوره رایگان</h3>
<?php echo do_shortcode( $advice_form ); ?>

</div>
</div>

        </div>
    </div>
</div>
</div>
</div>
</div>
