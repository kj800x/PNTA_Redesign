<?php

$filename = $_POST["filename"];

unlink("../../files/".$filename);

header( 'Location: http://'.$_SERVER["HTTP_HOST"].'/manage/FileUploadHome.php' );

?>
