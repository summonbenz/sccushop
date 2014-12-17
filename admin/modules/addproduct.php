<?php
	$action =  (isset($_GET["action"])) ? $_GET["action"] : '';
	$pid =  (isset($_GET["pid"])) ? $_GET["pid"] : '';
	$ch = false;
	if(isset($_GET["pid"])) {
		$ch = true;
		$sqllist = "SELECT * FROM product p LEFT OUTER JOIN whmakeproduct whp ON p.productid=whp.productid LEFT OUTER JOIN warehouse wh ON wh.warehouseid = whp.warehouseid WHERE p.productid=$pid ";
		
		$query= mysqli_query($connect, $sqllist);
		$item = mysqli_num_rows($query);
		
		//if($item == 0) header('Location:index.php?page=404');
		$row = mysqli_fetch_array($query); 
		$productid = $row['productid'];
	}
?>
<!-- Page heading -->
        <div class="page-head">

            <!-- Breadcrumb -->
            <div class="bread-crumb">
                <a href="index.html"><i class="icon-home"></i></a>
                <!-- Divider -->
                <i class="icon-angle-right"></i>
                <a href="index.php?page=product" class="bread-current">สินค้า</a>
				<i class="icon-angle-right"></i>
                <a href="#" class="bread-current">เพิ่มสินค้าใหม่</a>
            </div>
            <!-- Page heading -->
            <h3 class="content-heading">เพิ่มสินค้าใหม่</h3>

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
					$product_name = $_POST['product_name'];
					$product_catid = $_POST['product_catid'];
					$product_type = $_POST['product_type'];
					//echo "TYPE=".$_POST['product_type'];
					$product_warehouse = $_POST['product_warehouse'];
					$subproduct = $_POST['subproduct'];
					
					if($product_name==NULL || $product_catid==NULL || $product_type==NULL || $product_warehouse==NULL) {
						echo "<h1>คุณกรอกข้อมูลไม่ครบค่ะ</h1>";
						exit();
					}
					if (isset($_FILES["fileUpload"]["name"])) 
					{
					
						//*** copy file to productimages ***//
						$random_digit=rand(000000,999999);
						$sepext = explode('.', strtolower($_FILES['fileUpload']['name']));
						$type = end($sepext);       // gets extension
						 $images = $_FILES["fileUpload"]["tmp_name"]; 
						 $typeupload =($_FILES["fileUpload"]["type"] );
						 $nameimages = $random_digit.".".$type;
						 copy($_FILES["fileUpload"]["tmp_name"],"../productimages/".$nameimages); 


						//*** Insert Record ***//
						
						//add product
						$strSQL = "INSERT INTO product ";
						$strSQL .="(pname,catid,pic,price,cost,wStock,stock,type,barcode,parentid) VALUES ('{$_POST['product_name']}','{$_POST['product_catid']}','{$nameimages}','{$_POST['product_price']}', ";
						$strSQL .= "'{$_POST['product_cost']}', '{$_POST['product_wstock']}', '{$_POST['product_stock']}', '{$_POST['product_type']}', '{$_POST['product_barcode']}', '$subproduct');";
						$objQuery = mysqli_query($connect, $strSQL) or die(mysqli_error());		
								if($objQuery) {
									echo "<div class=\"alert alert-success\">ระบบได้เพิ่มสินค้า {$_POST['product_name']} เรียบร้อยแล้วค่ะ <a href='index.php?page=product'>[กลับ]</a></div>";
								} else {
									echo "<div class=\"alert alert-warning\">ไม่สามารถเพิ่ม {$_POST['product_name']} ได้ อาจจะเพราะชื่อนี้เคยถูกใช้ไปแล้วค่ะ</div>";
								}
						//add whmakrproduct
						$productid = mysqli_fetch_row(mysqli_query($connect, "SELECT productid FROM `product` ORDER BY productid DESC LIMIT 1"));
						$strSQL = "INSERT INTO whmakeproduct ";
						$strSQL .= "(productid, warehouseid) VALUES ({$productid[0]}, '{$_POST['product_warehouse']}');";					
						mysqli_query($connect, $strSQL) or die(mysqli_error());		
					}	
			}
			
			?>
			
                    <!-- Content -->
					<form action="index.php?page=addproduct&action=add" method="POST" class="form-horizontal form-box" role="form" enctype="multipart/form-data">
                                    <h4 class="form-box-header">เพิ่มสินค้าใหม่</h4>
                                    <div class="form-box-content">

                                        <div class="form-group">
                                            <label class="col-lg-7 control-label">ชื่อสินค้า</label>

                                            <div class="col-lg-7">
                                                <input class="form-control" placeholder="" type="text" name="product_name" <?php if($ch) echo "value=\"{$row['pname']}\"";?>>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-5 control-label">หมวดหมู่สินค้า</label>

                                            <div class="col-lg-7">
													<select name="product_catid" class="form-control">
													<option selected>==== เลือกหมวดหมู่สินค้า ====</option>
													<?php
													$sql = mysqli_query($connect, "SELECT catid, description FROM category ORDER BY ranking");
													while($result = mysqli_fetch_array($sql)) {
														echo "<option value=\"{$result['catid']}\" ";
														if($ch) {
																//echo  $row	['productid'];
																	if($result['catid'] == $row['catid']) echo "selected";
														}
														echo ">{$result['description']}</option>";
													}
													?>
													</select>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-5 control-label">รูปภาพประกอบ</label>

                                            <div class="col-lg-7">
                                                <input type="file" name="fileUpload" class="form-control"/>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-5 control-label">ราคาขายสินค้า<br>(ต่อชิ้น)</label>

                                            <div class="col-lg-7">
                                                <input class="form-control" placeholder="0.00" type="text" name="product_price" <?php if($ch) echo "value=\"{$row['price']}\"";?>>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-5 control-label">ราคาต้นทุนสินค้า<br>(ต่อชิ้น)</label>

                                            <div class="col-lg-7">
                                                <input class="form-control" placeholder="0.00" type="text" name="product_cost" <?php if($ch) echo "value=\"{$row['cost']}\"";?>>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-5 control-label">จำนวนสินค้าในคลัง</label>

                                            <div class="col-lg-7">
                                                <input class="form-control" placeholder="1" type="text" name="product_wstock" <?php if($ch) echo "value=\"{$row['wStock']}\"";?>>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-5 control-label">จำนวนสินค้าในหน้าร้าน</label>

                                            <div class="col-lg-7">
                                                <input class="form-control" placeholder="1" type="text" name="product_stock" <?php if($ch) echo "value=\"{$row['stock']}\"";?>>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-5 control-label">บริษัทตัวแทนจัดซื้อ</label>

                                            <div class="col-lg-7">
                                                <select name="product_warehouse" class="form-control" >
												<option selected>==== เลือกบริษัทตัวแทน ====</option>
												
													<?php
													$sql = mysqli_query($connect, "SELECT warehouseid, wname FROM warehouse");
													while($result = mysqli_fetch_array($sql)) {
														echo "<option value=\"{$result['warehouseid']}\" ";
														if($ch) {
																//echo  $row	['productid'];
																	if($result['warehouseid'] == $row['warehouseid']) echo "selected";
														}
														echo ">{$result['wname']}</option>";
													}
													?>
												</select>	
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-5 control-label">ประเภทสินค้า</label>

                                            <div class="col-lg-8">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="product_type" id="optionsRadios1"
                                                               value="1" <?php if(!$ch) echo "checked";?> >สินค้าปกติ
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="product_type" id="optionsRadios2"
                                                               value="2">สินค้าที่มีคุณสมบัติ
                                                    </label>
                                                </div>
												<div class="radio">
													<div class="col-lg-3">
														<label>
															<input type="radio" name="product_type" id="optionsRadios2"
																   value="3" <?php if($ch) echo "checked";?> >เป็นสินค้าย่อยของ
														</label>
													</div>
													<div class="col-lg-6">
														<select name="subproduct" class="form-control" >
														<option selected>==== เลือกสินค้า ====</option>
														
															<?php
															$sql = mysqli_query($connect, "SELECT productid, pname FROM product WHERE type = 2");
															while($result = mysqli_fetch_array($sql)) {
																echo "<option value=\"{$result['productid']}\" ";
																if($ch) {
																//echo  $row	['productid'];
																	if($result['productid'] == $row['productid']) echo "selected";
																}
																echo ">{$result['pname']}</option>";
															}
															?>
														</select>	
													</div>
                                            </div>
											
											
                                            </div>
                                        </div>
                                        
										<div class="form-group">
                                            <label class="col-lg-5 control-label">Barcode</label>

                                            <div class="col-lg-7">
                                                <input class="form-control" placeholder="" type="text" name="product_barcode">
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