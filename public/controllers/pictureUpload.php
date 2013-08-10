<?php
$renamed       = false;
$kevinerror    = 0;
$finalfilename = $_POST["filename"];
print_r($_FILES);
if (true) {
  if ($_FILES["file"]["error"] > 0) {
    header('Location: http://' . $_SERVER["HTTP_HOST"] . '/pictures.php?Error=' . $_FILES["file"]["error"]);
  } else {
    while (true) {
      if (file_exists("../../images/UserSubmittedPhotos/" . $finalfilename)) {
        $finalfilename = "Copy of " . $finalfilename;
        $renamed       = true;
      } else {
        break;
      }
    }
    echo("testing");
    move_uploaded_file($_FILES["file"]["tmp_name"], "../../images/UserSubmittedPhotos/" . $finalfilename);
    echo("movedfile");
  }
}
if ($renamed) {
  header('Location: http://' . $_SERVER["HTTP_HOST"] . '/pictures.php?Uploaded=1&Renamed=1&Name=' . $finalfilename);
} else {
  header('Location: http://' . $_SERVER["HTTP_HOST"] . '/pictures.php?Uploaded=1');
}
?>
