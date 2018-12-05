<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link      https://digitalcenturysf.com/
 * @since      1.0.0
 *
 * @package    Testimonial_Pro
 * @subpackage Testimonial_Pro/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Testimonial_Pro
 * @subpackage Testimonial_Pro/includes
 * @author     digitalcenturysf <digitalcenturysf@gmail.com>
 */
class Testimonial_Pro_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'testimonial-pro',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
