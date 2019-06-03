<?php
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

define("DB_HOSTNAME",$url["host"]);
define("DB_USERNAME", $url["user"]);
define("DB_PASSWORD", $url["pass"]);
define("DB_DATABASE", substr($url["path"], 1));

// define("DB_HOSTNAME", "localhost");
// 	define("DB_USERNAME", "root");
// 	define("DB_PASSWORD", "");
// 	define("DB_DATABASE", "projeto_selfie");
define("DB_CHARSET", "utf8");
// if ($_SERVER['HTTP_HOST']=='localhost'):
// 	// BANCO DE DADOS LOCALHOST
// 	define("DB_HOSTNAME", "localhost");
// 	define("DB_USERNAME", "root");
// 	define("DB_PASSWORD", "");
// 	define("DB_DATABASE", "projeto_selfie");
// 	define("DB_CHARSET", "utf8");
// else:
// 	// BANCO DE DADOS HOST
// 	define("DB_HOSTNAME", "mysql.hostinger.com.br");
// 	define("DB_USERNAME", "u733009724_tcc");
// 	define("DB_PASSWORD", "dhominustcc");
// 	define("DB_DATABASE", "u733009724_tcc");
// 	define("DB_CHARSET", "utf8");
// endif;

define('path', '');
// phpinfo();
// if (strpos($_SERVER['DOCUMENT_ROOT'], "/") === true)
// {
// 	$separator = "/";
// }else{
// 	$separator = null;
// }
$separator = '/';
if (path) {
	define("url", 'https://'.$_SERVER['HTTP_HOST'] . '/' . path . '/');
	define("root", $_SERVER['DOCUMENT_ROOT'] . $separator . path . '/');
}else{
	define("url", 'https://'.$_SERVER['HTTP_HOST'] . '/');
	define("root", $_SERVER['DOCUMENT_ROOT'] . $separator);
}

define("url_panel", url . "admin/");
define("name", 'LiveImage: Você ao Vivo!');

define("root_panel", root."admin/");

require_once 'database.php';

require_once root.'config/functions.php';

date_default_timezone_set('America/Sao_Paulo');
session_start();

$errors = 0;
if ($errors == 1) {
	ini_set('display_errors', 'On');
	ini_set('display_startup_errors', 'On');
}else{
	ini_set('display_errors', 'Off');
	ini_set('display_startup_errors', 'Off');
}
?>