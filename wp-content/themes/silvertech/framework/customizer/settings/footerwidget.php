<?php
/**
 * Footer Widget setting for Customizer
 *
 * @package silvertech
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Footer General
$this->sections['silvertech_footer_widget_general'] = array(
	'title' => esc_html__( 'General', 'silvertech' ),
	'panel' => 'silvertech_footerwidget',
	'settings' => array(
		array(
			'id' => 'footer_widgets',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'silvertech' ),
				'type' => 'checkbox',
			),
		),
		// Title Widget
		array(
			'id' => 'heading_footer_widget_title',
			'control' => array(
				'type' => 'silvertech-heading',
				'label' => esc_html__( 'Title Widget', 'silvertech' ),
				'active_callback' => 'silvertech_cac_has_footer_widgets'
			),
		),
		array(
			'id' => 'footer_widget_title_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Title Widget: Margin', 'silvertech' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'silvertech' ),
				'active_callback' => 'silvertech_cac_has_footer_widgets'
			),
			'inline_css' => array(
				'target' => '#footer-widgets .widget .widget-title',
				'alter' => 'margin',
			),
		),
		array(
			'id' => 'footer_widget_title_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Title Widget: Color', 'silvertech' ),
				'active_callback' => 'silvertech_cac_has_footer_widgets'
			),
			'inline_css' => array(
				'target' => '#footer-widgets .widget .widget-title',
				'alter' => 'color',
			),
		),
	),
);

// Footer Widget Search
$this->sections['silvertech_footer_widget_search'] = array(
	'title' => esc_html__( 'Widget: Search', 'silvertech' ),
	'panel' => 'silvertech_footerwidget',
	'settings' => array(
		array(
			'id' => 'footer_widget_search_form_icon_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Icon Color', 'silvertech' ),
			),
			'inline_css' => array(
				'target' => '#footer-widgets .widget.widget_search .search-form .search-submit:before',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'footer_widget_search_form_border_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Border Color', 'silvertech' ),
			),
			'inline_css' => array(
				'target' => '#footer-widgets .widget.widget_search .search-form .search-field',
				'alter' => 'border-color',
			),
		),
		array(
			'id' => 'footer_widget_search_form_border_width',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Border Width', 'silvertech' ),
			),
			'inline_css' => array(
				'target' => '#footer-widgets .widget.widget_search .search-form .search-field',
				'alter' => 'border-width',
			),
		),
	),
);

// Footer Widget Built-In
$this->sections['silvertech_footer_widget_built_in'] = array(
	'title' => esc_html__( 'Widget: Categories, Archives, Meta...', 'silvertech' ),
	'panel' => 'silvertech_footerwidget',
	'settings' => array(
		array(
			'id' => 'footer_widget_built_in_list_padding',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Item Padding', 'silvertech' ),
				'description' => esc_html__( 'Top Right Bottom Left. Ex: 13px 0px 13px 0px', 'silvertech' ),
			),
			'inline_css' => array(
				'target' => array(
					'#footer-widgets .widget.widget_categories ul li',
					'#footer-widgets .widget.widget_meta ul li',
					'#footer-widgets .widget.widget_pages ul li',
					'#footer-widgets .widget.widget_archive ul li'
				),
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'footer_widget_built_in_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Links Color', 'silvertech' ),
			),
			'inline_css' => array(
				'target' => array(
					'#footer-widgets .widget.widget_categories ul li a',
					'#footer-widgets .widget.widget_meta ul li a',
					'#footer-widgets .widget.widget_pages ul li a',
					'#footer-widgets .widget.widget_archive ul li a'
				),
				'alter' => 'color',
			),
		),
	),
);

// Footer Widget Tags
$this->sections['silvertech_footer_widget_tags'] = array(
	'title' => esc_html__( 'Footer Widget: Tags', 'silvertech' ),
	'panel' => 'silvertech_footerwidget',
	'settings' => array(
		array(
			'id' => 'footer_widget_tags_padding',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'silvertech' ),
				'description' => esc_html__( 'Top Right Bottom Left. Ex: 2px 8px 2px 8px', 'silvertech' ),
			),
			'inline_css' => array(
				'target' => '#footer-widgets .widget.widget_tag_cloud .tagcloud a',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'footer_widget_tags_rounded',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Rounded', 'silvertech' ),
				'description' => esc_html__( '0px is square.', 'silvertech' ),
			),
			'inline_css' => array(
				'target' => '#footer-widgets .widget.widget_tag_cloud .tagcloud a:after',
				'alter' => 'border-radius',
			),
		),
		array(
			'id' => 'footer_widget_tags_space_between',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Space Between Items', 'silvertech' ),
				'description' => esc_html__( 'Example: 6px.', 'silvertech' ),
			),
			'inline_css' => array(
				'target' => '#footer-widgets .widget.widget_tag_cloud .tagcloud a',
				'alter' => array(
					'margin-right',
					'margin-bottom'
				),
			),
		),
		array(
			'id' => 'footer_widget_tags_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'silvertech' ),
			),
			'inline_css' => array(
				'target' => '#footer-widgets .widget.widget_tag_cloud .tagcloud a',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'footer_widget_tags_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background Color', 'silvertech' ),
			),
			'inline_css' => array(
				'target' => '#footer-widgets .widget.widget_tag_cloud .tagcloud a:after',
				'alter' => 'background-color',
			),
		),
	),
);

// Footer Widget Links
$this->sections['silvertech_footer_widget_links'] = array(
	'title' => esc_html__( 'Footer Widget: Links', 'silvertech' ),
	'panel' => 'silvertech_footerwidget',
	'settings' => array(
		array(
			'id' => 'footer_widget_links_padding',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'silvertech' ),
				'description' => esc_html__( 'Top Right Bottom Left. Ex: 10px 0px 10px 0px', 'silvertech' ),
			),
			'inline_css' => array(
				'target' => '#footer-widgets .widget.widget_links ul li',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'footer_widget_links_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'silvertech' ),
			),
			'inline_css' => array(
				'target' => '#footer-widgets .widget.widget_links ul li a',
				'alter' => 'color',
			),
		),
	),
);