<?php
  header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
  header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
  header ("Cache-Control: no-cache, must-revalidate");
  header ("Pragma: no-cache");
  require "inc/setting.inc.php";
  session_start();
  if(!isset($_SESSION["memberid"])) header('Location:login.php?url=queue');
  
  ?>	

<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml"><head>
 <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta name="apple-mobile-web-app-capable" content="yes"/>
<meta name="format-detection" content="telephone=no">
<title>Queueing System</title>
<script src="pos/js/jquery-2.1.0.min.js"></script>
<script> 		   
	function loadtime() {
			$('#time').load('ajax/time.php', function( response, status, xhr ) {
			if ( status == "error" ) {
			    //alert("การเชื่อมต่ออินเตอร์เน็ตมีปัญหา \nโปรดตรวจสอบสัญญาณ wifi ที่เชื่อมต่ออยู่ในขณะนี้ด้วยค่ะ");
			}
		});
	}
	function queue() {
			$('#serving').load('ajax/callqueue.php?status=3');
			$('#prepare').load('ajax/callqueue.php?status=2');
     }
	   
	function sendcom3(oid){
		$.ajax({
			url: 'ajax/complete.php',
			method: 'POST',
			data: 'orderid='+oid,
			cache: false,
			success: function(data) {
				//alert(data);
				queue();
			}
		});
	}
	//setserve
	function sendcom2(oid){
		$.ajax({
			url: 'ajax/setserve.php',
			method: 'POST',
			data: 'orderid='+oid,
			cache: false,
			success: function(data) {
				//alert(data);
				queue();
			}
		});
	}
   $(document).ready(function() {
       var auto_refresh = setInterval(queue, 1000);
       queue();
	    var auto_time = setInterval(loadtime, 1000);
       loadtime();
   });
</script>
 <style type="text/css">
 @font-face {
    font-family: 'rsu-regular';
    src: url('pos/fonts/rsu_regular-webfont.eot');
    src: url('pos/fonts/rsu_regular-webfont.eot?#iefix') format('embedded-opentype'),
         url('pos/fonts/rsu_regular-webfont.woff') format('woff'),
         url('pos/fonts/rsu_regular-webfont.ttf') format('truetype');
    font-weight: normal;
    font-style: normal;
}

        * {
            margin: 0;
            padding: 0;
            }
        
        body, html {
            height: 100%;
			background-color: #f6f6f6;
            }
        
        #container {
          /* background: #fff;  styling only */
            width: 100%;
            margin: 0 auto;
            position: relative;
            height: auto !important;
            min-height: 100%;
            height: 100%;
            }
        #header {
            left: 0;
            bottom: 0;
            height: 30px;
            width: 100%;
            background: #333333;
			color: #fff;
			font-size:1em; 
			font-family:'rsu-regular';
			text-align:center;
		}
		
		#title {
			padding-top:5px;
			background:#036564; 
			color:#ffffff; 
			font-size:1em; 
			font-family:'rsu-regular';
			height: 100%;
			text-align:center;
		}
		#title2 {
			padding-top:5px;
			background:#033649; 
			color:#ffffff; 
			font-size:1em; 
			font-family:'rsu-regular';
			height: 100%;
			text-align:center;
		}
        .content {
           /* padding-bottom: 20.85%; */
          	background:#fff; 
			height: 100%;
        }
        
        #footer {
            position: absolute;
            left: 0;
            bottom: 0;
            height: 100px;
            width: 100%;
            background: #0f0;
         }
		 ul, li { float:left; display:inline; list-style-type:none; } /* reset ul */
		.number, .number2{
			text-shadow: 0 3px  3px rgba(255,255,255,.5);
		}
         .number li, .number2 li{
			display:inline;
			padding:.4em;
			 /*width:100px; height:40px; */
			 
		 }
		 .number li a, .number2 li a{
			font-family:Arial;
			padding:2px;
			font-size:1.6em;
			width:100px;
			color:#000000;
			text-decoration:none;
		 }
		 .number li a:hover, .number2 li a:hover {
		 	background:#fff;
			transition: all .1s linear;  
			border-radius:5px;
		 }
		 .iBannerFix{  
		 	font-family:'rsu-regular';
		 	font-size: 3em;
		    height:60px;  
		    position:fixed;  
		    display: inline-block;
		    left:0px;  
		    bottom:0px;  
		    background-color:#f9ff49;  
		    width:100%;  
		    z-index: 99;  
		    color: #ff4949;
		    padding-top: 10px;
		    padding-bottom: 10px;
		}  
		#time{
			font-family:'rsu-regular';
		 	font-size: 3em;
		    height:60px;  
		    position:fixed;  
		    display: inline-block;
		    left:80%;  
		    bottom:0px;  
		    background-color:#122c70;  
		    width:20%;  
		    z-index: 99;  
		    color: #fff;
		    padding-top: 10px;
		    padding-bottom: 10px;
		    text-align: center;
		}

	@media only screen and (min-width: 768px) {
		#header{
			font-size:3em;
			height:70px;
			padding-top:10px;
		}
		 .content {
           /* padding-bottom: 20.85%; */
		   padding:15px;
		  	min-height:250px;
			background:#f6f6f6; 
			font-size: 1.6em;
			line-height: 1.2em;
			overflow: hidden;
        }
		.number li{
			padding:.8em;
		}
	    .number li a{
			padding:10px;
			font-size:3em;
			color: #0e900b;
		}
		.number2 li{
			padding:.8em;
		}
	    .number2 li a{
			padding:10px;
			font-size:3em;
			color: #8e8e8e; 
		}
		#title, #title2{
			font-size:3em;
		}
		 .number li a:hover {
		 	background:#fff;
			transition: all .1s linear;  
			border-radius:20px;
		 }
    }


    </style>

</head>

<body>

     <div id="container">
		
		<div id="title">
            จัดของเตรียมเสร็จแล้ว / Serving Now
        </div>
        <div class="content">
			<ul class="number" id="serving">
				<li><a href="#"></a></li>
			</ul>
        </div>
		<div id="title2">
           กำลังจัดเตรียมสินค้า / Prepare Order
        </div>
        <div class="content">
           <ul class="number2" id="prepare">
				<li><a href="#"></a></li>
			</ul>
        </div>
        <div class="iBannerFix">  
        	<marquee scrolldelay="150">กรุณาตรวจสอบสินค้าให้เรียบร้อยก่อนออกจากร้านนะคะ สินค้าซื้อแล้วไม่รับเปลี่ยนคืน ขอบคุณค่ะ</marquee>
		</div>  
		<span id="time">00:00:00</span>

        
           
        <!--div id="footer">
            Footer here
        </div-->        
    </div>
</body>