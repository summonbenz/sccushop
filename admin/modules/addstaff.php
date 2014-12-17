<?php
	$action =  (isset($_GET["action"])) ? $_GET["action"] : '';
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
			if($action=="add"){
					$username = $_POST['regUsername'];
					$password = $_POST['regPassword'];
					$password2 = $_POST['regPassword2'];
					$firstname = $_POST['regFirstname'];
					$lastname = $_POST['regLastname'];
					$nickname = $_POST['regNickname'];
					$phone = $_POST['regPhone'];
					$email = $_POST['regEmail'];
					$position = $_POST['regPosition'];
                    $idcode = $_POST['regIDCode'];
                    $major = $_POST['regMajor'];
					
					if($password != $password2) {
						echo "<h1>รหัสผ่านไม่ตรงกันค่ะ</h1>";
						exit();
					}
					if($username==NULL || $password==NULL || $password2==NULL || $firstname==NULL || $lastname==NULL || $nickname==NULL || $phone==NULL || $email==NULL) {
						echo "<h1>คุณกรอกข้อมูลไม่ครบค่ะ</h1>";
						exit();
					}

						//*** Insert Record ***//
						
						//add product
						$strSQL = "INSERT INTO member_staff ";
						$strSQL .="VALUES (NULL, '$username', '$password', '$firstname', '$lastname', '$nickname', '$phone', '$email', '$position', '$idcode', '$major');";
						$objQuery = mysqli_query($connect, $strSQL) or die(mysqli_error());		
								if($objQuery) {
									echo "<div class=\"alert alert-success\">ระบบได้เพิ่ม {$username} ในระบบเรียบร้อยแล้วค่ะ</div>";
								} else {
									echo "<div class=\"alert alert-warning\">ไม่สามารถเพิ่มชื่อ {$username} ได้ อาจจะเพราะชื่อนี้เคยถูกใช้ไปแล้วค่ะ</div>";
								}
			}
			
			?>
			
                    <!-- Content -->
					<form action="index.php?page=addstaff&action=add" method="POST" class="form-horizontal form-box" role="form" enctype="multipart/form-data">
                                    <h4 class="form-box-header">เพิ่มพนักงานใหม่</h4>
                                    <div class="form-box-content">

                                        <div class="form-group">
                                            <label class="col-lg-7 control-label">Username</label>

                                            <div class="col-lg-5">
                                                <input class="form-control" placeholder="ชื่อที่ใช้ในการ login" type="text" name="regUsername">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-7 control-label">Password</label>

                                            <div class="col-lg-5">
                                                <input class="form-control" placeholder="" type="password" name="regPassword">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-7 control-label">ยืนยัน Password</label>

                                            <div class="col-lg-5">
                                                <input class="form-control" placeholder="" type="password" name="regPassword2">
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="col-lg-7 control-label">รหัสประจำตัวนิสิต (10 หลัก)</label>

                                            <div class="col-lg-4">
                                                <input class="form-control" placeholder="xxxxxxxxxx" type="text" maxlength=10 name="regIDCode">
                                            </div>
                                        </div>


										<div class="form-group">
                                            <label class="col-lg-7 control-label">ชื่อ</label>

                                            <div class="col-lg-4">
                                                <input class="form-control" placeholder="" type="text" name="regFirstname">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-7 control-label">นามสกุล</label>

                                            <div class="col-lg-4">
                                                <input class="form-control" placeholder="" type="text" name="regLastname">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-7 control-label">ชื่อเล่น</label>

                                            <div class="col-lg-2">
                                                <input class="form-control" placeholder="" type="text" name="regNickname">
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="col-lg-7 control-label">ภาควิชา</label>

                                            <div class="col-lg-4">
                                                <input class="form-control" placeholder="เช่น math, เคมี, ภาพถ่าย, ฯลฯ" type="text" name="regMajor">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-7 control-label">เบอร์โทรศัพท์</label>

                                            <div class="col-lg-4">
                                                <input class="form-control" placeholder="0891234567" type="text" name="regPhone">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-7 control-label">E-mail</label>

                                            <div class="col-lg-4">
                                                <input class="form-control" placeholder="test@test.com" type="text" name="regEmail">
                                            </div>
                                        </div>

                                       
                                       
										
										<div class="form-group">
                                            <label class="col-lg-5 control-label">ตำแหน่งพนักงาน</label>

                                            <div class="col-lg-7">
                                                <div class="col-lg-8">
												<div class="radio">
												
                                                    <label>
                                                        <input type="radio" name="regPosition" id="optionsRadios1"
                                                               value="C" checked>แคชเชียร์
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="regPosition" id="optionsRadios1"
                                                               value="M">ผู้จัดการร้าน
                                                    </label>
                                                </div>
												<?php if ($_SESSION['position'] == 'A') { ?>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="regPosition" id="optionsRadios1"
                                                               value="A">ผู้ดูแลระบบ
                                                    </label>
                                                </div>
												<?php } ?>
                                            </div>
											
											
                                            </div>
                                        </div>
										
                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-9">
                                                <button type="submit" class="btn btn-default">เพิ่มสินค้าใหม่</button>
												
                                            </div>
                                        </div>
                                    </div>
                    </form>
					</div>
                </div>

            </div>
        </div>

        <!-- Matter ends -->