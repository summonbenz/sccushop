<?php 
require "../../inc/setting.inc.php";

if($action=! NULL) {
    ?>

<?php
}
	$orderid = (isset($_GET['oid'])) ? $_GET['oid'] : 0;
    $action =  (isset($_GET["action"])) ? $_GET["action"] : '';
    if($action == "add") {
        mysqli_autocommit($connect, TRUE);
        $error = false;
        $stock = $_POST['piece'];

        $sql = "SELECT stock FROM product WHERE productid={$_POST['pid']}";
        //echo $sql;
        $result = mysqli_query($connect, $sql);
        $check = mysqli_fetch_row($result);
        if(($check[0] - $stock) >= 0) {
            $sql = "UPDATE product SET stock = stock-$stock WHERE productid={$_POST['pid']}";
            $result = mysqli_query($connect, $sql);
        } else {
            mysqli_rollback($connect);
            $error = true;
        }

        if($error == false) {
            $sql = "INSERT INTO buyproduct (orderid, productid, piece) VALUES ('{$_POST['orderid']}', '{$_POST['pid']}', '{$_POST['piece']}');";
            $query = mysqli_query($connect, $sql);
            if(!$result) { mysqli_rollback($connect); $error=true; }
                echo "<center><h2>เพิ่มข้อมูลเรียบร้อยแล้วค่ะ</h2><br><input type=\"button\" value=\"ปิด [X]\"onclick=\"closeWindow();\"/></center>"; 
            } else {
                echo "<center><h2>ไม่สามารถเพิ่มสินค้าได้เนื่องจากมีไม่พอในสต๊อกค่ะ</h2><br><input type=\"button\" value=\"ปิด [X]\"onclick=\"closeWindow();\"/></center>"; 
                mysqli_rollback($connect);
            }
    }else if($action == "delete") {
        
        $sql = "SELECT piece FROM `buyproduct` WHERE `orderid` = {$_GET['oid']} AND `productid` = {$_GET['pid']};";
        $query = mysqli_query($connect, $sql);
        $stock = mysqli_fetch_row($query);

        $sql = "UPDATE product SET stock = stock + {$stock[0]} WHERE productid = {$_GET['pid']}";
        $query = mysqli_query($connect, $sql);

        $sql = "DELETE FROM `buyproduct` WHERE `orderid` = {$_GET['oid']} AND `productid` = {$_GET['pid']};";
        $query = mysqli_query($connect, $sql);

        echo "<center><h2>ลบรายการเรียบร้อยแล้วค่ะ</h2><br><input type=\"button\" value=\"ปิด [X]\"onclick=\"closeWindow();\"/>  
</center>"; 
    }
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <!-- Title and other stuffs -->
    <title>Dashboard - Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <script src="../../pos/js/jquery-2.1.0.min.js"></script>
    <script src="../js/admin.js"></script>
    <script>
        function closeWindow(){
            window.opener.location.reload();
            window.close();

        }
        function lookup(inputString) {
            if(inputString.length != 0) {
                $.get("searchproduct.php", {q: ""+inputString+""}, function(data) { // Do an AJAX call
                    //$('#suggestions').fadeIn(); // Show the suggestions box
                    $('#nameproduct').html(data); // Fill the suggestions box
                });
            }
        }
    </script>
</head>
<body>
    <?php if($action == NULL) { ?>
<form action="addprotoin.php?action=add" method="POST">
<h2>เพิ่มสินค้า</h2>
รหัสสินค้า : <input type="text" name="pid" placeholder="1" onkeyup="lookup(this.value);"/><br>
ชื่อสินค้า : <span id="nameproduct" class="result">กรุณาใส่รหัสสินค้า</span><br>
จำนวน : <input type="text" name="piece" placeholder="1"/><br>
<input type="submit" value="บันทึก"><input type="reset" value="ล้างข้อมูล"> 
<input type="hidden" name="orderid" value="<?php echo $orderid; ?>"/>
<script type="text/javascript">
        /*function RefreshParent() {
            if (window.opener != null && !window.opener.closed) {
                window.opener.location.reload();
            }
        }
        window.onbeforeunload = RefreshParent;*/
    </script>
</form>
<?php } ?>
</body>
</html>