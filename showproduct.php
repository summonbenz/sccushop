<?php
  header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
  header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
  header ("Cache-Control: no-cache, must-revalidate");
  header ("Pragma: no-cache");
  
  require "inc/setting.inc.php";
  session_start();
  if(!isset($_SESSION["memberid"])) header('Location:login.php?url=queue');
  
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
  <link rel="stylesheet" href="pos/css/style.css">
  
	<link rel="stylesheet" href="pos/responsive-tables.css">
	<script src="pos/js/jquery.js"></script>
	<script src="responsive-tables.js"></script>
<script> 	
	function changeStock(pid, name, wstock){
		//alert(pid);
		var add=parseInt(prompt("คุณต้องการเพิ่มสินค้า "+name+" เป็นจำนวนเท่าไหร่ ?","0"));

	if (add!=null) {
		 				if(add<=wstock) {
						$.ajax({
							url: 'admin/addstock.php',
							data: 'productid='+pid+'&stock='+add,
							type: "POST",
							cache: false
						}).done(function() {
							show();
						});
						
						} else {
							alert('ของมีไม่พอกับจำนวนในโกดังค่ะ');
						}
			
	  }
	}	   
	function changeWarehouse(pid, name) {
		var add=parseInt(prompt("คุณต้องการเพิ่มสินค้า "+name+" เป็นจำนวนเท่าไหร่ ?","0"));

		if (add!=null) {
			$.ajax({
							url: 'admin/addstockw.php',
							data: 'productid='+pid+'&stock='+add,
							type: "POST",
							cache: false
							
							}).done(function() {
								show();
							});
		}
	}
	function show() {
			$('#showwproduct').load('ajax/callwproduct.php');
			$('#showproduct').load('ajax/callproduct.php');
     }
   $(document).ready(function() {
      var auto_refresh = setInterval(show, 5000);
       show();
   });
</script>

<style>
 body {
	background:#fff;

 }
 a{
	color: #000;
 }
  a:hover{
	color: #bbb;
 }

.list td, .list th
{
	font-family: 'rsu-regular';
	font-size:1.2em;
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

<div class="small-6 large-6 large-6 columns">
<center>
<h2>สินค้าคงเหลือในโกดัง</h2>
	 <table>
	  <thead>
		<tr class="list">
		  <th>รูป</th>
		  <th width=600>ชื่อ</th>
		  <th>จำนวน</th> 
		</tr>
	  </thead>
	  <tbody id="showwproduct">

		</tbody>
	</table>
  <!-- Footer -->
</center>
  </div>

  <div class="small-6 large-6 large-6 columns">
<center>
<h2>สินค้าคงเหลือหน้าร้าน</h2>
	 <table>
	  <thead>
		<tr class="list">
		  <th>รูป</th>
		  <th width=600>ชื่อ</th>
		  <th>จำนวน</th> 
		</tr>
	  </thead>
	  <tbody id="showproduct">

		</tbody>
	</table>
  <!-- Footer -->
</center>
  </div>

    <div class="large-12 column" style="background:#444444; color: #cbcbcb; height:180px">
	<div class="footer">
          <!--p>© Copyright </p-->
		  <?php echo $info['footer']; ?></div>
    </div> 

   
</body>
</html>