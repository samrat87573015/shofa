<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package shofa
 */
?>

<article id="post-<?php the_ID();?>" <?php post_class( 'postbox_quote__item format-quote mb-50' );?>>
    <div class="post-text">
        <blockquote>
            <p><?php echo wp_trim_words(get_the_content(), 40, '..');?></p>
        </blockquote>
    </div>
</article>