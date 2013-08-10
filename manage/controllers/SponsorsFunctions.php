<?php
include "../../include/functions.php";
//Check Post:action for what to do. 

if ($_POST["action"] == "E") //Edit
  {
  EditSponsor($_POST["id"], $_POST["name"], $_POST["description"], $_POST["url"], $_POST["order_in_list"], $_POST["logo"]);
  }

if ($_POST["action"] == "N") //Post
  {
  PostSponsor($_POST["name"], $_POST["description"], $_POST["url"], $_POST["order_in_list"], $_POST["logo"]);
  }
  
if ($_POST["action"] == "D") //Delete
  {
  DeleteSponsor($_POST["id"]);
  }
header( 'Location: http://'.$_SERVER["HTTP_HOST"].'/manage/SponsorsHome.php' ) ;
?>
