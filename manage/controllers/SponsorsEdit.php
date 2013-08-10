<?php

include "../../include/allrequirements.php";

$ID = $_GET["id"];

$N = MySqlQueryToArray(GetSponsorByID($ID));

$h2o = new h2o('../views/SponsorsEdit.djhtml');

echo $h2o->render(array('sponsor'=>$N[0]));

?>
