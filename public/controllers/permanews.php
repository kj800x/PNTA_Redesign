<?php
$id = $_GET["id"];
include "../../include/allrequirements.php";
$NewsArray = MySqlQueryToArray(GetNewsByID($id));


$h2o = new h2o('../views/permanews.djhtml');

echo $h2o->render(array('News'=>$NewsArray[0]));

?>