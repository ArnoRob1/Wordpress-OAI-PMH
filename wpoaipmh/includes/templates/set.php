<?php 

/**
* Set TEMPLATE
* ------------
*
*/

$setSpec = $IDENTIFIANT;
$setName = html_entity_decode(get_the_title($IDENTIFIANT));
$description = "whatever";

?>
<set>
	<setSpec><?= $setSpec ?></setSpec>
	<setName><?= $setName ?></setName>
	<setDescription>
		<oai_dc:dc xmlns:oai_dc="http://www.openarchives.org/OAI/2.0/oai_dc/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.openarchives.org/OAI/2.0/oai_dc/ http://www.openarchives.org/OAI/2.0/oai_dc.xsd">
		<dc:description><?= $description ?></dc:description>
		</oai_dc:dc>
	</setDescription>
</set>
