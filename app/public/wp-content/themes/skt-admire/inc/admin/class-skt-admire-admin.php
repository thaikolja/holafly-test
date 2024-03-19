<?php
/**
 * Admire Admin Class.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Admire_Admin' ) ) :

	/**
	 * Admire_Admin Class.
	 */
	class Admire_Admin {

		/**
		 * Constructor.
		 */
		public function __construct() {
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		}

		/**
		 * Localize array for import button AJAX request.
		 */
		public function enqueue_scripts() {
			wp_enqueue_script( 'admire-plugin-install-helper', get_template_directory_uri() . '/inc/admin/js/plugin-handle.js', array( 'jquery' ), '1.0', true );

			$welcome_data = array(
				'uri'      => esc_url( admin_url( '/themes.php?page=admire-panel-install-demos' ) ),
				'btn_text' => esc_html__( 'Processing...', 'skt-admire' ),
				'nonce'    => wp_create_nonce( 'skt_admire_demo_import_nonce' ),
			);

			wp_localize_script( 'admire-plugin-install-helper', 'admireRedirectDemoPage', $welcome_data );
		}
	}

endif;

return new Admire_Admin();
