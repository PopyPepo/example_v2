<?php 
$userauth = "userauth";
//if (isset($_SESSION[$userauth])){header("location:".$_SESSION['ASSETS_URL']."administrator/");} 
?>
<!DOCTYPE html>
<html lang="en" ng-app="myApp">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="<?php echo $ASSETS_URL; ?>assets/image/logosut_e.gif">
	<title>Scholaship : Administratior</title>

	<!-- ================= Favicon ================== -->

	<!-- Styles -->
	<link href="<?php echo $ASSETS_URL; ?>assets/css/lib/font-awesome.min.css" rel="stylesheet">
	<link href="<?php echo $ASSETS_URL; ?>assets/css/lib/themify-icons.css" rel="stylesheet">
	<link href="<?php echo $ASSETS_URL; ?>assets/css/lib/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo $ASSETS_URL; ?>assets/css/lib/unix.css" rel="stylesheet">
	<link href="<?php echo $ASSETS_URL; ?>assets/css/style.css" rel="stylesheet">

	<script type="text/javascript">
		var PATH = '<?php echo $ASSETS_URL; ?>';
		var LINK = '<?php echo $LINK_URL; ?>';
	</script>
	<script src="<?php echo $ASSETS_URL; ?>plugin/jquery.min.js"></script>
	<script src="<?php echo $ASSETS_URL; ?>plugin/angular.min.js"></script>
	<script src="<?php echo $ASSETS_URL; ?>plugin/angular-sanitize.min.js"></script>
	
	<script src="<?php echo $ASSETS_URL; ?>plugin/ng-notify-master/dist/ng-notify.min.js"></script>
	<link href="<?php echo $ASSETS_URL; ?>plugin/ng-notify-master/dist/ng-notify.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $ASSETS_URL; ?>assets/css/cusstom.css" rel="stylesheet">
</head>

<body class="bg-warning" ng-controller="loginController">

<div class="unix-login">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-lg-offset-3">
				<div class="login-content">
					<div class="login-logo">
						<a href="index.html"><span>Scholaship</span></a>
					</div>
					<div class="login-form">
						<h4>Administratior Login</h4>
						<form method="POST" autocomplete="off" ng-submit="login(user);">
							<div class="form-group">
								<label>Email address</label>
								<input type="text" class="form-control" placeholder="Email" ng-model="user.username" required="required">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" class="form-control" placeholder="Password" ng-model="user.password" required="required">
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox"> Remember Me
								</label>
								<!-- <label class="pull-right">
									<a href="#">Forgotten Password?</a>
								</label> -->

							</div>
							<button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Sign in</button>
							<!-- <div class="social-login-content">
								<div class="social-button">
									<button type="button" class="btn btn-primary bg-facebook btn-flat btn-addon m-b-10"><i class="ti-facebook"></i>Sign in with facebook</button>
									<button type="button" class="btn btn-primary bg-twitter btn-flat btn-addon m-t-10"><i class="ti-twitter"></i>Sign in with twitter</button>
								</div>
							</div> -->
							<div class="register-link m-t-15 text-center">
								<p>No account or problem? call <a href="#"> 3129</a> นายธัญเทพ พรหมสอน</p>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- inline scripts related to this page -->
<script type="text/javascript">

angular.module('myApp', ['ngNotify']).controller('loginController', ["$scope", "$http", "$window", "ngNotify",function($scope, $http, $window, ngNotify){

	$scope.xxx = {};
	$scope.login = function(user){
		$http({
			method: "POST",
			url: PATH+"app/glb_info/model/?action=login",
			data: $.param(user),
			headers: {"Content-Type": "application/x-www-form-urlencoded"}
		}).then(function successCallback(response) {
			console.log(response.data);
			ngNotify.set("ไม่พบชื่อผู้ใช้", 'warn');
			var ins = response.data.instance;
			if (response.data.status){
				setSession(ins);
			}else{
				// console.log('Login to Fail!!!');
				//showNotification('ไม่พบชื่อผู้ใช้', 'warning', 'fa-exclamation-triangle', 'Login to Fail!!! กรุณาตรวจสอบขอ้มูลให้ถูกต้อง');
				ngNotify.set("ไม่พบชื่อผู้ใช้", 'warn');
			}
		}, function errorCallback(response) {
			console.log("stadiumController save ERROR!!!");
		});
	};

	setSession = function(auth){
		$http({
			method: "POST",
			url: PATH+"app/glb_info/model/?action=setSession",
			data: $.param(auth),
			headers: {"Content-Type": "application/x-www-form-urlencoded"}
		}).then(function successCallback(response) {
			console.log(response.data);
			if (response.data){
				$window.location.href = PATH+"administrator/";
			}
		}, function errorCallback(response) {
			console.log("stadiumController save ERROR!!!");
		});
	};
}]);
</script>

</body>

</html>