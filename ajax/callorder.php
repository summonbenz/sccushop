<?php
			require "../inc/setting.inc.php";
  
			connect();
			$oid = (isset($_POST['oid'])) ? $_POST['oid'] : NULL;

			$sql = "SELECT * FROM `order`AS ord ";
			$sql .= "INNER JOIN buyproduct AS buy ON ord.orderid=buy.orderid ";
			$sql .= "INNER JOIN product ON product.productid = buy.productid ";
			$sql .= "WHERE ord.orderid=$oid ";
			$sql .= "ORDER BY ord.orderid ASC";
			$query = mysqli_query($connect, $sql);
			//echo $sql;
			
?>
		<h2>หมายเลขใบสั่งซื้อ : #<?php echo $oid;?></h2>

		 <a href="#" onclick="sendcom2(<?php echo $oid;?>)" class="button [radius round]" style="width:150px">จัดเสร็จแล้ว</a>
		 <a href="#" onclick="next()" class="button [radius success round]" style="width:130px">ข้าม</a>
		 
	 <table>
	  <thead>
		<tr class="list">
		  <th>รูป</th>
		  <th width=400>ชื่อ</th>
		  <th>จำนวน</th> 
		  <th>ครบ</th> 
		</tr>
	  </thead>
	  <tbody>
		<?php while($result= mysqli_fetch_array($query, MYSQL_ASSOC)) { ?>
	  <tr class="list">
		  <td><?php echo "<img src=\"productimages/{$result['pic']}\" width=40 height=40/>"?></td>
		  <td><?php echo $result['pname'];?></td>
		  <td><?php echo $result['piece'];?></td>
		  <td><input id="checkbox1" type="checkbox" ></td>
		 </tr>
		<?php
			}
		?>
		</tbody>
	</table>
  <!-- Footer -->