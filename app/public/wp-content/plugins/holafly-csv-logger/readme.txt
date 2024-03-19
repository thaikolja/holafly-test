=== Holafly CSV Logger ===

Contributors: 			thaikolja
Tags: 					woocommerce, csv, export, orders
Requires at least: 		5.0
Tested up to: 			5.9
Requires PHP: 			7.2
Stable tag: 			1.0.0
License: 				GPL-2.0+
License URI: 			http://www.gnu.org/licenses/gpl-2.0.txt
WC requires at least: 	3.0
WC tested up to: 		6.0

Automatically exports new WooCommerce orders to a CSV file, capturing essential details such as Creation Date, Total Value, and Buyer Email.

== Description ==

The **Holafly CSV Logger** plugin seamlessly integrates with WooCommerce to automatically export each new order's details into a conveniently formatted CSV file. This file includes vital information such as the order's creation date, the total value of the purchase, and the email address of the buyer. This plugin is designed to help store owners keep a detailed record of all transactions without requiring manual data entry.

== Installation ==

1. Upload the `holafly-csv-logger` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. The plugin will automatically start exporting new orders to the `orders.csv` file in your WordPress uploads directory.

== Frequently Asked Questions ==

= Where is the CSV file saved? =
The `orders.csv` file is saved in the WordPress uploads directory. You can access it via FTP or your hosting file manager.

= Does this plugin support custom order statuses? =
Yes, the plugin triggers on the WooCommerce action hooks `woocommerce_checkout_order_created` and `woocommerce_store_api_checkout_order_processed`, covering all new orders including those created through the block editor.

= Can I customize the CSV file format? =
Currently, the CSV format is fixed to include Creation Date, Total Value, and Buyer Email. For custom formats, you would need to modify the plugin code.

== Changelog ==

= 1.0.0 =
* Initial release. Automatically exports new WooCommerce orders to a CSV file, capturing Creation Date, Total Value, and Buyer Email.

== Upgrade Notice ==

= 1.0.0 =
Initial Release.
