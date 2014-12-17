<!-- Use the class nred, ngreen,,, or norange to add background color. You need to use this in <li> tag. -->

            <li class="current"><a href="index.php?page=main"><i class="icon-desktop"></i> หน้ารวม</a></li>

            <li><a href="index.php?page=notice"><i class="icon-comment"></i> หน้าประกาศ</a></li>
            

            <?php
                if($spage == "statement" || $spage=="addstatement" || $spage=="invoice") {
                    echo " <li class=\"has_submenu current open\">";
                } else {
                    echo " <li class=\"has_submenu\">";
                }
            ?>
                <a href="#">
                    <!-- Menu name with icon -->
                    <i class="icon-shopping-cart"></i> ใบสั่งซื้อ
                    <!-- Icon for dropdown -->
                    <span class="pull-right">1</span>
                </a>
                <?php //echo $spage; ?>
                <ul>
                    <li <?php if($spage=="statement" || $spage=="invoice" || $spage == "editinvoice") echo "class=\"active\""; ?>><a href="index.php?page=statement">รายการใบสั่งซื้อ</a></li>
                    
                </ul>
            </li>
            
			 <!-- Menu with sub menu -->
			<?php
				if($spage == "product" || $spage=="addproduct" || $spage=="category" || $spage=="infoproduct" || $spage=="editproduct") {
					echo " <li class=\"has_submenu current open\">";
				} else {
					echo " <li class=\"has_submenu\">";
				}
			?>
                <a href="#">
                    <!-- Menu name with icon -->
                    <i class="icon-briefcase"></i> สินค้า
                    <!-- Icon for dropdown -->
                    <span class="pull-right">3</span>
                </a>

                <ul>
                    <li <?php if($spage=="product") echo "class=\"active\""; ?>><a href="index.php?page=product">จัดการสินค้า</a></li>
					<li <?php if($spage=="addproduct") echo "class=\"active\""; ?>><a href="index.php?page=addproduct">เพิ่มสินค้าใหม่</a></li>
					<li <?php if($spage=="category") echo "class=\"active\""; ?>><a href="index.php?page=category">จัดการหมวดหมู่</a></li>
                </ul>
            </li>
			<li><a href="index.php?page=warehouse"><i class="icon-truck"></i> บริษัทตัวแทน</a></li>
			
			
			
			<li><a href="index.php?page=stat"><i class="icon-bar-chart"></i> รายงานสถิติ</a></li>
			
			<?php
				if($spage == "addstaff" || $spage=="staff") {
					echo " <li class=\"has_submenu current open\">";
				} else {
					echo " <li class=\"has_submenu\">";
				}
			?>
                <a href="#">
                    <!-- Menu name with icon -->
                    <i class="icon-group"></i> พนักงาน
                    <!-- Icon for dropdown -->
                    <span class="pull-right">2</span>
                </a>

                <ul>
                    <li <?php if($spage=="addstaff") echo "class=\"active\""; ?>><a href="index.php?page=addstaff">เพิ่มพนักงานใหม่</a></li>
                    <li <?php if($spage=="staff") echo "class=\"active\""; ?>><a href="index.php?page=staff">จัดการพนักงาน</a></li>
                </ul>

                <li><a href="index.php?page=log"><i class="icon-cog"></i> ดูความเคลื่อนไหว</a></li>
				
				<li><a href="index.php?page=reset"><i class="icon-off"></i> รีเซ็ตระบบ</a></li>
            </li>