<?php 

/*******************************************************/
/* AU DELA DE 400 RESULTATS -->  OUT OF MEMORY         */
/* IL RESTERAIT A IMPLEMENTER LES RESUMPTION TOKEN...  */
/*******************************************************/

namespace Crea\OAI;

class Requeter {

	public function __construct() {

	}

	public function listRecords($from = '', $until = '', $set = '', $resumptionToken = '') {

		$resultat = [];

		/* CAS EXCEPTIONNELS : On renvoie un tableau vide */
		/* ---------------------------------------------- */
		/* SET n'est pas nul, mais ne correspond pas à un ensemble valide  */
		/***************************************************************************************/
		if($set != '' &&  NOT VALID SET) return [];
		

		/* THIS REQUEST RETURNS ALL POTENTIALLY AVAILABLE RESSOURCES */ 
		/* Adapt this request with your needs ... */
		$args = array(
			'posts_per_page'   => 400,
			'offset'           => 0,
			'category__in'	   => array(  ),
			'meta_key'         => '...',
			'meta_value'       => '...',
			'post_status'      => 'publish'
			);

		$query = new \WP_Query($args);

		$posts = get_posts( $args );


		/* les dates from et until doivent être au format 2015-01-31 */
		/* je les transforme au format 20150131 pour la comparaison avec la date en base */
		// if($from != '')  $from  = str_replace('-', '', $from);
		// if($until != '') $until = str_replace('-', '', $until);

		foreach ($posts as $ressource) {

			$recordID         = $ressource->ID;
			$date = ...;

			$tobeincluded = true;			

			if($set != '' && DOES NOT BELONG TO SET) $tobeincluded = false;
			
			if($from != '' && $date < $from) $tobeincluded = false;
			
			if($until != '' && $date > $until) $tobeincluded = false;
			
			/* Si la ressource répond à tous les critères, on l'ajoute à la liste de résultats */
			if($tobeincluded) $resultat[] = $recordID;
		}

		return $resultat;
	}

	/* Returns an array with all available SET ids... */
	public function getSets() {
		return $sets;
	}

	/* Renvoie un tableau contenant les ids des collections et sous collections qui sont les SET OAI PMH */
	public function listSets($resumptionToken = '') {

		$sets = $this->getSets();

		foreach ($sets as $paire) {
			
			$col_id   = $paire[0];
			$sscol_id = $paire[1];

			$IDENTIFIANT = (empty($sscol_id)) ? $col_id : $sscol_id;

			include( __DIR__ . '/templates/set.php' );

		}
	}
}

