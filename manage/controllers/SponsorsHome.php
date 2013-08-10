<?php

include "../../include/allrequirements.php";

$N = MySqlQueryToArray(GetSponsors(0));

$h2o = new h2o('../views/SponsorsHome.djhtml');

echo $h2o->render(array('Sponsors'=>$N));

?>