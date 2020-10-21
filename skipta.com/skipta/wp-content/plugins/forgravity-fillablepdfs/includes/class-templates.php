<?php

namespace ForGravity\FillablePDFs;

use Exception;

use GFCommon;

/**
 * Fillable PDFs Templates class.
 *
 * @since     1.0
 * @package   FillablePDFs
 * @author    ForGravity
 * @copyright Copyright (c) 2017, ForGravity
 */
class Templates {

	/**
	 * Contains an instance of this class, if available.
	 *
	 * @since 1.0
	 * @var   object $_instance If available, contains an instance of this class.
	 */
	private static $_instance = null;

	/**
	 * Contains the template currently being edited.
	 *
	 * @since 2.3
	 * @var   array|bool $current_template Template being edited.
	 */
	private $current_template;

	/**
	 * Get instance of this class.
	 *
	 * @since  1.0
	 *
	 * @return Templates
	 */
	public static function get_instance() {

		if ( self::$_instance === null ) {
			self::$_instance = new self;
		}

		return self::$_instance;

	}

	/**
	 * Display templates plugin page.
	 *
	 * @since  1.0
	 */
	public function templates_page() {

		// If delete action is set, delete template(s).
		if ( rgget( 'action' ) === 'delete' || rgpost( 'action' ) === 'delete' || rgpost( 'action2' ) === 'delete' ) {

			// Delete templates.
			$this->maybe_delete_template();

			return $this->list_page();

		}

		// If a template ID is set, display edit page.
		if ( isset( $_GET['id'] ) && ! rgget( 'action' ) ) {

			return $this->edit_page();

		}

		return $this->list_page();

	}





	// # LIST TEMPLATES ------------------------------------------------------------------------------------------------

	/**
	 * Display templates list page.
	 *
	 * @since  1.0
	 */
	public function list_page() {

		?>
        <h3><span><?php echo $this->page_title(); ?></span></h3>
		<?php GFCommon::display_admin_message(); ?>
        <form id="fillablepdfs-templates" action="" method="post">
			<?php

			$table = $this->get_table();
			$table->prepare_items();
			$table->display();
			?>

            <!--Needed to save state after bulk operations-->
            <input type="hidden" value="<?php esc_attr_e( fg_fillablepdfs()->get_slug() ); ?>" name="page">
            <input type="hidden" value="<?php esc_attr_e( fg_fillablepdfs()->get_current_subview() ); ?>" name="subview">
            <input id="single_action" type="hidden" value="" name="single_action">
            <input id="single_action_argument" type="hidden" value="" name="single_action_argument">
			<?php wp_nonce_field( 'template_list', 'template_list' ) ?>
        </form>

        <script type="text/javascript">
			<?php GFCommon::gf_vars() ?>
        </script>
		<?php

	}





	// # EDIT TEMPLATE -------------------------------------------------------------------------------------------------

	/**
	 * Display template edit page.
	 *
	 * @since  2.0
	 */
	public function edit_page() {

		// Display page title.
		printf(
			'<h3><span>%s</span></h3>',
			$this->page_title()
		);

		// If API is not initialized, display configure Add-On message.
		if ( ! fg_fillablepdfs()->initialize_api() ) {

			// Display error message.
			printf(
				'<div>%s</div>',
				fg_fillablepdfs()->configure_addon_message()
			);

			return;
		}

		// Get current template.
		$template = $this->get_current_template();

		// If we are creating a new template, check template creation limit.
		if ( is_array( $template ) && empty( $template ) ) {

			try {

				// Get license info.
				$license = fg_fillablepdfs()->api->get_license_info();

			} catch ( Exception $e ) {

				// Log error.
				fg_fillablepdfs()->log_error( __METHOD__ . '(): Unable to get license info; ' . $e->getMessage() );

				esc_html_e( 'Unable to get license info.', 'forgravity_fillablepdfs' );
				return;

			}

			// Check template creation limit.
			if ( ! $license['supports']['create_templates'] ) {
				esc_html_e( 'You have reached the active templates limit.', 'forgravity_fillablepdfs' );
				return;
			}

		}

		// Save template.
		if ( fg_fillablepdfs()->is_save_postback() ) {

			$new_template = $this->maybe_save_template();

			// Set new template to template.
			if ( is_array( $new_template ) && ! empty( $new_template ) ) {
				$template = $new_template;
			}

		}

		// Set page settings to template data.
		fg_fillablepdfs()->set_settings( $template );

		// Display any defined admin messages.
		GFCommon::display_admin_message();

		// Render settings.
		fg_fillablepdfs()->render_settings( $this->settings_fields() );

	}

