<?php
	session_start();
	if(!$_SESSION["adminmode"]) {
		header("location:login.php");
	}
	$pageurl =  (isset($_GET["page"])) ? $_GET["page"] : 'main';
	$spage = $pageurl;
	$pageurl = "modules/".$pageurl.".php";
	require "includes/setting.inc.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <!-- Title and other stuffs -->
    <title>Dashboard - Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">


    <!-- Stylesheets -->
    <link href="style/bootstrap.css" rel="stylesheet">
    <!-- Font awesome icon -->
    <link rel="stylesheet" href="style/font-awesome.css">
    <!-- jQuery UI -->
    <link rel="stylesheet" href="style/jquery-ui.css">
    <!-- Calendar -->
    <link rel="stylesheet" href="style/fullcalendar.css">
    <!-- prettyPhoto -->
    <link rel="stylesheet" href="style/prettyPhoto.css">
    <!-- Star rating -->
    <link rel="stylesheet" href="style/rateit.css">
    <!-- Date picker -->
    <link rel="stylesheet" href="style/bootstrap-datetimepicker.min.css">
    <!-- jQuery Gritter -->
    <link rel="stylesheet" href="style/jquery.gritter.css">
    <!-- CLEditor -->
    <link rel="stylesheet" href="style/jquery.cleditor.css">
    <!-- Bootstrap toggle -->
    <link rel="stylesheet" href="style/bootstrap-switch.css">
    <!-- Main stylesheet -->
    <link href="style/style.css" rel="stylesheet">
    <!--[if lte IE 9]>
    <link href="style/styleie.css" rel="stylesheet">
    <![endif]-->
    <!-- Widgets stylesheet -->
    <link href="style/widgets.css" rel="stylesheet">


    <!-- HTML5 Support for IE -->
    <!--[if lt IE 9]>
    <script src="js/html5shim.js"></script>
    <![endif]-->

    <!-- Favicon -->
    <link rel="shortcut icon" href="img/favicon/favicon.png">
	
	 <!-- JS -->
	<script src="js/jquery.js"></script>
	<!-- jQuery -->
	<script src="js/bootstrap.js"></script>
	<!-- Bootstrap -->
	<script src="js/jquery-ui-1.10.4.custom.min.js"></script>
	<script src="js/admin.js"></script>
		<style>
		#sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
		#sortable li { color:#4e4e4e;margin: 0 5px 5px 5px; padding: 5px; font-size: 1.4em; height: 1.5em; }
		html>body #sortable li { height: 2.1em; line-height: 1.2em; }
		.ui-state-highlight { height: 1.5em; line-height: 1.2em; }
		</style>

</head>

<body>

<div class="navbar navbar-fixed-top bs-docs-nav" role="banner">

<div class="containerk">
<!-- Menu button for smallar screens -->
<div class="navbar-header">
    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a href="../index.php" class="navbar-brand"><img src="img/logo_alpha.png" width=55/> CoinCoin*</a>
</div>
<!-- Site name for smallar screens -->


<!-- Navigation starts -->
<div class="collapse navbar-collapse bs-navbar-collapse" role="navigation">


<!-- Links -->
<ul class="nav navbar-nav navbar-right"><small></small>
	<li class="text-center hidden-xs" style="color:#fff;padding-top:10px;padding-right:10px;"><?php echo $info['name']; ?></li>
	<li class="text-center hidden-xs" style="color:#fff;padding-top:10px;padding-right:10px;">(Management System)</li>
	
	<li class="divider-vertical hidden-xs"></li>
    <li class="dropdown light-blue">
        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
            <i class="icon-user"></i>&nbsp;Hello, <?php echo $_SESSION["firstname"];?> <span class="visible-xs">Admin</span>
            <b class="caret"></b>
        </a>

        <!-- Dropdown menu -->
        <ul class="dropdown-menu">
            <li><a href="#"><i class="icon-refresh"></i>Refresh</a></li>
            <li class="divider"></li>
            <li><a href="#"><i class="icon-user"></i> Profile</a></li>
            <li><a href="#"><i class="icon-cogs"></i> Settings</a></li>
            <li class="divider"></li>
            <li><a href="login.php?mode=logout"><i class="icon-off"></i> Logout</a></li>
        </ul>
    </li>

</ul>

<!-- Notifications -->
<ul class="nav navbar-nav navbar-right">
    <li class="divider-vertical hidden-xs"></li>

    <li class="divider-vertical hidden-xs"></li>

</ul>

</div>

</div>

</div>


<!-- Main content starts -->

<div class="content">

<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-dropdown"><a href="#">Navigation</a></div>

    <div class="sidebar-inner">


        <!-- sidebar shortcuts -->
        <div class="sidebar-shortcuts" class="sidebar-shortcuts-large">
            <button class="btn btn-success">
                <i class="icon-signal"></i>
            </button>
            <button class="btn btn-info">
                <i class="icon-pencil"></i>
            </button>
            <button class="btn btn-warning">
                <i class="icon-group"></i>
            </button>
            <button class="btn btn-danger">
                <i class="icon-cogs"></i>
            </button>
        </div>

        <!--- Sidebar navigation -->
        <!-- If the main navigation has sub navigation, then add the class "has_submenu" to "li" of main navigation. -->
        <ul class="navi">

            <?php require "includes/nav.inc.php"; ?>
			
        </ul>


    </div>

</div>

<!-- Sidebar ends -->

<!-- Main bar -->
<div class="mainbar">
		<?php 
			
			if (!is_file($pageurl)) {
				$pageurl = "modules/404.html";
			}
			include ($pageurl);
	
		?>

 </div>
<div id="footer">
	<?php require "includes/footer.inc.php"; ?>
</div>
</div>

<!-- Footer -->


<!-- Mainbar ends -->
<div class="clearfix"></div>

</div>
<!-- Content ends -->


<!-- Scroll to top -->
<span class="totop"><a href="#"><i class="icon-chevron-up"></i></a></span>


<!-- jQuery UI -->
<script src="js/fullcalendar.min.js"></script>
<!-- Full Google Calendar - Calendar -->
<script src="js/jquery.rateit.min.js"></script>
<!-- RateIt - Star rating -->
<script src="js/jquery.prettyPhoto.js"></script>
<!-- prettyPhoto -->

<!-- jQuery Flot -->
<script src="js/excanvas.min.js"></script>
<script src="js/jquery.flot.js"></script>
<script src="js/jquery.flot.resize.js"></script>
<script src="js/jquery.flot.pie.js"></script>
<script src="js/jquery.flot.stack.js"></script>

<script src="js/jquery.gritter.min.js"></script>
<!-- jQuery Gritter -->
<script src="js/sparklines.js"></script>
<!-- Sparklines -->
<script src="js/jquery.cleditor.min.js"></script>
<!-- CLEditor -->
<script src="js/bootstrap-datetimepicker.min.js"></script>
<!-- Date picker -->
<script src="js/bootstrap-switch.min.js"></script>
<!-- Bootstrap Toggle -->
<script src="js/filter.js"></script>
<!-- Filter for support page -->
<script src="js/custom.js"></script>
<!-- Custom codes -->
<script src="js/charts.js"></script>
<!-- Custom chart codes -->
<!-- Slimscroll -->
<script src="js/jquery.slimscroll.min.js"></script>

<?php

	if($spage == "stat" || $spage=="main") {
		include "loadgraph.php";
	}
?>

</body>
</html>