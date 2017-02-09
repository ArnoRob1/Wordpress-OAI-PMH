<?php  

/**
* ListRecords TEMPLATE
* --------------------
* Used for ListRecords and ListIdentifiers (in $this->verb)
* noRecordsMatch Error is triggered here.
*
*/

use Crea\OAI;

$requeter 		 = new \Crea\OAI\Requeter();

$set             = $this->arguments["set"];
$from            = $this->arguments["from"];
$until           = $this->arguments["until"];
$resumptionToken = $this->arguments["resumptionToken"];

$liste = $requeter->listRecords($from, $until, $set, $resumptionToken);

if(!empty($liste)) { 

	/* <ListRecords> ou <ListIdentifiers> */
	echo('<' . $this->verb . '>');

	/* Les records (ou identifiers)... */
	foreach ($liste as $recordID) include('record.php');
	
	/* </ListRecords> ou </ListIdentifiers> */
	echo('</' . $this->verb . '>');

}  else { 

	echo('<error code="noRecordsMatch"></error>');

}

?>