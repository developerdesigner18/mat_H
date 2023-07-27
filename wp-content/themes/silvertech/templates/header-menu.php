<?php
/**
 * Header / Menu
 *
 * @package silvertech
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Menu
if ( has_nav_menu( 'primary' ) || has_nav_menu( 'onepage' ) ) {
	$cls = '';
	if ( silvertech_get_mod( 'menu_show_current' ) ) $cls .= 'show-current';
	$menu = is_page_template( 'templates/page-onepage.php' )
		? 'onepage'
		: 'primary';
	?>

	<div class="mobile-button"><span></span></div>

	<nav id="main-nav" class="main-nav <?php echo esc_attr( $cls ); ?>">
		<?php
		wp_nav_menu( array(
			'theme_location' => $menu,
			'link_before' => '<span>',
			'link_after'=>'</span>',
			'fallback_cb' => false,
			'container' => false
		) );
		?>
	</nav>
<?php }