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
	
if(!isset($_GET['catid'])) {
	$catid = 0;
} else {
	$catid = $_GET['catid'];
}
if(!isset($_GET['page'])) {
	$page = 1;
} else {
	$page = $_GET['page'];
}
if(!isset($_GET['q'])) {
	$q = NULL;
} else {
	$q = $_GET['q'];
}
$page--;
$item = 20;
	$sql = "SELECT * FROM product WHERE type<>3 AND type<>6";
if($catid!=0) {
	$sql .= " AND catid = $catid";
}
if($q) {
	$sql .= " AND pname LIKE '%$q%'";
}
$result_num = $mysqli->query($sql);
$allitem = $result_num->num_rows;
$allitem = ceil($allitem/$item);
$sql .= " LIMIT ".($page*$item).", $item";  
//echo $sql;
$result = $mysqli->query($sql);
if($result->num_rows == 0) {
	echo "<center><h3>Not Found!!</h3></center>";
}
while ($record = $result->fetch_object()) {  
$pid = $record->productid;
	if(($record->stock)<=0) {
		echo "<li class=\"product-all\"><a href=\"#\" onclick=\"alert('สินค้าหมดในขณะนี้ค่ะ');\"title=\"{$record->pname} เหลือ {$record->stock} ชิ้น\"><div class=\"product-group\" style=\"background-image:url('../productimages/{$record->pic}');background-size:100px 65px;background-repeat:no-repeat; background-position:center;\"><img src=\"img/soldout.png\"/></div><div class=\"product-item\">{$record->pname}</div></a></li>";
	} else {
		if($record->type == 2) {
			echo "<li class=\"product-all\"><a href=\"#\" onclick=\"opensub({$pid})\"><div class=\"product-group\" style=\"background-image:url('../productimages/{$record->pic}');background-size:100px 65px;background-repeat:no-repeat; background-position:center;\"></div><div class=\"product-item\">{$record->pname}</div></a></li>";
		} else if($record->type == 4) {
			echo "<li class=\"product-all\"><a href=\"#\" onclick=\"bundle({$pid})\"><div class=\"product-group\" style=\"background-image:url('../productimages/{$record->pic}');background-size:100px 65px;background-repeat:no-repeat; background-position:center;\"></div><div class=\"product-item\">{$record->pname}</div></a></li>";
		} else {
			echo "<li class=\"product-all\"><a href=\"#\" onclick=\"addItem({$record->productid},'{$record->pname}',{$record->price});\"title=\"{$record->pname} เหลือ {$record->stock} ชิ้น\"><div class=\"product-group\" style=\"background-image:url('../productimages/{$record->pic}');background-size:100px 65px;background-repeat:no-repeat; background-position:center;\"></div><div class=\"product-item\">{$record->pname}</div></a></li>";
		}
	}
} 
?>
<script>
$(".pagination>li").each( function(){ 
			this.parentNode.removeChild( this );  
}); 
if(currentPage == 1) {
	$(".pagination").append("<li class='arrow unavailable'><a>«</a></li>");
} else {
	$(".pagination").append("<li class='arrow'><a  onclick='previouspage(<?=$catid;?>)'>«</a></li>");
}
var allitem = <?php echo $allitem; ?>;
//alert(allitem);
for(i=1;i<=allitem;i++) {
		if(i==<?=($page+1);?>) {
				$(".pagination").append("<li class='current'><a onclick='loadpage("+i+", <?=$catid;?>)'>"+i+"</a></li>");	
		} else {
				$(".pagination").append("<li><a onclick='loadpage("+i+", <?=$catid;?>)'>"+i+"</a></li>");	
		}
}
if(currentPage == allitem) {
	$(".pagination").append("<li class='arrow unavailable'><a>»</a></li>");
} else {
	$(".pagination").append("<li class='arrow'><a onclick='nextpage(<?=$catid;?>)'>»</a></li>");
}
</script>
<?php
$mysqli->close();
?>