<?php

/**
* Template Name: Track
 * @package shofa
 */

get_header();


?>

<main>

    <!-- track-area-start -->
    <section class="track-area pt-80 pb-80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7">
                    <div class="tptrack__product">
                        <div class="tptrack__thumb">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/banner/track-bg.jpg" alt="shofa_img">
                        </div>
                        <div class="tptrack__content grey-bg-3">
                            <div class="tptrack__item d-flex mb-20">
                                <div class="tptrack__item-icon">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/track-1.png" alt="shofa_img">
                                </div>
                                <div class="tptrack__item-content">
                                    <h4 class="tptrack__item-title">Track Your Order</h4>
                                    <p>To track your order please enter your Order ID in the box below and press the
                                        "Track" button. This was given to you on your receipt and in the confirmation
                                        email you should have received.</p>
                                </div>
                            </div>
                            <?php if(!class_exists('CBWCT_ORDER_TRACKER')) : ?>
                            <div class="tptrack__id mb-10">
                                <?php echo do_shortcode('[cbwct-order-tracker]'); ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- track-area-end -->
</main>

<?php
get_footer();