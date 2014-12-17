<?php
	session_start();
	require ("../inc/setting.inc.php");
	$mysqli = new mysqli($config['host'], $config['user'], $config['pass'], $config['dbname']);
	if ($mysqli->connect_errno) {
		echo $mysqli->connect_error;
		exit;
	}
	$orderid = (isset($_POST['orderid']))? $_POST['orderid'] : NULL;
	$mysqli->query("SET NAMES UTF8");
	
	$sql = "UPDATE `order` SET `status` = '4', `dateReceive` = '$datetime' WHERE `orderid` =$orderid;";
	$result = $mysqli->query($sql);
	
	
?>