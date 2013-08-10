<?php

if ($_POST["typeoffile"] == "I")
{
  if ($_POST["batch"] == "1"){
    $finalfilename = $_POST["filename"];
    move_uploaded_file($_FILES["file"]["tmp_name"], "../../images/" . $finalfilename);
    unzip("../../images/" . $finalfilename);
    header( 'Location: http://pnta.org/manage/FileUploadHome.php');
  }
  else
  {
      $renamed = false;
      $kevinerror = 0;
      $finalfilename = $_POST["filename"];
      if (true)
        {
        if ($_FILES["file"]["error"] > 0)
          {
              header( 'Location: http://'.$_SERVER["HTTP_HOST"].'/manage/FileUploadHome.php?Error='.$_FILES["file"]["error"] );
          }
        else
          {
          while (true)
            {
            if (file_exists("../../images/" . $finalfilename))
              {
            $finalfilename= "Copy of ".$finalfilename;
            $renamed = true;
              }
            else
              {
              break;
              }
            }
          move_uploaded_file($_FILES["file"]["tmp_name"], "../../images/" . $finalfilename);
          }
        }
        header( 'Location: http://'.$_SERVER["HTTP_HOST"].'/manage/FileUploadHome.php');
	}
}
else
{
  if ($_POST["batch"] == "1"){
    $finalfilename = $_POST["filename"];
    move_uploaded_file($_FILES["file"]["tmp_name"], "../../files/" . $finalfilename);
    unzip("../../files/" . $finalfilename);
    header( 'Location: http://'.$_SERVER["HTTP_HOST"].'/manage/FileUploadHome.php');
  }
  else
  {
      $kevinerror = 0;
      if (true)
        {
        if ($_FILES["file"]["error"] > 0)
          {
          echo "Return Code: " . $_FILES["file"]["error"] . "<br />";$kevinerror = 1;
          }
        else
          {
          if (file_exists("../../files/" . $_POST["filename"]))
            {
            echo $_POST["filename"] . " already exists. ";$kevinerror = 1;
            }
          else
            {
            move_uploaded_file($_FILES["file"]["tmp_name"],
            "../../files/" . $_POST["filename"]);
            }
          }
        }
      else
        {
        echo "Invalid file";$kevinerror = 1;
        }
      if ($kevinerror == 0){
          header( 'Location: http://'.$_SERVER["HTTP_HOST"].'/manage/FileUploadHome.php' ) ;
      }
    }
}
?> 
