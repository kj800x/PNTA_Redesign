<?php

include "../../include/allrequirements.php";

$N = MySqlQueryToArray(GetContacts());

$h2o = new h2o('../views/contacts.djhtml');

echo $h2o->render(array('Contacts'=>$N));

?>