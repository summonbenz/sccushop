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
                <a href="#" class="bread-current">บริษัทตัวแทน</a>
            </div>
            <!-- Page heading -->
            <h3 class="content-heading">บริษัทตัวแทน</h3>

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
					$wh_name = $_POST["name"];
					$wh_address  = $_POST["address"];
					$wh_phone = $_POST["phone"];
					$wh_website = $_POST["website"];
					$wh_email = $_POST['email'];
						if($wh_name == NULL) {
							echo "<h1>กรุณากรอกข้อมูลให้ครบด้วยค่ะ</h1>";
							exit();
						}
					
					$sql = mysqli_query($connect, "INSERT INTO warehouse VALUE(NULL, '$wh_name', '$wh_address', '$wh_phone', '$wh_website', '$wh_email')");
					if($sql) {
						echo "<div class=\"alert alert-success\">ระบบได้เพิ่ม {$wh_name} เรียบร้อยแล้วค่ะ</div>";
					} else {
						echo "<div class=\"alert alert-danger\">ไม่สามารถเพิ่ม{$wh_name} ได้ อาจจะเพราะชื่อนี้เคยถูกใช้ไปแล้วค่ะ</div>";	
					}
			}
			else if($action=="delete"){
					$sql = mysqli_query($connect, "DELETE FROM warehouse WHERE warehouseid={$_GET['id']}");
					if($sql) {
						echo "<div class=\"alert alert-success\">ระบบได้ทำการลบ เรียบร้อยแล้วค่ะ</div>";
					} else {
						echo "<div class=\"alert alert-danger\">ไม่สามารถลบได้ เพราะยังมีสินค้าอยู่ในบริษัทนี้ค่ะ</div>";	
					}
			}
			?>
			
                    <!-- Content -->
					<form action="index.php?page=warehouse&action=add" method="POST" class="form-horizontal form-box" role="form">
                                    <h4 class="form-box-header">เพิ่มบริษัทตัวแทน</h4>
                                    <div class="form-box-content">

                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">ชื่อบริษัท</label>

                                            <div class="col-lg-8">
                                                <input class="form-control" placeholder="" type="text" name="name">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-4 control-label">ที่อยู่</label>

                                            <div class="col-lg-8">
                                                <input class="form-control" placeholder="" type="text" name="address">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-4 control-label">เบอร์โทรศัพท์</label>

                                            <div class="col-lg-4">
                                                <input class="form-control" placeholder="0891234567" type="text" name="phone">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-4 control-label">E-mail</label>

                                            <div class="col-lg-4">
                                                <input class="form-control" placeholder="test@test.com" type="text" name="email">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-4 control-label">เว็บไซต์</label>

                                            <div class="col-lg-4">
                                                <input class="form-control" placeholder="http://www.google.com" type="text" name="website">
                                            </div>
                                        </div>

                                        
                                      
                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-9">
                                                <button type="submit" class="btn btn-default">เพิ่มบริษัทตัวแทน</button>
												
                                            </div>
                                        </div>
                                    </div>
                                </form>
										
					<table class="table table-bordered ">
            <thead>
            <tr>
                <th>#</th>
                <th><i class="icon-briefcase"></i> ชื่อบริษัท</th>
                <th><i class="icon-tag"></i> สินค้าจากบริษัทนี้</th>
                <th>จัดการ</th>
            </tr>
            </thead>
            <tbody>
			<?php
			$sql = "SELECT w.warehouseID, w.wname,count(productid) as itemCount";
			$sql .= " FROM warehouse w";
			$sql .= " LEFT OUTER JOIN whmakeproduct wh ON w.warehouseid = wh.warehouseid";
			$sql .= " GROUP BY w.warehouseid ORDER BY w.warehouseID ASC ";
			$query = mysqli_query($connect, $sql);
			$count=1;
				while($result = mysqli_fetch_array($query)) {
			?>
            <tr>
                <td><?php echo $count;?></td>
                <td><?php echo $result['wname'];?></td>
                <td><?php echo $result['itemCount'];?></td>
                <td>
                    <div class="btn-group">
							<a href="?page=infowarehouse&pid=<?php echo $result['warehouseID'];?>"><button class="btn btn-sm btn-default" title="View"><i class="icon-search"></i></button></a>
							<a href="?page=editwarehouse&wid=<?php echo $result['warehouseID'];?>"><button class="btn btn-sm btn-default" title="Edit"><i class="icon-pencil"></i></button></a>
							<a href="index.php?page=warehouse&action=delete&id=<?php echo $result['warehouseID'];?>">	
							<a href="" onclick="return deleteBox('<?php echo $result['wname'];?>','?page=warehouse&action=delete&id=<?php echo $result['warehouseID'];?>', 1)"><button class="btn btn-sm btn-default" title="Delete"><i class="icon-trash"></i></button></a>
						</a>
                    </div>
                </td>
            </tr>
			<?php 
			$count++;
			} ?>
            </tbody>
        </table>
					</div>
                </div>

            </div>
        </div>

        <!-- Matter ends -->