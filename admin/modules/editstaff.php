<?php
	$action =  (isset($_GET["action"])) ? $_GET["action"] : '';
	$pid =  (isset($_GET["pid"])) ? $_GET["pid"] : '';
	if(isset($_GET["pid"])) {
		connect();
		$sqllist = "SELECT * FROM member_staff WHERE memberid=$pid ";
		
//		$sqllist = "SELECT * FROM product  ";
		//echo $sqllist;
		$query= mysql_query($sqllist);
		$item = mysql_num_rows($query);
		
		//if($item == 0) header('Location:index.php?page=404');
		$row = mysql_fetch_array($query); 
		
		if($_SESSION['position'] != 'A' && $row['position'] == 'A') {
			echo "<h1>ไม่อนุญาตให้แก้ไขผู้ดูแลระบบค่ะ</h1>";
			exit();
		}
	}
?>
<!-- Page heading -->
        <div class="page-head">

            <!-- Breadcrumb -->
            <div class="bread-crumb">
                <a href="index.html"><i class="icon-home"></i></a>
                <!-- Divider -->
                <i class="icon-angle-right"></i>
                <a href="index.php?page=staff" class="bread-current">พนักงาน</a>
				<i class="icon-angle-right"></i>
                <a href="#" class="bread-current">เพิ่มพนักงานใหม่</a>
            </div>
            <!-- Page heading -->
            <h3 class="content-heading">เพิ่มพนักงานใหม่</h3>

            <div class="clearfix"></div>

        </div>
        <!-- Page heading ends -->

        <!-- Matter -->

        <div class="matter">
            <div class="container">

                <div class="row">
					<div class="col-md-12">
			<?php
			if($action=="edit"){
					//*** Insert Record ***//
						connect();
						
						//add product
						$strSQL = "UPDATE member_staff ";
						$strSQL .= "SET username = '{$_POST['regUsername']}' ,";
						if($_POST['regPassword'] != "") $strSQL .= " password = '{$_POST['regPassword']}' ,";
						$strSQL .= " firstname = '{$_POST['regFirstname']}' ,";
						$strSQL .= " lastname = '{$_POST['regLastname']}' ,";
						$strSQL .= " nickname = '{$_POST['regNickname']}' ,";
						$strSQL .= " phone = '{$_POST['regPhone']}' ,";
						$strSQL .= " email = '{$_POST['regEmail']}' ,";
						$strSQL .= " position= '{$_POST['regPosition']}' ,";
						$strSQL .= " studentID = '{$_POST['regIDCode']}' ,";
						$strSQL .= " major= '{$_POST['regMajor']}' ";

						$strSQL .=" WHERE memberid = {$_POST['memberid']}";
						//echo $strSQL;
						$objQuery = mysql_query($strSQL) or die(mysql_error());		
								if($objQuery) {
									echo "<div class=\"alert alert-success\">ระบบได้ทำการแก้ไข {$_POST['regFirstname']} เรียบร้อยแล้วค่ะ";
									echo "&nbsp;<a href='?page=staff'>[กลับ]</a> </div>";
								} else {
									echo "<div class=\"alert alert-warning\">ไม่สามารถเพิ่ม {$_POST['regFirstname']}  ได้ อาจจะเพราะชื่อนี้เคยถูกใช้ไปแล้วค่ะ</div>";
								}
			} else {
			
			?>
			
                    <!-- Content -->
					<form action="index.php?page=editstaff&action=edit" method="POST" class="form-horizontal form-box" role="form" enctype="multipart/form-data">
                                    <h4 class="form-box-header">เพิ่มพนักงานใหม่</h4>
                                    <div class="form-box-content">

                                        <div class="form-group">
                                            <label class="col-lg-7 control-label">Username</label>

                                            <div class="col-lg-5">
                                                <input class="form-control" placeholder="" type="text" name="regUsername" <?php echo "value=\"{$row['username']}\"";?>>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-7 control-label">Password</label>

                                            <div class="col-lg-5">
                                                <input class="form-control" placeholder="" type="password" name="regPassword">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-7 control-label">Verify Password</label>

                                            <div class="col-lg-5">
                                                <input class="form-control" placeholder="" type="password" name="regPassword2">
                                            </div>
                                        </div>
										 <div class="form-group">
                                            <label class="col-lg-7 control-label">รหัสประจำตัวนิสิต (10 หลัก)</label>

                                            <div class="col-lg-4">
                                                <input class="form-control" placeholder="xxxxxxxxxx" type="text" maxlength=10 name="regIDCode" <?php echo "value=\"{$row['studentID']}\"";?>  >
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-7 control-label">ชื่อ</label>

                                            <div class="col-lg-4">
                                                <input class="form-control" placeholder="" type="text" name="regFirstname" <?php echo "value=\"{$row['firstname']}\"";?>>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-7 control-label">นามสกุล</label>

                                            <div class="col-lg-4">
                                                <input class="form-control" placeholder="" type="text" name="regLastname" <?php echo "value=\"{$row['lastname']}\"";?>>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-7 control-label">ชื่อเล่น</label>

                                            <div class="col-lg-2">
                                                <input class="form-control" placeholder="" type="text" name="regNickname" <?php echo "value=\"{$row['nickname']}\"";?>>
                                            </div>
                                        </div>
										  <div class="form-group">
                                            <label class="col-lg-7 control-label">ภาควิชา</label>

                                            <div class="col-lg-4">
                                                <input class="form-control" placeholder="เช่น math, เคมี, ภาพถ่าย, ฯลฯ" type="text" name="regMajor" <?php echo "value=\"{$row['major']}\"";?>  >
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-7 control-label">เบอร์โทรศัพท์</label>

                                            <div class="col-lg-4">
                                                <input class="form-control" placeholder="0891234567" type="text" name="regPhone" <?php echo "value=\"{$row['phone']}\"";?>>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-7 control-label">E-mail</label>

                                            <div class="col-lg-4">
                                                <input class="form-control" placeholder="test@test.com" type="text" name="regEmail" <?php echo "value=\"{$row['email']}\"";?>>
                                            </div>
                                        </div>
										
										<div class="form-group">
                                            <label class="col-lg-5 control-label">ตำแหน่งพนักงาน</label>

                                            <div class="col-lg-7">
                                                <div class="col-lg-8">
												<div class="radio">
                                                    <label>
                                                        <input type="radio" name="regPosition" id="optionsRadios1"
                                                               value="C" <?php if($row['position'] == 'C') echo "checked";?>>แคชเชียร์
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="regPosition" id="optionsRadios1"
                                                               value="M"<?php if($row['position'] == 'M') echo "checked";?>>ผู้จัดการร้าน
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="regPosition" id="optionsRadios1"
                                                               value="A"<?php if($row['position'] == 'A') echo "checked";?>>ผู้ดูแลระบบ
                                                    </label>
                                                </div>
                                            </div>
											
											
                                            </div>
                                        </div>
										
                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-9">
												<input type="hidden" name="memberid" value="<?php echo $pid;?>">
                                                <button type="submit" class="btn btn-default">แก้ไขพนักงานใหม่</button>
												
                                            </div>
                                        </div>
                                    </div>
                    </form>
					<?php } ?>
					</div>
                </div>

            </div>
        </div>

        <!-- Matter ends -->