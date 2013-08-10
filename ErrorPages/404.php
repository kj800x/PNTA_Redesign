<?php
	
include "../include/allrequirements.php";

$h2o = new h2o('./404.djhtml');

echo $h2o->render();

?>