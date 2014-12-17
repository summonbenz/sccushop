<!-- Page heading -->
<div class="page-head">
    <!-- Breadcrumb -->
    <div class="bread-crumb">
        <a href="index.html"><i class="icon-home"></i></a>
        <!-- Divider -->
        <i class="icon-angle-right"></i>
        <a href="#" class="bread-current">Dashboard</a>
    </div>
    <!-- Page heading -->
    <div class="clearfix"></div>

</div>
<!-- Page heading ends -->


<!-- Matter -->

<div class="matter">
<div class="container">

<!-- Today status. jQuery Sparkline plugin used. -->

<div class="row">
    <div class="col-md-12">

    

    <!-- Statistics starts -->

        <div class="row">
            <!-- stats -->
            <div class="well-container">
                <div class="well wviolet">
                    <div class="well-icon">
                        <i class="icon-sitemap"></i>
                    </div>
                    <div class="well-data">
                        <span class="well-data-number">
						<?php
									$sql = "SELECT count(catid) FROM category";
									$query = mysqli_query($connect, $sql);
									$row = mysqli_fetch_array($query);
									echo $row[0];
						?>
						</span>
                        <div class="well-content">หมวดหมู่สินค้า</div>
                    </div>
                </div>
				<div class="well wblue">
                    <div class="well-icon">
                        <i class="icon-suitcase"></i>
                    </div>
                    <div class="well-data">
                        <span class="well-data-number">
						<?php
									$sql = "SELECT count(productid) FROM product";
									$query = mysqli_query($connect, $sql);
									$row = mysqli_fetch_array($query);
									echo $row[0];
						?>
						</span>
                        <div class="well-content">จำนวนสินค้า</div>
                    </div>
                </div>
                <div class="well wred">
                    <div class="well-icon">
                        <i class="icon-pencil"></i>
                    </div>
                    <div class="well-data">
                        <span class="well-data-number">
						<?php
									$sql = "SELECT count(orderid) FROM `order`";
									$query = mysqli_query($connect, $sql);
									$row = mysqli_fetch_array($query);
									$numorder = $row[0];
									echo $row[0];
						?>
						</span>
                        <div class="well-content">รายการสั่งซื้อ</div>
                    </div>
                </div>
				
				<div class="well wpink">
                    <div class="well-icon">
                        <i class="icon-inbox"></i>
                    </div>
                    <div class="well-data">
                        <span class="well-data-number">
						<?php
									$sql = "SELECT count(orderid) FROM `order` WHERE status=3";
									$query = mysqli_query($connect, $sql);
									$row = mysqli_fetch_array($query);
									$numcomplete = $row[0];
									echo $row[0];
						
									//echo ($numorder-$numcomplete);
						?>
						</span>
                        <div class="well-content">ยังไม่ได้รับของ	</div>
                    </div>
                </div>
				<div class="well wgreen">
                    <div class="well-icon">
                        <i class="icon-truck"></i>
                    </div>
                    <div class="well-data">
                        <span class="well-data-number">
						<?php
                                    $sql = "SELECT count(orderid) FROM `order` WHERE status=4";
                                    $query = mysqli_query($connect, $sql);
                                    $row = mysqli_fetch_array($query);
                                    $numcomplete = $row[0];
                                    //echo $row[0];
                        
                                    echo $numcomplete;
                        ?>
						</span>
                        <div class="well-content">รับของเสร็จสิ้น</div>
                    </div>
                </div>
				<div class="well wgreen">
                    <div class="well-icon">
                        <i class="icon-bitcoin"></i>
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
                        <div class="well-content">ยอดเงินรวม</div>
                    </div>
                </div>
				
				<div class="well wviolet">
                    <div class="well-icon">
                        <i class="icon-user"></i>
                    </div>
                    <div class="well-data">
                        <span class="well-data-number">
						<?php
									$sql = "SELECT count(memberid) FROM member_staff";
									$query = mysqli_query($connect, $sql);
                                    $row = mysqli_fetch_array($query);
									echo $row[0];
						?>
						</span>
                        <div class="well-content">จำนวนพนักงาน</div>
                    </div>
                </div>
				
				<div class="well wgray">
                    <div class="well-icon">
                        <i class="icon-envelope"></i>
                    </div>
                    <div class="well-data">
                        <span class="well-data-number">0</span>
                        <div class="well-content">ข้อความ</div>
                    </div>
                </div>
               
            </div>
            <!-- Statistics ends -->
            <!-- Recent comments widget -->

        </div>


    </div>
</div>

<!-- Today status ends -->

<!-- Dashboard Graph starts -->

<div class="row">
    <div class="col-md-6">

        <!-- Widget -->
        <!-- Chart -->
        <div class="widget wgray">
            <!-- Widget head -->
            <div class="widget-head">
                <div class="pull-left"><i class="icon-bar-chart"></i> Dashboard</div>
                <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a>
                    <a href="#" class="wclose"><i class="icon-remove"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>

            <!-- Widget content -->
            <div class="widget-content">
                <div class="padd">

                    <!-- Bar chart (Blue color). jQuery Flot plugin used. -->
                    <div id="pie-chart">Loading...</div>


                </div>
            </div>
            <!-- Widget ends -->

        </div>
    </div>

    <!-- curve chart -->
    <div class="col-md-6">
        <div class="widget wgray">
            <div class="widget-head">
                <div class="pull-left"><i class="icon-bar-chart"></i> กราฟแสดงยอดใบสั่งซื้อประจำวัน</div>
                <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a>
                    <a href="#" class="wclose"><i class="icon-remove"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="widget-content">
                <div class="padd">

                    <!-- Curve chart -->

                    <div id="curve-chart"></div>

                    <hr/>
                    <!-- Hover location -->
                    <div id="hoverdata">Mouse hovers at
                        (<span id="x">0</span>, <span id="y">0</span>). <span id="clickdata"></span></div>

                    <!-- Skil this line. <div class="uni"><input id="enableTooltip" type="checkbox">Enable tooltip</div> -->

                </div>
            </div>
        </div>
    </div>
    <!-- curve chart ends -->
</div>

<div class="row">


            <!-- Widget footer -->
            <div class="widget-foot">

            </div>

        </div>
    </div>

            </div>

            <!-- Widget footer -->
            <div class="widget-foot">
                <div class="clearfix"></div>

            </div>
			

        </div>