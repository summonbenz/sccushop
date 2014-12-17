<?php  
header("Content-type:text/html; charset=UTF-8");          
header("Cache-Control: no-store, no-cache, must-revalidate");         
header("Cache-Control: post-check=0, pre-check=0", false);         
error_reporting(0);
	require ("../../inc/setting.inc.php");
	$mysqli = new mysqli($config['host'], $config['user'], $config['pass'], $config['dbname']);
	if ($mysqli->connect_errno) {
		echo $mysqli->connect_error;
		exit;
	}
	$mysqli->query("SET NAMES UTF8");
if(!isset($_GET['q'])) {
	$q = 0;
} else {
	$q = $_GET['q'];
}
	$sql = "SELECT * FROM product WHERE productid=$q";

$result_num = $mysqli->query($sql);
$allitem = $result_num->num_rows;
//echo $sql;
$result = $mysqli->query($sql);
if($result->num_rows == 0) {
	echo "Not Found!!";
}
while ($record = $result->fetch_object()) {  
	echo "{$record->pname}";
}
?>