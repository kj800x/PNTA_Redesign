<?php

include "../../include/allrequirements.php";

$files = array();

$dir = '../../files/';
$dh  = opendir($dir);
while (false !== ($filename = readdir($dh))) {
    if (!($filename == "." or $filename == "..")) {
        $files[] = $filename;
    }
}

$picfiles = array();

$dir = '../../images/';
$dh  = opendir($dir);
while (false !== ($filename = readdir($dh))) {
    if (!($filename == "." or $filename == "UserSubmittedPhotos" or $filename == "..")) {
        $picfiles[] = $filename;
    }
}

$h2o = new h2o('../views/FileUploadHome.djhtml');

echo $h2o->render(array('files'=>$files,'picfiles'=>$picfiles));

?>
