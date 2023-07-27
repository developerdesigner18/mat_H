<?php
/**
 * Bottom Bar
 *
 * @package silvertech
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Exit if disabled via Customizer
if ( ! silvertech_get_mod( 'bottom_bar', true ) ) return false;

$bottom_style = silvertech_get_mod( 'bottom_bar_style' );
$copyright = silvertech_get_mod( 'bottom_copyright', '&copy; Silvertech - Technology WordPress Theme. All Right Reserved.' );

$css = silvertech_element_bg_css( 'bottom_background_img' );
$cls = $bottom_style;
?>

<div id="bottom" class="<?php echo esc_attr( $cls ); ?>" style="<?php echo esc_attr( $css ); ?>">
    <div class="silvertech-container">
        <div class="bottom-bar-inner-wrap">
            <div class="inner-wrap clearfix">

                <?php if ( $copyright ) : ?>
                    <div id="copyright">
                        <?php printf( '%s', do_shortcode( $copyright ) ); ?>
                    </div>
                <?php endif; ?>

                <?php if ( 'style-2' == $bottom_style ) : ?>
                    <div class="bottom-bar-menu">
                        <?php get_template_part( 'templates/bottom-nav' ); ?>
                    </div><!-- /.bottom-bar-menu -->
                <?php endif; ?>
            </div><!-- /.bottom-bar-copyright -->
        </div>
    </div>

    <?php get_template_part( 'templates/scroll-top'); ?>
</div><!-- /#bottom -->