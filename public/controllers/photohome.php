<?php

include "../../include/allrequirements.php";

$files = array();

    $dir = '../../images/';
    $dh  = opendir($dir);
    while (false !== ($filename = readdir($dh))) {
        if (!(substr($filename,0,1) == "." || $filename == "UserSubmittedPhotos"))
        {
            $files[] = $filename;
        }
    }

$h2o = new h2o('../views/photohome.djhtml');

echo $h2o->render(array('Files'=>$files));

?>