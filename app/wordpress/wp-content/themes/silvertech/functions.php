<?php

// Include required files.
require( get_template_directory() . '/framework/get-mods.php' );
require( get_template_directory() . '/framework/theme-hooks.php' );
require( get_template_directory() . '/framework/theme-functions.php' );
require( get_template_directory() . '/framework/fonts.php' );
require( get_template_directory() . '/framework/typography.php' );
require( get_template_directory() . '/framework/accent-color.php' );
require( get_template_directory() . '/framework/customizer/customizer.php' );
require( get_template_directory() . '/framework/elementor-options.php' );
require( get_template_directory() . '/framework/widget-areas.php' );
require( get_template_directory() . '/framework/breadcrumbs.php' );
require( get_template_directory() . '/framework/plugins.php' );
require( get_template_directory() . '/framework/theme-woocommerce.php' );
require( get_template_directory() . '/framework/demo-install.php' );

// Sets up theme defaults and registers support for various WordPress features.
function silvertech_theme_setup() {
	// Make theme available for translation.
	load_theme_textdomain( 'silvertech', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Custom background color.
	add_theme_support( 'custom-background' );

	// Custom Header
	add_theme_support( 'custom-header' );

	// Enable woocommerce support
	add_theme_support( 'woocommerce' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'silvertech-post-standard', 1170, 570, true );
	add_image_size( 'silvertech-post-widget', 170, 170, true );

	// Register menus
	register_nav_menu( 'primary', esc_html__( 'Primary Menu', 'silvertech' ) );
	register_nav_menu( 'onepage', esc_html__( 'Onepage Menu', 'silvertech' ) );
	register_nav_menu( 'bottom', esc_html__( 'Bottom Menu', 'silvertech' ) );
	
	// Switch default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array(
		'image',
		'gallery',
		'video'
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( array( 'assets/css/editor-style.css' ) );
}
add_action( 'after_setup_theme', 'silvertech_theme_setup' );

// Enqueues scripts and styles.
function silvertech_theme_scripts() {
	// Vendor Styles & Icons
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/assets/css/animate.css', array(), '3.5.2' );
	wp_enqueue_style( 'animsition', get_template_directory_uri() . '/assets/css/animsition.css', array(), '4.0.1' );
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/css/slick.css', array(), '1.6.0' );
	wp_enqueue_style( 'eleganticons', get_template_directory_uri() . '/assets/css/eleganticons.css', array(), '1.0.0' );
	wp_enqueue_style( 'pe-icon-7-stroke', get_template_directory_uri() . '/assets/css/pe-icon-7-stroke.css', array(), '1.0.0' );
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/css/fontawesome.css', array(), '5.13.0' );

	// Theme Style
	wp_enqueue_style( 'silvertech-theme-style', get_stylesheet_uri(), array(), '1.0.0' );
	wp_add_inline_style( 'silvertech-theme-style', apply_filters( 'silvertech_custom_colors_css', null ) );

	// Vendor Scripts
	wp_enqueue_script( 'html5shiv', get_template_directory_uri() . '/assets/js/html5shiv.js', array('jquery'), '3.7.3', true );
	wp_enqueue_script( 'respond', get_template_directory_uri() . '/assets/js/respond.js', array('jquery'), '1.3.0', true );
	wp_enqueue_script( 'matchmedia', get_template_directory_uri() . '/assets/js/matchmedia.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'easing', get_template_directory_uri() . '/assets/js/easing.js', array('jquery'), '1.3.0', true );
	wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/assets/js/fitvids.js', array('jquery'), '1.1.0', true );
	wp_enqueue_script( 'animsition', get_template_directory_uri() . '/assets/js/animsition.js', array('jquery'), '4.0.1', true );
	wp_register_script( 'slick', get_template_directory_uri() . '/assets/js/slick.js', array('jquery'), '1.6.0', true );
	wp_enqueue_script( 'splittext', get_template_directory_uri() . '/assets/js/splittext.js', array('jquery'), '3.6.1', true );

	// Theme Script
	wp_enqueue_script( 'silvertech-theme-script', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), '1.0.0', true );

	// Comment JS
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
}
add_action( 'wp_enqueue_scripts', 'silvertech_theme_scripts' );

// Registers a widget areas.
function silvertech_sidebars_init() {
	// Sidebar for Blog
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Blog', 'silvertech' ),
		'id'            => 'sidebar-blog',
		'description'   => esc_html__( 'Add widgets here to appear in Sidebar Blog.', 'silvertech' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>'
	) );

	// Sidebar for Pages
	register_sidebar( array(
		'name'			=> esc_html__( 'Sidebar Page', 'silvertech' ),
		'id'			=> 'sidebar-page',
		'description'	=> esc_html__( 'Add widgets here to appear in Sidebar Page', 'silvertech' ),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h2 class="widget-title"><span>',
		'after_title'	=> '</span></h2>'
	) );

	// Sidebar for Portfolio
	register_sidebar( array(
		'name'			=> esc_html__( 'Sidebar Portfolio', 'silvertech' ),
		'id'			=> 'sidebar-portfolio',
		'description'	=> esc_html__( 'Add widgets here to appear in Sidebar Portfolio', 'silvertech' ),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h2 class="widget-title"><span>',
		'after_title'	=> '</span></h2>'
	) );

	// Sidebar for Shop
	register_sidebar( array(
		'name'			=> esc_html__( 'Sidebar Shop', 'silvertech' ),
		'id'			=> 'sidebar-shop',
		'description'	=> esc_html__( 'Add widgets here to appear in Sidebar Shop', 'silvertech' ),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h2 class="widget-title"><span>',
		'after_title'	=> '</span></h2>'
	) );

	// 4 Sidebars for Footer
	register_sidebar( array(
		'name'			=> esc_html__( 'Sidebar Footer 1', 'silvertech' ),
		'id'			=> 'sidebar-footer-1',
		'description'	=> esc_html__( 'Add widgets here to appear in Sidebar Footer 1', 'silvertech' ),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h2 class="widget-title"><span>',
		'after_title'	=> '</span></h2>'
	) );
	register_sidebar( array(
		'name'			=> esc_html__( 'Sidebar Footer 2', 'silvertech' ),
		'id'			=> 'sidebar-footer-2',
		'description'	=> esc_html__( 'Add widgets here to appear in Sidebar Footer 2', 'silvertech' ),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h2 class="widget-title"><span>',
		'after_title'	=> '</span></h2>'
	) );
	register_sidebar( array(
		'name'			=> esc_html__( 'Sidebar Footer 3', 'silvertech' ),
		'id'			=> 'sidebar-footer-3',
		'description'	=> esc_html__( 'Add widgets here to appear in Sidebar Footer 3', 'silvertech' ),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h2 class="widget-title"><span>',
		'after_title'	=> '</span></h2>'
	) );
	register_sidebar( array(
		'name'			=> esc_html__( 'Sidebar Footer 4', 'silvertech' ),
		'id'			=> 'sidebar-footer-4',
		'description'	=> esc_html__( 'Add widgets here to appear in Sidebar Footer 4', 'silvertech' ),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h2 class="widget-title"><span>',
		'after_title'	=> '</span></h2>'
	) );
}
add_action( 'widgets_init', 'silvertech_sidebars_init' );

// Hide trailing zeros on prices.
add_filter( 'woocommerce_price_trim_zeros', 'silvertech_hide_trailing_zeros', 10, 1 );

function silvertech_hide_trailing_zeros( $trim ) {
    return true;
}
add_post_type_support( 'page', 'excerpt' );

// Add svg file type for upload.
function silvertech_add_file_types_to_uploads($file_types){
	$new_filetypes = array();
	$new_filetypes['svg'] = 'image/svg+xml';
	$file_types = array_merge($file_types, $new_filetypes );
	return $file_types;
}
add_filter('upload_mimes', 'silvertech_add_file_types_to_uploads');

// Disable gutenberg on widgets

function silvertech_theme_support() {
    remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'silvertech_theme_support' );