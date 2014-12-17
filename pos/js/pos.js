var total = 0;
var discount = 0;
var listItem = new Array;
var currentPage = 1;
function calS() {
	var total = 0;
	var inttotal;
		$( "#itemOrder tr" ).each(function( index ) {
				var price = $( this ).find( "td:eq(1)" ).text();
				var quantity = $( this ).find( "td:eq(3)" ).text();
				total += (price*quantity);
		});
		//alert("discount:"+discount);
		total -= discount;
		inttotal = total;
		total = numeral(total).format('0,0.00');
	$('#total').html('<input name="tTotal" value="'+inttotal+'" type="hidden">'+total);	
}
function plusItem(productid){
		var pos = listItem.indexOf(productid);
		var count=-2;
		$( "#itemOrder tr" ).each(function( index ) {
		//alert("COUNT"+count+" POS"+pos);
			if(count==pos) {
			//alert('FOUND');
				var price = $( this ).find( "td:eq(1)" ).text();
				var quantity = $( this ).find( "td:eq(3)" ).text();
				quantity++;
				$( this ).find( "td:eq(3)" ).html('<input name="items[]" value="'+quantity+'" type="hidden">'+quantity);
				var newtotal = quantity*price;
				$( this ).find( "td:eq(5)" ).html(newtotal);
				calS();
			}
			count++;
		});
		
}
function minusItem(productid){
		var pos = listItem.indexOf(productid);
		var count=-2;
		$( "#itemOrder tr" ).each(function( index ) {
		
			if((count)==(pos)) {
				var price = $( this ).find( "td:eq(1)" ).text();
				var quantity = $( this ).find( "td:eq(3)" ).text();
				if((quantity-1) <=0) {
					deleteItem(productid);
					//alert("ขออภัยค่ะ ไม่สามารถลดจำนวนได้มากกว่านี้แล้วค่ะ");
				} else {
					quantity--;
					$( this ).find( "td:eq(3)" ).html(quantity);
					var newtotal = quantity*price;
					$( this ).find( "td:eq(5)" ).html(newtotal);
					calS();
				}
			}
			count++;
		});
}
function deleteItem(productid){
		var pos = listItem.indexOf(productid);
		var count=-2;
		//alert(productid);
		//alert(listItem.toString());
		$( "#itemOrder tr" ).each(function( index ) {
		
			if((count)==(pos)) {
				var price = $( this ).find( "td:eq(1)" ).text();
				var quantity = $( this ).find( "td:eq(3)" ).text();
				//delete HTML
				this.parentNode.removeChild( this );  
				//delete Node Array
				var index = listItem.indexOf(productid);		
				listItem.splice(index, 1);
				//alert(listItem.toString());
				calS();
			}
			count++;
		});
}
function resetList() {
		if(confirm("คุณต้องการจะลบรายการทั้งหมดหรือไม่?")) {
			callReset();
		}
}
function callReset() {
			$('#itemOrder tbody tr').each( function(){ 
				this.parentNode.removeChild( this );  
			}); 
			$('#itemOrder tbody').html("<tr></tr>"); 
			listItem = [];
			discount = 0;
			$('#disbox').html('<input name="discount" value="0" type="hidden">'+'0.00');
			calS();
}
function addItem(productid, name, price){
	
	var pos = listItem.indexOf(productid);
	if(pos==-1) {
		//new list
		$('#itemOrder tr:last').after('<tr><td><input name="itemspid[]" value="'+productid+'" type="hidden"><a href="#" style="color:red;"  onclick="deleteItem('+productid+')">[X]</a> '+name+'</td>\n<td><input name="itemsprice[]" value="'+price+'" type="hidden">'+price+'</td>\n<td><a href="#" onclick="minusItem('+productid+')"><span class="round secondary label">-</span></a></td>\n<td><input name="items[]" value="1" type="hidden">1</td><td><a href="#" onclick="plusItem('+productid+')"><span class="round secondary label">+</span></a></td><td>'+price+'</td></tr>\n');
		listItem.push(productid);
		calS();
	} else {
		//already list
		plusItem(productid);
	}
	
}
function addDiscount() {
	var sum = ($('#total').text());
	sum = numeral().unformat(sum);
	var amount = parseFloat(prompt("ใส่เป็นจำนวนเงินที่ต้องการลดให้ค่ะ","0.00"));
	if (amount>=0.00)
	  {
	  discount = parseFloat(discount);
	  if(sum>=amount) {
		  discount += amount;
		  showdis = numeral(discount).format('0,0.00');
		  $('#disbox').html('<input name="discount" value="'+discount+'" type="hidden">'+showdis);
		  calS();
	  } else {
		alert('ขออภัยค่ะ คุณใส่ส่วนลดเกินจำนวนค่ะ');
	  }
	} 
}
function loadpage(page, catid) {
		$("#product_list").load("search.php?page="+page+"&catid="+catid);
		currentPage = page;
}
function nextpage(catid) {
		currentPage++;
		loadpage(currentPage, catid);
}
function previouspage(catid) {
		currentPage--;
		loadpage(currentPage, catid);
}
function selectCat(catid) {
		$('#product_list').html("<center><img src='img/loader.gif'/><h3>Loading...</h3></center>")
		$("#product_list").load("search.php?catid="+catid);
		//alert(catid);
}
function lookup(inputString) {
	if(inputString.length == 0) {
		$("#product_list").load("search.php");
	} else {
		$.get("search.php", {q: ""+inputString+""}, function(data) { // Do an AJAX call
			//$('#suggestions').fadeIn(); // Show the suggestions box
			$('#product_list').html(data); // Fill the suggestions box
		});
	}
}
function opensub(pid) {
	$.fancybox({
		href: 'subproduct.php?pid='+pid,
		type: 'ajax',
		hideOnContentClick: true
	}); // fancybox
}
function bundle(pid) {
	$.fancybox({
		href: 'subbundle.php?pid='+pid,
		type: 'ajax',
		hideOnContentClick: true
	}); // fancybox
}
function discountBundle(cost){
	var sum = ($('#total').text());
	sum = numeral().unformat(sum);

if(cost<sum) {
	var amount = sum-cost;
	alert('ระบบได้ให้ส่วนลดไป '+amount+' บาทค่ะ');
	  
	discount += amount;
	showdis = numeral(discount).format('0,0.00');
	$('#disbox').html('<input name="discount" value="'+discount+'" type="hidden">'+showdis);
	calS();
} else {
	alert('โปรดตรวจสอบสินค้าใหม่อีกครั้ง เนื่องจากยังสั่งซื้อไม่ครบค่ะ');
}
	
}
function logout() {
		$.ajax({
				cache: false,
				url: "logout.php",
				success: function(data) {
						$("#login_box").get(0).className = "";
						$("#txtUsername").val("");
						$("#txtPassword").val("");
						$("#manager").html("");
				}//end success
		});//end ajax	
	
}
 function about() {
	alert('จัดทำโดย\nนายนิพิฐพนธ์ จันทร์ธาดา #5533684623\nน.ส.นพรัตน์ ทรัพย์อร่ามดี #5533683023\nน.ส.วนัสนันท์ มณีแสง #5333686723\nนิสิตคณะวิทยาศาสตร์ สาขาคณิตศาสตร์และวิทยาการคอมพิวเตอร์ จุฬาลงกรณ์มหาวิทยาลัย');
 }
