<?php
  header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
  header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
  header ("Cache-Control: no-cache, must-revalidate");
  header ("Pragma: no-cache");
  
  require "inc/setting.inc.php";
    session_start();
  if(!isset($_SESSION["memberid"])) header('Location:login.php?url=showprint');
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
	function show() {
			$('#showproduct').load('ajax/callprint.php');
			$('#lastprint').load('ajax/callprint2.php');
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
<h2>แสดงใบสั่งสินค้าที่ยังไม่ได้พิมพ์</h2>
<div id="lastprint">Loading...</div><br>
	 <table>
	  <thead>
		<tr class="list">
		  <th width=100>ใบสั่งซื้อ</th>
		  <th width=200 >จำนวนเงิน</th>
		  <th width=200>สถานะ</th> 
		  <th></th>
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