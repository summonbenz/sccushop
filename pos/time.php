<?php
  $hour = 6; //ปรับให้ตรงตามต้องการ ชม. เช่น เป็นค่าบวก หรือค่าลบ เพื่อให้เวลาของ server ตรงกับเวลาจริง
  $min = 0; //ปรับให้ตรงตามต้องการ นาที
  $Year = date("Y")+543;
  $thaimonth=array("มค.","กพ.","มีค.","เมย.","พค.","มิย.","กค.","สค.","กย.","ตค.", "พย.","ธค.");

  //วันที่ วันนี้
  $mtoday=date("d ",mktime( date("H")+$hour, date("i")+$min ));
  $mtime=date("H:i",mktime( date("H")+$hour, date("i")+$min ));
  $mdate=$mtoday. $thaimonth[date("m")-1]." ".$Year;
  
  //กำหนดให้ IE อ่าน page นี้ทุกครั้ง ไม่ไปเอาจาก cache
  header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
  header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
  header ("Cache-Control: no-cache, must-revalidate");
  header ("Pragma: no-cache");
  
  header("content-type: application/x-javascript; charset=utf-8");
  echo "$mtime";
?>