<?php

namespace TPCore;

defined('ABSPATH') || die();

class TP_El_Woocommerce
{

    /**
     * Instance
     *
     * @since 1.0.0
     *
     * @access private
     * @static
     *
     * @var BdevsElement The single instance of the class.
     */
    private static $_instance = null;

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @return BdevsElement An instance of the class.
     * @since 1.0.0
     *
     * @access public
     * @static
     *
     */
    public static function instance()
    {

        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;

    }

    public static function tp_woo_add_to_cart( $args = array() ) {
        global $product;

            if ( $product ) {
                $defaults = array(
                    'quantity'   => 1,
                    'class'      => implode(
                        ' ',
                        array_filter(
                            array(
                                'cart-button icon-btn button',
                                'product_type_' . $product->get_type(),
                                $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                                $product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
                            )
                        )
                    ),
                    'attributes' => array(
                        'data-product_id'  => $product->get_id(),
                        'data-product_sku' => $product->get_sku(),
                        'aria-label'       => $product->add_to_cart_description(),
                        'rel'              => 'nofollow',
                    ),
                );

                $args = wp_parse_args( $args, $defaults );

                if ( isset( $args['attributes']['aria-label'] ) ) {
                    $args['attributes']['aria-label'] = wp_strip_all_tags( $args['attributes']['aria-label'] );
                }
            }


             // check product type 
             if( $product->is_type( 'simple' ) ){
                $btntext = esc_html__("Add to Cart",'ninico');
             } elseif( $product->is_type( 'variable' ) ){
                $btntext = esc_html__("Select Options",'ninico');
             } elseif( $product->is_type( 'external' ) ){
                $btntext = esc_html__("Buy Now",'ninico');
             } elseif( $product->is_type( 'grouped' ) ){
                $btntext = esc_html__("View Products",'ninico');
             }
             else{
                $btntext = "Add to Cart";
             } 

            echo sprintf( '<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
                esc_url( $product->add_to_cart_url() ),
                esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
                esc_attr( isset( $args['class'] ) ? $args['class'] : 'cart-button icon-btn button' ),
                isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
                '<i class="fal fa-shopping-cart"></i>'.$btntext.' '
            );
    }

    // quick view
    public static function gninico_woosq_button_html( $output , $prodid ) {
        return $output = '<a href="#" class="icon-btn woosq-btn woosq-btn-' . esc_attr( $prodid ) . ' ' . get_option( 'woosq_button_class' ) . '" data-id="' . esc_attr( $prodid ) . '" data-effect="mfp-3d-unfold"><svg width="19" height="16" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg">
       <path d="M9.49943 5.34978C8.23592 5.34978 7.20896 6.37595 7.20896 7.63732C7.20896 8.89774 8.23592 9.92296 9.49943 9.92296C10.7629 9.92296 11.7908 8.89774 11.7908 7.63732C11.7908 6.37595 10.7629 5.34978 9.49943 5.34978M9.49941 11.3456C7.45025 11.3456 5.78394 9.68213 5.78394 7.63738C5.78394 5.59169 7.45025 3.92725 9.49941 3.92725C11.5486 3.92725 13.2158 5.59169 13.2158 7.63738C13.2158 9.68213 11.5486 11.3456 9.49941 11.3456" fill="currentColor"/>
       
       <path d="M1.49145 7.63683C3.25846 11.5338 6.23484 13.8507 9.50001 13.8517C12.7652 13.8507 15.7416 11.5338 17.5086 7.63683C15.7416 3.7408 12.7652 1.42386 9.50001 1.42291C6.23579 1.42386 3.25846 3.7408 1.49145 7.63683V7.63683ZM9.50173 15.2742H9.49793H9.49698C5.56775 15.2714 2.03943 12.5219 0.0577129 7.91746C-0.0192376 7.73822 -0.0192376 7.53526 0.0577129 7.35601C2.03943 2.75248 5.5687 0.00306822 9.49698 0.000223018C9.49888 -0.000725381 9.49888 -0.000725381 9.49983 0.000223018C9.50173 -0.000725381 9.50173 -0.000725381 9.50268 0.000223018C13.4319 0.00306822 16.9602 2.75248 18.942 7.35601C19.0199 7.53526 19.0199 7.73822 18.942 7.91746C16.9612 12.5219 13.4319 15.2714 9.50268 15.2742H9.50173Z" fill="currentColor"/>

       </svg></a>';
    }
    




