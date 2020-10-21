<?php

namespace ForGravity;

use ForGravity\FillablePDFs\API;

use Exception;

use GFAPI;
use GFChart_API;
use GFCommon;
use GFEntryDetail;
use GFExport;
use GFFeedAddOn;
use GFForms;
use GFFormsModel;
use WP_Error;

GFForms::include_feed_addon_framework();

/**
 * Fillable PDFs for Gravity Forms.
 *
 * @since     1.0
 * @package   FillablePDFs
 * @author    ForGravity
 * @copyright Copyright (c) 2017, ForGravity
 */
class Fillable_PDFs extends GFFeedAddOn {

	/**
	 * Contains an instance of this class, if available.
	 *
	 * @since  1.0
	 * @access private
	 * @var    object $_instance If available, contains an instance of this class.
	 */
	private static $_instance = null;

	/**
	 * Defines the version of the Fillable PDFs for Gravity Forms.
	 *
	 * @since  1.0
	 * @access protected
	 * @var    string $_version Contains the version, defined from fillablepdfs.php
	 */
	protected $_version = FG_FILLABLEPDFS_VERSION;

	/**
	 * Defines the minimum Gravity Forms version required.
	 *
	 * @since  1.0
	 * @access protected
	 * @var    string $_min_gravityforms_version The minimum version required.
	 */
	protected $_min_gravityforms_version = '2.0.7.7';

	/**
	 * Defines the plugin slug.
	 *
	 * @since  1.0
	 * @access protected
	 * @var    string $_slug The slug used for this plugin.
	 */
	protected $_slug = 'forgravity-fillablepdfs';

	/**
	 * Defines the main plugin file.
	 *
	 * @since  1.0
	 * @access protected
	 * @var    string $_path The path to the main plugin file, relative to the plugins folder.
	 */
	protected $_path = 'forgravity-fillablepdfs/fillablepdfs.php';

	/**
	 * Defines the full path to this class file.
	 *
	 * @since  1.0
	 * @access protected
	 * @var    string $_full_path The full path.
	 */
	protected $_full_path = __FILE__;

	/**
	 * Defines the URL where this Add-On can be found.
	 *
	 * @since  1.0
	 * @access protected
	 * @var    string The URL of the Add-On.
	 */
	protected $_url = 'https://forgravity.com';

	/**
	 * Defines the title of this Add-On.
	 *
	 * @since  1.0
	 * @access protected
	 * @var    string $_title The title of the Add-On.
	 */
	protected $_title = 'Fillable PDFs for Gravity Forms';

	/**
	 * Defines the short title of the Add-On.
	 *
	 * @since  1.0
	 * @access protected
	 * @var    string $_short_title The short title.
	 */
	protected $_short_title = 'Fillable PDFs';

	/**
	 * Defines the capability needed to access the Add-On settings page.
	 *
	 * @since  1.0
	 * @access protected
	 * @var    string $_capabilities_settings_page The capability needed to access the Add-On settings page.
	 */
	protected $_capabilities_settings_page = 'forgravity_fillablepdfs';

	/**
	 * Defines the capability needed to access the Add-On settings page.
	 *
	 * @since  2.2.3
	 * @access protected
	 * @var    string $_capabilities_settings_page The capability needed to access the Add-On settings page.
	 */
	protected $_capabilities_plugin_page = 'forgravity_fillablepdfs';

	/**
	 * Defines the capability needed to access the Add-On form settings page.
	 *
	 * @since  1.0
	 * @access protected
	 * @var    string $_capabilities_form_settings The capability needed to access the Add-On form settings page.
	 */
	protected $_capabilities_form_settings = 'forgravity_fillablepdfs';

	/**
	 * Defines the capability needed to uninstall the Add-On.
	 *
	 * @since  1.0
	 * @access protected
	 * @var    string $_capabilities_uninstall The capability needed to uninstall the Add-On.
	 */
	protected $_capabilities_uninstall = 'forgravity_fillablepdfs_uninstall';

	/**
	 * Defines the capabilities needed for Fillable PDFs for Gravity Forms.
	 *
	 * @since  1.0
	 * @access protected
	 * @var    array $_capabilities The capabilities needed for the Add-On
	 */
	protected $_capabilities = [ 'forgravity_fillablepdfs', 'forgravity_fillablepdfs_uninstall' ];

	/**
	 * Contains an instance of the Fillable PDFs API library, if available.
	 *
	 * @since  1.0
	 * @access protected
	 * @var    API $api If available, contains an instance of the Fillable PDFs API library.
	 */
	public $api = null;

	/**
	 * Get instance of this class.
	 *
	 * @since  1.0
	 * @static
	 *
	 * @return Fillable_PDFs
	 */
	public static function get_instance() {

		if ( null === self::$_instance ) {
			self::$_instance = new self;
		}

		return self::$_instance;

	}

	/**
	 * Register needed hooks.
	 *
	 * @since 2.3
	 */
	public function pre_init() {

		parent::pre_init();

		// Import and Export Feeds
		add_filter( 'gform_export_form', [ $this, 'filter_gform_export_form' ] );
		add_action( 'gform_forms_post_import', [ $this, 'action_gform_forms_post_import' ] );

		// Add cron action.
		add_action( FG_FILLABLEPDFS_PATH_CHECK_ACTION, [ $this, 'check_base_pdf_path_public' ] );
		add_filter( 'cron_schedules', [ $this, 'filter_cron_schedules' ] );

		// Schedule action.
		if ( ! wp_next_scheduled( FG_FILLABLEPDFS_PATH_CHECK_ACTION ) ) {
			wp_schedule_event( current_time( 'timestamp' ), 'fg_fillablepdfs_weekly', FG_FILLABLEPDFS_PATH_CHECK_ACTION );
		}

	}

	/**
	 * Register needed hooks.
	 *
	 * @since  1.0
	 */
	public function init() {

		parent::init();

		// Include Server class.
		if ( ! class_exists( '\ForGravity\FillablePDFs\Server' ) ) {
			require_once( 'includes/class-server.php' );
		}

		// Load Editor Blocks if WordPress is 5.0+.
		if ( function_exists( 'register_block_type' ) && class_exists( '\GF_Blocks' ) ) {
			require_once 'includes/blocks/class-list.php';
		}

		// Add delayed payment support.
		$this->add_delayed_payment_support(
			[
				'option_label' => esc_html__( 'Generate PDF only when payment is received', 'forgravity_fillablepdfs' ),
			]
		);

		// Initialize Server class.
		fg_fillablepdfs_server()->get_instance();

		add_filter( 'gform_notification', [ $this, 'attach_generated_pdfs' ], 10, 3 );
		add_filter( 'gform_entry_detail_meta_boxes', [ $this, 'register_meta_box' ], 10, 3 );

		add_filter( 'gform_admin_pre_render', [ $this, 'add_merge_tags' ] );
		add_action( 'gform_pre_replace_merge_tags', [ $this, 'replace_merge_tags' ], 6, 3 );

		add_action( 'gform_delete_lead', [ $this, 'delete_entry_pdfs' ] );
		add_action( 'gform_delete_entries', [ $this, 'delete_entries_pdfs' ], 10, 2 );

		add_filter( 'gform_entry_list_bulk_actions', [ $this, 'add_bulk_action' ], 10, 2 );
		add_action( 'gform_entry_list_action_fillablepdfs', [ $this, 'process_bulk_action' ], 10, 3 );

		add_action( 'admin_init', [ $this, 'maybe_regenerate_pdfs' ] );

		add_filter( 'gform_personal_data', [ $this, 'filter_gform_personal_data' ], 10, 2 );

		add_filter( 'auto_update_plugin', [ $this, 'maybe_auto_update' ], 10, 2 );

		// Use proper Date format.
		add_filter( 'gform_' . $this->_slug . '_field_value', [ $this, 'filter_gform_addon_field_value' ], 10, 4 );

		// Remove deleted fields from mapping.
		add_action( 'gform_after_delete_field', [ $this, 'action_gform_after_delete_field' ], 10, 2 );

	}

	/**
	 * Register needed admin hooks.
	 *
	 * @since  1.0
	 */
	public function init_admin() {

		parent::init_admin();

		// If current user can access plugin settings, add settings page to plugin action links.
		if ( $this->current_user_can_any( $this->_capabilities_settings_page ) ) {
			add_filter( 'plugin_action_links', [ $this, 'plugin_settings_link' ], 10, 2 );
		}

		add_filter( 'gform_system_report', [ $this, 'filter_gform_system_report' ] );

	}

	/**
	 * Enqueue needed scripts.
	 *
	 * @since  1.0
	 *
	 * @return array
	 */
	public function scripts() {

		global $wp_version;

		// Get minification string.
		$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG || isset( $_GET['gform_debug'] ) ? '' : '.min';

		$scripts = [
			[
				'handle'  => $this->get_slug() . '_vendor_react',
				'src'     => '//unpkg.com/react@16.6.0/umd/react.production.min.js',
				'version' => '16.6.0',
			],
			[
				'handle'  => $this->get_slug() . '_vendor_react-dom',
				'src'     => '//unpkg.com/react-dom@16.6.0/umd/react-dom.production.min.js',
				'version' => '16.6.0',
				'deps'    => [ $this->get_slug() . '_vendor_react' ],
			],
			[
				'handle'    => 'forgravity_fillablepdfs_admin',
				'src'       => $this->get_base_url() . '/js/admin.js',
				'version'   => $this->get_version(),
				'deps'      => [ 'jquery', 'gform_chosen', 'gform_tooltip_init' ],
				'in_footer' => true,
				'enqueue'   => [
					[
						'admin_page' => [ 'form_settings', 'plugin_page' ],
						'tab'        => $this->get_slug(),
					],
				],
				'strings'   => [
					'illegal_file_type' => esc_html__( 'Illegal file type.', 'forgravity_fillablepdfs' ),
				],
			],
			[
				'handle'    => 'forgravity_fillablepdfs_feed_settings',
				'src'       => $this->get_base_url() . "/js/feed_settings{$min}.js",
				'version'   => filemtime( $this->get_base_path() . "/js/feed_settings{$min}.js" ),
				'deps'      => [ 'jquery', version_compare( $wp_version, '5.0', '>=' ) ? 'wp-element' : $this->get_slug() . '_vendor_react-dom' ],
				'in_footer' => true,
				'enqueue'   => [
					[
						'admin_page' => [ 'form_settings' ],
						'tab'        => $this->get_slug(),
					],
				],
				'callback'  => [ $this, 'localize_feed_settings_script' ],
			],
			[
				'handle'    => 'forgravity_fillablepdfs_import',
				'src'       => $this->get_base_url() . '/js/import.js',
				'version'   => $this->get_version(),
				'deps'      => [ 'jquery', 'gform_chosen', 'thickbox' ],
				'in_footer' => true,
				'enqueue'   => [
					[ 'query' => 'page=' . $this->get_slug() . '&subview=import' ],
				],
				'strings'   => [
					'illegal_file_type' => esc_html__( 'Illegal file type.', 'forgravity_fillablepdfs' ),
					'modal_title'       => esc_html__( 'Define Field Choices', 'forgravity_fillablepdfs' ),
				],
			],
		];

		return array_merge( parent::scripts(), $scripts );

	}

	/**
	 * Localize feed settings script.
	 *
	 * @since  2.0
	 *
	 * @param string|array $form    The current Form object.
	 * @param bool         $is_ajax If form is being loaded via AJAX.
	 */
	public function localize_feed_settings_script( $form = '', $is_ajax = false ) {

		global $gfp_gfchart_image_charts;

	    // Initialize API.
        if ( ! $this->initialize_api() ) {
            return;
        }

        // Get settings.
        if ( $this->is_postback() ) {

            // Get posted settings.
            $settings = $this->get_posted_settings();

        } else {

            // Get saved settings.
            $settings = $this->get_current_feed();
            $settings = $settings['meta'];

        }

        try {

			// Get template.
			$template = rgar( $settings, 'templateID' ) ? $this->api->get_template( $settings['templateID'] ) : [];

		} catch ( Exception $e ) {

            // Log that template could not be retrieved.
            $this->log_error( __METHOD__ . '(): Unable to localize script because template could not be retrieved; ' . $e->getMessage() );

            // Set template to empty array.
            $template = [];

        }

		// Get available GFChart charts.
		$gfchart_charts = self::get_gfchart_charts();

		// Localize script.
		wp_localize_script(
			'forgravity_fillablepdfs_feed_settings',
			'fg_fillablepdfs',
			[
				'api_base'     => FG_FILLABLEPDFS_API_URL,
				'entry_meta'   => $this->get_entry_meta_options(),
				'template'     => $template,
				'integrations' => [
					'gfchart' => [
						'label'   => esc_html__( 'GFChart', 'forgravity_fillablepdfs' ),
						'enabled' => ! empty( $gfp_gfchart_image_charts ) && ! empty( $gfchart_charts ),
						'charts'  => $gfchart_charts,
					],
				],
			]
		);

    }

