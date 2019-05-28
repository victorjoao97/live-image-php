<?php
require '../config/config.php';

Header("content-type: application/x-javascript");

if (!isset($_GET['q'])) {

    echo 'var galleryarray=new Array();';

}else{

    $event = DBRead('events',"where id = '" . $_GET['q'] . "' limit 1")[0];

    if ($event) {

        function returnimages($dirname) {
            global $event;
            //$pattern="(\.jpg$)|(\.png$)|(\.jpeg$)|(\.gif$)"; //valid image extensions
            $pattern = "/(\.jpg$)|(\.png$)|(\.jpeg$)|(\.gif$)/";
            $files = array();
            $curimage=0;
            if($handle = opendir($dirname)) {
                while(false !== ($file = readdir($handle))){
                    if(preg_match($pattern, $file)){
                        echo 'galleryarray['.$curimage.']="'.url.'assets/images/events/'.$event['id'].'/'.$file.'";';
                        $curimage++;
                    }
                }
         
                closedir($handle);
            }
            return($files);
        }

        echo 'var galleryarray=new Array();'; //Define array in JavaScript
        returnimages(root . "assets/images/events/" . $event['id']); //Output the array elements containing the image file names
    }else{
        echo 'var galleryarray=new Array();';
    }

}
?>