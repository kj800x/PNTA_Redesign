<?php

include "../../include/allrequirements.php";

$N = MySqlQueryToArray(GetMembers());

$h2o = new h2o('../views/TMView.djhtml');

echo $h2o->render(array('Members'=>$N));

?>