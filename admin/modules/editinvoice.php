<?php
	if(!isset( $_GET['oid'])) {
		header('Location:index.php?page=404');
	}
	$orderid = $_GET['oid'];
    $action =  (isset($_GET["action"])) ? $_GET["action"] : '';
	if($action == "edit") {
            if($_POST['status'] == 6) { //cancel list
                   //STEP 1 - Add Product
                    $sqlsearch = "SELECT * FROM `buyproduct` WHERE orderid=$orderid";
                    $querys = mysqli_query($connect, $sqlsearch);
                    while($rows = mysqli_fetch_array($querys)) {
                        mysqli_query($connect, "UPDATE product SET stock = stock + '{$rows['piece']}' WHERE productid = {$rows['productid']}");
                    }
                    //STEP 2 - send to Log
                    mysqli_query($connect, "INSERT INTO log (id, type, event, datetime) VALUES (NULL, '5', '".$_SESSION["firstname"]." ได้ยกเลิกใบสั่งซื้อ #{$_GET['id']} ', '$datetime');");
                    
            }
            $sqllist = "UPDATE `order` SET `total` = '".$_POST["total"]."', `pay` = '".$_POST["pay"]."', `discount` = '".$_POST["discount"]."', `status` = '".$_POST["status"]."' WHERE orderid = $orderid;"; 
            $sql = mysqli_query($connect, $sqllist);
    }

	$sql = "SELECT * FROM `order`AS ord ";
	$sql .= "LEFT OUTER JOIN buyproduct AS buy ON ord.orderid=buy.orderid ";
	$sql .= "LEFT OUTER JOIN product ON product.productid = buy.productid ";
	$sql .= "WHERE ord.orderid = $orderid ORDER BY product.productid ASC";
	$query = mysqli_query($connect, $sql);
	$item = mysqli_num_rows($query);
	if($item == 0) {
        echo "";
        echo "<h1>ไม่พบใบสั่งซื้อนี้ในรายการหรืออาจถูกลบแล้วค่ะ</h1>";
        exit();
    }
	$row = mysqli_fetch_array($query); 
