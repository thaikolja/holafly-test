<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns the main instance of Admire_Extra to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object Admire_Extra
 */
function Admire_Extra() {
	return Admire_Extra::instance();
} // End Admire_Extra()

Admire_Extra();

#[AllowDynamicProperties]

/**
 * Main Admire_Extra Class
 *
 * @class Admire_Extra
 * @version	1.0.0
 * @since 1.0.0
 * @package	Admire_Extra
 */
final class Admire_Extra {
	/**
	 * Admire_Extra The single instance of Admire_Extra.
	 * @var 	object
	 * @access  private
	 * @since 	1.0.0
	 */
	private static $_instance = null;

	/**
	 * The token.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $token;

	/**
	 * The version number.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $version;

	// Admin - Start
	/**
	 * The admin object.
	 * @var     object
	 * @access  public
	 * @since   1.0.0
	 */
	public $admin;

	/**
	 * Constructor function.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function __construct() {
		$this->token 			= 'admire-extra';
		$this->plugin_url 		= plugin_dir_url( __FILE__ );
		$this->plugin_path 		= plugin_dir_path( __FILE__ );
		$this->version 			= '1.0';

		define( 'ADMR_XTRA_URL', $this->plugin_url );
		define( 'ADMR_XTRA_PATH', $this->plugin_path );
		define( 'ADMR_XTRA_VERSION', $this->version );	


		register_activation_hook( __FILE__, array( $this, 'install' ) );

		// Setup all the things
		add_action( 'init', array( $this, 'setup' ) );

	}

	/**
	 * Main Admire_Extra Instance
	 *
	 * Ensures only one instance of Admire_Extra is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see Admire_Extra()
	 * @return Main Admire_Extra instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) )
			self::$_instance = new self();
		return self::$_instance;
	} // End instance()

	/**
	 * Cloning is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), '1.0.0' );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), '1.0.0' );
	}

	/**
	 * Installation.
	 * Runs on activation.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function install() {
	
	}



	/**
	 * Setup all the things.
	 * @return void
	 */
	public function setup() {
		$theme = wp_get_theme();
		require_once( ADMR_XTRA_PATH .'/demos.php' );
	}



} // End Class