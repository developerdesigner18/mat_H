<?php
/**
 * Bottom Bar setting for Customizer
 *
 * @package silvertech
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bottom Bar General
$this->sections['silvertech_bottombar_general'] = array(
	'title' => esc_html__( 'General', 'silvertech' ),
	'panel' => 'silvertech_bottombar',
	'settings' => array(
		array(
			'id' => 'bottom_bar',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'silvertech' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'bottom_bar_style',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Style', 'silvertech' ),
				'type' => 'select',
				'default' => 'style-1',
				'choices' => array(
					'style-1' => esc_html__( 'Only Copyright', 'silvertech' ),
					'style-2' => esc_html__( 'Copyright + Menu', 'silvertech' ),
				),
				'active_callback' => 'silvertech_cac_has_bottombar',
			),
		),
		array(
			'id' => 'bottom_copyright',
			'transport' => 'postMessage',
			'default' => '&copy; Silvertech - Technology WordPress Theme. All Right Reserved.',
			'control' => array(
				'label' => esc_html__( 'Copyright', 'silvertech' ),
				'type' => 'silvertech_textarea',
				'active_callback' => 'silvertech_cac_has_bottombar',
			),
		),
		array(
			'id' => 'bottom_padding',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'silvertech' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'silvertech' ),
				'active_callback'=> 'silvertech_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => '#bottom .bottom-bar-inner-wrap',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'bottom_background',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'silvertech' ),
				'active_callback'=> 'silvertech_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => '#bottom',
				'alter' => 'background',
			),
		),
		array(
			'id' => 'bottom_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Background Image', 'silvertech' ),
				'active_callback' => 'silvertech_cac_has_bottombar',
			),
		),
		array(
			'id' => 'bottom_background_img_style',
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
				'active_callback' => 'silvertech_cac_has_bottombar',
			),
		),
		array(
			'id' => 'bottom_color',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'silvertech' ),
				'active_callback'=> 'silvertech_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => '#bottom',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'line_color',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'color',
				'label' => esc_html__( 'Line Color', 'silvertech' ),
				'active_callback'=> 'silvertech_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => '#bottom:before',
				'alter' => 'background-color',
			),
		),
	),
);

// Bottom Logo
$this->sections['silvertech_bottom_logo'] = array(
	'title' => esc_html__( 'Logo', 'silvertech' ),
	'panel' => 'silvertech_bottombar',
	'settings' => array(
		array(
			'id' => 'bottom_custom_logo',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Logo Image', 'silvertech' ),
				'type' => 'image',
			),
		),
		array(
			'id' => 'bottom_logo_width',
			'control' => array(
				'label' => esc_html__( 'Logo Width', 'silvertech' ),
				'type' => 'text',
			),
		),
	)
);
