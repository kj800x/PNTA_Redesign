<?php

header('Content-type: application/rss+xml; charset=utf-8');

include "../../include/allrequirements.php";

$temp = MySqlQueryToArray(GetNews(5));
$N = Array();

foreach ($temp as $value){
    $value["alteredpubdate"] = date("r", strtotime($value["dateposted"]));
    $value["content"] = $value["content"];
    $N[] = $value;
}

$h2o = new h2o('../views/rss.djrss');

echo $h2o->render(array('News'=>$N));

?>