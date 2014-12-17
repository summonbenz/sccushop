var tender = 0;
var change = 0;
function addValue(num) {
	//var old = numeral().unformat($("#tTender").val());
	old =  parseFloat($("#tTender").val());
	if(isNaN(old)) {
		old = 0;
	}
	tender = old+num;
	// showdis = numeral(tender).format('0,0.00');
	$("#tTender").val(tender);
	calTotal();
}
function delValue() {
	var str = $("#tTender").val();
	var n = str.length;
	var res = str.substring(0,--n);

	$("#tTender").val(res);
	calTotal();
}
function addKeyboard(k) {
	//alert('ADD'+k);
	//calc.tender.value += k;
	var old = $("#tTender").val();
	//alert(old);
	$("#tTender").val(old+k);
	calTotal();
}
function submitForm() {
var val = parseFloat($("#tTender").val());
if(isNaN(val)) {
    alert("ตัวเลขไม่ถูกต้องค่ะ");
} else {
	if(change<0) { 
		alert('ยังชำระเงินไม่ครบค่ะ'); 
	} else { //success
		$("#loading").css('display','block');
		showdis = numeral(change).format('0,0.00');
		$("#showtender").html(showdis);
		$.ajax({
				type: "POST",
				cache: false,
				url: "sendorder.php",
				data: $("#calc").serializeArray(), // all form fields
				timeout: 20000,
				error: function(data2) {
					$("#errorSend").css('display','block');
				},
				success: function(data) {
				//alert(data);
					$("#loading").css('display','none');
					$(".orderid").html(data);
					$("#complete_box").get(0).className = "active";
				}
		});
	} //end if
}
}
function closeForm() {
alert('close');
$.fancybox.close();
}
function calTotal() {
	var tt = $("#tTotal").html();
	tt = numeral().unformat(tt);
	var td = $("#tTender").val();
	change = td-tt;
	showdis = numeral(change).format('0,0.00');
	$(".btValue").html('<input type="hidden" name="change_val" value="'+change+'">'+showdis);
		//change when OK
		if(change>=0) {
			$("#bt_submit").get(0).className = "button [radius round]";
			$("#bt_submit").css("background", "#3daadc");
		} else {
			$("#bt_submit").get(0).className = "button disabled";
			$("#bt_submit").css("background", "#585858");
		}
		
}
$(document).ready(function() {
	//$("#tTender").focus();
	
});