    public static function add_to_cart_button($product_id)
    {

        $product = wc_get_product($product_id);
        if ($product) {
            $defaults = array(
                'quantity' => 1,
                'class' => implode(' ', array_filter(array(
                    '',
                    'product_type_' . $product->get_type(),
                    $product->is_purchasable() && $product->is_in_stock() ? '' : '',
                    $product->supports('ajax_add_to_cart') ? 'ajax_add_to_cart' : ''
                )))
            );

            extract($defaults);

            return sprintf('<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s add_to_cart_button tp-btn"><i class="fal fa-shopping-cart"></i> Add To Cart</a>',
                esc_url($product->add_to_cart_url()),
                esc_attr(isset($quantity) ? $quantity : 1),
                esc_attr($product->get_id()),
                esc_attr($product->get_sku()),
                esc_attr(isset($class) ? $class : 'button')
            );
        }
    }

    public static function quick_view_button($product_id) {

        $product = wc_get_product($product_id);

        $button = '';
        if ( $product_id ) {
      
            $button = '<a href="#" class="button yith-wcqv-button" data-product_id="' . esc_attr( $product_id ) . '" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="fal fa-eye"></i></a>';
            $button = apply_filters( 'yith_add_quick_view_button_html', $button, '', $product );
        }

        return $button;
            
    }

    public static function yith_wishlist($product_id)
    {

        $product = wc_get_product($product_id);

        $cssclass = 'wishlist-rd';
        $mar = 'tanzim-mar-top';

        $id = $product->get_id();
        $type = $product->get_type();
        $link = get_site_url();

        $img = '<img src="' . $link . '/wp-content/plugins/yith-woocommerce-wishlist/assets/images/wpspin_light.gif" class="ajax-loading tanzim_wi_loder" alt="loading" width="16" height="16" style="visibility:hidden">';
        $markup = '';

        if (BDEVSEL_WISHLIST_ACTIVED) {

            $markup .= '<div class="yith-wcwl-add-to-wishlist ' . $mar . ' add-to-wishlist-' . $id . '">';
            $markup .= '<div class="yith-wcwl-add-button wishlist show" style="display:block">';
            $markup .= '<a href="' . $link . '/shop/?add_to_wishlist=' . $id . '" rel="nofollow" data-product-id="' . $id . '" data-product-type="' . $type . '" class="add_to_wishlist ' . $cssclass . '">';
            $markup .= '<i class="fal fa-heart"></i></a>';
            $markup .= $img;
            $markup .= '</div>';
            $markup .= '<div class="yith-wcwl-wishlistaddedbrowse wishlist hide" style="display:none;">';
            $markup .= '<a href="' . $link . '/wishlist/view/" rel="nofollow" class=" ' . $cssclass . '"><i class="fal fa-heart"></i></a>';
            $markup .= $img;
            $markup .= '</div>';
            $markup .= '<div class="yith-wcwl-wishlistexistsbrowse wishlist  hide" style="display:none">';
            $markup .= '<a href="' . $link . '/wishlist/view/" rel="nofollow" class=" ' . $cssclass . '"><i class="fal fa-heart"></i></a>';
            $markup .= $img;
            $markup .= '</div>';
            $markup .= '<div style="clear:both"></div>';
            $markup .= '<div class="yith-wcwl-wishlistaddresponse"></div>';
            $markup .= '</div>';
        }

        return $markup;
    }

    // product_price
    public static function product_price($product_id, $oldp = false)
    {

        $product = wc_get_product($product_id);

        return $product->get_price_html();

    }


    // product_price_sale
    public static function product_price_sale($product_id, $oldp = false)
    {

        $product = wc_get_product($product_id);
        $woo_sale_tag = get_theme_mod('woo_sale_tag', 'Sale');

        $price = $product->get_regular_price();
        $old = '';

        if ($product->get_sale_price() != '') {
            if ($oldp) {
                return '<span class="sale-text">' . $woo_sale_tag . '</span> ';
            }
            else{
                '';
            }
        }
        return false;
    }