	/**
	 * Maybe save template.
	 *
	 * @since  1.0
	 *
	 * @return array
	 */
	public function maybe_save_template() {

		global $_gaddon_posted_settings;

		// Verify nonce.
		check_admin_referer( fg_fillablepdfs()->get_slug() . '_save_settings', '_' . fg_fillablepdfs()->get_slug() . '_save_settings_nonce' );

		// If user cannot update form settings, return.
		if ( ! fg_fillablepdfs()->current_user_can_any( 'forgravity_fillablepdfs' ) ) {
			GFCommon::add_error_message( esc_html__( "You don't have sufficient permissions to save this template.", 'forgravity_fillablepdfs' ) );
			return [];
		}

		// If API is not initialized, add error message and return.
		if ( ! fg_fillablepdfs()->initialize_api() ) {
			GFCommon::add_error_message( esc_html__( 'Unable to save template because API is not initialized.', 'forgravity_fillablepdfs' ) );
			return [];
		}

		// Get current template.
		$template = $this->get_current_template();

		// Store a copy of the previous templates settings.
		fg_fillablepdfs()->set_previous_settings( $template );

		// Get posted settings.
		$settings = fg_fillablepdfs()->get_posted_settings();

		// Add file contents to settings.
		if ( isset( $_FILES['_gaddon_setting_pdf_name'] ) && ! empty( $_FILES['_gaddon_setting_pdf_name']['name'] ) && 0 === $_FILES['_gaddon_setting_pdf_name']['error'] ) {
			$settings['pdf_name'] = $_FILES['_gaddon_setting_pdf_name'];
		}

		// Get template settings fields.
		$sections = $this->settings_fields();

		// Validate settings.
		$is_valid = fg_fillablepdfs()->validate_settings( $sections, $settings );

		// If settings are valid,
		if ( $is_valid ) {

			// Run save callbacks.
			$settings = fg_fillablepdfs()->filter_settings( $sections, $settings );

			try {

				// Create template.
				if ( rgar( $settings, 'template_id' ) ) {
					$new_template = fg_fillablepdfs()->api->save_template( $settings['template_id'], $settings['name'], $settings['pdf_name'], $settings['is_global'] );
				} else {
					$new_template = fg_fillablepdfs()->api->create_template( $settings['name'], $settings['pdf_name'], $settings['is_global'] );
				}

				// Save template ID to settings.
				$_gaddon_posted_settings = $new_template;

				// Add success message.
				GFCommon::add_message( fg_fillablepdfs()->get_save_success_message( $sections ) );

			} catch ( Exception $e ) {

				// Log error message.
				fg_fillablepdfs()->log_error( __METHOD__ . '(): Unable to save template; ' . $e->getMessage() );

				// Add error message.
				GFCommon::add_error_message( esc_html( $e->getMessage() ) );

				return [];

			}

		} else {

			// Add invalid error message.
			GFCommon::add_error_message( fg_fillablepdfs()->get_save_error_message( $sections ) );

			return [];

		}

		return $new_template;

	}

