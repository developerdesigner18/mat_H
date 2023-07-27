<?php
/**
 * Header / Search
 *
 * @package silvertech
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Search Icon
if ( silvertech_get_mod( 'header_search_icon', false ) ) { ?>
	<div class="header-search-wrap">
		<div class="search_form_wrap">
	    	<?php get_search_form(); ?>
	    </div>
	    <span class="header-search-trigger"> <?php echo silvertech_svg( 'search' ) ?> </span>
	</div>
<?php } ?>