	/**
	 * Enqueue needed stylesheets.
	 *
	 * @since  1.0
	 *
	 * @return array
	 */
	public function styles() {

		// Get minification string.
		$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG || isset( $_GET['gform_debug'] ) ? '' : '.min';

		// Prepare stylesheets.
		$styles = [
			[
				'handle'  => $this->get_slug() . '_admin',
				'src'     => $this->get_base_url() . '/css/admin.css',
				'version' => $this->get_version(),
				'deps'    => [ 'gform_tooltip' ],
				'enqueue' => [
					[
						'admin_page' => [ 'form_settings', 'plugin_page' ],
						'tab'        => $this->get_slug(),
					],
					[ 'query' => 'page=gf_export&view=import_pdf' ],
				],
			],
			[
				'handle'  => $this->get_slug() . '_feed_settings',
				'src'     => $this->get_base_url() . "/css/feed_settings{$min}.css",
				'version' => filemtime( $this->get_base_path() . "/css/feed_settings{$min}.css" ),
				'deps'    => [ 'gform_chosen' ],
				'enqueue' => [
					[
						'admin_page' => [ 'form_settings' ],
						'tab'        => $this->get_slug(),
					],
				],
			],
			[
				'handle'  => $this->get_slug() . '_import',
				'src'     => $this->get_base_url() . '/css/import.css',
				'version' => $this->get_version(),
				'deps'    => [ 'thickbox', 'gform_chosen' ],
				'enqueue' => [
					[ 'query' => 'page=' . $this->get_slug() . '&subview=import' ],
				],
			],
		];

		// Add Chosen stylesheet.
		if ( ! wp_style_is( 'gform_chosen', 'registered' ) ) {

			// Add Chosen.
			$styles[] = [
				'handle'  => 'gform_chosen',
				'src'     => GFCommon::get_base_url() . "/css/chosen{$min}.css",
				'version' => GFCommon::$version,
				'enqueue' => [],
			];

		}

		return array_merge( parent::styles(), $styles );

	}

	/**
	 * Remove scheduled events on uninstall.
	 *
	 * @since 2.3
	 */
	public function uninstall() {

		self::clear_scheduled_events();

		parent::uninstall();

	}




	// # PLUGIN PAGE ---------------------------------------------------------------------------------------------------

	/**
	 * Initialize plugin page.
	 * Displays plugin settings and template management.
	 *
	 * @since  1.0
	 */
	public function plugin_page() {

		// Display plugin page header.
		$this->plugin_page_header();

		// Get current subview.
        $subview = $this->get_current_subview( false );

		// Display current subview if exists.
		if ( is_callable( $subview['callback'] ) ) {
			call_user_func( $subview['callback'] );
		} else {
			die( esc_html__( 'This subview does not exist.', 'forgravity_fillablepdfs' ) );
		}

		// Display plugin page footer.
		$this->plugin_page_footer();

	}

	/**
	 * Plugin page header.
	 *
	 * @since  1.0
	 *
	 * @param string $title Page title.
	 */
    public function plugin_page_header( $title = '' ) {

        // Register needed styles.
        wp_register_style( 'gform_admin', GFCommon::get_base_url() . '/css/admin.css' );
        wp_print_styles( [ 'jquery-ui-styles', 'gform_admin', 'wp-pointer' ] );

        // Get subviews.
        $subviews = $this->get_subviews();

        ?>

        <div class="wrap <?php echo esc_attr( GFCommon::get_browser_class() ); ?>">

            <?php GFCommon::display_admin_message(); ?>

            <div id="gform_tab_group" class="gform_tab_group vertical_tabs">

                <ul id="gform_tabs" class="gform_tabs">
                    <?php
                    foreach ( $subviews as $view ) {

                        // Initialize URL query params.
                        $query = [ 'subview' => $view['name'] ];

                        // Add subview query params, if set.
                        if ( isset( $view['query'] ) ) {
                            $query = array_merge( $query, $view['query'] );
                        }

                        // Prepare subview URL.
                        $view_url = add_query_arg( $query );

                        // Remove unneeded query params.
                        $view_url = remove_query_arg( [ 'id', 'action' ], $view_url );

                        ?>
                        <li <?php echo $this->get_current_subview() === $view['name'] ? 'class="active"' : ''; ?>>
                            <a href="<?php echo esc_attr( $view_url ); ?>"><?php echo esc_html( $view['label'] ); ?></a>
                        </li>
                    <?php } ?>
                </ul>

                <div id="gform_tab_container" class="gform_tab_container">
                    <div class="gform_tab_content" id="tab_<?php echo esc_attr( $this->get_current_subview() ); ?>">

        <?php
    }

    /**
     * Plugin page footer.
     *
     * @since  1.0
     */
    public function plugin_page_footer() {
    ?>

                    </div> <!-- / gform_tab_content -->
                </div> <!-- / gform_tab_container -->
            </div> <!-- / gform_tab_group -->

            <br class="clear" style="clear: both;"/>

        </div> <!-- / wrap -->

        <script type="text/javascript">
            jQuery( document ).ready( function ( $ ) {
                $( '.gform_tab_container' ).css( 'minHeight', jQuery( '#gform_tabs' ).height() + 100 );
            } );
        </script>

        <?php
    }

	/**
	 * Get current plugin page subview.
	 *
	 * @since  1.0
	 *
	 * @param bool $return_name Return only subview name.
	 *
	 * @return string|array|bool
	 */
	public function get_current_subview( $return_name = true ) {

		// Get subviews.
		$subviews = $this->get_subviews();

		// Get current subview.
		$current_subview = rgempty( 'subview', $_GET ) ? $subviews[0]['name'] : rgget( 'subview' );

		// If returning name, return.
		if ( $return_name ) {
			return $current_subview;
		}

		// Loop through subviews.
		foreach ( $subviews as $subview ) {

			// If this is the current subview, return.
			if ( $current_subview === $subview['name'] ) {
				return $subview;
			}

		}

		return false;

	}

	/**
	 * Get plugin page subviews.
	 *
	 * @since  1.0
	 *
	 * @return array
	 */
	public function get_subviews() {

		// Initialize subviews.
		$subviews = [
			[
				'name'     => 'settings',
				'label'    => esc_html__( 'Settings', 'forgravity_fillablepdfs' ),
				'callback' => [ $this, 'settings_page' ],
			],
		];

		// If API is not initialized, return.
		if ( ! $this->initialize_api() ) {
			return $subviews;
		}

		// Load Templates class.
		if ( ! class_exists( '\ForGravity\FillablePDFs\Templates' ) ) {
			require_once 'includes/class-templates.php';
		}

		// Load Import class.
		if ( ! class_exists( '\ForGravity\FillablePDFs\Import' ) ) {
			require_once 'includes/class-import.php';
		}

		// Add additional subviews.
		$subviews[] = [
			'name'     => 'templates',
			'label'    => esc_html__( 'Templates', 'forgravity_fillablepdfs' ),
			'callback' => [ fg_fillablepdfs_templates(), 'templates_page' ],
		];

		try {

			// Get license info.
			$license = $this->api->get_license_info();

		} catch ( Exception $e ) {

			// Log that license info could not be retrieved.
			$this->log_error( __METHOD__ . '(): Unable to get license info; ' . $e->getMessage() );

			return $subviews;

		}

		// If license has access to Import feature, add tab.
		if ( $license['supports']['import'] ) {
			$subviews[] = [
				'name'     => 'import',
				'label'    => esc_html__( 'Import PDFs', 'forgravity_fillablepdfs' ),
				'callback' => [ fg_fillablepdfs_import(), 'import_page' ],
			];
		}

		return $subviews;

	}





	// # PLUGIN SETTINGS -----------------------------------------------------------------------------------------------

	/**
	 * Prevent plugin settings page from appearing on Gravity Forms settings page.
	 *
	 * @since  1.0
	 */
	public function plugin_settings_init() {
	}

	/**
	 * Add link to settings to plugin action links.
	 *
	 * @since  1.0
	 *
	 * @param array  $links An array of plugin action links.
	 * @param string $file  Path to the plugin file.
	 *
	 * @return array
	 */
	public function plugin_settings_link( $links, $file ) {

		// If plugin being filtered is not Fillable PDFs, return links.
		if ( $file !== $this->get_path() ) {
			return $links;
		}

		// Prepare settings URL.
		$settings_url = add_query_arg( [ 'page' => $this->get_slug() ], admin_url( 'admin.php?subview=settings' ) );

		// Prepare link.
		$link = sprintf(
			'<a href="%s">%s</a>',
			esc_url( $settings_url ),
			esc_html__( 'Settings', 'forgravity_fillablepdfs' )
		);

		// Add settings page to links.
		array_unshift( $links, $link );

		return $links;

	}

	/**
	 * Display plugin settings page as settings subview.
	 *
	 * @since  1.0
	 */
	public function settings_page() {

		$this->plugin_settings_page();

	}





	// # TEMPLATES ----------------------------------------------------------------------------------------------------

	/**
	 * Display templates plugin page.
	 *
	 * @since  1.0
	 */
	public function templates_page() {

		// Load table class.
		if ( ! class_exists( '\ForGravity\FillablePDFs\Templates' ) ) {
			require_once 'includes/class-templates.php';
		}

		return fg_fillablepdfs_templates()->templates_page();

	}





	// # FEED SETTINGS -------------------------------------------------------------------------------------------------

	/**
	 * Renders the UI of all settings page based on the specified configuration array $sections.
	 *    Forked to display section tabs.
	 *
	 * @since  1.0
	 *
	 * @param  array $sections Configuration array containing all fields to be rendered grouped into sections.
	 */
	public function render_settings( $sections ) {

		// Add default save button if not defined.
		if ( ! $this->has_setting_field_type( 'save', $sections ) ) {
			$sections = $this->add_default_save_button( $sections );
		}

		// Initialize tabs.
		$tabs = [];

		// Get tabs.
		foreach ( $sections as $section ) {

			// If no tab is defined, skip it.
			if ( ! rgar( $section, 'tab' ) ) {
				continue;
			}

			// If section doesn't meet dependency, skip it.
			if ( ! $this->setting_dependency_met( rgar( $section, 'dependency' ) ) ) {
				continue;
			}

			// Add tab.
			$tabs[ rgar( $section, 'id' ) ] = [
				'label' => rgars( $section, 'tab/label' ),
				'icon'  => rgars( $section, 'tab/icon' ),
			];

		}

		?>

        <form id="gform-settings" action="" enctype="multipart/form-data" method="post">
			<?php if ( ! empty( $tabs ) ) { ?>
                <div class="wp-filter fillablepdfs-tabs">
                    <ul class="filter-links">
						<?php
						$is_first = true;
						foreach ( $tabs as $id => $tab ) {
							echo '<li id="' . esc_attr( $id ) . '-nav">';
							echo '<a href="#' . esc_attr( $id ) . '"' . ( $is_first ? ' class="current"' : '' ) . '>';
							echo $tab['icon'] ? '<i class="fa ' . esc_attr( $tab['icon'] ) . '"></i> ' : null;
							echo esc_html( $tab['label'] );
							echo '</a>';
							echo '</li>';
							$is_first = false;
						}
						?>
                    </ul>
                </div>
				<?php
			}
			wp_nonce_field( $this->_slug . '_save_settings', '_' . $this->_slug . '_save_settings_nonce' );
			$this->settings( $sections );
			?>
        </form>

		<?php
	}

	/**
	 * Prepare title for Feed Settings page.
	 *
	 * @since  1.0
	 *
	 * @return string
	 */
	public function feed_settings_title() {

		return sprintf(
			'<i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbsp;%s',
			esc_html__( 'Feed Settings', 'gravityforms' )
		);

	}