	/**
	 * Get settings fields for creating or editing a template.
	 *
	 * @since 2.3
	 *
	 * @return array
	 */
	protected function settings_fields() {

		// Require tooltips function.
		require_once( GFCommon::get_base_path() . '/tooltips.php' );

		// Get current template.
		$template = $this->get_current_template();

		// Prepare save field.
		if ( $template ) {
			$save_button = [
				'type'     => 'save',
				'value'    => esc_html__( 'Save Template', 'forgravity_fillablepdfs' ),
				'messages' => [
					'success' => esc_html__( 'Template has been saved.', 'forgravity_fillablepdfs' ),
					'error'   => esc_html__( 'Template could not be saved. Please review the errors below and try again.', 'forgravity_fillablepdfs' ),
				],
			];
		} else {
			$save_button = [
				'type'     => 'save',
				'value'    => esc_html__( 'Create Template', 'forgravity_fillablepdfs' ),
				'messages' => [
					'success' => esc_html__( 'Template has been created.', 'forgravity_fillablepdfs' ),
					'error'   => esc_html__( 'Template could not be created. Please review the errors below and try again.', 'forgravity_fillablepdfs' ),
				],
			];
		}

		// Prepare settings fields.
		$fields = [
			[
				'fields' => [
					[
						'name' => 'template_id',
						'type' => 'hidden',
					],
					[
						'name'     => 'name',
						'label'    => esc_html__( 'Template Name', 'forgravity_fillablepdfs' ),
						'type'     => 'text',
						'class'    => 'medium',
						'required' => true,
					],
					[
						'name'     => 'pdf_name',
						'label'    => esc_html__( 'Template File', 'forgravity_fillablepdfs' ),
						'type'     => 'template_file',
						'callback' => $template ? [ $this, 'settings_existing_template' ] : [ $this, 'settings_new_template' ],
						'required' => true,
					],
					[
						'name'    => 'is_global',
						'label'   => null,
						'type'    => 'checkbox',
						'choices' => [
							[
								'name'    => 'is_global',
								'label'   => esc_html__( 'Add as a global template', 'forgravity_fillablepdfs' ),
								'tooltip' => esc_html__( 'Global templates can be used across all sites associated with your license key.', 'forgravity_fillablepdfs' ),

							],
						],
					],
					$save_button
				],
			],
		];

		// Determine if global templates are supported.
		$global_supported = false;

		try {

			// Get license info.
			$license = fg_fillablepdfs()->api->get_license_info();

			// If license does support global templates, update flag.
			if ( rgars( $license, 'supports/global_templates' ) ) {
				$global_supported = true;
			}

			// If template does not belong to this site, update flag.
			if ( $template && parse_url( $template['site_url'] )['host'] !== parse_url( home_url() )['host'] ) {
				$global_supported = false;
			}

		} catch ( Exception $e ) {

			// Log error.
			fg_fillablepdfs()->log_error( __METHOD__ . '(): Unable to get license info; ' . $e->getMessage() );

		}

		// If global template are not supported, set disabled attribute.
		if ( ! $global_supported ) {
			$fields[0]['fields'][4]['choices'][0]['disabled'] = true;
		}

		return $fields;

	}

	/**
	 * Renders and initializes a PDF file field based on the $field array
	 *
	 * @since  2.0
	 * @access public
	 *
	 * @param array $field Field array containing the configuration options of this field.
	 * @param bool  $echo  (default: true) Echo the output to the screen.
	 *
	 * @return string The HTML for the field
	 */
	public function settings_new_template( $field, $echo = true ) {

		// Prepare HTML.
		$html = sprintf(
			'<div class="fillablepdfs-template-file-upload">
				<label class="button" for="_gaddon_setting_%1$s">%2$s</label>
				<input type="file" id="_gaddon_setting_%1$s" name="_gaddon_setting_%1$s" />
				<span class="file-name"></span>
				<span class="error-message"></span>
				%3$s
				<p class="thumbnail"><img src="" alt="" class="fillablepdfs-template-thumbnail" /></p>
			</div>',
			esc_attr( $field['name'] ),
			esc_html__( 'Select a Template File', 'forgravity_fillablepdfs' ),
			fg_fillablepdfs()->field_failed_validation( $field ) ? fg_fillablepdfs()->get_error_icon( $field ) : null
		);

		if ( $echo ) {
			echo $html;
		}

		return $html;

	}

