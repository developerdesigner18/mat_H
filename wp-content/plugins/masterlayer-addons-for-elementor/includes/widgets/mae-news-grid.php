<?php
/*
Widget Name: News Grid
Description: 
Author: Masterlayer
Author URI: http://masterlayer.edu.vn
Plugin URI: https://masterlayer.edu.vn/masterlayer-addons-for-masterlayer/
*/

namespace MasterlayerAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_News_Grid_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    public function get_script_depends() {
        return [ 'cubeportfolio', 'waitforimages' ];
    }

    public function get_style_depends() {
        return [ 'cubeportfolio' ];
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-news-grid';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'News Grid', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    } 

    protected function register_controls() {
        // General
        $this->start_controls_section( 'content_section',
            [
                'label' => __( 'Content', 'masterlayer' ),
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label'     => __( 'Posts to show', 'masterlayer'),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 6,
                'min'     => 2,
                'max'     => 20,
                'step'    => 1
            ]
        );

        $this->add_control(
            'cat_slug',
            [
                'label'   => __( 'Category Slug (optional)', 'masterlayer' ),
                'type'    => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'exclude_cat_slug',
            [
                'label'   => __( 'Exclude Cat Slug (Optional)', 'masterlayer' ),
                'type'    => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'category',
            [
                'label'        => __( 'Show Category', 'masterlayer' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'masterlayer' ),
                'label_off'    => __( 'Off', 'masterlayer' ),
                'return_value' => 'true',
                'default'      => 'true',
            ]
        );

        $this->add_control(
            'desc',
            [
                'label'        => __( 'Show Description', 'masterlayer' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'masterlayer' ),
                'label_off'    => __( 'Off', 'masterlayer' ),
                'return_value' => 'true',
                'default'      => '',
            ]
        );

        $this->add_control(
            'url_heading',
            [
                'label'     => __( 'URL', 'masterlayer'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'url_type',
            [
                'label'     => __( 'URL Type', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'link',
                'options'   => [
                    'none'      => __( 'None', 'masterlayer'),
                    'link'      => __( 'Link', 'masterlayer'),
                    'button'    => __( 'Button', 'masterlayer'),
                ],
            ]
        );

        $this->add_control(
            'url_text',
            [
                'label'   => __( 'URL Text', 'masterlayer' ),
                'type'    => Controls_Manager::TEXT,
                'default' => __( 'Read More', 'masterlayer' ),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [ 'url_type!' => ['none'] ]
            ]
        );

        $this->add_control(
            'link_icon_position',
            [
                'label'     => __( 'Has Icon ?', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'right',
                'options'   => [
                    'none'      => __( 'None', 'masterlayer'),
                    'left'      => __( 'Icon Left', 'masterlayer'),
                    'right'     => __( 'Icon Right', 'masterlayer')
                ],
                'condition' => [ 'url_type' => 'link' ]
            ]
        );

        $this->add_control(
            'link_icon',
            [
                'label' => __( 'Link Icon', 'masterlayer' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fa fa-arrow-right',
                    'library' => 'solid',
                ],
                'label_block'      => false,
                'skin'             => 'inline',
                'condition' => [ 
                    'link_icon_position!' => 'none', 
                    'url_type' => 'link',
                ]
            ]
        );

        $this->add_control(
            'button_style',
            [
                'label'     => __( 'Button Style', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'btn-accent',
                'options'   => [
                    'btn-accent'      => __( 'Accent', 'masterlayer'),
                    'btn-light'       => __( 'Light', 'masterlayer'),
                    'btn-dark'     => __( 'Dark', 'masterlayer')
                ],
                'condition' => [ 'url_type' => 'button' ]
            ]
        );

        $this->add_control(
            'button_icon_position',
            [
                'label'     => __( 'Has Icon ?', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'right',
                'options'   => [
                    'none'      => __( 'None', 'masterlayer'),
                    'left'      => __( 'Icon Left', 'masterlayer'),
                    'right'     => __( 'Icon Right', 'masterlayer')
                ],
                'condition' => [ 'url_type' => 'button' ]
            ]
        );

        $this->add_control(
            'button_icon',
            [
                'label' => __( 'Button Icon', 'masterlayer' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fa fa-arrow-right',
                    'library' => 'solid',
                ],
                'label_block'      => false,
                'skin'             => 'inline',
                'condition' => [ 
                    'button_icon_position!' => 'none', 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->end_controls_section();

        // Grid
        $this->start_controls_section( 'setting_general_section',
            [
                'label' => __( 'General Settings', 'masterlayer' ),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );

        $this->add_control(
            'filter',
            [
                'label'        => __( 'Filter', 'masterlayer' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'masterlayer' ),
                'label_off'    => __( 'Off', 'masterlayer' ),
                'return_value' => 'true',
                'default'      => '',
            ]
        );

        $this->add_control(
            'pagination',
            [
                'label'        => __( 'Pagination', 'masterlayer' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'masterlayer' ),
                'label_off'    => __( 'Off', 'masterlayer' ),
                'return_value' => 'true',
                'default'      => '',
            ]
        );

        $this->add_control(
            'filter_all',
            [
                'label'   => __( 'Button Filter All: Text', 'masterlayer' ),
                'type'    => Controls_Manager::TEXT,
                'default' => __( 'All', 'masterlayer')
            ]
        );

        $this->add_responsive_control(
            'layout',
            [
                'label' => __( 'Layout Mode', 'masterlayer' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'grid' => [
                        'title' => __( 'Grid', 'masterlayer' ),
                        'icon' => 'eicon-gallery-grid',
                    ],
                    'mosaic' => [
                        'title' => __( 'Mosaic', 'masterlayer' ),
                        'icon' => 'eicon-inner-section',
                    ],
                ],
                'separator' => 'before',
                'default' => 'grid',
            ]
        );

        $this->add_control(
            'columns',
            [
                'label'     => __( 'Columns', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '2,2,2,1',
                'options'   => [
                    '1,1,1,1'      => __( '1', 'masterlayer'),
                    '2,2,2,1'      => __( '2', 'masterlayer'),
                    '3,3,2,1'      => __( '3', 'masterlayer'),
                    '4,3,2,1'      => __( '4', 'masterlayer'),
                ]
            ]
        );

        $this->add_control(
            'gapHorizontal',
            [
                'label'     => __( 'Gap Horizontal', 'masterlayer'),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 30,
                'min'     => 0,
                'max'     => 100,
                'step'    => 1
            ]
        );

        $this->add_control(
            'gapVertical',
            [
                'label'     => __( 'Gap Vertical', 'masterlayer'),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 30,
                'min'     => 0,
                'max'     => 100,
                'step'    => 1
            ]
        );

        $this->end_controls_section(); 

        // General Style
        $this->start_controls_section( 'style_general_section',
            [
                'label' => __( 'General', 'masterlayer' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'box' );

        $this->start_controls_tab(
            'box_normal',
            [
                'label' => __( 'Normal', 'masterlayer' ),
            ]
        );

        $this->add_control(
            'color_heading',
            [
                'label' => __( 'Color', 'masterlayer' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'cat_color',
            [
                'label' => __( 'Category', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .news-cat' => 'color: {{VALUE}};',
                ],
                'condition' => [ 'category' => 'true' ]
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Title', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-news .headline-2' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label' => __( 'Description', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-news .desc' => 'color: {{VALUE}};',
                ],
                'condition' => [ 'desc' => 'true' ]
            ]
        );

        $this->add_control(
            'bg_heading',
            [
                'label' => __( 'Background', 'masterlayer' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'box_bg',
                'label' => __( 'Background', 'masterlayer' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .master-news .content-wrap',
            ]
        );

        $this->add_control(
            'border_heading',
            [
                'label' => __( 'Border', 'masterlayer' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => __( 'Border', 'masterlayer' ),
                'selector' => '{{WRAPPER}} .master-news',
            ]
        );

        $this->add_control(
            'rounded_heading',
            [
                'label' => __( 'Rounded', 'masterlayer' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => __('Rounded', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .master-news' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'shadow_heading',
            [
                'label' => __( 'Box Shadow', 'masterlayer' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'selector' => '{{WRAPPER}} .master-news',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'news_box_hover',
            [
                'label' => __( 'Hover', 'masterlayer' ),
            ]
        );

        $this->add_control(
            'color_heading_hover',
            [
                'label' => __( 'Color', 'masterlayer' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'cat_color_hover',
            [
                'label' => __( 'Category', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-news:hover .news-cat' => 'color: {{VALUE}};',
                ],
                'condition' => [ 'category' => 'true' ]
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label' => __( 'Title', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-news:hover .headline-2' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'desc_color_hover',
            [
                'label' => __( 'Description Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-news:hover .desc' => 'color: {{VALUE}};',
                ],
                'condition' => [ 'desc' => 'true' ]
            ]
        );

        $this->add_control(
            'bg_heading_hover',
            [
                'label' => __( 'Background', 'masterlayer' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'box_bg_hover',
                'label' => __( 'Background', 'masterlayer' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .master-news .content-wrap',
            ]
        );

        $this->add_control(
            'border_heading_hover',
            [
                'label' => __( 'Border', 'masterlayer' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border_hover',
                'label' => __( 'Border', 'masterlayer' ),
                'selector' => '{{WRAPPER}} .master-news:hover',
            ]
        );

        $this->add_control(
            'rounded_heading_hover',
            [
                'label' => __( 'Rounded', 'masterlayer' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'border_radius_hover',
            [
                'label' => __('Rounded', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .master-news:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'shadow_heading_hover',
            [
                'label' => __( 'Box Shadow', 'masterlayer' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow_hover',
                'selector' => '{{WRAPPER}} .master-news:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // URL
        $this->start_controls_section( 'setting_url_section',
            [
                'label' => __( 'URL', 'masterlayer' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [ 'url_type!' => 'none' ]
            ]
        );

        // URL - Link

        $this->add_responsive_control(
            'link_icon_font_size',
            [
                'label'      => __( 'Icon Font Size', 'masterlayer' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'      => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                    ],
                    '%' => [
                        'min' => 50,
                        'max' => 150,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 16,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .master-link .icon ' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                50,
                'condition' => [ 
                    'link_icon_position!' => 'none', 
                    'url_type' => 'link',
                ]
            ]
        );

        $this->add_control(
            'link_icon_margin',
            [
                'label' => __('Icon Margin', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .master-link .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [ 
                    'link_icon_position!' => 'none', 
                    'url_type' => 'link',
                ]
            ]
        );

        $this->start_controls_tabs( 'link_hover_tabs' );

        // Link normal
        $this->start_controls_tab(
            'link_normal',
            [
                'label' => __( 'Normal', 'masterlayer' ),
                'condition' => [ 'url_type' => 'link' ]
            ]
        );

        $this->add_control(
            'link_color',
            [
                'label' => __( 'Text Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-link' => 'color: {{VALUE}};',
                ],
                'condition' => [ 
                    'url_type' => 'link',
                ]
            ]
        );

        $this->add_control(
            'link_icon_color',
            [
                'label' => __( 'Icon Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-link .icon' => 'color: {{VALUE}};',
                ],
                'condition' => [ 
                    'link_icon_position!' => 'none', 
                    'url_type' => 'link',
                ]
            ]
        );

        $this->end_controls_tab();

        // Box hover
        $this->start_controls_tab(
            'link_box_hover',
            [
                'label' => __( 'Box Hover', 'masterlayer' ),
                'condition' => [ 'url_type' => 'link' ]
            ]
        );

        $this->add_control(
            'link_color_box_hover',
            [
                'label' => __( 'Text Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-news:hover .master-link' => 'color: {{VALUE}};',
                ],
                'condition' => [ 
                    'url_type' => 'link',
                ]
            ]
        );

        $this->add_control(
            'link_icon_color_box_hover',
            [
                'label' => __( 'Icon Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-news:hover .master-link .icon' => 'color: {{VALUE}};',
                ],
                'condition' => [ 
                    'link_icon_position!' => 'none', 
                    'url_type' => 'link',
                ]
            ]
        );

        $this->end_controls_tab();

        // Link hover
        $this->start_controls_tab(
            'link_hover',
            [
                'label' => __( 'URL Hover', 'masterlayer' ),
                'condition' => [ 'url_type' => 'link' ]
            ]
        );

        $this->add_control(
            'link_color_hover',
            [
                'label' => __( 'Text Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-link:hover' => 'color: {{VALUE}} !important;',
                ],
                'condition' => [ 
                    'url_type' => 'link',
                ]
            ]
        );

        $this->add_control(
            'link_icon_color_hover',
            [
                'label' => __( 'Icon Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-link:hover .icon' => 'color: {{VALUE}} !important;',
                ],
                'condition' => [ 
                    'link_icon_position!' => 'none', 
                    'url_type' => 'link',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        // URL - Button
        $this->add_responsive_control(
            'button_icon_font_size',
            [
                'label'      => __( 'Icon Font Size', 'masterlayer' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'      => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                    ],
                    '%' => [
                        'min' => 50,
                        'max' => 150,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 16,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .master-button .icon ' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
                50,
                'condition' => [ 
                    'button_icon_position!' => 'none', 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->add_control(
            'button_icon_margin',
            [
                'label' => __('Icon Margin', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .master-button .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [ 
                    'button_icon_position!' => 'none', 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->start_controls_tabs( 'button_hover_tabs' );

        // Button normal
        $this->start_controls_tab(
            'button_normal',
            [
                'label' => __( 'Normal', 'masterlayer' ),
                'condition' => [ 'url_type' => 'button' ]
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => __( 'Text Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-button' => 'color: {{VALUE}};',
                ],
                'condition' => [ 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->add_control(
            'button_icon_color',
            [
                'label' => __( 'Icon Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-button .icon' => 'color: {{VALUE}};',
                ],
                'condition' => [ 
                    'button_icon_position!' => 'none', 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => __( 'Background Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-button' => 'background-color: {{VALUE}};',
                ],
                'condition' => [ 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->add_control(
            'button_rounded',
            [
                'label' => __('Rounded', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [ 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->add_control(
            'button_border_color',
            [
                'label' => __( 'Border Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-button' => 'border-color: {{VALUE}};'
                ],
                'condition' => [ 
                    'url_type' => 'button',
                    'button_style' => [ 'btn-outline' ]
                ]
            ]
        );

        $this->add_control(
            'button_border_width',
            [
                'label' => __('Border Width', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'top' => 1,
                    'right' => 1,
                    'bottom' => 1,
                    'left' => 1,
                    'unit' => 'px',
                    'isLinked' => true
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-button' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [ 
                    'url_type' => 'button',
                    'button_style' => [ 'btn-outline' ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .master-button',
                'condition' => [ 'url_type' => 'button' ]
            ]
        );

        $this->end_controls_tab();

        // Box hover
        $this->start_controls_tab(
            'button_box_hover',
            [
                'label' => __( 'Box Hover', 'masterlayer' ),
                'condition' => [ 'url_type' => 'button' ]
            ]
        );

        $this->add_control(
            'button_color_box_hover',
            [
                'label' => __( 'Text Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-news:hover .master-button' => 'color: {{VALUE}};',
                ],
                'condition' => [ 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->add_control(
            'button_icon_color_box_hover',
            [
                'label' => __( 'Icon Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-news:hover .master-button .icon' => 'color: {{VALUE}};',
                ],
                'condition' => [ 
                    'button_icon_position!' => 'none', 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->add_control(
            'button_bg_color_box_hover',
            [
                'label' => __( 'Background Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-news:hover .master-button' => 'background-color: {{VALUE}};',
                ],
                'condition' => [ 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->add_control(
            'button_rounded_box_hover',
            [
                'label' => __('Rounded', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .master-news:hover .master-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [ 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->add_control(
            'button_border_color_box_hover',
            [
                'label' => __( 'Border Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-news:hover .master-button' => 'border-color: {{VALUE}};'
                ],
                'condition' => [ 
                    'url_type' => 'button',
                    'button_style' => [ 'btn-outline' ]
                ]
            ]
        );

        $this->add_control(
            'button_border_width_box_hover',
            [
                'label' => __('Border Width', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'top' => 1,
                    'right' => 1,
                    'bottom' => 1,
                    'left' => 1,
                    'unit' => 'px',
                    'isLinked' => true
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-news:hover .master-button' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [ 
                    'url_type' => 'button',
                    'button_style' => [ 'btn-outline' ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow_box_hover',
                'selector' => '{{WRAPPER}} .master-news:hover .master-button',
                'condition' => [ 'url_type' => 'button' ]
            ]
        );

        $this->end_controls_tab();

        // Button hover
        $this->start_controls_tab(
            'button_hover',
            [
                'label' => __( 'URL Hover', 'masterlayer' ),
                'condition' => [ 'url_type' => 'button' ]
            ]
        );

        $this->add_control(
            'button_color_hover',
            [
                'label' => __( 'Text Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-button:hover' => 'color: {{VALUE}} !important;',
                ],
                'condition' => [ 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->add_control(
            'button_icon_color_hover',
            [
                'label' => __( 'Icon Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-button:hover .icon' => 'color: {{VALUE}} !important;',
                ],
                'condition' => [ 
                    'button_icon_position!' => 'none', 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->add_control(
            'button_bg_color_hover',
            [
                'label' => __( 'Background Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-news .master-button:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => [ 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->add_control(
            'button_rounded_hover',
            [
                'label' => __('Rounded', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .master-news .master-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [ 
                    'url_type' => 'button',
                ]
            ]
        );

        $this->add_control(
            'button_border_color_hover',
            [
                'label' => __( 'Border Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-news .master-button:hover' => 'border-color: {{VALUE}};'
                ],
                'condition' => [ 
                    'url_type' => 'button',
                    'button_style' => [ 'btn-outline' ]
                ]
            ]
        );

        $this->add_control(
            'button_border_width_hover',
            [
                'label' => __('Border Width', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'top' => 1,
                    'right' => 1,
                    'bottom' => 1,
                    'left' => 1,
                    'unit' => 'px',
                    'isLinked' => true
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-news .master-button:hover' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [ 
                    'url_type' => 'button',
                    'button_style' => [ 'btn-outline' ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow_hover',
                'selector' => '{{WRAPPER}} .master-news .master-button:hover',
                'condition' => [ 'url_type' => 'button' ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // Spacing
        $this->start_controls_section( 'setting_spacing_section',
            [
                'label' => __( 'Spacing', 'masterlayer' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'filter_margin',
            [
                'label' => __('Filter Margin', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .newss-filter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [ 'filter' => 'true' ]
            ]
        );

        $this->add_responsive_control(
            'filter_item_margin',
            [
                'label' => __('Filter Item Margin', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .newss-filter .cbp-filter-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [ 'filter' => 'true' ]
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label' => __('Content Padding', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-news .content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'cat_margin',
            [
                'label' => __('Separator Margin', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-news .news-cat' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [ 'category' => 'true' ]
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => __('Title Margin', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-news .headline-2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'desc_margin',
            [
                'label' => __('Description Margin', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-news .desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [ 'desc' => 'true' ]
            ]
        );

        $this->end_controls_section();

        // Typography
        $this->start_controls_section( 'setting_typography_section',
            [
                'label' => __( 'Typography', 'masterlayer' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'filter_typography',
                'label' => __('filter', 'masterlayer'),
                'selector' => '{{WRAPPER}} .newss-filter .cbp-filter-item',
                'condition' => [ 'filter' => 'true' ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'cat_typography',
                'label' => __('Category', 'masterlayer'),
                'selector' => '{{WRAPPER}} .news-cat',
                'condition' => [ 'category' => 'true' ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'headline_typography',
                'label' => __('Title', 'masterlayer'),
                'selector' => '{{WRAPPER}} .headline-2'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typography',
                'label' => __('Description', 'masterlayer'),
                'selector' => '{{WRAPPER}} .desc',
                'condition' => [ 'desc' => 'true' ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'link_typography',
                'label' => __('Link', 'masterlayer'),
                'selector' => '{{WRAPPER}} .master-link',
                'condition' => [ 'url_type' => 'link' ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => __('Button', 'masterlayer'),
                'selector' => '{{WRAPPER}} .master-button',
                'condition' => [ 'url_type' => 'button' ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $config = array();
        $cls = $css = $data = "";
        $settings = $this->get_settings_for_display();

        if ( get_query_var('paged') ) {
           $paged = get_query_var('paged');
        } elseif ( get_query_var('page') ) {
           $paged = get_query_var('page');
        } else {
           $paged = 1;
        }

        $args = array(
            'post_type' => 'post',
            'posts_per_page' => $settings['posts_per_page'],
            'paged'     => $paged
        );

        if ( $settings['cat_slug'] ) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'category',
                    'field'    => 'slug',
                    'terms'    => $settings['cat_slug']
                ),
            );
        }

        if ( $settings['exclude_cat_slug'] ) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'category',
                    'field' => 'slug',
                    'terms' => $settings['exclude_cat_slug'],
                    'operator' => 'NOT IN'
                ),
            );
        }

        $query = new \WP_Query( $args );
        if ( ! $query->have_posts() ) { esc_html_e( 'News item not found!', 'deeper' ); return; }

        // Data config for grid
        $config['columns'] = $settings['columns'];
        $config['gapHorizontal'] = $settings['gapHorizontal'];
        $config['gapVertical'] = $settings['gapVertical'];
        $config['layoutMode'] = $settings['layout'];
        if ( $settings['layout'] == 'mosaic' ) {
            $config['gridAdjustment'] = 'default';
            $config['sortToPreventGaps'] = false;
        }
        
        $data = 'data-config=\'' . json_encode( $config ) . '\'';

        $cls = 'mlr-' . rand();
        ?>

        <div class="master-news-grid <?php echo esc_attr($cls); ?>" <?php echo $data; ?>>
            <div class="galleries cbp">
                <?php 

                // Filter
                if ( $settings['filter'] ) { ?>
                    <div class="news-filter">                                
                        <div class="inner">
                            <?php if ( $settings['filter_all'] )
                                echo '<div data-filter="*" class="cbp-filter-item button-all"><span>'. esc_html( $settings['filter_all'] ) .'</span><div class="cbp-filter-counter"></div></div>';

                            if ( $settings['cat_slug'] ) {
                                $term = strtolower( str_replace( ' ', '-', $settings['cat_slug'] ) );
                                $term = get_term_by( 'slug', $settings['cat_slug'], 'category' ); 
                                if ( $term ) $terms = get_term_children( $term->term_id, 'category' );

                                foreach( $terms as $term ) {
                                    $t = get_term_by( 'id', $term, 'category' );
                                    echo '<div data-filter=".'. esc_attr( $t->slug ) .'" class="cbp-filter-item" title="'. esc_attr( $t->name ) .'"><span>'. $t->name . '</span><div class="cbp-filter-counter"></div></div>';
                                }
                            } else {
                                $terms = get_terms( 'category' );
                                foreach ( $terms as $term ) {
                                    if ( $term->parent == 0 )
                                        echo '<div data-filter=".'. esc_attr( $term->slug ) .'" class="cbp-filter-item" title="'. esc_attr( $term->name ) .'"><span>'. $term->name .'</span><div class="cbp-filter-counter"></div></div>';
                                }
                            } ?>
                        </div><!-- /.inner -->
                    </div><!-- /#project-filter -->
                <?php } ?>

                <?php
                if ( $query->have_posts() ) : ?>
                    <?php while ( $query->have_posts() ) : $query->the_post(); 
                        $url = $desc = $title = $cat = '';

                        // Title
                        if ( mae_get_mod('news_title') ) {
                            $title = sprintf(
                                '<h3 class="headline-2"><a href="%2$s">%1$s</a></h3>',
                                esc_html( mae_get_mod('news_title') ),
                                esc_url( get_the_permalink() ) );  
                        } else {
                            $title = sprintf(
                                '<h3 class="headline-2"><a href="%2$s">%1$s</a></h3>',
                                esc_html( get_the_title() ),
                                esc_url( get_the_permalink() ) );  
                        }

                        // Post date
                        $post_date = sprintf('<span class="post-date">%1$s. <span class="time"> %2$s</span></span>', 
                            get_the_date(), 
                            get_post_time( 'g:i A' )
                        );


                        // Desciption
                        if ( $settings['desc'] ) {
                            $desc = sprintf('<div class="desc">%1$s</div>', get_the_excerpt() );
                        };

                        // Category
                        $categories = get_the_category();

                        foreach ($categories as $key => $cat) {
                            $cat_string = sprintf( '<span class="cat-item"><a class="post-cat" href="%2$s">%1$s</a></span>',
                                $cat->cat_name,
                                get_category_link( $cat->cat_ID )
                            );
                        }
                        
                        // Image
                        $image = sprintf(
                            '<div class="thumb" style="background-image:url(%2$s)">%1$s</div>',
                            get_the_post_thumbnail( get_the_ID(), 'full' ),
                            esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) )
                        );

                        // URL
                        if ( $settings['url_type'] == 'link' || 'button')
                            $url = $this->render_link( get_the_permalink(), $settings['url_text'] );

                        global $post;
                        $term_list = '';
                        $terms = get_the_terms( $post->ID, 'category' );

                        if ( $terms ) {
                            foreach ( $terms as $term ) {
                                $term_list .= $term->slug .' ';
                            }
                        } ?>

                        <div class="cbp-item <?php echo esc_attr( $term_list ); ?>">
                            <div class="master-news">
                                <?php 
                                echo $image;
                                echo '<div class="content-wrap">';
                                echo '<div class="text-wrap">';
                                echo $post_date;
                                echo $cat_string;
                                echo $title;
                                echo $desc;
                                echo '</div>';
                                echo $url;
                                echo '</div>'
                                ?>
                            </div>
                        </div>
                    <?php endwhile; 
                endif; wp_reset_postdata(); ?>
            </div><!-- galleries -->
        </div><!-- master-portfolio -->

        <?php 
        if ( 'true' == $settings['pagination'] ) {
            echo '<div class="news-nav">';
            silvertech_pagination($query);
            echo '</div>';
        } ?>

        <?php 
    }

    public function render_link( $url, $text ) {
        $link = $this->get_settings_for_display();

        if ($link['url_type'] == 'link') {
            $cls = "";
            $cls .= ' icon-' . $link['link_icon_position'];

            $link_icon = '';
            if ($link['link_icon'])  {
                $link_icon = sprintf('<span class="icon %1$s"></span>', $link['link_icon']['value']);
            }
            
            ob_start(); ?>
            <div class="url-wrap">
                <a class="master-link <?php echo esc_attr($cls); ?>" href="<?php echo esc_url($url); ?>">
                    <?php if ( $link['link_icon_position'] == 'left' ) echo $link_icon; ?>
                    <span><?php echo $text; ?></span>
                    <?php if ( $link['link_icon_position'] == 'right' ) echo $link_icon; ?>
                </a>
            </div>

            <?php
            $return = ob_get_clean();
            return $return;
        } else if ($link['url_type'] == 'button') {
            $button = $link;
            $cls = "";
            $cls .= $button['button_style'] . ' icon-' . $button['button_icon_position'];

            $button_icon = '';
            if ($button['button_icon'])  {
                $button_icon = sprintf('<span class="icon %1$s"></span>', $button['button_icon']['value']);
            }
            
            ob_start(); ?>
            <div class="url-wrap">
                <a class="master-button small <?php echo esc_attr($cls); ?>" href="<?php echo esc_url($url); ?>">
                    <?php if ( $button['button_icon_position'] == 'left' ) echo $button_icon; ?>
                    <?php echo $text; ?>
                    <span class="hover-effect"></span>
                    <?php if ( $button['button_icon_position'] == 'right' ) echo $button_icon; ?>
                </a>
            </div>

            <?php
            $return = ob_get_clean();
            return $return;
        }

    }

    protected function content_template() {}
}

