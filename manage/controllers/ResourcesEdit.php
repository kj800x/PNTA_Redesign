<?php

include "../../include/allrequirements.php";

$ID = $_GET["id"];

$N = MySqlQueryToArray(GetResourceByID($ID));

$h2o = new h2o('../views/ResourceEdit.djhtml');

echo $h2o->render(array('resource'=>$N[0]));

?>