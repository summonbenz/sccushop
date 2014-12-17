<?php
	header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	session_start();
	require "../inc/setting.inc.php";
	$mysqli = new mysqli($config['host'], $config['user'], $config['pass'], $config['dbname']);
	$mysqli->query("SET NAMES UTF8");
	
	$firstname = (isset($_SESSION['firstname'])) ? $_SESSION['firstname'] : '';
?>
<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<head>
 <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
 <title>CoinCoin*</title>
  <link rel="apple-touch-icon" href="img/ios-icon.png"/>
  <meta name="apple-mobile-web-app-capable" content="yes"/>
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/foundation.css">
  <link rel="stylesheet" href="css/foundation-icons.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/cal.css">
  <link type="text/css" href="css/fancybox/jquery.fancybox.css" rel="stylesheet" media="all" />
  <script src="js/vendor/modernizr.js"></script>
  
	<link rel="stylesheet" href="responsive-tables.css">
	<script src="js/jquery-2.1.0.min.js"></script>
	<script src="responsive-tables.js"></script>
	<script language="JavaScript" src="js/numeral.js"> </script>
	<script language="JavaScript" src="js/pos.js"> </script>
	<script language="JavaScript" src="js/cal.js"> </script>
	<script language="JavaScript" type="text/javascript">
var req;
function Inint_AJAX() {
   try { return new ActiveXObject("Msxml2.XMLHTTP"); } catch(e) {} //IE
   try { return new ActiveXObject("Microsoft.XMLHTTP"); } catch(e) {} //IE
   try { return new XMLHttpRequest(); } catch(e) {} //Native Javascript
   alert("XMLHttpRequest not supported")
   return null
}
function startCallback() {
     if (req.readyState == 4) {
          if (req.status == 200) {
               document.getElementById("time").innerHTML="ขณะนี้เวลา : "+req.responseText; //รับค่ากลับมา และ แสดงผล
               setTimeout("doStart()", 10000); //Auto Refresh กลับมาอ่าน เวลาทุก 1 วินาที
          } else {
          	alert("การเชื่อมต่ออินเตอร์เน็ตมีปัญหา \nโปรดตรวจสอบสัญญาณ wifi ที่เชื่อมต่ออยู่ในขณะนี้ด้วยค่ะ");
          	setTimeout("doStart()", 10000);
          }
     }
}
function doStart() {
     req = Inint_AJAX();
     req.open("POST", 'time.php?' + new Date().getTime(), true);
     req.onreadystatechange = startCallback; //กำหนด ฟังก์ชั่นเพื่อส่งค่ากลับ
     req.send(null);
};
function showNotice() {
	 $('#notice').load('callnotice.php');
}
$( document ).ready(function() {
	var auto_refresh = setInterval(doStart, 10000);
       doStart();
    var auto_refresh2 = setInterval(showNotice, 10000);
       showNotice();
     });
</script>
</head>
<body>
 <!-- body content here -->
 <script src="js/vendor/jquery.js"></script>

 <script src="js/foundation.min.js"></script>
 	<!-- fancybox script -->
	<script type="text/javascript" src="js/jquery.fancybox.pack.js"></script>
 <script>
 $(document).foundation();
 </script>
<nav class="top-bar" data-topbar > 
 <ul class="title-area">
    <li class="name">
      <h1><a href="../index.php"><?php echo $info['name'] ?></a></h1>
    </li>
    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
  </ul>
<section class="top-bar-section">

    <!-- Right Nav Section -->

    <ul class="right">
	<li class="divider"></li>
     <li> <a href="#">สวัสดี, <b><span id="manager"><?php echo $firstname;?> </span></b></a> </li>
	   
	<li class="divider"></li>
     <li> <a href="#"><div id="time"></div></a> </li>
	 
	  <li class="divider"></li>
	    <li class="has-form">
        <a href="#" class="button" onclick="logout()" style="background: #14b9d5;"><i class="fi-power"></i>&nbsp;ออกจากระบบ</a>
      </li>
    </ul>

    <!-- Left Nav Section -->
    <ul class="left">
      <li><a href="#">ระบบขายสินค้าหน้าร้าน</a></li>
    </ul>
  </section>	
  </nav>

 <br>
 <div class="row">
 	<div class="large-12 small-12 columns">
 		<div id="notice" data-alert>
  <a href="#" class="close">&times;</a>
</div>
 	</div>
 </div>
  <!-- Main Page Content and Sidebar -->
 
  <div class="row">
 
    <!-- Contact Details -->
    <div class="large-7 small-7 columns"><br>
	<!--nav class="breadcrumbs"> <a href="#">All Product</a> <a href="#">Features</a> <a class="unavailable" href="#">Gene Splicing</a> <a class="current" href="#">Cloning</a> </nav-->
     
	 <ul class="large-block-grid-4 medium-block-grid-4 small-block-grid-3" id="cat_group">
      <?php
		$sql = "SELECT * FROM category ORDER BY ranking";
		$result = $mysqli->query($sql);
