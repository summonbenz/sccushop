<?php
 header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
  header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
  header ("Cache-Control: no-cache, must-revalidate");
  header ("Pragma: no-cache");
$total = $_POST['tTotal'];

?>

<header class="row">
		<div class="large-12 medium-12 small-12 columns title-header"><center>ชำระเงิน</center></div>
</header>
<header class="row">
		<div class="large-4 medium-4 small-4 columns title-total">ทั้งหมด</div>
		<div class="large-8 medium-8 small-8 columns total-value" id="tTotal">
		<?php echo number_format($total, 2, '.', ',');?>
		</div>
</header>
<header class="row">
		<div class="large-4 medium-4 small-4 columns title-tender">ชำระเงิน</div>
		<div class="large-8 medium-8 small-8 columns tender-value">
		<input type="text" onkeyup="calTotal();" name="tender" placeholder="0.00" id="tTender" style="text-align:right;background: transparent;color:#fff;border:0px;font-size:1.5em;" />
		</div>
</header>
<!-------------------------- Bank Pad ---------------------->
<div class="row" style="text-align:center;padding:10px;heig	ht:4.3em;"><ul class="large-block-grid-5 medium-block-grid-5 small-block-grid-5 padbank">
		<li><a href="#" onclick="addValue(20);"><img src="img/bank_20.png"/></a></li>	
		<li><a href="#" onclick="addValue(50);"><img src="img/bank_50.png"/></a></li>	
		<li><a href="#" onclick="addValue(100);"><img src="img/bank_100.png"/></a></li>	
		<li><a href="#" onclick="addValue(500);"><img src="img/bank_500.png"/></a></li>	
		<li><a href="#" onclick="addValue(1000);"><img src="img/bank_1000.png"/></a></li>	
</ul>
</div>
<!-------------------------- Number Pad---------------------->
<div class="row padnum"><ul class="large-block-grid-3 medium-block-grid-3 small-block-grid-3">
<li><a href="javascript:;" onclick="addKeyboard('1')">1</a></li>
<li><a href="javascript:;" onclick="addKeyboard('2')">2</a></li>
<li><a href="javascript:;" onclick="addKeyboard('3')">3</a></li>
<li><a href="javascript:;" onclick="addKeyboard('4')">4</a></li>
<li><a href="javascript:;" onclick="addKeyboard('5')">5</a></li>
<li><a href="javascript:;" onclick="addKeyboard('6')">6</a></li>
<li><a href="javascript:;" onclick="addKeyboard('7')">7</a></li>
<li><a href="javascript:;" onclick="addKeyboard('8')">8</a></li>
<li><a href="javascript:;" onclick="addKeyboard('9')">9</a></li>
<li><a href="javascript:;" onclick="addKeyboard('.')">.</a></li>
<li><a href="javascript:;" onclick="addKeyboard('0')">0</a></li>
<li><a href="javascript:;" onclick="delValue();">Del</a></li>
</ul></div>
<!-------------------------- Button Total ---------------------->
<footer class="row" style="text-align:center;">
		<a href="javascript:;" onclick="submitForm();" id="bt_submit"class="button disabled" style="background:#585858;width:100%;font-family: 'rsu-bold';font-size:1.5em;">เงินทอน (<span class="btValue">
		<input type="hidden" name="change_val" value="0"><?php echo "-".number_format($total, 2, '.', ',');?></span> THB)</a>
</footer>



<!----------------------------- Complete Box --------------------->
<div id="complete_box" class="">
	<header class="row">
		<div class="title-header">ชำระเงินเสร็จสิ้น</div>
	</header>
	<aside class="row complete-text">
	เงินทอน <span style="font-size:2em;">00.00</span> บาท<br>
	ขอบคุณที่มาอุดหนุนสินค้าค่ะ<br>
	<br>
	ราคาทั้งหมด 0.00 บาท
	</aside>

	<footer class="row" style="text-align:center;"><a href="javascript:jQuery.fancybox.close();" id="bt_submit"class="button [secondary success alert]" style="width:100%;font-family: 'rsu-bold';font-size:1.5em;">ตกลง</a></footer>
	</form>
</div>
