<?php
error_reporting(E_ALL);
ob_start();
ini_set('display_errors', 1);
date_default_timezone_set("Asia/Bangkok");
//if (!isset($_SESSION['userauth_cf'])){header("location:".$_SESSION['ASSETS_URL']."auth/");}
// $userID = isset($_SESSION['memberAuth']) ? $_SESSION['memberAuth']['id'] : null;
$DOMAIN = isset($uri_past[0]) && $uri_past[0]!="" ? $uri_past[0] : "layout";
$ACTION = $DOMAIN=="layout" ? "main" : (isset($uri_past[1]) ? $uri_past[1] : "list");
$_SESSION['LANG'] = $LANG = isset($_SESSION['LANG']) ? $_SESSION['LANG'] : "Th";
$PAGE = $DOMAIN."/view/".$ACTION;
?>
<!DOCTYPE html>
<html lang="en" ng-app="myApp">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Atlantis Lite - Bootstrap 4 Admin Dashboard</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<!-- <link rel="icon" href="<?php // echo $ASSETS_URL; ?>assets/img/icon.ico" type="image/x-icon"/> -->

	<!-- Fonts and icons -->
	<script src="<?php echo $ASSETS_URL; ?>assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['<?php echo $ASSETS_URL; ?>assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="<?php echo $ASSETS_URL; ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo $ASSETS_URL; ?>assets/css/atlantis.min.css">
	<link rel="stylesheet" href="<?php echo $ASSETS_URL; ?>assets/fontawesome/css/all.min.css">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="<?php echo $ASSETS_URL; ?>assets/css/demo.css">

	<script type="text/javascript">
		var PATH = '<?php echo $ASSETS_URL; ?>';
		// var USERID = '<?php //echo $userID; ?>';
		var LANG = '<?php echo $LANG; ?>';
		var LINK = '<?php echo $LINK_URL; ?>';
	</script>
	<script src="<?php echo $ASSETS_URL; ?>plugin/jquery.min.js"></script>
	<script src="<?php echo $ASSETS_URL; ?>plugin/angular.min.js"></script>
	<script src="<?php echo $ASSETS_URL; ?>plugin/angular-sanitize.min.js"></script>
	
	<script src="<?php echo $ASSETS_URL; ?>plugin/ng-notify-master/dist/ng-notify.min.js"></script>
	<script src="<?php echo $ASSETS_URL; ?>conf/myApp//myApp.js"></script>
	<script src="<?php echo $ASSETS_URL; ?>conf/myApp/myAppController.js"></script>
	<link href="<?php echo $ASSETS_URL; ?>plugin/ng-notify-master/dist/ng-notify.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $ASSETS_URL; ?>assets/css/cusstom.css" rel="stylesheet">
</head>
<body ng-controller="myAppController" data-background-color="bg3">
<div id="loading" data-loading>
	<ul class="bokeh">
		<li></li>
		<li></li>
		<li></li>
	</ul>
