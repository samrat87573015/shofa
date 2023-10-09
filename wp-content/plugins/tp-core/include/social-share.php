<?php

// blog single social share
function ninico_blog_social_share(){

    $ninico_blog_single_social = get_theme_mod( 'ninico_blog_single_social', false );
    $blog_tag_col = $ninico_blog_single_social ? 'col-xl-7' : 'col-xl-12';

    $post_url = get_the_permalink();

    $social_class = has_tag() ? 'postbox__social-tag' : 'postbox__social-tag text-start';
    $social_col = has_tag() ? 'col-xl-5 col-md-12' : 'col-12';

    if(!empty($ninico_blog_single_social)) : ?>    
    <div class="<?php echo esc_attr($social_col); ?>">
        <div class="<?php echo esc_attr($social_class); ?>">
            <span><?php echo esc_html__('Share:', 'ninico'); ?></span>
            <a class="blog-d-lnkd" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url($post_url);?>" target="_blank"><i class="fab fa-linkedin-in"></i></a>
            <a class="blog-d-pin" href="http://pinterest.com/pin/create/button/?url=<?php echo esc_url($post_url);?>" target="_blank"><i class="fab fa-pinterest-p"></i></a>
            <a class="blog-d-fb" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url($post_url);?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a class="blog-d-tweet" href="https://twitter.com/share?url=<?php echo esc_url($post_url);?>" target="_blank"><i class="fab fa-twitter"></i></a>
        </div>
    </div>
    <?php endif ; 

}

// product single social share
function ninico_product_social_share(){

    $ninico_blog_single_social = get_theme_mod( 'ninico_blog_single_social', false );
    
    $post_url = get_the_permalink();

    if(!empty($ninico_blog_single_social)) : ?>    
   <div class="tpproduct-details__information tpproduct-details__social">
        <p><?php echo esc_html__('Share:', 'ninico'); ?></p>
        <a class="blog-d-lnkd" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url($post_url);?>" target="_blank"><i class="fab fa-linkedin-in"></i></a>
        <a class="blog-d-pin" href="http://pinterest.com/pin/create/button/?url=<?php echo esc_url($post_url);?>" target="_blank"><i class="fab fa-pinterest-p"></i></a>
        <a class="blog-d-fb" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url($post_url);?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
        <a class="blog-d-tweet" href="https://twitter.com/share?url=<?php echo esc_url($post_url);?>" target="_blank"><i class="fab fa-twitter"></i></a>
    </div>
    <?php endif ; 

}


