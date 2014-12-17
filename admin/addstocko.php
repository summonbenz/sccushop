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
	$orderid = (isset($_POST['oid']))? $_POST['oid'] : NULL;
	$mysqli->query("SET NAMES UTF8");
	
	$mysqli->autocommit(FALSE);
	$error = false;

		$sql = "SELECT stock FROM product WHERE productid=$productid";
		$result = $mysqli->query($sql);
		$check = $result->fetch_row();
		if(($check[0] - $stock) >= 0) {
			$sql = "UPDATE product SET stock = stock-$stock WHERE productid=$productid";
			//echo $sql;
			$result = $mysqli->query($sql);
		} else {
			echo "<span style=\"color:#ff1e1e;\"><i class=\"fi-x\" style=\"font-size:5em;\"></i><br>ไม่สามารถซื้อได้เนื่องจากสินค้ามีจำนวนไม่พอค่ะ</span>";
			echo "";
			$mysqli->rollback();
			$error = true;
		}

	$sql = "UPDATE buyproduct SET piece = piece +'$stock' WHERE orderid = $orderid AND productid = $productid;";
	$result = $mysqli->query($sql);
	if(!$result) { $mysqli->rollback(); }

	if(!$error) {
		$mysqli->commit();
		} else {
		$mysqli->rollback();
	}
	$mysqli->close();
	
	$fn = $_SESSION["firstname"];

	$mysqli->query("INSERT INTO log (id, type, event, datetime) VALUES (NULL, '4', '$fn ได้แก้ไขรหัสสินค้า $productid ใบสั่งซื้อ $orderid จำนวน $stock ชิ้น', '$datetime');");
	
?>