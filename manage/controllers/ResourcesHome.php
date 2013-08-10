<?php

include "../../include/allrequirements.php";

$N = MySqlQueryToArray(GetResources(0));

$h2o = new h2o('../views/ResourceHome.djhtml');

echo $h2o->render(array('Resources'=>$N));

?>