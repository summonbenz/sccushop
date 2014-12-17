<?php
	session_start();
	require ("../inc/setting.inc.php");
	$mysqli = new mysqli($config['host'], $config['user'], $config['pass'], $config['dbname']);
	if ($mysqli->connect_errno) {
		echo $mysqli->connect_error;
		exit;
	}
	$mysqli->query("SET NAMES UTF8");
	$username = $_POST['txtUsername'];
	$password = $_POST['txtPassword'];
	
	$sql = "SELECT * FROM `member_staff`WHERE username='$username' AND password='$password'";
	$result = $mysqli->query($sql);
	$check =$result->num_rows;
	if($check == 0){
		echo "false";
	} else { //login success
		$record = $result->fetch_object();
		$mid = $record->memberid;
		$fn = $record->nickname;
		$_SESSION["memberid"] = $mid;
		$_SESSION["firstname"] = $fn;
		
		setcookie("memberid",$mid, time()+3600*24);
		$mysqli->query("INSERT INTO log (id, type, event, datetime) VALUES (NULL, '1', '$fn ได้เข้าสู่ระบบ', '$datetime');");
		echo $record->memberid;
		echo "|";
		echo $record->firstname;
	}
?>