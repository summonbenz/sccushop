<?php
	session_start();
	require ("../inc/setting.inc.php");
	$mysqli = new mysqli($config['host'], $config['user'], $config['pass'], $config['dbname']);
	if ($mysqli->connect_errno) {
		echo $mysqli->connect_error;
		exit;
	}
	$status = (isset($_GET['status']))? $_GET['status'] : 1;
	$mysqli->query("SET NAMES UTF8");
	
	if($status == 3) {
		$sql = "SELECT orderid FROM `order` WHERE status = $status ORDER BY `order`.`orderid` ASC";
	} else if($status == 2){
		$sql = "SELECT orderid FROM `order` WHERE status = 2 OR status = 1 ORDER BY `order`.`orderid` ASC";
	
	}
	$result = $mysqli->query($sql);
	
	 while ($record = $result->fetch_object()) {  
		echo "<li><a href=\"#\" onclick=\"sendcom{$status}({$record->orderid});\">{$record->orderid}</a></li>";
	 }
?>