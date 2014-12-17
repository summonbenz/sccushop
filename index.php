<?php
  header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
  header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
  header ("Cache-Control: no-cache, must-revalidate");
  header ("Pragma: no-cache");
  
  require "inc/setting.inc.php";
  ?>	
<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" >
<head>
 <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
 <title><?php echo $info['name']; ?></title>
   <meta name="apple-mobile-web-app-capable" content="yes"/>
  <!-- If you are using CSS version, only link these 2 files, you may add app.css to use for your overrides if you like. -->
  <link rel="stylesheet" href="pos/css/normalize.css">
  <link rel="stylesheet" href="pos/css/foundation.css">
  <link rel="stylesheet" href="pos/css/foundation-icons.css" />
  <link rel="stylesheet" href="pos/css/style.css">
  <script src="pos/js/vendor/modernizr.js"></script>
  
	<link rel="stylesheet" href="pos/responsive-tables.css">
		<script src="pos/javascripts/jquery.min.js"></script>
	<script src="responsive-tables.js"></script>
</head>
<body  onload="doStart()">

 <!-- body content here -->
 <script src="js/vendor/jquery.js"></script>
 <script src="js/foundation.min.js"></script>
 <script>
 $(document).foundation();
 function about() {
	alert('จัดทำโดย\nสร้างโดยฝ่ายไอทีรุ่นที่ 46 ชมรมการศึกษา คณะวิทยาศาสตร์ จุฬาลงกรณ์มหาวิทยาลัย');
 }
 function coming() {
	alert('ยังไม่เปิดใช้บริการในส่วนนี้ค่ะ');
 }
 </script>
 <style>
 body {
	background:#333333;
 }
 a{
	color: #fff;
 }
  a:hover{
	color: #bbb;
 }
 </style>
<nav class="top-menu"  data-topbar> 
<span class="title-icon"><center><?php echo $info['name']; ?></center></span>

  </nav>
<br>

<div class="large-12 columns" style="padding-top:20px;background:#fff;">
      <ul class="large-block-grid-5 medium-block-grid-5 small-block-grid-3" style="text-align:center; color:#000000; ">
		<li>
		   <a href="pos/">
				<div class="menu">
					<div class="wrose">
							<div class="menu-icon">
								<i class="fi-shopping-cart"></i>
							</div>
						   <div class="text-icon">
						   ระบบขายสินค้า
						   </div>
						</div>
					</div>
			</a>
		 </li>
		 <li>
		   <a href="admin/">
				<div class="menu">
					<div class="wyellow">
							<div class="menu-icon">
								<i class="fi-torso"></i>
							</div>
						   <div class="text-icon">
						   หน้าผู้จัดการร้าน
						   </div>
						</div>
					</div>
			</a>
		 </li>
		 
		  <li>
		   <a href="queue.php">
				<div class="menu">
					<div class="wgreen">
							<div class="menu-icon">
								<i class="fi-thumbnails"></i>
							</div>
						   <div class="text-icon">
						   แสดงคิว
						   </div>
						</div>
					</div>
			</a>
		 </li>
		 
		  <li>
		   <a href="print/printall.php">
				<div class="menu">
					<div class="wblue">
							<div class="menu-icon">
								<i class="fi-print"></i>
							</div>
						   <div class="text-icon">
						  ใบสรุปยอดรวม
						   </div>
						</div>
					</div>
			</a>
		 </li>
		 
		  <li>
		   <a href="showproduct.php">
				<div class="menu">
					<div class="wgrey">
							<div class="menu-icon">
								<i class="fi-list-bullet"></i>
							</div>
						   <div class="text-icon">
						   แสดงสินค้าคงเหลือ
						   </div>
						</div>
					</div>
			</a>
		 </li>
		 <li>
		   <a href="manage_order.php">
				<div class="menu">
					<div class="wrose">
							<div class="menu-icon">
								<i class="fi-checkbox"></i>
							</div>
						   <div class="text-icon">
						   แสดงใบจัดของ
						   </div>
						</div>
					</div>
			</a>
		 </li>
		  <li>
		   <a href="admin/index.php?page=stat">
				<div class="menu">
					<div class="wyellow">
							<div class="menu-icon">
								<i class="fi-graph-bar"></i>
							</div>
						   <div class="text-icon">
						   สถิติรวม
						   </div>
						</div>
					</div>
			</a>
		 </li>
		 
		  
		 
		  <li>
		    <a href="javascript:about()">
				<div class="menu">
					<div class="wgreen">
							<div class="menu-icon">
								<i class="fi-info"></i>
							</div>
						   <div class="text-icon">
						   เกี่ยวกับเรา
						   </div>
						</div>
					</div>
			</a>
		 </li>
		 
		  <li>
		   <a href="usermanual.pdf">
				<div class="menu">
					<div class="wblue">
							<div class="menu-icon">
								<i class="fi-book"></i>
							</div>
						   <div class="text-icon">
						   คู่มือการใช้งาน
						   </div>
						</div>
					</div>
			</a>
		 </li>
		 
		  <li>
		   <a href="http://www.whatismyip.com/">
				<div class="menu">
					<div class="wgrey">
							<div class="menu-icon">
								<i class="fi-sound"></i>
							</div>
						   <div class="text-icon">
						   เช็คหมายเลข IP
						   </div>
						</div>
					</div>
			</a>
		 </li>
		 
      
      </ul>

  <!-- Footer -->
  </div>

    <div class="large-12 column" style="background:#333333; color: #cbcbcb; height:180px">
	<div class="footer">
          <!--p>© Copyright </p-->
		  <?=$info['footer'];?>
		  </div>
    </div> 

   
</body>
</html>