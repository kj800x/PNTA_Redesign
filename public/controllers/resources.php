<?php

include "../../include/allrequirements.php";

$N = MySqlQueryToArray(GetResources(0));

$h2o = new h2o('../views/resources.djhtml');

echo $h2o->render(array('Resources'=>$N));

?>