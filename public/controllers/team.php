<?php

include "../../include/allrequirements.php";

$N = MySqlQueryToArray(GetMembers());

$h2o = new h2o('../views/team.djhtml');

echo $h2o->render(array('Team'=>$N));

?>