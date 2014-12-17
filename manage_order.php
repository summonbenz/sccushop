<?php
  header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
  header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
  header ("Cache-Control: no-cache, must-revalidate");
  header ("Pragma: no-cache");
  
  require "inc/setting.inc.php";
  session_start();
  
  if(!isset($_SESSION["memberid"])) header('Location:login.php?url=manage_order');
  
	$oid = (isset($_GET['oid'])) ? $_GET['oid'] : NULL;
			$sql = "SELECT * FROM `order`AS ord ";
			$sql .= "INNER JOIN buyproduct AS buy ON ord.orderid=buy.orderid ";
			$sql .= "INNER JOIN product ON product.productid = buy.productid ";
			$sql .= "WHERE ord.status = 2 ";
			$sql .= "GROUP BY ord.orderid ORDER BY ord.orderid ASC";
			//echo $sql;
			
			//$sql = mysql_query($sqllist);
			$query = mysqli_query($connect, $sql);
			$check = mysqli_num_rows($query); 
			header('Content-Type: text/html; charset=utf-8');
			if($check == 0) { echo "<h1>ไม่มีใบจัดของในขณะนี้ค่ะ</h1>"; exit();}
	  ?>
<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" >
<head>
 <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
 <title><?php echo $info['name']; ?></title>
   <meta name="apple-mobile-web-app-capable" content="yes"/>
   
  <link rel="stylesheet" href="pos/css/normalize.css">
  <link rel="stylesheet" href="pos/css/foundation.css">
    <link rel="stylesheet" href="pos/css/foundation-icons.css" />
  <link rel="stylesheet" href="pos/css/style.css">
  
	<link rel="stylesheet" href="pos/responsive-tables.css">
	<script src="pos/js/jquery.js"></script>
	<script src="responsive-tables.js"></script>
<script> 		   
	var orderitem = new Array();
	<?php
			$count=0;
			$query = mysqli_query($connect, $sql);
			while ($result = mysqli_fetch_array($query, MYSQL_ASSOC)) {
				echo "orderitem[$count] = \"{$result['orderid']}\";\n";
			$count++;
			}
	?>
	var orderid;
	
	function next() {
			var last = orderitem.indexOf(orderid);
			if(last == -1) last = 0;
			var index = orderitem[last+1];
			//alert();
			show(index);
	}
	function show(oid) {
			if(oid == undefined) { oid = orderitem[0]; }
			//alert("OID = "+oid);
			$('#showorder').load('ajax/callorder.php', {oid: oid});	
			orderid = oid;
     }
	 //setserve
	function sendcom2(oid){
	//alert("OID :"+oid);
		$.ajax({
			url: 'ajax/setserve.php',
			method: 'POST',
			data: 'orderid='+oid,
			cache: false,
			success: function(data) {
				//alert(data);
				location.reload(); 
			}
		});
	}
   $(document).ready(function() {
		show();
   });
</script>

<style>
 body {
	background:#fff;
 }
 a{
	color: #fff;
 }
  a:hover{
	color: #bbb;
 }

.list td, .list th
{
	font-family: 'rsu-regular';
	font-size:1.5em;
}
.red td{
	background-color: #ff2626;
	color: #fff;
}
.yellow td{
	background-color: #fff4aa;

}
@media only screen and (max-width: 400px) {
	.list td, .list th
{
	font-size:1em;
}
}
</style>
</head>

<body>

<nav class="top-menu"  data-topbar> 
<span class="title-icon"><center><a href="index.php" style="text-decoration:none;color:#ffffff;"><?php echo $info['name']; ?></a></center></span>

  </nav>
<br>

<div class="large-12 columns">
<center>
<div id="showorder">
</div>
</center>
  </div>

    <div class="large-12 column" style="background:#444444; color: #cbcbcb; height:180px">
	<div class="footer">
          <!--p>© Copyright </p-->
		  <?php echo $info['footer']; ?></div>
    </div> 

   
</body>
</html>