function printoid(){
	var oid=parseInt(prompt("กรุณาใส่่หมายเลขใบสั่งซื้อสินค้าด้วยค่ะ","0"));
		if (oid!=null) {
			window.location="../print/print.php?oid="+oid;
		}
}
$(document).ready(function() {
	$("#search_form").val("");
	//$("#search_form").focus();
	$("#product_list").load("search.php");

	/*------------------------------- CHECK OUT -------------------------------*/
	$('#bt_checkout').on("click", function (e) {
		e.preventDefault(); // avoids calling success.php from the link
		//alert('tes');
		$.ajax({
			type: "POST",
            cache: false,
            url: this.href,
            data: $("#shopping").serializeArray(), // all form fields
			success: function(data) {
				//alert('connect');
				$.fancybox.showLoading();
				$.fancybox(data, {
				  // fancybox API options
				  padding : 5,
				  scrolling: 'no',
				  fitToView: false,
				  width: 400,
				  height: 500,
				  autoSize: false,
				  closeClick: false,
				  openEffect: 'elastic',
				  closeEffect: 'fade',
				  'afterClose':function () {
						callReset();
						selectCat(0);
					}
				}); // fancybox
			} //success
        }); // ajax
	});
	/*-------------------------- END CHECK OUT -------------------------------*/
	$('#submit').click(function(){
	//alert("login");
		var username=$('#username').val();
		var password=$('#password').val();
		var dataString = 'txtUsername='+ username+'&txtPassword='+password;
		$.ajax({ type: "POST",
					url: "login.php",
					data: dataString,
					cache: false,
					success: function(data)
					{
						msg = data.split('|');
						if(data == "false") {
						$("#error").get(0).className = "active";
						} else {
							$("#login_box").get(0).className = "active";
							$("#manager").html(msg[1]);
						}
					}

				   });
		return false;

		});
});