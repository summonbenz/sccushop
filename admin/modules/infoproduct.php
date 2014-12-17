<?php
	$pid =  (isset($_GET["pid"])) ? $_GET["pid"] : '';
	$sort =  (isset($_GET["sort"])) ? $_GET["sort"] : '';
	$type =  (isset($_GET["type"])) ? $_GET["type"] : '';
	$action =  (isset($_GET["action"])) ? $_GET["action"] : '';
	$sqllist = "SELECT * FROM product p LEFT OUTER JOIN category ON p.catid = category.catid LEFT OUTER JOIN whmakeproduct whp ON p.productid=whp.productid LEFT OUTER JOIN warehouse wh ON wh.warehouseid = whp.warehouseid WHERE p.productid=$pid";
	$query= mysqli_query($connect, $sqllist);
	$item = mysqli_num_rows($query);
	if($item == 0) header('Location:index.php?page=404');
	$row = mysqli_fetch_array($query); 
	
	if($action=="copy"){
						connect();
							$count=1;
							$sqllist = "SELECT *  FROM product WHERE productid = $pid limit 1";
							$sql = mysqli_query($sqllist);
							while($result = mysqli_fetch_array($sql, MYSQL_ASSOC)) {
										$strSQL = "INSERT INTO product ";
									$strSQL .="(productid, pname, catid ,pic ,price ,cost ,stock ,type ,barcode ,parentid) VALUES ('','{$result['pname']}','{$result['catid']}','{$result['pic']}', ";
									$strSQL .= "'{$result['price']}', '{$result['cost']}', '{$result['stock']}', '{$result['type']}', '{$result['barcode']}', '{$result['parentid']}');";
									$objQuery = mysqli_query($connect, $strSQL) or die(mysql_error());		
											if($objQuery) {
												echo "<div class=\"alert alert-success\">ระบบได้เพิ่มสินค้า {$result['pname']} เรียบร้อยแล้วค่ะ <a href='index.php?page=infoproduct&pid={$result['parentid']}'>[กลับ]</a></div>";
											} else {
												echo "<div class=\"alert alert-warning\">ไม่สามารถเพิ่ม {$result['pname']} ได้ อาจจะเพราะชื่อนี้เคยถูกใช้ไปแล้วค่ะ</div>";
											}
											
									//add whmakrproduct
									$productid = mysql_fetch_row(mysql_query("SELECT productid FROM `product` ORDER BY productid DESC LIMIT 1"));
									$strSQL = "INSERT INTO whmakeproduct ";
									$strSQL .= "(productid, warehouseid) VALUES ({$productid[0]}, '1');";					
									mysql_query($strSQL) or die(mysql_error());		
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
                <a href="#" class="bread-current">สินค้า</a>
				<i class="icon-angle-right"></i>
                <a href="#" class="bread-current">จัดการสินค้า</a>
				<i class="icon-angle-right"></i>
                <a href="#" class="bread-current">แสดงสินค้า</a>
            </div>
            <!-- Page heading -->
            <h3 class="content-heading"><?php echo $row['pname'];?></h3>

            <div class="clearfix"></div>

        </div>
        <!-- Page heading ends -->

        <!-- Matter -->

        <div class="matter">
            <div class="container">

                <div class="row">
				<div class="col-md-4">
					<center><img src="../productimages/<?php echo $row['pic'];?>" height=200/></center>
				</div>
			
				
					<div class="col-md-8"> 
					<b>ชื่อสินค้า : </b> <?php echo $row['pname'];?><hr/>
					<b>หมวดหมู่ : </b> <?php echo $row['description'];?><hr/>
					<b>บริษัทตัวแทนจัดซื้อ : </b> <?php echo $row['wname'];?><hr/>
					<b>ต้นทุน : </b> <?php echo $row['cost'];?> บาท<hr/>
					<b>ขาย : </b> <?php echo $row['price'];?>  บาท<hr/>
					<b>จำนวนสินค้าคงเหลือ : </b> <?php echo $row['stock'];?><br>
					<br>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12"> 
					<!-- Show sub product -->
					<?php if ($row['type'] == 2) { ?>
					<h3 class="content-heading">สินค้าย่อย</h3>
					<a href="?page=addproduct&pid=<?php echo $row['productid'];?>" class="label label-success"><i class="icon-plus-sign" title="เพิ่มสินค้าย่อย"></i> เพิ่มสินค้าย่อย</a><br><br>
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
									</i> จน.โกดัง</a></th>
							<th>
									</i> จน.หน้าร้าน</a></th>
							<th>จัดการสินค้า</th>
						</tr>
						</thead>
						<tbody>
						<?php
							$count=1;
							$allstock = 0;
							$allwstock = 0;
							$sqllist = "SELECT *  FROM product WHERE parentid = $pid AND type<>4";
							$sql = mysqli_query($connect, $sqllist);
							while($result = mysqli_fetch_array($sql, MYSQL_ASSOC)) {
						?>
						<tr id="product-list-<?php echo $result['productid'];?>">
							<td><?php echo $count;?></td>
							<td><?php echo "<img src=\"../productimages/{$result['pic']}\" width=40 height=40/>"?></td>
							<td><?php echo $result['pname'];?></td>
							<td><?php echo $result['cost'];?></td>
							<td><?php echo $result['price'];?></td>
							<td><?php $allwstock+=$result['wStock']; if($result['wStock'] <=0) echo "<font color='red'>{$result['wStock']}</font>"; else echo  $result['wStock'];?>
									<a href="#" onclick="editWarehouse(<?php echo $result['productid'];?>)"><i class="icon-plus-sign" title="เพิ่ม/ลดสต็อกสินค้า"></i></a></td>
							
							<td><?php $allstock+=$result['stock']; if($result['stock'] <=0) echo "<font color='red'>{$result['stock']}</font>"; else echo  $result['stock'];?>
									<a href="#" onclick="editbox(<?php echo $result['productid'];?>)"><i class="icon-plus-sign" title="เพิ่ม/ลดสต็อกสินค้า"></i></a></td>
							<td>
								<div class="btn-group">
										<?php if($result['type'] == 2) { ?>
										<a href="index.php?page=subproduct&pid=<?php echo $result['productid'];?>"><button class="btn btn-sm btn-success" title="เพิ่มสินค้าย่อย"><i class="icon-plus"></i></button></a>
										<?php } ?>
										<a href="index.php?page=infoproduct&pid=<?php echo $result['productid'];?>"><button class="btn btn-sm btn-default" title="ดู"><i class="icon-search"></i></button></a>
										<a href="index.php?page=infoproduct&action=copy&pid=<?php echo $result['productid'];?>"><button class="btn btn-sm btn-default" title="คัดลอก"><i class="icon-copy"></i></button></a>
										<a href="index.php?page=editproduct&pid=<?php echo $result['productid'];?>"><button class="btn btn-sm btn-default" title="แก้ไข"><i class="icon-pencil"></i></button></a>
										<a href="index.php?page=product&action=delete&id=<?php echo $result['productid'];?>"></a>
										<a href=""><button class="btn btn-sm btn-default" title="ลบ"><i class="icon-trash"></i></button></a>
									</a>
								</div>
							</td>
						</tr>
						<?php 
						$count++;
						} ?>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>รวม</td>
							<td><?php echo $allwstock; ?></td>
							<td><?php echo $allstock; ?></td>
							<td></td>
						</tbody>
					</table>
                    <!-- Content -->
					<?php } ?>
					</div>
                </div>

            </div>
        </div>

        <!-- Matter ends -->