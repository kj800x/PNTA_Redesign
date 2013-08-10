<?php

include "../../include/allrequirements.php";

$N = MySqlQueryToArray(GetNews(2));

$h2o = new h2o('../views/main.djhtml');

echo $h2o->render(array('News'=>$N));

?>