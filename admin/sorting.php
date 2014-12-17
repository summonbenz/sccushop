<?php
	session_start();
	require ("../inc/setting.inc.php");
	$mysqli = new mysqli($config['host'], $config['user'], $config['pass'], $config['dbname']);
	$mysqli->query("SET NAMES UTF8");
	if ($mysqli->connect_errno) {
		echo $mysqli->connect_error;
		exit;
	}
	
	$_sorting = $_POST['recordsArray'];
	$_sorting_rows = count($_sorting);
	for($i=0;$i<$_sorting_rows;$i++) {
		$_update_sorting = "UPDATE category SET ranking ='".$i."' WHERE catid ='".$_sorting[$i]."';";
		$mysqli->query($_update_sorting);
	}
	$json['status'] = 1;
	echo json_encode($json);
?>