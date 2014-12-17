<!-- Page heading -->
        <div class="page-head">

            <!-- Breadcrumb -->
            <div class="bread-crumb">
                <a href="index.html"><i class="icon-home"></i></a>
                <!-- Divider -->
                <i class="icon-angle-right"></i>
                <a href="#" class="bread-current">Dashboard</a>
            </div>
            <!-- Page heading -->
            <h3 class="content-heading">ดูความเคลื่อนไหว</h3>

            <div class="clearfix"></div>

        </div>
        <!-- Page heading ends -->

        <!-- Matter -->

        <div class="matter">
            <div class="container">

                <div class="row">

                    <!-- Content -->
                    <div class="col-md-12">
                        <table class="table table-hover">
                        <thead>
                            <tr>
                                <th> รูป</th>
                                <th>
                                        เหตุการณ์</th>
                                <th> 
                                        เมื่อเวลา</a></th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                $sql = 'SELECT * FROM `log` ORDER BY `datetime` DESC';
                $query = mysqli_query($connect, $sql);
                
                while($result = mysqli_fetch_array($query, MYSQL_ASSOC)) {
                    $type = $result['type'];
                    $event = $result['event'];
                    $datetime = $result['datetime'];
                    echo "<tr>";
                    echo "<td>";
                        if($type == 1) {
                            echo '<i class="icon-user"></i>';
                        } else if($type == 2) {
                            echo '<i class="icon-off"></i>';
                        } else if($type == 3) {
                            echo '<i class="icon-shopping-cart"></i>';
                        } else if($type == 4) {
                            echo '<i class="icon-plus"></i>';
                        } else if($type == 5) {
                            echo '<i class="icon-minus"></i>';
                        }
                    echo "</td>";
                    echo "<td> $event </td>";
                    echo "<td> $datetime </td>";
                    echo "</tr>";
                }
                                        
                ?> 
                               
                                
                                
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>

        <!-- Matter ends -->