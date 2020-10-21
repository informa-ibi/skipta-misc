<?php

namespace ForGravity\FillablePDFs;

use GFForms;
use Gravity_Flow_Step_Feed_Add_On;
use Gravity_Flow_Steps;

// If Gravity Forms is not loaded, exit.
if ( ! class_exists( 'GFForms' ) ) {
	die();
}

/**
 * Fillable PDFs Step for Gravity Flow
 *
 * @since     1.0
 * @package   FillablePDFs
 * @author    ForGravity
 * @copyright Copyright (c) 2017, ForGravity
 */
class Gravity_Flow_Step extends Gravity_Flow_Step_Feed_Add_On {

	protected $_slug = 'forgravity-fillablepdfs';

	public $_step_type = 'fillablepdfs';

	protected $_class_name = '\ForGravity\Fillable_PDFs';

	public function get_label() {
		return esc_html__( 'Fillable PDFs', 'forgravity_fillablepdfs' );
	}

	public function get_icon_url() {
		return fg_fillablepdfs()->get_base_url() . '/images/gravityflow-step.png';
	}
}

Gravity_Flow_Steps::register( new Gravity_Flow_Step() );
