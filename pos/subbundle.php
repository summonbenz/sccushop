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

$sql2 = "SELECT * FROM product WHERE productid=$pid";
$result2 = $mysqli->query($sql2);
$record2 = $result2->fetch_object();
$parentid = $record2->parentid;
$subitem = explode(",", $parentid);

for($i = 0;$i<sizeof($subitem);$i++){
	$sql3 = "SELECT * FROM product WHERE productid=$subitem[$i]";
	$result3 = $mysqli->query($sql3);
	$record3 = $result3->fetch_object();
?>
<h2>สินค้าย่อย : <?php echo $record3->pname;?> <?php if($record3->setname) { echo "<font color=red>($record3->setname)</font>"; }?></h2>
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
	$sql = "SELECT * FROM product WHERE parentid=$subitem[$i] AND type<>4 ORDER BY productid";
	$result = $mysqli->query($sql);
	$allitem = $result->num_rows;
	if($result->num_rows == 0) {
	echo "<center><h3>Not Found!!</h3></center>";
	} else {
		while ($record = $result->fetch_object()) {  
		echo "<tr>";
			if(($record->type)==5) {
				echo "<td>{$record->pname}</td><td>{$record->price}</td><td>{$record->stock}</td>";
				echo " <td><a href='#' onclick=\"discountBundle({$record->price});\"><span class='round info label'>เพิ่มส่วนลด</span></a></td>";
			} else if(($record->stock)<=0) {
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
 <?php } ?>
<center>
	<a href="javascript:jQuery.fancybox.close();" class="radius secondary label">[X] ปิดหน้าต่างนี้</a>
</center>