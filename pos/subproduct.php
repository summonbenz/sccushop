<?php
header("Content-type:text/html; charset=UTF-8");          
header("Cache-Control: no-store, no-cache, must-revalidate");         
header("Cache-Control: post-check=0, pre-check=0", false);         
	require ("../inc/setting.inc.php");
	$mysqli = new mysqli($config['host'], $config['user'], $config['pass'], $config['dbname']);
	if ($mysqli->connect_errno) {
		echo $mysqli->connect_error;
		exit;
	}
	$mysqli->query("SET NAMES UTF8");
if(!isset($_GET['pid'])) {
	$pid = 0;
} else {
	$pid = $_GET['pid'];
}

$sql = "SELECT * FROM product WHERE productid=$pid";
$result = $mysqli->query($sql);
$record = $result->fetch_object();
?>
<h2>สินค้าย่อย : <?php echo $record->pname;?></h2>
<table>
  <thead>
    <tr>
      <th>ชื่อ</th>
      <th width="50">ราคา</th>
	  <th width="50">เหลือ</th>
      <th width="80">เพิ่มสินค้า	</th>
    </tr>
  </thead>
  <tbody>
  <?php
	$sql = "SELECT * FROM product WHERE parentid=$pid AND type=3 ORDER BY productid";
	$result = $mysqli->query($sql);
	$allitem = $result->num_rows;
	if($result->num_rows == 0) {
	echo "<center><h3>Not Found!!</h3></center>";
	} else {
		while ($record = $result->fetch_object()) {  
		echo "<tr>";
			if(($record->stock)<=0) {
				echo "<td>{$record->pname}</td><td>{$record->price}</td><td>{$record->stock}</td>";
				echo " <td><a href='#' onclick=\"alert('สินค้าหมดในขณะนี้ค่ะ');\"><span class='round alert label'>สินค้าหมด</span></a></td>";
			} else {
				echo "<td>{$record->pname}</td><td>{$record->price}</td><td>{$record->stock}</td>";
				echo " <td><a href=\"#\" onclick=\"addItem({$record->productid},'{$record->pname}',{$record->price});\"title=\"{$record->pname}\"><span class='round success label'>เพิ่มสินค้า</span></a></td>";
			}
	}
	echo "</tr>";
	} 
  ?>
  </tbody>
  </table>
<center>
	<a href="javascript:jQuery.fancybox.close();" class="radius secondary label">[X] ปิดหน้าต่างนี้</a>
</center>