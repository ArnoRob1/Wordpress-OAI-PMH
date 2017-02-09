<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.univ-rennes2.fr/
 * @since      1.0.0
 *
 * @package    Wpoaipmh
 * @subpackage Wpoaipmh/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wpoaipmh
 * @subpackage Wpoaipmh/includes
 * @author     CREA - Université Rennes 2 <arnaud.robin@univ-rennes2.fr>
 */
class Wpoaipmh_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		
		// J'ai essayé de regénérer les règles d'url à l'activation / désactivation
		// Mais ça ne marche pas ?...
		// flush_rewrite_rules();

		/* Il faut nécessairement sauvegarder les permalines dans WordPress pour faire marcher ces règles */
		
	}

}
