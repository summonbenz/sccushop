<?php
	session_start();
	require ("../inc/setting.inc.php");
	$mysqli = new mysqli($config['host'], $config['user'], $config['pass'], $config['dbname']);
	if ($mysqli->connect_errno) {
		echo $mysqli->connect_error;
		exit;
	}
	$mysqli->query("SET NAMES UTF8");
//	$result = $link->query($link, "INSERT INTO buyproduct (VALUES ('1', '7', '1');");
	//itemspid[] itemsprice[] "items[]" "tender total\\
	
	//get variable
	$total = $_POST['total'];
	$discount = $_POST['discount'];
	$tender = $_POST['tender'];
	$itemspid = $_POST['itemspid'];
	$itemsprice = $_POST['itemsprice'];
	$items = $_POST['items'];
	
	//$timestamp = time()+25200; //+7 hours
	//$datetime = date("Y-m-d H:i:s", $timestamp);
	


	//*** Start Transaction ***//
	$mysqli->autocommit(FALSE);
	$error = false;

	//STEP0 - Check Login Staff
	if(!isset($_COOKIE["memberid"])) {
	echo "<span style=\"color:#ff1e1e;\"><i class=\"fi-x\" style=\"font-size:5em;\"></i><br>กรุณากลับไปเข้าสู่ระบบใหม่ด้วยค่ะ</span>";
			//echo "C:".$_COOKIE["memberid"];
			$mysqli->rollback();
			$error = true;
			exit();
	}		
	//STEP0 - Check Cookie
	if(isset($_COOKIE["buyProduct"])) {
		echo "<span style=\"color:#ff1e1e;\"><i class=\"fi-x\" style=\"font-size:5em;\"></i><br>ไม่สามารถซื้อได้เนื่องจากคุณสั่งซื้อติดต่อกันซ้ำเยอะเกิน ติดต่อฝ่ายไอทีเพื่อขอเลขใบสั่งซื้อล่าสุดค่ะ</span>";
			echo "";
			$mysqli->rollback();
			$error = true;
			exit();
	}

	//STEP1 - Add to table 'order'
	$sql = "INSERT INTO `order` VALUES (NULL, '$total', '$tender', '$discount', '2', '$datetime', NULL, 0)";
	$result = $mysqli->query($sql);
	//echo $sql;
	if(!$result) { $mysqli->rollback(); }
	//echo $sql;
	//get pidproduct	
	$orderid = $mysqli->insert_id;
	
	//STEP2 - Add to table 'buyproduct'
	foreach($itemspid as $value => $n)
	{
		if($items[$value] != 0) {
			$sql = "INSERT INTO `buyproduct` VALUES ('$orderid', '$itemspid[$value]', '$items[$value]')";
			$result = $mysqli->query($sql);
		} else {
			echo "<span style=\"color:#ff1e1e;\"><i class=\"fi-x\" style=\"font-size:5em;\"></i><br>ไม่สามารถซื้อได้เนื่องจากระบบมีปัญหา กรุณาสั่งซื้อใหม่อีกครั้งค่ะ</span>";
			echo "";
			$mysqli->rollback();
			$error = true;
			break;
		}
	}
	
	//STEP3  - Remove stock from product
	foreach($itemspid as $value => $n)
	{
		$sql = "SELECT stock FROM product WHERE productid={$itemspid[$value]}";
		//echo $sql;
		$result = $mysqli->query($sql);
		$check = $result->fetch_row();
		if(($check[0] - $items[$value]) >= 0) {
			$sql = "UPDATE product SET stock = stock-{$items[$value]} WHERE productid={$itemspid[$value]}";
			//echo $sql;
			$result = $mysqli->query($sql);
		} else {
			echo "<span style=\"color:#ff1e1e;\"><i class=\"fi-x\" style=\"font-size:5em;\"></i><br>ไม่สามารถซื้อได้เนื่องจากสินค้ามีจำนวนไม่พอค่ะ</span>";
			echo "";
			$mysqli->rollback();
			$error = true;
			break;
		}
	}
	
	//STEP4  - Add staff to product membcontrolor
		$staffid = $_COOKIE["memberid"];
			if($staffid != NULL) {
			$sql = "INSERT INTO membcontrolor VALUES ('$orderid', '$staffid')";
			//echo $sql;
			$result = $mysqli->query($sql);
		} else {
			echo "<span style=\"color:#ff1e1e;\"><i class=\"fi-x\" style=\"font-size:5em;\"></i><br>กรุณากลับไปเข้าสู่ระบบใหม่ด้วยค่ะ</span>";
			$mysqli->rollback();
			$error = true;
		}

	//STEP5 - send to LOG
	$fn = $_SESSION["firstname"];
	$mysqli->query("INSERT INTO log (id, type, event, datetime) VALUES (NULL, '3', '$fn ได้เพิ่มใบสั่งซื้อ #{$orderid}', '$datetime');");
	
	//STEP6 - Check value and Total
	$result = $mysqli->query("SELECT SUM(piece*price) AS totalOrder FROM `order`AS ord LEFT OUTER JOIN buyproduct AS buy ON ord.orderid=buy.orderid  LEFT OUTER JOIN product ON product.productid = buy.productid  WHERE ord.orderid = {$orderid}");
	$row = $result->fetch_row();
	if($row[0] != $total) {
			//echo "<span style=\"color:#ff1e1e;\"><i class=\"fi-x\" style=\"font-size:5em;\"></i><br>ไม่สามารถซื้อได้เนื่องจากมีข้อมูลผิดพลาดทางด้านเทคนิค กรุณาสั่งซื้อใหม่ขออภัยในความไม่สะดวก</span>";
			echo "";
			$mysqli->rollback();
			$error = true;
	}

	//STEP7 - Record to Cookie
	setcookie ("buyProduct", "buyProduct", time() + 10);

	if(!$error) {
		$mysqli->commit();
		echo "<span style=\"color:#43ac6a;\"><i class=\"fi-check\" style=\"font-size:5em;\"></i><br>หมายเลขใบสั่งซื้อ: #{$orderid}</span>";
	} else {
		$mysqli->rollback();
	}
	$mysqli->close();
?>