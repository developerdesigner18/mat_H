<?php
/**
 * Entry Content / Nex - Previous Post
 *
 * @package silvertech
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


$next_post = get_next_post();
$prev_post = get_previous_post();
if (!$next_post && !$prev_post) return;
?>

<div id="post-nav">
    <?php if ($prev_post) : ?>
    <div class="link-wrap post-previous clearfix">
        <div class="thumb"><?php echo get_the_post_thumbnail( $prev_post->ID, 'silvertech-post-widget'); ?></div>
        <div class="content-wrap">
            <h4 class="title">
                <a href="<?php echo esc_url( get_the_permalink( $prev_post->ID ) ); ?>">
                    <?php echo esc_html( get_the_title($prev_post->ID)); ?>
                </a>
            </h4>

            <a class="link" href="<?php echo esc_url( get_the_permalink( $prev_post->ID ) ); ?>"><?php esc_html_e( 'Prev Post', 'silvertech'); ?></a>
        </div>
    </div>
    <?php endif; ?>

    <?php if ($next_post) : ?>
    <div class="link-wrap post-next clearfix">
        <div class="thumb"><?php echo get_the_post_thumbnail( $next_post->ID, 'silvertech-post-widget'); ?></div>
        <div class="content-wrap">
            <h4 class="title">
                <a href="<?php echo esc_url( get_the_permalink( $next_post->ID ) ); ?>">
                    <?php echo esc_html( get_the_title($next_post->ID)); ?>
                </a>
            </h4>

            <a class="link" href="<?php echo esc_url( get_the_permalink( $next_post->ID ) ); ?>"><?php esc_html_e( 'Next Post', 'silvertech'); ?></a>
        </div>
    </div>
    <?php endif; ?>
</div>
