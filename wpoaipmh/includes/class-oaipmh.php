<?php 

namespace Crea\OAI;

class Builder {

	protected $verb;
	protected $arguments;
	protected $errors;

	public $keys = ['identifier', 'metadataPrefix', 'from', 'until', 'set', 'resumptionToken'];

	public function __construct() {

		$this->verb    = get_query_var('verb');
		$this->errors  = [];

		/* Variables passées en requêtes */
		foreach ($this->keys as $key) 
			$this->arguments[$key] = get_query_var($key);		

		/* Pour chaque requete, on vérifie plein de choses */
		$this->analyse_verb();
		$this->analyse_requete();
	}

	private function analyse_verb() {
		$verbs = ["GetRecord", "Identify", "ListIdentifiers", "ListMetadataFormats", "ListRecords", "ListSets"];
		if(!in_array($this->verb, $verbs)) $this->errors["badVerb"] = "Bad Verb";
	}

	/* L'erreur BadArgument peut être */
	private function analyse_requete() {

		/* Erreur : badVerb -> gérée précédemment */

		/* Erreur : badArgument -> pour tous les verbes */
		$this->analyse_parametres_requis();
		$this->analyse_parametres_illegaux();

		/* Erreur cannotDisseminateFormat -> pour GetRecord, ListIdentifiers, ListRecords */
		if(in_array($this->verb, ['GetRecord', 'ListIdentifiers', 'ListRecords']))
			$this->analyse_cannotDisseminateFormat();

		/* Erreur : idDoesNotExist -> pour GetRecord, ListMetadataFormats */
		if(in_array($this->verb, ['GetRecord', 'ListMetadataFormats']))
			$this->analyse_idDoesNotExist();

		/* Erreur : noMetadataFormats -> uniquement pour ListMetadataFormats, et toutes nos ressources gèrent */
		/* le même MetadataFormat oai_dc, donc on ne renvoie jamais cette erreur */

		/* Erreur : noSetHierarchy -> Nous ne renvoyons jamais cette erreur car nous supportons les SETS */

		/* Erreur : noRecordsMatch -> triggered at record.php template level */
		/* Erreur : badResumptionToken -> resumptionToken not implemented so far */


	}

	/* On vérifie pour toutes les requetes, quelque soit le verbe, les parametres requis */
	/* Dans certains cas, il n'y a aucun parametre requis */
	private function analyse_parametres_requis() {

		$REQUIS = array(
			'GetRecord' => ['identifier', 'metadataPrefix'],
			'Identify' => [],
			'ListIdentifiers' => ['metadataPrefix'],
			'ListMetadataFormats' => [],
			'ListRecords' => ['metadataPrefix'],
			'ListSets' => []
			);

		/* Paramètres requis pour ce verbe */
		$parametres_requis = $REQUIS[$this->verb];

		$some_arg_missing = false;

		/* L'argument resumptionToken est exclusif. S'il est présent, les arguments requis peuvent être omis */
		if ($this->arguments['resumptionToken'] == '') {
			foreach ($parametres_requis as $parametre) {		
				if($this->arguments[$parametre] == '') $some_arg_missing = true;
			}
		}

		if($some_arg_missing) 
			$this->errors["badArgument"] = "One or more arguments is missing";

	}

	/* On vérifie pour toutes les requetes, quelque soit le verbe, les parametres illegaux */
	/* C'est à dire les parametres (de notre liste autorisée) qui seraient appelés sur cette requête, alors qu'ils ne devraient pas */
	/* Je ne vois pas bien à quoi ça sert de renvoyer une erreur plutot que d'ignorer le parametre, mais bon... */
	private function analyse_parametres_illegaux() {

		$LEGAUX = array(
			'GetRecord' => ['identifier', 'metadataPrefix'],
			'Identify' => [],
			'ListIdentifiers' => ['from', 'until', 'metadataPrefix', 'set', 'resumptionToken'],
			'ListMetadataFormats' => ['identifier'],
			'ListRecords' => ['from', 'until', 'metadataPrefix', 'set', 'resumptionToken'],
			'ListSets' => ['resumptionToken']
			);

		/* Paramètres legaux pour ce verbe */
		$parametres_legaux = $LEGAUX[$this->verb];

		$has_illegal = false;

		foreach($this->keys as $key) {
			if ( get_query_var($key) != '' && !in_array($key, $parametres_legaux) )
				$has_illegal = true;
		}

		if($has_illegal) 
			$this->errors["badArgument"] = "Illegal Argument";

	}

	/* On vérifie que le metadataPrefix demandé est compatible avec notre implémantion pour certains verbes */
	/* Dans notre cas, nous supportons seulement le format oai_dc */
	private function analyse_cannotDisseminateFormat() {		
		if($this->arguments['metadataPrefix'] != 'oai_dc')
			$this->errors["cannotDisseminateFormat"] = "Only oai_dc format supported ! ";
	}

	/* On vérifie que l'id de fiche demandée existe */
	private function analyse_idDoesNotExist() {

		$id = $this->arguments['identifier'];

		$idDoesNotExist = false;
		
		/* Si l'ID n'est pas renseigné, soit il est optionnel (verb ListMetadataFormats) et on ne renvoie pas une erreur */
		/* soit il est requis, et dans ce cas l'erreur badArgument aura déjà été levée, donc on ne renvoie pas cette erreur en plus */
		if($id == '') return;

		if(TEST TO CHECK IF IT SHOULD BE INCLUDED) $idDoesNotExist = true;
	
		if($idDoesNotExist)
			$this->errors["idDoesNotExist"] = "Requested identifier not valid !";

	}



	public function render() {

		Header('Content-type: text/xml');
		header("Access-Control-Allow-Origin: *");

		$this->print_header();

		$this->print_request();

		if(empty($this->errors)) $this->print_content();

		else $this->print_errors();

		$this->print_footer();

		die();
	}

	private function print_header() {
		$now = date('Y-m-d\TH:i:s\z');
		print('<?xml version="1.0" encoding="UTF-8"?>');
		print('<OAI-PMH xmlns="http://www.openarchives.org/OAI/2.0/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.openarchives.org/OAI/2.0/ http://www.openarchives.org/OAI/2.0/OAI-PMH.xsd">');
		print('<responseDate>' . $now . '</responseDate>');
	}

	private function print_request() {
		$request = '<request verb="' . $this->verb . '"';
		foreach ($this->arguments as $key => $value) {
			if($value != '') $request .= (' ' . $key . '="' . $value . '"'); 
		}
		/* request base url : http://www.website.tld/oai */
		$url = get_site_url() . '/oai';
		$request .= '>' . $url . '</request>';
		print($request);

	}

	private function print_content() {
		include( __DIR__ . '/templates/' . $this->verb . '.php' );
	}

	private function print_errors() {
		foreach ($this->errors as $code => $message) {
			print('<error code="' . $code . '">' . $message . '</error>');
		}
	}

	private function print_footer() {
		print('</OAI-PMH>');
	}

}
