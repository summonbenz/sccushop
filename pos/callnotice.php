<?php
			require "../inc/setting.inc.php";
  
			$sqllist = "SELECT * FROM notice LIMIT 1";
			$sql = mysqli_query($connect, $sqllist);
			while($result = mysqli_fetch_array($sql, MYSQL_ASSOC)) {
	  ?>
	  	
	  <?php
	   if($result['type']) {
	  			echo "<div data-alert class=\"alert-box {$result['type']}\">{$result['message']}</div>";
			}
		}
	?>
		