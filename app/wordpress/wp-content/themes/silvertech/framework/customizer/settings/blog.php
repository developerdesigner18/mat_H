<?php
/**
 * Blog setting for Customizer
 *
 * @package silvertech
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Blog Posts General
$this->sections['silvertech_blog_post'] = array(
	'title' => esc_html__( 'General', 'silvertech' ),
	'panel' => 'silvertech_blog',
	'settings' => array(
		array(
			'id' => 'blog_featured_title',
			'default' => esc_html__( 'Our Blog', 'silvertech' ),
			'control' => array(
				'label' => esc_html__( 'Blog Featured Title', 'silvertech' ),
				'type' => 'text',
			),
		),
		array(
			'id' => 'blog_entry_content_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Entry Content Background Color', 'silvertech' ),
			),
			'inline_css' => array(
				'target' => '.post-content-wrap',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'blog_entry_content_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Entry Content Padding', 'silvertech' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'silvertech' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-content-wrap',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'blog_entry_bottom_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Entry Bottom Margin', 'silvertech' ),
				'description' => esc_html__( 'Example: 30px.', 'silvertech' ),
			),
			'inline_css' => array(
				'target' => '.hentry',
				'alter' => 'margin-top',
			),
		),
		array(
			'id' => 'blog_entry_border_width',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Entry Border Width', 'silvertech' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 0px 2px 0px 0px', 'silvertech' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-content-wrap',
				'alter' => 'border-width',
			),
		),
		array(
			'id' => 'blog_entry_border_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Entry Border Color', 'silvertech' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-content-wrap',
				'alter' => 'border-color',
			),
		),
		array(
			'id' => 'blog_entry_composer',
			'default' => 'meta,title,avatar,excerpt_content,readmore',
			'control' => array(
				'label' => esc_html__( 'Entry Content Elements', 'silvertech' ),
				'type' => 'silvertech-sortable',
				'object' => 'Silvertech_Customize_Control_Sorter',
				'choices' => array(
					'meta'            => esc_html__( 'Meta', 'silvertech' ),
					'title'           => esc_html__( 'Title', 'silvertech' ),
					'avatar'            => esc_html__( 'Avatar', 'silvertech' ),
					'excerpt_content' => esc_html__( 'Excerpt', 'silvertech' ),
					'readmore'        => esc_html__( 'Read More', 'silvertech' ),

				),
				'desc' => esc_html__( 'Drag and drop elements to re-order.', 'silvertech' ),
			),
		),
	),
);

// Blog Posts Media
$this->sections['silvertech_blog_post_media'] = array(
	'title' => esc_html__( 'Blog Post - Media', 'silvertech' ),
	'panel' => 'silvertech_blog',
	'settings' => array(
		array(
			'id' => 'blog_media_margin_bottom',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Bottom Margin', 'silvertech' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-media',
				'alter' => 'margin-bottom',
			),
		),
	),
);

// Blog Posts Title
$this->sections['silvertech_blog_post_title'] = array(
	'title' => esc_html__( 'Blog Post - Title', 'silvertech' ),
	'panel' => 'silvertech_blog',
	'settings' => array(
		array(
			'id' => 'blog_title_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Margin', 'silvertech' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'silvertech' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-title',
				'alter' => 'margin',
			),
		),
		array(
			'id' => 'blog_title_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'silvertech' ),
			),
			'inline_css' => array(
				'target' => array(
					'.hentry .post-title a',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_title_color_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color Hover', 'silvertech' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-title a:hover',
				'alter' => 'color',
			),
		),
	),
);

// Blog Posts Meta
$this->sections['silvertech_blog_post_meta'] = array(
	'title' => esc_html__( 'Blog Post - Meta', 'silvertech' ),
	'panel' => 'silvertech_blog',
	'settings' => array(
		// Blog Custom Meta
		array(
			'id' => 'blog_custom_meta',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Meta Style', 'silvertech' ),
				'type' => 'select',
				'choices' => array(
					'style-1' => esc_html__( 'Basic', 'silvertech' ),
					'style-2' => esc_html__( 'Modern', 'silvertech' ),
				),
			),
		),
		array(
			'id' => 'blog_before_author',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Text Before Author', 'silvertech' ),
				'type' => 'text',
			),
		),
		array(
			'id' => 'blog_entry_meta_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Meta Margin', 'silvertech' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 0 0 20px 0.', 'silvertech' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-meta',
				'alter' => 'margin',
			),
		),
		array(
			'id'  => 'blog_entry_meta_items',
			'default' => array( 'date', 'comments' ),
			'control' => array(
				'label' => esc_html__( 'Meta Items', 'silvertech' ),
				'desc' => esc_html__( 'Click and drag and drop elements to re-order them.', 'silvertech' ),
				'type' => 'silvertech-sortable',
				'object' => 'Silvertech_Customize_Control_Sorter',
				'choices' => array(
					'date'       => esc_html__( 'Date', 'silvertech' ),
					'comments' => esc_html__( 'Comments', 'silvertech' ),
					'author'     => esc_html__( 'Author', 'silvertech' ),
					'categories' => esc_html__( 'Categories', 'silvertech' ),
				),
			),
		),
		array(
			'id' => 'heading_blog_entry_meta_item',
			'control' => array(
				'type' => 'silvertech-heading',
				'label' => esc_html__( 'Item Meta', 'silvertech' ),
			),
		),
		array(
			'id' => 'blog_entry_meta_item_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'silvertech' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-meta .item',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_entry_meta_item_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color', 'silvertech' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-meta .item a',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_entry_meta_item_link_color_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color Hover', 'silvertech' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-meta .item a:hover',
				'alter' => 'color',
			),
		),
	),
);

// Blog Posts Excerpt
$this->sections['silvertech_blog_post_excerpt'] = array(
	'title' => esc_html__( 'Blog Post - Excerpt', 'silvertech' ),
	'panel' => 'silvertech_blog',
	'settings' => array(
		array(
			'id' => 'blog_content_style',
			'default' => 'style-1',
			'control' => array(
				'label' => esc_html__( 'Content Style', 'silvertech' ),
				'type' => 'select',
				'choices' => array(
					'style-1' => esc_html__( 'Normal', 'silvertech' ),
					'style-2' => esc_html__( 'Excerpt', 'silvertech' ),
				),
			),
		),
		array(
			'id' => 'blog_excerpt_length',
			'default' => '50',
			'control' => array(
				'label' => esc_html__( 'Excerpt length', 'silvertech' ),
				'type' => 'text',
				'desc' => esc_html__( 'This option only apply for Content Style: Excerpt.', 'silvertech' )
			),
		),
		array(
			'id' => 'blog_excerpt_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Margin', 'silvertech' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 0 0 30px 0.', 'silvertech' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-excerpt',
				'alter' => 'margin',
			),
		),
		array(
			'id' => 'blog_excerpt_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'silvertech' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-excerpt',
				'alter' => 'color',
			),
		),
	),
);

// Blog Posts Read More
$this->sections['silvertech_blog_post_read_more'] = array(
	'title' => esc_html__( 'Blog Post - Read More', 'silvertech' ),
	'panel' => 'silvertech_blog',
	'settings' => array(
		array(
			'id' => 'blog_entry_button_read_more_text',
			'default' => esc_html__( 'Read More', 'silvertech' ),
			'control' => array(
				'label' => esc_html__( 'Button Text', 'silvertech' ),
				'type' => 'text',
			),
		),
	),
);

