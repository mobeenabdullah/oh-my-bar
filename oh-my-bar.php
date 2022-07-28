<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://mobeenabdullah.com
 * @since             0.1.0
 * @package           Oh_My_Bar
 *
 * @wordpress-plugin
 * Plugin Name:       Oh My Bar
 * Plugin URI:        https://github.com/mobeenabdullah/oh-my-bar
 * Description:       Oh My Bar is a WordPress plugin that creates a reading progress bar on top/bottom of the site that helps users to understand that how far they're from finishing the article/page
 * Version:           0.1.0
 * Author:            Mobeen Abdullah
 * Author URI:        https://mobeenabdullah.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       oh-my-bar
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 0.1.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'OH_MY_BAR_VERSION', '0.1.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-oh-my-bar-activator.php
 */
function activate_oh_my_bar() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-oh-my-bar-activator.php';
	Oh_My_Bar_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-oh-my-bar-deactivator.php
 */
function deactivate_oh_my_bar() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-oh-my-bar-deactivator.php';
	Oh_My_Bar_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_oh_my_bar' );
register_deactivation_hook( __FILE__, 'deactivate_oh_my_bar' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-oh-my-bar.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    0.1.0
 */
function run_oh_my_bar() {

	$plugin = new Oh_My_Bar();
	$plugin->run();

}
run_oh_my_bar();
