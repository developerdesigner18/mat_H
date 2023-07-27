<?php
/**
 * Projects setting for Customizer
 *
 * @package silvertech
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Project Related General
$this->sections['silvertech_projects_general'] = array(
	'title' => esc_html__( 'General', 'silvertech' ),
	'panel' => 'silvertech_projects',
	'settings' => array(
		array(
			'id' => 'project_related',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Enable Related Project', 'silvertech' ),
				'type' => 'checkbox',
				'active_callback' => 'silvertech_cac_has_single_project',
			),
		),
		array(
			'id' => 'project_single_featured_title_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Single Project: Featured Title Background', 'silvertech' ),
				'active_callback' => 'silvertech_cac_has_related_project',
			),
		),
		array(
			'id' => 'related_pre_title', 
			'default' => esc_html__( 'EXPLORE PROJECTS', 'silvertech' ),
			'control' => array(
				'label' => esc_html__( 'Project Related Pre-Title', 'silvertech' ),
				'type' => 'silvertech_textarea',
				'rows' => 3,
				'active_callback' => 'silvertech_cac_has_related_project',
			),
		),
		array(
			'id' => 'related_title',
			'default' => esc_html__( 'OUR RECENT PROJECTS', 'silvertech' ),
			'control' => array(
				'label' => esc_html__( 'Project Related Title', 'silvertech' ),
				'type' => 'silvertech_textarea',
				'rows' => 3,
				'active_callback' => 'silvertech_cac_has_related_project',
			),
		),
		array(
			'id' => 'project_related_query',
			'default' => 7,
			'control' => array(
				'label' => esc_html__( 'Number of items', 'silvertech' ),
				'type' => 'number',
				'active_callback' => 'silvertech_cac_has_related_project',
			),
		),
		array(
			'id' => 'project_related_column',
			'default' => '3',
			'control' => array(
				'label' => esc_html__( 'Columns', 'silvertech' ),
				'type' => 'select',
				'choices' => array(
					'4' => '4',
					'3' => '3',
					'2' => '2',
				),
				'active_callback' => 'silvertech_cac_has_related_project',
			),
		),
		array(
			'id' => 'project_related_item_spacing',
			'default' => 30,
			'control' => array(
				'label' => esc_html__( 'Spacing between items', 'silvertech' ),
				'type' => 'number',
				'active_callback' => 'silvertech_cac_has_related_project',
			),
		),
	),
);