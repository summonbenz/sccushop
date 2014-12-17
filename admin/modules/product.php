<?php
	$action =  (isset($_GET["action"])) ? $_GET["action"] : '';
	$sort =  (isset($_GET["sort"])) ? $_GET["sort"] : '';
	$type =  (isset($_GET["type"])) ? $_GET["type"] : '';
	$typepd =  (isset($_GET["typepd"])) ? $_GET["typepd"] : '';
	
	if($action == "search") {
		//get variable
		$name = $_POST['name'];
		$min_p = $_POST['min_price'];
		$max_p = $_POST['max_price'];
		
		$min_c = $_POST['min_cost'];
		$max_c = $_POST['max_cost'];
		
		$min_s = $_POST['min_stock'];
		$max_s = $_POST['max_stock'];
		
		//echo "$name $min_p $max_p $min_c $max_c $min_s $max_s ";
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
            </div>
            <!-- Page heading -->
            <h3 class="content-heading">จัดการสินค้า</h3>

            <div class="clearfix"></div>

        </div>
        <!-- Page heading ends -->

        <!-- Matter -->

        <div class="matter">
            <div class="container">
				
				
                <div class="row">
				
				<form method="post" onreset="return cancel_search_orders(this);" action="?page=product&action=search">
					<span class="s-oid"><span class="text"><strong>ชื่อสินค้า </strong></span><input class="p-name" name="name" style="width:120px"></span>
					<span class="s-price"><span class="text"><strong>ราคาขาย</strong></span>
						<input name="min_price" type="number" style="width:75px"> - <input name="max_price" type="number" style="width:75px"><span class="text"> บาท</span>
					</span>
					<span class="s-price"><span class="text"><strong>ราคาต้นทุน</strong></span>
						<input name="min_cost" type="number" style="width:75px"> - <input name="max_cost" type="number" style="width:75px"><span class="text"> บาท</span>
					</span>
					<span class="s-price"><span class="text"><strong>เหลือ</strong></span>
						<input name="min_stock" type="number" style="width:75px"> - <input name="max_stock" type="number" style="width:75px"><span class="text"> ชิ้น</span>
					</span>
					
					
					<span class="s-submit"><input value="ค้นหา" class="hilightButton search-button" type="submit"></span>
					<span class="s-reset"><input value="ยกเลิก" class="normalButton search-button" type="reset"></span>
				</form>
				
					<div class="col-md-12">
			<?php
			if($action=="delete"){
					connect();
					$sql = mysql_query("DELETE FROM product WHERE productid={$_GET['id']}");
					if($sql) {
						echo "<div class=\"alert alert-success\">ระบบได้ทำการลบ เรียบร้อยแล้วค่ะ</div>";
					} else {
						echo "<div class=\"alert alert-warning\">ไม่สามารถลบได้ เพราะไม่มีสินค้านี้อยู่ในระบบค่ะ</div>";	
					}
			}
			?>
			
                    <!-- Content -->
					<table class="table table-bordered  table-hover">
            <thead>
            <tr>
                <th>
						</i> #</a></th>
				<th> รูป</th>
                <th>
						<?php
						if($type =="asc" && $sort==2)  {
							echo "<a href=\"?page=product&sort=2&type=desc\"><i class=\"icon-sort-up\">";
						} else if($type == "desc"  && $sort==2) {
							echo "<a href=\"?page=product&sort=2&type=asc\"><i class=\"icon-sort-down\">";
						} else {
							echo "<a href=\"?page=product&sort=2&type=asc\">";
						}
						
						?></i> ชื่อ</a></th>
                <th> 
						<?php
						if($type =="asc" && $sort==3)  {
							echo "<a href=\"?page=product&sort=3&type=desc\"><i class=\"icon-sort-up\">";
						} else if($type == "desc" && $sort==3) {
							echo "<a href=\"?page=product&sort=3&type=asc\"><i class=\"icon-sort-down\">";
						} else {
							echo "<a href=\"?page=product&sort=3&type=asc\">";
						}
						
						?></i> ต้นทุน</a></th>
				<th> 
						<?php
						if($type =="asc" && $sort==4)  {
							echo "<a href=\"?page=product&sort=4&type=desc\"><i class=\"icon-sort-up\">";
						} else if($type == "desc" && $sort==4) {
							echo "<a href=\"?page=product&sort=4&type=asc\"><i class=\"icon-sort-down\">";
						} else {
							echo "<a href=\"?page=product&sort=4&type=asc\">";
						}
						
						?></i> ขาย</a></th>
                <th> จน.โกดัง</th>
                <th>
						<?php
						if($type =="asc" && $sort==5)  {
							echo "<a href=\"?page=product&sort=5&type=desc\"><i class=\"icon-sort-up\">";
						} else if($type == "desc" && $sort==5) {
							echo "<a href=\"?page=product&sort=5&type=asc\"><i class=\"icon-sort-down\">";
						} else {
							echo "<a href=\"?page=product&sort=5&type=asc\">";
						}
						
						?></i> จน.หน้าร้าน</a></th>
                <th>จัดการสินค้า</th>
            </tr>
            </thead>
            <tbody>
			<?php
				$count=1;
				if($action == "search") {
					
					$sqllist = "SELECT * FROM product";
					$extra = "";
						if($name) { $extra .=" WHERE pname LIKE '%{$name}%'  "; $count++;}
						if(is_numeric($min_p) && is_numeric($max_p) && $count==1) { $extra .=" WHERE price BETWEEN '$min_p' AND '$max_p' "; $count++;} else if(is_numeric($min_p) && is_numeric($max_p)) {  $extra .=" AND price BETWEEN '$min_p' AND '$max_p' "; }
						if(is_numeric($min_c) && is_numeric($max_c) && $count==1){ $extra .=" WHERE cost BETWEEN '$min_c' AND '$max_c' ";  $count++;} else if(is_numeric($min_c) && is_numeric($max_c)) {  $extra .=" AND cost BETWEEN '$min_c' AND '$max_c' "; } 
						if(is_numeric($min_s) && is_numeric($max_s) && $count==1) { $extra .=" xWHERE stock BETWEEN '$min_s' AND '$max_s' "; $count++; } else if(is_numeric($min_s) && is_numeric($max_s) && $count>1){  $extra .=" AND stock BETWEEN '$min_s' AND '$max_s' "; } 
					$extra = substr($extra, 0, -1);
					$sqllist .= $extra;
					$sqllist .= " ORDER BY productid ASC ";
				} else {
					$sqllist = "SELECT * FROM product ";
						$sqllist .= "WHERE type <= 2 ";
					if($sort == 1) {
						$sqllist .= "ORDER BY productid ";
					} else if($sort == 2) {
						$sqllist .= "ORDER BY pname ";
					} else if($sort == 3) {
						$sqllist .= "ORDER BY cost ";
					} else if($sort == 4) {
						$sqllist .= "ORDER BY price ";
					} else if($sort == 5) {
						$sqllist .= "ORDER BY stock ";
					}
						
					if($type == "asc") {
						$sqllist .= "asc";
					} else if($type == "desc") {
						$sqllist .= "desc";
					}
				}
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
                <?php if($result['type'] == 2) { echo "<td>----</td><td>---</td>"?>
                <?php } else { ?>
				<td><?php if($result['wStock'] <=0) echo "<font color='red'>{$result['wStock']}</font>"; else echo  $result['wStock'];?>
						<a href="#" onclick="editWarehouse(<?php echo $result['productid'];?>)"><i class="icon-plus-sign" title="เพิ่ม/ลดสต็อกสินค้า"></i></a></td>
                <td><?php if($result['stock'] <=0) echo "<font color='red'>{$result['stock']}</font>"; else echo  $result['stock'];?>
						<a href="#" onclick="editbox(<?php echo $result['productid'];?>)"><i class="icon-plus-sign" title="เพิ่ม/ลดสต็อกสินค้า"></i></a></td>
                <?php } ?>
                <td>
                    <div class="btn-group">
							<?php if($result['type'] == 2) { ?>
							
							<a href="?page=addproduct&pid=<?php echo $result['productid'];?>"><button class="btn btn-sm btn-success" title="เพิ่มสินค้าย่อย"><i class="icon-plus"></i></button></a>
							<?php } ?>
							<a href="?page=infoproduct&pid=<?php echo $result['productid'];?>"><button class="btn btn-sm btn-default" title="ดู"><i class="icon-search"></i></button></a>
							<a href="?page=addproduct&pid=<?php echo $result['productid'];?>"><button class="btn btn-sm btn-default" title="คัดลอก"><i class="icon-copy"></i></button></a>
							<a href="?page=editproduct&pid=<?php echo $result['productid'];?>"><button class="btn btn-sm btn-default" title="แก้ไข"><i class="icon-pencil"></i></button></a> 
							<a href="" onclick="return deleteBox('<?php echo $result['pname'];?>','?page=product&action=delete&id=<?php echo $result['productid'];?>', 0)"><button class="btn btn-sm btn-default" title="ลบ"><i class="icon-trash"></i></button></a>
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