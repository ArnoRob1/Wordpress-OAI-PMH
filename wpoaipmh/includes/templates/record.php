<?php 

/**
* Record TEMPLATE
* ---------------
*
*/


/* title */
$title       = html_entity_decode(get_the_title($recordID));

/* description */
$description = cleanforxml("whatever"); /* set with the appropriate cleaned information for this record... */

/* datestamp */
$datestamp   = "yyyy-mm-dd"; /* set with the appropriate information for this record... */

/* setSpec */
$line_setSpec1 = "<setSpec> whatever... </setSpec>";
$line_setSpec2 = "<setSpec> whatever... </setSpec>";

/* subject */
$line_subject = "<dc:subject> whatever... </dc:subject>";

/* Languages */
$lines_languages .= "<dc:language> whatever... </dc:language>";

/* creator */
$line_creator = "<dc:creator> whatever... </dc:creator>";

$header = "<header>";
$header .= "<identifier>$recordID</identifier>";
$header .= "<datestamp>$datestamp</datestamp>";
$header .= $line_setSpec1;
$header .= $line_setSpec2;
$header .= "</header>";

if($this->verb == "ListIdentifiers") {

	echo($header);

} else { ?>
<record>
	<?= $header ?>
	<metadata>
	<oai_dc:dc xmlns:oai_dc="http://www.openarchives.org/OAI/2.0/oai_dc/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.openarchives.org/OAI/2.0/oai_dc/ http://www.openarchives.org/OAI/2.0/oai_dc.xsd">
	<dc:title><?= $title ?></dc:title>
	<?= $line_creator ?>
	<?= $line_subject ?>
	<dc:description><?= $description ?></dc:description>
	<?= $lines_langues ?>
	<dc:date><?= $datestamp ?></dc:date>
	</oai_dc:dc>
</metadata>
</record>
<?php } ?>