<?php
	session_start();
	$action =  (isset($_GET["action"])) ? $_GET["action"] : '';
	$type =  (isset($_GET["type"])) ? $_GET["type"] : '';
	$sort =  (isset($_GET["sort"])) ? $_GET["sort"] : '';
	$ndate = date("d");
	$nmonth = date("m");
	$nyear = date("Y");
	
	if($action == "search") {
		//get variable
		$oid = $_POST['q'];
		$min_p = $_POST['min_price'];
		$max_p = $_POST['max_price'];
		$dateStart = $_POST['dateStart'];
		$dateEnd = $_POST['dateEnd'];
		$status = $_POST['status'];
	}
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
                <a href="#" class="bread-current">รายการใบสั่งซื้อ</a>
            </div>
            <!-- Page heading -->
            <h3 class="content-heading">รายการใบสั่งซื้อ</h3>

            <div class="clearfix"></div>

        </div>
        <!-- Page heading ends -->

        <!-- Matter -->

        <div class="matter">
            <div class="container">

                <div class="row">
				
				

            <div class="clearfix margin-bottom-20"></div>
			
					<div class="col-md-12">
			<?php
			
			if($action=="delete"){
					//STEP 1 - Add Product
					$sqlsearch = "SELECT * FROM `buyproduct` WHERE orderid={$_GET['id']}";
					//echo $sqlsearch;
					$querys = mysqli_query($connect, $sqlsearch);
					while($rows = mysqli_fetch_array($querys)) {
						//echo $rows['productid'];
						mysqli_query($connect, "UPDATE product SET stock = stock + '{$rows['piece']}' WHERE productid = {$rows['productid']}");
					}
					//STEP 2 - send to Log
				 	mysqli_query($connect, "INSERT INTO log (id, type, event, datetime) VALUES (NULL, '5', '".$_SESSION["firstname"]." ได้ยกเลิกใบสั่งซื้อ #{$_GET['id']} ', '$datetime');");
                    //STEP 3 - Edit Status
					$sql = mysqli_query($connect, "UPDATE `order` SET `status` = '6' WHERE orderid={$_GET['id']}");
					if($sql) {
						echo "<div class=\"alert alert-success\">ระบบได้ทำการแก้สถานะเป็นยกเลิก เรียบร้อยแล้วค่ะ</div>";
					} else {
						echo "<div class=\"alert alert-warning\">ไม่สามารถลบได้ เพราะไม่มีสินค้านี้อยู่ในระบบค่ะ</div>";	
					}
			}
			?>
			<form method="post" onreset="return cancel_search_orders(this);" action="?page=statement&action=search">
					<span class="s-oid"><span class="text"><strong>OID </strong></span><input class="s-input" name="q" type="number" style="width:50px"></span>
					<span class="s-price"><span class="text"><strong>ราคา</strong></span>
						<input name="min_price" type="number" style="width:100px"> - <input name="max_price" type="number" style="width:100px"><span class="text"> บาท</span>
					</span>
					<span class="s-date"><span class="text"><strong>วันสั่งซื้อ</strong></span>
						 <div id="datetimeA" class="input-append" style="display: inline;"><input data-format="yyyy-MM-dd" type="text" style="width:100px" name="dateStart"> <span class="add-on"><i class="icon-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span></div>
						 - <div id="datetimeB" class="input-append" style="display: inline;"><input data-format="yyyy-MM-dd" type="text" style="width:100px" name="dateEnd"> <span class="add-on"><i class="icon-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span></div>
					</span>
					
					<span class="s-status">
						<span class="text"><strong>สถานะ</strong></span>
						<select name="status">
							<option value="0">ทั้งหมด</option>
							<option value="1">ชำระเงินเสร็จสิ้น</option>
							<option value="2">กำลังจัดของ</option>
							<option value="3">รอรับของ</option>
							<option value="4">รับเสร็จเรียบร้อย</option>
							<option value="6">ยกเลิกรายการ</option>
							<option value="-1">มีปัญหา</option>
						</select>
					</span>
					<span class="s-submit"><input value="ค้นหา" class="hilightButton search-button" type="submit"></span>
					<span class="s-reset"><input value="ยกเลิก" class="normalButton search-button" type="reset"></span>
				</form>
				
			
                    <!-- Content -->
					<table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
				 <th>
						<?php
						if($type =="asc" && $sort==1)  {
							echo "<a href=\"?page=statement&sort=1&type=desc\"><i class=\"icon-sort-up\">";
						} else if($type == "desc"  && $sort==1) {
							echo "<a href=\"?page=statement&sort=1&type=asc\"><i class=\"icon-sort-down\">";
						} else {
							echo "<a href=\"?page=statement&sort=1&type=asc\">";
						}
						
						?></i> #OID</a></th>
                <th>
						<?php
						if($type =="asc" && $sort==2)  {
							echo "<a href=\"?page=statement&sort=2&type=desc\"><i class=\"icon-sort-up\">";
						} else if($type == "desc"  && $sort==2) {
							echo "<a href=\"?page=statement&sort=2&type=asc\"><i class=\"icon-sort-down\">";
						} else {
							echo "<a href=\"?page=statement&sort=2&type=asc\">";
						}
						
						?></i> จำนวนเงิน</a></th>
				<th class="hidden-xs">  
						<?php
						if($type =="asc" && $sort==4)  {
							echo "<a href=\"?page=statement&sort=4&type=desc\"><i class=\"icon-sort-up\">";
						} else if($type == "desc"  && $sort==4) {
							echo "<a href=\"?page=statement&sort=4&type=asc\"><i class=\"icon-sort-down\">";
						} else {
							echo "<a href=\"?page=statement&sort=4&type=asc\">";
						}
						
						?></i> ส่วนลด</a></th>
                <th class="hidden-xs"> <?php
						if($type =="asc" && $sort==5)  {
							echo "<a href=\"?page=statement&sort=5&type=desc\"><i class=\"icon-sort-up\">";
						} else if($type == "desc"  && $sort==5) {
							echo "<a href=\"?page=statement&sort=5&type=asc\"><i class=\"icon-sort-down\">";
						} else {
							echo "<a href=\"?page=statement&sort=5&type=asc\">";
						}
						
						?></i> พนักงานที่รับชำระ</a></th>
				<th> <?php
						if($type =="asc" && $sort==6)  {
							echo "<a href=\"?page=statement&sort=6&type=desc\"><i class=\"icon-sort-up\">";
						} else if($type == "desc"  && $sort==6) {
							echo "<a href=\"?page=statement&sort=6&type=asc\"><i class=\"icon-sort-down\">";
						} else {
							echo "<a href=\"?page=statement&sort=6&type=asc\">";
						}
						
						?></i> สถานะ</a></th>
				<th class="hidden-xs"> <?php
						if($type =="asc" && $sort==7)  {
							echo "<a href=\"?page=statement&sort=7&type=desc\"><i class=\"icon-sort-up\">";
						} else if($type == "desc"  && $sort==7) {
							echo "<a href=\"?page=statement&sort=7&type=asc\"><i class=\"icon-sort-down\">";
						} else {
							echo "<a href=\"?page=statement&sort=7&type=asc\">";
						}
						
						?></i> วันที่ชำระเงิน</a></th>
				<th class="hidden-xs"> <?php
						if($type =="asc" && $sort==8)  {
							echo "<a href=\"?page=statement&sort=8&type=desc\"><i class=\"icon-sort-up\">";
						} else if($type == "desc"  && $sort==8) {
							echo "<a href=\"?page=statement&sort=8&type=asc\"><i class=\"icon-sort-down\">";
						} else {
							echo "<a href=\"?page=statement&sort=8&type=asc\">";
						}
						
						?></i> วันที่รับสินค้า</a></th>
                <th> จัดการ</th>
            </tr>
            </thead>
            <tbody>
			<?php
				//connect();
				$count = 1;
				$item = 50;
				
				//calculator from page
				$sql = "SELECT orderid FROM `order`";
				$query = mysqli_query($connect, $sql);
				$num = mysqli_num_rows($query);
				$nump = $num/$item;
				
				$start = (isset($_GET['start']))?$_GET['start'] : 1;
				$start = (--$start)*$item;
				
				if($action == "search") {
					$sql = "SELECT ord.orderid AS orderid, total, status, dateOrder, dateReceive, firstname, discount FROM `order`AS ord LEFT OUTER JOIN membcontrolor as mem ";
					$sql .= "ON ord.orderid = mem.orderid LEFT OUTER JOIN member_staff staff ON mem.memberid=staff.memberid WHERE";
					$extra = "";
						if($oid) $extra .=" ord.orderid='$oid' ,";
						if(is_numeric($min_p) && is_numeric($max_p)) $extra .=" ord.total BETWEEN '$min_p' AND '$max_p' ,";
						if(($dateStart) && ($dateEnd)) $extra .=" ord.dateOrder BETWEEN '$dateStart 00:00:00' AND '$dateEnd 00:00:00' ,";
						if($status) $extra .=" ord.status=$status,";
					//echo "ex <b>$extra</b>";
					$extra = substr($extra, 0, -1);
					//echo $extra;
					$sql .= $extra;
					$sql .= " ORDER BY ord.orderid ASC ";
					
				} else {
					$sql = "SELECT ord.orderid AS orderid, total, status, dateOrder, dateReceive, firstname, discount FROM `order`AS ord LEFT OUTER JOIN membcontrolor as mem ";
					$sql .= "ON ord.orderid = mem.orderid LEFT OUTER JOIN member_staff staff ON mem.memberid=staff.memberid ";
					if($sort == 1) {
						$sql .= "ORDER BY ord.orderid ";
					} else if($sort == 2) {
						$sql .= "ORDER BY ord.total ";
					} else if($sort == 3) {
						$sql .= "ORDER BY ord.pay ";
					} else if($sort == 4) {
						$sql .= "ORDER BY ord.discount ";
					} else if($sort == 5) {
						$sql .= "ORDER BY firstname ";
					} else if($sort == 6) {
						$sql .= "ORDER BY status ";
					} else if($sort == 7) {
						$sql .= "ORDER BY ord.dateOrder ";
					} else if($sort == 8) {
						$sql .= "ORDER BY ord.dateReceive ";
					} else {
						$sql .= "ORDER BY ord.orderid DESC ";
					}
						
					if($type == "asc") {
						$sql .= "ASC";
					} else if($type == "desc") {
						$sql .= "DESC";
					}
					$sql .=" LIMIT $start,$item ";
					
					
					
				}
				//echo $sql;
				$query = mysqli_query($connect, $sql);
				
				$alltotal = 0;
				while($result = mysqli_fetch_array($query, MYSQL_ASSOC)) {
					$alltotal += $result['total'];
					$phpdate = strtotime($result['dateOrder']);
					$dateOrder  = date( 'd/m/Y H:i:s', $phpdate );
					if(isset($result['dateReceive'])) {
						$phpdate = strtotime($result['dateReceive']);
						$dateReceive = date('d/m/Y H:i:s', $phpdate );
					} else {
						$dateReceive = "";
					}
					
			?>
            <tr> 
                <td><?php echo $result['orderid'];?></td>
                <td><?php echo $result['total'];?></td>
				<td class="hidden-xs"><?php echo ($result['discount']!=0)? number_format($result['discount']*(-1), 2) : $result['discount'];?></td>
				<td class="hidden-xs"><?php echo $result['firstname'];?></td>
                <td class="type-order" id="orderid-<?php echo $result['orderid'];?>">
					<?php
						if($result['status'] == 1) {
							echo "<span class=\"label label-default\">ชำระเงินเสร็จสิ้น</span>";
						} else if($result['status'] == 2) {
							echo "<span class=\"label label-info\">กำลังจัดของ</span>";
						} else if($result['status'] == 3) {
							echo "<span class=\"label label-warning\">รอรับของ</span>";
						} else if($result['status'] == 4) {
							echo "<span class=\"label label-success\">รับของเรียบร้อย</span>";
						} else if($result['status'] == 6) {
							echo "<span class=\"label label-important\">ยกเลิกรายการ</span>";
						} else {
							echo "<span class=\"label label-important\">มีปัญหา</span>";
						}

					?>
				</td>
				<td class="hidden-xs"><?php echo $dateOrder;?></td>
				<td class="hidden-xs"><?php echo $dateReceive;?></td>
				
                <td>
                    <div class="btn-group">
						<a href= "index.php?page=invoice&oid=<?php echo $result['orderid'];?>">
							<button class="btn btn-sm btn-default" title="View"><i class="icon-search"></i></button>
						</a>
						<a href= "index.php?page=editinvoice&oid=<?php echo $result['orderid'];?>">
							<button class="btn btn-sm btn-default" title="Edit"><i class="icon-pencil"></i></button>
						</a>
						<?php if($result['status'] != 6) { ?>
						<a href="" onclick="return deleteBox('หมายเลขใบสั่งซื้อ #<?php echo $result['orderid'];?>','?page=statement&action=delete&id=<?php echo $result['orderid'];?>', 0)">
							<button class="btn btn-sm btn-default" title="Delete"><i class="icon-trash"></i></button>
						</a>
						<?php } ?>
                    </div>
                </td>
            </tr>
			<?php 
			$count++;
			} ?>
			<!-------------------------TOTAL----------------------->
				<td><b>Total</b></td>
                <td><b><?php echo number_format($alltotal, 2, '.', ',');?></b></td>
				<td></td>
				<td></td>
                <td></td>
				<td></td>
				<td></td>
				<td></td>
				<!---------------------END TOTAL----------------------->
            </tbody>
        </table>
		<center>
		<?php if($action != "search") { ?>
		<ul class="pagination">
                <li><a href="#">Prev</a></li>
                <?php
					for($i=1;$i<=($nump+1);$i++) {
						echo "<li><a href=\"index.php?page=statement&start=$i\">$i</a></li>";
					}					
				?>
                <li><a href="#">Next</a></li>
        </ul>
		<?php } ?>
		</center>
					</div>
                </div>

            </div>
        </div>

        <!-- Matter ends -->