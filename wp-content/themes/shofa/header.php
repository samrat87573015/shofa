<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package shofa
 */
?>

<!doctype html>
<html <?php language_attributes();?>>
<head>
	<meta charset="<?php bloginfo( 'charset' );?>">
    <?php if ( is_singular() && pings_open( get_queried_object() ) ): ?>
    <?php endif;?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head();?>
</head>

<body <?php body_class();?>>

    <?php wp_body_open();?>


    <?php
         $shofa_preloader = get_theme_mod( 'shofa_preloader_switch', false );
         $shofa_backtotop = get_theme_mod( 'shofa_backtotop', false );

    ?>

    <?php if ( !empty( $shofa_preloader ) ): ?>
      <!-- pre loader area start -->
      <div id="preloader">
         <div class="preloader">
               <span></span>
               <span></span>
         </div>
      </div>
      <!-- pre loader area end -->
    <?php endif;?>

    <?php if ( !empty( $shofa_backtotop ) ): ?>
      <!-- back to top start -->
      <button class="scroll-top scroll-to-target" data-target="html">
         <i class="fas fa-angle-up"></i>
      </button>
      <!-- back to top end -->
    <?php endif;?>

    <!-- header start -->
    <?php do_action( 'shofa_header_style' );?>
    <!-- header end -->
    
    <!-- wrapper-box start -->
    <?php do_action( 'shofa_before_main_content' );?>