	/**
	 * Renders and initializes a template file field based on the $field array
	 *
	 * @since  1.0
	 * @access public
	 *
	 * @param array $field Field array containing the configuration options of this field.
	 * @param bool  $echo  (default: true) Echo the output to the screen.
	 *
	 * @return string The HTML for the field
	 */
	public function settings_existing_template( $field, $echo = true ) {

		// Get field value.
		$default_value = rgar( $field, 'value' ) ? rgar( $field, 'value' ) : rgar( $field, 'default_value' );
		$value         = fg_fillablepdfs()->get_setting( $field['name'], $default_value );

		// Include hidden field with template file name.
		$html = fg_fillablepdfs()->settings_hidden( $field, false );

		// Show template file name and thumbnail.
		$html .= sprintf(
			'<div class="fillablepdfs-template-existing-preview">
				<p>%s &nbsp;<button class="button primary">Replace Template File</button></p>
				<p><img src="%s" alt="%s" class="fillablepdfs-template-thumbnail" /></p>
			</div>',
			esc_html( $value ),
			esc_url( API::$api_url . 'templates/' . fg_fillablepdfs()->get_setting( 'template_id' ) . '/image' ),
			esc_attr( $value )
		);

		// Prepare HTML.
		$html .= sprintf(
			'<div class="fillablepdfs-template-file-upload" style="display: none;">
				<label class="button" for="_gaddon_setting_%1$s">%2$s</label>
				<input type="file" id="_gaddon_setting_%1$s" name="_gaddon_setting_%1$s" />
				<span class="file-name"></span>
				<span class="error-message"></span>
				%3$s
				<p class="thumbnail"><img src="" alt="" class="fillablepdfs-template-thumbnail" /></p>
			</div>',
			esc_attr( $field['name'] ),
			esc_html__( 'Select a Template File', 'forgravity_fillablepdfs' ),
			fg_fillablepdfs()->field_failed_validation( $field ) ? fg_fillablepdfs()->get_error_icon( $field ) : null
		);


		if ( $echo ) {
			echo $html;
		}

		return $html;

	}





	// # DELETE TEMPLATE -----------------------------------------------------------------------------------------------

	/**
	 * Delete templates.
	 *
	 * @since  2.0
	 * @access public
	 */
	public function maybe_delete_template() {

		// Get template IDs to be deleted.
		$template_ids = rgpost( 'template_ids' ) ? rgpost( 'template_ids' ) : [ rgget( 'id' ) ];

		// Sanitize template IDs.
		$template_ids = array_map( 'sanitize_text_field', $template_ids );

		// Initialize API.
		if ( ! fg_fillablepdfs()->initialize_api() ) {

			// Display error message.
			GFCommon::add_error_message( esc_html__( 'Unable to initialize API.', 'forgravity_fillablepdfs' ) );

			return;

		}

		// Loop through template IDs and delete.
		foreach ( $template_ids as $template_id ) {

			try {

				// Log that template is about to be deleted.
				fg_fillablepdfs()->log_debug( __METHOD__ . '(): Deleting template "' . $template_id . '".' );

				// Delete template.
				$deleted = fg_fillablepdfs()->api->delete_template( $template_id );

			} catch ( Exception $e ) {

				// Log that template could not be deleted.
				fg_fillablepdfs()->log_error( __METHOD__ . '(): Template could not be deleted; ' . $e->getMessage() );

				// Add error message.
				GFCommon::add_error_message( esc_html__( 'Template could not be deleted.', 'forgravity_fillablepdfs' ) );

				return;

			}

			// Display error message if template could not be deleted.
			if ( ! $deleted ) {

				// Display error message.
				GFCommon::add_error_message( esc_html__( 'Template could not be deleted.', 'forgravity_fillablepdfs' ) );

				return;

			}

		}

		// Display success message.
		GFCommon::add_message( esc_html__( 'Template(s) were successfully deleted.', 'forgravity_fillablepdfs' ) );

		return;

	}





	// # DOWNLOAD TEMPLATE ---------------------------------------------------------------------------------------------