?>
<!-- Page heading -->
        <div class="page-head">

            <!-- Breadcrumb -->
            <div class="bread-crumb">
                <a href="index.html"><i class="icon-home"></i></a>
                <!-- Divider -->
                <i class="icon-angle-right"></i>
                <a href="#" class="bread-current">ใบสั่งซื้อ</a>
				<i class="icon-angle-right"></i>
                <a href="index.php?page=statement" class="bread-current">รายการใบสั่งซื้อ</a>
				<i class="icon-angle-right"></i>
                <a href="#" class="bread-current">แก้ไขใบสั่งซื้อ</a>
            </div>
            <!-- Page heading -->
            <div class="clearfix"></div>

        </div>
        <!-- Page heading ends -->

        <!-- Matter -->

        <div class="matter">
        <div class="container">
            <?php
            if($action == "edit") {
            
                    if($sql) {
                        echo "<div class=\"alert alert-success\">ระบบได้ทำการแก้ไขใบสั่งซื้อ #{$orderid} เรียบร้อยแล้วค่ะ";
                        echo "&nbsp;<a href='?page=statement'>[กลับ]</a> </div>";
                    } else {
                        echo "<div class=\"alert alert-danger\">ไม่สามารถลบได้ค่ะ</div>"; 
                    }
            }
            ?>
            <div class="row">
                 <h3 class="sub-header text-center" style="font-size:2em;">
                     ดูใบสั่งซื้ออื่น : <form action="index.php?page=editinvoice" method="GET"><input type="hidden" name="page" value="invoice"><input type="number" name="oid" placeholder="หมายเลขใบสั่งซื้อ"><input type="submit" value="ค้นหา"/></form><br>
                
                    <i class="icon-file-alt"></i>
                    แก้ไขใบสั่งซื้อ #<?php echo $orderid;?>
                </h3>
                <?php
                    //check
                    $sql2 = "SELECT orderid.orderid, orderid.total, orderid.pay, orderid.discount, orderid.status, orderid.dateOrder, staff.firstname FROM `order` AS orderid";
                    $sql2 .= " INNER JOIN membcontrolor mem ON orderid.orderid = mem.orderid";
                    $sql2 .= " INNER JOIN member_staff staff ON mem.memberid = staff.memberid";
                    $sql2 .= " WHERE orderid.orderid = $orderid";
                    $query2 = mysqli_query($connect, $sql2);
                    $row2 = mysqli_fetch_array($query2);
                    if($row2['status'] == 6) {
                        echo "<center><h1><font color='red'>ใบสั่งซื้อนี้ถูกยกเลิกค่ะ</font></h1></center>";
                        //exit();
                    } 
                ?>
                <div class="col-md-10 col-md-offset-1">

                        <div class="dash-tile-content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <address>
                                            <strong>
                                                <i class="icon-home"></i>
													คณะวิทยาศาสตร์ จุฬาลงกรณ์มหาวิทยาลัย
                                            </strong>
                                            <br>
												254 ถนนพญาไท แขวงวังใหม่
                                            <br>
												 เขตปทุมวัน กทม. 1033
                                            <br>
                                            <abbr title="Phone">
                                                <i class="icon-phone"></i>
                                            </abbr>
                                            (02) 215-3555
                                        </address>
                                    </div>
                                    <div class="col-md-5 col-md-offset-1">
                                        <form action="index.php?page=editinvoice&action=edit&oid=<?php echo $orderid; ?>" method="POST">
                                        <table class="table table-borderless table-condensed">
                                            <tbody>
                                           
                                            <tr>
                                                <td>
                                                    <strong>หมายเลขใบสั่งซื้อ</strong>
                                                </td>
                                                <td>
                                                    <span class="label label-danger">#<?php echo $orderid;?></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>วันที่สั่งซื้อ</strong>
                                                </td>
                                                <td>
                                                    <span class="label label-warning">
													<?php
													$phpdate = strtotime($row['dateOrder']);
													echo date( 'd/m/Y', $phpdate );
													?></span>
                                                </td>
                                            </tr>
                                             <tr>
                                                <td>
                                                    <strong>สถานะ</strong>
                                                </td>
                                                <td>
                                                    <select name="status">
                                                        <option value="1" <?php if($row2['status']==1) echo " selected";?>>ชำระเงินเสร็จสิ้น</option>
                                                        <option value="2" <?php if($row2['status']==2) echo " selected";?>>กำลังจัดของ</option>
                                                        <option value="3" <?php if($row2['status']==3) echo " selected";?>>รอรับของ</option>
                                                        <option value="4" <?php if($row2['status']==4) echo " selected";?>>รับเสร็จเรียบร้อย</option>
                                                        <option value="6" <?php if($row2['status']==6) echo " selected";?>>ยกเลิกรายการ</option>
                                                        <option value="-1" <?php if($row2['status']==-1) echo " selected";?>>มีปัญหา</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>พนักงาน</strong>
                                                </td>
                                                <td>
                                                    <span class="label label-default"><?php echo $row2['firstname'];?></span>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <table class="table table-borderless table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>รายการสินค้า</th>
										<th class="hidden-xs hidden-sm">ราคา</th>
                                        <th class="hidden-xs hidden-sm">จำนวน</th>
                                        <th>ราคารวม</th>
                                        <th>ลบ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
									<?php
									$query = mysqli_query($connect, $sql);
									$count = 1;
									$alltotal = 0;
									while($row = mysqli_fetch_array($query)) {
                                    $pid = $row['productid'];
									$price = $row['price'];
									$quantity = $row['piece'];
									$subtotal = $price*$quantity;
                                   
										echo "<tr id='product-list-$pid'><td>{$count}</td>\n";
                                        echo "<td>{$row['pname']}</td>\n";
                                        echo "<td>{$price}</td>\n";
										echo "<td>{$quantity} <a href=\"#\" onclick=\"editOrder($orderid, $pid)\"><i class=\"icon-plus-sign\" title=\"เพิ่ม/ลดสต็อกสินค้า\"></i></a></td>\n";
                                        echo "<td class=\"hidden-xs hidden-sm\">{$subtotal}</td>\n";
                                        echo "<td><a onclick=\"deleteItem($orderid, $pid);\"><i class=\"icon-remove-sign\" style=\"color:red;font-size:1.4em;\"></i></a></td>\n";
										echo "</tr>\n";
                                        $alltotal += $subtotal;
										$count++;
									}
									
									?>
                                    <tr class="info">
                                    
                                    
                                    <tr class=" ">
                                        <td></td>
                                        <td><button type="submit" class="btn btn-success" onclick="openpopup('modules/addprotoin.php', <?php echo $orderid; ?>)"><i class="icon-plus"> เพิ่มสินค้า</i></button></td>
                                        <td class="hidden-xs hidden-sm"></td>
                                        <td class="text-right">
                                            <strong>ราคารวม</strong>
                                        </td>
										
                                        <td class="text-right">
										<?php
											$query = mysqli_query($connect, $sql);
											$row = mysqli_fetch_array($query);
											//print_r($row);
											$subtotal = $row['total'];
                                            $pay = $row['pay'];
											//echo number_format($alltotal,2);
										?>
                                        <input type="text" class="text-right" name="total" value="<?php echo $row['total'];?>"/>
                                        </td>
                                        <td class="hidden-xs hidden-sm"></td>
                                    </tr>
                                    <tr class=" ">
                                        <td></td>
                                        <td class="hidden-xs hidden-sm"></td>
                                        <td class="hidden-xs hidden-sm"></td>
                                        <td class="text-right">
                                            <strong>ส่วนลด</strong>
                                        </td>
                                        <td class="text-right"><input type="text" class="text-right" name="discount" value="<?php echo $row['discount'];?>"/></td>
                                        <td class="hidden-md hidden-xs hidden-sm"></td>
                                    </tr>
                                    <tr class=" ">
                                        <td></td>
                                        <td class="text-right">
											<strong>ชำระเงิน</strong></td>
                                        <td class="text-right"><input type="text" class="text-right" name="pay" value="<?php echo $row['pay'];?>"/></td>
                                        <td class="text-right">
                                            <strong>เงินทอน</strong>
                                        </td>
                                        <td class="text-right"><?php echo($pay-$subtotal);?></td>
                                        <td class="hidden-xs hidden-sm"></td>
                                    </tr>
                                    <tr class=" ">
                                        <td></td>
                                        <td class="hidden-xs hidden-sm"></td>
                                        <td class="hidden-xs hidden-sm"></td>
                                        <td class="text-right">
                                            <strong>ราคารวม</strong>
                                        </td>
									<td class="text-right">
									<span class="text-danger">
									<strong><?php echo number_format($alltotal,2);?></strong>
									</span>
                                        </td>
                                        <td class="hidden-xs hidden-sm"></td>
                                    </tr>
                                    </tbody>

                                </table>
                                    <center>
                                        <?php if($row2['status']!=6) { ?>
                                        <button type="submit" class="btn btn-success">บันทึก</button>
                                        <button type="reset" class="btn btn-warning">ล้างข้อมูล</button>
                                        <?php } else { echo "ไม่อนุญาตให้แก้ไขเนื่องจากยกเลิกใบสั่งซื้อแล้วค่ะ"; }?>
                                    </center>
                                </div>

                                </table>
                                <!-- Buttons -->
                            </form>
                               

                        </div>
                </div>
            </div>

        </div>
</div>
        <!-- Matter ends -->