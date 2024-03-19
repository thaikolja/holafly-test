<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

class _Welcome_Notice {

	public function __construct() {
		add_action( 'wp_loaded', array( $this, 'welcome_notice' ), 20 );
		add_action( 'wp_loaded', array( $this, 'hide_notices' ), 15 );
		add_action( 'wp_ajax_import_button', array( $this, 'welcome_notice_import_handler' ) );
	}

	public function welcome_notice() {
		if ( ! get_option( 'skt_admire_admin_notice_welcome' ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice_markup' ) ); // Show notice.
		}
	}

	/**
	 * echo `Get started` CTA.
	 *
	 * @return string
	 *
	 */
	public function import_button_html() {
		$html = '<a class="btn-get-started button button-primary button-hero" href="#" data-name="' . esc_attr( 'admire-extra' ) . '" data-slug="' . esc_attr( 'admire-extra' ) . '" aria-label="' . esc_attr__( 'Get started with SKT Admire', 'skt-admire' ) . '">' . esc_html__( 'Get started with SKT Admire', 'skt-admire' ) . '</a>';

		return $html;
	}

	/**
	 * Show welcome notice.
	 */
	public function welcome_notice_markup() {
		$dismiss_url = wp_nonce_url(
			remove_query_arg( array( 'activated' ), add_query_arg( 'admire-hide-notice', 'welcome' ) ),
			'skt_admire_hide_notices_nonce',
			'_skt_admire_notice_nonce'
		);
		?>
		<div id="message" class="notice notice-success admire-notice">
			<a class="admire-message-close notice-dismiss" href="<?php echo esc_url( $dismiss_url ); ?>"></a>

			<div class="admire-message__content">
				<div class="admire-message__image">
					<img class="admire-screenshot" src="<?php echo esc_url( get_template_directory_uri() ); ?>/screenshot.png" alt="<?php esc_attr_e( 'Admire Theme', 'skt-admire' ); ?>" /><?php // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped, Squiz.PHP.EmbeddedPhp.SpacingBeforeClose ?>
				</div>

				<div class="admire-message__text">
					<h2 class="admire-message__heading">
						<?php
						printf(
							esc_html__( 'Welcome! Thank you for choosing SKT Admire!', 'skt-admire' )
						);
						?>
					</h2>
                    <p>
                    	<?php echo 'Welcome to SKT Admire theme. It comes with ready to use templates.'; ?>
                    </p>

					<div class="admire-message__cta">
						<?php echo wp_kses_post($this->import_button_html()); ?>
					</div>
				</div>
			</div>
		</div> <!-- /.admire-message__content -->
		<?php
	}

	/**
	 * Hide a notice if the GET variable is set.
	 */
	public function hide_notices() {
		if ( isset( $_GET['admire-hide-notice'] ) && isset( $_GET['_skt_admire_notice_nonce'] ) ) { // WPCS: input var ok.
			if ( ! wp_verify_nonce( wp_unslash( $_GET['_skt_admire_notice_nonce'] ), 'skt_admire_hide_notices_nonce' ) ) { // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
			
			
				wp_die( __( 'Action failed. Please refresh the page and retry.', 'skt-admire' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( __( 'Cheatin&#8217; huh?', 'skt-admire' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			$hide_notice = sanitize_text_field( wp_unslash( $_GET['admire-hide-notice'] ) );

			// Hide.
			if ( 'welcome' === $_GET['admire-hide-notice'] ) {
				update_option( 'skt_admire_admin_notice_' . $hide_notice, 1 );
			} else { // Show.
				delete_option( 'skt_admire_admin_notice_' . $hide_notice );
			}
		}
	}

	/**
	 * Handle the AJAX process while import or get started button clicked.
	 */
	public function welcome_notice_import_handler() {
		check_ajax_referer( 'skt_admire_demo_import_nonce', 'security' );

		$state = '';

		if ( 'activated' === $state ) {
			$response['redirect'] = admin_url( '/themes.php?page=admire-panel-install-demos&admire-hide-notice=welcome' );
		} elseif ( 'installed' === $state ) {
			$response['redirect'] = admin_url( '/themes.php?page=admire-panel-install-demos&admire-hide-notice=welcome' );
			if ( current_user_can( 'activate_plugin' ) ) {
				$result = activate_plugin( 'admire-extra/admire-extra.php' );

				if ( is_wp_error( $result ) ) {
					$response['errorCode']    = $result->get_error_code();
					$response['errorMessage'] = $result->get_error_message();
				}
			}
		} else {
			wp_enqueue_style( 'plugin-install' );
			wp_enqueue_script( 'plugin-install' );

			$response['redirect'] = admin_url( '/themes.php?page=admire-panel-install-demos&admire-hide-notice=welcome' );

			/**
			 * Install Plugin.
			 */
			include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
			include_once ABSPATH . 'wp-admin/includes/plugin-install.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

			$api = plugins_api(
				'plugin_information',
				array(
					'slug'   => sanitize_key( wp_unslash( 'admire-extra' ) ),
					'fields' => array(
						'sections' => false,
					),
				)
			);

			$skin     = new WP_Ajax_Upgrader_Skin();
			$upgrader = new Plugin_Upgrader( $skin );
			$result   = $upgrader->install( $api->download_link );

			if ( $result ) {
				$response['installed'] = 'succeed';
			} else {
				$response['installed'] = 'failed';
			}

			// Activate plugin.
			if ( current_user_can( 'activate_plugin' ) ) {
				$result = activate_plugin( 'admire-extra/admire-extra.php' );

				if ( is_wp_error( $result ) ) {
					$response['errorCode']    = $result->get_error_code();
					$response['errorMessage'] = $result->get_error_message();
				}
			}
		}

		wp_send_json( $response );

		exit();
	}
}

new _Welcome_Notice();
