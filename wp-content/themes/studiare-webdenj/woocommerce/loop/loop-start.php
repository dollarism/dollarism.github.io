<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$courses_columns = '3';

if ( ! is_active_sidebar( 'sidebar_shop' ) ) {
    $courses_columns = '4';
}

if ( class_exists('Redux' ) ) {
	$courses_columns = codebean_option('courses_columns');
}

$loop_start_classes = array('products grid-view');
$loop_start_classes[] = 'courses-'. $courses_columns .'-columns';

?>
<div <?php echo studiare_get_class_attribute( $loop_start_classes ); ?>>