<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://mobeenabdullah.com
 * @since      0.1.0
 *
 * @package    Oh_My_Bar
 * @subpackage Oh_My_Bar/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      0.1.0
 * @package    Oh_My_Bar
 * @subpackage Oh_My_Bar/includes
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
class Oh_My_Bar_i18n {

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    0.1.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'oh-my-bar',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}
}
