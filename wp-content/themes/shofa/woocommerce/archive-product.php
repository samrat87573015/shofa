<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

$product_column = is_active_sidebar( 'product-sidebar' ) ? 9 : 12;

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

?>

		<?php
		if ( woocommerce_product_loop() ) {
			?>


			<?php ?>

            <div class="row ">
               <div class="col-lg-3">
                  <div class="sidebar__wrapper mr-10">
                     <?php dynamic_sidebar('shop-sidebar');?>
                  </div>
               </div>
               <div class="col-lg-9">
                  <div class="tab-content" id="nav-tabContent">
                     <div class="product-filter-content mb-40">
                        <div class="row align-items-center">
                           <div class="col-sm-6">
                              <?php
                              /**
                               * Hook: woocommerce_before_shop_loop.
                                 *
                                 * @hooked woocommerce_output_all_notices - 10
                                 * @hooked woocommerce_result_count - 20
                                 * @hooked woocommerce_catalog_ordering - 30
                                 */
                              do_action( 'woocommerce_before_shop_loop' );
                              ?>
                           </div>
                           <div class="col-sm-6">
                              <div class="product-navtabs d-flex justify-content-end align-items-center">
                                 <div class="tp-shop-selector">
                                    <?php woocommerce_catalog_ordering();?>
                                 </div>
                                 <div class="tpproductnav tpnavbar product-filter-nav">
                                    <nav>
                                       <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                          <button class="nav-link"  id="nav-list-tab" data-bs-toggle="tab" data-bs-target="#nav-list" type="button" role="tab" aria-controls="nav-list" aria-selected="false"><i class="fal fa-list-ul"></i></button>

                                          <button class="nav-link active"  id="nav-grid-tab" data-bs-toggle="tab" data-bs-target="#nav-grid" type="button" role="tab" aria-controls="nav-grid" aria-selected="true"><i class="fal fa-th"></i></button>
                                       </div>
                                    </nav>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                        <div class="tab-pane fade  show active" id="nav-grid" role="tabpanel" aria-labelledby="nav-grid-tab">
                           <?php woocommerce_product_loop_start();
                              if ( wc_get_loop_prop( 'total' ) ) {
                                 while ( have_posts() ) {
                                    the_post(); ?>

                                    <?php

                                    /**
                                     * Hook: woocommerce_shop_loop.
                                    */
                                    do_action( 'woocommerce_shop_loop' );

                                    wc_get_template_part( 'content', 'product' );
                                 }
                              }

                              woocommerce_product_loop_end(); 
                           ?>
                        </div>

                        <div class="tab-pane fade" id="nav-list" role="tabpanel" aria-labelledby="nav-list-tab">
                           <?php
                              if ( wc_get_loop_prop( 'total' ) ) {
                                 while ( have_posts() ) {
                                    the_post(); ?>

                                    <?php

                                    /**
                                     * Hook: woocommerce_shop_loop.
                                    */
                                    do_action( 'woocommerce_shop_loop' );

                                    wc_get_template_part( 'content', 'product-list' );
                                 }
                              }
                           ?>
                        </div>

                        

                           <?php
                              /**
                               * Hook: woocommerce_after_shop_loop.
                              *
                              * @hooked woocommerce_pagination - 10
                              */
                              do_action( 'woocommerce_after_shop_loop' );
                           ?>

                  </div>
               </div>
            </div>

            <?php   
		} else {
			/**
			 * Hook: woocommerce_no_products_found.
			 *
			 * @hooked wc_no_products_found - 10
			 */
			do_action( 'woocommerce_no_products_found' );
		}
		?>


<?php
		/**
		 * Hook: woocommerce_after_main_content.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );

		/**
		 * Hook: woocommerce_sidebar.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );
?>
<?php
get_footer( 'shop' );