</div>
	<div class="wrapper">
		<div class="main-header">
			<?php 
				include 'app/layout/view/admin_herder.php'; 
				include 'app/layout/view/admin_navbar_header.php'; 
			?>
		</div>

		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">			
			<?php include 'app/layout/view/admin_menu_sidebar.php'; ?>
		</div>
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
				<?php
					$PAGE = isset($_GET['page']) ? $_GET['page'] : $PAGE;
					$str_pathFile = "app/" . $PAGE.".php";
					$breadcrumb = isset($_GET['page']) ? explode("/", $_GET['page']) : explode("/", $PAGE);

					if (file_exists($str_pathFile)){
						include_once($str_pathFile);
					}else{
						include_once("app/layout/view/404.php");
					}
				?>
			</div>
			<?php include_once("app/layout/view/admin_footer.php"); ?>
		</div>
		
		<!-- Custom template | don't include it in your project! -->
		<!-- <div class="custom-template">
			<div class="title">Settings</div>
			<div class="custom-content">
				<div class="switcher">
					<div class="switch-block">
						<h4>Logo Header</h4>
						<div class="btnSwitch">
							<button type="button" class="changeLogoHeaderColor" data-color="dark"></button>
							<button type="button" class="selected changeLogoHeaderColor" data-color="blue"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="purple"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="light-blue"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="green"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="orange"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="red"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="white"></button>
							<br/>
							<button type="button" class="changeLogoHeaderColor" data-color="dark2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="blue2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="purple2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="light-blue2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="green2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="orange2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="red2"></button>
						</div>
					</div>
					<div class="switch-block">
						<h4>Navbar Header</h4>
						<div class="btnSwitch">
							<button type="button" class="changeTopBarColor" data-color="dark"></button>
							<button type="button" class="changeTopBarColor" data-color="blue"></button>
							<button type="button" class="changeTopBarColor" data-color="purple"></button>
							<button type="button" class="changeTopBarColor" data-color="light-blue"></button>
							<button type="button" class="changeTopBarColor" data-color="green"></button>
							<button type="button" class="changeTopBarColor" data-color="orange"></button>
							<button type="button" class="changeTopBarColor" data-color="red"></button>
							<button type="button" class="changeTopBarColor" data-color="white"></button>
							<br/>
							<button type="button" class="changeTopBarColor" data-color="dark2"></button>
							<button type="button" class="selected changeTopBarColor" data-color="blue2"></button>
							<button type="button" class="changeTopBarColor" data-color="purple2"></button>
							<button type="button" class="changeTopBarColor" data-color="light-blue2"></button>
							<button type="button" class="changeTopBarColor" data-color="green2"></button>
							<button type="button" class="changeTopBarColor" data-color="orange2"></button>
							<button type="button" class="changeTopBarColor" data-color="red2"></button>
						</div>
					</div>
					<div class="switch-block">
						<h4>Sidebar</h4>
						<div class="btnSwitch">
							<button type="button" class="selected changeSideBarColor" data-color="white"></button>
							<button type="button" class="changeSideBarColor" data-color="dark"></button>
							<button type="button" class="changeSideBarColor" data-color="dark2"></button>
						</div>
					</div>
					<div class="switch-block">
						<h4>Background</h4>
						<div class="btnSwitch">
							<button type="button" class="changeBackgroundColor" data-color="bg2"></button>
							<button type="button" class="changeBackgroundColor selected" data-color="bg1"></button>
							<button type="button" class="changeBackgroundColor" data-color="bg3"></button>
							<button type="button" class="changeBackgroundColor" data-color="dark"></button>
						</div>
					</div>
				</div>
			</div>
			<div class="custom-toggle">
				<i class="flaticon-settings"></i>
			</div>
		</div>-->
		<!-- End Custom template -->
	<!-- </div>  -->
	<!--   Core JS Files   -->
	<script src="<?php echo $ASSETS_URL; ?>assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="<?php echo $ASSETS_URL; ?>assets/js/core/popper.min.js"></script>
	<script src="<?php echo $ASSETS_URL; ?>assets/js/core/bootstrap.min.js"></script>

	<!-- jQuery UI -->
	<script src="<?php echo $ASSETS_URL; ?>assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="<?php echo $ASSETS_URL; ?>assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

	<!-- jQuery Scrollbar -->
	<script src="<?php echo $ASSETS_URL; ?>assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>


	<?php /*<!-- Chart JS -->
	<script src="<?php echo $ASSETS_URL; ?>assets/js/plugin/chart.js/chart.min.js"></script>

	<!-- jQuery Sparkline -->
	<script src="<?php echo $ASSETS_URL; ?>assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

	<!-- Chart Circle -->
	<script src="<?php echo $ASSETS_URL; ?>assets/js/plugin/chart-circle/circles.min.js"></script>

	<!-- Datatables -->
	<script src="<?php echo $ASSETS_URL; ?>assets/js/plugin/datatables/datatables.min.js"></script>

	<!-- Bootstrap Notify -->
	<script src="<?php echo $ASSETS_URL; ?>assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script> */ ?>

	<!-- jQuery Vector Maps -->
	<!-- <script src="<?php //echo $ASSETS_URL; ?>assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
	<script src="<?php //echo $ASSETS_URL; ?>assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script> -->

	<!-- Sweet Alert -->
	<script src="<?php echo $ASSETS_URL; ?>assets/js/plugin/sweetalert/sweetalert.min.js"></script>

	<!-- Atlantis JS -->
	<script src="<?php //echo $ASSETS_URL; ?>assets/js/atlantis.min.js"></script>

	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<!-- <script src="<?php //echo $ASSETS_URL; ?>assets/js/setting-demo.js"></script> -->
	<!-- <script src="<?php //echo $ASSETS_URL; ?>assets/js/demo.js"></script> -->
	<!-- <script>
		Circles.create({
			id:'circles-1',
			radius:45,
			value:60,
			maxValue:100,
			width:7,
			text: 5,
			colors:['#f1f1f1', '#FF9E27'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})

		Circles.create({
			id:'circles-2',
			radius:45,
			value:70,
			maxValue:100,
			width:7,
			text: 36,
			colors:['#f1f1f1', '#2BB930'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})

		Circles.create({
			id:'circles-3',
			radius:45,
			value:40,
			maxValue:100,
			width:7,
			text: 12,
			colors:['#f1f1f1', '#F25961'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})

		var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');

		var mytotalIncomeChart = new Chart(totalIncomeChart, {
			type: 'bar',
			data: {
				labels: ["S", "M", "T", "W", "T", "F", "S", "S", "M", "T"],
				datasets : [{
					label: "Total Income",
					backgroundColor: '#ff9e27',
					borderColor: 'rgb(23, 125, 255)',
					data: [6, 4, 9, 5, 4, 6, 4, 3, 8, 10],
				}],
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				legend: {
					display: false,
				},
				scales: {
					yAxes: [{
						ticks: {
							display: false //this will remove only the label
						},
						gridLines : {
							drawBorder: false,
							display : false
						}
					}],
					xAxes : [ {
						gridLines : {
							drawBorder: false,
							display : false
						}
					}]
				},
			}
		});

		$('#lineChart').sparkline([105,103,123,100,95,105,115], {
			type: 'line',
			height: '70',
			width: '100%',
			lineWidth: '2',
			lineColor: '#ffa534',
			fillColor: 'rgba(255, 165, 52, .14)'
		});
	</script> -->
</body>
</html>