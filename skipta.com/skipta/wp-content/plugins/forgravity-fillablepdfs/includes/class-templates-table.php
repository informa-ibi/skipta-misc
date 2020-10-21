<?php

namespace ForGravity\FillablePDFs;

use Exception;
use WP_List_Table;

if ( ! class_exists( '\WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

/**
 * Templates table for plugin page.
 *
 * @extends WP_List_Table
 */
class Templates_Table extends WP_List_Table {

	/**
	 * Get table columns.
	 *
	 * @since  1.0
	 * @access public
	 *
	 * @return array
	 */
	public function get_columns() {

		return [
			'cb'       => esc_html__( 'Checkbox', 'forgravity_fillablepdfs' ),
			'name'     => esc_html__( 'Name', 'forgravity_fillablepdfs' ),
			'pdf_name' => esc_html__( 'File Name', 'forgravity_fillablepdfs' ),
		];

	}

	/**
	 * Get sortable table columns.
	 *
	 * @since  2.0
	 * @access public
	 *
	 * @return array
	 */
	public function get_sortable_columns() {

		return [
			'name'     => [ 'name', true ],
			'pdf_name' => [ 'pdf_name', false ],
		];

	}

	/**
	 * Get bulk template actions.
	 *
	 * @since  1.0
	 * @access public
	 *
	 * @return array
	 */
	public function get_bulk_actions() {

		return [
			'delete' => esc_html__( 'Delete', 'forgravity_fillablepdfs' ),
		];

	}

	/**
	 * Get a list of CSS classes for the WP_List_Table table tag.
	 *
	 * @since 2.0
	 * @access protected
	 *
	 * @return array List of CSS classes for the table tag.
	 */
	protected function get_table_classes() {

		return [ 'widefat', 'fixed', 'striped', 'fillablepdfs__templates' ];

	}

	/**
	 * Prepare templates for table.
	 *
	 * @since  1.0
	 * @access public
	 *
	 * @uses   API::get_templates()
	 * @uses   Fillable_PDFs::initialize_api()
	 * @uses   WP_List_Table::get_columns()
	 * @uses   WP_List_Table::get_sortable_columns()
	 */
	public function prepare_items() {

		// If API is not initialize, do not set items.
		if ( ! fg_fillablepdfs()->initialize_api() ) {
			return;
		}

		// Get columns, hidden columns and sortable columns.
		$columns  = $this->get_columns();
		$hidden   = [];
		$sortable = $this->get_sortable_columns();

		// Set column headers.
		$this->_column_headers = [ $columns, $hidden, $sortable ];

		try {

			// Set table items to site templates.
			$this->items = fg_fillablepdfs()->api->get_templates();

		} catch ( Exception $e ) {

			// Store error message.
			$this->errorMessage = $e->getMessage();

		}

		// Sort templates.
		switch ( rgget( 'orderby' ) ) {

			case 'name':

				// Sort templates by name alphabetically.
				usort( $this->items, function( $a, $b ) { return strcasecmp( $a['name'], $b['name'] ); } );

				// Reverse sort.
				if ( 'desc' === rgget( 'order' ) ) {
					$this->items = array_reverse( $this->items );
				}

				break;

			case 'pdf_name':

				// Sort templates by template name alphabetically.
				usort( $this->items, function( $a, $b ) { return strcasecmp( $a['pdf_name'], $b['pdf_name'] ); } );

				// Reverse sort.
				if ( 'desc' === rgget( 'order' ) ) {
					$this->items = array_reverse( $this->items );
				}

				break;

			default:
				break;

		}


	}

	/**
	 * Display default column content.
	 *
	 * @since  1.0
	 * @access public
	 *
	 * @param array  $template Template for current row.
	 * @param string $column   Column name being displayed.
	 *
	 * @return string
	 */
	public function column_default( $template, $column ) {

		// Return column content based on column name.
		switch ( $column ) {

			case 'type':
				return esc_html( strtoupper( rgar( $template, 'type' ) ) );

			default:
				return esc_html( rgar( $template, $column ) );

		}

	}

	/**
	 * Display checkbox column.
	 *
	 * @since  1.0
	 * @access public
	 *
	 * @param array $template Template for current row.
	 *
	 * @return string
	 */
	public function column_cb( $template ) {

		return sprintf( '<input type="checkbox" name="template_ids[]" value="%s" />', esc_attr( $template['template_id'] ) );

	}

	/**
	 * Display name column with action links.
	 *
	 * @since  1.0
	 * @access public
	 *
	 * @param array $template Template for current row.
	 *
	 * @uses   WP_List_Table::row_actions()
	 *
	 * @return string
	 */
	public function column_name( $template ) {

		// Initialize actions array.
		$actions = [
			'edit'   => sprintf(
				'<a href="%s">%s</a>',
				esc_attr( add_query_arg( [ 'id' => $template['template_id'], 'action' => null ] ) ),
				esc_html__( 'Edit', 'forgravity_fillablepdfs' )
			),
			'delete' => sprintf(
				'<a href="%s">%s</a>',
				esc_attr( add_query_arg( [ 'id' => $template['template_id'], 'action' => 'delete' ] ) ),
				esc_html__( 'Delete', 'forgravity_fillablepdfs' )
			),
			'download' => sprintf(
				'<a href="%s">%s</a>',
				esc_attr( add_query_arg( [ 'id' => $template['template_id'], 'action' => 'download' ] ) ),
				esc_html__( 'Download', 'forgravity_fillablepdfs' )
			)
		];

		return sprintf( '%1$s %2$s', $template['name'], $this->row_actions( $actions ) );

	}

	/**
	 * Display message when no templates exist.
	 *
	 * @since  1.0
	 * @access public
	 */
	public function no_items() {

		// If an error message is set, return it.
		if ( isset( $this->errorMessage ) ) {
			printf(
				'%s: %s',
				esc_html__( 'Unable to get templates', 'forgravity_fillablepdfs' ),
				esc_html( $this->errorMessage )
			);
		}

		// Prepare URL.
		$url = add_query_arg( [ 'id' => 0 ] );
		$url = remove_query_arg( 'action', $url );

		printf(
			esc_html__( 'To get started, %sadd a new template.%s', 'forgravity_fillablepdfs' ),
			'<a href="' . esc_url( $url ) . '">',
			'</a>'
		);

	}

}
