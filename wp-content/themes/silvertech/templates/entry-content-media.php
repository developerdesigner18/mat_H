<?php
/**
 * Entry Content / Media
 *
 * @package silvertech
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// // Exit if disabled via Customizer
if ( is_single() && ! silvertech_get_mod( 'blog_single_media', true ) )
	return;

$html = $cls = '';

switch ( get_post_format() ) {
	case 'gallery':
		$icon = 'post-gallery';
		$size = 'silvertech-post-standard';

		if ( is_single() )
			$size = 'silvertech-post-single';

		if ( empty( $images ) )
			break;

		wp_enqueue_script( 'slick' );
		$html = '<div class="blog-gallery">';
  
		foreach ( $images as $image ) {
			$html .= sprintf(
				'<li><img src="%s" alt="%s"></li>',
				esc_url( $image['url'] ),
				esc_attr__( 'Image', 'silvertech' )
			);
		}
		$html .= '</div>';
		break;
	case 'video':
		$icon = 'post-video';
		if ( ! $video )
			break;

		if ( filter_var( $video, FILTER_VALIDATE_URL ) ) {
			// If URL: show oEmbed HTML
			if ( $oembed = @wp_oembed_get( $video ) )
				$html .= $oembed;
		} else {
			// If embed code: just display
			$html .= $video;
		}
		break;
	default:
		$icon = 'post-standard"';
		$size = 'silvertech-post-standard';

		if ( is_single() )
			$size = 'silvertech-post-single';

		if ( is_page_template( 'templates/page-blog-grid.php' ) )
			$size = 'silvertech-post-grid';

		$thumb = get_the_post_thumbnail( get_the_ID(), $size );
		if ( empty( $thumb ) )
			return;

		if ( is_single() ) {
			$html .= $thumb;
		} else {
			$html .= '<a href="'. esc_url( get_permalink() ) .'">';
			$html .= $thumb;
			$html .= '</a>';
		}
}

if ( silvertech_get_mod( 'blog_custom_category', false ) ) {
	if ( get_the_category() ) {
		$html .= sprintf( '<div class="post-cat-custom"><a href="%2$s">%1$s</a></div>',
			esc_html( get_the_category()[0]->cat_name ),
			esc_url ( get_the_permalink() ) ) ;
		$cls .= ' '. 'custom-cat';
	}
}

if ( $html )
	printf( '<div class="post-media %2$s clearfix">%1$s</div>', $html, $cls );
