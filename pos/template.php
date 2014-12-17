<?php
 header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
  header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
  header ("Cache-Control: no-cache, must-revalidate");
  header ("Pragma: no-cache");
	
require "includes/functions.php";

?>
<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" >
<head>
 <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
 <title>Point of Sale System</title>
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
               setTimeout("doStart()", 1000); //Auto Refresh กลับมาอ่าน เวลาทุก 1 วินาที
          }
     }
}
function doStart() {
     req = Inint_AJAX();
     req.open("POST", 'time.php?' + new Date().getTime(), true);
     req.onreadystatechange = startCallback; //กำหนด ฟังก์ชั่นเพื่อส่งค่ากลับ
     req.send(null);
};
</script>
</head>
<body>
</body>
</html>