//		print_r ($result);
			echo " <li><a onclick='selectCat(0)' class='bt_category'>ทั้งหมด</a></li>";
		while ($record = $result->fetch_object()) {  
			echo " <li><a onclick='selectCat({$record->catid})' class='bt_category'>{$record->description}</a></li>";
		}
		
	  ?>
      </ul>
			<br>
      <div class="section-container tabs" data-section>
        <section class="section">
		   <div class="row collapse">
							<div class="large-9 small-9 columns">
							  <input type="text" id="search_form" name="search_product_form" onkeyup="lookup(this.value);" placeholder="ค้นหา รหัสสินค้า, ชื่อสินค้า, บาร์โค้ด" style="height:40px;">
							</div>
							<div class="large-3 small-3 columns" >
							  <a href="#" class="button expand  [tiny small large]" style="height:40px;background:#59c4bc;font-size:1em;"><i class="fi-magnifying-glass"></i>&nbsp;ค้นหา</a>
							</div>
						  </div>
        </section>
        <section class="section">
          <!--h5 class="title"><a href="#panel2">เลือกสินค้า</a></h5-->
          <div class="content" data-slug="panel2">
            <ul class="large-block-grid-5 medium-block-grid-5 small-block-grid-3" id="product_list">
					<center><img src='img/loader.gif'/><h3>Loading...</h3></center>
            </ul>
			
          </div>
		  
		<div class="pagination-centered">
			  <ul class="pagination">
				
			  </ul>
		</div>
        </section>
      </div>
    </div>
 
    <!-- End Contact Details -->
 
 
    <!-- Sidebar -->
 
 <form action="" method="post" name="shopping" id="shopping">
    <div class="large-5 small-5 columns">
     <div class="large columns">
      <ul class="small-block-grid-5  listmenu"><br>
		 <li><a href="#" onclick="addDiscount()"><img src="img/bt_discount.png" title="Discount" /></a></li>
        <li><a href="#" onclick="resetList()"><img src="img/bt_trash.png" title="Reset" /></a></li>
        <li><a href="#" onclick="printoid()"><img src="img/bt_print.png" title="Print Order" /></a></li>
		<li><a href="#"><img src="img/bt_refresh.png" title="Refresh" /></a></li>
		<li><a href="#" onclick="about()"><img src="img/bt_edit.png" title="Edit Order" /></a></li>
      </ul>
    </div>
	<br>
	<div class="panel">
		<div class="row">
		<div class="large-6 medium-6 columns totaltitle">ราคารวม</div>
		<div class="large-6 medium-6 columns" id="total">0.00</div>
		</div>
	<br>
		<div class="row">
		<div class="large-6 medium-6 columns distitle">ส่วนลด</div>
		<div class="large-6 medium-6 columns discount" id="disbox"><input name="discount" value="0" type="hidden">0.00</div>
		</div>
	</div>
	<a href="cal.php" id="bt_checkout" class="button radius fancybox fancybox.iframe"data-fancybox-type="ajax" style="width:100%;background:#f5696c;"><i class="fi-shopping-cart"></i>&nbsp;ชำระเงิน</a>
	  <table id="itemOrder" class="responsive">
  				<thead>
  				  <tr>
					<th width=100%>ชื่อสินค้า</th>
      				<th>ราคา</th>
      				<th></th>
					<th>จน.</th>
					<th></th>
      				<th>รวม</th>
				  </tr>
				  </thead>
				  <tbody>
				  <tr>
				  </tr>
				  </tbody>
	</table>
	</div>
	</div>
    <!-- End Sidebar -->
  </div>
 </form>
  <!-- End Main Content and Sidebar -->
 
 
    
  <!-- Footer -->
  

    <div class="large-12 column" style="background:#444444; color: #cbcbcb;">
	<div class="footer">
          <!--p>© Copyright </p-->
		 <?php echo $info['footer'];?><br><br>
		  </div>
    </div> 
	
<!------------------------------------------ LOGIN BOX ---------------------------------------------------->
<?php
	if(isset($_SESSION["memberid"])) {
		echo "<div id=\"login_box\" class=\"active\">";
	} else {
		echo "<div id=\"login_box\" class=\"\">";
	}
?>

	<div class="title-header" style="padding-top:20px;font-size:3em;color:#ffffff;text-shadow: 4px 4px 4px #a1a1a1;"><?php echo $info['name'];?></div>
	<div class="title-header" style="padding-top:20px;line-height:30px;font-size:1.5em;color:yellow;text-shadow: 2px 2px #818181;"> ห้าม login แทนคนอื่นเด็ดขาด !<br>ถ้าจะสมัครเป็นแคชเชียร์ให้ไปหาตัวแทนฝ่ายไอทีเพื่อลงทะเบียนนะ :)</div>
	<div class="row">
	<form data-abide class="login_class" id="login_id">
	<div class="title-header" style="font-size:1.8em">Login Cashier</div>
	<div id="error" class="">ชื่อผู้ใช้กับรหัสผ่านไม่ถูกต้องค่ะ</div>
	  <div class="username-field">
		<input type="text" name="txtUsername" id="username" required placeholder="Username">
		<small class="error">Username is required and must be a string.</small>
	  </div>
	   <div class="password-field">
		<input type="password" name="txtPassword" id="password" required placeholder="Password">
		<small class="error">Password is required.</small>
	  </div>
	 <center><input type="submit" class="button [radius round]" value="Login"  id="submit"/></center><br>
	 <footer style="font-size:0.8em;text-align:center;"><?php echo $info['footer'];?></footer>
	</form>
	</div>
	
</div>
</body>

</html>
