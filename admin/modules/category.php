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
                <a href="#" class="bread-current">สินค้า</a>
				<i class="icon-angle-right"></i>
                <a href="#" class="bread-current">จัดการหมวดหมู่</a>
            </div>
            <!-- Page heading -->
            <h3 class="content-heading">จัดการหมวดหมู่</h3>

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
					$cat_name = $_POST["cat_name"];
					$sql = mysqli_query($connect, "INSERT INTO category VALUE(NULL, '$cat_name', 0)");
					if($sql) {
						echo "<div class=\"alert alert-success\">ระบบได้เพิ่มหมวดหมู่ {$cat_name} เรียบร้อยแล้วค่ะ</div>";
					} else {
						echo "<div class=\"alert alert-warning\">ไม่สามารถเพิ่ม{$cat_name} ได้ อาจจะเพราะชื่อนี้เคยถูกใช้ไปแล้วค่ะ</div>";	
					}
			}
			else if($action=="delete"){
					connect();
					$sql = mysqli_query($connect, "DELETE FROM category WHERE catid={$_GET['id']}");
					if($sql) {
						echo "<div class=\"alert alert-success\">ระบบได้ทำการลบ เรียบร้อยแล้วค่ะ</div>";
					} else {
						echo "<div class=\"alert alert-warning\">ไม่สามารถลบได้ เพราะไม่มีสินค้านี้อยู่ในระบบค่ะ</div>";	
					}
			}
			?>
			
			
                    <!-- Content -->
					<form action="index.php?page=category&action=add" method="POST" class="form-horizontal form-box" role="form">
                                    <h4 class="form-box-header">เพิ่มหมวดหมู่ใหม่</h4>
                                    <div class="form-box-content">

                                        <div class="form-group">
                                            <label class="col-lg-4 control-label">ชื่อหมวดหมู่</label>

                                            <div class="col-lg-8">
                                                <input class="form-control" placeholder="" type="text" name="cat_name">
                                            </div>
                                        </div>

                                        
                                      
                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-9">
                                                <button type="submit" class="btn btn-default">เพิ่มหมวดหมู่</button>
												
                                            </div>
                                        </div>
                                    </div>
                                </form>
										

			<ul id="sortable">
			
				<?php
				$count=1;
				$sql = mysqli_query($connect, "SELECT c.catid, description,count(p.productid) AS num, ranking FROM category c LEFT OUTER JOIN product p ON c.catid=p.catid GROUP BY c.catid ORDER BY ranking asc");
				while($result = mysqli_fetch_array($sql, MYSQL_ASSOC)) {
				?>
				<li class="ui-state-default" id="recordsArray_<?php echo $result['catid'];?>"><div class="row"> <div class="col-lg-10"><i class="icon-sort"></i> <?php echo $result['description'];?> (<?php echo $result['num'];?> ชิ้น)</div>
				 <div class="col-lg-2 btn-group">
						<a href="index.php?page=editcategory&catid=<?php echo $result['catid'];?>">
							<button class="btn btn-sm btn-default" title="Edit"><i class="icon-pencil"></i></button>
						</a>
						<a href="" onclick="return deleteBox('<?php echo $result['description'];?>','?page=category&action=delete&id=<?php echo $result['catid'];?>', 0)">
							<button class="btn btn-sm btn-default" title="Delete"><i class="icon-trash"></i></button>
						</a>
                    </div>
					</div>
					</li>
				<?php 
				$count++;
				} ?>
			</ul>
			
					</div>
                </div>

            </div>
        </div>

        <!-- Matter ends -->