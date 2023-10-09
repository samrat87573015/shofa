<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package shofa
 */

 
$shofa_audio_url = function_exists( 'get_field' ) ? get_field( 'format_style' ) : NULL;
$gallery_images = function_exists('get_field') ? get_field('gallery_images') : '';
$shofa_video_url = function_exists( 'get_field' ) ? get_field( 'format_style' ) : NULL;

$shofa_blog_single_social = get_theme_mod( 'shofa_blog_single_social', false );
$blog_tag_col = $shofa_blog_single_social ? 'col-xl-7' : 'col-xl-12';


if ( is_single() ) : ?>
<article class="postbox__item format-search mb-50 transition-3">

    <!-- if post has image -->
    <?php if ( has_post_format('image') ): ?>
    <?php if(has_post_thumbnail()) : ?>
    <div class="postbox__thumb w-img mb-25">
        <?php the_post_thumbnail(); ?>
    </div>
    <?php endif; ?>
    <!-- if post has audio -->
    <?php elseif ( has_post_format('audio') ): ?>
    <?php if ( !empty( $shofa_audio_url ) ): ?>
    <div class="postbox__thumb postbox__audio m-img p-relative">
        <?php echo wp_oembed_get( $shofa_audio_url ); ?>
    </div>
    <?php endif; ?>
    <!-- if post has video -->
    <?php elseif ( has_post_format('video') ): ?>
    <?php if ( has_post_thumbnail() ): ?>
    <div class="postbox__thumb postbox__video p-relative mb-25">
        <a href="<?php the_permalink();?>">
            <?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
        </a>
        <?php if(!empty($shofa_video_url)) : ?>
        <a href="<?php print esc_url( $shofa_video_url );?>" class="play-btn popup-video"><i
                class="fas fa-play"></i></a>
        <?php endif; ?>
    </div>
    <?php endif; ?>
    <!-- if post has gallery -->
    <?php elseif ( has_post_format('gallery') ): ?>
    <?php if ( !empty( $gallery_images ) ): ?>
    <div class="postbox__thumb postbox-active swiper-container w-img p-relative mb-25">
        <div class="swiper-wrapper">
            <?php foreach ( $gallery_images as $key => $image ): ?>
            <div class="postbox__slider-item swiper-slide">
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
            </div>
            <?php endforeach;?>
        </div>
        <div class="postbox-nav">
            <button class="postbox-slider-button-next"><i class="far fa-chevron-right"></i></button>
            <button class="postbox-slider-button-prev"><i class="far fa-chevron-left"></i></button>
        </div>
    </div>
    <?php endif; ?>
    <!-- if post has standared -->
    <?php else : ?>
    <?php if(has_post_thumbnail()) : ?>
    <div class="postbox__thumb w-img mb-25">
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail(); ?>
        </a>
    </div>
    <?php endif; ?>
    <?php endif; ?>

    <!-- blog meta -->
    <?php get_template_part( 'template-parts/blog/blog-meta' ); ?>

    <div class="postbox__details-content-wrapper postbox__content postbox__text mb-40 fix">
        <?php the_content();?>
        <?php
            wp_link_pages( [
                'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'shofa' ),
                'after'       => '</div>',
                'link_before' => '<span class="page-number">',
                'link_after'  => '</span>',
            ] );
        ?>

    </div>

</article>
<?php else: ?>

<article id="post-<?php the_ID();?>" <?php post_class( 'postbox__item format-search mb-60 transition-3' );?>>

    <!-- if post has image -->
    <?php if ( has_post_format('image') ): ?>
    <?php if(has_post_thumbnail()) : ?>
    <div class="postbox__thumb w-img mb-25">
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail(); ?>
        </a>
    </div>
    <?php endif; ?>
    <!-- if post has audio -->
    <?php elseif ( has_post_format('audio') ): ?>
    <?php if ( !empty( $shofa_audio_url ) ): ?>
    <div class="postbox__thumb postbox__audio m-img p-relative">
        <?php echo wp_oembed_get( $shofa_audio_url ); ?>
    </div>
    <?php endif; ?>
    <!-- if post has video -->
    <?php elseif ( has_post_format('video') ): ?>
    <?php if ( has_post_thumbnail() ): ?>
    <div class="postbox__thumb postbox__video p-relative mb-25">
        <a href="<?php the_permalink();?>">
            <?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
        </a>
        <?php if(!empty($shofa_video_url)) : ?>
        <a href="<?php print esc_url( $shofa_video_url );?>" class="play-btn popup-video"><i
                class="fas fa-play"></i></a>
        <?php endif; ?>
    </div>
    <?php endif; ?>
    <!-- if post has gallery -->
    <?php elseif ( has_post_format('gallery') ): ?>
    <?php if ( !empty( $gallery_images ) ): ?>
    <div class="postbox__thumb postbox-active swiper-container w-img p-relative mb-25">
        <div class="swiper-wrapper">
            <?php foreach ( $gallery_images as $key => $image ): ?>
            <div class="postbox__slider-item swiper-slide">
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
            </div>
            <?php endforeach;?>
        </div>
        <div class="postbox-nav">
            <button class="postbox-slider-button-next"><i class="far fa-chevron-right"></i></button>
            <button class="postbox-slider-button-prev"><i class="far fa-chevron-left"></i></button>
        </div>
    </div>
    <?php endif; ?>
    <!-- if post has standared -->
    <?php else : ?>
    <?php if(has_post_thumbnail()) : ?>
    <div class="postbox__thumb w-img mb-25">
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail(); ?>
        </a>
    </div>
    <?php endif; ?>
    <?php endif; ?>

    <div class="postbox__content">

        <!-- blog meta -->
        <?php get_template_part( 'template-parts/blog/blog-meta' ); ?>

        <h3 class="postbox__title mb-20">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>
        <div class="postbox__text mb-30">
            <?php the_excerpt();?>
        </div>
        <!-- blog btn -->
        <?php get_template_part( 'template-parts/blog/blog-btn' ); ?>
    </div>
</article>
<?php endif;?>