<?php

namespace ForGravity\FillablePDFs;

use Exception;

/**
 * Fillable PDFs API library.
 *
 * @since     1.0
 * @package   FillablePDFs
 * @author    ForGravity
 * @copyright Copyright (c) 2017, ForGravity
 */
class API {

	/**
	 * Base Fillable PDFs API URL.
	 *
	 * @since  1.0
	 * @var    string
	 * @access protected
	 */
	public static $api_url = FG_FILLABLEPDFS_API_URL;

	/**
	 * License key.
	 *
	 * @since 1.0
	 * @var   string
	 */
	protected $license_key;

	/**
	 * Site home URL.
	 *
	 * @since 1.0
	 * @var   string
	 */
	protected $site_url;

	/**
	 * Initialize Fillable PDFs API library.
	 *
	 * @since  1.0
	 * @access public
	 *
	 * @param string $license_key License key.
	 */
	public function __construct( $license_key ) {

		$this->license_key = $license_key;
		$this->site_url    = home_url();

	}





	// # FILES ---------------------------------------------------------------------------------------------------------

	/**
	 * Get PDF file fields.
	 *
	 * @since  2.0
	 *
	 * @param array $file Temporary file details.
	 *
	 * @return array
	 * @throws Exception
	 */
	public function get_file_meta( $file = [] ) {

		// Build request URL.
		$request_url = self::$api_url . 'files/meta';

		// Generate boundary.
		$boundary = wp_generate_password( 24 );

		// Prepare request body.
		$body = '--' . $boundary . "\r\n";
		$body .= 'Content-Disposition: form-data; name="pdf_file"; filename="' . $file['name'] . '"' . "\r\n\r\n";
		$body .= file_get_contents( $file['tmp_name'] ) . "\r\n";
		$body .= '--' . $boundary . '--';

		// Build request arguments.
		$args = [
			'body'    => $body,
			'method'  => 'POST',
			'timeout' => 30,
			'headers' => [
				'Authorization' => 'Basic ' . base64_encode( $this->site_url . ':' . $this->license_key ),
				'Content-Type'  => 'multipart/form-data; boundary=' . $boundary,
			],
		];

		// Execute request.
		$response = wp_remote_request( $request_url, $args );

		// If request attempt threw a WordPress error, throw exception.
		if ( is_wp_error( $response ) ) {
			throw new Exception( $response->get_error_message() );
		}

		// Decode response.
		$response = json_decode( $response['body'], true );

		// If error response was received, throw exception.
		if ( isset( $response['error'] ) ) {
			throw new Exception( $response['message'] );
		}

		return $response;

	}





	// # TEMPLATES -----------------------------------------------------------------------------------------------------

	/**
	 * Create template.
	 *
	 * @since  1.0
	 *
	 * @param string $name      Template name.
	 * @param array  $file      Temporary file details.
	 * @param bool   $is_global Global template.
	 *
	 * @return array
	 * @throws Exception
	 */
	public function create_template( $name = '', $file = [], $is_global = false ) {

		// Build request URL.
		$request_url = self::$api_url . 'templates';

		// Generate boundary.
		$boundary = wp_generate_password( 24 );

		// Prepare request body.
		$body  = '--' . $boundary . "\r\n";
		$body .= 'Content-Disposition: form-data; name="name"' . "\r\n\r\n" . $name . "\r\n";
		$body .= '--' . $boundary . "\r\n";
		$body .= 'Content-Disposition: form-data; name="is_global"' . "\r\n\r\n" . ( $is_global ? '1' : '0' ) . "\r\n";
		$body .= '--' . $boundary . "\r\n";
		$body .= 'Content-Disposition: form-data; name="pdf_file"; filename="' . $file['name'] . '"' . "\r\n\r\n";
		$body .= file_get_contents( $file['tmp_name'] ) . "\r\n";
		$body .= '--' . $boundary . '--';

		// Build request arguments.
		$args = [
			'body'    => $body,
			'method'  => 'POST',
			'timeout' => 30,
			'headers' => [
				'Authorization' => 'Basic ' . base64_encode( $this->site_url . ':' . $this->license_key ),
				'Content-Type'  => 'multipart/form-data; boundary=' . $boundary,
			],
		];

		// Execute request.
		$response = wp_remote_request( $request_url, $args );

		// If request attempt threw a WordPress error, throw exception.
		if ( is_wp_error( $response ) ) {
			throw new Exception( $response->get_error_message() );
		}

		// Decode response.
		$response = json_decode( $response['body'], true );

		// If error response was received, throw exception.
		if ( isset( $response['error'] ) ) {
			throw new Exception( $response['message'] );
		}

		return $response;

	}

	/**
	 * Delete template.
	 *
	 * @since  1.0
	 *
	 * @param string $template_id Template ID.
	 *
	 * @return array
	 * @throws Exception
	 */
	public function delete_template( $template_id = '' ) {

		return $this->make_request( 'templates/' . $template_id, [], 'DELETE' );

	}

	/**
	 * Get specific template.
	 *
	 * @since  1.0
	 *
	 * @param string $template_id Template ID.
	 *
	 * @return array
	 * @throws Exception
	 */
	public function get_template( $template_id = '' ) {

		return $this->make_request( 'templates/' . $template_id );

	}

