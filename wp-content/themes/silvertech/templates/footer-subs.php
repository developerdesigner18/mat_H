<?php
/**
 * Footer Promotion
 *
 * @package silvertech
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Exit if disabled via Customizer or Metabox
if ( ! silvertech_get_mod( 'subscribe_box', false ) )
	return false;

$heading = silvertech_get_mod( 'subs_heading', 'Subscribe to our newsletter and stay updated on the latest news and special offers!' );
$subheading = silvertech_get_mod( 'subs_subheading', '');
$text = silvertech_get_mod( 'subs_text', '');
?>

<div class="footer-subscribe clearfix" style="<?php echo silvertech_element_bg_css('subs_background_img'); ?>">
	<?php
	if ( class_exists('MC4WP_MailChimp') ) {

		echo '<h4 class="heading">'. do_shortcode( $heading ) .'</h4>';
		echo '<div class="subheading">'. do_shortcode( $subheading ) .'</div>';
		echo '<div class="form-wrap">';
		mc4wp_show_form(0);
		echo '</div>';
		echo '<div class="text">'. do_shortcode( $text ) .'</div>';

	} ?>
</div>