	/**
	 * Setup fields for feed settings.
	 *
	 * @since  1.0
	 *
	 * @return array
	 */
	public function feed_settings_fields() {

		return [
			[
				'id'     => 'section-general',
				'class'  => 'fillablepdfs-feed-section',
				'tab'    => [ 'label' => esc_html__( 'General', 'forgravity_fillablepdfs' ), 'icon' => 'fa-cog' ],
				'fields' => [
					[
						'label'    => esc_html__( 'Name', 'forgravity_fillablepdfs' ),
						'name'     => 'feedName',
						'type'     => 'text',
						'class'    => 'medium',
						'required' => true,
					],
					[
						'label'            => esc_html__( 'Template', 'forgravity_fillablepdfs' ),
						'name'             => 'templateID',
						'type'             => 'template',
						'required'         => true,
						'onchange'         => "jQuery(this).parents('form').submit();",
						'choices'          => $this->get_templates_as_choices(),
						'data-placeholder' => esc_html__( 'Select a Template', 'forgravity_fillablepdfs' ),
						'no_choices' => sprintf(
							'<p>%s</p>',
							sprintf(
								esc_html__( 'You must have %sat least one template%s to be able to create a Fillable PDFs feed.', 'forgravity_fillablepdfs' ),
								'<a href="' . esc_url( add_query_arg( [
									'page'    => $this->get_slug(),
									'subview' => 'templates',
								], admin_url( 'admin.php' ) ) ) . '">',
								'</a>'
							)
						),
					],
					[
						'label'         => esc_html__( 'File Name', 'forgravity_fillablepdfs' ),
						'name'          => 'fileName',
						'type'          => 'text',
						'required'      => true,
						'class'         => 'medium merge-tag-support mt-position-right mt-hide_all_fields',
						'dependency'    => 'templateID',
						'default_value' => $this->get_default_file_name(),
					],
					[
						'label'            => esc_html__( 'Notifications', 'forgravity_fillablepdfs' ),
						'name'             => 'notifications[]',
						'type'             => 'select',
						'multiple'         => true,
						'choices'          => $this->get_notifications_as_choices(),
						'data-placeholder' => esc_html__( 'Select Notifications', 'forgravity_fillablepdfs' ),
						'dependency'       => 'templateID',
						'description'      => esc_html__( 'Select what notifications this generated PDF will be attached to', 'forgravity_fillablepdfs' ),
					],
					[
						'label'          => esc_html__( 'Conditional Logic', 'forgravity_fillablepdfs' ),
						'name'           => 'feed_condition',
						'type'           => 'feed_condition',
						'checkbox_label' => esc_html__( 'Enable', 'forgravity_fillablepdfs' ),
						'instructions'   => esc_html__( 'Export to PDF if', 'forgravity_fillablepdfs' ),
						'dependency'     => 'templateID',
					],
				],
			],
			[
				'id'         => 'section-advanced',
				'class'      => 'fillablepdfs-feed-section',
				'tab'        => [
					'label' => esc_html__( 'Advanced', 'forgravity_fillablepdfs' ),
					'icon'  => 'fa-cogs',
				],
				'dependency' => 'templateID',
				'fields'     => [
					[
						'name'        => 'userPassword',
						'label'       => esc_html__( 'User Password', 'forgravity_fillablepdfs' ),
						'type'        => 'text',
						'class'       => 'medium merge-tag-support mt-position-right mt-hide_all_fields',
						'description' => esc_html__( 'Set password required to view PDF', 'forgravity_fillablepdfs' ),
					],
					[
						'name'        => 'password',
						'label'       => esc_html__( 'Owner Password', 'forgravity_fillablepdfs' ),
						'type'        => 'text',
						'class'       => 'medium merge-tag-support mt-position-right mt-hide_all_fields',
						'description' => esc_html__( 'Set password to allow PDF permissions to be changed', 'forgravity_fillablepdfs' ),
					],
					[
						'name'          => 'filePermissions[]',
						'label'         => esc_html__( 'File Permissions', 'forgravity_fillablepdfs' ),
						'type'          => 'select',
						'multiple'      => true,
						'default_value' => [
							'ModifyAnnotations',
							'Printing',
							'DegradedPrinting',
							'ModifyContents',
							'Assembly',
							'CopyContents',
							'ScreenReaders',
							'FillIn',
						],
						'description'   => esc_html__( 'Select what users are allowed to do with the generated PDF', 'forgravity_fillablepdfs' ),
						'choices'       => [
							[
								'label' => esc_html__( 'Print - High Resolution', 'forgravity_fillablepdfs' ),
								'value' => 'Printing',
							],
							[
								'label' => esc_html__( 'Print - Low Resolution', 'forgravity_fillablepdfs' ),
								'value' => 'DegradedPrinting',
							],
							[
								'label' => esc_html__( 'Modify', 'forgravity_fillablepdfs' ),
								'value' => 'ModifyContents',
							],
							[
								'label' => esc_html__( 'Assembly', 'forgravity_fillablepdfs' ),
								'value' => 'Assembly',
							],
							[
								'label' => esc_html__( 'Copy', 'forgravity_fillablepdfs' ),
								'value' => 'CopyContents',
							],
							[
								'label' => esc_html__( 'Screen Reading', 'forgravity_fillablepdfs' ),
								'value' => 'ScreenReaders',
							],
							[
								'label' => esc_html__( 'Annotate', 'forgravity_fillablepdfs' ),
								'value' => 'ModifyAnnotations',
							],
							[
								'label' => esc_html__( 'Fill Forms', 'forgravity_fillablepdfs' ),
								'value' => 'FillIn',
							],
						],
					],
					[
						'name'          => 'publicAccess',
						'label'         => esc_html__( 'Enable Public Access', 'forgravity_fillablepdfs' ),
						'type'          => 'radio',
						'required'      => true,
						'default_value' => '0',
						'description'   => esc_html__( 'Enabling this setting allows anyone to download the generated PDF.', 'forgravity_fillablepdfs' ),
						'horizontal'    => true,
						'choices'       => [
							[
								'label' => esc_html__( 'Yes', 'forgravity_fillablepdfs' ),
								'value' => '1',
							],
							[
								'label' => esc_html__( 'No', 'forgravity_fillablepdfs' ),
								'value' => '0',
							],
						],
					],
					[
						'name'    => 'options',
						'label'   => esc_html__( 'Additional Options', 'forgravity_fillablepdfs' ),
						'type'    => 'checkbox',
						'choices' => [
							[
								'label' => esc_html__( 'Remove interactive form fields', 'forgravity_fillablepdfs' ),
								'name'  => 'flatten',
							],
						],
					],
				],
			],
			[
				'fields' => [ [ 'type' => 'save' ] ],
			],
		];

	}

	/**
	 * Renders and initializes a template selection field based on the $field array
	 *
	 * @since  1.0
	 *
	 * @param array $field Field array containing the configuration options of this field.
	 * @param bool  $echo  Echo the output to the screen.
	 *
	 * @return string
	 */
	public function settings_template( $field, $echo = true ) {

		// Get template setting.
		$template_id = $this->get_setting( 'templateID' );

		// Get select field.
		$html = '<div class="fillablepdfs__template-controls">';
		$html .= $this->settings_select( $field, false );

		// If template is selected, display field map field.
		if ( $template_id ) {

		    try {

		        // Get template.
				$this->api->get_template( $template_id );

				// Add open mapper button.
				$html .= sprintf(
					' <a class="button" onclick="javascript:openTemplateMapper();">%s</a>',
					esc_html__( 'Open Mapper', 'forgravity_fillablepdfs' )
				);
				$html .= '</div>';

				// Prepare field map field.
				$field_map = [
					'name'          => 'fieldMap',
					'type'          => 'hidden',
					'default_value' => json_encode( [] ),
				];

				// Get hidden field.
				$html .= $this->settings_hidden( $field_map, false );

				// Display template thumbnail.
				$html .= sprintf(
					'<p><img src="%s" alt="%s" class="fillablepdfs-template-thumbnail" /></p>',
					esc_url( API::$api_url . 'templates/' . $template_id . '/image' ),
					esc_attr( $this->get_setting( 'feedName' ) )
				);

			} catch ( Exception $e ) {
			}

		} else {

		    $html .= '</div>';

        }

		if ( $echo ) {
			echo $html;
		}

		return $html;

	}

	/**
	 * Get default PDF file name.
	 *
	 * @since  1.0
	 *
	 * @return string
	 */
	public function get_default_file_name() {

		// If API cannot be initialized, return.
		if ( ! $this->initialize_api() ) {
			return '';
		}

		// Get template setting.
		$template_id = $this->get_setting( 'templateID' );

		// If template is not selected, return.
		if ( ! $template_id ) {
			return '';
		}

		try {

			// Get template.
			$template = $this->api->get_template( $template_id );

		} catch ( Exception $e ) {

			return '';

		}

		return sanitize_file_name( $template['name'] ) . '.pdf';

	}

	/**
	 * Get form notifications as choices for feed settings field.
	 *
	 * @since  1.0
	 *
	 * @return array
	 */
	public function get_notifications_as_choices() {

		// Initialize choices array.
		$choices = [];

		// Get current form.
		$form = $this->get_current_form();

		// If form was not found, return choices.
		if ( ! $form ) {
			return $choices;
		}

		// Loop through notifications.
		foreach ( $form['notifications'] as $notification ) {

			// Add notification as choice.
			$choices[] = [
				'label' => esc_html( $notification['name'] ),
				'value' => esc_attr( $notification['id'] ),
			];

		}

		return $choices;

	}

	/**
	 * Get PDF templates as choices for feed settings field.
	 *
	 * @since  1.0
	 *
	 * @return array
	 */
	public function get_templates_as_choices() {

		// If API is not initialized, return empty array.
		if ( ! $this->initialize_api() ) {
			return [];
		}

		try {

			// Get templates.
			$templates = $this->api->get_templates();

		} catch ( Exception $e ) {

			// Log that templates could not be retrieved.
			$this->log_error( __METHOD__ . '(): Unable to retrieve templates; ' . $e->getMessage() );

			return [];

		}

		// Initialize choices array.
		$choices = [];

		// If template exist, add them as choices.
		if ( $templates ) {

			// Add initial choice.
			$choices[] = [
				'label' => null,
				'value' => null,
			];

			// Loop through templates.
			foreach ( $templates as $template ) {

				// Add template as choice.
				$choices[] = [
					'label' => esc_html( $template['name'] ),
					'value' => esc_attr( $template['template_id'] ),
				];

			}

		}

		return $choices;

	}





	// # FEED LIST -------------------------------------------------------------------------------------------------

	/**
	 * Add PDF icon to feed list title.
	 *
	 * @since  1.0
	 *
	 * @return string
	 */
	public function feed_list_title() {

		return sprintf( '<i class="fa fa-file-pdf-o" aria-hidden="true"></i> %s', parent::feed_list_title() );

	}

	/**
	 * Set if feeds can be created.
	 *
	 * @since  1.0
	 *
	 * @return bool
	 */
	public function can_create_feed() {

		return $this->initialize_api();

	}

	/**
	 * Enable feed duplication.
	 *
	 * @since  1.0
	 *
	 * @param string $id Feed ID requesting duplication.
	 *
	 * @return bool
	 */
	public function can_duplicate_feed( $id ) {

		return true;

	}

	/**
	 * Display message to configure Add-On before setting up feeds.
	 *
	 * @since  1.0
	 *
	 * @return string
	 */
	public function configure_addon_message() {

		$settings_label = sprintf( __( '%s Settings', 'forgravity_fillablepdfs' ), $this->get_short_title() );
		$settings_url   = add_query_arg( [ 'page' => $this->get_slug() ], admin_url( 'admin.php' ) );
		$settings_link  = sprintf( '<a href="%s">%s</a>', esc_url( $settings_url ), $settings_label );

		return sprintf( __( 'To get started, please configure your %s.', 'gravityforms' ), $settings_link );

	}

	/**
	 * Setup columns for feed list table.
	 *
	 * @since  1.0
	 *
	 * @return array
	 */
	public function feed_list_columns() {

		return [
			'feedName' => esc_html__( 'Name', 'forgravity_fillablepdfs' ),
			'template' => esc_html__( 'Template', 'forgravity_fillablepdfs' ),
		];

	}

	/**
	 * Returns the value to be displayed in the template feed list column.
	 *
	 * @since  1.0
	 *
	 * @param array $feed The feed being included in the feed list.
	 *
	 * @return string
	 */
	public function get_column_value_template( $feed ) {

		// If API is not initialized, return template ID.
		if ( ! $this->initialize_api() || ! rgars( $feed, 'meta/templateID' ) ) {
			return rgars( $feed, 'meta/templateID' );
		}

		try {

			// Get template.
			$template = $this->api->get_template( rgars( $feed, 'meta/templateID' ) );

			return esc_html( $template['name'] );

		} catch ( Exception $e ) {

			// Log that template could not be retrieved.
			$this->log_error( __METHOD__ . '(): Unable to retrieve template; ' . $e->getMessage() );

			return rgars( $feed, 'meta/templateID' );

		}

	}





	// # FORM SUBMISSION -----------------------------------------------------------------------------------------------

