<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.univ-rennes2.fr/
 * @since      1.0.0
 *
 * @package    Wpoaipmh
 * @subpackage Wpoaipmh/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wpoaipmh
 * @subpackage Wpoaipmh/includes
 * @author     CREA - Université Rennes 2 <arnaud.robin@univ-rennes2.fr>
 */
class Wpoaipmh_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wpoaipmh',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
