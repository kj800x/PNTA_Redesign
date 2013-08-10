<?php
include "../../include/allrequirements.php";
//Check Post:action for what to do. 

if ($_POST["action"] == "E") //Edit
  {
  EditNews($_POST["id"], $_POST["author"], $_POST["content"], $_POST["title"]);
  }

if ($_POST["action"] == "N") //Post
  {
  PostNews($_POST["author"], $_POST["content"], $_POST["title"]);
  }
  
if ($_POST["action"] == "D") //Delete
  {
  DeleteNews($_POST["id"]);
  }
header( 'Location: http://'.$_SERVER["HTTP_HOST"].'/manage/NewsHome.php' ) ;
?>