	/**
	 * Process feed.
	 *
	 * @since  1.0
	 *
	 * @param array $feed  The Feed object to be processed.
	 * @param array $entry The Entry object currently being processed.
	 * @param array $form  The Form object currently being processed.
	 */
	public function process_feed( $feed, $entry, $form ) {

		global $wpdb;

		// If API could not be initialized, return.
		if ( ! $this->initialize_api() ) {

			// Add feed error explaining why PDF could not be generated.
			$this->add_feed_error( esc_html__( 'PDF could not be generated because API could not be initialized.', 'forgravity_fillablepdfs' ), $feed, $entry, $form );

			return;

		}

		try {

			// Get template.
			$template = $this->api->get_template( rgars( $feed, 'meta/templateID' ) );

		} catch ( Exception $e ) {

			// Log feed error.
			$this->add_feed_error( sprintf( esc_html__( 'PDF template could not be retrieved; %s', 'forgravity_fillablepdfs' ), $e->getMessage() ), $feed, $entry, $form );

			return;

		}

		// Get field map.
		$field_map = rgars( $feed, 'meta/fieldMap' );

		// Initialize field values array.
		$field_values = [];

		// Loop through field map and retrieve field values.
		foreach ( $field_map as $field_name => $meta ) {

		    // If mapped field is 0, skip.
            if ( '0' === (string) $meta['field'] ) {
                continue;
            }

			// Get field object and field value.
			$field_object = GFAPI::get_field( $form, $meta['field'] );
			$field_value  = $this->get_field_value( $form, $entry, $meta['field'] );

			if ( 'gf_custom' === rgar( $meta, 'field' ) ) {

				// Replace merge tags.
				$field_value = GFCommon::replace_variables( $meta['value'], $form, $entry, false, false, false, 'text' );

				// Process conditional shortcode.
				if ( has_shortcode( $field_value, 'gravityforms' ) || has_shortcode( $field_value, 'gravityform' ) ) {
					$field_value = do_shortcode( $field_value );
					$field_value = wp_strip_all_tags( $field_value );
				}

			}

			// If field is a GFChart chart, get image URL.
			if ( 'gfchart' === rgar( $meta, 'field' ) ) {

				// Get image chart URL.
				$field_value = self::get_gfchart_image_chart_url( rgar( $meta, 'value' ) );

				// If image chart was returned, set modifier.
				if ( ! empty( $field_value ) ) {
					$meta['modifiers'] = [ 'image_fill' ];
				}

			}

			// If field is a Signature field, set modifier and transparency.
			if ( $field_object && 'signature' === $field_object->type ) {

				// Set transparency
				$field_value = add_query_arg( [ 't' => '1' ], $field_value );

				// Set modifier
				if ( ! in_array( 'image_fill', $meta['modifiers'] ) ) {
					$meta['modifiers'][] = 'image_fill';
				}

			}

			// If field is a List field, get specific value.
			if ( $field_object && 'list' === $field_object->type ) {

				// Get list modifier.
				$list_mod = $list_mod_key = false;
				foreach ( $meta['modifiers'] as $i => $mod ) {
					if ( substr( $mod, 0, 5 ) !== 'list=' ) {
						continue;
					}
					$list_mod_key = $i;
					$list_mod     = explode( ',', substr( $mod, 5 ) );
				}

				// If list modifier was found, get value.
				if ( $list_mod ) {

					// Remove modifier.
					unset( $meta['modifiers'][ $list_mod_key ] );

					// Set field value to entry value.
					$field_value = rgar( $entry, $meta['field'] );
					$field_value = maybe_unserialize( $field_value );

					// Get row number.
					$list_row = (int) $list_mod[1] - 1;

					// Get input value.
					if ( $list_mod[0] == '0' ) {
						$field_value = rgar( $field_value, $list_row );
					} else {
						$field_value = isset( $field_value[ $list_row ] ) ? rgar( $field_value[ $list_row ], $list_mod[0] ) : null;
					}

				}

			}

			// If field value is empty, skip it.
			if ( rgblank( $field_value ) ) {
				continue;
			}

			// If modifier is set, prepend to value.
            if ( rgar( $meta, 'modifiers' ) ) {
                $field_value = GFCommon::implode_non_blank( ',', $meta['modifiers'] ) . '|' . $field_value;
            }

			$field_values[ $field_name ] = $field_value;

		}

		// Prepare PDF meta.
		$pdf_meta = [
			'template_id'   => rgar( $template, 'template_id' ),
			'field_values'  => $field_values,
			'file_name'     => GFCommon::replace_variables( rgars( $feed, 'meta/fileName' ), $form, $entry, false, false, false, 'text' ),
			'password'      => GFCommon::replace_variables( rgars( $feed, 'meta/password' ), $form, $entry, false, false, false, 'text' ),
			'user_password' => GFCommon::replace_variables( rgars( $feed, 'meta/userPassword' ), $form, $entry, false, false, false, 'text' ),
			'permissions'   => rgars( $feed, 'meta/filePermissions' ),
			'flatten'       => rgars( $feed, 'meta/flatten' ),
		];

		/**
		 * Modify the PDF that will be created.
		 *
		 * @param array $pdf_meta PDF arguments.
		 * @param array $feed     The feed object.
		 * @param array $entry    The entry object.
		 * @param array $form     The form object.
		 */
		$pdf_meta = gf_apply_filters( [
			'fg_fillablepdfs_pdf_args',
			$form['id'],
		], $pdf_meta, $feed, $entry, $form );

		// If file name is empty, return.
		if ( rgblank( $pdf_meta['file_name'] ) ) {

			// Add feed error explaining why PDF could not be generated.
			$this->add_feed_error( esc_html__( 'PDF could not be generated because no file name was provided.', 'forgravity_fillablepdfs' ), $feed, $entry, $form );

			return;

		}

		// If PDF extension is not in file name, add it.
		if ( ! preg_match( '/\.pdf$/i', $pdf_meta['file_name'] ) ) {
			$pdf_meta['file_name'] .= '.pdf';
		}

		// Remove unused PDF meta.
		$pdf_meta = array_filter( $pdf_meta );

		// Log the PDF to be created.
		$this->log_debug( __METHOD__ . '(): PDF to be generated; ' . print_r( $pdf_meta, true ) );

		try {

			// Generate PDF.
			$generated_pdf = $this->api->generate( $pdf_meta['template_id'], $pdf_meta );

			// Log that PDF was successfully generated.
			$this->log_debug( __METHOD__ . '(): PDF was successfully generated.' );

		} catch ( Exception $e ) {

			// Log feed error.
			$this->add_feed_error( sprintf( esc_html__( 'PDF could not be generated; %s', 'forgravity_fillablepdfs' ), $e->getMessage() ), $feed, $entry, $form );

			return;

		}

		// If generated PDF returns empty, exit.
        if ( empty( $generated_pdf ) ) {

			// Log feed error.
			$this->add_feed_error( esc_html__( 'PDF could not be generated; empty file returned.', 'forgravity_fillablepdfs' ), $feed, $entry, $form );

			return;

		}

		// Get the destination file path.
		$file_path = $this->generate_physical_file_path( $form['id'], $pdf_meta['file_name'], $entry, true );

		// Open file writer.
		$writer = fopen( $file_path, 'w' );

		// If writer could not be opened, exit.
		if ( ! $writer ) {

			// Log feed error.
			$this->add_feed_error( esc_html__( 'Unable to save PDF file; writer could not be opened.', 'forgravity_fillablepdfs' ), $feed, $entry, $form );

			return;

		}

		// Write file.
		$written = fwrite( $writer, $generated_pdf );

		// Close file.
		fclose( $writer );

		// If file could not be written, exit.
		if ( ! $written ) {

			// Log feed error.
			$this->add_feed_error( esc_html__( 'Unable to save PDF file; could not write to file.', 'forgravity_fillablepdfs' ), $feed, $entry, $form );

			return;

		}

		// Get existing entry PDF IDs.
		$entry_pdfs = gform_get_meta( $entry['id'], 'fillablepdfs' );
		$entry_pdfs = is_array( $entry_pdfs ) ? $entry_pdfs : [];

		// Look for existing PDF for feed, replace file.
		if ( isset( $entry_pdfs[ $feed['id'] ] ) ) {

			// Get PDF ID.
			$pdf_id = $entry_pdfs[ $feed['id'] ];

			// Get existing PDF.
			$entry_meta = gform_get_meta( $entry['id'], 'fillablepdfs_' . $pdf_id );

			// Get existing file path.
			$existing_file_path = $this->get_physical_file_path( $entry_meta );

			// Delete existing file.
			if ( file_exists( $existing_file_path ) ) {
				unlink( $existing_file_path );
			}

			// Update entry meta.
			$entry_meta['file_name']          = $pdf_meta['file_name'];
			$entry_meta['physical_file_name'] = basename( $file_path );
			$entry_meta['date_created']       = $wpdb->get_var( 'SELECT utc_timestamp()' );
			$entry_meta['public']             = (bool) rgars( $feed, 'meta/publicAccess' );
			unset( $entry_meta['access'], $entry_meta['file_path'] );

			// Save to entry meta.
			gform_update_meta( $entry['id'], 'fillablepdfs_' . $pdf_id, $entry_meta );

		} else {

			// Generate PDF ID.
			$pdf_id = uniqid();

			// Prepare entry meta.
			$entry_meta = [
				'pdf_id'             => $pdf_id,
				'file_name'          => $pdf_meta['file_name'],
				'physical_file_name' => basename( $file_path ),
				'date_created'       => $wpdb->get_var( 'SELECT utc_timestamp()' ),
				'user_id'            => rgar( $entry, 'created_by' ),
				'feed_id'            => $feed['id'],
				'public'             => (bool) rgars( $feed, 'meta/publicAccess' ),
				'token'              => md5( uniqid( time() ) ),
			];

			// Save PDF details to entry meta.
			gform_update_meta( $entry['id'], 'fillablepdfs_' . $pdf_id, $entry_meta );

			// Add new PDF ID to entry PDF IDs array.
			$entry_pdfs[ $feed['id'] ] = $pdf_id;

			// Save entry PDF IDs.
			gform_update_meta( $entry['id'], 'fillablepdfs', $entry_pdfs );

		}

		/**
		 * Fires after PDF has been generated.
		 *
		 * @param array $pdf_meta PDF arguments.
		 * @param array $entry    The entry object.
		 * @param array $form     The form object.
		 * @param array $feed     The feed object.
		 */
		gf_do_action( [
			'fg_fillablepdfs_after_generate',
			$form['id'],
			$feed['id'],
		], $entry_meta, $entry, $form, $feed );

	}

	/**
	 * Override field value when processing feed.
	 *
	 * @since 2.0.6 Fix Entry Date time zone.
	 * @since 2.0.5 Override Time field.
	 * @since 2.0.4 Override Date field.
	 *
	 * @param string $field_value The value to be overridden.
	 * @param array  $form        The Form currently being processed.
	 * @param array  $entry       The Entry currently being processed.
	 * @param string $field_id    The ID of the Field currently being processed.
	 *
	 * @return string
	 */
	public function filter_gform_addon_field_value( $field_value, $form, $entry, $field_id ) {

		/**
		 * Get field.
		 *
		 * @var false|\GF_Field|\GF_Field_Date|\GF_Field_Time $field
		 */
		$field = GFAPI::get_field( $form, $field_id );

		// If this is the Entry Date field, format properly.
		if ( 'date_created' === $field_id ) {
			return GFCommon::format_date( $entry['date_created'], false, 'Y-m-d H:i:s', false );
		}

		// If this is not a proper field, return.
		if ( ! $field ) {
			return $field_value;
		}

		// Get input type.
		$input_type = $field->get_input_type();

		// If this is not a Date or Time field, return.
		if ( ! in_array( $input_type, [ 'date', 'time' ] ) ) {
			return $field_value;
		}

		// Handle Date field, when getting full Date.
		if ( 'date' === $input_type && (int) $field_id == $field_id ) {
			return GFCommon::date_display( $field_value, $field->dateFormat, $field->get_output_date_format() );
		}

		// Handle Date field, when getting specific input.
		if ( 'date' === $input_type && (int) $field_id != $field_id ) {

			// Parse date.
			$date = GFCommon::parse_date( rgar( $entry, $field->id ), $field->dateFormat );

			// Get targeted input.
			$tmp      = explode( '.', $field_id );
			$input_id = (int) end( $tmp );

			switch ( $field->dateFormat ) {

				case 'dmy':
				case 'dmy_dash':
				case 'dmy_dot':

					switch ( $input_id ) {
						case 1:
							return rgar( $date, 'day' );
						case 2:
							return rgar( $date, 'month' );
						case 3:
							return rgar( $date, 'year' );
					}

					break;

				case 'mdy':
				default:

					switch ( $input_id ) {
						case 1:
							return rgar( $date, 'month' );
						case 2:
							return rgar( $date, 'day' );
						case 3:
							return rgar( $date, 'year' );
					}

					break;

				case 'ymd':
				case 'ymd_dash':
				case 'ymd_dot':
				case 'ymd_slash':

					switch ( $input_id ) {
						case 1:
							return rgar( $date, 'year' );
						case 2:
							return rgar( $date, 'month' );
						case 3:
							return rgar( $date, 'day' );
					}

					break;

			}

			return $field_value;

		}

		if ( 'time' === $input_type && (int) $field_id != $field_id ) {

			// Get field value.
			$field_value = rgar( $entry, (int) $field_id );

			// Split value.
			preg_match( '/^(\d*):(\d*) ?(.*)$/', $field_value, $matches );

			// Get targeted input.
			$input_id = end( explode( '.', $field_id ) );

			return rgar( $matches, $input_id );

		}

		return $field_value;

	}

	/**
	 * Attach generated PDFs to notifications.
	 *
	 * @since  1.0
	 *
	 * @param array $notification An array of properties which make up a notification object.
	 * @param array $form         The form object for which the notification is being sent.
	 * @param array $entry        The entry object for which the notification is being sent.
	 *
	 * @return array
	 */
	public function attach_generated_pdfs( $notification, $form, $entry ) {

		// Get Fillable PDFs for entry.
		$entry_pdfs = gform_get_meta( $entry['id'], 'fillablepdfs' );

		// If no PDFs were found, return.
		if ( ! $entry_pdfs || empty( $entry_pdfs ) ) {
			return $notification;
		}

		// Initialize notification PDFs array.
		$notification_pdfs = [];

		// Loop through entry PDFs.
		foreach ( $entry_pdfs as $feed_id => $entry_pdf_id ) {

			// Get feed for entry PDF.
			$feed = $this->get_feed( $feed_id );

			// If feed condition is not met, skip.
			if ( ! $this->is_feed_condition_met( $feed, $form, $entry ) ) {
				continue;
			}

			// Get feed notifications.
			$feed_notifications = rgars( $feed, 'meta/notifications' ) ? $feed['meta']['notifications'] : [];

			// If this notification is not setup for this feed, skip.
			if ( ! in_array( $notification['id'], $feed_notifications ) ) {
				continue;
			}

			// Get entry PDF.
			$entry_pdf = gform_get_meta( $entry['id'], 'fillablepdfs_' . $entry_pdf_id );

			// Add PDF to notification PDFs.
			$notification_pdfs[] = fg_fillablepdfs()->get_physical_file_path( $entry_pdf );

		}

		// Initialize attachments array.
		if ( ! isset( $notification['attachments'] ) ) {
			$notification['attachments'] = [];
		}

		// Add attachments.
		$notification['attachments'] = array_merge( $notification['attachments'], $notification_pdfs );

		return $notification;

	}





	// # ENTRY LIST ----------------------------------------------------------------------------------------------------

	/**
	 * Add Regenerate PDFs to entry list bulk actions.
	 *
	 * @since  2.0
	 *
	 * @param array $actions Bulk actions.
	 * @param int   $form_id The current form ID.
	 *
	 * @return array
	 */
	public function add_bulk_action( $actions = [], $form_id = 0 ) {

		// Add action.
		$actions['fillablepdfs'] = esc_html__( 'Regenerate PDFs', 'forgravity_fillablepdfs' );

		return $actions;

	}

	/**
	 * Process Fillable PDFs entry list bulk actions.
	 *
	 * @since  1.4.2
	 *
	 * @param string $action  Action being performed.
	 * @param array  $entries The entry IDs the action is being applied to.
	 * @param int    $form_id The current form ID.
	 */
	public function process_bulk_action( $action = '', $entries = [], $form_id = 0 ) {

		// If no entries are being processed or this is not the Fillable PDFs action, return.
		if ( empty( $entries ) || 'fillablepdfs' !== $action ) {
			return;
		}

		// Get the current form.
		$form = GFAPI::get_form( $form_id );

		// Loop through entries.
		foreach ( $entries as $entry_id ) {

			// Get the entry.
			$entry = GFAPI::get_entry( $entry_id );

			// Process feeds.
			$this->maybe_process_feed( $entry, $form );

		}

	}





	// # ENTRY DELETION ------------------------------------------------------------------------------------------------

