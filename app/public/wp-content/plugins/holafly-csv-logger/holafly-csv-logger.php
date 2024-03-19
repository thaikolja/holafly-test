<?php
/**
 * Plugin Name:            Holafly CSV Logger
 * Plugin URI:             https://www.youtube.com/watch?v=dQw4w9WgXcQ
 * Description:            Automatically exports new WooCommerce orders to a CSV file, capturing Creation Date, Total Value, and Buyer Email.
 * Version:                1.0.0
 * Author:                 Kolja Nolte for Holafly
 * Author URI:             https://www.kolja-nolte.com/
 * License:                GPL-2.0+
 * License URI:            http://www.gnu.org/licenses/gpl-2.0.txt
 * WC requires at least:   3.0
 * WC tested up to:        6.0
 *
 * @package                Holafly_Csv_Logger
 */

/**
 * Include WordPress plugin administration functions to use is_plugin_active().
 * This is necessary because is_plugin_active() is not loaded by default outside the admin area.
 */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/**
 * Check if WooCommerce is active before proceeding.
 * This ensures that the plugin does not run if WooCommerce is not active, preventing errors.
 */
if ( ! is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
	return; // Exit if WooCommerce is not active.
}

/**
 * Add an action hook to trigger the export_order_to_csv function when a WooCommerce order is created.
 * The 'woocommerce_checkout_order_created' hook is used here as it fires after the order is created.
 *
 * We also need `woocommerce_store_api_checkout_order_processed` for block editor orders. THIS IS IMPORTANT!
 */
add_action( 'woocommerce_checkout_order_created', 'export_order_to_csv' );
add_action( 'woocommerce_store_api_checkout_order_processed', 'export_order_to_csv' );

/**
 * Exports order data to a CSV file upon order creation.
 *
 * @param WC_Order $order The WooCommerce order object.
 *
 * @returns bool Whether the order data was successfully written to the CSV file.
 */
function export_order_to_csv( WC_Order $order ): bool {
	// Retrieve the order data array from the order object.
	$order_data = $order->get_data();

	// Define the path to the CSV file in the WordPress uploads directory.
	$upload_dir = wp_upload_dir();
	$file_path  = $upload_dir['basedir'] . '/orders.csv';

	// Check if the CSV file already exists to avoid writing headers multiple times.
	$file_exists = file_exists( $file_path );

	// Attempt to open the file in append mode ('a'), so new data is added to the end of the file.
	$file = fopen( $file_path, 'a' );

	// If the file could not be opened, log an error message and exit the function.
	if ( ! $file ) {
		error_log( 'Unable to open orders.csv for writing.' );

		return false;
	}

	// If the file does not exist, write the column headers to the CSV file.
	if ( ! $file_exists ) {
		fputcsv( $file, [ 'Creation Date', 'Total Value', 'Buyer Email' ] );
	}

	// Prepare the order data for writing to the CSV file.
	$data = [
		$order_data['date_created']->date( 'Y-m-d H:i:s' ), // Order creation date.
		$order_data['total'], // Total value of the order.
		$order_data['billing']['email'], // Email address of the buyer.
	];

	// Write the order data to the CSV file.
	fputcsv( $file, $data );

	// Close the CSV file after writing.
	return fclose( $file );
}
