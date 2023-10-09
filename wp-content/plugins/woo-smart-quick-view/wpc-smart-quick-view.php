<?php
/*
Plugin Name: WPC Smart Quick View for WooCommerce
Plugin URI: https://wpclever.net/
Description: WPC Smart Quick View allows users to get a quick look of products without opening the product page.
Version: 3.5.0
Author: WPClever
Author URI: https://wpclever.net
Text Domain: woo-smart-quick-view
Domain Path: /languages/
Requires at least: 4.0
Tested up to: 6.3
WC requires at least: 3.0
WC tested up to: 8.1
*/

use Automattic\WooCommerce\Utilities\FeaturesUtil;

defined( 'ABSPATH' ) || exit;

! defined( 'WOOSQ_VERSION' ) && define( 'WOOSQ_VERSION', '3.5.0' );
! defined( 'WOOSQ_FILE' ) && define( 'WOOSQ_FILE', __FILE__ );
! defined( 'WOOSQ_URI' ) && define( 'WOOSQ_URI', plugin_dir_url( __FILE__ ) );
! defined( 'WOOSQ_DIR' ) && define( 'WOOSQ_DIR', plugin_dir_path( __FILE__ ) );
! defined( 'WOOSQ_REVIEWS' ) && define( 'WOOSQ_REVIEWS', 'https://wordpress.org/support/plugin/woo-smart-quick-view/reviews/?filter=5' );
! defined( 'WOOSQ_CHANGELOG' ) && define( 'WOOSQ_CHANGELOG', 'https://wordpress.org/plugins/woo-smart-quick-view/#developers' );
! defined( 'WOOSQ_DISCUSSION' ) && define( 'WOOSQ_DISCUSSION', 'https://wordpress.org/support/plugin/woo-smart-quick-view' );
! defined( 'WPC_URI' ) && define( 'WPC_URI', WOOSQ_URI );

include 'includes/dashboard/wpc-dashboard.php';
include 'includes/kit/wpc-kit.php';

