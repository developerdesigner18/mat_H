<?php
/**
 * Header / Social
 *
 * @package silvertech
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$css = $cls = '';
$social_style = silvertech_get_mod( 'header_socials_style', '' );
$social_spacing = silvertech_get_mod( 'header_socials_spacing', '' );

if ( $social_style ) $cls .= ' '. $social_style;
if ( $social_spacing ) $css .= 'margin-left:'. intval( $social_spacing ) .'px;';

if ( silvertech_get_mod( 'header_socials', false ) ) {
?>
	<div class="header-socials <?php echo esc_html( $cls ); ?>" <?php if ( $css ) echo ' style="'. esc_attr( $css ) .'"'; ?>>
		<div class="header-socials-inner">
	    <?php
	    $profiles =  silvertech_get_mod( 'header_social_profiles' );
	    $social_options = silvertech_header_social_options();

	    foreach ( $social_options as $key => $val ) :
	        $url = isset( $profiles[$key] ) ? $profiles[$key] : '';

	        if ( $url ) :
	            echo '<a href="'. esc_url( $url ) .'" style="'. esc_attr( $css ) .'" title="'. esc_attr( $val['label'] ) .'"><span class="'. esc_attr( $val['icon_class'] ) .'" aria-hidden="true"></span><span class="screen-reader-text">'. $val['label'] .' '. esc_html__( 'Profile', 'silvertech' ) .'</span></a>';
	        endif;
	    endforeach; ?>
		</div>
	</div><!-- /.header-socials -->
<?php }