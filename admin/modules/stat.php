
<!-- Page heading -->
        <div class="page-head">

            <!-- Breadcrumb -->
            <div class="bread-crumb">
                <a href="index.html"><i class="icon-home"></i></a>
                <!-- Divider -->
                <i class="icon-angle-right"></i>
                <a href="#" class="bread-current">รายงานสถิติ</a>
            </div>
            <!-- Page heading -->
            <h3 class="content-heading">รายงานสถิติ</h3>

            <div class="clearfix"></div>

        </div>
        <!-- Page heading ends -->

        <!-- Matter -->

        <div class="matter">
            <div class="container">

                <div class="row">
				
		
                    <div class="well-container">
                        <div class="well wviolet">
                            <div class="well-icon">
                                <i class="icon-cog"></i>
                            </div>
                            <div class="well-data">
                                <span class="well-data-number">
								<?php
									$ndate = date("d");
									$nmonth = date("m");
									$nyear = date("Y");
									$sql = "SELECT sum(total) AS alltotal FROM `order` WHERE dateOrder BETWEEN '$nyear-$nmonth-$ndate 00:00:00' AND  '$nyear-$nmonth-$ndate 23:59:59' ";
									$query = mysqli_query($connect, $sql);
									$row = mysqli_fetch_array($query);
									echo number_format($row['alltotal'], 2, '.', ',');
								?>
								</span>
                                <div class="well-content">ยอดรวมวันนี้</div>
                            </div>
						</div>
                        

                        <div class="well wblue">
                            <div class="well-icon">
                                <i class="icon-refresh"></i>
                            </div>
                            <div class="well-data">
                                <span class="well-data-number">
								<?php
									$sql = "SELECT sum(total) AS alltotal FROM `order` WHERE dateOrder BETWEEN '$nyear-$nmonth-01 00:00:00' AND  '$nyear-$nmonth-".date("t")." 23:59:59' ";
									//echo "<h1>$sql</h1>";
									$query = mysqli_query($connect, $sql);
									$row = mysqli_fetch_array($query);
									echo number_format($row['alltotal'], 2, '.', ',');
								?>
								</span>
                                <div class="well-content">ยอดรวมเดือนนี้</div>
                            </div>
                         </div>

                
                        <div class="well wgray">
                            <div class="well-icon">
                                <i class="icon-dashboard"></i>
                            </div>
                            <div class="well-data">
                                <span class="well-data-number">
								<?php
									$sql = "SELECT sum(total) AS alltotal FROM `order`";
									$query = mysqli_query($connect, $sql);
									$row = mysqli_fetch_array($query);
									echo number_format($row['alltotal'], 2, '.', ',');
								?>
								</span>
                                <div class="well-content">ยอดรวมทั้งร้าน</div>
                            </div>
                         </div>
			
			
                        <div class="well wred">
                            <div class="well-icon">
                                <i class="icon-asterisk"></i>
                            </div>
                            <div class="well-data">
                                <span class="well-data-number">
								<?php
									$sql = "SELECT sum(discount) AS alltotal FROM `order`";
									$query = mysqli_query($connect, $sql);
									$row = mysqli_fetch_array($query);
									$discount = $row['alltotal'];
									echo number_format($row['alltotal'], 2, '.', ',');
								?>
								</span>
                                <div class="well-content">ส่วนลดทั้งหมด</div>
                            </div>
                        </div> 
            
			 
                        <div class="well wgreen">
                            <div class="well-icon">
                                <i class="icon-bitcoin"></i>
                            </div>
                            <div class="well-data">
                                <span class="well-data-number">
								<?php
									$sql = "SELECT sum((piece*price)-(piece*cost)) FROM `buyproduct`buy INNER JOIN product ON buy.productid=product.productid";
									$query = mysqli_query($connect, $sql);
									$row = mysqli_fetch_array($query);
									echo number_format($row[0]-$discount, 2, '.', ',');
								?>
								</span>
                                <div class="well-content">ได้กำไร</div>
                            </div>
                        </div> 

            </div>
			
					<div class="col-md-12">
                    <!-- Curve chart starts -->

                    <div class="widget">

                        <div class="widget-head">
                            <div class="pull-left">กราฟแสดงยอดใบสั่งซื้อของวันนี้</div>
                            <div class="widget-icons pull-right">
                                <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a>
                                <a href="#" class="wclose"><i class="icon-remove"></i></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>


                        <div class="widget-content">
                            <div class="padd">

                                <div id="curve-chart"></div>

                                <hr/>

                                <div id="hoverdata">Mouse hovers at
                                    (<span id="x">0</span>, <span id="y">0</span>). <span id="clickdata"></span></div>

                            </div>
                        </div>
                    </div>
					
                    <!-- Curve chart ends -->
					</div><!---- END col md 12 ---->
					<!---------------------------- TOP TEN PRODUCT WIDGET -------------------->
					<div class="col-md-4">
						<div class="widget wgray">
							<!-- Widget title -->
							<div class="widget-head">
								<div class="pull-left"><i class="icon-reorder"></i> 10 อันดับสินค้าขายดี</div>
								<div class="widget-icons pull-right">
									<a href="#" class="wminimize"><i class="icon-chevron-up"></i></a>
									<a href="#" class="wclose"><i class="icon-remove"></i></a>
								</div>
								<div class="clearfix"></div>
							</div>

							<div class="widget-content referrer">
									<!-- Widget content -->

									<table class="table table-striped ">
										<tbody><tr>
											<th>
												<center>#</center>
											</th>
											<th>สินค้า</th>
											<th>จำนวน</th>
										</tr>
										<?php
														$sql = "SELECT SUM(buy.piece) AS itemCount, pname FROM `buyproduct`buy LEFT OUTER JOIN product pro ON buy.productid = pro.productid GROUP BY buy.productid ORDER BY `itemCount`  DESC LIMIT 10";
														$query = mysqli_query($connect, $sql);
														$count=1;
														while($row = mysqli_fetch_array($query)) { 
														echo "<tr>";
														echo "<td><center>$count</center></td>";
														echo "<td>{$row['pname']}</td>";
														echo "<td>".number_format($row['itemCount'], 0, '.', ',')."</td>";
														echo "</tr>";
														$count++;
														}
										?>
										
									</tbody></table>

							</div>
							
						</div>
					</div>
					<!---------------------------------------- END TOP TEN ------------------------->

					<!---------------------------- TOP TEN PRODUCT WIDGET -------------------->	
					<div class="col-md-4">
							<div class="widget wgray">
								<!-- Widget title -->
								<div class="widget-head">
									<div class="pull-left"><i class="icon-reorder"></i> 10 อันดับพนักงานทำยอดสูงสุด</div>
									<div class="widget-icons pull-right">
										<a href="#" class="wminimize"><i class="icon-chevron-up"></i></a>
										<a href="#" class="wclose"><i class="icon-remove"></i></a>
									</div>
									<div class="clearfix"></div>
								</div>

								<div class="widget-content referrer">
										<!-- Widget content -->

										<table class="table table-striped ">
											<tbody><tr>
												<th>
													<center>#</center>
												</th>
												<th>ชื่อพนักงาน</th>
												<th>จำนวน</th>
											</tr>
											<?php
															//connect();
															$sql = "SELECT COUNT(orderid) AS item, firstname, nickname FROM membcontrolor AS a NATURAL JOIN member_staff GROUP BY memberid ORDER BY item DESC";
															$query = mysqli_query($connect, $sql);
															$count=1;
															while($row = mysqli_fetch_array($query)) { 
															echo "<tr>";
															echo "<td><center>$count</center></td>";
															echo "<td>{$row['nickname']}</td>";
															echo "<td>".number_format($row['item'], 0, '.', ',')."</td>";
															echo "</tr>";
															$count++;
															}
											?>
											
										</tbody></table>

									</div>
								
							</div>
						</div>
					<!---------------------------------------- END TOP TEN ------------------------->
					
                    <!---------------------------- TOP TEN PRODUCT WIDGET -------------------->	
					<div class="col-md-4">
							<div class="widget wgray">
								<!-- Widget title -->
								<div class="widget-head">
									<div class="pull-left"><i class="icon-reorder"></i> หมวดหมู่สินค้าขายดี</div>
									<div class="widget-icons pull-right">
										<a href="#" class="wminimize"><i class="icon-chevron-up"></i></a>
										<a href="#" class="wclose"><i class="icon-remove"></i></a>
									</div>
									<div class="clearfix"></div>
								</div>

								<div class="widget-content referrer">
										<!-- Widget content -->

										<div id="pie-chart">Loading...</div>

									</div>
								
							</div>
						</div>
					<!---------------------------------------- END TOP TEN ------------------------->
                
				<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				</div>
</div>
            </div>
        </div>

        <!-- Matter ends -->
		
		