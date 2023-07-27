<?php
/**
 * Accent color
 *
 * @package silvertech
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start class
if ( ! class_exists( 'Silvertech_Accent_Color' ) ) {
	class Silvertech_Accent_Color {
		// Main constructor
		function __construct() {
			add_filter( 'silvertech_custom_colors_css', array( 'Silvertech_Accent_Color', 'head_css' ), 999 );
		}

		// Generates arrays of elements to target
		public static function arrays( $return ) {
			// Color
			$texts = apply_filters( 'silvertech_accent_texts', array(
				'.text-accent-color',
				'.link-dark:hover',
				'.link-gray:hover',
				'.sticky-post',
				'a.accent',
				'#site-logo .site-logo-text:hover',
				'.header-style-2 #main-nav>ul>li:hover>a>span',
				'.header-style-2 #main-nav .sub-menu li a:hover',
				'.header-style-2 .master-quote .name a',
				'.header-style-3 #main-nav>ul>li:hover>a>span',
				'.header-style-3 #main-nav .sub-menu li a:hover',
				'.header-style-2 .header-search-wrap:hover .header-search-trigger',
				'.header-style-3 .header-search-wrap:hover .header-search-trigger',
				'.hentry .post-tags .inner:before',
				'#featured-title #breadcrumbs a:hover',
				'.hentry .page-links span',
				'.hentry .page-links a span',
				'.hentry .post-tags .inner:before',
				'.hentry .post-tags a:hover',
				'.hentry .post-author .author-socials .socials a',
				'.related-news .related-title',
				'.related-news .post-item .post-categories a:hover',
				'.related-news .post-item .text-wrap h3 a:hover',
				'.related-news .related-post .slick-next:hover:before',
				'.related-news .related-post .slick-prev:hover:before',
				'.comment-reply a',
				'.comment-edit-link',
				'#cancel-comment-reply-link',
				'.unapproved',
				'.logged-in-as a',
				'.hentry .post-title a:hover',
				'#sidebar .widget.widget_calendar caption',
				'.widget.widget_nav_menu .menu > li.current-menu-item > a',
				'.widget.widget_nav_menu .menu > li.current-menu-item',
				'#sidebar .widget.widget_calendar tbody #today',
				'#sidebar .widget.widget_calendar tbody #today a',
				'#sidebar .widget_information ul li.accent-icon i',
				'#footer-widgets .widget_mc4wp_form_widget .mc4wp-form .submit-wrap button:before',
				'#footer .widget_mc4wp_form_widget .submit-wrap button:after',
				'#footer-widgets .widget.widget_recent_posts .post-author',
				'#footer-widgets .widget.widget_recent_posts .post-author a',
				'#bottom .bottom-bar-copyright a:hover',
				'.widget.widget_categories .cat-item span',
				'.widget.widget_categories ul li a:hover',
				'.header-socials a:hover',
				'.hentry .post-by-avatar .text-wrap .name:hover',
				'.widget.widget_recent_posts h3 a:hover',
				'.hentry .post-meta a:hover',

				// shortcodes
				'.silvertech-step-box .number-box .number',
				'.silvertech-links.link-style-1.accent',
				'.silvertech-links.link-style-2.accent',
				'.silvertech-links.link-style-3.accent',
				'.news-style-1 .master-news:hover .headline-2 a',
				'.silvertech-arrow.hover-accent:hover',
				'.icon-accent .master-video-icon a',
				'.silvertech-button.outline.outline-accent',
				'.silvertech-button.outline.outline-accent .icon',
				'.silvertech-counter .icon.accent',
				'.silvertech-counter .prefix.accent',
				'.silvertech-counter .suffix.accent',
				'.silvertech-counter .number.accent',
				'.silvertech-divider.has-icon .icon-wrap > span.accent',
				'.silvertech-single-heading .heading.accent',
				'.silvertech-headings .heading.accent',
				'.silvertech-icon.accent > .icon',
				'.silvertech-image-box .item .title a:hover',
				'.silvertech-news .meta .author a:hover',
				'.silvertech-news .meta .comment a:hover ',
				'.silvertech-progress .perc.accent',
				'.silvertech-list .icon.accent',
				'.accent .master-heading .pre-heading',
				'.icon-has-bg.icon-accent .master-icon',
				'.accent .master-link',
				'.icon-accent .master-link:hover',
				'.accent .master-video-icon:hover span',
				'.flickity-slider .master-project:first-child .headline-2 a',
				'.blog-grid .master-news:hover .content-wrap .headline-2 a',

				 // Woocommerce
				'.woocommerce-page .woocommerce-MyAccount-content .woocommerce-info .button',
				'.products li .product-info .button',
				'.products li .product-info .added_to_cart',
				'.products li .product-cat:hover',
				'.products li h2:hover',
				'.woo-single-post-class .woocommerce-grouped-product-list-item__label a:hover',
				'.woocommerce-page .shop_table.cart .product-name a:hover',
				'.product_list_widget .product-title:hover',
				'.widget_recent_reviews .product_list_widget a:hover',
				'.widget_product_categories ul li a:hover',
				'.widget.widget_product_search .woocommerce-product-search .search-submit:hover:before',
				'.widget_shopping_cart_content ul li a:hover',
				'.master-project:hover .headline-2 a',
				'.woo-single-post-class .summary .product_meta>span a:hover',
				'.widget_shopping_cart_content ul li a.remove',

				
			) );

			// Background color
			$backgrounds = apply_filters( 'silvertech_accent_backgrounds', array(
				'.accent .master-button',
				'.flickity-slider .master-news:first-child .url-wrap .master-button',
				'.flickity-slider .master-news .url-wrap .master-button .hover-effect',
				'.header-style-1 #site-header .master-button',
				'.header-style-2 #site-header .master-button',
				'.header-style-2 .master-quote .name a:before',
				'.header-style-3 #site-header .master-button',
				'button, input[type="button"], input[type="reset"], input[type="submit"]',
				'bg-accent',
				'#scroll-top',
				'#scroll-top:before',
				'#main-nav > ul > li > a > span:before',
				'#main-nav .sub-menu li a:before',
				'.hentry .post-media .post-date-custom',
				'.post-media .slick-prev:hover',
				'.post-media .slick-next:hover',
				'.post-media .slick-dots li.slick-active button',
				'.hentry .post-link a > span:before',
				'#footer-widgets .widget .widget-title > span:after ',
				'.widget_mc4wp_form_widget .mc4wp-form .submit-wrap button',
				'#sidebar .widget.widget_tag_cloud .tagcloud a:hover',
				'.widget_product_tag_cloud .tagcloud a:hover',
				'.no-results-content .search-form .search-submit:before',
				'.widget.widget_links ul li a:after',
				'.footer-subscribe .form-wrap .submit-wrap .master-button',
				'.master-news .master-button',
				'.silvertech-pagination ul li .page-numbers:hover',
				'.woocommerce-pagination .page-numbers li .page-numbers:hover',
				'.silvertech-pagination ul li .page-numbers.current',
				'.woocommerce-pagination .page-numbers li .page-numbers.current',
				'.hentry .post-read-more .post-link .hover-effect',

				// shortcodes
				'.silvertech-accordions .accordion-item.active .accordion-heading > .inner:before',
				'.silvertech-step-box .number-box:hover .number',
				'.silvertech-links > span:before',
				'.silvertech-links.link-style-1.accent > span:before',
				'.silvertech-links.link-style-1.accent > span:after',
				'.silvertech-links.link-style-1.dark > span:after',
				'.silvertech-links.link-style-2.accent > span:before',
				'.silvertech-links.link-style-3.accent > span:after',
				'.silvertech-links.link-style-3.dark > span:after',
				'.silvertech-button.accent',
				'.accent .master-video-icon a',
				'.dot-style-4.dot-accent .master-carousel-box .flickity-page-dots .dot.is-selected',
				'body .accent table.booked-calendar thead tr:first-child th',
				'.silvertech-button.outline.outline-accent:hover',
				'.silvertech-content-box > .inner.accent',
				'.silvertech-content-box > .inner.dark-accent',
				'.silvertech-content-box > .inner.light-accent',
				'.silvertech-single-heading .line.accent',
				'.silvertech-headings .sep.accent',
				'.accent .silvertech-headings .heading > span',
				'.silvertech-icon-box:hover .icon-number',
				'.silvertech-icon.accent-bg .icon',
				'.silvertech-image-box .item .thumb .hover-image .arrow',
				'.silvertech-image-box.style-2 .url-wrap .arrow',
				'.silvertech-images-grid .zoom-popup:after',
				'.silvertech-news .image-wrap .post-date-custom',
				'.project-box .project-text .button a',
				'.project-box .project-text .arrow a',
				'.silvertech-progress .progress-animate.accent',
				'.silvertech-images-carousel.has-borders:after',
				'.silvertech-images-carousel.has-borders:before',
				'.silvertech-images-carousel.has-arrows.arrow-bottom .owl-nav',
				'.silvertech-team .socials li a:hover',
				'.silvertech-video-icon.accent a',
				'.icon-has-bg.accent .master-icon',

				'.hover-effect-style-1.active .elementor-widget-container:before',
				'.hover-effect-style-1:hover .elementor-widget-container:before',
				'.hover-effect-style-3.active .elementor-widget-container:before',
				'.hover-effect-style-3:hover .elementor-widget-container:before',
				'.hover-effect-style-1.icon-has-bg:hover .master-icon',

				// woocemmerce
				'.woocommerce-page .wc-proceed-to-checkout .button',
				'.woocommerce-page .return-to-shop a',
				'#payment #place_order',
				'.widget_price_filter .price_slider_amount .button:hover',
				'.widget_shopping_cart_content .buttons a.checkout',
				'.widget_price_filter .ui-slider .ui-slider-range',
				'.woo-single-post-class .woocommerce-tabs ul li:after',
			) );

			// Border color
			$borders = apply_filters( 'silvertech_accent_borders', array(
				'.underline-solid:after, .underline-dotted:after, .underline-dashed:after' => array( 'bottom' ),
				'.widget.widget_links ul li a:after' => array( 'bottom' ),
				'.widget_mc4wp_form_widget .mc4wp-form .email-wrap input:focus',
				'#sidebar .widget.widget_tag_cloud .tagcloud a:hover',
				'.widget_product_tag_cloud .tagcloud a:hover',
				'.no-results-content .search-form .search-field:focus',

				// shortcodes
				'.silvertech-step-box .number-box .number',
				'.silvertech-button.outline.outline-accent',
				'.silvertech-button.outline.outline-accent:hover',
				'.divider-icon-before.accent',
				'.divider-icon-after.accent',
				'.silvertech-divider.has-icon .divider-double.accent',
				'.accent-border .master-button.btn-outline',

				// woocommerce
				'.widget_price_filter .ui-slider .ui-slider-handle',
				'.silvertech-pagination ul li .page-numbers:hover',
				'.woocommerce-pagination .page-numbers li .page-numbers:hover',
				'.silvertech-pagination ul li .page-numbers.current',
				'.woocommerce-pagination .page-numbers li .page-numbers.current',
				'.widget_price_filter .price_slider_amount .button',
			) );

			// Gradient color
			$gradients = apply_filters( 'silvertech_accent_gradient', array(
				'.silvertech-progress .progress-animate.accent.gradient'
			) );

			// Return array
			if ( 'texts' == $return ) {
				return $texts;
			} elseif ( 'backgrounds' == $return ) {
				return $backgrounds;
			} elseif ( 'borders' == $return ) {
				return $borders;
			} elseif ( 'gradients' == $return ) {
				return $gradients;
			}
		}

		// Generates the CSS output
		public static function head_css( $output ) {

			// Get custom accent
			$default_accent = '#eddd5e';
			$custom_accent  = silvertech_get_mod( 'accent_color' );

			// Return if accent color is empty or equal to default
			if ( ! $custom_accent || ( $default_accent == $custom_accent ) )
				return $output;

			// Define css var
			$css = '';

			// Get arrays
			$texts       = self::arrays( 'texts' );
			$backgrounds = self::arrays( 'backgrounds' );
			$borders     = self::arrays( 'borders' );
			$gradients    = self::arrays( 'gradients' );

			// Texts
			if ( ! empty( $texts ) )
				$css .= implode( ',', $texts ) .'{color:'. $custom_accent .'!important;}';

			// Backgrounds
			if ( ! empty( $backgrounds ) )
				$css .= implode( ',', $backgrounds ) .'{background-color:'. $custom_accent .'!important;}';

			// Borders
			if ( ! empty( $borders ) ) {
				foreach ( $borders as $key => $val ) {
					if ( is_array( $val ) ) {
						$css .= $key .'{';
						foreach ( $val as $key => $val ) {
							$css .= 'border-'. $val .'-color:'. $custom_accent .'!important;';
						}
						$css .= '}'; 
					} else {
						$css .= $val .'{border-color:'. $custom_accent .'!important;}';
					}
				}
			}

			// Gradients
			if ( ! empty( $gradients ) )
				$css .= implode( ',', $gradients ) .'{background: '. silvertech_hex2rgba($custom_accent, 1) .';background: -moz-linear-gradient(left, '. silvertech_hex2rgba($custom_accent, 1) .' 0%, '. silvertech_hex2rgba($custom_accent, 0.3) .' 100%);background: -webkit-linear-gradient( left, '. silvertech_hex2rgba($custom_accent, 1) .' 0%, '. silvertech_hex2rgba($custom_accent, 0.3) .' 100% );background: linear-gradient(to right, '. silvertech_hex2rgba($custom_accent, 1) .' 0%, '. silvertech_hex2rgba($custom_accent, 0.3) .' 100%) !important;}';

			// Return CSS
			if ( ! empty( $css ) )
				$output .= '/*ACCENT COLOR*/'. $css;

			// Return output css
			return $output;
		}
	}
}

new Silvertech_Accent_Color();
