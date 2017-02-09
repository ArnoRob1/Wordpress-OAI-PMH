<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://www.univ-rennes2.fr/
 * @since      1.0.0
 *
 * @package    Wpoaipmh
 * @subpackage Wpoaipmh/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Wpoaipmh
 * @subpackage Wpoaipmh/includes
 * @author     CREA - Université Rennes 2 <arnaud.robin@univ-rennes2.fr>
 */
class Wpoaipmh_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		// J'ai essayé de regénérer les règles d'url à l'activation / désactivation
		// Mais ça ne marche pas ?...
		// flush_rewrite_rules();
	}

}
