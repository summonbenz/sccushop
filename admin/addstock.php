<?php
	session_start();
	require ("../inc/setting.inc.php");
	$mysqli = new mysqli($config['host'], $config['user'], $config['pass'], $config['dbname']);
	$mysqli->query("SET NAMES UTF8");
	if ($mysqli->connect_errno) {
		echo $mysqli->connect_error;
		exit;
	}
	$productid = (isset($_POST['productid']))? $_POST['productid'] : NULL;
	$stock = (isset($_POST['stock']))? $_POST['stock'] : NULL;
	$mysqli->query("SET NAMES UTF8");
	
	$sql = "UPDATE product SET wStock = wStock - '$stock' WHERE productid =$productid;";
	$result = $mysqli->query($sql);

	$sql = "UPDATE product SET stock = stock + '$stock' WHERE productid =$productid;";
	$result = $mysqli->query($sql);
	

	$fn = $_SESSION["firstname"];

	$mysqli->query("INSERT INTO log (id, type, event, datetime) VALUES (NULL, '4', '$fn ได้เพิ่มสินค้าหน้าร้านรหัสสินค้า $productid จำนวน $stock ชิ้น', '$datetime');");
	
?>