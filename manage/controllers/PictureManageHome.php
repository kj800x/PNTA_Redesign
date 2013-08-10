<?php

include "../../include/allrequirements.php";

$veripicfiles = array();
$notveripicfiles = array();

$dir = '../../images/UserSubmittedPhotos/';
$dh  = opendir($dir);
while (false !== ($filename = readdir($dh))) {
    if (!($filename == "." or $filename == "..")) {
        $notveripicfiles[] = $filename;
    }
}

$dir = '../../images/';
$dh  = opendir($dir);
while (false !== ($filename = readdir($dh))) {
    if (!($filename == "." or $filename == "UserSubmittedPhotos" or $filename == "..")) {
        $veripicfiles[] = $filename;
    }
}

$h2o = new h2o('../views/PictureManageHome.djhtml');

echo $h2o->render(array('notveripicfiles'=>$notveripicfiles,'veripicfiles'=>$veripicfiles));

?>
