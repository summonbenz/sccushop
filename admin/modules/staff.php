<?php
	$action =  (isset($_GET["action"])) ? $_GET["action"] : '';
	$pid =  (isset($_GET["id"])) ? $_GET["id"] : '';
?>
<!-- Page heading -->
        <div class="page-head">

            <!-- Breadcrumb -->
            <div class="bread-crumb">
                <a href="index.html"><i class="icon-home"></i></a>
                <!-- Divider -->
                <i class="icon-angle-right"></i>
                <a href="#" class="bread-current"> พนักงาน</a>
				<i class="icon-angle-right"></i>
                <a href="#" class="bread-current"> จัดการพนักงาน</a>
            </div>
            <!-- Page heading -->
            <h3 class="content-heading"> จัดการพนักงาน</h3>

            <div class="clearfix"></div>

        </div>
        <!-- Page heading ends -->

        <!-- Matter -->

        <div class="matter">
            <div class="container">

                <div class="row">
					<div class="col-md-12">
			<?php
			if($action=="delete"){
					$sqllist = "SELECT * FROM member_staff WHERE memberid=$pid ";
					$query= mysqli_query($connect, $sqllist);
					$row = mysqli_fetch_array($query); 
					
					if($_SESSION['position'] != 'A' && $row['position'] == 'A') {
							echo "<h1>ไม่อนุญาตให้ลบผู้ดูแลระบบค่ะ</h1>";
							exit();
					}
	
					$sql = mysqli_query($connect, "DELETE FROM member_staff WHERE memberid={$_GET['id']}");
					if($sql) {
						echo "<div class=\"alert alert-success\">ระบบได้ทำการลบ เรียบร้อยแล้วค่ะ</div>";
					} else {
						echo "<div class=\"alert alert-warning\">ไม่สามารถลบได้ เพราะไม่มีสินค้านี้อยู่ในระบบค่ะ</div>";	
					}
			}
			?>
			
                    <!-- Content -->
					<table class="table">
            <thead>
            <tr>
                <th>#</th>
				<th>  Username</th>
                <th>  ชื่อเล่น</th>
                <th> ภาควิชา</th>
				<th><i class="icon-phone"></i> เบอร์โทร</th>
				<th><i class="icon-envelope"></i> อีเมล์</th>
				<th><i class="icon-user"></i> ตำแหน่ง</th>
                <th>จัดการสินค้า</th>
            </tr>
            </thead>
            <tbody>
			<?php
				$count=1;
				$sql = mysqli_query($connect, "SELECT * FROM member_staff ORDER BY memberid asc ");
				while($result = mysqli_fetch_array($sql, MYSQL_ASSOC)) {
			?>
            <tr>
                <td><?php echo $result['memberid']?></td>
                <td><?php echo $result['username'];?></td>
				<td><?php echo $result['nickname'];?></td>
                <td><?php echo $result['major'];?></td>
				<td><?php echo $result['phone'];?></td>
				<td><?php echo $result['email'];?></td>
				<td>
					<?php
						if($result['position'] == 'A') {
							echo "<span class=\"label label-success\">ผู้ดูแลระบบ</span>";
						} else if($result['position'] == 'M') {
							echo "<span class=\"label label-warning\">ผู้จัดการ</span>";
						} else if($result['position'] == 'C') {
							echo "<span class=\"label label-info\">แคชเชียร์</span>";
						}

					?>
				</td>
                <td>
                    <div class="btn-group">
						<a href="?page=infostaff&pid=<?php echo $result['memberid'];?>"><button class="btn btn-sm btn-default" title="View"><i class="icon-search"></i></button></a>
						<a href="?page=editstaff&pid=<?php echo $result['memberid'];?>"><button class="btn btn-sm btn-default" title="Edit"><i class="icon-pencil"></i></button></a>
						<a href="" onclick="return deleteBox('<?php echo $result['firstname'];?>','?page=staff&action=delete&id=<?php echo $result['memberid'];?>', 0)">
							<button class="btn btn-sm btn-default" title="Delete"><i class="icon-trash"></i></button>
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