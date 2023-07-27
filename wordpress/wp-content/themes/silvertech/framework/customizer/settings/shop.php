<?php
/**
 * Shop setting for Customizer
 *
 * @package silvertech
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Main Shop
$this->sections['silvertech_shop_general'] = array(
	'title' => esc_html__( 'Main Shop', 'silvertech' ),
	'panel' => 'silvertech_shop',
	'settings' => array(
		array(
			'id' => 'shop_layout_position',
			'default' => 'no-sidebar',
			'control' => array(
				'label' => esc_html__( 'Shop Layout Position', 'silvertech' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'silvertech' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'silvertech' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'silvertech' ),
				),
				'desc' => esc_html__( 'Specify layout for main shop page.', 'silvertech' ),
				'active_callback' => 'silvertech_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_featured_title',
			'default' => esc_html__( 'Our Shop', 'silvertech' ),
			'control' => array(
				'label' => esc_html__( 'Shop: Featured Title', 'silvertech' ),
				'type' => 'silvertech_textarea',
				'active_callback' => 'silvertech_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_featured_title_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Shop: Featured Title Background', 'silvertech' ),
				'active_callback' => 'silvertech_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_products_per_page',
			'default' => 6,
			'control' => array(
				'label' => esc_html__( 'Products Per Page', 'silvertech' ),
				'type' => 'number',
				'active_callback' => 'silvertech_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_columns',
			'default' => '3',
			'control' => array(
				'label' => esc_html__( 'Shop Columns', 'silvertech' ),
				'type' => 'select',
				'choices' => array(
					'2' => '2',
					'3' => '3',
					'4' => '4',
				),
				'active_callback' => 'silvertech_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_item_bottom_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Item Bottom Margin', 'silvertech' ),
				'description' => esc_html__( 'Example: 30px.', 'silvertech' ),
				'active_callback' => 'silvertech_cac_has_woo',
			),
			'inline_css' => array(
				'target' => '.products li',
				'alter' => 'margin-top',
			),
		),
	),
);

// Single Shop
$this->sections['silvertech_single_shop_general'] = array(
	'title' => esc_html__( 'Single Shop', 'silvertech' ),
	'panel' => 'silvertech_shop',
	'settings' => array(
		array(
			'id' => 'shop_single_layout_position',
			'default' => 'no-sidebar',
			'control' => array(
				'label' => esc_html__( 'Shop Single Layout Position', 'silvertech' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'silvertech' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'silvertech' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'silvertech' ),
				),
				'desc' => esc_html__( 'Specify layout on the shop single page.', 'silvertech' ),
				'active_callback' => 'silvertech_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_single_featured_title',
			'default' => esc_html__( 'Our Shop', 'silvertech' ),
			'control' => array(
				'label' => esc_html__( 'Shop Single: Featured Title', 'silvertech' ),
				'type' => 'text',
				'active_callback' => 'silvertech_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_single_featured_title_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Shop Single: Featured Title Background', 'silvertech' ),
				'active_callback' => 'silvertech_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_realted_columns',
			'default' => '3',
			'control' => array(
				'label' => esc_html__( 'Related Product Columns', 'silvertech' ),
				'type' => 'select',
				'choices' => array(
					'2' => '2',
					'3' => '3',
					'4' => '4',
				),
				'active_callback' => 'silvertech_cac_has_woo',
			),
		),
	),
);
