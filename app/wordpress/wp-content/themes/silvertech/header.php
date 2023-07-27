<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="mobi-overlay"><span class="close"></span></div>
<div id="wrapper" style="<?php echo silvertech_element_bg_css( 'wrapper_background_img' ); ?>">

    <div id="page" class="clearfix <?php echo silvertech_preloader_class(); ?>">
    	<div id="site-header-wrap">
			<?php get_template_part( 'templates/site-header' ); ?>
		</div><!-- /#site-header-wrap -->

		<?php get_template_part( 'templates/featured-title' ); ?>

        <!-- Main Content -->
        <div id="main-content" class="site-main clearfix" style="<?php echo silvertech_main_content_bg(); ?>">