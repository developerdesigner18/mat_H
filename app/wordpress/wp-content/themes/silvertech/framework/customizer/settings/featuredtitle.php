<?php
/**
 * Featured Title setting for Customizer
 *
 * @package silvertech
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Featured Title General
$this->sections['silvertech_featuredtitle_general'] = array(
	'title' => esc_html__( 'General', 'silvertech' ),
	'panel' => 'silvertech_featuredtitle',
	'settings' => array(
		array(
			'id' => 'featured_title',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'silvertech' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'featured_title_style',
			'default' => 'simple',
			'control' => array(
				'label'  => esc_html__( 'Style', 'silvertech' ),
				'type' => 'select',
				'choices' => array(
					'simple' => esc_html__( 'Simple', 'silvertech' ),
					'centered' => esc_html__( 'Centered', 'silvertech' ),
				),
				'active_callback' => 'silvertech_cac_has_featured_title',
			),
		),
		array(
			'id' => 'featured_title_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'silvertech' ),
				'description' => esc_html__( 'Example: 250px 0px 150px 0px', 'silvertech' ),
				'active_callback' => 'silvertech_cac_has_featured_title',
			),
			'inline_css' => array(
				'media_query' => '(min-width: 992px)',
				'target' => '#featured-title .inner-wrap',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'featured_title_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'silvertech' ),
				'active_callback' => 'silvertech_cac_has_featured_title',
			),
			'inline_css' => array(
				'target' => '#featured-title',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'featured_title_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Background Image', 'silvertech' ),
				'active_callback' => 'silvertech_cac_has_featured_title',
			),
		),
		array(
			'id' => 'featured_title_background_img_style',
			'default' => 'repeat',
			'control' => array(
				'label' => esc_html__( 'Background Image Style', 'silvertech' ),
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
				'active_callback' => 'silvertech_cac_has_featured_title',
			),
		),
	),
);

// Featured Title Headings
$this->sections['silvertech_featuredtitle_heading'] = array(
	'title' => esc_html__( 'Headings', 'silvertech' ),
	'panel' => 'silvertech_featuredtitle',
	'settings' => array(
		array(
			'id' => 'featured_title_heading',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'silvertech' ),
				'type' => 'checkbox',
				'active_callback' => 'silvertech_cac_has_featured_title',
			),
		),
		array(
			'id' => 'featured_title_heading_bottom_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Heading Bottom Margin', 'silvertech' ),
				'active_callback' => 'silvertech_cac_has_featured_title_center',
				'description' => esc_html__( 'Example: 30px.', 'silvertech' ),
			),
			'inline_css' => array(
				'target' => '#featured-title.centered .title-group',
				'alter' => 'margin-bottom',
			),
		),
		array(
			'id' => 'featured_title_heading_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Title Color', 'silvertech' ),
				'active_callback' => 'silvertech_cac_has_featured_title_heading',
			),
			'inline_css' => array(
				'target' => '#featured-title .main-title',
				'alter' => 'color',
			),
		),
	),
);

// Featured Title Breadcrumbs
$this->sections['silvertech_featuredtitle_breadcrumbs'] = array(
	'title' => esc_html__( 'Breadcrumbs', 'silvertech' ),
	'panel' => 'silvertech_featuredtitle',
	'settings' => array(
		array(
			'id' => 'featured_title_breadcrumbs',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'silvertech' ),
				'type' => 'checkbox',
				'active_callback' => 'silvertech_cac_has_featured_title',
			),
		),
		array(
			'id' => 'featured_title_breadcrumbs_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'silvertech' ),
				'active_callback' => 'silvertech_cac_has_featured_title_breadcrumbs',
			),
			'inline_css' => array(
				'target' => array(
					'#featured-title #breadcrumbs',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'featured_title_breadcrumbs_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color', 'silvertech' ),
				'active_callback' => 'silvertech_cac_has_featured_title_breadcrumbs',
			),
			'inline_css' => array(
				'target' => '#featured-title #breadcrumbs a',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'featured_title_breadcrumbs_link_hover_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color: Hover', 'silvertech' ),
				'active_callback' => 'silvertech_cac_has_featured_title_breadcrumbs',
			),
			'inline_css' => array(
				'target' => '#featured-title #breadcrumbs a:hover',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'portfolio_page',
			'control' => array(
				'label'  => esc_html__( 'Projects', 'silvertech' ),
				'type' => 'select',
				'choices' => silvertech_get_pages(),
				'active_callback' => 'silvertech_cac_has_single_project',
			),
		),
		array(
			'id' => 'service_page',
			'control' => array(
				'label'  => esc_html__( 'Services', 'silvertech' ),
				'type' => 'select',
				'choices' => silvertech_get_pages(),
				'active_callback' => 'silvertech_cac_has_single_service',
			),
		),
	),
);