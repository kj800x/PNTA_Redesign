<?php
	
include "../include/allrequirements.php";

$h2o = new h2o('./401.djhtml');

echo $h2o->render();

?>