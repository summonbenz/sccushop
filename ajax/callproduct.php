<?php
			require "../inc/setting.inc.php";
  
			$sqllist = "SELECT wStock, productid, pic, pname, stock FROM product  WHERE type<>2 AND type<>4 ORDER BY stock ASC";
			$sql = mysqli_query($connect, $sqllist);
			while($result = mysqli_fetch_array($sql, MYSQL_ASSOC)) {
	  ?>
	  	
	  <?php if($result['stock'] >10) echo "<tr class=\"list\">"; else if($result['stock'] >0) echo "<tr class=\"list yellow\">"; else echo "<tr class=\"list red\">";?>
		
		  <td><?php echo "<img src=\"productimages/{$result['pic']}\" width=40 height=40/>"?></td>
		  <td><a href="#" onclick="changeStock(<?php echo $result['productid']; ?>, '<?php echo $result['pname']; ?>', <?php echo $result['wStock']; ?>)"><?php echo $result['pname'];?></a></td>
		  <td><?php if($result['stock'] <=0) echo "<font color='#fff'>{$result['stock']}</font>"; else echo  $result['stock'];?></td>
		 </tr>
		<?php
			}
		?>
		