	/**
	 * Delete PDFs upon entry deletion.
	 *
	 * @since  1.0
	 *
	 * @param int $entry_id Entry ID being deleted.
	 */
	public function delete_entry_pdfs( $entry_id ) {

		global $wpdb;

		// Get entry.
		$entry = GFAPI::get_entry( $entry_id );

		// Get PDF meta based on Gravity Forms database version.
		if ( version_compare( $this->get_gravityforms_db_version(), '2.3-dev-1', '<' ) ) {

			// Get entry meta table name.
			$table_name = GFFormsModel::get_lead_meta_table_name();

			// Get PDFs.
			$pdfs = $wpdb->get_col( "SELECT meta_value FROM $table_name WHERE lead_id = $entry_id AND meta_key LIKE 'fillablepdfs_%'" );

		} else {

			// Get entry meta table name.
			$table_name = GFFormsModel::get_entry_meta_table_name();

			// Get PDFs.
			$pdfs = $wpdb->get_col( "SELECT meta_value FROM $table_name WHERE entry_id = $entry_id AND meta_key LIKE 'fillablepdfs_%'" );

		}

		// If no PDFs were found, exit.
		if ( empty( $pdfs ) ) {
			return;
		}

		// Loop through PDFs.
		foreach ( $pdfs as $pdf ) {

			// Unserialize.
			$pdf = maybe_unserialize( $pdf );

			// Get file path.
			$file_path = $this->get_physical_file_path( $pdf );

			// Remove file.
			wp_delete_file( $file_path );

		}

	}

	/**
	 * Delete PDFs for multiple entries upon deletion.
	 *
	 * @since  1.0
	 *
	 * @param int    $form_id The form ID to specify from which form to delete entries.
	 * @param string $status  Allows you to set the form entries to a deleted status.
	 */
	public function delete_entries_pdfs( $form_id, $status ) {

		global $wpdb;

		// Get status filter.
		$status_filter = empty( $status ) ? '' : $wpdb->prepare( 'AND status=%s', $status );

		// Get entry table name.
		$table_name = version_compare( $this->get_gravityforms_db_version(), '2.3-dev-1', '<' ) ? GFFormsModel::get_lead_table_name() : GFFormsModel::get_entry_table_name();

		// Get entry IDs.
		$entry_ids = $wpdb->get_col( $wpdb->prepare( "SELECT id FROM $table_name WHERE form_id=%d {$status_filter}", $form_id ) );

		// If entries were found, loop through them and run action.
		if ( ! empty( $entry_ids ) ) {

			foreach ( $entry_ids as $entry_id ) {

				$this->delete_entry_pdfs( $entry_id );

			}

		}

	}





	// # ENTRY DETAILS -------------------------------------------------------------------------------------------------

	/**
	 * Add Fillable PDFs posts meta box to the entry detail page.
	 *
	 * @since  1.0
	 *
	 * @param array $meta_boxes The properties for the meta boxes.
	 * @param array $entry      The entry currently being viewed/edited.
	 * @param array $form       The form object used to process the current entry.
	 *
	 * @return array
	 */
	public function register_meta_box( $meta_boxes, $entry, $form ) {

		// If user does not have access to Fillable PDFs, exit.
		if ( ! GFCommon::current_user_can_any( $this->_capabilities_settings_page ) ) {
			return $meta_boxes;
		}

	    // Register metabox.
		$meta_boxes[ $this->_slug ] = [
			'title'    => esc_html__( 'Generated PDFs', 'forgravity_fillablepdfs' ),
			'callback' => [ $this, 'add_pdfs_meta_box' ],
			'context'  => 'side',
		];

		return $meta_boxes;

	}

	/**
	 * Display generated PDFs in Fillable PDFs entry meta box.
	 *
	 * @since  1.0
	 *
	 * @param array $args An array containing the Form and Entry objects.
	 */
	public function add_pdfs_meta_box( $args ) {

		// Get PDF IDs entry meta.
		$pdf_ids = gform_get_meta( $args['entry']['id'], 'fillablepdfs' );

		// Display generated PDFs.
        if ( ! empty( $pdf_ids ) ) {

			echo '<ul>';

			// Loop through PDF IDs.
			foreach ( $pdf_ids as $feed_id => $pdf_id ) {

				// Get PDF meta.
				$pdf_meta = gform_get_meta( $args['entry']['id'], 'fillablepdfs_' . $pdf_id );

				// Display link.
				printf(
					'<li><a href="%s">%s</a></li>',
					esc_url( $this->build_pdf_url( $pdf_meta, false ) ),
					esc_html( $pdf_meta['file_name'] )
				);

			}

			echo '</ul>';

		}

		// Prepare regenerate PDFs URL.
		$url = add_query_arg( [ 'fillablepdfs' => 'regenerate', 'lid' => $args['entry']['id'] ] );

		// Display button.
		printf(
			'<p><a href="%s" class="button">%s</a></p>',
			esc_url( $url ),
			esc_html__( 'Regenerate PDFs', 'forgravity_fillablepdfs' )
		);

	}

	/**
	 * Regenerate PDFs on the entry detail page.
	 *
	 * @since  2.0
	 */
	public function maybe_regenerate_pdfs() {

		// If we're not on the entry view page, return.
		if ( rgget( 'page' ) !== 'gf_entries' || rgget( 'view' ) !== 'entry' || rgget( 'fillablepdfs' ) !== 'regenerate' ) {
			return;
		}

		// Get the current form and entry.
		$form  = GFAPI::get_form( rgget( 'id' ) );
		$entry = $this->get_current_entry();

		// Process feeds.
		$this->maybe_process_feed( $entry, $form );

	}





	// # MERGE TAGS ----------------------------------------------------------------------------------------------------

	/**
	 * Add Fillable PDFs merge tags.
	 *
	 * @since  1.0
	 *
	 * @param array $form The form object.
	 *
	 * @return array
	 */
	public function add_merge_tags( $form ) {

		// If the header has already been output, add merge tags script in the footer.
		if ( ! did_action( 'admin_head' ) ) {
			add_action( 'admin_footer', [ $this, 'add_merge_tags_footer' ] );
			return $form;
		}

		?>

        <script type="text/javascript">

			( function ( $ ) {

				var FG_FillablePDFs_MergeTags = <?php echo json_encode( $this->get_merge_tags( $form ) ); ?>;

				if ( window.gform ) {

					gform.addFilter( 'gform_merge_tags', function ( mergeTags, elementId, hideAllFields, excludeFieldTypes, isPrepop, option ) {

						mergeTags[ 'fg_fillablepdfs' ] = {
							label: '<?php _e( 'Fillable PDFs', 'forgravity_fillablepdfs' ); ?>',
							tags:  []
						};

						for ( var i = 0; i < FG_FillablePDFs_MergeTags.length; i ++ ) {
							mergeTags[ 'fg_fillablepdfs' ].tags.push( {
								tag:   FG_FillablePDFs_MergeTags[ i ].tag,
								label: FG_FillablePDFs_MergeTags[ i ].label
							} );
						}

						return mergeTags;

					} );

				}

			} )( jQuery );

        </script>

		<?php
		return $form;

	}

	/**
	 * Add Fillable PDFs merge tags in admin footer.
	 *
	 * @since  1.0
	 */
	public function add_merge_tags_footer() {

		// Get current form.
		$form = $this->get_current_form();

		// If form was found, include merge tags script.
		if ( $form ) {
			$this->add_merge_tags( $form );
		}

	}

	/**
	 * Get Fillable PDFs merge tags for form.
	 *
	 * @since  1.0
	 *
	 * @param array $form The form object.
	 *
	 * @return array
	 */
	public function get_merge_tags( $form ) {

		// Initialize merge tags array.
		$merge_tags = [];

		// Get feeds for form.
		$feeds = $this->get_active_feeds( $form['id'] );

		// Loop through feeds.
		foreach ( $feeds as $feed ) {

			// Add base merge tag.
			$merge_tags[] = [
				'tag'   => sprintf( '{%s:%s}', 'fillable_pdfs', $feed['id'] ),
				'label' => $feed['meta']['feedName'],
			];

			// Add file name merge tag.
			$merge_tags[] = [
				'tag'   => sprintf( '{%s:%s:%s}', 'fillable_pdfs', $feed['id'], 'name' ),
				'label' => sprintf( '%s (%s)', $feed['meta']['feedName'], esc_html__( 'File Name', 'forgravity_fillablepdfs' ) ),
			];

			// Add file URL merge tag.
			$merge_tags[] = [
				'tag'   => sprintf( '{%s:%s:%s}', 'fillable_pdfs', $feed['id'], 'url' ),
				'label' => sprintf( '%s (%s)', $feed['meta']['feedName'], esc_html__( 'File URL', 'forgravity_fillablepdfs' ) ),
			];

		}

		return $merge_tags;

	}

	/**
	 * Replace Fillable PDFs merge tags.
	 *
	 * @since  1.0
	 *
	 * @param string $text  The current text in which merge tags are being replaced.
	 * @param array  $form  The current form.
	 * @param array  $entry The current entry.
	 *
	 * @return string
	 */
	public function replace_merge_tags( $text, $form, $entry ) {

		// If text does not contain any merge tags, return.
		if ( ( strpos( strtolower( $text ), '{fillable_pdfs:' ) === false && strpos( strtolower( $text ), '{fillable pdfs:' ) === false ) || ! rgar( $entry, 'id' ) ) {
			return $text;
		}

		// Get PDF IDs for entry.
		$pdf_ids = gform_get_meta( $entry['id'], 'fillablepdfs' );

		// Initialize array to store PDF meta.
		$pdf_meta_cache = [];

		// Search for merge tags in text.
		preg_match_all( '/{[^{]*?:(\d+)(:([^:]*?))?(:([^:]*?))?(:url)?}/mi', $text, $matches, PREG_SET_ORDER );

		// Loop through matches.
		foreach ( $matches as $match ) {

			// Get parts.
			$merge_tag = $match[0];
			$feed_id   = rgar( $match, 1 );
			$modifier  = rgar( $match, 3 );

			// If this is not a PDF merge tag, skip it.
			if ( strpos( strtolower( $merge_tag ), '{fillable_pdfs:' ) !== 0 && strpos( strtolower( $merge_tag ), '{fillable pdfs:' ) !== 0 ) {
				continue;
			}

			// Determine if this is the legacy merge tags.
			$is_legacy = strpos( strtolower( $merge_tag ), '{fillable pdfs:' ) !== false;

			// Get PDF ID for merge tag.
			$pdf_id = rgar( $pdf_ids, $feed_id );

			// If no PDF exists for this feed, replace with empty string.
			if ( empty( $pdf_id ) ) {
			    $text = str_replace( $merge_tag, '', $text );
				continue;
			}

			// Cache PDF meta if not already stored.
			if ( ! isset( $pdf_meta_cache[ $pdf_id ] ) ) {
				$pdf_meta_cache[ $pdf_id ] = gform_get_meta( $entry['id'], 'fillablepdfs_' . $pdf_id );
			}

			// Get PDF meta.
			$pdf_meta = $pdf_meta_cache[ $pdf_id ];

			// Build replacement.
			switch ( $modifier ) {

				case 'name':
					$replacement = esc_html( $pdf_meta['file_name'] );
					break;

				case 'url':
					$replacement = esc_url( $this->build_pdf_url( $pdf_meta, $is_legacy ) );
					break;

				case 'url_signed':
					$replacement = esc_url( $this->build_pdf_url( $pdf_meta, true ) );
					break;

				default:
					$replacement = sprintf(
						'<a href="%s">%s</a>',
						esc_url( $this->build_pdf_url( $pdf_meta, $is_legacy ) ),
						esc_html( $pdf_meta['file_name'] )
					);
					break;

			}

			// Replace merge tag.
			$text = str_replace( $merge_tag, $replacement, $text );

		}

		return $text;

	}





	// # PERSONAL DATA -------------------------------------------------------------------------------------------------

	/**
	 * Register Fillable PDFs as a personal data item.
	 *
	 * @since  2.0
	 *
	 * @param array $items An associative array with the field id as the key and the value as the label.
	 * @param array $form  The current Form object.
	 *
	 * @return array
	 */
	public function filter_gform_personal_data( $items, $form ) {

	    // Get feeds for form.
        $feeds = $this->get_feeds( $form['id'] );

        // If form has no feeds, return.
        if ( empty( $feeds ) ) {
            return $items;
        }

		// Add Fillable PDFs item.
		$items['forgravity_fillablepdfs'] = [
			'label'             => esc_html__( 'Fillable PDFs', 'forgravity_fillablepdfs' ),
			'exporter_callback' => [ $this, 'export_personal_data' ],
			'eraser_callback'   => [ $this, 'erase_personal_data' ],
		];

	    return $items;

    }

	/**
	 * Export Fillable PDFs for entry.
	 *
	 * @since  2.0
	 *
	 * @param array $form  The current Form object.
	 * @param array $entry The current Entry object.
	 *
	 * @return null|array
	 */
	public function export_personal_data( $form, $entry ) {

		// Get PDFs for form.
		$pdf_ids = gform_get_meta( $entry['id'], 'fillablepdfs' );

		// If no PDFs were found for entry, continue.
		if ( ! $pdf_ids ) {
			return null;
		}

		// Initialize PDF URLs array.
		$pdf_urls = [];

		// Get PDF URLs from meta.
		foreach ( $pdf_ids as $pdf_id ) {

			// Get PDF meta.
			$pdf_meta = gform_get_meta( $entry['id'], 'fillablepdfs_' . $pdf_id );

			// Build URL.
			$pdf_urls[] = $this->build_pdf_url( $pdf_meta, true );

		}

		return [
			'name'  => esc_html__( 'Generated PDFs', 'forgravity_fillablepdfs' ),
			'value' => implode( '<br />', $pdf_urls ),
		];

	}

