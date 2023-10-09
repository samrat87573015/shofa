<?php


function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
    return false;
}
// Remove issues with prefetching adding extra views


function harry_blog_single_social(){
    $post_url = get_the_permalink();
 ?>    
    <div class="postbox__share text-xl-end">
        <span><?php echo esc_html__('Share On:', 'harry');?></span>
        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url($post_url);?>" target="_blank"><i class="fab fa-linkedin tp-linkedin"></i></a>
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url($post_url);?>" target="_blank""><i class="fab fa-facebook tp-facebook" ></i></a>
        <a href="https://twitter.com/share?url=<?php echo esc_url($post_url);?>" target="_blank"><i class="fab fa-twitter tp-twitter"></i></a>
    </div>
   <?php return false;
}

// harry_product_single_social
function harry_product_single_social(){
    $post_url = get_the_permalink();
 ?>    
    <div class="product__details-share">
        <span><?php echo esc_html__('Share On:', 'harry');?></span>
        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url($post_url);?>" target="_blank"><i class="fab fa-linkedin-in tp-linkedin"></i></a>
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url($post_url);?>" target="_blank""><i class="fab fa-facebook-f tp-facebook" ></i></a>
        <a href="https://twitter.com/share?url=<?php echo esc_url($post_url);?>" target="_blank"><i class="fab fa-twitter tp-twitter"></i></a>
    </div>
   <?php return false;
}


function gp_reading_time() {
    global $post;
    $article = get_post_field( 'post_content', $post->ID ); //gets full text from article
    $wordcount = str_word_count( strip_tags( $article ) ); //removes html tags
    $time = ceil($wordcount / 250); //takes rounded of words divided by 250 words per minute
        
    if ($time == 1) { //grammar conversion
        $label = " minute";
    } else {
        $label = " minutes";
    }
        
    $totalString = $time . $label; //adds time with minute/minutes label
    return $totalString;
        
    }

    function theme_domain_reading_time() {
        global $post;
        // load the content
        $thecontent = $post->post_content;
        // count the number of words
        $words = str_word_count( strip_tags( $thecontent ) );
        // rounding off and deviding per 200 words per minute
        $m = floor( $words / 200 );
    
        // calculate the amount of read time
        $readtime = $m . ' min' . ( $m == 1 ? '' : 's' ) ;
    
        // return the readtime
        return $readtime;
    }