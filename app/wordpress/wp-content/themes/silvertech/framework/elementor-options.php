<?php
namespace Silvertech\Settings;

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow as Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

class Silvertech_Settings
{

    public function __construct()
    {	
    	add_action('elementor/documents/register_controls', [$this, 'silvertech_register_settings'], 10);
    }

    public function silvertech_register_settings($element)
    {	 	
    	$post_id = $element->get_id();
    	$post_type = get_post_type($post_id);

        //$default = [];


        $this->silvertech_general_settings($element);

    	if ( ($post_type !== 'project') 
            && ($post_type !== 'post') 
            && ($post_type !== 'service') 
            && ($post_type !== 'pre_footer') )
    		$this->silvertech_page_settings($element);

    	if ( is_singular( 'project' ) ) 
    		$this->silvertech_project_settings($element);

        if ( is_singular( 'post' ) ) {
            $this->silvertech_post_settings($element);
            //$this->silvertech_update_post($element);
        }

        if ( is_singular( 'pre_footer' ) ) 
            $this->silvertech_prefooter_settings($element);  	
    }

    public function silvertech_general_settings($element) {
        $element->start_controls_section(
            'silvertech_general_settings',
            [
                'label' => __('Page Settings', 'silvertech'),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );

        $element->add_control(
            'layout',
            [
                'label'     => __( 'Layout', 'silvertech'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $element->add_control(
            'site_layout_position',
            [
                'label' => __( 'Sidebar Position', 'silvertech' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'sidebar-left' => [
                        'title' => __( 'Sidebar Left', 'silvertech' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'no-sidebar' => [
                        'title' => __( 'No Sidebar', 'silvertech' ),
                        'icon' => 'eicon-ban',
                    ],
                    'sidebar-right' => [
                        'title' => __( 'Sidebar Right', 'silvertech' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
            ]
        );

        // Featured Title
        $element->add_control(
            'featured_title_heading',
            [
                'label'     => __( 'Featured Title', 'silvertech'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $element->add_control(
            'hide_featured_title',
            [
                'label'     => __( 'Hide?', 'silvertech'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'block',
                'options'   => [
                    'none'       => __( 'Yes', 'silvertech'),
                    'block'      => __( 'No', 'silvertech'),
                ],
                'selectors'  => [
                    '{{WRAPPER}} #featured-title' => 'display: {{VALUE}};',
                ],
            ]
        );

        $element->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'featured_title_bg',
                'label' => __( 'Background', 'silvertech' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} #featured-title',
                'condition' => [ 'hide_featured_title' => 'block' ]
            ]
        );

        $element->add_control(
            'custom_featured_title',
            [
                'label'   => __( 'Custom Title', 'silvertech' ),
                'type'    => Controls_Manager::TEXT,
                'label_block' => true,
                'condition' => [ 'hide_featured_title' => 'block' ]
            ]
        );

        $element->add_control(
            'main_content_heading',
            [
                'label'     => __( 'Main Content', 'silvertech'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $element->add_responsive_control(
            'content_padding',
            [
                'label' => __('Content Padding', 'silvertech'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'allowed_dimensions' => [ 'top', 'bottom' ],
                'selectors' => [ 
                    '{{WRAPPER}} #page #main-content' => 'padding-top: {{TOP}}{{UNIT}}; padding-bottom: {{BOTTOM}}{{UNIT}};',
                ],
            ]
        );

        $element->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'main_content_bg',
                'label' => __( 'Background', 'silvertech' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} #main-content',
            ]
        );

        $element->end_controls_section();
    }

    public function silvertech_page_settings($element) {
        // Header
        $element->start_controls_section(
            'silvertech_header_settings',
            [
                'label' => __('Header', 'silvertech'),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );

        $element->add_control(
            'header_heading',
            [
                'label'     => __( 'Header', 'silvertech'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $element->add_control(
            'header_style',
            [
                'label'     => __( 'Header Style', 'silvertech'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'style-2',
                'options'   => [
                    ''             => __( 'Default', 'silvertech'),
                    'style-1' => esc_html__( 'Basic', 'silvertech' ),
                    'style-2' => esc_html__( 'Float', 'silvertech' ),
                    'style-3' => esc_html__( 'Modern', 'silvertech' ),
                    'style-4' => esc_html__( 'Float - Button 2', 'silvertech' ),
                    'style-5' => esc_html__( 'Float - Button 3', 'silvertech' ),
                    'style-6' => esc_html__( 'Float - Header White', 'silvertech' ),
                ],
                'description' => __( 'Update and refresh page to view change', 'silvertech' )
            ]
        );

        // Logo
        $element->add_control(
            'logo_heading',
            [
                'label'     => __( 'Logo', 'silvertech'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $element->add_control(
            'custom_logo',
            [
                'label'   => __( 'Custom Logo', 'silvertech' ),
                'type'    => Controls_Manager::MEDIA,
            ]
        );

        $element->add_responsive_control(
            'logo_width',
            [
                'label'      => __( 'Logo Width', 'silvertech' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'      => [
                    'px' => [
                        'min' => 30,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => 50,
                        'max' => 150,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} #site-logo #site-logo-inner' => 'max-width: {{SIZE}}{{UNIT}} !important;',
                ],
                50
            ]
        );

        $element->add_control(
            'header_extra',
            [
                'label'   => __( 'Extra Classes', 'silvertech' ),
                'type'    => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $element->end_controls_section();

        // Footer
        $element->start_controls_section(
            'silvertech_footer_settings',
            [
                'label' => __('Footer', 'silvertech'),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );

        $element->add_control(
            'footer_heading',
            [
                'label'     => __( 'Footer', 'silvertech'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $element->add_control(
            'footer_style',
            [
                'label'     => __( 'Footer Fixed', 'silvertech'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'basic',
                'options'   => [
                    ''             => __( 'Default', 'silvertech'),
                    'basic' => esc_html__( 'Basic', 'silvertech' ),
                    'fixed' => esc_html__( 'Fixed', 'silvertech' ),
                ],
                'description' => __( 'Update and refresh page to view change', 'silvertech' )
            ]
        );

        $element->add_control(
            'hide_footer',
            [
                'label'     => __( 'Hide?', 'silvertech'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'block',
                'options'   => [
                    'none'       => __( 'Yes', 'silvertech'),
                    'block'      => __( 'No', 'silvertech'),
                ],
                'selectors'  => [
                    '{{WRAPPER}} #footer' => 'display: {{VALUE}};' 
                ],
            ]
        );

        $element->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'footer_bg',
                'label' => __( 'Background', 'silvertech' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} #footer',
                'condition' => [ 'hide_footer' => 'block' ]
            ]
        );

        // Bottom
        $element->add_control(
            'bottom_heading',
            [
                'label'     => __( 'Bottom Bar', 'silvertech'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $element->add_control(
            'hide_bottom',
            [
                'label'     => __( 'Hide?', 'silvertech'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'block',
                'options'   => [
                    'none'       => __( 'Yes', 'silvertech'),
                    'block'      => __( 'No', 'silvertech'),
                ],
                'selectors'  => [
                    '{{WRAPPER}} #bottom' => 'display: {{VALUE}};' 
                ],
            ]
        );

        $element->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'bottom_bg',
                'label' => __( 'Background', 'silvertech' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} #bottom',
                'condition' => [ 'hide_bottom!' => 'none']
            ]
        );

        $element->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'bottom_border',
                'label' => __( 'Border', 'silvertech' ),
                'selector' => '{{WRAPPER}} #bottom',
                'fields_options' => [
                    'border' => [ 'default' => 'solid', ],
                    'width' => [ 
                        'default' => [
                            'top' => 1,
                            'left' => 0,
                            'bottom' => 0,
                            'right' => 0,
                        ] 
                    ]
                ],
                'condition' => [ 'hide_bottom!' => 'none']
            ]
        );

        $element->end_controls_section();
    }

    public function silvertech_project_settings($element) {
    	$element->start_controls_section(
            'silvertech_project_settings',
            [
                'label' => __('Project Settings', 'silvertech'),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );

        $element->add_control(
            'project_title',
            [
                'label'   => __( 'Custom Title', 'silvertech' ),
                'type'    => Controls_Manager::TEXT,
            ]
        );

        $element->add_control(
            'project_desc',
            [
                'label'      => __( 'Short Description', 'silvertech' ),
                'type'       => Controls_Manager::WYSIWYG,
            ]
        );

        $element->end_controls_section();
    }

    public function silvertech_post_settings($element) {

        $element->start_controls_section(
            'silvertech_post_settings',
            [
                'label' => __('Post Settings', 'silvertech'),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );


        $element->add_control(
            'video_url',
            [
                'label'     => __( 'Video URL or Embeded Code', 'silvertech'),
                'type'      => Controls_Manager::TEXT,
                'default'   => '',
            ]
        );

        $element->add_control(
            'gallery_images',
            [
                'label' => __( 'Add Images', 'silvertech' ),
                'type' => Controls_Manager::GALLERY,
                'default' => [],
            ]
        );

        $element->end_controls_section();
    }

    public function silvertech_prefooter_settings($element) {
        $element->start_controls_section(
            'silvertech_prefooter_settings',
            [
                'label' => __('Pre-footer Settings', 'silvertech'),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );

        $element->add_control(
            'pre_footer_heading',
            [
                'label'        => __( 'Show on page', 'silvertech' ),
                'type'         => Controls_Manager::HEADING,
            ]
        );

        $element->add_control(
            'pre_footer_blog',
            [
                'label'        => __( 'Blog', 'silvertech' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'silvertech' ),
                'label_off'    => __( 'Off', 'silvertech' ),
                'return_value' => 'yes',
                'default'      => ''
            ]
        );

        $element->add_control(
            'pre_footer_single_post',
            [
                'label'        => __( 'Blog Single', 'silvertech' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'silvertech' ),
                'label_off'    => __( 'Off', 'silvertech' ),
                'return_value' => 'yes',
                'default'      => ''
            ]
        );

        $element->add_control(
            'pre_footer_shop',
            [
                'label'        => __( 'Shop', 'silvertech' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'silvertech' ),
                'label_off'    => __( 'Off', 'silvertech' ),
                'return_value' => 'yes',
                'default'      => ''
            ]
        );

        $element->add_control(
            'pre_footer_product',
            [
                'label'        => __( 'Product', 'silvertech' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'silvertech' ),
                'label_off'    => __( 'Off', 'silvertech' ),
                'return_value' => 'yes',
                'default'      => ''
            ]
        );

        $element->add_control(
            'pre_footer_project_single',
            [
                'label'        => __( 'Project Single', 'silvertech' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'silvertech' ),
                'label_off'    => __( 'Off', 'silvertech' ),
                'return_value' => 'yes',
                'default'      => ''
            ]
        );

        $element->end_controls_section();
    }
}

new Silvertech_Settings();