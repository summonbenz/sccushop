<?php
	if(!isset( $_GET['oid'])) {
		header('Location:index.php?page=404');
	}
	$orderid = $_GET['oid'];
	
	$sql = "SELECT * FROM `order`AS ord ";
	$sql .= "LEFT OUTER JOIN buyproduct AS buy ON ord.orderid=buy.orderid ";
	$sql .= "LEFT OUTER JOIN product ON product.productid = buy.productid ";
	$sql .= "WHERE ord.orderid = $orderid";
	$query = mysqli_query($connect, $sql);
	$item = mysqli_num_rows($query);
	if($item == 0) {
        echo "<h2>#$orderid ไม่พบใบสั่งซื้อนี้ในรายการหรืออาจถูกลบแล้วค่ะ<br>";
        echo "<a href=\"index.php?page=invoice&oid=".($orderid-1)."\">[ย้อนกลับ]</a>&nbsp;";
        echo "<a href=\"index.php?page=invoice&oid=".($orderid+1)."\">[ถัดไป]</a></h2>";
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
                <a href="#" class="bread-current">ดูใบสั่งซื้อ</a>
            </div>
            <!-- Page heading -->
            <div class="clearfix"></div>

        </div>
        <!-- Page heading ends -->

        <!-- Matter -->

        <div class="matter">
        <div class="container">

            <div class="row">

                <h3 class="sub-header text-center" style="font-size:2em;">
                     ดูใบสั่งซื้ออื่น : <form action="index.php?page=invoice" method="GET"><input type="hidden" name="page" value="invoice"><input type="number" name="oid" placeholder="หมายเลขใบสั่งซื้อ"><input type="submit" value="ค้นหา"/></form><br>
                    <i class="icon-file-alt"></i>
                    <a href="index.php?page=invoice&oid=<?php echo $orderid-1; ?>"><</a> ใบสั่งซื้อ #<?php echo $orderid;?> <a href="index.php?page=invoice&oid=<?php echo $orderid+1; ?>">></a>
                <a href="index.php?page=editinvoice&oid=<?php echo $orderid; ?>">[แก้ไข]</a>
                <a href="index.php?page=statement&action=delete&id=<?php echo $orderid; ?>">[ยกเลิก]</a>
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
                <div class="col-md-8 col-md-offset-2">

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
                                                    <?php
                                                        if($row2['status'] == 1) {
                                                            echo "<span class=\"label label-default\">ชำระเงินเสร็จสิ้น</span>";
                                                        } else if($row2['status'] == 2) {
                                                            echo "<span class=\"label label-info\">กำลังจัดของ</span>";
                                                        } else if($row2['status'] == 3) {
                                                            echo "<span class=\"label label-warning\">รอรับของ</span>";
                                                        } else if($row2['status'] == 4) {
                                                            echo "<span class=\"label label-success\">รับของเรียบร้อย</span>";
                                                        } else if($row2['status'] == 6) {
                                                            echo "<span class=\"label label-important\">ยกเลิกรายการ</span>";
                                                        } else {
                                                            echo "<span class=\"label label-important\">มีปัญหา</span>";
                                                        }
                                                    ?>
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
                                        <th>จำนวน</th>
                                        <th>ราคารวม</th>
                                    </tr>
                                    </thead>
                                    <tbody>
									<?php
									$query = mysqli_query($connect, $sql);
									$count = 1;
									$alltotal = 0;
									while($row = mysqli_fetch_array($query)) {
									$price = $row['price'];
									$quantity = $row['piece'];
									$subtotal = $price*$quantity;
                                   
										echo "<td>{$count}</td>";
                                        echo "<td>{$row['pname']}</td>";
                                        echo "<td>{$price}</td>";
										echo "<td>{$quantity}</td>";
                                        echo "<td class=\"hidden-xs hidden-sm\">{$subtotal}</td>";
										echo "</tr>";
                                        $alltotal += $subtotal;
										$count++;
									}
									
									?>
                                    <tr class="info">
                                    
                                    
                                    <tr class=" ">
                                        <td></td>
                                        <td class="hidden-xs hidden-sm"></td>
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
											echo number_format($alltotal,2);
										?></td>
                                    </tr>
                                    <tr class=" ">
                                        <td></td>
                                        <td class="hidden-xs hidden-sm"></td>
                                        <td class="hidden-xs hidden-sm"></td>
                                        <td class="text-right">
                                            <strong>ส่วนลด</strong>
                                        </td>
                                        <td class="text-right"><?php echo "-".$row['discount'];?></td>
                                    </tr>
                                    <tr class=" ">
                                        <td></td>
                                        <td class="text-right">
											<strong>ชำระเงิน</strong></td>
                                        <td class="text-right"><?php $pay=$row['pay']; echo number_format($pay,2);?></td>
                                        <td class="text-right">
                                            <strong>เงินทอน</strong>
                                        </td>
                                        <td class="text-right"><?php echo($pay-$subtotal);?></td>
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
									<strong><?php echo number_format($subtotal,2);?></strong>
									</span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                </table>
                               
                        </div>
                </div>
            </div>

        </div>
</div>
        <!-- Matter ends -->