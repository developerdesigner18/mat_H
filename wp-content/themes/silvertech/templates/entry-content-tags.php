<?php
/**
 * Entry Content / Tags
 *
 * @package silvertech
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Exit if disabled via Customizer
if ( is_single() && ! silvertech_get_mod( 'blog_single_tags', true ) )
	return;

$text = silvertech_get_mod( 'blog_single_tags_text', '' );
the_tags( '<div class="post-tags clearfix"><div class="inner">'. esc_html( $text ),', ','</div></div>' );


