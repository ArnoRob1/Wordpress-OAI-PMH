<?php

/**
 * @link              https://www.univ-rennes2.fr/
 * @since             1.0.0
 * @package           Wpoaipmh
 *
 * @wordpress-plugin
 * Plugin Name:       Wordpress OAI-PMH
 * Plugin URI:        https://github.com/ArnoRob1/wpoaipmh
 * Description:       A plugin to add OAI-PMH to a Wordpress Website
 * Version:           1.0.0
 * Author:            CREA - Université Rennes 2
 * Author URI:        https://www.univ-rennes2.fr/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wpoaipmh
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) { die; }


function cleanforxml($string) {
	$string = str_replace(array('&rsquo;'), array("'"), $string);
	$string = str_replace(array('&', '<', '>', '\'', '"'), array('&amp;', '&lt;', '&gt;', '&apos;', '&quot;'), $string);
	return $string;
}

/* The code that runs during plugin activation */
function activate_wpoaipmh() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wpoaipmh-activator.php';
	Wpoaipmh_Activator::activate();
}

/* The code that runs during plugin deactivation */
function deactivate_wpoaipmh() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wpoaipmh-deactivator.php';
	Wpoaipmh_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wpoaipmh' );
register_deactivation_hook( __FILE__, 'deactivate_wpoaipmh' );

/* The core plugin class that is used to define internationalization, admin-specific hooks, and public-facing site hooks. */
require plugin_dir_path( __FILE__ ) . 'includes/class-wpoaipmh.php';

/* The Builder Class builds the OAI-PMH response to a request */
require plugin_dir_path( __FILE__ ) . 'includes/class-oaipmh.php';

/* The Requeter Class makes queries on the WordPress Database */
require plugin_dir_path( __FILE__ ) . 'includes/class-requeter.php';

/* Begins execution of the plugin */
function run_wpoaipmh() {
	$plugin = new Wpoaipmh();
	$plugin->run();
}

run_wpoaipmh();
