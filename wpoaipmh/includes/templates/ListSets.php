<?php 

/**
* ListSets TEMPLATE
* -----------------
*
*/

use Crea\OAI;
$requeter = new \Crea\OAI\Requeter();
$list = $requeter->listSets();

?>
<ListSets>
	<?= $list ?>
</ListSets>