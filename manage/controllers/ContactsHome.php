<?php

include "../../include/allrequirements.php";

$N = MySqlQueryToArray(GetContacts(0));

$h2o = new h2o('../views/ContactsHome.djhtml');

echo $h2o->render(array('Contacts'=>$N));

?>