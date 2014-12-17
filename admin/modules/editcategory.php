<?php
	$action =  (isset($_GET["action"])) ? $_GET["action"] : '';
	$catid =  (isset($_GET["catid"])) ? $_GET["catid"] : '';
?>
<!-- Page heading -->
        <div class="page-head">

            <!-- Breadcrumb -->
            <div class="bread-crumb">
                <a href="index.html"><i class="icon-home"></i></a>
                <!-- Divider -->
                <i class="icon-angle-right"></i>
                <a href="#" class="bread-current">สินค้า</a>
				<i class="icon-angle-right"></i>
                <a href="#" class="bread-current">จัดการหมวดหมู่</a>
				<i class="icon-angle-right"></i>
                <a href="#" class="bread-current">แก้ไขหมวดหมู่</a>
            </div>
            <!-- Page heading -->
            <h3 class="content-heading">แก้ไขหมวดหมู่</h3>

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
					connect();
					$cat_name = $_POST["cat_name"];
					$catid = $_POST["catid"];
					$sql = mysql_query("UPDATE category SET description='$cat_name' WHERE catid=$catid");
					if($sql) {
						echo "<div class=\"alert alert-success\">ระบบได้แก้ไขหมวดหมู่ {$cat_name} เรียบร้อยแล้วค่ะ";
						echo "&nbsp;<a href='?page=category'>[กลับ]</a> </div>";
					} else {
						echo "<div class=\"alert alert-danger\">ไม่สามารถแก้ไข{$cat_name} ได้ อาจจะเพราะชื่อนี้เคยถูกใช้ไปแล้วค่ะ</div>";	
					}
			} 
			?>
			
			
                    <!-- Content -->
					<form action="index.php?page=editcategory&action=edit" method="POST" class="form-horizontal form-box" role="form">
                                    <h4 class="form-box-header">แก้ไขหมวดหมู่</h4>
                                    <div class="form-box-content">

                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">ชื่อหมวดหมู่</label>
											<?php
												connect();
												$query = mysql_query("SELECT * FROM category WHERE catid=$catid");
												$row = mysql_fetch_array($query); 
											?>

                                            <div class="col-lg-8">
                                                <input class="form-control" placeholder="" type="text" name="cat_name" value="<?=$row['description'];?>">
												<input type="hidden" name="catid" value="<?=$catid;?>">
											</div>
                                        </div>

                                        
                                      
                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-9">
                                                <button type="submit" class="btn btn-default">แก้ไขหมวดหมู่</button>
												
                                            </div>
                                        </div>
                                    </div>
                                </form>
										
			
					</div>
                </div>

            </div>
        </div>

        <!-- Matter ends -->