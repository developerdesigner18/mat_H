<?php
/**
 * General setting for Customizer
 *
 * @package silvertech
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Accent Colors
$this->sections['silvertech_accent_colors'] = array(
	'title' => esc_html__( 'Accent Colors', 'silvertech' ),
	'panel' => 'silvertech_general',
	'settings' => array(
		array(
			'id' => 'accent_color',
			'default' => '#3377ff',
			'control' => array(
				'label' => esc_html__( 'Accent Color', 'silvertech' ),
				'type' => 'color',
			),
		),
	)
);

// PreLoader
$this->sections['silvertech_preloader'] = array(
	'title' => esc_html__( 'PreLoader', 'silvertech' ),
	'panel' => 'silvertech_general',
	'settings' => array(
		array(
			'id' => 'preloader',
			'default' => 'animsition',
			'control' => array(
				'label' => esc_html__( 'Preloader Option', 'silvertech' ),
				'type' => 'select',
				'choices' => array(
					'animsition' => esc_html__( 'Enable','silvertech' ),
					'' => esc_html__( 'Disable','silvertech' )
				),
			),
		),
		array(
			'id' => 'preload_color_1',
			'default' => '#3377ff',
			'control' => array(
				'label' => esc_html__( 'Color', 'silvertech' ),
				'type' => 'color',
			),
			'inline_css' => array(
				'target' => '.animsition-loading',
				'alter' => 'color',
			),
		),
	)
);

// Header Site
$this->sections['silvertech_header_site'] = array(
	'title' => esc_html__( 'Header Site', 'silvertech' ),
	'panel' => 'silvertech_general',
	'settings' => array(
		array(
			'id' => 'header_site_style',
			'default' => 'style-2',
			'control' => array(
				'label' => esc_html__( 'Header Style', 'silvertech' ),
				'type' => 'select',
				'choices' => array(
                    'style-1' => esc_html__( 'Basic', 'silvertech' ),
                    'style-2' => esc_html__( 'Float', 'silvertech' ),
                    'style-3' => esc_html__( 'Modern', 'silvertech' ),
                    'style-4' => esc_html__( 'Float - Button 2', 'silvertech' ),
                    'style-5' => esc_html__( 'Float - Button 3', 'silvertech' ),
                    'style-6' => esc_html__( 'Float - Header White', 'silvertech' ),
				),
				'desc' => esc_html__( 'Header Style for all pages on website. (e.g. pages, blog posts, single post, archives, etc ). Single page can override this setting in Page Settings metabox when edit.', 'silvertech' )
			),
		),
		array(
			'id' => 'header_fixed',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Header Fixed: Enable', 'silvertech' ),
				'type' => 'checkbox',
			),
		),
	),
);

// Scroll to top
$this->sections['silvertech_scroll_top'] = array(
	'title' => esc_html__( 'Scroll Top Button', 'silvertech' ),
	'panel' => 'silvertech_general',
	'settings' => array(
		array(
			'id' => 'scroll_top',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'silvertech' ),
				'type' => 'checkbox',
			),
		),
	),
);

// Forms
$this->sections['silvertech_general_forms'] = array(
	'title' => esc_html__( 'Forms', 'silvertech' ),
	'panel' => 'silvertech_general',
	'settings' => array(
		array(
			'id' => 'input_border_rounded',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Border Rounded', 'silvertech' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'border-radius',
			),
		),
		array(
			'id' => 'input_background_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'silvertech' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'input_border_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Border Color', 'silvertech' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'border-color',
			),
		),
		array(
			'id' => 'input_border_width',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Border Width', 'silvertech' ),
				'description' => esc_html__( 'Enter a value in pixels. Example: 1px', 'silvertech' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'border-width',
			),
		),
		array(
			'id' => 'input_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'silvertech' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'color',
			),
		),
	),
);

// Responsive
$this->sections['silvertech_responsive'] = array(
	'title' => esc_html__( 'Responsive', 'silvertech' ),
	'panel' => 'silvertech_general',
	'settings' => array(
		// Mobile Logo
		array(
			'id' => 'heading_mobile_logo',
			'control' => array(
				'type' => 'silvertech-heading',
				'label' => esc_html__( 'Mobile Logo', 'silvertech' ),
			),
		),
		array(
			'id' => 'mobile_logo_width',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Mobile Logo: Width', 'silvertech' ),
				'description' => esc_html__( 'Example: 150px', 'silvertech' ),
			),
			'inline_css' => array(
				'media_query' => '(max-width: 991px)',
				'target' => '#site-logo',
				'alter' => 'max-width',
			),
		),
		array(
			'id' => 'mobile_logo_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Mobile Logo: Margin', 'silvertech' ),
				'description' => esc_html__( 'Example: 20px 0px 20px 0px', 'silvertech' ),
			),
			'inline_css' => array(
				'media_query' => '(max-width: 991px)',
				'target' => '#site-logo-inner',
				'alter' => 'margin',
			),
		),
		// Mobile Menu
		array(
			'id' => 'heading_mobile_menu',
			'control' => array(
				'type' => 'silvertech-heading',
				'label' => esc_html__( 'Mobile Menu', 'silvertech' ),
			),
		),
		array(
			'id' => 'mobile_menu_item_height',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Item Height', 'silvertech' ),
				'description' => esc_html__( 'Example: 40px', 'silvertech' ),
			),
			'inline_css' => array(
				'target' => array(
					'#main-nav-mobi ul > li > a',
					'#main-nav-mobi .menu-item-has-children .arrow'
				),
				'alter' => 'line-height'
			),
		),
		array(
			'id' => 'mobile_menu_logo',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Mobile Menu Logo', 'silvertech' ),
				'type' => 'image',
			),
		),
		array(
			'id' => 'mobile_menu_logo_width',
			'control' => array(
				'label' => esc_html__( 'Mobile Menu Logo: Width', 'silvertech' ),
				'type' => 'text',
			),
		),
		// Featured Title
		array(
			'id' => 'heading_featured_title',
			'control' => array(
				'type' => 'silvertech-heading',
				'label' => esc_html__( 'Mobile Featured Title', 'silvertech' ),
			),
		),
		array(
			'id' => 'mobile_featured_title_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'silvertech' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'silvertech' ),
				'active_callback' => 'silvertech_cac_has_featured_title',
			),
			'inline_css' => array(
				'media_query' => '(max-width: 991px)',
				'target' => '#featured-title .inner-wrap, #featured-title.centered .inner-wrap, #featured-title.creative .inner-wrap',
				'alter' => 'padding',
			),
		),
	)
);