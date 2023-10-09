=== WPC Smart Compare for WooCommerce ===
Contributors: wpclever
Donate link: https://wpclever.net
Tags: woocommerce, woo, wpc, smart, compare, product-compare, smart-compare
Requires at least: 4.0
Tested up to: 6.3
Stable tag: 6.1.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

WPC Smart Compare is an extension of WooCommerce plugin that allows your users to compare some products of your shop. You can quickly access to the compare table (powerful AJAX without open new page or iframe), rearrange the compare products with drag/drop.

== Description ==

**WPC Smart Compare** is an optimal solution that brings about beyond-expectation features for improving user experience and enhance the sales strategy on your online WooCommerce shop. Advanced comparing features, detailed settings with extensive options for further customizing the Compare button, comparison table & comparison bar, powerful responsiveness and mobile friendly interface are things that you should not overlook from this plugin. A truly sharp comparing tool for powering your WooCommerce shop and obtaining customers’ trust. Let’s put this Smart Compare in a comparison now.

= Live demo =

Curious about how WPC Smart Compare works? Visit our [live demo 01](https://demo.wpclever.net/woosc/ "live demo 01") or [live demo 02](https://demo.wpclever.net/wpcplant/ "live demo 02") to have a play around. Try out each and every feature listed here to give your business a real boost.

= Features =

- Powerful AJAX functions (there’s no need to open a new tab or iframe)
- Drag and drop to rearrange product order in the comparison line
- Switch between horizontal and vertical view of comparison table (coming soon)
- Adjust the visibility of Compare button for products in selected categories
- Save login data for registered/subscribed users (same function as the Wishlist plugin)
- Automatically prompt related products when searching for items in the comparison table
- Prompt new products instantly when the table is empty or no related products found
- Enable/disable Quick Comparison Table for related products
- Customize the position of Quick Comparison Table on single product pages
- Add new products to the comparison list instantly by pressing the search button
- Fully responsive & mobile friendly view on any touch devices
- Dynamic comparison table: sticky first column & row
- Using custom shortcodes to add buttons to specific pages
- Unlimited choice of bar background color and button color
- Hide/show fields for a clearer view in comparison table
- WPML compatible for building multilingual sites
- Compare button advanced settings: type, text, visibility, categories, product removal
- Comparison table advanced settings: fields, attributes, sticky column & row
- Comparison bar settings: Add More button, Remove All button, bar appearance, ...
- HOT: Comparison methods - hide similarities and highlight differences
- HOT: Share button - social media sharing via links

= Premium Version =

- Support customization of all attributes, custom attributes
- Support customization of all product fields, custom fields
- HOT: Free support of compare button’s adjustment to customers’ theme design

= Translators =

Available languages: English (Default), Italian, Vietnamese, Russian, Spanish, Persian

If you have created your own language pack, or have an update for an existing one, you can send [gettext PO and MO file](http://codex.wordpress.org/Translating_WordPress "Translating WordPress") to [us](https://wpclever.net/contact?utm_source=pot&utm_medium=woosc&utm_campaign=wporg "WPClever.net") so we can bundle it into WPC Smart Compare.

= Need more features? =

Please try other plugins from us:

- [WPC Smart Wishlist](https://wordpress.org/plugins/woo-smart-wishlist/ "WPC Smart Wishlist")
- [WPC Smart Quick View](https://wordpress.org/plugins/woo-smart-quick-view/ "WPC Smart Quick View")
- [WPC Fly Cart](https://wordpress.org/plugins/woo-fly-cart/ "WPC Fly Cart")
- [WPC AJAX Add to Cart](https://wordpress.org/plugins/wpc-ajax-add-to-cart/ "WPC AJAX Add to Cart")
- [WPC Added To Cart Notification](https://wordpress.org/plugins/woo-added-to-cart-notification/ "WPC Added To Cart Notification")

= Rate us & Review =

If you love our plugins, please give us a full five-star rating so that we know that our work is valued and appreciated. This will be the drive and motivation for us to further improve our plugins with more useful features. Tell us what you think and suggest some ways for improvement. We highly appreciate your support and love.

== Installation ==

1. Please make sure that you installed WooCommerce
2. Go to Plugins in your dashboard and select "Add New"
3. Search for "WPC Smart Compare", Install & Activate it
4. Now you can see the Compare button on each product
5. Go to settings page to configure the compare button/bar/table as you want

== Frequently Asked Questions ==

= How to integrate with my theme? =

To integrate with a theme, please use bellow filter to hide the default buttons.

`add_filter( 'woosc_button_position_archive', '__return_false' );
add_filter( 'woosc_button_position_single', '__return_false' );`

After that, use the shortcode to display the button where you want.

`echo do_shortcode('[woosc id="{product_id}"]');`

Example:

`echo do_shortcode('[woosc id="99"]');`

== Changelog ==

= 6.1.4 =
* Added: Function 'get_user_key' & 'get_products'
* Updated: Optimized the code

= 6.1.3 =
* Updated: Compatible with WP 6.3 & Woo 8.0

= 6.1.2 =
* Updated: Optimized the code

= 6.1.1 =
* Fixed: CSRF vulnerability

= 6.1.0 =
* Updated: Optimized the code

= 6.0.1 =
* Added: Custom text/shortcode field

= 6.0.0 =
* Updated: New interface for fields manager

= 5.5.0 =
* Fixed: Configure fields for quick comparison table

= 5.4.8 =
* Fixed: Minor CSS/JS issue for the backend

= 5.4.7 =
* Fixed: Minor CSS issue

= 5.4.6 =
* Added: Parameter 'products' for shortcode [woosc_list] to show the comparison table of selected products

= 5.4.5 =
* Added: "Above title" position

= 5.4.4 =
* Updated: Optimized the code

= 5.4.3 =
* Added: Comparison menu on My Account page

= 5.4.2 =
* Updated: Optimized the code

= 5.4.1 =
* Fixed: Minor CSS/JS issue for the backend

= 5.4.0 =
* Updated: Optimized the code

= 5.3.9 =
* Fixed: Images don't show when printing on Safari

= 5.3.8 =
* Added: Print button to print the comparison table

= 5.3.7 =
* Fixed: Minor issue for variations

= 5.3.6 =
* Added: Option to enable "Hide similarities" and "Highlight differences" by default

= 5.3.5 =
* Updated: Optimized the code

= 5.3.4 =
* Fixed: JQMIGRATE: jQuery.fn.resize() event shorthand is deprecated

= 5.3.3 =
* Fixed: 404 error when the comparison page is a child page

= 5.3.2 =
* Fixed: Minor JS issue in the backend

= 5.3.1 =
* Added: Function 'get_settings' & 'get_setting'
* Updated: Optimized the code

= 5.3.0 =
* Added: Quick comparison table on single product page

= 5.2.1 =
* Added: Show related products as default when opening the search popup

= 5.2.0 =
* Added: Icon picker for the button

= 5.1.7 =
* Fixed: Filter hook 'woosc_field_value'

= 5.1.6 =
* Fixed: Compatible with WPML

= 5.1.5 =
* Added: Product adding option, prepend or append

= 5.1.4 =
* Fixed: Notice on settings page

= 5.1.3 =
* Fixed: Can't change button position

= 5.1.2 =
* Updated: Optimized the code

= 5.1.1 =
* Fixed: Minor CSS/JS issues

= 5.1.0 =
* Added: Compare sidebar

= 5.0.0 =
* Added: Enable show the message only when adding to the compare
* Updated: Optimized the code

= 4.4.6 =
* Updated: Backward compatibility with WPC themes

= 4.4.5 =
* Updated: Optimized the code

= 4.4.4 =
* Added: Localization for fields' label

= 4.4.3 =
* Fixed: Error while searching products for selected categories

= 4.4.2 =
* Updated: Optimized the code

= 4.4.1 =
* Fixed: Minor CSS/JS issues

= 4.4.0 =
* Added: Generate the share link for current compare table

= 4.3.2 =
* Fixed: Minor CSS/JS issues

= 4.3.1 =
* Fixed: Hide similarities & Highlight differences doesn't work when having placeholder column

= 4.3.0 =
* Added: Hide similarities & Highlight differences

= 4.2.8 =
* Fixed: Remove button on compare page

= 4.2.7 =
* Added: Remove button beside product name

= 4.2.6 =
* Added: Filter hook 'woosc_button_positions_archive', 'woosc_button_positions_single'

= 4.2.5 =
* Updated: Compatible with WP 5.9 & Woo 6.1

= 4.2.4 =
* Fixed: Compare button for variable product

= 4.2.3 =
* Updated: Optimized the code

= 4.2.2 =
* Added: Filter hook 'woosc_verify_nonce'

= 4.2.1 =
* Updated: Optimized the code

= 4.2.0 =
* Updated: Use jQuery UI Sortable instead of dragArrange library

= 4.1.2 =
* Updated: Optimized the code

= 4.1.1 =
* Fixed: Minor CSS issues

= 4.1.0 =
* Added: Localization tab

= 4.0.6 =
* Added: Filter hook 'woosc_menu_item_class', 'woosc_menu_item'

= 4.0.5 =
* Added: Option to enable/disable perfect-scrollbar

= 4.0.4 =
* Added: Filter hook 'woosc_menu_item_label'

= 4.0.3 =
* Added: Filter hook 'woosc_get_table_minimum_columns'
* Fixed: Shortcode to work with page builder

= 4.0.2 =
* Added: Filter hook "woosc_get_bar" and "woosc_get_table"
* Fixed: Add to cart button on the compare table

= 4.0.1 =
* Added: Filter hook "woosc_fields" and "woosc_field_value" to add custom field and value

= 4.0.0 =
* BIG UPDATE: Please read the article on the plugin support forum before updating

= 3.7.1 =
* Fixed: Drag/drop & color picker in backend

= 3.7.0 =
* Updated: Compatible with WordPress 5.8 & WooCommerce 5.5.1

= 3.6.0 =
* Fixed: Disable position selector when having the filter

= 3.5.9 =
* Updated: Compatible with WordPress 5.7.2 & WooCommerce 5.4.1

= 3.5.8 =
* Updated: Compatible with WooCommerce 5.4

= 3.5.7 =
* Added: Message "Click outside to hide the compare bar" above the compare bar

= 3.5.6 =
* Added: Filter hook 'wooscp_product_name'
* Updated: Compatible with WordPress 5.7.2 & WooCommerce 5.3

= 3.5.5 =
* Fixed: Compare menu item

= 3.5.4 =
* Fixed: Compare menu item missed link

= 3.5.3 =
* Added: Enable/disable link to individual product
* Updated: Optimized the code

= 3.5.2 =
* Fixed: Button classes

= 3.5.1 =
* Updated: Optimized the code

= 3.5.0 =
* Updated: Optimized the code

= 3.4.0 =
* Updated: Compatible with WordPress 5.7 & WooCommerce 5.0

= 3.3.5 =
* Updated: Optimized the code

= 3.3.4 =
* Added: Option to prevent changing button text

= 3.3.3 =
* Added: Option to show a bubble instead of the fully compare bar

= 3.3.2 =
* Updated: Optimized the code

= 3.3.1 =
* Fixed: The update checker URL

= 3.3.0 =
* Updated: Compatible with WordPress 5.6 & WooCommerce 4.8

= 3.2.7 =
* Updated: Compatible with WooCommerce 4.7

= 3.2.6 =
* Fixed: Some minor CSS & JS issues

= 3.2.5 =
* Added: Persian (Thanks to Amini Ali)
* Updated: Optimized the code

= 3.2.4 =
* Added: Shortcode woosc & woosc_list
* Updated: Compatible with WooCommerce 4.6.1

= 3.2.3 =
* Updated: Optimized the code

= 3.2.2 =
* Fixed: Some minor CSS & JS issues

= 3.2.1 =
* Updated: Optimized the code

= 3.2.0 =
* Updated: Compatible with WordPress 5.5 & WooCommerce 4.3.2

= 3.1.1 =
* Updated: Compatible with WooCommerce 4.3
* Updated: Optimized the code

= 3.1.0 =
* Updated: Compatible with WordPress 5.4.2 & WooCommerce 4.2

= 3.0.4 =
* Fixed: Variation product attributes
* Updated: Optimized the code

= 3.0.3 =
* Fixed: Filter for product name in tooltip
* Updated: Optimized the code

= 3.0.2 =
* Added: Filter hooks for all fields

= 3.0.1 =
* Updated: Compatible with WordPress 5.4 & WooCommerce 4.0.1

= 3.0.0 =
* Updated: Compatible with WooCommerce 4.0

= 2.8.3 =
* Added: Option to change the text after added

= 2.8.2 =
* Updated: Compatible with WordPress 5.3.2 & WooCommerce 3.9.2

= 2.8.1 =
* Updated: Optimized the code

= 2.8.0 =
* Updated: Optimized the code

= 2.7.9 =
* Updated: Compatible with WordPress 5.3 & WooCommerce 3.8

= 2.7.8 =
* Updated: Optimized the code
* Added: Custom label for custom field (Premium Version)

= 2.7.7 =
* Added: Compare variations
* Added: Russian & Spanish translation
* Fixed: Some minor issues

= 2.7.6 =
* Added: Tooltip show product name on compare bar

= 2.7.5 =
* Added: Customize fields on the compare table

= 2.7.4 =
* Updated: Optimized the code

= 2.7.3 =
* Added: Additional information on the compare table
* Updated: Optimized the code

= 2.7.2 =
* Added: Shortcode for compare page [wooscp_list]
* Added: Change action for the menu: open compare page or compare popup

= 2.7.1 =
* Updated: Optimized the code

= 2.7.0 =
* Added: The button to search product and add to compare list immediately (Free Version)
* Added: Support custom fields (Premium Version)
* Updated: Optimized the code

= 2.6.9 =
* Added: Filter for button html 'wooscp_button_html'
* Updated: Optimized the code

= 2.6.8 =
* Fixed: Default fields on the first install
* Added: Italian translation

= 2.6.7 =
* Added: Choose image size option
* Updated: Compatible with WooCommerce 3.6

= 2.6.6 =
* Updated: Display attributes list with checkbox in settings page (Premium Version)
* Updated: Optimized the code

= 2.6.5 =
* Updated: Optimized the code

= 2.6.4 =
* Added: Option to limit the product on compare table
* Added: Option to turn on/off freeze row or column
* Added: Filter for attributes

= 2.6.3 =
* Added: Only show the Compare button for products in selected categories
* Fixed: Button text can be translated

= 2.6.2 =
* Updated: Optimized the code

= 2.6.1 =
* Updated: Compatible with WordPress 5.0.2

= 2.6.0 =
* Fixed: Minor JS issue

= 2.5.9 =
* Updated: Changed plugin name
* Updated: Optimized the code

= 2.5.8 =
* Updated: Compatible with WooCommerce 3.5

= 2.5.7 =
* Updated: Optimize the code to reduce the loading time

= 2.5.6 =
* Fixed: Error when WooCommerce is not active

= 2.5.5 =
* Fixed: Error when have no product on the compare bar

= 2.5.4 =
* Fixed: JS trigger
* Fixed: Some minor CSS issues

= 2.5.3 =
* Updated: Compatible with WooCommerce 3.4.4

= 2.5.2 =
* Updated: The settings page style

= 2.5.1 =
* Added: Option "Hide if empty"
* Added: Option "Click outside to hide"

= 2.5.0 =
* Added: Button remove all products
* Added: Option to choose categories for search function (Premium Version)

= 2.4.0 =
* Updated: Optimized the code
* Added: The button to search product and add to compare list immediately (Premium Version)

= 2.3.2 =
* Fixed: Remove the warning on the line 883

= 2.3.1 =
* Added: The compare menu item, click to open the compare table
* Updated: Compatible with WooCommerce 3.4.2

= 2.3.0 =
* Updated: Compatible with WooCommerce 3.3.5

= 2.2.9 =
* Updated: Compatible with WordPress 4.9.5

= 2.2.8 =
* Added: Close button (optional)
* Added: Content field

= 2.2.7 =
* Added: Placeholder columns when have smaller than 3 products on compare table

= 2.2.6 =
* Updated: Compatible with WooCommerce 3.3.3
* Fixed: Saved fields in settings page

= 2.2.5 =
* Updated: Compatible with WordPress 4.9.4
* Updated: Compatible with WooCommerce 3.3.1

= 2.2.4 =
* Added: Option to remove product when clicking again

= 2.2.3 =
* Added: Button to open compare
* Fixed: Problem with Cookie

= 2.2.2 =
* Fixed: CSS & JS issues

= 2.2.1 =
* Fixed: Error when product is not exists

= 2.2.0 =
* New: WPML compatible

= 2.1.2 =
* Fixed: Just load scripts in WooCommerce Smart Compare settings page

= 2.1.1 =
* Tested up to WordPress 4.9.1 & WooCommerce 3.2.5

= 2.1.0 =
* Added welcome page
* Tested up to WordPress 4.9
* Tested up to WooCommerce 3.2.4

= 2.0.0 =
* Tested up to WordPress 4.8.3
* Tested up to WooCommerce 3.2.2

= 1.2.2 =
* Tested up to WordPress 4.8.2

= 1.2.1 =
* Close compare when click outside

= 1.2.0 =
* Optimized code

= 1.1.0 =
* Tested up to WordPress 4.8

= 1.0.0 =
* Released