	/**
	 * Delete Fillable PDFs from entry.
	 *
	 * @since  2.0
	 *
	 * @param array $form  The current Form object.
	 * @param array $entry The current Entry object.
	 */
	public function erase_personal_data( $form, $entry ) {

		// Get PDFs for form.
		$pdf_ids = gform_get_meta( $entry['id'], 'fillablepdfs' );

		// If no PDFs were found for entry, continue.
		if ( ! $pdf_ids ) {
			return;
		}

		// Delete PDFs.
		foreach ( $pdf_ids as $pdf_id ) {

			// Get PDF meta.
			$pdf_meta = gform_get_meta( $entry['id'], 'fillablepdfs_' . $pdf_id );

			// Get file path.
			$file_path = $this->get_physical_file_path( $pdf_meta );

			// Delete file.
			if ( file_exists( $file_path ) ) {
				unlink( $file_path );
			}

			// Delete PDF meta.
			gform_delete_meta( $entry['id'], 'fillablepdfs_' . $pdf_id );

		}

		// Delete PDF meta for entry.
		gform_delete_meta( $entry['id'], 'fillablepdfs' );

	}





	// # INTEGRATIONS --------------------------------------------------------------------------------------------------

	/**
	 * Get available GFChart charts for mapper.
	 *
	 * @since 2.3
	 *
	 * @return array
	 */
	private static function get_gfchart_charts() {

		// If GFCharts API does not exist, return.
		if ( ! class_exists( '\GFChart_API' ) ) {
			return [];
		}

		// Get charts.
		$charts = GFChart_API::get_charts();

		// If no charts exist, return.
		if ( empty( $charts ) ) {
			return $charts;
		}

		// Remove unnecessary data.
		$charts = array_map(
			function( $chart ) {
				return [ 'id' => rgobj( $chart, 'ID' ), 'title' => rgobj( $chart, 'post_title' ) ];
			},
			$charts
		);

		return $charts;

	}

	/**
	 * Get image URL for GFChart embed.
	 *
	 * @since 2.3
	 *
	 * @param int $chart_id Chart ID.
	 *
	 * @return string|null
	 */
	private static function get_gfchart_image_chart_url( $chart_id ) {

		global $gfp_gfchart_image_charts;

		// If GFChart Image Charts plugin is not active, return.
		if ( ! is_object( $gfp_gfchart_image_charts ) ) {
			fg_fillablepdfs()->log_debug( __METHOD__ . '(): GFChart Image Charts plugin is unavailable; skipping field.' );
			return null;
		}

		// Enable image chart generation.
		$gfp_gfchart_image_charts->_doing_notification_message = true;

		// Get shortcode response.
		$shortcode_response = do_shortcode( sprintf( '[gfchart id="%d"]', $chart_id ) );

		// If image tag was not found, return.
		if ( preg_match( '/<img src="(.*)" style="(.*)" \/>/', $shortcode_response, $matches ) !== 1 ) {
			return null;
		}

		return rgar( $matches, 1 );

	}






	// # HELPER METHODS ------------------------------------------------------------------------------------------------

	/**
	 * Initializes Fillable PDFs API if credentials are valid.
	 *
	 * @since  1.0
	 *
	 * @param string $license_key License key.
	 *
	 * @return bool|null
	 */
	public function initialize_api( $license_key = null ) {

		// If API is already initialized and license key is not provided, return true.
		if ( ! is_null( $this->api ) && is_null( $license_key ) ) {
			return true;
		}

		// Load the API library.
		if ( ! class_exists( '\ForGravity\FillablePDFs\API' ) ) {
			require_once( 'includes/class-api.php' );
		}

		// Get the license key.
		if ( rgblank( $license_key ) ) {
			$license_key = $this->get_plugin_setting( 'license_key' );
		}

		// If the license key is empty, do not run a validation check.
		if ( rgblank( $license_key ) ) {
			return null;
		}

		// Log validation step.
		$this->log_debug( __METHOD__ . '(): Validating API Info.' );

		// Setup a new Fillable PDFs API object with the API credentials.
		$api = new FillablePDFs\API( $license_key );

		try {

			// Get license info.
			$api->get_license_info();

			// Assign API library to instance.
			$this->api = $api;

			// Log that authentication test passed.
			$this->log_debug( __METHOD__ . '(): API credentials are valid.' );

			return true;

		} catch ( Exception $e ) {

			// Log that authentication test failed.
			$this->log_error( __METHOD__ . '(): API credentials are invalid; ' . $e->getMessage() );

			return false;

		}

	}

	/**
	 * Build public PDF URL.
	 *
	 * @since  1.0
	 *
	 * @param array $pdf_meta PDF metadata.
	 * @param bool  $token    Include token with URL.
	 *
	 * @return string
	 */
	public function build_pdf_url( $pdf_meta, $token = false ) {

		// Prepare query arguments.
		$args = [ 'fgpdf' => $pdf_meta['pdf_id'] ];

		// Include token.
		if ( rgar( $pdf_meta, 'access' ) === 'token' || ( rgar( $pdf_meta, 'access' ) !== 'token' && $token ) ) {
			$args['token'] = $pdf_meta['token'];
		}

		return add_query_arg(
			$args,
			home_url()
		);

	}

	/**
	 * Helper function to get current entry.
	 *
	 * @since  2.0
	 *
	 * @return array $entry
	 */
	public function get_current_entry() {

		if ( $this->is_gravityforms_supported( '2.0-beta-3' ) ) {

			if ( ! class_exists( '\GFEntryDetail' ) ) {
				require_once( GFCommon::get_base_path() . '/entry_detail.php' );
			}

			return GFEntryDetail::get_current_entry();

		} else {

			$entry_id = rgpost( 'entry_id' ) ? absint( rgpost( 'entry_id' ) ) : absint( rgget( 'lid' ) );

			if ( $entry_id > 0 ) {

				return GFAPI::get_entry( $entry_id );

			} else {

				$position = rgget( 'pos' ) ? rgget( 'pos' ) : 0;
				$paging   = [ 'offset' => $position, 'page_size' => 1 ];
				$entries  = GFAPI::get_entries( rgget( 'id' ), [], null, $paging );

				return $entries[0];

			}

		}

	}

	/**
	 * Get entry for PDF.
	 *
	 * @since  2.4
	 *
	 * @param string|array $pdf_id PDF ID or metadata.
	 *
	 * @return array|false
	 */
	public function get_entry_for_pdf( $pdf_id ) {

		global $wpdb;

		// Get PDF ID from metadata.
		if ( is_array( $pdf_id ) ) {
			$pdf_id = rgar( $pdf_id, 'pdf_id' );
		}

		// Get PDF meta based on Gravity Forms database version.
		if ( version_compare( fg_fillablepdfs()->get_gravityforms_db_version(), '2.3-dev-1', '<' ) ) {

			// Get entry meta table name.
			$table_name = GFFormsModel::get_lead_meta_table_name();

			// Get entry ID.
			$entry_id = $wpdb->get_var(
				$wpdb->prepare(
					"SELECT lead_id FROM {$table_name} WHERE `meta_key` = '%s'",
					'fillablepdfs_' . $pdf_id
				)
			);

		} else {

			// Get entry meta table name.
			$table_name = GFFormsModel::get_entry_meta_table_name();

			// Get entry ID.
			$entry_id = $wpdb->get_var(
				$wpdb->prepare(
					"SELECT entry_id FROM {$table_name} WHERE `meta_key` = '%s'",
					'fillablepdfs_' . $pdf_id
				)
			);

		}

		// If entry could not be found, return.
		if ( ! $entry_id ) {
			return false;
		}

		// Get entry.
		$entry = GFAPI::get_entry( $entry_id );

		return is_wp_error( $entry ) ? false : $entry;

	}

	/**
	 * Get entry meta options for form.
	 *
	 * @since  1.1
	 *
	 * @param array|bool $form Form object.
	 *
	 * @return array
	 */
	public function get_entry_meta_options( $form = false ) {

		// If form was not provided, get current form.
		if ( ! $form ) {
			$form = $this->get_current_form();
		}

		// Initialize meta array.
		$meta = [
			[
				'value' => 'id',
				'label' => esc_html__( 'Entry ID', 'forgravity_easypassthrough' ),
			],
			[
				'value' => 'date_created',
				'label' => esc_html__( 'Entry Date', 'forgravity_easypassthrough' ),
			],
			[
				'value' => 'ip',
				'label' => esc_html__( 'User IP', 'forgravity_easypassthrough' ),
			],
			[
				'value' => 'source_url',
				'label' => esc_html__( 'Source Url', 'forgravity_easypassthrough' ),
			],
			[
				'value' => 'form_title',
				'label' => esc_html__( 'Form Title', 'forgravity_easypassthrough' ),
			],
			[
				'value' => 'payment_status',
				'label' => esc_html__( 'Payment Status', 'forgravity_easypassthrough' ),
			],
			[
				'value' => 'transaction_id',
				'label' => esc_html__( 'Transaction Id', 'forgravity_easypassthrough' ),
			],
			[
				'value' => 'payment_date',
				'label' => esc_html__( 'Payment Date', 'forgravity_easypassthrough' ),
			],
			[
				'value' => 'payment_amount',
				'label' => esc_html__( 'Payment Amount', 'forgravity_easypassthrough' ),
			],
			[
				'value' => 'payment_gateway',
				'label' => esc_html__( 'Payment Gateway', 'forgravity_easypassthrough' ),
			],
		];

		// Get entry meta fields for form.
		$form_meta = GFFormsModel::get_entry_meta( $form['id'] );

		// Add entry meta to meta map.
		foreach ( $form_meta as $meta_key => $m ) {
			$meta[] = [
				'value' => $meta_key,
				'label' => rgars( $form_meta, "{$meta_key}/label" ),
			];
		}

		return $meta;

	}

	/**
	 * Returns a collection of PDF meta for the entry.
	 *
	 * @since 2.3
	 *
	 * @param array $entry Entry object.
	 *
	 * @return array
	 */
	public function get_entry_pdfs( $entry = array() ) {

		// If Entry ID was provided, get full entry.
		if ( ! is_array( $entry ) && is_numeric( $entry ) ) {
			$entry = GFAPI::get_entry( $entry );
		}

		// Initialize PDF meta array.
		$pdf_meta = [];

		// Get PDF meta IDs for entry.
		$ids = gform_get_meta( $entry['id'], 'fillablepdfs' );

		// If entry does not have any PDFs, return.
		if ( ! $ids ) {
			return $pdf_meta;
		}

		// Loop through PDF meta IDs, get PDF meta.
		foreach ( $ids as $id ) {

			// Get meta.
			$meta = gform_get_meta( $entry['id'], 'fillablepdfs_' . $id );

			// If meta was not found, skip.
			if ( ! $meta ) {
				continue;
			}

			// Add creation date.
			if ( ! rgar( $meta, 'date_created' ) ) {
				$meta['date_created'] = rgar( $entry, 'date_created' );
			}

			// Convert creation date to timestamp.
			$meta['date_created'] = strtotime( $meta['date_created'] );

			// Add entry, form IDs to meta.
			$meta['entry_id'] = $entry['id'];
			$meta['form_id']  = $entry['form_id'];

			// Add to PDF meta array.
			$pdf_meta[ $id ] = $meta;

		}

		return $pdf_meta;

	}

	/**
	 * Get the physical file path for a generated PDF.
	 *
	 * @since 2.4
	 *
	 * @param array $pdf_meta PDF metadata.
	 *
	 * @return string
	 */
	public function get_physical_file_path( $pdf_meta ) {

		// If legacy file path is set, return.
		if ( rgar( $pdf_meta, 'file_path' ) ) {
			return $pdf_meta['file_path'];
		}

		// Get form ID, entry.
		$entry   = $this->get_entry_for_pdf( $pdf_meta );
		$form_id = rgar( $entry, 'form_id' );

		return $this->generate_physical_file_path( $form_id, $pdf_meta['physical_file_name'], $entry, false );

	}

	/**
	 * Get upload path for file.
	 *
	 * @since  1.0
	 *
	 * @param int    $form_id   Form ID.
	 * @param string $file_name File name.
	 * @param array  $entry     The current Entry object.
	 * @param bool   $unique    Use a unique file name.
	 *
	 * @return string
	 */
	public function generate_physical_file_path( $form_id, $file_name, $entry = [], $unique = true ) {

		if ( version_compare( phpversion(), '7.4', '<' ) && get_magic_quotes_gpc() ) {
			$file_name = stripslashes( $file_name );
		}

		// Generate target folder.
		$form_id     = absint( $form_id );
		$time        = ! empty( $entry ) ? date( 'Y-m-d H:i:s', strtotime( rgar( $entry, 'date_created' ) ) ) : current_time( 'mysql' );
		$y           = substr( $time, 0, 4 );
		$m           = substr( $time, 5, 2 );
		$base_path   = self::get_base_pdf_path();
		$form_path   = self::get_form_pdf_path( $form_id );
		$target_root = sprintf( '%s/%s/%s/', untrailingslashit( $form_path ), $y, $m );

		// Ensure base path has .htaccess file.
		if ( ! file_exists( $base_path . '.htaccess' ) ) {

			// Include GFExport.
			if ( ! class_exists( 'GFExport' ) ) {
				require_once( GFCommon::get_base_path() . '/export.php' );
			}

			// Add .htaccess file.
			GFExport::maybe_create_htaccess_file( $base_path );

		}

		// If target folder does not exist, create it.
		if ( ! is_dir( $target_root ) ) {

			// Log that we could not create the target folder.
			if ( ! wp_mkdir_p( $target_root ) ) {
				$this->log_error( __METHOD__ . '(): Unable to create folder "' . $target_root . '".' );
				return false;
			}

			// Adding index.html files to all sub-folders.
			if ( ! file_exists( $base_path . '/index.html' ) ) {
				GFCommon::recursive_add_index_file( $base_path );
			} else if ( ! file_exists( $form_path . 'index.html' ) ) {
				GFCommon::recursive_add_index_file( $form_path );
			} else if ( ! file_exists( $form_path . $y . '/index.html' ) ) {
				GFCommon::recursive_add_index_file( $form_path . $y );
			} else {
				GFCommon::recursive_add_index_file( $form_path . "$y/$m" );
			}

		}

		// Add the original filename to our target path.
		// Result is "uploads/filename.extension".
		$file_info = pathinfo( $file_name );
		$extension = rgar( $file_info, 'extension' );
		if ( ! empty( $extension ) ) {
			$extension = '.' . $extension;
		}
		$file_name = basename( $file_info['basename'], $extension );
		$file_name = sanitize_file_name( $file_name );

		$counter     = 1;
		$target_path = $target_root . $file_name . $extension;

		if ( $unique ) {
			while ( file_exists( $target_path ) ) {
				$target_path = $target_root . $file_name . "$counter" . $extension;
				$counter++;
			}
		}

		// Remove '.' from the end if file does not have a file extension
		$target_path = trim( $target_path, '.' );

		return $target_path;

	}

