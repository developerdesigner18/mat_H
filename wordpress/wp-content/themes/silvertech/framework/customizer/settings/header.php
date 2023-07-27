<?php
/**
 * Header setting for Customizer
 *
 * @package silvertech
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Header General
$this->sections['silvertech_header_general'] = array(
	'title' => esc_html__( 'General', 'silvertech' ),
	'panel' => 'silvertech_header',
	'settings' => array(
		array(
			'id' => 'header_topbar',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Top Bar: Enable', 'silvertech' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'header_background',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Background', 'silvertech' ),
				'type' => 'color',
			),
			'inline_css' => array(
				'target' => array(
					'#site-header:after'
				),
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'header_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'silvertech' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'silvertech' ),
			),
			'inline_css' => array(
				'media_query' => '(min-width: 1199px)',
				'target' => '.site-header-inner',
				'alter' => 'padding',
			),
			'sanitize_callback' => 'esc_url',
		),
		array(
			'id' => 'header_class',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Extra Class', 'silvertech' ),
				'type' => 'text',
				'desc' => esc_html__( 'Header Class for all pages on website. (e.g. pages, blog posts, single post, archives, etc ). Single page can override this setting in Page Settings metabox when edit.', 'silvertech' )
			),
		),
	)
);

// Header Logo
$this->sections['silvertech_header_logo'] = array(
	'title' => esc_html__( 'Logo', 'silvertech' ),
	'panel' => 'silvertech_header',
	'settings' => array(
		array(
			'id' => 'custom_logo',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Logo Image', 'silvertech' ),
				'type' => 'image',
			),
		),
		array(
			'id' => 'logo_width',
			'control' => array(
				'label' => esc_html__( 'Logo Width', 'silvertech' ),
				'type' => 'text',
			),
		),
	)
);

// Header Menu
$this->sections['silvertech_header_menu'] = array(
	'title' => esc_html__( 'Menu', 'silvertech' ),
	'panel' => 'silvertech_header',
	'settings' => array(
		// General
		array(
			'id' => 'menu_show_current',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Show current page indicator?', 'silvertech' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'menu_link_spacing',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Link Spacing', 'silvertech' ),
				'description' => esc_html__( 'Example: 20px', 'silvertech' ),
			),
			'inline_css' => array(
				'target' => array(
					'#main-nav > ul > li',
				),
				'alter' => array(
					'padding-left',
					'padding-right',
				),
			),
		),
		array(
			'id' => 'menu_height',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Menu Height', 'silvertech' ),
				'description' => esc_html__( 'Example: 100px', 'silvertech' ),
			),
			'inline_css' => array(
				'target' => array(
					'#site-header #main-nav > ul > li > a',
				),
				'alter' => array(
					'height',
					'line-height',
				),
			),
		),
		array(
			'id' => 'menu_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color', 'silvertech' ),
			),
			'inline_css' => array(
				'target' => array(
					'#main-nav > ul > li > a > span',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'menu_link_color_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color: Hover', 'silvertech' ),
			),
			'inline_css' => array(
				'target' => array(
					'#main-nav > ul > li > a:hover > span',
				),
				'alter' => 'color',
			),
		),
	)
);

// Search & Cart
$this->sections['silvertech_header_search_cart'] = array(
	'title' => esc_html__( 'Search & Cart', 'silvertech' ),
	'panel' => 'silvertech_header',
	'settings' => array(
		// Search Icon
		array(
			'id' => 'header_search_icon',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Search Icon', 'silvertech' ),
				'type' => 'checkbox',
			),
		),
		// Cart Icon
		array(
			'id' => 'header_cart_icon',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Cart Icon', 'silvertech' ),
				'type' => 'checkbox',
				'active_callback' => 'silvertech_cac_has_woo',
			),
		),
	)
);

// Button
$this->sections['silvertech_header_button'] = array(
	'title' => esc_html__( 'Button', 'silvertech' ),
	'panel' => 'silvertech_header',
	'settings' => array(
		array(
			'id' => 'header_button_text',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Text', 'silvertech' ),
				'type' => 'text',
			),
		),
		array(
			'id' => 'header_button_url',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Url', 'silvertech' ),
				'type' => 'text',
			),
		),
	),
);

// Header Info
$this->sections['silvertech_header_info'] = array(
	'title' => esc_html__( 'Header Information', 'silvertech' ),
	'panel' => 'silvertech_header',
	'settings' => array(
		// Content
		array(
			'id' => 'header_info_phone_prefix',
			'default' => 'Phone:',
			'control' => array(
				'label' => esc_html__( 'Phone', 'silvertech' ),
				'type' => 'text',
				'rows' => 3,
				'active_callback' => 'silvertech_cac_has_header_topbar',
			),
		),
		array(
			'id' => 'header_info_phone',
			'default' => '',
			'control' => array(
				'type' => 'text',
				'rows' => 3,
				'active_callback' => 'silvertech_cac_has_header_topbar',
			),
		),
		array(
			'id' => 'header_info_email_prefix',
			'default' => 'Email:',
			'control' => array(
				'label' => esc_html__( 'Email', 'silvertech' ),
				'type' => 'text',
				'rows' => 3,
				'active_callback' => 'silvertech_cac_has_header_topbar',
			),
		),
		array(
			'id' => 'header_info_email',
			'default' => '',
			'control' => array(
				'type' => 'text',
				'rows' => 3,
				'active_callback' => 'silvertech_cac_has_header_topbar',
			),
		),	
		array(
			'id' => 'header_info_address_prefix',
			'default' => 'Address:',
			'control' => array(
				'label' => esc_html__( 'Address', 'silvertech' ),
				'type' => 'text',
				'rows' => 3,
				'active_callback' => 'silvertech_cac_has_header_topbar',
			),
		),
		array(
			'id' => 'header_info_address',
			'default' => '',
			'control' => array(
				'type' => 'text',
				'rows' => 3,
				'active_callback' => 'silvertech_cac_has_header_topbar',
			),
		),
		// Style
		array(
			'id' => 'header_info_color',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Header Infor Color', 'silvertech' ),
				'type' => 'color',
				'active_callback' => 'silvertech_cac_has_header_topbar',
			),
			'inline_css' => array(
				'target' => '.header-info .content, #header.header-dark .header-info .content',
				'alter' => 'color',
			),
		),
	),
);

// Top Bar Socials
$this->sections['silvertech_header_socials'] = array(
	'title' => esc_html__( 'Social', 'silvertech' ),
	'panel' => 'silvertech_header',
	'settings' => array(
		array(
			'id' => 'header_socials',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Enable', 'silvertech' ),
				'type' => 'checkbox',
				'active_callback' => 'silvertech_cac_has_header_topbar',
				
			),
		),
		array(
			'id' => 'header_socials_spacing',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Socials Spacing', 'silvertech' ),
				'description' => esc_html__( 'Gap Between Each Social. Example: 10px.', 'silvertech' ),
				'type' => 'text',
				'active_callback' => 'silvertech_cac_has_header_socials',
			),
		),
	),
);

// Social settings
$social_options = silvertech_header_social_options();
foreach ( $social_options as $key => $val ) {
	$this->sections['silvertech_header_socials']['settings'][] = array(
		'id' => 'header_social_profiles[' . $key .']',
		'control' => array(
			'label' => $val['label'],
			'type' => 'text',
			'active_callback' => 'silvertech_cac_has_header_socials',
		),
	);
}

// Remove var from memory
unset( $social_options );
