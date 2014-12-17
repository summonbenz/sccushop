<?php
	$hour = date("H", time()+(3600*6));
	echo $hour."".date(":i:s");
?>