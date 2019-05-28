<?php
require '../config/config.php';

if (isset($_SESSION["user"]) || isset($_SESSION["pass"]))
{
	if (DBRead('users', "where user = '{$_SESSION['user']}' and pass = password('{$_SESSION['pass']}')"))
	{
		echo json_encode(true);
		$_SESSION['auth'] = true;
	}else
	{
		echo json_encode(false);
		$_SESSION['auth'] = false;
	}
}
elseif (isset($_SESSION['auth']))
{
	if ($_SESSION['auth'] == true)
	{
		echo json_encode(true);
		$_SESSION['auth'] = true;
	}else
	{
		echo json_encode(false);
		$_SESSION['auth'] = false;
	}
}else{
	echo json_encode(false);
	$_SESSION['auth'] = false;
}

?>