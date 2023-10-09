<?php 

/**
 * Template part for displaying post meta
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package shofa
 */

$categories = get_the_terms( $post->ID, 'category' );

$shofa_blog_date = get_theme_mod( 'shofa_blog_date', true );
$shofa_blog_comments = get_theme_mod( 'shofa_blog_comments', true );
$shofa_blog_author = get_theme_mod( 'shofa_blog_author', true );
$shofa_blog_cat = get_theme_mod( 'shofa_blog_cat', false );

?>

<div class="postbox__meta mb-15">

    <?php if ( !empty($shofa_blog_author) ): ?>
    <span><a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>"><i class="fal fa-user-alt"></i> <?php print get_the_author();?></a></span>
    <?php endif;?>

    <?php if ( !empty($shofa_blog_date) ): ?>
    <span><i class="fal fa-clock"></i> <?php the_time( get_option('date_format') ); ?></span>
    <?php endif;?>

    <?php if ( !empty($shofa_blog_comments) ): ?>
    <span><a href="<?php comments_link();?>"><i class="far fa-comment-alt"></i> <?php comments_number();?></a></span>
    <?php endif;?>
    
    <?php if ( !empty($shofa_blog_cat) && !empty( $categories[0]->name ) ): ?>
    <span><a href="<?php print esc_url(get_category_link($categories[0]->term_id)); ?>"><i class="fal fa-tag"></i> <?php echo esc_html($categories[0]->name); ?></a></span>
    <?php endif;?>
</div>