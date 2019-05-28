<?php include '../config/config.php';
$url = path("assets/images/1/491.jpg");
var_dump(is_file($url));
echo $url . "<br>";
$url2 = explode("/", $url);
echo $url2[count($url2)-2];
$url = basename($url);
echo $url;
var_dump(strpos($url, "assets/images/" . strstr($url,"assets/images")));

