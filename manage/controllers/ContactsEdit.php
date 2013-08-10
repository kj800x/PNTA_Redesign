<?php

include "../../include/allrequirements.php";

$ID = $_GET["id"];

$N = MySqlQueryToArray(GetContactById($ID));

$h2o = new h2o('../views/ContactsEdit.djhtml');

echo $h2o->render(array('contact'=>$N[0]));

?>