	/**
	 * Get all templates for site.
	 *
	 * @since  1.0
	 *
	 * @return array
	 * @throws Exception
	 */
	public function get_templates() {

		return $this->make_request( 'templates' );

	}

	/**
	 * Get original file for template.
	 *
	 * @since  1.0
	 *
	 * @param string $template_id Template ID.
	 *
	 * @return array
	 * @throws Exception
	 */
	public function get_template_file( $template_id = '' ) {

		return $this->make_request( 'templates/' . $template_id . '/file' );

	}

	/**
	 * Create template.
	 *
	 * @since  1.0
	 *
	 * @param string     $template_id Template ID.
	 * @param string     $name        Template name.
	 * @param array|null $file        Temporary file details.
	 * @param bool       $is_global   Global template.
	 *
	 * @return array
	 * @throws Exception
	 */
	public function save_template( $template_id, $name, $file = null, $is_global = false ) {

		// If no file is provided, use default method.
		if ( ! is_array( $file ) ) {
			return $this->make_request( 'templates/' . $template_id, [ 'name' => $name, 'is_global' => $is_global ], 'PUT' );
		}

		// Build request URL.
		$request_url = self::$api_url . 'templates/' . $template_id;

		// Generate boundary.
		$boundary = wp_generate_password( 24 );

		// Prepare request body.
		$body  = '--' . $boundary . "\r\n";
		$body .= 'Content-Disposition: form-data; name="name"' . "\r\n\r\n" . $name . "\r\n";
		$body .= '--' . $boundary . "\r\n";
		$body .= 'Content-Disposition: form-data; name="is_global"' . "\r\n\r\n" . ( $is_global ? '1' : '0' ) . "\r\n";
		$body .= '--' . $boundary . "\r\n";
		$body .= 'Content-Disposition: form-data; name="pdf_file"; filename="' . $file['name'] . '"' . "\r\n\r\n";
		$body .= file_get_contents( $file['tmp_name'] ) . "\r\n";
		$body .= '--' . $boundary . '--';

		// Build request arguments.
		$args = [
			'body'    => $body,
			'method'  => 'POST',
			'timeout' => 30,
			'headers' => [
				'Authorization' => 'Basic ' . base64_encode( $this->site_url . ':' . $this->license_key ),
				'Content-Type'  => 'multipart/form-data; boundary=' . $boundary,
			],
		];

		// Execute request.
		$response = wp_remote_request( $request_url, $args );

		// If request attempt threw a WordPress error, throw exception.
		if ( is_wp_error( $response ) ) {
			return $response;
		}

		// Decode response.
		$response = json_decode( $response['body'], true );

		// If error response was received, throw exception.
		if ( isset( $response['error'] ) ) {
			throw new Exception( $response['message'] );
		}

		return $response;

	}

	/**
	 * Generate PDF.
	 *
	 * @since  1.0
	 *
	 * @param string $template_id Template ID.
	 * @param array  $meta        PDF meta.
	 *
	 * @return string
	 * @throws Exception
	 */
	public function generate( $template_id = '', $meta = [] ) {

		return $this->make_request( 'templates/' . $template_id . '/generate', $meta, 'POST' );

	}





	// # LICENSE -------------------------------------------------------------------------------------------------------

	/**
	 * Get information about current license.
	 *
	 * @since  1.0
	 *
	 * @return array
	 * @throws Exception
	 */
	public function get_license_info() {

		static $license_info;

		if ( ! isset( $license_info ) ) {
			$license_info = $this->make_request( 'license' );
		}

		return $license_info;

	}





	// # REQUEST METHODS -----------------------------------------------------------------------------------------------

	/**
	 * Make API request.
	 *
	 * @since  1.0
	 *
	 * @param string $path    Request path.
	 * @param array  $options Request options.
	 * @param string $method  Request method. Defaults to GET.
	 *
	 * @return array|string
	 * @throws Exception
	 */
	private function make_request( $path, $options = [], $method = 'GET' ) {

		// Build request URL.
		$request_url = self::$api_url . $path;

		// Add options if this is a GET request.
		if ( 'GET' === $method ) {
			$request_url = add_query_arg( $options, $request_url );
		}

		// Build request arguments.
		$args = [
			'body'    => 'GET' !== $method ? wp_json_encode( $options ) : null,
			'method'  => $method,
			'timeout' => 30,
			'headers' => [
				'Authorization' => 'Basic ' . base64_encode( $this->site_url . ':' . $this->license_key ),
				'Content-Type'  => 'application/json'
			],
		];

		// Execute request.
		$response = wp_remote_request( $request_url, $args );

		// If request attempt threw a WordPress error, throw exception.
		if ( is_wp_error( $response ) ) {
			throw new Exception( $response->get_error_message() );
		}

		// Decode response.
		$response = fg_fillablepdfs()->maybe_decode_json( $response['body'] );

		// If error response was received, throw exception.
		if ( isset( $response['error'] ) ) {
			throw new Exception( $response['message'] );
		}

		return $response;

	}

}
