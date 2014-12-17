<?php
	$action =  (isset($_GET["action"])) ? $_GET["action"] : '';
	if($action=="reset" && $_SESSION["position"] == "A") {
		//mysqli_query($connect, "UPDATE `product` SET `stock` = '0';");
		mysqli_query($connect, "TRUNCATE `log`;");
		mysqli_query($connect, "TRUNCATE `membcontrolor`;");
		mysqli_query($connect, "TRUNCATE `buyproduct`;");
		mysqli_query($connect, "DELETE FROM `order` WHERE `orderid`>0;");
		mysqli_query($connect, "ALTER TABLE `order` AUTO_INCREMENT =1;");
		mysqli_query($connect, "ALTER TABLE `buyproduct` DROP FOREIGN KEY `prodORFK` ;");
		mysqli_query($connect, "ALTER TABLE `buyproduct` DROP FOREIGN KEY `prodIDFK` ;");
		mysqli_query($connect, "ALTER TABLE `order` AUTO_INCREMENT = 1;");
		mysqli_query($connect, "ALTER TABLE `membcontrolor` DROP FOREIGN KEY `memodIDFK` ;");
		mysqli_query($connect, "ALTER TABLE `membcontrolor` DROP FOREIGN KEY `membIDFK` ;");
		mysqli_query($connect, "TRUNCATE `order`;");


		mysqli_query($connect, "ALTER TABLE `buyproduct` ADD CONSTRAINT `prodIDFK` FOREIGN KEY (`productid`) REFERENCES `product` (`productid`) ON DELETE CASCADE ON UPDATE CASCADE, ADD CONSTRAINT `prodORFK` FOREIGN KEY (`orderid`) REFERENCES `order` (`orderid`) ON DELETE CASCADE;");

		$query = mysqli_query($connect, "ALTER TABLE `membcontrolor` ADD CONSTRAINT `membIDFK` FOREIGN KEY (`memberid`) REFERENCES `member_staff` (`memberid`), ADD CONSTRAINT `memodIDFK` FOREIGN KEY (`orderid`) REFERENCES `order` (`orderid`) ON DELETE CASCADE;");
	
		
		if($query) {
		echo "<div class=\"alert alert-success\">ระบบได้ทำการรีเซ็ทระบบเรียบร้อยแล้วค่ะ";
		echo "&nbsp;<a href='index.php?page=main'>[กลับ]</a> </div>";
		} else {
			echo "<div class=\"alert alert-danger\">ไม่สามารถรีเซ็ทได้ กรุณาติดต่อผู้ดูแลระบบด่วนค่ะ</div>";	
		}
	} else if($action=="reset" && $_SESSION["position"] != "A") {
		echo "<div class=\"alert alert-danger\">ส่วนนี้อนุญาตให้เฉพาะผู้ดูแลระบบเท่านั้นค่ะ</div>";	
	}
?>
<!-- Page heading -->
        <div class="page-head">

            <!-- Breadcrumb -->
            <div class="bread-crumb">
                <a href="index.html"><i class="icon-home"></i></a>
                <!-- Divider -->
                <i class="icon-angle-right"></i>
                <a href="#" class="bread-current">Dashboard</a>
            </div>
            <!-- Page heading -->
            <h3 class="content-heading">รีเซ็ทระบบ</h3>

            <div class="clearfix"></div>

        </div>
        <!-- Page heading ends -->

        <!-- Matter -->

        <div class="matter">
            <div class="container">

                <div class="row">
					<center>
					<h2 style="font-family: 'rsu';">รีเซ็ทระบบคือ การลบข้อมูลเกี่ยวกับรายละเอียดใบสั่งซื้อสินค้า<br>และข้อมูลการขายทั้งหมด เพื่อเริ่มต้นเปิดใช้งานร้านจริง<br><br><span  style="color: red;font-family: 'rsu';">คุณต้องการลบข้อมูลทั้งหมดใช่หรือไม่ ?</span></h2>
					<a href='index.php?page=reset&action=reset'><span class="label label-danger" style="border-radius:50%;line-height:100px;height:100px;width:100px;font-size:3em;font-family: 'rsu';">ใช่</span></a>&nbsp;&nbsp;
					<a href='index.php?page=main'><span class="label label-warning" style="border-radius:50%;line-height:100px;height:100px;width:100px;font-size:3em;font-family: 'rsu';">ไม่</span></a>
					</center>
                    <!-- Content -->
                </div>

            </div>
        </div>

        <!-- Matter ends -->