	/**
	 * Get upload path for form ID.
	 *
	 * @since  1.0
	 * @since  2.3 Renamed from get_upload_path()
	 *
	 * @param int $form_id Form ID.
	 *
	 * @return string
	 */
	public static function get_form_pdf_path( $form_id ) {

		// Get form folder name.
		$form_id          = absint( $form_id );
		$form_folder_name = sprintf( '%d-%s', $form_id, wp_hash( $form_id ) );

		// Get base path.
		$base_path = trailingslashit( self::get_base_pdf_path() );

		/**
		 * Modify the folder where generated PDFs are stored for a form.
		 *
		 * @since 2.3
		 *
		 * @param string $form_path Path to base folder.
		 * @param int    $form_id   The Form ID.
		 */
		$form_path = gf_apply_filters( [ 'fg_fillablepdfs_form_path', $form_id ], trailingslashit( $base_path . $form_folder_name ), $form_id );

		return trailingslashit( $form_path );

	}

	/**
	 * The base folder path where generated PDFs are stored.
	 *
	 * @since 2.3
	 *
	 * @return string
	 */
	public static function get_base_pdf_path() {

		/**
		 * Modify the base folder where generated PDFs are stored.
		 *
		 * @since 2.3
		 *
		 * @param string $base_path Path to base folder.
		 */
		$base_path = apply_filters( 'fg_fillablepdfs_base_path', trailingslashit( GFFormsModel::get_upload_root() . 'fillablepdfs' ) );

		return trailingslashit( $base_path );

	}

	/**
	 * Get Gravity Forms database version number.
	 *
	 * @since  1.0.4
	 *
	 * @return string
	 */
	public static function get_gravityforms_db_version() {

		if ( method_exists( 'GFFormsModel', 'get_database_version' ) ) {
			$db_version = GFFormsModel::get_database_version();
		} else {
			$db_version = GFForms::$version;
		}

		return $db_version;

	}

	/**
	 * Remove field mapping when field is deleted.
	 *
	 * @since 2.0.5
	 *
	 * @param int    $form_id  Form ID.
	 * @param string $field_id Field being deleted.
	 */
	public function action_gform_after_delete_field( $form_id, $field_id ) {

		// Get Fillable PDFs feeds for form.
		$feeds = $this->get_feeds( $form_id );

		// If no feeds were found, exit.
		if ( ! $feeds ) {
			return;
		}

		// Loop through feeds, unmap field.
		foreach ( $feeds as $feed ) {

			// Initialize update meta flag.
			$update_meta = false;

			// Loop through field map, remove mapped field.
			foreach ( $feed['meta']['fieldMap'] as $i => $mapping ) {

				// If this is not the field being deleted, skip.
				if ( $field_id != $mapping['field'] ) {
					continue;
				}

				// Remove mapping.
				unset( $feed['meta']['fieldMap'][ $i ] );
				$update_meta = true;

			}

			// Update feed meta.
			if ( $update_meta ) {
				$this->update_feed_meta( $feed['id'], $feed['meta'] );
			}

		}

	}





	// # IMPORT / EXPORT -----------------------------------------------------------------------------------------------

	/**
	 * Imports feeds attached to form object.
	 *
	 * @since 2.3
	 *
	 * @param array $forms The forms being imported.
	 */
	public function action_gform_forms_post_import( $forms ) {

		// Loop through forms, import feeds.
		foreach ( $forms as $form ) {

			// If no feeds are found for form, skip.
			if ( ! rgars( $form, 'feeds/' . $this->_slug ) ) {
				continue;
			}

			// Loop through feeds, import.
			foreach ( $form['feeds'][ $this->_slug ] as $feed ) {

				// Import feed.
				$old_feed_id = rgar( $feed, 'id' );
				$new_feed_id = GFAPI::add_feed( $form['id'], $feed['meta'], $this->_slug );

				// Disable feed, if necessary.
				if ( ! is_wp_error( $new_feed_id ) && ! $feed['is_active'] ) {
					$this->update_feed_active( $new_feed_id, false );
				}

				// Replace merge tags.
				if ( ! is_wp_error( $new_feed_id ) ) {
					$form['confirmations'] = $this->update_import_merge_tags( $form['confirmations'], $old_feed_id, $new_feed_id );
					$form['notifications'] = $this->update_import_merge_tags( $form['notifications'], $old_feed_id, $new_feed_id );
				}

			}

			// Remove Add-On feeds from form object.
			unset( $form['feeds'][ $this->_slug ] );

			// If form has no other feeds to import, remove feeds array.
			if ( empty( $form['feeds'] ) ) {
				unset( $form['feeds'] );
			}

			// Save form object.
			GFAPI::update_form( $form );

		}

	}

	/**
	 * Update feed IDs in merge tags when importing form.
	 *
	 * @since 2.3
	 *
	 * @param array $objects     Collection of confirmations or notifications.
	 * @param int   $old_feed_id Old feed ID.
	 * @param int   $new_feed_id New feed ID.
	 *
	 * @return array
	 */
	private function update_import_merge_tags( $objects, $old_feed_id, $new_feed_id ) {

		// Loop through objects, update message.
		foreach ( $objects as &$object ) {

			// Search for merge tags in text.
			preg_match_all( '/{[^{]*?:(\d+)(:([^:]*?))?(:([^:]*?))?(:url)?}/mi', $object['message'], $matches, PREG_SET_ORDER );

			// Loop through matches, replace merge tag.
			foreach ( $matches as $match ) {

				// Get parts.
				$merge_tag = $match[0];
				$feed_id   = rgar( $match, 1 );

				// If this is not a PDF merge tag, skip it.
				if ( strpos( strtolower( $merge_tag ), '{fillable pdfs:' ) !== 0 ) {
					continue;
				}

				// If this is not the feed being imported, skip it.
				if ( intval( $feed_id ) !== intval( $old_feed_id ) ) {
					continue;
				}

				// Replace merge tag.
				$new_merge_tag     = str_replace( $old_feed_id, $new_feed_id, $merge_tag );
				$object['message'] = str_replace( $merge_tag, $new_merge_tag, $object['message'] );

			}

		}

		return $objects;

	}

	/**
	 * Add feeds to form object before exporting.
	 *
	 * @since 2.3
	 *
	 * @param array $form The form being exported.
	 *
	 * @return array
	 */
	public function filter_gform_export_form( $form ) {

		// Get feeds for form.
		$feeds = $this->get_feeds( $form['id'] );

		// If feeds array does not exist for object, add it.
		if ( ! isset( $form['feeds'] ) ) {
			$form['feeds'] = [];
		}

		// Add feeds to form.
		$form['feeds'][ $this->_slug ] = $feeds;

		return $form;

	}





	// # PUBLIC ACCESS DETECTION ---------------------------------------------------------------------------------------

	/**
	 * Determines whether the generated PDFs folder is accessible to the public.
	 *
	 * @since 2.3
	 *
	 * @return bool
	 */
	public function is_base_pdf_path_public() {

		// Get PDFs folder.
		$folder = self::get_base_pdf_path();

		// Generate test file.
		$file_name     = wp_hash( uniqid( $this->get_slug() ) ) . '.txt';
		$file_path     = trailingslashit( $folder ) . $file_name;
		$file_contents = wp_hash( uniqid( $this->get_slug() ) );
		file_put_contents( $file_path, $file_contents );

		// IF file does not exist, return.
		if ( ! is_file( $file_path ) ) {
			$this->log_error( __METHOD__ . '(): Unable to create test file.' );
			return false;
		}

		// Set public file flag.
		$public = false;

		// Get file URL.
		$file_url = self::convert_path_to_url( $file_path );

		// If file URL could be obtained, test it.
		if ( $file_url ) {

			// Attempt to get file.
			$request = wp_remote_get( $file_url );

			// If file could not be retrieved, log and set public flag.
			if ( ! is_wp_error( $request ) && wp_remote_retrieve_response_code( $request ) === 200 && wp_remote_retrieve_body( $request ) === $file_contents ) {
				$this->log_debug( __METHOD__ . '(): Generated PDF files are publicly accessible.' );
				$public = true;
			}

		}

		// Delete test file.
		@unlink( $file_path );

		return $public;

	}

	/**
	 * Attempt to convert a local path to a publicly accessible URL.
	 * (Credit: GravityPDF)
	 *
	 * @since 2.3
	 *
	 * @param string $path Path to file.
	 *
	 * @return bool|string
	 */
	private static function convert_path_to_url( $path ) {

		// Trim the path.
		$path = trim( $path );

		// If URL is not provided, return.
		if ( empty( $path ) ) {
			return false;
		}

		// Get the upload directory, prepare URL.
		$upload_dir = wp_upload_dir();
		$url        = str_replace( $upload_dir['basedir'], $upload_dir['baseurl'], $path );

		// If path was converted to URL, return.
		if ( $url !== $path && filter_var( $url, FILTER_VALIDATE_URL ) ) {
			return $url;
		}

		// Attempt to replace using defined constants.
		if ( defined( 'WP_CONTENT_DIR' ) && defined( 'WP_CONTENT_URL' ) ) {

			// Replace with defined constants.
			$url = str_replace( WP_CONTENT_DIR, WP_CONTENT_URL, $path );

			// If path was converted to URL, return.
			if ( $url !== $path && filter_var( $url, FILTER_VALIDATE_URL ) ) {
				return $url;
			}

		}

		/**
		 * Attempt to replace with get_home_path().
		 * Include the function first.
		 */
		if ( ! function_exists( 'get_home_path' ) ) {
			require_once ABSPATH . 'wp-admin/includes/file.php';
		}

		// Replace with get_home_path().
		$url = str_replace( get_home_path(), home_url(), $path );

		// If path was converted to URL, return.
		if ( $url !== $path && filter_var( $url, FILTER_VALIDATE_URL ) ) {
			return $url;
		}

		// Attempt to replace with site_url().
		$url = str_replace( ABSPATH, site_url(), $path );

		// If path was converted to URL, return.
		if ( $url !== $path && filter_var( $url, FILTER_VALIDATE_URL ) ) {
			return $url;
		}

		return false;

	}

	/**
	 * Check if generated PDFs folder is accessible to public and display admin message.
	 *
	 * @since 2.3
	 */
	public function check_base_pdf_path_public() {

		// If base PDF path is not public, return.
		if ( ! $this->is_base_pdf_path_public() ) {
			return;
		}

		// Prepare message. @todo Update links.
		$message = sprintf(
			esc_html__( 'Your generated PDFs folder is publicly accessible. This could allow anyone to view your PDFs. %sClick here to learn how to make this folder private.%s', 'forgravity_fillabepdfs' ),
			'<a href="https://forgravity.com/documentation/fillable-pdfs/protecting-your-pdfs/">',
			'</a>'
		);

		// Display message.
		GFCommon::add_dismissible_message(
			$message,
			'fillablepdfs_pdf_path_warning_' . date( 'Y' ) . date( 'z' ),
			'error',
			$this->_capabilities_settings_page,
			true
		);

	}

	/**
	 * Add weekly schedule to cron schedules.
	 *
	 * @since 2.3
	 *
	 * @param array $schedules An array of non-default cron schedules.
	 *
	 * @return array
	 */
	public function filter_cron_schedules( $schedules ) {

		$schedules['fg_fillablepdfs_weekly'] = [
			'display'  => __( 'Once Weekly', 'forgravity_fillablepdfs' ),
			'interval' => 604800,
		];

		return $schedules;

	}

	/**
	 * Clear scheduled events.
	 *
	 * @since 2.3
	 */
	public static function clear_scheduled_events() {

		// Clear scheduled action.
		if ( wp_next_scheduled( FG_FILLABLEPDFS_PATH_CHECK_ACTION ) ) {
			wp_clear_scheduled_hook( FG_FILLABLEPDFS_PATH_CHECK_ACTION );
		}

	}





	// # SYSTEM REPORT -------------------------------------------------------------------------------------------------

	/**
	 * Add Fillable PDFs section to Gravity Forms System Report.
	 *
	 * @since 2.3
	 *
	 * @param array $system_report An array of default sections displayed on the System Status page.
	 *
	 * @return array
	 */
	public function filter_gform_system_report( $system_report = [] ) {

		// Get title_export, target section key.
		$title_export   = wp_list_pluck( $system_report, 'title_export' );
		$gf_section_key = array_search( 'Gravity Forms Environment', $title_export );

		// Determine if base PDF path is public.
		$is_base_pdf_path_public = $this->is_base_pdf_path_public();

		// Add Fillable PDFs section.
		$system_report[ $gf_section_key ]['tables'][] = [
			'title'        => esc_html__( 'Fillable PDFs', 'forgravity_fillablepdfs' ),
			'title_export' => 'Fillable PDFs',
			'items'        => [
				[
					'label'        => esc_html__( 'Base PDFs Path Public', 'forgravity_fillablepdfs' ),
					'label_export' => 'Base PDFs Path Public',
					'value'        => $is_base_pdf_path_public ? __( 'Yes', 'forgravity_fillablepdfs' ) : __( 'No', 'forgravity_fillablepdfs' ),
					'value_export' => $is_base_pdf_path_public ? 'Yes' : 'No',
					'is_valid'     => ! $is_base_pdf_path_public,
				],
			],
		];

		return $system_report;

	}





