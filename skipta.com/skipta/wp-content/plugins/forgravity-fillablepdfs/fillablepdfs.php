<?php
/**
 * Plugin Name: Fillable PDFs for Gravity Forms
 * Plugin URI: http://forgravity.com/plugins/fillable-pdfs/
 * Description: Generate PDFs from form submissions and create forms from PDFs
 * Version: 2.3.3
 * Author: ForGravity
 * Author URI: http://forgravity.com
 * Text Domain: gravityformsfillablepdfs
 * Domain Path: /languages
 */

if ( ! defined( 'FG_EDD_STORE_URL' ) ) {
	define( 'FG_EDD_STORE_URL', 'https://forgravity.com' );
}

if ( ! defined( 'FG_FILLABLEPDFS_API_URL' ) ) {
	define( 'FG_FILLABLEPDFS_API_URL', 'https://forgravity.com/wp-json/pdf/v2/' );
}

if ( ! defined( 'FG_FILLABLEPDFS_PATH_CHECK_ACTION' ) ) {
	define( 'FG_FILLABLEPDFS_PATH_CHECK_ACTION', 'forgravity_fillablepdfs_check_base_pdf_path_public' );
}

define( 'FG_FILLABLEPDFS_VERSION', '2.3.3' );
define( 'FG_FILLABLEPDFS_EDD_ITEM_ID', 169 );

// Initialize plugin updater.
add_action( 'init', array( 'FillablePDFs_Bootstrap', 'updater' ), 0 );

// If Gravity Forms is loaded, bootstrap the Live Population Add-On.
add_action( 'gform_loaded', array( 'FillablePDFs_Bootstrap', 'load' ), 5 );

// Include Gravity Flow step.
add_action( 'gravityflow_loaded', array( 'FillablePDFs_Bootstrap', 'load_gravityflow' ), 5 );

// Handle template downloads.
add_action( 'gform_loaded', [ 'ForGravity\FillablePDFs\Templates', 'maybe_download_template' ], 6 );

register_deactivation_hook( __FILE__, [ fg_fillablepdfs(), 'clear_scheduled_events' ] );

/**
 * Class FillablePDFs_Bootstrap
 *
 * Handles the loading of the Fillable PDFs Add-On and registers with the Add-On framework.
 */
class FillablePDFs_Bootstrap {

	/**
	 * If the Feed Add-On Framework exists, Fillable PDFs Add-On is loaded.
	 *
	 * @access public
	 * @static
	 */
	public static function load() {

		if ( ! method_exists( 'GFForms', 'include_feed_addon_framework' ) ) {
			return;
		}

		if ( ! class_exists( '\ForGravity\FillablePDFs\EDD_SL_Plugin_Updater' ) ) {
			require_once( 'includes/EDD_SL_Plugin_Updater.php' );
		}

		// Register GravityView field.
		if ( class_exists( 'GravityView_Field' ) ) {
			include( dirname( __FILE__ ) . '/includes/integrations/class-gravityview-field.php' );
		}

		require_once( 'class-fillablepdfs.php' );
		require_once( 'includes/class-templates.php' );

		GFAddOn::register( '\ForGravity\Fillable_PDFs' );

	}

	/**
	 * If the Gravity Flow exists, Fillable PDFs Step is loaded.
	 *
	 * @access public
	 * @static
	 */
	public static function load_gravityflow() {

		require_once( 'includes/class-gravityflow-step.php' );

	}

	/**
	 * Initialize plugin updater.
	 *
	 * @access public
	 * @static
	 */
	public static function updater() {

		// Get Fillable PDFs instance.
		$fillable_pdfs = fg_fillablepdfs();

		// If Fillable PDFs could not be retrieved, exit.
		if ( ! $fillable_pdfs ) {
			return;
		}

		// Get plugin settings.
		$settings = $fillable_pdfs->get_plugin_settings();

		// Get license key.
		$license_key = trim( rgar( $settings, 'license_key' ) );

		new ForGravity\FillablePDFs\EDD_SL_Plugin_Updater(
			FG_EDD_STORE_URL,
			__FILE__,
			array(
				'version' => FG_FILLABLEPDFS_VERSION,
				'license' => $license_key,
				'item_id' => FG_FILLABLEPDFS_EDD_ITEM_ID,
				'author'  => 'ForGravity',
			)
		);

	}

}

/**
 * Returns an instance of the Fillable_PDFs class
 *
 * @see    Fillable_PDFs::get_instance()
 *
 * @return ForGravity\Fillable_PDFs
 */
function fg_fillablepdfs() {
	if ( class_exists( '\ForGravity\Fillable_PDFs' ) ) {
		return ForGravity\Fillable_PDFs::get_instance();
	}
}

/**
 * Returns an instance of the Import class
 *
 * @see    Import::get_instance()
 *
 * @return ForGravity\FillablePDFs\Import
 */
function fg_fillablepdfs_import() {
	if ( class_exists( '\ForGravity\FillablePDFs\Import' ) ) {
		return ForGravity\FillablePDFs\Import::get_instance();
	}
}

/**
 * Returns an instance of the Server class
 *
 * @see    Server::get_instance()
 *
 * @return ForGravity\FillablePDFs\Server
 */
function fg_fillablepdfs_server() {
	if ( class_exists( '\ForGravity\FillablePDFs\Server' ) ) {
		return ForGravity\FillablePDFs\Server::get_instance();
	}
}

/**
 * Returns an instance of the Templates class
 *
 * @see    Templates::get_instance()
 *
 * @return ForGravity\FillablePDFs\Templates
 */
function fg_fillablepdfs_templates() {
	if ( class_exists( '\ForGravity\FillablePDFs\Templates' ) ) {
		return ForGravity\FillablePDFs\Templates::get_instance();
	}
}
