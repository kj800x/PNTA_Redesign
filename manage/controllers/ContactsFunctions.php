<?php
include "../../include/functions.php";
//Check Post:action for what to do. 

if ($_POST["action"] == "E") //Edit
  {
  EditContact($_POST["id"], $_POST["name"], $_POST["role"], $_POST["email"]);
  }

if ($_POST["action"] == "N") //Post
  {
  PostContact($_POST["name"], $_POST["role"], $_POST["email"]);
  }
  
if ($_POST["action"] == "D") //Delete
  {
  DeleteContact($_POST["id"]);
  }
header( 'Location: http://'.$_SERVER["HTTP_HOST"].'/manage/ContactsHome.php' ) ;
?>