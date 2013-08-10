<?php

include "../../include/allrequirements.php";

$ID = $_GET["id"];

$N = MySqlQueryToArray(GetMemberByID($ID));

$h2o = new h2o('../views/TMEdit.djhtml');

echo $h2o->render(array('member'=>$N[0]));

?>