if ( ! function_exists( 'woosq_init' ) ) {
	add_action( 'plugins_loaded', 'woosq_init', 11 );

	function woosq_init() {
		// load text-domain
		load_plugin_textdomain( 'woo-smart-quick-view', false, basename( __DIR__ ) . '/languages/' );

		if ( ! function_exists( 'WC' ) || ! version_compare( WC()->version, '3.0', '>=' ) ) {
			add_action( 'admin_notices', 'woosq_notice_wc' );

			return null;
		}

		if ( ! class_exists( 'WPCleverWoosq' ) ) {
			class WPCleverWoosq {
				protected static $summary = [];
				protected static $summary_default = [];
				protected static $settings = [];
				protected static $localization = [];
				protected static $instance = null;

				public static function instance() {
					if ( is_null( self::$instance ) ) {
						self::$instance = new self();
					}

					return self::$instance;
				}

				function __construct() {
					self::$settings        = (array) get_option( 'woosq_settings', [] );
					self::$localization    = (array) get_option( 'woosq_localization', [] );
					self::$summary         = [
						'title'       => esc_html__( 'Title', 'woo-smart-quick-view' ),
						'rating'      => esc_html__( 'Rating', 'woo-smart-quick-view' ),
						'price'       => esc_html__( 'Price', 'woo-smart-quick-view' ),
						'excerpt'     => esc_html__( 'Short description', 'woo-smart-quick-view' ),
						'add_to_cart' => esc_html__( 'Add to cart', 'woo-smart-quick-view' ),
						'meta'        => esc_html__( 'Meta', 'woo-smart-quick-view' ),
						'description' => esc_html__( 'Description', 'woo-smart-quick-view' ),
					];
					self::$summary_default = [
						'title',
						'rating',
						'price',
						'excerpt',
						'add_to_cart',
						'meta'
					];

					// init
					add_action( 'init', [ $this, 'init' ] );

					// menu
					add_action( 'admin_init', [ $this, 'register_settings' ] );
					add_action( 'admin_menu', [ $this, 'admin_menu' ] );

					// admin enqueue scripts
					add_action( 'admin_enqueue_scripts', [ $this, 'admin_enqueue_scripts' ] );

					// enqueue scripts
					add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );

					// footer
					add_action( 'wp_footer', [ $this, 'footer' ] );

					// ajax
					add_action( 'wp_ajax_woosq_quickview', [ $this, 'ajax_quickview' ] );
					add_action( 'wp_ajax_nopriv_woosq_quickview', [ $this, 'ajax_quickview' ] );

					// link
					add_filter( 'plugin_action_links', [ $this, 'action_links' ], 10, 2 );
					add_filter( 'plugin_row_meta', [ $this, 'row_meta' ], 10, 2 );

					// add image to variation
					add_filter( 'woocommerce_available_variation', [ $this, 'available_variation' ], 10, 3 );

					// summary
					add_action( 'woosq_product_summary', [ $this, 'before_title' ], 4 );
					add_action( 'woosq_product_summary', 'woocommerce_template_single_title', 5 );
					add_action( 'woosq_product_summary', [ $this, 'after_title' ], 6 );

					add_action( 'woosq_product_summary', [ $this, 'before_rating' ], 9 );
					add_action( 'woosq_product_summary', 'woocommerce_template_single_rating' );
					add_action( 'woosq_product_summary', [ $this, 'after_rating' ], 11 );

					add_action( 'woosq_product_summary', [ $this, 'before_price' ], 14 );
					add_action( 'woosq_product_summary', 'woocommerce_template_single_price', 15 );
					add_action( 'woosq_product_summary', [ $this, 'after_price' ], 16 );

					add_action( 'woosq_product_summary', [ $this, 'before_excerpt' ], 19 );
					add_action( 'woosq_product_summary', 'woocommerce_template_single_excerpt', 20 );
					add_action( 'woosq_product_summary', [ $this, 'after_excerpt' ], 21 );

					add_action( 'woosq_product_summary', [ $this, 'add_to_cart' ], 25 );

					add_action( 'woosq_product_summary', [ $this, 'before_meta' ], 29 );
					add_action( 'woosq_product_summary', 'woocommerce_template_single_meta', 30 );
					add_action( 'woosq_product_summary', [ $this, 'after_meta' ], 31 );

					// add to cart redirect
					add_filter( 'woocommerce_add_to_cart_redirect', [ $this, 'add_to_cart_redirect' ] );

					// mini-cart
					add_action( 'woocommerce_before_mini_cart', function () {
						$GLOBALS['woosq_mini_cart'] = true;
					} );
					add_action( 'woocommerce_after_mini_cart', function () {
						unset( $GLOBALS['woosq_mini_cart'] );
					} );
					add_filter( 'woocommerce_cart_item_permalink', [ $this, 'cart_item_link' ], 99, 2 );

					// multiple cats
					add_filter( 'wp_dropdown_cats', [ $this, 'dropdown_cats_multiple' ], 10, 2 );

					// wpml
					add_filter( 'wcml_multi_currency_ajax_actions', [ $this, 'wcml_multi_currency' ], 99 );

					// WPC Smart Messages
					add_filter( 'wpcsm_locations', [ $this, 'wpcsm_locations' ] );

					// HPOS compatibility
					add_action( 'before_woocommerce_init', function () {
						if ( class_exists( '\Automattic\WooCommerce\Utilities\FeaturesUtil' ) ) {
							FeaturesUtil::declare_compatibility( 'custom_order_tables', WOOSQ_FILE );
						}
					} );
				}

				function init() {
					// image size
					add_image_size( 'woosq', 460, 460, true );

					// shortcode
					add_shortcode( 'woosq', [ $this, 'shortcode_btn' ] );
					add_shortcode( 'woosq_btn', [ $this, 'shortcode_btn' ] );

					// position
					$position = apply_filters( 'woosq_button_position', self::get_setting( 'button_position', apply_filters( 'woosq_button_position_default', 'after_add_to_cart' ) ) );

					if ( ! empty( $position ) ) {
						switch ( $position ) {
							case 'before_title':
								add_action( 'woocommerce_shop_loop_item_title', [ $this, 'add_button' ], 9 );
								break;
							case 'after_title':
								add_action( 'woocommerce_shop_loop_item_title', [ $this, 'add_button' ], 11 );
								break;
							case 'after_rating':
								add_action( 'woocommerce_after_shop_loop_item_title', [ $this, 'add_button' ], 6 );
								break;
							case 'after_price':
								add_action( 'woocommerce_after_shop_loop_item_title', [ $this, 'add_button' ], 11 );
								break;
							case 'before_add_to_cart':
								add_action( 'woocommerce_after_shop_loop_item', [ $this, 'add_button' ], 9 );
								break;
							case 'after_add_to_cart':
								add_action( 'woocommerce_after_shop_loop_item', [ $this, 'add_button' ], 11 );
								break;
							default:
								add_action( 'woosq_button_position_' . $position, [ $this, 'add_button' ] );
						}
					}
				}

				function available_variation( $data, $variable, $variation ) {
					if ( $image_id = $variation->get_image_id() ) {
						$image_sz = apply_filters( 'woosq_image_size', 'default' );

						if ( $image_sz === 'default' ) {
							$image_size = self::get_setting( 'image_size', 'woosq' );
						} else {
							$image_size = $image_sz;
						}

						$image_src               = wp_get_attachment_image_src( $image_id, $image_size );
						$data['woosq_image_id']  = $image_id;
						$data['woosq_image_src'] = $image_src[0];
						$data['woosq_image']     = wp_get_attachment_image( $image_id, $image_size );
					}

					return $data;
				}

				function add_to_cart( $_product ) {
					global $product;
					$product = $_product;

					do_action( 'woosq_before_add_to_cart', $product );

					if ( self::get_setting( 'add_to_cart_button', 'single' ) === 'archive' ) {
						woocommerce_template_loop_add_to_cart();
					} else {
						woocommerce_template_single_add_to_cart();
					}

					do_action( 'woosq_after_add_to_cart', $product );
				}

				function add_to_cart_redirect( $url ) {
					if ( apply_filters( 'woosq_redirect', true ) ) {
						if ( isset( $_REQUEST['woosq-redirect'] ) && ! empty( $_REQUEST['woosq-redirect'] ) ) {
							return esc_url( sanitize_url( $_REQUEST['woosq-redirect'] ) );
						}
					}

					return $url;
				}

				function description( $product ) {
					do_action( 'woosq_before_description', $product );

					$description = $product->get_description();

					if ( ! empty( $description ) ) {
						echo '<div class="product-description">' . do_shortcode( $description ) . '</div>';
					}

					do_action( 'woosq_after_description', $product );
				}

				function cart_item_link( $link, $cart_item ) {
					if ( ! empty( $link ) ) {
						if ( ( isset( $GLOBALS['woosq_mini_cart'] ) && ( self::get_setting( 'mini_cart', 'yes' ) === 'yes' ) ) || ( ! isset( $GLOBALS['woosq_mini_cart'] ) && ( self::get_setting( 'cart', 'yes' ) === 'yes' ) ) ) {
							// mini-cart & cart
							return $link . '#woosq-' . ( ! empty( $cart_item['variation_id'] ) ? $cart_item['variation_id'] : $cart_item['product_id'] );
						}
					}

					return $link;
				}

				function ajax_quickview() {
					check_ajax_referer( 'woosq-security', 'nonce' );

					global $post, $product;
					$product_id = absint( sanitize_key( $_REQUEST['product_id'] ) );
					$product    = wc_get_product( $product_id );

					if ( $product ) {
						$post = get_post( $product_id );
						setup_postdata( $post );
						$thumb_ids = [];

						if ( self::get_setting( 'content_image', 'all' ) === 'product_image' ) {
							if ( $product_image = $product->get_image_id() ) {
								$thumb_ids[] = $product_image;
							}

							if ( $product->is_type( 'variable' ) && ( $children = $product->get_visible_children() ) ) {
								foreach ( $children as $child ) {
									if ( ( $child_product = wc_get_product( $child ) ) && ( $child_product_image = $child_product->get_image_id() ) ) {
										$thumb_ids[] = $child_product_image;
									}
								}
							}
						} else {
							if ( self::get_setting( 'content_image', 'all' ) === 'all' ) {
								if ( $product_image = $product->get_image_id() ) {
									$thumb_ids[] = $product_image;
								}

								if ( $product->is_type( 'variable' ) && ( $children = $product->get_visible_children() ) ) {
									foreach ( $children as $child ) {
										if ( ( $child_product = wc_get_product( $child ) ) && ( $child_product_image = $child_product->get_image_id() ) ) {
											$thumb_ids[] = $child_product_image;
										}
									}
								}
							}

							if ( is_a( $product, 'WC_Product_Variation' ) ) {
								// get images from WPC Additional Variation Images
								$_images = array_filter( explode( ',', get_post_meta( $product_id, 'wpcvi_images', true ) ) );

								if ( ! empty( $_images ) && is_array( $_images ) ) {
									$thumb_ids = array_merge( $thumb_ids, $_images );
								}
							} else {
								$thumb_ids = array_merge( $thumb_ids, $product->get_gallery_image_ids() );
							}
						}

						$thumb_ids = apply_filters( 'woosq_thumbnails', $thumb_ids, $product );
						$thumb_ids = array_unique( $thumb_ids );

						if ( self::get_setting( 'view', 'popup' ) === 'popup' ) {
							echo '<div id="woosq-popup" class="woosq-popup mfp-with-anim ' . esc_attr( self::get_setting( 'content_view_details_button', 'no' ) === 'yes' ? 'view-details' : '' ) . '">';
						} else {
							if ( self::get_setting( 'sidebar_heading', 'no' ) === 'yes' ) {
								echo '<div class="woosq-sidebar-heading"><span class="woosq-heading">' . esc_html( $product->get_name() ) . '</span><span class="woosq-close"> &times; </span></div>';
							} else {
								echo '<span class="woosq-close"> &times; </span>';
							}
						}
						?>
                        <div class="woocommerce single-product woosq-product">
                            <div id="product-<?php echo esc_attr( $product_id ); ?>" <?php wc_product_class( '', $product ); ?>>
                                <div class="thumbnails">
									<?php
									do_action( 'woosq_before_thumbnails', $product );

									echo '<div class="images">';

									$image_sz = apply_filters( 'woosq_image_size', 'default' );

									if ( $image_sz === 'default' ) {
										$image_size = self::get_setting( 'image_size', 'woosq' );
									} else {
										$image_size = $image_sz;
									}

									if ( ! empty( $thumb_ids ) ) {
										foreach ( $thumb_ids as $thumb_id ) {
											if ( self::get_setting( 'content_image_lightbox', 'no' ) !== 'no' ) {
												$image_full = wp_get_attachment_image_src( $thumb_id, 'full' );

												echo '<div class="thumbnail" data-id="' . $thumb_id . '">' . wp_get_attachment_image( $thumb_id, $image_size, false, [
														'data-fancybox' => 'gallery',
														'data-src'      => esc_url( $image_full[0] )
													] ) . '</div>';
											} else {
												echo '<div class="thumbnail" data-id="' . $thumb_id . '">' . wp_get_attachment_image( $thumb_id, $image_size ) . '</div>';
											}
										}
									} else {
										echo '<div class="thumbnail">' . wc_placeholder_img( $image_size ) . '</div>';
									}

									echo '</div>';

									do_action( 'woosq_after_thumbnails', $product );
									?>
                                </div>
                                <div class="summary entry-summary">
									<?php do_action( 'woosq_before_summary', $product ); ?>

                                    <div class="summary-content">
										<?php do_action( 'woosq_product_summary', $product ); ?>
                                    </div>

									<?php do_action( 'woosq_after_summary', $product ); ?>
                                </div>
                            </div>
                        </div><!-- /woocommerce single-product -->
						<?php
						if ( self::get_setting( 'content_view_details_button', 'no' ) === 'yes' ) {
							$view_details_text = self::localization( 'view_details', esc_html__( 'View product details', 'woo-smart-quick-view' ) );

							echo sprintf( '<a class="view-details-btn" href="%s">%s</a>', $product->get_permalink(), esc_html( $view_details_text ) );
						}

						if ( self::get_setting( 'view', 'popup' ) === 'popup' ) {
							echo '</div><!-- #woosq-popup -->';
						}

						wp_reset_postdata();
					}

					wp_die();
				}

				function add_button() {
					echo do_shortcode( '[woosq]' );
				}

				function shortcode_btn( $attrs ) {
					$output = '';

					$attrs = shortcode_atts( [
						'id'      => null,
						'text'    => null,
						'type'    => self::get_setting( 'button_type', 'button' ),
						'effect'  => self::get_setting( 'effect', 'mfp-3d-unfold' ),
						'context' => 'default',
					], $attrs, 'woosq' );

					if ( ! $attrs['id'] ) {
						global $product;

						if ( $product && is_a( $product, 'WC_Product' ) ) {
							$attrs['id'] = $product->get_id();
						}
					}

					if ( $attrs['id'] ) {
						// check cats
						$selected_cats = self::get_setting( 'cats', [] );

						if ( is_array( $selected_cats ) && ! empty( $selected_cats ) && ( $selected_cats[0] !== '0' ) ) {
							if ( ! has_term( $selected_cats, 'product_cat', $attrs['id'] ) ) {
								return '';
							}
						}

						// button text
						if ( ! empty( $attrs['text'] ) ) {
							$button_text = $attrs['text'];
						} else {
							$button_text = self::localization( 'button', esc_html__( 'Quick view', 'woo-smart-quick-view' ) );
						}

						// button class
						$button_class = trim( 'woosq-btn woosq-btn-' . esc_attr( $attrs['id'] ) . ' ' . esc_attr( self::get_setting( 'button_class', '' ) ) );

						if ( ( $button_icon = self::get_setting( 'button_icon', 'no' ) ) !== 'no' ) {
							$button_class .= ' woosq-btn-has-icon';
							$icon         = apply_filters( 'woosq_button_normal_icon', self::get_setting( 'button_normal_icon', 'woosq-icon-1' ) );

							if ( $button_icon === 'left' ) {
								$button_class .= ' woosq-btn-icon-text';
								$button_text  = '<span class="woosq-btn-icon ' . esc_attr( $icon ) . '"></span><span class="woosq-btn-text">' . esc_html( $button_text ) . '</span>';
							} elseif ( $button_icon === 'right' ) {
								$button_class .= ' woosq-btn-text-icon';
								$button_text  = '<span class="woosq-btn-text">' . esc_html( $button_text ) . '</span><span class="woosq-btn-icon ' . esc_attr( $icon ) . '"></span>';
							} else {
								$button_class .= ' woosq-btn-icon-only';
								$button_text  = '<span class="woosq-btn-icon ' . esc_attr( $icon ) . '"></span>';
							}
						}

						$button_class = apply_filters( 'woosq_button_class', $button_class, $attrs );

						if ( $attrs['type'] === 'link' ) {
							$output = '<a href="' . esc_url( '?quick-view=' . $attrs['id'] ) . '" class="' . esc_attr( $button_class ) . '" data-id="' . esc_attr( $attrs['id'] ) . '" data-effect="' . esc_attr( $attrs['effect'] ) . '" data-context="' . esc_attr( $attrs['context'] ) . '">' . $button_text . '</a>';
						} else {
							$output = '<button class="' . esc_attr( $button_class ) . '" data-id="' . esc_attr( $attrs['id'] ) . '" data-effect="' . esc_attr( $attrs['effect'] ) . '" data-context="' . esc_attr( $attrs['context'] ) . '">' . $button_text . '</button>';
						}
					}

					return apply_filters( 'woosq_button_html', $output, $attrs['id'] );
				}

				function before_title( $product ) {
					do_action( 'woosq_before_title', $product );
				}

				function after_title( $product ) {
					do_action( 'woosq_after_title', $product );
				}

				function before_rating( $product ) {
					do_action( 'woosq_before_rating', $product );
				}

				function after_rating( $product ) {
					do_action( 'woosq_after_rating', $product );
				}

				function before_price( $product ) {
					do_action( 'woosq_before_price', $product );
				}

				function after_price( $product ) {
					do_action( 'woosq_after_price', $product );
				}

				function before_excerpt( $product ) {
					do_action( 'woosq_before_excerpt', $product );
				}

				function after_excerpt( $product ) {
					do_action( 'woosq_after_excerpt', $product );
				}

				function before_meta( $product ) {
					do_action( 'woosq_before_meta', $product );
				}

				function after_meta( $product ) {
					do_action( 'woosq_after_meta', $product );
				}

				function register_settings() {
					// settings
					register_setting( 'woosq_settings', 'woosq_settings' );

					// localization
					register_setting( 'woosq_localization', 'woosq_localization' );
				}

				function admin_menu() {
					add_submenu_page( 'wpclever', esc_html__( 'WPC Smart Quick View', 'woo-smart-quick-view' ), esc_html__( 'Smart Quick View', 'woo-smart-quick-view' ), 'manage_options', 'wpclever-woosq', [
						$this,
						'admin_menu_content'
					] );
				}

				function admin_menu_content() {
					$active_tab = isset( $_GET['tab'] ) ? sanitize_key( $_GET['tab'] ) : 'settings';
					?>
                    <div class="wpclever_settings_page wrap">
                        <h1 class="wpclever_settings_page_title"><?php echo esc_html__( 'WPC Smart Quick View', 'woo-smart-quick-view' ) . ' ' . WOOSQ_VERSION . ' ' . ( defined( 'WOOSQ_PREMIUM' ) ? '<span class="premium" style="display: none">' . esc_html__( 'Premium', 'woo-smart-quick-view' ) . '</span>' : '' ); ?></h1>
                        <div class="wpclever_settings_page_desc about-text">
                            <p>
								<?php printf( esc_html__( 'Thank you for using our plugin! If you are satisfied, please reward it a full five-star %s rating.', 'woo-smart-quick-view' ), '<span style="color:#ffb900">&#9733;&#9733;&#9733;&#9733;&#9733;</span>' ); ?>
                                <br/>
                                <a href="<?php echo esc_url( WOOSQ_REVIEWS ); ?>" target="_blank"><?php esc_html_e( 'Reviews', 'woo-smart-quick-view' ); ?></a> |
                                <a href="<?php echo esc_url( WOOSQ_CHANGELOG ); ?>" target="_blank"><?php esc_html_e( 'Changelog', 'woo-smart-quick-view' ); ?></a> |
                                <a href="<?php echo esc_url( WOOSQ_DISCUSSION ); ?>" target="_blank"><?php esc_html_e( 'Discussion', 'woo-smart-quick-view' ); ?></a>
                            </p>
                        </div>
						<?php if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] ) { ?>
                            <div class="notice notice-success is-dismissible">
                                <p><?php esc_html_e( 'Settings updated.', 'woo-smart-quick-view' ); ?></p>
                            </div>
						<?php } ?>
                        <div class="wpclever_settings_page_nav">
                            <h2 class="nav-tab-wrapper">
                                <a href="<?php echo admin_url( 'admin.php?page=wpclever-woosq&tab=settings' ); ?>" class="<?php echo esc_attr( $active_tab === 'settings' ? 'nav-tab nav-tab-active' : 'nav-tab' ); ?>">
									<?php esc_html_e( 'Settings', 'woo-smart-quick-view' ); ?>
                                </a>
                                <a href="<?php echo admin_url( 'admin.php?page=wpclever-woosq&tab=localization' ); ?>" class="<?php echo esc_attr( $active_tab === 'localization' ? 'nav-tab nav-tab-active' : 'nav-tab' ); ?>">
									<?php esc_html_e( 'Localization', 'woo-smart-quick-view' ); ?>
                                </a>
                                <a href="<?php echo admin_url( 'admin.php?page=wpclever-woosq&tab=premium' ); ?>" class="<?php echo esc_attr( $active_tab === 'premium' ? 'nav-tab nav-tab-active' : 'nav-tab' ); ?>" style="color: #c9356e;">
									<?php esc_html_e( 'Premium Version', 'woo-smart-quick-view' ); ?>
                                </a>
                                <a href="<?php echo admin_url( 'admin.php?page=wpclever-kit' ); ?>" class="nav-tab">
									<?php esc_html_e( 'Essential Kit', 'woo-smart-quick-view' ); ?>
                                </a>
                            </h2>
                        </div>
                        <div class="wpclever_settings_page_content">
							<?php if ( $active_tab === 'settings' ) {
								$button_type            = self::get_setting( 'button_type', 'button' );
								$button_icon            = self::get_setting( 'button_icon', 'no' );
								$button_normal_icon     = self::get_setting( 'button_normal_icon', 'woosq-icon-1' );
								$view                   = self::get_setting( 'view', 'popup' );
								$effect                 = self::get_setting( 'effect', 'mfp-3d-unfold' );
								$sidebar_position       = self::get_setting( 'sidebar_position', '01' );
								$sidebar_heading        = self::get_setting( 'sidebar_heading', 'no' );
								$auto_close             = self::get_setting( 'auto_close', 'yes' );
								$perfect_scrollbar      = self::get_setting( 'perfect_scrollbar', 'yes' );
								$mini_cart              = self::get_setting( 'mini_cart', 'yes' );
								$cart                   = self::get_setting( 'cart', 'yes' );
								$content_image          = self::get_setting( 'content_image', 'all' );
								$content_image_lightbox = self::get_setting( 'content_image_lightbox', 'no' );
								$add_to_cart_button     = self::get_setting( 'add_to_cart_button', 'single' );
								$view_details_button    = self::get_setting( 'content_view_details_button', 'no' );
								$suggested              = self::get_setting( 'related_products', [] );

								if ( ! is_array( $suggested ) ) {
									// backward compatible before 3.3.3
									if ( $suggested === 'yes' ) {
										$suggested = [ 'related' ];
									} else {
										$suggested = [];
									}
								}
								?>
                                <form method="post" action="options.php">
                                    <table class="form-table">
                                        <tr class="heading">
                                            <th colspan="2">
												<?php esc_html_e( 'General', 'woo-smart-quick-view' ); ?>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?php esc_html_e( 'Button type', 'woo-smart-quick-view' ); ?></th>
                                            <td>
                                                <select name="woosq_settings[button_type]">
                                                    <option value="button" <?php selected( $button_type, 'button' ); ?>><?php esc_html_e( 'Button', 'woo-smart-quick-view' ); ?></option>
                                                    <option value="link" <?php selected( $button_type, 'link' ); ?>><?php esc_html_e( 'Link', 'woo-smart-quick-view' ); ?></option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?php esc_html_e( 'Use icon', 'woo-smart-quick-view' ); ?></th>
                                            <td>
                                                <select name="woosq_settings[button_icon]" class="woosq_button_icon">
                                                    <option value="left" <?php selected( $button_icon, 'left' ); ?>><?php esc_html_e( 'Icon on the left', 'woo-smart-quick-view' ); ?></option>
                                                    <option value="right" <?php selected( $button_icon, 'right' ); ?>><?php esc_html_e( 'Icon on the right', 'woo-smart-quick-view' ); ?></option>
                                                    <option value="only" <?php selected( $button_icon, 'only' ); ?>><?php esc_html_e( 'Icon only', 'woo-smart-quick-view' ); ?></option>
                                                    <option value="no" <?php selected( $button_icon, 'no' ); ?>><?php esc_html_e( 'No', 'woo-smart-quick-view' ); ?></option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr class="woosq-show-if-button-icon">
                                            <th><?php esc_html_e( 'Icon', 'woo-smart-quick-view' ); ?></th>
                                            <td>
                                                <select name="woosq_settings[button_normal_icon]" class="woosq_icon_picker">
													<?php for ( $i = 1; $i <= 64; $i ++ ) {
														echo '<option value="woosq-icon-' . $i . '" ' . selected( $button_normal_icon, 'woosq-icon-' . $i, false ) . '>woosq-icon-' . $i . '</option>';
													} ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?php esc_html_e( 'Extra class (optional)', 'woo-smart-quick-view' ); ?></th>
                                            <td>
                                                <input type="text" name="woosq_settings[button_class]" value="<?php echo self::get_setting( 'button_class', '' ); ?>"/>
                                                <span class="description"><?php esc_html_e( 'Add extra class for action button/link, split by one space.', 'woo-smart-quick-view' ); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?php esc_html_e( 'Position', 'woo-smart-quick-view' ); ?></th>
                                            <td>
												<?php
												$position  = apply_filters( 'woosq_button_position', 'default' );
												$positions = apply_filters( 'woosq_button_positions', [
													'before_title'       => esc_html__( 'Above title', 'woo-smart-quick-view' ),
													'after_title'        => esc_html__( 'Under title', 'woo-smart-quick-view' ),
													'after_rating'       => esc_html__( 'Under rating', 'woo-smart-quick-view' ),
													'after_price'        => esc_html__( 'Under price', 'woo-smart-quick-view' ),
													'before_add_to_cart' => esc_html__( 'Above add to cart', 'woo-smart-quick-view' ),
													'after_add_to_cart'  => esc_html__( 'Under add to cart', 'woo-smart-quick-view' ),
													'0'                  => esc_html__( 'None (hide it)', 'woo-smart-quick-view' ),
												] );
												?>
                                                <select name="woosq_settings[button_position]" <?php echo esc_attr( $position !== 'default' ? 'disabled' : '' ); ?>>
													<?php
													if ( $position === 'default' ) {
														$position = self::get_setting( 'button_position', apply_filters( 'woosq_button_position_default', 'after_add_to_cart' ) );
													}

													foreach ( $positions as $k => $p ) {
														echo '<option value="' . esc_attr( $k ) . '" ' . ( ( $k === $position ) || ( empty( $position ) && empty( $k ) ) ? 'selected' : '' ) . '>' . esc_html( $p ) . '</option>';
													}
													?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?php esc_html_e( 'Shortcode', 'woo-smart-quick-view' ); ?></th>
                                            <td>
                                                <span class="description"><?php printf( esc_html__( 'You can add the button by manually, please use the shortcode %s, eg. %s for the product with ID is 99.', 'woo-smart-quick-view' ), '<code>[woosq id="{product id}"]</code>', '<code>[woosq id="99"]</code>' ); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?php esc_html_e( 'View type', 'woo-smart-quick-view' ); ?></th>
                                            <td>
                                                <select name="woosq_settings[view]" class="woosq_view">
                                                    <option value="popup" <?php selected( $view, 'popup' ); ?>><?php esc_html_e( 'Popup', 'woo-smart-quick-view' ); ?></option>
                                                    <option value="sidebar" <?php selected( $view, 'sidebar' ); ?>><?php esc_html_e( 'Sidebar', 'woo-smart-quick-view' ); ?></option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr class="woosq_view_type woosq_view_type_popup">
                                            <th scope="row"><?php esc_html_e( 'Popup effect', 'woo-smart-quick-view' ); ?></th>
                                            <td>
                                                <select name="woosq_settings[effect]">
                                                    <option value="mfp-fade" <?php selected( $effect, 'mfp-fade' ); ?>><?php esc_html_e( 'Fade', 'woo-smart-quick-view' ); ?></option>
                                                    <option value="mfp-zoom-in" <?php selected( $effect, 'mfp-zoom-in' ); ?>><?php esc_html_e( 'Zoom in', 'woo-smart-quick-view' ); ?></option>
                                                    <option value="mfp-zoom-out" <?php selected( $effect, 'mfp-zoom-out' ); ?>><?php esc_html_e( 'Zoom out', 'woo-smart-quick-view' ); ?></option>
                                                    <option value="mfp-newspaper" <?php selected( $effect, 'mfp-newspaper' ); ?>><?php esc_html_e( 'Newspaper', 'woo-smart-quick-view' ); ?></option>
                                                    <option value="mfp-move-horizontal" <?php selected( $effect, 'mfp-move-horizontal' ); ?>><?php esc_html_e( 'Move horizontal', 'woo-smart-quick-view' ); ?></option>
                                                    <option value="mfp-move-from-top" <?php selected( $effect, 'mfp-move-from-top' ); ?>><?php esc_html_e( 'Move from top', 'woo-smart-quick-view' ); ?></option>
                                                    <option value="mfp-3d-unfold" <?php selected( $effect, 'mfp-3d-unfold' ); ?>><?php esc_html_e( '3d unfold', 'woo-smart-quick-view' ); ?></option>
                                                    <option value="mfp-slide-bottom" <?php selected( $effect, 'mfp-slide-bottom' ); ?>><?php esc_html_e( 'Slide bottom', 'woo-smart-quick-view' ); ?></option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr class="woosq_view_type woosq_view_type_sidebar">
                                            <th><?php esc_html_e( 'Sidebar position', 'woo-smart-quick-view' ); ?></th>
                                            <td>
                                                <select name="woosq_settings[sidebar_position]">
                                                    <option value="01" <?php selected( $sidebar_position, '01' ); ?>><?php esc_html_e( 'Right', 'woo-smart-quick-view' ); ?></option>
                                                    <option value="02" <?php selected( $sidebar_position, '02' ); ?>><?php esc_html_e( 'Left', 'woo-smart-quick-view' ); ?></option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr class="woosq_view_type woosq_view_type_sidebar">
                                            <th><?php esc_html_e( 'Sidebar heading', 'woo-smart-quick-view' ); ?></th>
                                            <td>
                                                <select name="woosq_settings[sidebar_heading]">
                                                    <option value="yes" <?php selected( $sidebar_heading, 'yes' ); ?>><?php esc_html_e( 'Yes', 'woo-smart-quick-view' ); ?></option>
                                                    <option value="no" <?php selected( $sidebar_heading, 'no' ); ?>><?php esc_html_e( 'No', 'woo-smart-quick-view' ); ?></option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?php esc_html_e( 'Auto close', 'woo-smart-quick-view' ); ?></th>
                                            <td>
                                                <select name="woosq_settings[auto_close]">
                                                    <option value="yes" <?php selected( $auto_close, 'yes' ); ?>><?php esc_html_e( 'Yes', 'woo-smart-quick-view' ); ?></option>
                                                    <option value="no" <?php selected( $auto_close, 'no' ); ?>><?php esc_html_e( 'No', 'woo-smart-quick-view' ); ?></option>
                                                </select>
                                                <span class="description"><?php esc_html_e( 'Auto close the popup after adding a product to the cart.', 'woo-smart-quick-view' ); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?php esc_html_e( 'Use perfect-scrollbar', 'woo-smart-quick-view' ); ?></th>
                                            <td>
                                                <select name="woosq_settings[perfect_scrollbar]">
                                                    <option value="yes" <?php selected( $perfect_scrollbar, 'yes' ); ?>><?php esc_html_e( 'Yes', 'woo-smart-quick-view' ); ?></option>
                                                    <option value="no" <?php selected( $perfect_scrollbar, 'no' ); ?>><?php esc_html_e( 'No', 'woo-smart-quick-view' ); ?></option>
                                                </select>
                                                <span class="description"><?php printf( esc_html__( 'Read more about %s.', 'woo-smart-quick-view' ), '<a href="https://github.com/mdbootstrap/perfect-scrollbar" target="_blank">perfect-scrollbar</a>' ); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?php esc_html_e( 'Categories', 'woo-smart-quick-view' ); ?></th>
                                            <td>
												<?php
												$selected_cats = self::get_setting( 'cats', [] );

												if ( ! is_array( $selected_cats ) || empty( $selected_cats ) ) {
													$selected_cats = [ 0 ];
												}

												wc_product_dropdown_categories(
													[
														'name'             => 'woosq_settings[cats]',
														'id'               => 'woosq_settings_cats',
														'hide_empty'       => 0,
														'value_field'      => 'id',
														'multiple'         => true,
														'show_option_all'  => esc_html__( 'All categories', 'woo-smart-quick-view' ),
														'show_option_none' => '',
														'selected'         => implode( ',', $selected_cats )
													] );
												?>
                                                <span class="description"><?php esc_html_e( 'Only show the Quick View button for products in selected categories.', 'woo-smart-quick-view' ); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?php esc_html_e( 'Enable for mini-cart', 'woo-smart-quick-view' ); ?></th>
                                            <td>
                                                <select name="woosq_settings[mini_cart]">
                                                    <option value="yes" <?php selected( $mini_cart, 'yes' ); ?>><?php esc_html_e( 'Yes', 'woo-smart-quick-view' ); ?></option>
                                                    <option value="no" <?php selected( $mini_cart, 'no' ); ?>><?php esc_html_e( 'No', 'woo-smart-quick-view' ); ?></option>
                                                </select>
                                                <span class="description"><?php esc_html_e( 'Enable quick view for products on mini-cart.', 'woo-smart-quick-view' ); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?php esc_html_e( 'Enable for cart page', 'woo-smart-quick-view' ); ?></th>
                                            <td>
                                                <select name="woosq_settings[cart]">
                                                    <option value="yes" <?php selected( $cart, 'yes' ); ?>><?php esc_html_e( 'Yes', 'woo-smart-quick-view' ); ?></option>
                                                    <option value="no" <?php selected( $cart, 'no' ); ?>><?php esc_html_e( 'No', 'woo-smart-quick-view' ); ?></option>
                                                </select>
                                                <span class="description"><?php esc_html_e( 'Enable quick view for products on the cart page.', 'woo-smart-quick-view' ); ?></span>
                                            </td>
                                        </tr>
                                        <tr class="heading">
                                            <th>
												<?php esc_html_e( 'Content', 'woo-smart-quick-view' ); ?>
                                            </th>
                                            <td>
                                                <span style="color: #c9356e">Below settings are available on Premium Version only, click <a href="https://wpclever.net/downloads/smart-quick-view?utm_source=pro&utm_medium=woosq&utm_campaign=wporg" target="_blank">here</a> to buy, just $29!</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?php esc_html_e( 'Images', 'woo-smart-quick-view' ); ?></th>
                                            <td>
                                                <select name="woosq_settings[content_image]">
                                                    <option value="all" <?php selected( $content_image, 'all' ); ?>><?php esc_html_e( 'Product image & Product gallery images', 'woo-smart-quick-view' ); ?></option>
                                                    <option value="product_image" <?php selected( $content_image, 'product_image' ); ?>><?php esc_html_e( 'Product image', 'woo-smart-quick-view' ); ?></option>
                                                    <option value="product_gallery" <?php selected( $content_image, 'product_gallery' ); ?>><?php esc_html_e( 'Product gallery images', 'woo-smart-quick-view' ); ?></option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?php esc_html_e( 'Image size', 'woo-smart-quick-view' ); ?></th>
                                            <td>
												<?php
												$image_sz = apply_filters( 'woosq_image_size', 'default' );

												if ( $image_sz === 'default' ) {
													$image_size = self::get_setting( 'image_size', 'woosq' );
												} else {
													$image_size = $image_sz;
												}

												$image_sizes         = $this->get_image_sizes();
												$image_sizes['full'] = [
													'width'  => '',
													'height' => '',
													'crop'   => false
												];

												if ( ! empty( $image_sizes ) ) {
													echo '<select name="woosq_settings[image_size]" ' . ( $image_sz !== 'default' ? 'disabled' : '' ) . '>';

													foreach ( $image_sizes as $image_size_name => $image_size_data ) {
														echo '<option value="' . esc_attr( $image_size_name ) . '" ' . ( $image_size_name === $image_size ? 'selected' : '' ) . '>' . esc_attr( $image_size_name ) . ( ! empty( $image_size_data['width'] ) ? ' ' . $image_size_data['width'] . '&times;' . $image_size_data['height'] : '' ) . ( $image_size_data['crop'] ? ' (cropped)' : '' ) . '</option>';
													}

													echo '</select>';
												}
												?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?php esc_html_e( 'Product images effect', 'woo-smart-quick-view' ); ?></th>
                                            <td>
                                                <select name="woosq_settings[content_image_lightbox]">
                                                    <option value="no" <?php selected( $content_image_lightbox, 'no' ); ?>><?php esc_html_e( 'None', 'woo-smart-quick-view' ); ?></option>
                                                    <option value="yes" <?php selected( $content_image_lightbox, 'yes' ); ?>><?php esc_html_e( 'Lightbox', 'woo-smart-quick-view' ); ?></option>
                                                    <option value="zoom" <?php selected( $content_image_lightbox, 'zoom' ); ?>><?php esc_html_e( 'Zoom', 'woo-smart-quick-view' ); ?></option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?php esc_html_e( 'Product summary', 'woo-smart-quick-view' ); ?></th>
                                            <td>
                                                <span class="description"><?php esc_html_e( 'Drag and drop to re-arrange these fields.', 'woo-smart-quick-view' ); ?></span>
                                                <ul class="woosq-summary">
													<?php
													$saved_summary = [];
													$summary       = self::get_setting( 'summary', self::$summary_default );

													foreach ( $summary as $s ) {
														$saved_summary[ $s ] = self::$summary[ $s ];
													}

													$merge_summary = array_merge( $saved_summary, self::$summary );

													foreach ( $merge_summary as $k => $s ) {
														echo '<li><input type="checkbox" name="woosq_settings[summary][]" value="' . esc_attr( $k ) . '" ' . ( is_array( $summary ) && in_array( $k, $summary, true ) ? 'checked' : '' ) . '/><span class="label">' . $s . '</span></li>';
													}
													?>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?php esc_html_e( 'Add to cart button', 'woo-smart-quick-view' ); ?></th>
                                            <td>
                                                <select name="woosq_settings[add_to_cart_button]">
                                                    <option value="archive" <?php selected( $add_to_cart_button, 'archive' ); ?>><?php esc_html_e( 'Like archive page', 'woo-smart-quick-view' ); ?></option>
                                                    <option value="single" <?php selected( $add_to_cart_button, 'single' ); ?>><?php esc_html_e( 'Like single page', 'woo-smart-quick-view' ); ?></option>
                                                </select>
                                                <span class="description"><?php esc_html_e( 'Choose the functionally for the add to cart button.', 'woo-smart-quick-view' ); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?php esc_html_e( 'Suggested products', 'woo-smart-quick-view' ); ?></th>
                                            <td>
                                                <ul>
                                                    <li>
                                                        <label><input type="checkbox" name="woosq_settings[related_products][]" value="related" <?php echo esc_attr( in_array( 'related', $suggested ) ? 'checked' : '' ); ?>/> <?php esc_html_e( 'Related products', 'woo-smart-quick-view' ); ?>
                                                        </label></li>
                                                    <li>
                                                        <label><input type="checkbox" name="woosq_settings[related_products][]" value="up-sells" <?php echo esc_attr( in_array( 'up-sells', $suggested ) ? 'checked' : '' ); ?>/> <?php esc_html_e( 'Upsells products', 'woo-smart-quick-view' ); ?>
                                                        </label></li>
                                                    <li>
                                                        <label><input type="checkbox" name="woosq_settings[related_products][]" value="cross-sells" <?php echo esc_attr( in_array( 'cross-sells', $suggested ) ? 'checked' : '' ); ?>/> <?php esc_html_e( 'Cross-sells products', 'woo-smart-quick-view' ); ?>
                                                        </label></li>
                                                    <li>
                                                        <label><input type="checkbox" name="woosq_settings[related_products][]" value="wishlist" <?php echo esc_attr( in_array( 'wishlist', $suggested ) ? 'checked' : '' ); ?>/> <?php esc_html_e( 'Wishlist', 'woo-smart-quick-view' ); ?>
                                                        </label> <span class="description">(from
                                                            <a href="<?php echo esc_url( admin_url( 'plugin-install.php?tab=plugin-information&plugin=woo-smart-wishlist&TB_iframe=true&width=800&height=550' ) ); ?>" class="thickbox" title="WPC Smart Wishlist">WPC Smart Wishlist</a>)</span>
                                                    </li>
                                                    <li>
                                                        <label><input type="checkbox" name="woosq_settings[related_products][]" value="compare" <?php echo esc_attr( in_array( 'compare', $suggested ) ? 'checked' : '' ); ?>/> <?php esc_html_e( 'Compare', 'woo-smart-quick-view' ); ?>
                                                        </label> <span class="description">(from
                                                        <a href="<?php echo esc_url( admin_url( 'plugin-install.php?tab=plugin-information&plugin=woo-smart-compare&TB_iframe=true&width=800&height=550' ) ); ?>" class="thickbox" title="WPC Smart Compare">WPC Smart Compare</a>)</span>
                                                    </li>
                                                </ul>
                                                <span class="description">You can use
                                                    <a href="<?php echo esc_url( admin_url( 'plugin-install.php?tab=plugin-information&plugin=wpc-custom-related-products&TB_iframe=true&width=800&height=550' ) ); ?>" class="thickbox" title="WPC Custom Related Products">WPC Custom Related Products</a> or
                                                    <a href="<?php echo esc_url( admin_url( 'plugin-install.php?tab=plugin-information&plugin=wpc-smart-linked-products&TB_iframe=true&width=800&height=550' ) ); ?>" class="thickbox" title="WPC Smart Linked Products">WPC Smart Linked Products</a> plugin to configure related/upsells/cross-sells in bulk with smart conditions.
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?php esc_html_e( 'View details button', 'woo-smart-quick-view' ); ?></th>
                                            <td>
                                                <select name="woosq_settings[content_view_details_button]">
                                                    <option value="no" <?php selected( $view_details_button, 'no' ); ?>><?php esc_html_e( 'No', 'woo-smart-quick-view' ); ?></option>
                                                    <option value="yes" <?php selected( $view_details_button, 'yes' ); ?>><?php esc_html_e( 'Yes', 'woo-smart-quick-view' ); ?></option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr class="heading">
                                            <th colspan="2"><?php esc_html_e( 'Suggestion', 'woo-smart-quick-view' ); ?></th>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                To display custom engaging real-time messages on any wished positions, please install
                                                <a href="https://wordpress.org/plugins/wpc-smart-messages/" target="_blank">WPC Smart Messages</a> plugin. It's free!
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                Wanna save your precious time working on variations? Try our brand-new free plugin
                                                <a href="https://wordpress.org/plugins/wpc-variation-bulk-editor/" target="_blank">WPC Variation Bulk Editor</a> and
                                                <a href="https://wordpress.org/plugins/wpc-variation-duplicator/" target="_blank">WPC Variation Duplicator</a>.
                                            </td>
                                        </tr>
                                        <tr class="submit">
                                            <th colspan="2">
												<?php settings_fields( 'woosq_settings' ); ?><?php submit_button(); ?>
                                            </th>
                                        </tr>
                                    </table>
                                </form>
							<?php } elseif ( $active_tab === 'localization' ) { ?>
                                <form method="post" action="options.php">
                                    <table class="form-table">
                                        <tr class="heading">
                                            <th scope="row"><?php esc_html_e( 'Localization', 'woo-smart-quick-view' ); ?></th>
                                            <td>
												<?php esc_html_e( 'Leave blank to use the default text and its equivalent translation in multiple languages.', 'woo-smart-quick-view' ); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th><?php esc_html_e( 'Button text', 'woo-smart-quick-view' ); ?></th>
                                            <td>
                                                <input type="text" class="regular-text" name="woosq_localization[button]" value="<?php echo esc_attr( self::localization( 'button' ) ); ?>" placeholder="<?php esc_attr_e( 'Quick view', 'woo-smart-quick-view' ); ?>"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th><?php esc_html_e( 'Close', 'woo-smart-quick-view' ); ?></th>
                                            <td>
                                                <input type="text" class="regular-text" name="woosq_localization[close]" value="<?php echo esc_attr( self::localization( 'close' ) ); ?>" placeholder="<?php esc_attr_e( 'Close (Esc)', 'woo-smart-quick-view' ); ?>"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th><?php esc_html_e( 'Next', 'woo-smart-quick-view' ); ?></th>
                                            <td>
                                                <input type="text" class="regular-text" name="woosq_localization[next]" value="<?php echo esc_attr( self::localization( 'next' ) ); ?>" placeholder="<?php esc_attr_e( 'Next (Right arrow key)', 'woo-smart-quick-view' ); ?>"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th><?php esc_html_e( 'Previous', 'woo-smart-quick-view' ); ?></th>
                                            <td>
                                                <input type="text" class="regular-text" name="woosq_localization[prev]" value="<?php echo esc_attr( self::localization( 'prev' ) ); ?>" placeholder="<?php esc_attr_e( 'Previous (Left arrow key)', 'woo-smart-quick-view' ); ?>"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th><?php esc_html_e( 'Suggested products', 'woo-smart-quick-view' ); ?></th>
                                            <td>
                                                <input type="text" class="regular-text" name="woosq_localization[related_products]" value="<?php echo esc_attr( self::localization( 'related_products' ) ); ?>" placeholder="<?php esc_attr_e( 'You may also like&hellip;', 'woo-smart-quick-view' ); ?>"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th><?php esc_html_e( 'View details text', 'woo-smart-quick-view' ); ?></th>
                                            <td>
                                                <input type="text" class="regular-text" name="woosq_localization[view_details]" value="<?php echo esc_attr( self::localization( 'view_details' ) ); ?>" placeholder="<?php esc_attr_e( 'View product details', 'woo-smart-quick-view' ); ?>"/>
                                            </td>
                                        </tr>
                                        <tr class="submit">
                                            <th colspan="2">
												<?php settings_fields( 'woosq_localization' ); ?><?php submit_button(); ?>
                                            </th>
                                        </tr>
                                    </table>
                                </form>
							<?php } elseif ( $active_tab === 'premium' ) { ?>
                                <div class="wpclever_settings_page_content_text">
                                    <p>Get the Premium Version just $29!
                                        <a href="https://wpclever.net/downloads/smart-quick-view?utm_source=pro&utm_medium=woosq&utm_campaign=wporg" target="_blank">https://wpclever.net/downloads/smart-quick-view</a>
                                    </p>
                                    <p><strong>Extra features for Premium Version:</strong></p>
                                    <ul style="margin-bottom: 0">
                                        <li>- Add lightbox/zoom effect for product images.</li>
                                        <li>- Show/hide or re-arrange the part of content in the popup.</li>
                                        <li>- Add "View Product Details" button.</li>
                                        <li>- Get the lifetime update & premium support.</li>
                                    </ul>
                                </div>
							<?php } ?>
                        </div>
                    </div>
					<?php
				}

				function admin_enqueue_scripts( $hook ) {
					if ( strpos( $hook, 'woosq' ) ) {
						wp_enqueue_style( 'woosq-backend', WOOSQ_URI . 'assets/css/backend.css', [ 'woocommerce_admin_styles' ], WOOSQ_VERSION );

						add_thickbox();
						wp_enqueue_style( 'fonticonpicker', WOOSQ_URI . 'assets/libs/fonticonpicker/css/jquery.fonticonpicker.css' );
						wp_enqueue_script( 'fonticonpicker', WOOSQ_URI . 'assets/libs/fonticonpicker/js/jquery.fonticonpicker.min.js', [ 'jquery' ] );
						wp_enqueue_style( 'woosq-icons', WOOSQ_URI . 'assets/css/icons.css', [], WOOSQ_VERSION );
						wp_enqueue_script( 'woosq-backend', WOOSQ_URI . 'assets/js/backend.js', [
							'jquery',
							'jquery-ui-sortable',
							'selectWoo',
						], WOOSQ_VERSION, true );
					}
				}

				function enqueue_scripts() {
					wp_enqueue_script( 'wc-add-to-cart-variation' );

					// slick
					wp_enqueue_style( 'slick', WOOSQ_URI . 'assets/libs/slick/slick.css' );
					wp_enqueue_script( 'slick', WOOSQ_URI . 'assets/libs/slick/slick.min.js', [ 'jquery' ], WOOSQ_VERSION, true );

					// fancybox
					if ( self::get_setting( 'content_image_lightbox', 'no' ) === 'yes' ) {
						wp_enqueue_style( 'fancybox', WOOSQ_URI . 'assets/libs/fancybox/jquery.fancybox.min.css' );
						wp_enqueue_script( 'fancybox', WOOSQ_URI . 'assets/libs/fancybox/jquery.fancybox.min.js', [ 'jquery' ], WOOSQ_VERSION, true );
					}

					// zoom
					if ( self::get_setting( 'content_image_lightbox', 'no' ) === 'zoom' ) {
						wp_enqueue_script( 'zoom', WOOSQ_URI . 'assets/libs/zoom/jquery.zoom.min.js', [ 'jquery' ], WOOSQ_VERSION, true );
					}

					// perfect srollbar
					if ( self::get_setting( 'perfect_scrollbar', 'yes' ) === 'yes' ) {
						wp_enqueue_style( 'perfect-scrollbar', WOOSQ_URI . 'assets/libs/perfect-scrollbar/css/perfect-scrollbar.min.css' );
						wp_enqueue_style( 'perfect-scrollbar-wpc', WOOSQ_URI . 'assets/libs/perfect-scrollbar/css/custom-theme.css' );
						wp_enqueue_script( 'perfect-scrollbar', WOOSQ_URI . 'assets/libs/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js', [ 'jquery' ], WOOSQ_VERSION, true );
					}

					// magnific
					if ( self::get_setting( 'view', 'popup' ) === 'popup' ) {
						wp_enqueue_style( 'magnific-popup', WOOSQ_URI . 'assets/libs/magnific-popup/magnific-popup.css' );
						wp_enqueue_script( 'magnific-popup', WOOSQ_URI . 'assets/libs/magnific-popup/jquery.magnific-popup.min.js', [ 'jquery' ], WOOSQ_VERSION, true );
					}

					// feather icons
					wp_enqueue_style( 'woosq-feather', WOOSQ_URI . 'assets/libs/feather/feather.css' );

					if ( self::get_setting( 'button_icon', 'no' ) !== 'no' ) {
						wp_enqueue_style( 'woosq-icons', WOOSQ_URI . 'assets/css/icons.css', [], WOOSQ_VERSION );
					}

					// main style & js
					wp_enqueue_style( 'woosq-frontend', WOOSQ_URI . 'assets/css/frontend.css', [], WOOSQ_VERSION );
					wp_enqueue_script( 'woosq-frontend', WOOSQ_URI . 'assets/js/frontend.js', [
						'jquery',
						'wc-add-to-cart-variation'
					], WOOSQ_VERSION, true );
					wp_localize_script( 'woosq-frontend', 'woosq_vars', [
							'ajax_url'                => admin_url( 'admin-ajax.php' ),
							'nonce'                   => wp_create_nonce( 'woosq-security' ),
							'view'                    => self::get_setting( 'view', 'popup' ),
							'effect'                  => self::get_setting( 'effect', 'mfp-3d-unfold' ),
							'scrollbar'               => self::get_setting( 'perfect_scrollbar', 'yes' ),
							'auto_close'              => self::get_setting( 'auto_close', 'yes' ),
							'hashchange'              => apply_filters( 'woosq_hashchange', 'no' ),
							'cart_redirect'           => get_option( 'woocommerce_cart_redirect_after_add' ),
							'cart_url'                => apply_filters( 'woocommerce_add_to_cart_redirect', wc_get_cart_url(), null ),
							'close'                   => self::localization( 'close', esc_html__( 'Close (Esc)', 'woo-smart-quick-view' ) ),
							'next'                    => self::localization( 'next', esc_html__( 'Next (Right arrow key)', 'woo-smart-quick-view' ) ),
							'prev'                    => self::localization( 'prev', esc_html__( 'Previous (Left arrow key)', 'woo-smart-quick-view' ) ),
							'thumbnails_effect'       => self::get_setting( 'content_image_lightbox', 'no' ),
							'related_slick_params'    => apply_filters( 'woosq_related_slick_params', json_encode( apply_filters( 'woosq_related_slick_params_arr', [
								'slidesToShow'   => 2,
								'slidesToScroll' => 2,
								'dots'           => true,
								'arrows'         => false,
								'adaptiveHeight' => true,
								'rtl'            => is_rtl()
							] ) ) ),
							'thumbnails_slick_params' => apply_filters( 'woosq_thumbnails_slick_params', json_encode( apply_filters( 'woosq_thumbnails_slick_params_arr', [
								'slidesToShow'   => 1,
								'slidesToScroll' => 1,
								'dots'           => true,
								'arrows'         => true,
								'adaptiveHeight' => false,
								'rtl'            => is_rtl()
							] ) ) ),
							'thumbnails_zoom_params'  => apply_filters( 'woosq_thumbnails_zoom_params', json_encode( apply_filters( 'woosq_thumbnails_zoom_params_arr', [
								'duration' => 120,
								'magnify'  => 1
							] ) ) ),
							'quick_view'              => isset( $_REQUEST['quick-view'] ) ? absint( sanitize_key( $_REQUEST['quick-view'] ) ) : 0,
						]
					);
				}

				function footer() {
					if ( self::get_setting( 'view', 'popup' ) === 'sidebar' ) {
						echo '<div id="woosq-popup" class="woosq-sidebar woosq-position-' . esc_attr( self::get_setting( 'sidebar_position', '01' ) ) . ' woosq-heading-' . esc_attr( self::get_setting( 'sidebar_heading', 'no' ) ) . '"></div>';
						echo '<div class="woosq-overlay"></div>';
					}
				}

				function action_links( $links, $file ) {
					static $plugin;

					if ( ! isset( $plugin ) ) {
						$plugin = plugin_basename( __FILE__ );
					}

					if ( $plugin === $file ) {
						$settings             = '<a href="' . admin_url( 'admin.php?page=wpclever-woosq&tab=settings' ) . '">' . esc_html__( 'Settings', 'woo-smart-quick-view' ) . '</a>';
						$links['wpc-premium'] = '<a href="' . admin_url( 'admin.php?page=wpclever-woosq&tab=premium' ) . '">' . esc_html__( 'Premium Version', 'woo-smart-quick-view' ) . '</a>';
						array_unshift( $links, $settings );
					}

					return (array) $links;
				}

				function row_meta( $links, $file ) {
					static $plugin;

					if ( ! isset( $plugin ) ) {
						$plugin = plugin_basename( __FILE__ );
					}

					if ( $plugin === $file ) {
						$row_meta = [
							'support' => '<a href="' . esc_url( WOOSQ_DISCUSSION ) . '" target="_blank">' . esc_html__( 'Community support', 'woo-smart-quick-view' ) . '</a>',
						];

						return array_merge( $links, $row_meta );
					}

					return (array) $links;
				}

				function get_image_sizes() {
					global $_wp_additional_image_sizes;
					$sizes = [];

					foreach ( get_intermediate_image_sizes() as $_size ) {
						if ( in_array( $_size, [ 'thumbnail', 'medium', 'medium_large', 'large' ] ) ) {
							$sizes[ $_size ]['width']  = get_option( "{$_size}_size_w" );
							$sizes[ $_size ]['height'] = get_option( "{$_size}_size_h" );
							$sizes[ $_size ]['crop']   = (bool) get_option( "{$_size}_crop" );
						} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
							$sizes[ $_size ] = [
								'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
								'height' => $_wp_additional_image_sizes[ $_size ]['height'],
								'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
							];
						}
					}

					return $sizes;
				}

				function dropdown_cats_multiple( $output, $r ) {
					if ( isset( $r['multiple'] ) && $r['multiple'] ) {
						$output = preg_replace( '/^<select/i', '<select multiple', $output );
						$output = str_replace( "name='{$r['name']}'", "name='{$r['name']}[]'", $output );

						foreach ( array_map( 'trim', explode( ',', $r['selected'] ) ) as $value ) {
							$output = str_replace( "value=\"{$value}\"", "value=\"{$value}\" selected", $output );
						}
					}

					return $output;
				}

				function wpcsm_locations( $locations ) {
					$locations['WPC Smart Quick View'] = [
						'woosq_before_thumbnails'  => esc_html__( 'Before thumbnails', 'woo-smart-quick-view' ),
						'woosq_after_thumbnails'   => esc_html__( 'After thumbnails', 'woo-smart-quick-view' ),
						'woosq_before_summary'     => esc_html__( 'Before summary', 'woo-smart-quick-view' ),
						'woosq_after_summary'      => esc_html__( 'After summary', 'woo-smart-quick-view' ),
						'woosq_before_title'       => esc_html__( 'Before title', 'woo-smart-quick-view' ),
						'woosq_after_title'        => esc_html__( 'After title', 'woo-smart-quick-view' ),
						'woosq_before_rating'      => esc_html__( 'Before rating', 'woo-smart-quick-view' ),
						'woosq_after_rating'       => esc_html__( 'After rating', 'woo-smart-quick-view' ),
						'woosq_before_price'       => esc_html__( 'Before price', 'woo-smart-quick-view' ),
						'woosq_after_price'        => esc_html__( 'After price', 'woo-smart-quick-view' ),
						'woosq_before_excerpt'     => esc_html__( 'Before excerpt', 'woo-smart-quick-view' ),
						'woosq_after_excerpt'      => esc_html__( 'After excerpt', 'woo-smart-quick-view' ),
						'woosq_before_meta'        => esc_html__( 'Before meta', 'woo-smart-quick-view' ),
						'woosq_after_meta'         => esc_html__( 'After meta', 'woo-smart-quick-view' ),
						'woosq_product_summary:39' => esc_html__( 'Before suggested products', 'woo-smart-quick-view' ),
						'woosq_product_summary:41' => esc_html__( 'After suggested products', 'woo-smart-quick-view' ),
					];

					return $locations;
				}

				function wcml_multi_currency( $ajax_actions ) {
					$ajax_actions[] = 'woosq_quickview';

					return $ajax_actions;
				}

				public static function get_settings() {
					return apply_filters( 'woosq_get_settings', self::$settings );
				}

				public static function get_setting( $name, $default = false ) {
					if ( ! empty( self::$settings ) ) {
						if ( isset( self::$settings[ $name ] ) ) {
							$setting = self::$settings[ $name ];
						} else {
							$setting = $default;
						}
					} else {
						$setting = get_option( 'woosq_' . $name, $default );
					}

					return apply_filters( 'woosq_get_setting', $setting, $name, $default );
				}

				public static function localization( $key = '', $default = '' ) {
					$str = '';

					if ( ! empty( $key ) && ! empty( self::$localization[ $key ] ) ) {
						$str = self::$localization[ $key ];
					} elseif ( ! empty( $default ) ) {
						$str = $default;
					}

					return apply_filters( 'woosq_localization_' . $key, $str );
				}
			}

			return WPCleverWoosq::instance();
		}

		return null;
	}
}

if ( ! function_exists( 'woosq_notice_wc' ) ) {
	function woosq_notice_wc() {
		?>
        <div class="error">
            <p><strong>WPC Smart Quick View</strong> requires WooCommerce version 3.0 or greater.</p>
        </div>
		<?php
	}
}
