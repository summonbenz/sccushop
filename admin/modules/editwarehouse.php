<?php
	$action =  (isset($_GET["action"])) ? $_GET["action"] : '';
	$wid =  (isset($_GET["wid"])) ? $_GET["wid"] : '';
?>
<!-- Page heading -->
        <div class="page-head">

            <!-- Breadcrumb -->
            <div class="bread-crumb">
                <a href="index.html"><i class="icon-home"></i></a>
                <!-- Divider -->
				<i class="icon-angle-right"></i>
                <a href="#" class="bread-current">แก้ไขบริษัทตัวแทน</a>
            </div>
            <!-- Page heading -->
            <h3 class="content-heading">แก้ไขบริษัทตัวแทน</h3>

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
					$strSQL = "UPDATE warehouse ";
						$strSQL .= "SET wname = '{$_POST['name']}' ,";
						$strSQL .= " address = '{$_POST['address']}' ,";
						$strSQL .= " phone = '{$_POST['phone']}' ,";
						$strSQL .= " email = '{$_POST['email']}' ,";
						$strSQL .= " website = '{$_POST['website']}' ";

						$strSQL .=" WHERE warehouseid = {$_POST['warehouseid']}";
						//echo $strSQL;
					$sql = mysql_query($strSQL);
					if($sql) {
						echo "<div class=\"alert alert-success\">ระบบได้ทำการแก้ไข {$_POST['name']} เรียบร้อยแล้วค่ะ";
						echo "&nbsp;<a href='?page=warehouse'>[กลับ]</a> </div>";
					} else {
						echo "<div class=\"alert alert-danger\">ไม่สามารถลบได้ เพราะไม่มีสินค้านี้อยู่ในระบบค่ะ</div>";	
					}
			} else {
			
					connect();
					$query = mysql_query("SELECT * FROM warehouse WHERE warehouseid=$wid");
					$row = mysql_fetch_array($query); 
			
			?>
                    <!-- Content -->
					<form action="index.php?page=editwarehouse&action=edit" method="POST" class="form-horizontal form-box" role="form">
                                    <h4 class="form-box-header">แก้ไขบริษัทตัวแทน</h4>
                                    <div class="form-box-content">

                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">ชื่อบริษัท</label>

                                            <div class="col-lg-8">
                                                <input class="form-control" placeholder="" type="text" name="name" value="<?php echo $row['wname'];?>">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-4 control-label">ที่อยู่</label>

                                            <div class="col-lg-8">
                                                <input class="form-control" placeholder="" type="text" name="address" value="<?php echo $row['address'];?>">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-4 control-label">เบอร์โทรศัพท์</label>

                                            <div class="col-lg-4">
                                                <input class="form-control" placeholder="0891234567" type="text" name="phone" value="<?php echo $row['phone'];?>">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-4 control-label">E-mail</label>

                                            <div class="col-lg-4">
                                                <input class="form-control" placeholder="test@test.com" type="text" name="email" value="<?php echo $row['email'];?>">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-4 control-label">เว็บไซต์</label>

                                            <div class="col-lg-4">
                                                <input class="form-control" placeholder="http://www.google.com" type="text" name="website" value="<?php echo $row['website'];?>">
                                            </div>
                                        </div>

                                        
										<input type="hidden" name="warehouseid" value="<?php echo $wid;?>">
                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-9">
                                                <button type="submit" class="btn btn-default">แก้ไขบริษัทตัวแทน</button>
												
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