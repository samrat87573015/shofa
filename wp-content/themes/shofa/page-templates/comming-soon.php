<?php

/**
* Template Name: Comming Soon
 * @package shofa
 */

get_header();


?>

<main>

    <!-- coming-soon-area-start -->
    <section class="coming-soon-area tpcoming__bg" data-background="<?php echo get_template_directory_uri(); ?>/assets/img/banner/comming-soon-1.jpg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="tpcoming__area text-center">
                        <div class="tpcoming__logo">
                            <a href="https://weblearnbd.net/wp/shofa/"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo/c-logo.png" alt="logo"></a>
                        </div>
                        <div class="tpcoming__content">
                            <span>Coming Soon!</span>
                            <h4 class="tpcoming__title mb-50">We are Coming Soon</h4>
                        </div>
                        <div class="tpcoming__count">
                            <div class="tpcoming__countdown" data-countdown="2023/5/2"></div>
                        </div>
                        <div class="tpcoming__submit">
                            <form action="#">
                                <input type="email" placeholder="Email address">
                                <span><i class="far fa-envelope"></i></span>
                                <button>Subscribe Now <i class="far fa-long-arrow-right"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- coming-soon-area-end -->

</main>

<?php
get_footer();