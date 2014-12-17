<?php
			require "../inc/setting.inc.php";
  
			$sqllist = "SELECT orderid, total, dateOrder, print FROM `order`WHERE print=0 ORDER BY orderid ASC LIMIT 20";
			$sql = mysqli_query($connect, $sqllist);
			$count=0;
			while($result = mysqli_fetch_array($sql, MYSQL_ASSOC)) {
	  ?>
	  <?php 
			
	  
			echo "<tr class=\"list\">"; ?>
		
		  <td>#<?php echo $result['orderid'];?></td>
		  <td><?php echo $result['total'];?></td>
		  <td><?php if($result['print'] ==0) echo "<font color='red'>ยังไม่ได้พิมพ์</font>"; else echo "พิมพ์แล้ว";?> </td>
		  
		 </tr>
		 <?php
		
			$count++;
			}
		?>