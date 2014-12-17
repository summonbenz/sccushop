<?php
	$pid =  (isset($_GET["pid"])) ? $_GET["pid"] : '';
	$sort =  (isset($_GET["sort"])) ? $_GET["sort"] : '';
	$type =  (isset($_GET["type"])) ? $_GET["type"] : '';
	$sqllist = "SELECT * FROM member_staff WHERE memberid=$pid ";
	$query= mysqli_query($connect, $sqllist);
	$item = mysqli_num_rows($query);
	if($item == 0) header('Location:index.php?page=404');
	$row = mysqli_fetch_array($query); 
?>
	<!-- Page heading -->
        <div class="page-head">

            <!-- Breadcrumb -->
            <div class="bread-crumb">
                <a href="index.html"><i class="icon-home"></i></a>
                <!-- Divider -->
                <i class="icon-angle-right"></i>
                <a href="?page=staff" class="bread-current">จัดการพนักงาน</a>
				<i class="icon-angle-right"></i>
                <a href="#" class="bread-current">ดูพนักงาน</a>
            </div>
            <!-- Page heading -->
            <h3 class="content-heading"><?php echo $row['firstname'];?> <?php echo $row['lastname'];?></h3>

            <div class="clearfix"></div>

        </div>
        <!-- Page heading ends -->

        <!-- Matter -->

        <div class="matter">
            <div class="container">

                <div class="row">
				
			
				
					<div class="col-md-8"> 
					<b><i class="icon-user"></i> Username : </b> <?php echo $row['username'];?><hr/>
					<b>&nbsp;&nbsp;&nbsp;&nbsp;ชื่อ : </b> <?php echo $row['firstname']." ".$row['lastname'];?><hr/>
					<b>&nbsp;&nbsp;&nbsp;&nbsp;ชื่อเล่น : </b> <?php echo $row['nickname'];?><hr/>
					<b>&nbsp;&nbsp;&nbsp;&nbsp;ภาควิชา : </b> <?php echo $row['major'];?><hr/>
					<b>&nbsp;&nbsp;&nbsp;&nbsp;รหัสประจำตัวนิสิต : </b> <?php echo $row['studentID'];?><hr/>
					<b><i class="icon-phone"></i> เบอร์โทรศัพท์ : </b> <?php echo $row['phone'];?><hr/>
					<b><i class="icon-envelope"></i> E-mail : </b> <a href="mailto:<?php echo $row['email'];?>"><?php echo $row['email'];?></a><hr/>
					<b><i class="icon-info"></i> ตำแหน่ง : </b> <?php
						//echo $row['position'];
						if($row['position'] == 'A') {
							echo "<span class=\"label label-success\">ผู้ดูแลระบบ</span>";
						} else if($row['position'] == 'M') {
							echo "<span class=\"label label-warning\">ผู้จัดการ</span>";
						} else if($row['position'] == 'C') {
							echo "<span class=\"label label-info\">แคชเชียร์</span>";
						}

					?> 
					<br>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12"> 
					
					</div>
                </div>

            </div>
        </div>

        <!-- Matter ends -->