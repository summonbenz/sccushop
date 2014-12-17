<?php
//Config Name Shop Here
/***********************************************************/
$info['name'] = "ชมรมการศึกษา";
$info['address'] = "254 ถนนพญาไท แขวงวังใหม่ <br>เขตปทุมวัน กทม. 10330 ";
$info['email'] = "";
$info['phone'] = "02-215-3555";

$info['footer'] = "สร้างโดยฝ่ายไอทีรุ่นที่ 46 ชมรมการศึกษา คณะวิทยาศาสตร์ จุฬาลงกรณ์มหาวิทยาลัย";
//Config Database
$config['host'] = "localhost";
$config['user'] = "sccushop";
$config['pass'] = "science";
$config['dbname'] = "sccushop";

$config['addhour'] = 6; //GMT +5

	$connect = mysqli_connect("localhost", "sccushop", "science", "sccushop") or die("Error connect database");
	mysqli_query($connect, "SET NAMES UTF8");

	//$hour = date("H")+$config['addhour'];

	$datetime = date("Y-m-d H:i:s", time()+(3600*$config['addhour']));
?>