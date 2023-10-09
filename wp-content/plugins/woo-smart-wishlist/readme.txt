=== WPC Smart Wishlist for WooCommerce ===
Contributors: wpclever
Donate link: https://wpclever.net
Tags: woocommerce, woo, wpc, smart, wishlist, wish list
Requires at least: 4.0
Tested up to: 6.3
Stable tag: 4.7.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

WPC Smart Wishlist is a simple but powerful tool that can help your customer save products for buying later.

== Description ==

**WPC Smart Wishlist** is a powerful yet intuitive plugin for helping your customers manage their to-buy list and save favorite items for later purchase. This helps the purchase flow on your site become more fluent and convenient while saving quite a great amount of time on searching for products and adding them to cart for buyers.

= Live demo =

Visit our [live demo 01](https://demo.wpclever.net/woosw/ "live demo 01") or [live demo 02](https://demo.wpclever.net/wpcplant/ "live demo 02") to see how this plugin works.

= Features =

- Control the use of wishlist for unauthenticated users
- Smart display of product details: title, price, date of adding, stock status, product image preview, wishlist item count
- Easy purchase flow from adding, removing, checking out or closing the wishlist
- Enable/disable Auto-removal of products after adding to the cart
- Choose a page as the wishlist page
- Use the provided shortcode to display the wishlist on selected page
- Enable/disable wishlist sharing button
- Enable/disable copying of wishlist links for sharing
- Choose a wishlist type: button or link
- Edit the text for the wishlist button
- Choose an action triggered by wishlist button: display a message or open the product list
- Edit the text and action triggered after adding an item to the wishlist
- Add extra classes for action button/link
- Customize the position of wishlist button on archive and single page
- Choose categories that allow wishlist button
- Unlimited colors for wishlist popup
- Edit the destination link for the Continue Shopping button
- Choose a menu to add the wishlist menu
- Choose an action triggered by the wishlist menu
- RTL support for better displaying right-to-left languages
- Premium: Enable multiple wishlists per user
- Premium: Add note for each product
- Premium: Lifetime update and dedicated support
- Premium: Customization to match with your theme/site design

Newly added feature for management: It's now possible to see all wishlists that a product was included in and check out all wishlists created by a user.

= The Importance of Adding a Wishlist button =
Many store owners miss the opportunities for selling items for their current customers because they’re not offering Add to Wishlist button on their shop or single product page. On many occasions, buyers need time to rethink their needs and allowing them to add products to wishlist increase the possibility for buyers to purchase these items in the future. As it is truly convenient and speedy to add, remove, proceed to check out or continue shopping, buyers will find the whole purchase flow an enjoyable process. Thus, this improves the shopping experience for your customers. In addition, enabling Add to Wishlist button is helpful for buyers to save an Out-of-Stock product for purchasing when it is restocked at a later time. Shop owners can control the wishlist availability by enabling it for authenticated users only, hence, encourage more membership engagement from visitors. Never miss any chance to strengthen the bond with your customers with an Add to Wishlist button on every product page and shop page of your site.

= Product Details at a Glance =
The wishlist items are displayed in great detail so that buyers don’t need to browse the single product page for more information when the title, price, stock status, thumbnail image and date of adding to the wishlist are smartly arranged in the wishlist page or wishlist popup. Buyers can also see a counter showing how many items have been added to their wishlist: a notification for urging them to checkout or to manage the list by removing unwanted items. By keeping your customers on your site, store owners can increase the conversion rate when buyers revise the list and find something useful that they might have missed or forgotten to purchase before. Controlling the wishlist is intuitive because there is a button to remove any item from the list. Users take full control of actions triggered by the wishlist button when an item is already added to the list.

= Ultra-speedy Performance =
There’s nearly zero delay speed for this Smart Wishlist plugin when visitors perform any kind of actions: item addition or removal, closing the wishlist popup or open the wishlist page, it all happens immediately with precision. Wishlist popup also allows an overlay effect that keeps the popup opens while visitors can still scroll the background page until the Continue Shopping button or Close button is pressed. Our plugin is compatible with all WPClever plugins, most common WooCommerce add-ons and WordPress themes, so the flexibility is really high with smooth performance for your website. Smart Wishlist can work in similar ways with any product bundles, composite deals, bought together offers, grouped or force-sell products made with our plugins.

= Fully Customizable Wishlist =
It is possible for users to fully customize the WPC Smart Wishlist plugin to their preferences regarding the appearance, actions and links, type of wishlist, position of wishlist on different pages and even the text displayed for visitors. Premium users are able to add a Wishlist button to any menu that they want: handheld, primary, or secondary menu and customize the action triggered on these menus as well. They can even request the customization of wishlist to match the design scheme of their website for free.

= Great Flow for Advertising Your Products =
If you think that the purchase flow ends with the checkout of your customers, then you are just closing your own door to further advertise your products to other potential clients. WPC Smart Wishlist allows users to take advantage of networking by enabling wishlist sharing via social networks or copying product links to share to other customers. Great products will see a higher conversion rate and better traffic when they are easily shared via social networks. This keeps the flow on and on for new clients and draw more attention to the most widely favored products in your store. With the increase in UX flow on your site, the sales will definitely go up accordingly. This is all up to your intentional arrangement of wishlist buttons.

= Translators =

Available languages: English (Default), Russian, Italian, Persian

If you have created your own language pack, or have an update for an existing one, you can send [gettext PO and MO file](http://codex.wordpress.org/Translating_WordPress "Translating WordPress") to [us](https://wpclever.net/contact?utm_source=pot&utm_medium=woosw&utm_campaign=wporg "WPClever.net") so we can bundle it into WPC Smart Wishlist.

= Need more features? =

Please try other plugins from us:

- [WPC Smart Compare](https://wordpress.org/plugins/woo-smart-compare/ "WPC Smart Compare")
- [WPC Smart Quick View](https://wordpress.org/plugins/woo-smart-quick-view/ "WPC Smart Quick View")
- [WPC Fly Cart](https://wordpress.org/plugins/woo-fly-cart/ "WPC Fly Cart")
- [WPC Smart Messages](https://wordpress.org/plugins/wpc-smart-messages/ "WPC Smart Messages")
- [WPC Added To Cart Notification](https://wordpress.org/plugins/woo-added-to-cart-notification/ "WPC Added To Cart Notification")

== Installation ==

1. Please make sure that you installed WooCommerce
2. Go to plugins in your dashboard and select "Add New"
3. Search for "WPC Smart Wishlist", Install & Activate it
4. Go to settings page to choose position and effect as you want

== Frequently Asked Questions ==

= How to integrate with my theme? =

To integrate with a theme, please use bellow filter to hide the default buttons.

`add_filter( 'woosw_button_position_archive', '__return_false' );
add_filter( 'woosw_button_position_single', '__return_false' );`

After that, use the shortcode to display the button where you want.

`echo do_shortcode('[woosw id="{product_id}"]');`

Example:

`echo do_shortcode('[woosw id="99"]');`

== Changelog ==

= 4.7.5 =
* Added: Suggested products from WPC Smart Compare

= 4.7.4 =
* Updated: Compatible with WP 6.3 & Woo 8.0

= 4.7.3 =
* Updated: Optimized the code

= 4.7.2 =
* Fixed: CSRF vulnerability

= 4.7.1 =
* Fixed: Minor JS/CSS issues in the backend

= 4.7.0 =
* Added: Suggested products from related/upsells/cross-sells

= 4.6.9 =
* Fixed: Minor JS issue in the backend

= 4.6.8 =
* Added: Paging for previewing wishlists in the backend

= 4.6.7 =
* Added: "Above title" position

= 4.6.6 =
* Updated: Optimized the code

= 4.6.5 =
* Updated: Move wishlist menu on My Account page to before Logout

= 4.6.4 =
* Update: Use shortcode [woosw_list key="xyz"] to show wishlist products on any page

= 4.6.3 =
* Updated: Settings for notes

= 4.6.2 =
* Fixed: Remove draft/deleted products from wishlist

= 4.6.1 =
* Fixed: Minor CSS issue

= 4.6.0 =
* Added: Show price change message for each product (increase or decrease)

= 4.5.3 =
* Fixed: Menu icon on some browsers

= 4.5.2 =
* Added: Compatible with WPC Smart Messages for WooCommerce

= 4.5.1 =
* Fixed: 404 error on the wishlist page

= 4.5.0 =
* Fixed: Wishlist overview in website backend

= 4.4.5 =
* Fixed: Minor JS issue in the backend

= 4.4.4 =
* Added: Function 'get_settings' & 'get_setting'

= 4.4.3 =
* Updated: Optimized the code

= 4.4.2 =
* Updated: Optimized the code

= 4.4.1 =
* Added: Wishlist page on My Account

= 4.4.0 =
* Added: Icon for the button

= 4.3.2 =
* Fixed: Compatible with WPML

= 4.3.1 =
* Fixed: Minor JS for variable product

= 4.3.0 =
* Added: Filter hook 'woosw_fragments'

= 4.2.3 =
* Fixed: Notice on settings page

= 4.2.2 =
* Fixed: Can't change button position

= 4.2.1 =
* Fixed: Stock status of item product
* Added: Filter hook 'woosw_item_stock' & 'woosw_item_add_to_cart'

= 4.2.0 =
* Fixed: Minor JS/CSS issues

= 4.1.0 =
* Added: Position left/right for the popup

= 4.0.0 =
* Added: New message interface
* Updated: Optimized the code

= 3.0.6 =
* Updated: Backward compatibility with WPC themes

= 3.0.5 =
* Updated: Optimized the code

= 3.0.4 =
* Fixed: Minor security issue

= 3.0.3 =
* Fixed: Security issues

= 3.0.2 =
* Fixed: Minor JS/CSS issues

= 3.0.1 =
* Updated: Optimized the code

= 3.0.0 =
* Added: Multiple wishlist (Premium Version)
* Updated: Optimized the code

= 2.9.9 =
* Fixed: Minor security issues

= 2.9.8 =
* Added: Add to wishlist endpoint /add-to-wishlist={product_id}

= 2.9.7 =
* Updated: Filter hook 'woosw_button_html'

= 2.9.6 =
* Updated: Optimized the code

= 2.9.5 =
* Added: Filter hook 'woosw_button_positions_archive', 'woosw_button_positions_single'

= 2.9.4 =
* Fixed: Security issue

= 2.9.3 =
* Fixed: Change the button for variable product

= 2.9.2 =
* Updated: Optimized the code

= 2.9.1 =
* Updated: Settings page

= 2.9.0 =
* Updated: Optimized the code

= 2.8.9 =
* Fixed: Minor JS/CSS issue

= 2.8.8 =
* Added: Action hooks 'woosw_before_items', 'woosw_after_items'

= 2.8.7 =
* Added: Option to enable/disable perfect-scrollbar
* Added: Remove all products button
* Updated: Optimized the code

= 2.8.6 =
* Added: Filter hook 'woosw_menu_item_class', 'woosw_menu_item'

= 2.8.5 =
* Added: Filter hook 'woosw_item_name', 'woosw_item_price', 'woosw_item_time'

= 2.8.4 =
* Updated: Optimized the code

= 2.8.3 =
* Added: Localization tab
* Fixed: Minor JS issue

= 2.8.2 =
* Added: Filter hook 'woosw_menu_item_label'

= 2.8.1 =
Fixed: Add to cart button on wishlist

= 2.8.0 =
* Updated: Compatible with WordPress 5.8 & WooCommerce 5.5.1

= 2.7.5 =
* Fixed: Style error for calendar picker when plugin active

= 2.7.4 =
* Fixed: Error with already logged in user at the first time install and activate plugin

= 2.7.3 =
* Fixed: Disable position selector when having the filter

= 2.7.2 =
* Updated: Compatible with WordPress 5.7.2 & WooCommerce 5.4.1

= 2.7.1 =
* Updated: Compatible WooCommerce 5.4

= 2.7.0 =
* Fixed: Compatible with SG Optimizer
* Fixed: Return the previous guest wishlist after logout

= 2.6.4 =
* Fixed: Filter 'woosw_button_position_archive' & 'woosw_button_position_single' doesn't work

= 2.6.3 =
* Updated: Optimized the code

= 2.6.2 =
* Fixed: Wishlist menu item

= 2.6.1 =
* Updated: Unlock wishlist menu item for free version
* Fixed: Some minor CSS issues

= 2.6.0 =
* Added: Action and filter hooks: woosw_wishlist_items_before, woosw_wishlist_item_before, woosw_wishlist_item_image, woosw_wishlist_item_info, woosw_wishlist_item_actions, woosw_wishlist_item_after, woosw_wishlist_items_after

= 2.5.3 =
* Fixed: Warning on the users page

= 2.5.2 =
* Added: Enable/disable link to individual product
* Updated: Optimized the code

= 2.5.1 =
* Updated: Optimized the code

= 2.5.0 =
* Updated: Optimized the code

= 2.4.0 =
* Added: View all wishlists contain a product on Products page
* Added: View wishlist of an user on Users page

= 2.3.4 =
* Updated: Compatible with WordPress 5.7.0 & WooCommerce 5.0.0

= 2.3.3 =
* Added: RTL support for better displaying right-to-left languages

= 2.3.2 =
* Updated: Optimized the code

= 2.3.1 =
* Fixed: The update checker URL

= 2.3.0 =
* Updated: Compatible with WordPress 5.6.0 & WooCommerce 4.8.0

= 2.2.6 =
* Updated: Compatible with WooCommerce 4.7.0

= 2.2.5 =
* Fixed: Some minor CSS & JS issues

= 2.2.4 =
* Added: Persian (Thanks to Amini Ali)
* Updated: Compatible with WooCommerce 4.6.1

= 2.2.3 =
* Fixed: data-pid or data-product_id for element on Elementor

= 2.2.2 =
* Fixed: Some minor CSS & JS issues

= 2.2.1 =
* Updated: Optimized the code

= 2.2.0 =
* Updated: Compatible with WordPress 5.5 & WooCommerce 4.3.3

= 2.1.2 =
* Added: New action "Add to wishlist solely" for the button

= 2.1.1 =
* Updated: Compatible with WooCommerce 4.3.0
* Updated: Optimized the code

= 2.1.0 =
* Updated: Compatible with WordPress 5.4.2 & WooCommerce 4.2.0

= 2.0.3 =
* Updated: Optimized the code

= 2.0.2 =
* Updated: Compatible with WordPress 5.4 & WooCommerce 4.0.1

= 2.0.1 =
* Updated: Optimized the code

= 2.0.0 =
* Updated: Compatible with WooCommerce 4.0.0

= 1.5.7 =
* Updated: Optimized the code

= 1.5.6 =
* Updated: Compatible with WordPress 5.3.2 & WooCommerce 3.9.2

= 1.5.5 =
* Updated: Optimized the code

= 1.5.4 =
* Updated: Optimized the code

= 1.5.3 =
* Added: Product column to show how many times it was added to the wishlist
* Updated: Optimized the code

= 1.5.2 =
* Updated: Compatible with WordPress 5.3 & WooCommerce 3.8.x

= 1.5.1 =
* Updated: Optimized the code

= 1.5.0 =
* Fixed: Some minor issues

= 1.4.9 =
* Fixed: Copy wishlist link on iOS devices

= 1.4.8 =
* Added: Translation from Tusko Trush
* Fixed: Duplicate wishlist page

= 1.4.7 =
* Updated: Optimized the code

= 1.4.6 =
* Fixed: Button type don't change

= 1.4.5 =
* Added: Filter for button html 'woosw_button_html'
* Updated: Optimized the code

= 1.4.4 =
* Updated: Compatible with WooCommerce 3.6.x

= 1.4.3 =
* Added: Action when clicking on the added button: open wishlist popup or wishlist page
* Added: Auto close for the message popup
* Updated: Optimized the code

= 1.4.2 =
* Fixed: PHP warning

= 1.4.1 =
* Added: Only show the Wishlist button for products in selected categories
* Fixed: Button text can be translated

= 1.4.0 =
* Added: Copy URL to clipboard on the Wishlist page

= 1.3.9 =
* Added: Custom URL for Continue shopping button
* Updated: Compatible with WooCommerce 3.5.4 & WordPress 5.0.3

= 1.3.8 =
* Updated: Compatible with WooCommerce 3.5.3 & WordPress 5.0.2

= 1.3.7 =
* Updated: Change JS event touchstart to touch
* Updated: Optimized the code

= 1.3.6 =
* Fixed: Error when removing the last item
* Added: Filter for Wishlist URL & count

= 1.3.5 =
* Updated: Change default popup type to products list
* Updated: Compatible with WooCommerce 3.5.1

= 1.3.4 =
* Added: Just show message when adding to Wishlist
* Updated: Optimized the code

= 1.3.3 =
* Updated: Compatible with WooCommerce 3.5.0

= 1.3.2 =
* Updated: Optimize the code to reduce the loading time

= 1.3.1 =
* Fixed: Error when loading backend.css

= 1.3.0 =
* Added: Option to remove product after adding to cart
* Fixed: Error when remove the last item on the Wishlist

= 1.2.5 =
* Fixed: Error when WooCommerce is not active

= 1.2.4 =
* Fixed: JS trigger
* Updated: Compatible with WooCommerce 3.4.5

= 1.2.3 =
* Updated: Settings page style

= 1.2.2 =
* Added option to change the color
* Compatible with WooCommerce 3.4.2

= 1.2.1 =
* Add JS trigger when show/hide or changing the count

= 1.2.0 =
* Optimized the code

= 1.1.6 =
* Fix some minor CSS issues

= 1.1.5 =
* Fix the PHP notice

= 1.1.4 =
* Compatible with WooCommerce 3.3.5

= 1.1.3 =
* Compatible with WordPress 4.9.5

= 1.1.2 =
* Added: Button text for "added" state
* Added: WPML compatible
* Fixed: Fix the height of popup to prevent blur

= 1.1.1 =
* Compatible with WordPress 4.9.4
* Compatible with WooCommerce 3.3.1

= 1.1.0 =
* Added: Auto create the Wishlist page with shortcode

= 1.0.4 =
* Fix share URLs

= 1.0.3 =
* Add share buttons on wishlist page

= 1.0.2 =
* Update wishlist page

= 1.0.1 =
* Update CSS

= 1.0 =
* Released