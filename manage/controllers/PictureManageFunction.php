<?php
include "../../include/functions.php";

if ($_POST["action"] == "D") //Delete
  {
  if ($_POST["directory"] == "Images") //Delete
    {
    unlink("../../images/".$_POST["filename"]);
    }
  elseif ($_POST["directory"] == "Temp")
    {
    unlink("../../images/UserSubmittedPhotos/".$_POST["filename"]);
    }
  }

if ($_POST["action"] == "M") //Move (aka, verify)
  {
  rename("../../images/UserSubmittedPhotos/".$_POST["filename"], "../../images/".$_POST["filename"]);
  }

if ($_POST["action"] == "R") //Rename
  {
  if ($_POST["directory"] == "Images") //Delete
    {
    rename("../../images/".$_POST["filename"], "../../images/".$_POST["newname"]);
    }
  elseif ($_POST["directory"] == "Temp")
    {
    rename("../../images/UserSubmittedPhotos/".$_POST["filename"], "../../images/UserSubmittedPhotos/".$_POST["newname"]);
    }
  }

header( 'Location: http://'.$_SERVER["HTTP_HOST"].'/manage/PictureManageHome.php' ) ;

?>
