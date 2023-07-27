<?php
/**
 * Layout setting for Customizer
 *
 * @package silvertech
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Layout Style
$this->sections['silvertech_layout_style'] = array(
	'title' => esc_html__( 'Layout Site', 'silvertech' ),
	'panel' => 'silvertech_layout',
	'settings' => array(
		array(
			'id' => 'site_layout_style',
			'default' => 'full-width',
			'control' => array(
				'label' => esc_html__( 'Layout Style', 'silvertech' ),
				'type' => 'select',
				'choices' => array(
					'full-width' => esc_html__( 'Full Width','silvertech' ),
					'boxed' => esc_html__( 'Boxed','silvertech' )
				),
			),
		),
		array(
			'id' => 'site_layout_boxed_shadow',
			'control' => array(
				'label' => esc_html__( 'Box Shadow', 'silvertech' ),
				'type' => 'checkbox',
				'active_callback' => 'silvertech_cac_has_boxed_layout',
			),
		),
		array(
			'id' => 'site_layout_wrapper_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Wrapper Margin', 'silvertech' ),
				'desc' => esc_html__( 'Top Right Bottom Left. Default: 30px 0px 30px 0px.', 'silvertech' ),
				'active_callback' => 'silvertech_cac_has_boxed_layout',
			),
			'inline_css' => array(
				'target' => '.site-layout-boxed #wrapper',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'wrapper_background_color',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Outer Background Color', 'silvertech' ),
				'type' => 'color',
				'active_callback' => 'silvertech_cac_has_boxed_layout',
			),
			'inline_css' => array(
				'target' => '.site-layout-boxed #wrapper',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'wrapper_background_img',
			'control' => array(
				'label' => esc_html__( 'Outer Background Image', 'silvertech' ),
				'type' => 'image',
				'active_callback' => 'silvertech_cac_has_boxed_layout',
			),
		),
		array(
			'id' => 'wrapper_background_img_style',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Outer Background Image Style', 'silvertech' ),
				'type'  => 'image',
				'type'  => 'select',
				'choices' => array(
					''             => esc_html__( 'Default', 'silvertech' ),
					'cover'        => esc_html__( 'Cover', 'silvertech' ),
					'center-top'        => esc_html__( 'Center Top', 'silvertech' ),
					'fixed-top'    => esc_html__( 'Fixed Top', 'silvertech' ),
					'fixed'        => esc_html__( 'Fixed Center', 'silvertech' ),
					'fixed-bottom' => esc_html__( 'Fixed Bottom', 'silvertech' ),
					'repeat'       => esc_html__( 'Repeat', 'silvertech' ),
					'repeat-x'     => esc_html__( 'Repeat-x', 'silvertech' ),
					'repeat-y'     => esc_html__( 'Repeat-y', 'silvertech' ),
				),
				'active_callback' => 'silvertech_cac_has_boxed_layout',
			),
		),
	),
);

// Layout Position
$this->sections['silvertech_layout_position'] = array(
	'title' => esc_html__( 'Layout Position', 'silvertech' ),
	'panel' => 'silvertech_layout',
	'settings' => array(
		array(
			'id' => 'site_layout_position',
			'default' => 'sidebar-right',
			'control' => array(
				'label' => esc_html__( 'Site Layout Position', 'silvertech' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'silvertech' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'silvertech' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'silvertech' ),
				),
				'desc' => esc_html__( 'Specify layout for all pages on website. (e.g. pages, blog posts, single post, archives, etc ). Single page can override this setting in Page Settings elementor when edit.', 'silvertech' )
			),
		),
		array(
			'id' => 'custom_page_layout_position',
			'default' => 'no-sidebar',
			'control' => array(
				'label' => esc_html__( 'Custom Page Layout Position', 'silvertech' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'silvertech' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'silvertech' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'silvertech' ),
				),
				'desc' => esc_html__( 'Specify layout for all custom pages.', 'silvertech' )
			),
		),
		array(
			'id' => 'single_post_layout_position',
			'default' => 'sidebar-right',
			'control' => array(
				'label' => esc_html__( 'Single Post Layout Position', 'silvertech' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'silvertech' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'silvertech' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'silvertech' ),
				),
				'desc' => esc_html__( 'Specify layout for all single post pages.', 'silvertech' )
			),
		),
		array(
			'id' => 'single_project_layout_position',
			'default' => 'no-sidebar',
			'control' => array(
				'label' => esc_html__( 'Single Project Layout Position', 'silvertech' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'silvertech' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'silvertech' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'silvertech' ),
				),
				'desc' => esc_html__( 'Specify layout for all single project pages.', 'silvertech' ),
				'active_callback' => 'silvertech_cac_has_single_project',
			),
		),
		array(
			'id' => 'single_service_layout_position',
			'default' => 'no-sidebar',
			'control' => array(
				'label' => esc_html__( 'Single Service Layout Position', 'silvertech' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'silvertech' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'silvertech' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'silvertech' ),
				),
				'desc' => esc_html__( 'Specify layout for all single service pages.', 'silvertech' ),
				'active_callback' => 'silvertech_cac_has_single_service',
			),
		),
	),
);

// Layout Widths
$this->sections['silvertech_layout_widths'] = array(
	'title' => esc_html__( 'Layout Widths', 'silvertech' ),
	'panel' => 'silvertech_layout',
	'settings' => array(
		array(
			'id' => 'site_desktop_container_width',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Container', 'silvertech' ),
				'type' => 'text',
				'desc' => esc_html__( 'Default: 1170px', 'silvertech' ),
			),
			'inline_css' => array(
				'target' => array( 
					'.site-layout-full-width .silvertech-container',
					'.site-layout-boxed #page'
				),
				'alter' => 'width',
			),
		),
		array(
			'id' => 'left_container_width',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Content', 'silvertech' ),
				'type' => 'text',
				'desc' => esc_html__( 'Example: 66%', 'silvertech' ),
			),
			'inline_css' => array(
				'target' => '#site-content',
				'alter' => 'width',
			),
		),
		array(
			'id' => 'sidebar_width',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Sidebar', 'silvertech' ),
				'type' => 'text',
				'desc' => esc_html__( 'Example: 28%', 'silvertech' ),
			),
			'inline_css' => array(
				'target' => '#sidebar',
				'alter' => 'width',
			),
		),
	),
);