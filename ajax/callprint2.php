<?php
			require "../inc/setting.inc.php";
  
			$sqllist = "SELECT orderid, total, dateOrder, print FROM  `order`WHERE print=0 ORDER BY orderid ASC LIMIT 20";
			$sql = mysqli_query($connect, $sqllist);
			$result = mysqli_fetch_array($sql, MYSQL_ASSOC);
			//echo $result['orderid']
			echo "<a href=\"print/print.php?oid={$result['orderid']}\" target=\"_blank\"><input type=\"button\" value=\"print!\"></a>";
			//echo "<iframe src=\"print/print.php?oid={$result['orderid']}\" name=\"frame1\" width=0 height=0></iframe><input type=\"button\" onclick=\"frames['frame1'].print()\" value=\"print!\">";
			//echo "<script>frames['frame1'].print();</script>";
?>