<?php
			require "../inc/setting.inc.php";
  
			$sqllist = "SELECT productid, pic, pname, wStock FROM product WHERE type<>2 AND type<>4 ORDER BY wStock ASC";
			$sql = mysqli_query($connect, $sqllist);
			while($result = mysqli_fetch_array($sql, MYSQL_ASSOC)) {
	  ?>
	  <?php if($result['wStock'] >10) echo "<tr class=\"list\">"; else if($result['wStock'] >0) echo "<tr class=\"list yellow\">"; else echo "<tr class=\"list red\">";?>
		
		  <td><?php echo "<img src=\"productimages/{$result['pic']}\" width=40 height=40/>"?></td>
		  <td><a href="#" onclick="changeWarehouse(<?php echo $result['productid']; ?>, '<?php echo $result['pname']; ?>')"><?php echo $result['pname'];?></a></td>
		  <td><?php if($result['wStock'] <=0) echo "<font color='#fff'>{$result['wStock']}</font>"; else echo  $result['wStock'];?></td>
		 </tr>
		<?php
			}
		?>