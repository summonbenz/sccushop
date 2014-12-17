<?php
    $action =  (isset($_GET["action"])) ? $_GET["action"] : '';
    $pid =  (isset($_GET["pid"])) ? $_GET["pid"] : '';
    $ch = false;
       $ch = true;
        $sqllist = "SELECT * FROM notice LIMIT 1";
        
        $query= mysqli_query($connect, $sqllist);
        $item = mysqli_num_rows($query);
        
        //if($item == 0) header('Location:index.php?page=404');
        $row = mysqli_fetch_array($query); 
        //$productid = $row['productid'];

?>
<!-- Page heading -->
        <div class="page-head">

            <!-- Breadcrumb -->
            <div class="bread-crumb">
                <a href="index.html"><i class="icon-home"></i></a>
                <!-- Divider -->
                <i class="icon-angle-right"></i>
                <a href="#" class="bread-current">หน้าประกาศ</a>
            </div>
            <!-- Page heading -->
            <h3 class="content-heading">หน้าประกาศ</h3>

            <div class="clearfix"></div>

        </div>
        <!-- Page heading ends -->
        <!-- Matter -->

        <div class="matter">
            <div class="container">

                <div class="row">

                    <!-- Content -->
                    <div class="col-md-12">
                        <?php
            if($action=="edit"){
                    $notice_message = $_POST['notice_message'];
                    $notice_type = $_POST['notice_type'];
                    
                    //echo "TYPE".$notice_type;
                        //*** Insert Record ***//
                        
                        //add product
                        $strSQL = "UPDATE notice SET type = '{$notice_type}', message = '{$notice_message}' WHERE id = 1;";
                        $objQuery = mysqli_query($connect, $strSQL) or die('error');     
                                if($objQuery) {
                                    echo "<div class=\"alert alert-success\">ระบบได้แก้ไขเรียบร้อยแล้วค่ะ <a href='index.php?page=main'>[กลับ]</a></div>";
                                }

                        $sqllist = "SELECT * FROM notice LIMIT 1";
        
                        $query= mysqli_query($connect, $sqllist);
                        $item = mysqli_num_rows($query);
                        
                        //if($item == 0) header('Location:index.php?page=404');
                        $row = mysqli_fetch_array($query); 
                    
            }
            
            ?>

                    หน้านี้มีไว้เพื่อตั้งค่าประกาศข่าวสารแจ้งให้ทราบ ในหน้าแคชเชียร์ เช่น สินค้าไม่พอ ระบบมีปัญหา เป็นต้น
                    <form action="index.php?page=notice&action=edit" method="POST" class="form-horizontal form-box" role="form" enctype="multipart/form-data">
                                    <h4 class="form-box-header">หน้าประกาศ</h4>
                                    <div class="form-box-content">

                                        <div class="form-group">
                                            <label class="col-lg-7 control-label">รูปแบบ</label>
                                            <div class="col-lg-7">
                                            <?php
                                            $typeValue = array("", "primary", "success", "info", "warning");
                                            $typeThai = array("ไม่มี", "สีน้ำเงิน", "สีเขียว", "สีฟ้า", "สีเหลือง");
                                            
                                            for($i=0;$i<sizeof($typeValue);$i++) {
                                                if($row['type']!=$typeValue[$i]) {
                                                echo '<input type="radio" name="notice_type" id="optionsRadios2"
                                                               value="'.$typeValue[$i].'">';
                                                } else {
                                                    echo '<input type="radio" name="notice_type" id="optionsRadios2"
                                                               value="{$typeValue[$i]}" checked>';
                                                }

                                                if($i!=0) {
                                                    echo '<span class="label label-'.$typeValue[$i].'">'.$typeThai[$i].'</span>&nbsp;&nbsp;';
                                                } else {
                                                    echo 'ปิด&nbsp;&nbsp;';
                                                }
                                            }

                                            ?>
                                            </div>
                                            
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <label class="col-lg-5 control-label">ข้อความ</label>

                                            <div class="col-lg-7">
                                                <input class="form-control" placeholder="" type="text" name="notice_message" value="<?php echo $row['message']; ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-9">
                                                <button type="submit" class="btn btn-default">แก้ไขข้อมูล</button>
                                                
                                            </div>
                                        </div>
                                    </div>
                    </form>
                    </div>
                </div>

            </div>
        </div>

        <!-- Matter ends -->