	// # UPGRADE ROUTINES ----------------------------------------------------------------------------------------------

	/**
	 * Upgrade routines.
	 *
	 * @since  2.0
	 *
	 * @param string $previous_version Previously installed version number.
	 */
	public function upgrade( $previous_version ) {

		// Run meta upgrade.
		if ( version_compare( $previous_version, '2.0-dev-1', '<' ) ) {
			$this->upgrade_20();
		}

		// Run meta upgrade.
		if ( version_compare( $previous_version, '2.3-rc-3', '<' ) ) {
			$this->upgrade_23();
		}

		// Run security upgrade.
		if ( version_compare( $previous_version, '2.3-rc-3', '<' ) ) {

			// Get base path.
			$base_path = self::get_base_pdf_path();

			// Include GFExport.
			if ( ! class_exists( 'GFExport' ) ) {
				require_once( GFCommon::get_base_path() . '/export.php' );
			}

			// Add .htaccess file.
			GFExport::maybe_create_htaccess_file( $base_path );

		}

	}

	/**
	 * Upgrade feeds to new field mapping.
	 *
	 * @since  2.0
	 */
	public function upgrade_20() {

	    // If API cannot be initialized, return.
        if ( ! $this->initialize_api() ) {
            return;
        }

	    // Get feeds.
        $feeds = $this->get_feeds();

        // Loop through feeds.
        foreach ( $feeds as $feed ) {

            try {

                // Get template.
                $template = $this->api->get_template( $feed['meta']['templateID'] );

            } catch ( Exception $e ) {

                // Log that feed could not be migrated.
                $this->log_error( __METHOD__ . '(): Unable to migrate feed #' . $feed['id'] . ' becasuse template could not be retrieved.' );

                continue;

            }

			// Get field mapping.
            $current_mapping = rgars( $feed, 'meta/fieldMap' );

			// Initialize new field mapping array.
            $field_mapping = [];

			// Loop through old field mapping, convert to new format.
            foreach ( $current_mapping as $mapping ) {

				// Update mapping.
				$field_mapping[ $template['fields'][ $mapping['key'] ]['name'] ] = [
					'field'     => $mapping['value'],
					'value'     => '',
					'modifiers' => [],
				];

            }

            // Save new field mapping to feed.
            $feed['meta']['fieldMap'] = $field_mapping;

			// Save feed.
            $this->update_feed_meta( $feed['id'], $feed['meta'] );

		}

    }

	/**
	 * Upgrade to new security setting.
	 *
	 * @since  2.3
	 */
	public function upgrade_23() {

		// Get feeds.
		$feeds = $this->get_feeds();

		// Loop through feeds.
		foreach ( $feeds as $feed ) {

			// Set publicly accessible flag.
			if ( rgars( $feed, 'meta/downloadPermissions' ) === 'anyone' ) {
				$feed['meta']['publicAccess'] = '1';
			}

			// Remove old download permissions flag.
			unset( $feed['meta']['downloadPermissions'] );

			// Save feed.
			$this->update_feed_meta( $feed['id'], $feed['meta'] );

		}

	}





	// # PLUGIN SETTINGS -----------------------------------------------------------------------------------------------

	/**
	 * Prepare plugin settings fields.
	 *
	 * @since  1.0
	 *
	 * @return array
	 */
	public function plugin_settings_fields() {

		return [
			[
				'fields' => [
					[
						'name'          => 'background_updates',
						'label'         => esc_html__( 'Background Updates', 'forgravity_fillablepdfs' ),
						'type'          => 'radio',
						'horizontal'    => true,
						'default_value' => true,
						'choices'       => [
							[
								'label' => esc_html__( 'On', 'forgravity_fillablepdfs' ),
								'value' => true,
							],
							[
								'label' => esc_html__( 'Off', 'forgravity_fillablepdfs' ),
								'value' => false,
							],
						],
					],
					[
						'name'                => 'license_key',
						'label'               => esc_html__( 'License Key', 'forgravity_fillablepdfs' ),
						'type'                => 'text',
						'class'               => 'medium',
						'default_value'       => '',
						'error_message'       => esc_html__( 'Invalid License', 'forgravity_fillablepdfs' ),
						'feedback_callback'   => [ $this, 'license_feedback' ],
						'validation_callback' => [ $this, 'license_validation' ],
						'description'         => $this->get_license_info(),
					],
				],
			],
		];

	}

	/**
	 * Title for plugin settings page.
	 *
	 * @since  1.0
	 *
	 * @return string
	 */
	public function plugin_settings_title() {

		return esc_html__( 'Settings', 'forgravity_fillablepdfs' );

	}

	/**
	 * Get license validity for plugin settings field.
	 *
	 * @since  1.0
	 *
	 * @param string $value Plugin setting value.
	 * @param array  $field Plugin setting field.
	 *
	 * @return null|bool
	 */
	public function license_feedback( $value, $field ) {

		// If no license key is provided, return.
		if ( empty( $value ) ) {
			return null;
		}

		// Get license data.
		$license_data = $this->check_license( $value );

		// If no license data was returned or license is invalid, return false.
		if ( empty( $license_data ) || 'invalid' === $license_data->license ) {
			return false;
		} else if ( 'valid' === $license_data->license ) {
			return true;
		}

		return false;

	}

	/**
	 * Activate license on plugin settings save.
	 *
	 * @since  1.0
	 *
	 * @param array  $field         Plugin setting field.
	 * @param string $field_setting Plugin setting value.
	 */
	public function license_validation( $field, $field_setting ) {

		// Get old license.
		$old_license = $this->get_plugin_setting( 'license_key' );

		// If an old license key exists and a new license is being saved, deactivate old license.
		if ( $old_license && $field_setting != $old_license ) {

			// Deactivate license.
			$deactivate_license = $this->process_license_request( 'deactivate_license', $old_license );

			// Log response.
			$this->log_debug( __METHOD__ . '(): Deactivate license: ' . print_r( $deactivate_license, true ) );

		}

		// If field setting is empty, return.
		if ( empty( $field_setting ) ) {
			return;
		}

		// Activate license.
		$this->activate_license( $field_setting );

	}

	/**
	 * Get license info for plugin settings page.
	 *
	 * @since  1.0
	 *
	 * @return string
	 */
	public function get_license_info() {

		// Initialize HTML string.
		$html = '';

		// If API is not initialized, return.
		if ( ! $this->initialize_api() ) {
			return $html;
		}

		try {

			// Get license info.
			$license = $this->api->get_license_info();

		} catch ( Exception $e ) {

			// Log that license info could not be retrieved.
			$this->log_error( __METHOD__ . '(): Unable to retrieve license info; ' . $e->getMessage() );

			return $html;

		}

		// Add legacy license info.
		if ( $license['plan_id'] < 10 ) {

			// Display monthly usage data.
			$html .= sprintf(
				'%s: %d / %d<br />',
				esc_html__( 'Monthly Usage', 'forgravity_fillablepdfs' ),
				$license['usage']['used'] + rgars( $license, 'usage/overage/used' ),
				$license['usage']['limit']
			);

			// Display overage data.
			$html .= sprintf(
				'%s: %s<br />',
				esc_html__( 'Overage Status', 'forgravity_fillablepdfs' ),
				rgars( $license, 'usage/overage/enabled' ) ? esc_html__( 'Enabled', 'forgravity_fillablepdfs' ) : esc_html__( 'Disabled', 'forgravity_fillablepdfs' )
			);

		} else {

			// Display template count.
			$html .= sprintf(
				'%s: %d / %d<br />',
				esc_html__( 'Templates Created', 'forgravity_fillablepdfs' ),
				rgars( $license, 'templates/created' ),
				rgars( $license, 'templates/limit')
			);

		}

		// Get renewal date.
        if ( rgar( $license, 'reset_date' ) && is_string( $license['reset_date'] ) ) {
			$renewal = strtotime( $license['reset_date'] );
			$renewal = date( get_option( 'date_format' ), $renewal );
        } else if ( is_numeric( $license['expires'] ) ) {
			$renewal = date( get_option( 'date_format' ), $license['expires'] );
		} else {
            $renewal = ucwords( $license['expires'] );
        }

		// Display subscription renewal date.
		$html .= sprintf(
			'%s: %s',
			esc_html__( 'Subscription Renewal Date', 'forgravity_fillablepdfs' ),
			esc_html( $renewal )
		);

		return $html;

	}





	// # LICENSE METHODS -----------------------------------------------------------------------------------------------

	/**
	 * Activate a license key.
	 *
	 * @since  1.0
	 *
	 * @param string $license_key The license key.
	 *
	 * @return array
	 */
	public function activate_license( $license_key ) {

		// Activate license.
		$license = $this->process_license_request( 'activate_license', $license_key );

		// Clear update plugins transient.
		set_site_transient( 'update_plugins', null );

		// Delete plugin version info cache.
		$cache_key = md5( 'edd_plugin_' . sanitize_key( $this->_path ) . '_version_info' );
		delete_transient( $cache_key );

		return json_decode( wp_remote_retrieve_body( $license ) );

	}

	/**
	 * Check the status of a license key.
	 *
	 * @since  1.0
	 *
	 * @param string $license_key The license key.
	 *
	 * @return object
	 */
	public function check_license( $license_key = '' ) {

		// If license key is empty, get the plugin setting.
		if ( empty( $license_key ) ) {
			$license_key = $this->get_plugin_setting( 'license_key' );
		}

		// Perform a license check request.
		$license = $this->process_license_request( 'check_license', $license_key );

		return json_decode( wp_remote_retrieve_body( $license ) );

	}

	/**
	 * Process a request to the ForGravity store.
	 *
	 * @since  1.0
	 *
	 * @param string $action  The action to process.
	 * @param string $license The license key.
	 * @param int    $item_id The EDD item ID.
	 *
	 * @return array|WP_Error
	 */
	public function process_license_request( $action, $license, $item_id = FG_FILLABLEPDFS_EDD_ITEM_ID ) {

		// Prepare the request arguments.
		$args = [
			'method'    => 'POST',
			'timeout'   => 10,
			'sslverify' => false,
			'body'      => [
				'edd_action' => $action,
				'license'    => trim( $license ),
				'item_id'    => urlencode( $item_id ),
				'url'        => home_url(),
			],
		];

		return wp_remote_request( FG_EDD_STORE_URL, $args );

	}





	// # BACKGROUND UPDATES --------------------------------------------------------------------------------------------

	/**
	 * Determines if automatic updating should be processed.
	 *
	 * @since  Unknown
	 *
	 * @param bool   $update Whether or not to update.
	 * @param object $item   The update offer object.
	 *
	 * @return bool
	 */
	public function maybe_auto_update( $update, $item ) {

		// If this is not the Fillable PDFs Add-On, exit.
		if ( ! isset( $item->slug ) || 'fillablepdfs' !== $item->slug ) {
			return $update;
		}

		// Log that we are starting auto update.
		$this->log_debug( __METHOD__ . '(): Starting auto-update for Fillable PDFs.' );

		// Check if automatic updates are disabled.
		$auto_update_disabled = $this->is_auto_update_disabled();

		// Log automatic update disabled state.
		$this->log_debug( __METHOD__ . '(): Automatic update disabled: ' . var_export( $auto_update_disabled, true ) );

		// If automatic updates are disabled or if the installed version is the newest version or earlier, exit.
		if ( $auto_update_disabled || version_compare( $this->_version, $item->new_version, '=>' ) ) {
			$this->log_debug( __METHOD__ . '(): Aborting update.' );

			return false;
		}

		$current_major = implode( '.', array_slice( preg_split( '/[.-]/', $this->_version ), 0, 1 ) );
		$new_major     = implode( '.', array_slice( preg_split( '/[.-]/', $item->new_version ), 0, 1 ) );

		$current_branch = implode( '.', array_slice( preg_split( '/[.-]/', $this->_version ), 0, 2 ) );
		$new_branch     = implode( '.', array_slice( preg_split( '/[.-]/', $item->new_version ), 0, 2 ) );

		if ( $current_major == $new_major && $current_branch == $new_branch ) {
			$this->log_debug( __METHOD__ . '(): OK to update.' );

			return true;
		}

		$this->log_debug( __METHOD__ . '(): Skipping - not current branch.' );

		return $update;

	}

	/**
	 * Determine if automatic updates are disabled.
	 *
	 * @since  1.0
	 *
	 * @return bool
	 */
	public function is_auto_update_disabled() {

		// WordPress background updates are disabled if you do not want file changes.
		if ( defined( 'DISALLOW_FILE_MODS' ) && DISALLOW_FILE_MODS ) {
			return true;
		}

		// Do not run auto update during install.
		if ( defined( 'WP_INSTALLING' ) ) {
			return true;
		}

		// Get automatic updater disabled state.
		$wp_updates_disabled = defined( 'AUTOMATIC_UPDATER_DISABLED' ) && AUTOMATIC_UPDATER_DISABLED;
		$wp_updates_disabled = apply_filters( 'automatic_updater_disabled', $wp_updates_disabled );

		// If WordPress automatic updates are disabled, return.
		if ( $wp_updates_disabled ) {
			$this->log_debug( __METHOD__ . '(): WordPress background updates are disabled.' );

			return true;
		}

		// Get background updates plugin setting.
		$enabled = $this->get_plugin_setting( 'background_updates' );

		// Log setting.
		$this->log_debug( __METHOD__ . '(): Background updates setting: ' . var_export( $enabled, true ) );

		return $enabled;

	}

}
