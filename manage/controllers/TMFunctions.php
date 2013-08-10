<?php
include "../../include/functions.php";
//Check Post:action for what to do. 

if (!isset($_POST["verified"])):
  $_POST["verified"] = "0";
endif;

if ($_POST["action"] == "E") //Edit
  {
  EditMember($_POST["id"], $_POST["name"], $_POST["verified"] ,$_POST["homephone"], $_POST["houseaddress"], $_POST["yog"], $_POST["email"], $_POST["type"], $_POST["cellphone"]);
  }

if ($_POST["action"] == "N") //Post
  {
  PostMember($_POST["name"], $_POST["verified"], $_POST["homephone"], $_POST["houseaddress"], $_POST["yog"], $_POST["email"], $_POST["type"], $_POST["cellphone"]);
  }
  
if ($_POST["action"] == "V") //Verify
  {
  VerifyMember($_POST["id"]);
  }
  
if ($_POST["action"] == "D") //Delete
  {
  DeleteMember($_POST["id"]);
  }
header( 'Location: http://'.$_SERVER["HTTP_HOST"].'/manage/TMHome.php' ) ;
?>
