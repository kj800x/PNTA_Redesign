<?php

include "../../include/allrequirements.php";

$N = MySqlQueryToArray(GetVerifiedMembers());
$U = MySqlQueryToArray(GetUnverifiedMembers());

$h2o = new h2o('../views/TMHome.djhtml');

echo $h2o->render(array('VerifiedMembers'=>$N, 'UnverifiedMembers'=>$U));

?>