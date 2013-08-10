<?php

include "../../include/allrequirements.php";

$N = MySqlQueryToArray(GetNews(0));

$h2o = new h2o('../views/news.djhtml');

echo $h2o->render(array('News'=>$N));

?>