    // bdevs_vc_product_thumb
    public static function bdevs_vc_product_thumb($size = array(370, 425))
    {

        $markup = '';
        global $post, $product, $woocommerce;

        $attachment_ids = $product->get_gallery_image_ids();
        $fea_image = array(get_post_thumbnail_id());
        $attachment_ids = array_merge($fea_image, $attachment_ids);
        $i = 1;

        if (!empty($attachment_ids)) {

            $markup .= '<a href="' . get_the_permalink() . '">';
            foreach ($attachment_ids as $attachment_id) {
                if ($i == 3) {
                    break;
                }
                $class = ($i == 1) ? 'front-img' : 'back-img';
                $image_attributes = wp_get_attachment_image_src($attachment_id, $size);
                if ($image_attributes[0] != '') {
                    $markup .= '<img class="' . $class . '" src="' . $image_attributes[0] . '" alt="' . esc_html__('image', 'bdevs-woocommerce') . '" >';
                }
                $i++;
            }
            $markup .= '</a>';
        }

        return $markup;
    }

    public static function bdevs_vc_loop_product_thumb()
    {

        $markup = '';
        global $post, $product, $woocommerce;
        $attachment_ids = $product->get_gallery_image_ids();
        $fea_image = array(get_post_thumbnail_id());
        $attachment_ids = array_merge($fea_image, $attachment_ids);
        $i = 1;
        if (!empty($attachment_ids)) {
            $markup .= '<a href="' . get_the_permalink() . '">';
            foreach ($attachment_ids as $attachment_id) {
                if ($i == 3) {
                    break;
                }
                $class = ($i == 1) ? 'front-img' : 'back-img';
                $image_attributes = wp_get_attachment_image_src($attachment_id, array(300, 300));
                if ($image_attributes[0] != '') {
                    $markup .= '<img class="' . $class . '" src="' . $image_attributes[0] . '" alt="' . esc_html__('image', 'bdevs-woocommerce') . '" >';
                }
                $i++;
            }
            $markup .= '</a>';
        }

        return $markup;
    }


    public static function product_rating($product_id)
    {

        $product = wc_get_product($product_id);
        $rating = $product->get_average_rating();
        $review = 'Rating ' . $rating . ' out of 5';
        $html   = '';
        $html   .= '<div class="details-rating mb-10" title="' . $review . '">';
        for ( $i = 0; $i <= 4; $i ++ ) {
            if ( $i < floor( $rating ) ) {
                $html .= '<i class="fas fa-star"></i>';
            } else {
                $html .= '<i class="far fa-star"></i>';
            }
        }

        $html .= '</div>';

        return $html;
    }

function sectox_woo_rating() {
    global $product;
    $rating = $product->get_average_rating();
    $review = 'Rating ' . $rating . ' out of 5';
    $html   = '';
    $html   .= '<div class="details-rating mb-10" title="' . $review . '">';
    for ( $i = 0; $i <= 4; $i ++ ) {
        if ( $i < floor( $rating ) ) {
            $html .= '<i class="fas fa-star"></i>';
        } else {
            $html .= '<i class="far fa-star"></i>';
        }
    }
    $html .= '<span>( ' . $rating . ' out of 5 )</span>';
    $html .= '</div>';
    print sectox_woo_rating_html( $html );
}

function sectox_woo_rating_html( $html ) {
    return $html;
}



    /**
     * taxonomy category
     */
    public static function product_get_terms($id, $tax)
    {

        $terms = get_the_terms(get_the_ID(), $tax);

        $list = '';
        if ($terms && !is_wp_error($terms)) :
            $i = 1;
            $cats_count = count($terms);

            foreach ($terms as $term) {
                $exatra = ($cats_count > $i) ? ', ' : '';
                $list .= $term->name . $exatra;
                $i++;
            }
        endif;

        return trim($list, ',');
    }

}

TP_El_Woocommerce::instance();