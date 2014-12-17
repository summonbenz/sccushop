function openpopup(site, oid) {
	window.open(site+'?oid='+oid, "MsgWindow", "width=300, height=240");
}
function deleteItem(oid, pid) {
	//alert("delete"+oid+" : "+pid);
	var textName = "คุณต้องการจะลบรายการชิ้นนี้หรือไม่?\nเมื่อลบแล้วจะกลับมาแก้ไขไม่ได้อีก";
	//if(type == 1) textName = textName.concat("\nถ้าลบบริษัทนี้ สินค้าในบริษัทนี้จะถูกลบทั้งหมด");
	var r=confirm(textName);
			if(r == true) {
				window.open('modules/addprotoin.php?action=delete&oid='+oid+'&pid='+pid, "MsgWindow", "width=300, height=240");
		}
	return false;
}

function editOrder(oid, pid) {
	//alert(pid);
	//alert('editware');
	var add=parseInt(prompt("กรุณาใส่จำนวนสินค้าที่ต้องการเพิ่ม/ลดด้วยค่ะ","0"));

	if (add!=null) {
		//alert('test');
			var count=0;
			$('#product-list-'+pid+' td').each( function(){ 
				//alert('test2');
					var quantity = 0;
					//var total = quantity+add;
					//alert('quan='+quantity+'total'+total);
					if(count==3) {
						$.ajax({
							url: 'addstocko.php',
							data: 'oid='+oid+'&productid='+pid+'&stock='+add,
							type: "POST",
							cache: false
							});
						quantity = parseInt($( this ).text());
						//alert('quan'+quantity);
						$( this ).html((add+quantity)+' <a href="#" onclick="editbox('+pid+')"><i class="icon-plus-sign" title="เพิ่ม/ลดสต็อกสินค้า"></i></a>');
					}
					count++;
					//alert(count);
			});
	  }
}
function editWarehouse(pid) {
	//alert(pid);
	var x;
	//alert('editware');
	var add=parseInt(prompt("กรุณาใส่จำนวนสินค้าที่ต้องการเพิ่ม/ลดด้วยค่ะ","0"));

	if (add!=null) {
		//alert('test');
			var count=0;
			$('#product-list-'+pid+' td').each( function(){ 
					var quantity = 0;
					//var total = quantity+add;
					//alert('quan='+quantity+'total'+total);
					if(count==5) {
						$.ajax({
							url: 'addstockw.php',
							data: 'productid='+pid+'&stock='+add,
							type: "POST",
							cache: false
							});
						quantity = parseInt($( this ).text());
						//alert('quan'+quantity);
						$( this ).html((add+quantity)+' <a href="#" onclick="editbox('+pid+')"><i class="icon-plus-sign" title="เพิ่ม/ลดสต็อกสินค้า"></i></a>');
					}
					count++;
					//alert(count);
			});
	  }
}

function editbox(pid) {
	var x;

	var add=parseInt(prompt("กรุณาใส่จำนวนสินค้าที่ต้องการเพิ่ม/ลดด้วยค่ะ","0"));

	if (add!=null) {
		  x="Hello " + add + "! How are you today?";
			var count=0;
			var current = 0;
			$('#product-list-'+pid+' td').each( function(){ 
					var quantity = 0;
					var total = quantity+add;
					if(count==5) {
						current = parseInt($( this ).text());
						quantity = parseInt($( this ).next().text());
						//alert('current: '+current+'quantity: '+quantity)
						if(current-add>=0) { //minus product

						$.ajax({
							url: 'addstock.php',
							data: 'productid='+pid+'&stock='+add,
							type: "POST",
							cache: false
							});

						$( this ).html((current-add)+' <a href="#" onclick="editWarehouse('+pid+')"><i class="icon-plus-sign" title="เพิ่ม/ลดสต็อกสินค้า"></i></a>');
						
						$( this ).next().html((add+quantity)+' <a href="#" onclick="editbox('+pid+')"><i class="icon-plus-sign" title="เพิ่ม/ลดสต็อกสินค้า"></i></a>');
						} else {
							alert('ของมีไม่พอกับจำนวนในโกดังค่ะ');
						}
					}
					count++;
			});
	  }
}
function deleteBox(name, urlname, type)
{
	var x;
	var textName = "คุณต้องการจะลบ \""+name+"\" หรือไม่?\nเมื่อลบแล้วจะกลับมาแก้ไขไม่ได้อีก";
	//if(type == 1) textName = textName.concat("\nถ้าลบบริษัทนี้ สินค้าในบริษัทนี้จะถูกลบทั้งหมด");
	var r=confirm(textName);
	
	
		var url = window.location.pathname;	
		var pathArray = url.split('/');
		var newHost = "index.php"+urlname;
			if(r == true) {
				window.location = newHost;
		}
	return false;
}
$(function() {
			$( "#sortable" ).sortable({
				placeholder: "ui-state-highlight",
				cursor: 'move',
				update : function () {
					var order = $('#sortable').sortable("serialize");
					$.ajax({
						type : "POST",
						url : "sorting.php",
						data : order,
						success: function(data,textStatus) {
							data = eval('(' + data + ')');
						}
					});
					
					//alert('update');
				}

			});
				$( "#sortable" ).disableSelection();
				
		$('.type-order').click(function() {

        // create input for editing
        //var editarea = document.createElement('input');
        //editarea.setAttribute('type', 'text');

        // put current value in it
        //editarea.setAttribute('value', $(this).html());

        // rewrite current value with edit area
			$(this).html('<select class="carlist" form="carform"><option value="0">==เลือกสถานะ==</option><option value="1">ชำระเงินเสร็จสิ้น</option><option value="2">กำลังจัดของ</option><option value="3">รอรับของ</option><option value="4">รับเสร็จเรียบร้อย</option><option value="-1">มีปัญหา</option></select>');
			
        // set focus to newly created input
			//$(editarea).focus();
		});
			
			$('.type-order').change(function(){
				//alert($(this).attr('id'));
				var idorder = $(this).attr('id');
				idorder = idorder.substring(8);
				//alert(idorder);
				var status = $('.carlist').val();
				$.ajax({
					type: 'POST',
					url: 'changeStatus.php',
					data: {orderid: idorder, status: status}
				});
				if(status == 1) {
					$(this).html("<span class=\"label label-default\">ชำระเงินเสร็จสิ้น</span>");
				} else if(status == 2) {
					$(this).html("<span class=\"label label-info\">กำลังจัดของ</span>");
				} else if(status == 3) {
					$(this).html("<span class=\"label label-warning\">รอรับของ</span>");
				} else if(status == 4) {
					$(this).html("<span class=\"label label-success\">รับของเรียบร้อย</span>");
				} else {
					$(this).html("<span class=\"label label-important\">มีปัญหา</span>");
				}
			});
			$('#datetimeA').datetimepicker({
			  pickTime: false
			});
			$('#datetimeB').datetimepicker({
			  pickTime: false
			});
});
