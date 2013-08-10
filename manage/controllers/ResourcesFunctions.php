<?php
include "../../include/functions.php";
//Check Post:action for what to do. 

if ($_POST["action"] == "E") //Edit
  {
  EditResource($_POST["id"], $_POST["name"], $_POST["description"], $_POST["url"]);
  }

if ($_POST["action"] == "N") //Post
  {
  PostResource($_POST["name"], $_POST["description"], $_POST["url"]);
  }
  
if ($_POST["action"] == "D") //Delete
  {
  DeleteResource($_POST["id"]);
  }
header( 'Location: http://'.$_SERVER["HTTP_HOST"].'/manage/ResourcesHome.php' ) ;
?>