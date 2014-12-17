<?php
	session_start();
	require ("../inc/setting.inc.php");
	$mysqli = new mysqli($config['host'], $config['user'], $config['pass'], $config['dbname']);
	$mysqli->query("SET NAMES UTF8");
	if ($mysqli->connect_errno) {
		echo $mysqli->connect_error;
		exit;
	}
	
	$hour = date("H")+5;
	$day = date("Y-m-d");
	$minute = date("i");
	$second = date("s");
	$datetime = "$day $hour:$minute:$second";
	
	$orderid = (isset($_POST['orderid']))? $_POST['orderid'] : NULL;
	$status = (isset($_POST['status']))? $_POST['status'] : NULL;
	$mysqli->query("SET NAMES UTF8");
	
	if($status == 4) {
		$sql = "UPDATE `order` SET status = $status, dateReceive='$datetime' WHERE orderid =$orderid;";
	} else {
		$sql = "UPDATE `order` SET status = $status, dateReceive=NULL  WHERE orderid =$orderid;";
	}
	//echo $sql;
	
	$result = $mysqli->query($sql);
?>