	/**
	 * Retrieve and serve original template file.
	 *
	 * @since 2.3
	 */
	public static function maybe_download_template() {

		// If this is not a download request, exit.
		if ( rgget( 'action' ) !== 'download' || rgempty( 'id', $_GET ) ) {
			return;
		}

		// If user does not have Fillable PDFs capabilities, exit.
		if ( ! GFCommon::current_user_can_any( fg_fillablepdfs()->get_capabilities( 'settings' ) ) ) {
			wp_die( esc_html__( 'You do not have permission to download this template.', 'forgravity_fillablepdfs' ) );
		}

		// If API cannot be initialized, exit.
		if ( ! fg_fillablepdfs()->initialize_api() ) {
			wp_die( esc_html__( 'Unable to connect to Fillable PDFs API.', 'forgravity_fillablepdfs' ) );
		}

		// Get template ID.
		$template_id = rgget( 'id' );

		try {

			// Get template.
			$template = fg_fillablepdfs()->api->get_template( $template_id );

		} catch ( Exception $e ) {

			wp_die( sprintf( esc_html__( 'Unable to get template: %s', 'forgravity_fillablepdfs' ), $e->getMessage() ) );

		}

		try {

			// Get template file.
			$file = fg_fillablepdfs()->api->get_template_file( $template['template_id'] );

		} catch ( Exception $e ) {

			wp_die( sprintf( esc_html__( 'Unable to get template file: %s', 'forgravity_fillablepdfs' ), $e->getMessage() ) );

		}

		// If response is JSON, display error.
		if ( is_array( $file ) ) {
			wp_die( sprintf( esc_html__( 'Unable to get template file: %s', 'forgravity_fillablepdfs' ), rgar( $file, 'message' ) ) );
		}

		// Enable output buffering.
		ob_start();

		// Set headers.
		header( 'X-Robots-Tag: noindex, nofollow', true );
		header( 'Content-Description: File Transfer' );
		header( 'Content-Transfer-Encoding: binary' );
		header( 'Cache-Control: public, must-revalidate, max-age=0' );
		header( 'Pragma: public' );
		header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' );
		header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
		header( 'Content-Type: application/force-download' );
		header( 'Content-Type: application/octet-stream', false );
		header( 'Content-Type: application/download', false );
		header( 'Content-Type: application/pdf', false );
		header( 'Content-Disposition: attachment; filename="' . sanitize_file_name( $template['pdf_name'] ) . '"' );

		// Flush output buffer.
		while ( ob_get_level() ) {
			ob_end_clean();
		}

		// Server PDF.
		echo $file;
		die();

	}





	// # HELPERS -------------------------------------------------------------------------------------------------------

	/**
	 * Get the template object currently being edited.
	 *
	 * @since 2.3
	 *
	 * @return array|bool
	 */
	private function get_current_template() {

		// If the current template is defined, return.
		if ( ! empty( $this->current_template ) ) {
			return $this->current_template;
		}

		// Get the current template ID.
		$template_id = fg_fillablepdfs()->is_postback() ? fg_fillablepdfs()->get_setting( 'template_id' ) : rgget( 'id' );

		// If no ID is provided, return.
		if ( ! $template_id || '0' === $template_id ) {
			$this->current_template = [];
			return $this->current_template;
		}

 		try {

			// Get template.
			$template = fg_fillablepdfs()->api->get_template( $template_id );

		} catch ( Exception $e ) {

			// Log error.
			fg_fillablepdfs()->log_error( __METHOD__ . '(): Unable to get template; ' . $e->getMessage() );

			// Set template to false.
			$template = false;

		}

		// Assign template object to instance.
		$this->current_template = $template;

		return $this->current_template;

	}

	/**
	 * Get templates list table object.
	 *
	 * @since  1.0
	 *
	 * @return Templates_Table
	 */
	private function get_table() {

		// Load table class.
		if ( ! class_exists( '\ForGravity\FillablePDFs\Templates_Table' ) ) {
			require_once 'class-templates-table.php';
		}

		return new Templates_Table();

	}

	/**
	 * Title for templates page.
	 *
	 * @since  1.0
	 *
	 * @return string
	 */
	private function page_title() {

		// Prepare base title.
		$title = esc_html__( 'Templates', 'forgravity_fillablepdfs' );

		// If license key is not setup or this is not the templates list page, return title only.
		if ( ! fg_fillablepdfs()->initialize_api() || ( isset( $_GET['id'] ) && ! isset( $_GET['action'] ) ) ) {
			return $title;
		}

		try {

			// Get license info.
			$license = fg_fillablepdfs()->api->get_license_info();

		} catch ( Exception $e ) {

			// Log error.
			fg_fillablepdfs()->log_error( __METHOD__ . '(): Unable to get license info; ' . $e->getMessage() );

			return $title;

		}

		// if license has hit template creation limit, return.
		if ( ! $license['supports']['create_templates'] ) {
			return $title;
		}

		// Prepare URL for new template page.
		$url = add_query_arg( [ 'id' => '0', 'action' => null ] );

		// Add new template button to title.
		$title .= sprintf( ' <a class="add-new-h2" href="%s">%s</a>',
			esc_url( $url ),
			esc_html__( 'Add New', 'forgravity_fillablepdfs' )
		);

		return $title;

	}

}
