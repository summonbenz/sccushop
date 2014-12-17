<?php
	session_start();
	require ("../inc/setting.inc.php");
	$mysqli = new mysqli($config['host'], $config['user'], $config['pass'], $config['dbname']);
	if ($mysqli->connect_errno) {
		echo $mysqli->connect_error;
		exit;
	}
	$mysqli->query("SET NAMES UTF8");


	$fn = $_SESSION["firstname"];
	unset($_COOKIE['memberid']);

	$mysqli->query("INSERT INTO log (id, type, event, datetime) VALUES (NULL, '2', '$fn ได้ออกจากระบบ', '$datetime');");
		

	session_destroy();
?>