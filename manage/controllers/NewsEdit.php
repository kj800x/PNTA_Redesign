<?php

include "../../include/allrequirements.php";

$ID = $_GET["id"];

$N = MySqlQueryToArray(GetNewsByID($ID));

$h2o = new h2o('../views/NewsEdit.djhtml');

echo $h2o->render(array('article'=>$N[0]));

?>
