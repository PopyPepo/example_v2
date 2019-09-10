<?php
error_reporting(E_ALL);
ob_start();
ini_set('display_errors', 1);
date_default_timezone_set("Asia/Bangkok");
//if (!isset($_SESSION['userauth_cf'])){header("location:".$_SESSION['ASSETS_URL']."auth/");}
// $userID = isset($_SESSION['memberAuth']) ? $_SESSION['memberAuth']['id'] : null;
$DOMAIN = isset($uri_past[0]) && $uri_past[0]!="" ? $uri_past[0] : "_main";
$ACTION = $DOMAIN=="_main" ? "main" : (isset($uri_past[1]) ? $uri_past[1] : "list");
$_SESSION['LANG'] = $LANG = isset($_SESSION['LANG']) ? $_SESSION['LANG'] : "Th";
$PAGE = $DOMAIN."/view/".$ACTION;
?>
<!DOCTYPE html>
<html ng-app="myApp">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Examper Useing JSON API</title>
	<link rel="icon" href="<?php echo $ASSETS_URL; ?>assets/image/logosut_e.gif">
	<!-- <link href="assets/css/style.css" rel="stylesheet"> -->
	<link href="<?php echo $ASSETS_URL; ?>assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo $ASSETS_URL; ?>plugin/ng-notify-master/dist/ng-notify.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">

	<script type="text/javascript">
	
		function preload(act){	
			// console.log('preload');
			var object = document.getElementById("loading");
			// object.style.display = 'block';
			if (act){
				object.style.display = 'block';
			}
			else{
				object.style.display = 'none';
			}
		}
		var PATH = '<?php echo $ASSETS_URL; ?>';
		// var USERID = '<?php //echo $userID; ?>';
		var LANG = '<?php echo $LANG; ?>';
		var LINK = '<?php echo $LINK_URL; ?>';
		// console.log(USERID);
	</script>
	<script src="<?php echo $ASSETS_URL; ?>plugin/jquery.min.js"></script>
	<script src="<?php echo $ASSETS_URL; ?>plugin/angular.min.js"></script>
	<script src="<?php echo $ASSETS_URL; ?>plugin/angular-sanitize.min.js"></script>
	
	<script src="<?php echo $ASSETS_URL; ?>plugin/ng-notify-master/dist/ng-notify.min.js"></script>
	<script src="<?php echo $ASSETS_URL; ?>app/_main/controller/myApp.js"></script>
	<script src="<?php echo $ASSETS_URL; ?>app/_main/controller/myAppController.js"></script>
	<link href="<?php echo $ASSETS_URL; ?>assets/css/cusstom.css" rel="stylesheet">
</head>
<body ng-controller="myAppController">
<div id="loading" data-loading>
	<ul class="bokeh">
		<li></li>
		<li></li>
		<li></li>
	</ul>
</div>
	<header class="mb-1">
		<nav class="navbar navbar-expand-lg navbar-light sticky-top">
			<a class="navbar-brand" href="<?php echo $LINK_URL; ?>">
			<img src="<?php echo $ASSETS_URL; ?>assets/image/logosut_e.gif" width="30" height="30" class="d-inline-block align-top" alt="">
				BRANDNAME
			</a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarText">
				<?php include("app/_main/view/menu.php"); ?>
			</div>
		</nav>
	</header>

	<main role="main" class="container pb-4 pt-3 clearfix">
		<?php 
			$PAGE = isset($_GET['page']) ? $_GET['page'] : $PAGE;
			$str_pathFile = "app/" . $PAGE.".php";
			$breadcrumb = isset($_GET['page']) ? explode("/", $_GET['page']) : explode("/", $PAGE);

			if (file_exists($str_pathFile)){
				include_once($str_pathFile);
			}else{
				include_once("app/_main/view/404.php");
			}
		?>
	</main>

	<footer class="footer">
		<div class="container mt-3 pb-3">
			<span class="text-muted">MIS@SUT © 2018-2019 v.1.0</span>
			<small class="text-muted float-right"><address>
				มหาวิทยาลัยเทคโนโลยีสุรนารี | Suranaree University of Technology<br>
				ที่อยู่: 111, ถนน มหาวิทยาลัย ตำบล สุรนารี อำเภอเมืองนครราชสีมา นครราชสีมา 30000</address>
			</small>
		</div>
	</footer>


	
	<script src="<?php echo $ASSETS_URL; ?>assets/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="<?php echo $ASSETS_URL; ?>assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('[data-toggle="tooltip"]').tooltip();
		});
	</script>
</body>
</html>