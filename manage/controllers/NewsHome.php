<?php

include "../../include/allrequirements.php";

$N = MySqlQueryToArray(GetNews(0));

$h2o = new h2o('../views/NewsHome.djhtml');

echo $h2o->render(array('News'=>$N));

?>