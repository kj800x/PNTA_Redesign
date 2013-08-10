<?php
include "../../include/allrequirements.php";

PostMember($_POST["name"], 0, $_POST["homephone"], $_POST["houseaddress"], $_POST["yog"], $_POST["email"], $_POST["type"], $_POST["cellphone"]);

header('Location: http://' . $_SERVER["HTTP_HOST"] . '/?Joined=1');

?>