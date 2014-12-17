<?php
	$pid =  (isset($_GET["pid"])) ? $_GET["pid"] : '';
	$sort =  (isset($_GET["sort"])) ? $_GET["sort"] : '';
	$type =  (isset($_GET["type"])) ? $_GET["type"] : '';
	$sqllist = "SELECT * FROM warehouse wh LEFT OUTER JOIN whmakeproduct whp ON wh.warehouseid=whp.warehouseid LEFT OUTER JOIN product p ON p.productid=whp.productid  WHERE wh.warehouseid = $pid ";
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
                <a href="?page=warehouse" class="bread-current">บริษัทตัวแทน</a>
				<i class="icon-angle-right"></i>
                <a href="#" class="bread-current">ดูบริษัทตัวแทน</a>
            </div>
            <!-- Page heading -->
            <h3 class="content-heading"><?=$row['wname'];?></h3>

            <div class="clearfix"></div>

        </div>
        <!-- Page heading ends -->

        <!-- Matter -->

        <div class="matter">
            <div class="container">

                <div class="row">
				
			
				
					<div class="col-md-8"> 
					<b><i class="icon-briefcase"></i> ชื่อบริษัท : </b> <?php echo $row['wname'];?><hr/>
					<b><i class="icon-location-arrow"></i> ที่อยู่ : </b> <?php echo $row['address'];?><hr/>
					<b><i class="icon-phone"></i> เบอร์โทรศัพท์ : </b> <?php echo $row['phone'];?><hr/>
					<b><i class="icon-envelope"></i> E-mail : </b> <a href="mailto:<?php echo $row['email'];?>"><?php echo $row['email'];?></a><hr/>
					<b><i class="icon-external-link-sign"></i> เว็บไซต์ : </b> <a href="<?php echo $row['website'];?>" target="_blank"><?php echo $row['website'];?></a><hr/>
					
					<br>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12"> 
					<!-- Show sub product -->
					<h3 class="content-heading">สินค้าจากบริษัทนี้</h3>
						<table class="table table-bordered ">
						<thead>
						<tr>
							<th>
									</i> #</a></th>
							<th> รูป</th>
							<th>
									</i> ชื่อ</a></th>
							<th> 
									</i> ต้นทุน</a></th>
							<th> 
									</i> ขาย</a></th>
							<th>
									</i> จน.สินค้าโกดัง</a></th>
							<th>
									</i> จน.สินค้าหน้าร้าน</a></th>
							<th>จัดการสินค้า</th>
						</tr>
						</thead>
						<tbody>
						<?php
							$count=1;
							$sqllist = "SELECT * FROM whmakeproduct wh INNER JOIN product pro ON wh.productid = pro.productid WHERE wh.warehouseid = $pid";
							//echo $sqllist;
							$sql = mysqli_query($connect, $sqllist);
							while($result = mysqli_fetch_array($sql, MYSQL_ASSOC)) {
						?>
						<tr id="product-list-<?php echo $result['productid'];?>">
							<td><?php echo $count;?></td>
							<td><?php echo "<img src=\"../productimages/{$result['pic']}\" width=40 height=40/>"?></td>
							<td><?php echo $result['pname'];?></td>
							<td><?php echo $result['cost'];?></td>
							<td><?php echo $result['price'];?></td>
							<td><?php if($result['wStock'] <=0) echo "<font color='red'>{$result['wStock']}</font>"; else echo  $result['wStock'];?>
									<a href="#" onclick="editWarehouse(<?=$result['productid'];?>)"><i class="icon-plus-sign" title="เพิ่ม/ลดสต็อกสินค้า"></i></a></td>
							<td><?php if($result['stock'] <=0) echo "<font color='red'>{$result['stock']}</font>"; else echo  $result['stock'];?>
									<a href="#" onclick="editbox(<?=$result['productid'];?>)"><i class="icon-plus-sign" title="เพิ่ม/ลดสต็อกสินค้า"></i></a></td>
							<td>
								<div class="btn-group">
										<?php if($result['type'] == 2) { ?>
										<a href="?page=addproduct&pid=<?=$result['productid'];?>"><button class="btn btn-sm btn-success" title="เพิ่มสินค้าย่อย"><i class="icon-plus"></i></button></a>
										<?php } ?>
										<a href="?page=infoproduct&pid=<?=$result['productid'];?>"><button class="btn btn-sm btn-default" title="ดู"><i class="icon-search"></i></button></a>
										<a href="?page=addproduct&pid=<?=$result['productid'];?>"><button class="btn btn-sm btn-default" title="คัดลอก"><i class="icon-copy"></i></button></a>
										<a href="?page=editproduct&pid=<?=$result['productid'];?>"><button class="btn btn-sm btn-default" title="แก้ไข"><i class="icon-pencil"></i></button></a> 
										<a href="" onclick="return deleteBox('<?=$result['pname'];?>','?page=product&action=delete&id=<?=$result['productid'];?>', 0)"><button class="btn btn-sm btn-default" title="ลบ"><i class="icon-trash"></i></button></a>
									</a>
								</div>
							</td>
						</tr>
						<?php 
						$count++;
						} ?>
						</tbody>
					</table>
                    <!-- Content -->
					</div>
                </div>

            </div>
        </div>

        <!-- Matter ends -->