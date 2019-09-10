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
	<link rel="stylesheet" href="<?php echo $ASSETS_URL; ?>assets/css/atlantis2.min.css">
	<link rel="stylesheet" href="<?php echo $ASSETS_URL; ?>assets/fontawesome/css/all.min.css">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="<?php echo $ASSETS_URL; ?>assets/css/demo.css">

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
	<script src="<?php echo $ASSETS_URL; ?>conf/myApp/myApp.js"></script>
	<script src="<?php echo $ASSETS_URL; ?>conf/myApp/myAppController.js"></script>
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
	<div class="wrapper horizontal-layout-2">
		
		<div class="main-header" data-background-color="light-blue2">
			<div class="nav-top">
				<div class="container d-flex flex-row">
					<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon">
							<i class="icon-menu"></i>
						</span>
					</button>
					<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
					<!-- Logo Header -->
					<a href="index.html" class="logo d-flex align-items-center">
						<img src="<?php echo $ASSETS_URL; ?>assets/img/logo.svg" alt="navbar brand" class="navbar-brand">
					</a>
					<!-- End Logo Header -->

					<!-- Navbar Header -->
					<nav class="navbar navbar-header navbar-expand-lg p-0">

						<div class="container-fluid p-0">
							<div class="collapse" id="search-nav">
								<form class="navbar-left navbar-form nav-search mr-md-3">
									<div class="input-group">
										<div class="input-group-prepend">
											<button type="submit" class="btn btn-search pr-1">
												<i class="fa fa-search search-icon"></i>
											</button>
										</div>
										<input type="text" placeholder="Search ..." class="form-control">
									</div>
								</form>
							</div>
							<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
								<li class="nav-item toggle-nav-search hidden-caret">
									<a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
										<i class="fa fa-search"></i>
									</a>
								</li>
								<li class="nav-item dropdown hidden-caret">
									<a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fa fa-envelope"></i>
									</a>
									<ul class="dropdown-menu messages-notif-box animated fadeIn" aria-labelledby="messageDropdown">
										<li>
											<div class="dropdown-title d-flex justify-content-between align-items-center">
												Messages 									
												<a href="#" class="small">Mark all as read</a>
											</div>
										</li>
										<li>
											<div class="scroll-wrapper message-notif-scroll scrollbar-outer" style="position: relative;"><div class="message-notif-scroll scrollbar-outer scroll-content" style="height: auto; margin-bottom: 0px; margin-right: 0px; max-height: 0px;">
												<div class="notif-center">
													<a href="#">
														<div class="notif-img"> 
															<img src="<?php echo $ASSETS_URL; ?>assets/img/jm_denis.jpg" alt="Img Profile">
														</div>
														<div class="notif-content">
															<span class="subject">Jimmy Denis</span>
															<span class="block">
																How are you ?
															</span>
															<span class="time">5 minutes ago</span> 
														</div>
													</a>
													<a href="#">
														<div class="notif-img"> 
															<img src="<?php echo $ASSETS_URL; ?>assets/img/chadengle.jpg" alt="Img Profile">
														</div>
														<div class="notif-content">
															<span class="subject">Chad</span>
															<span class="block">
																Ok, Thanks !
															</span>
															<span class="time">12 minutes ago</span> 
														</div>
													</a>
													<a href="#">
														<div class="notif-img"> 
															<img src="<?php echo $ASSETS_URL; ?>assets/img/mlane.jpg" alt="Img Profile">
														</div>
														<div class="notif-content">
															<span class="subject">Jhon Doe</span>
															<span class="block">
																Ready for the meeting today...
															</span>
															<span class="time">12 minutes ago</span> 
														</div>
													</a>
													<a href="#">
														<div class="notif-img"> 
															<img src="<?php echo $ASSETS_URL; ?>assets/img/talha.jpg" alt="Img Profile">
														</div>
														<div class="notif-content">
															<span class="subject">Talha</span>
															<span class="block">
																Hi, Apa Kabar ?
															</span>
															<span class="time">17 minutes ago</span> 
														</div>
													</a>
												</div>
											</div><div class="scroll-element scroll-x"><div class="scroll-element_outer"><div class="scroll-element_size"></div><div class="scroll-element_track"></div><div class="scroll-bar ui-draggable ui-draggable-handle"></div></div></div><div class="scroll-element scroll-y"><div class="scroll-element_outer"><div class="scroll-element_size"></div><div class="scroll-element_track"></div><div class="scroll-bar ui-draggable ui-draggable-handle"></div></div></div></div>
										</li>
										<li>
											<a class="see-all" href="javascript:void(0);">See all messages<i class="fa fa-angle-right"></i> </a>
										</li>
									</ul>
								</li>
								<li class="nav-item dropdown hidden-caret">
									<a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fa fa-bell"></i>
										<span class="notification">4</span>
									</a>
									<ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
										<li>
											<div class="dropdown-title">You have 4 new notification</div>
										</li>
										<li>
											<div class="scroll-wrapper notif-scroll scrollbar-outer" style="position: relative;"><div class="notif-scroll scrollbar-outer scroll-content" style="height: auto; margin-bottom: 0px; margin-right: 0px; max-height: 0px;">
												<div class="notif-center">
													<a href="#">
														<div class="notif-icon notif-primary"> <i class="fa fa-user-plus"></i> </div>
														<div class="notif-content">
															<span class="block">
																New user registered
															</span>
															<span class="time">5 minutes ago</span> 
														</div>
													</a>
													<a href="#">
														<div class="notif-icon notif-success"> <i class="fa fa-comment"></i> </div>
														<div class="notif-content">
															<span class="block">
																Rahmad commented on Admin
															</span>
															<span class="time">12 minutes ago</span> 
														</div>
													</a>
													<a href="#">
														<div class="notif-img"> 
															<img src="<?php echo $ASSETS_URL; ?>assets/img/profile2.jpg" alt="Img Profile">
														</div>
														<div class="notif-content">
															<span class="block">
																Reza send messages to you
															</span>
															<span class="time">12 minutes ago</span> 
														</div>
													</a>
													<a href="#">
														<div class="notif-icon notif-danger"> <i class="fa fa-heart"></i> </div>
														<div class="notif-content">
															<span class="block">
																Farrah liked Admin
															</span>
															<span class="time">17 minutes ago</span> 
														</div>
													</a>
												</div>
											</div><div class="scroll-element scroll-x"><div class="scroll-element_outer"><div class="scroll-element_size"></div><div class="scroll-element_track"></div><div class="scroll-bar ui-draggable ui-draggable-handle"></div></div></div><div class="scroll-element scroll-y"><div class="scroll-element_outer"><div class="scroll-element_size"></div><div class="scroll-element_track"></div><div class="scroll-bar ui-draggable ui-draggable-handle"></div></div></div></div>
										</li>
										<li>
											<a class="see-all" href="javascript:void(0);">See all notifications<i class="fa fa-angle-right"></i> </a>
										</li>
									</ul>
								</li>
								<li class="nav-item dropdown hidden-caret">
									<a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
										<i class="fas fa-layer-group"></i>
									</a>
									<div class="dropdown-menu quick-actions quick-actions-info animated fadeIn">
										<div class="quick-actions-header">
											<span class="title mb-1">Quick Actions</span>
											<span class="subtitle op-8">Shortcuts</span>
										</div>
										<div class="scroll-wrapper quick-actions-scroll scrollbar-outer" style="position: relative;"><div class="quick-actions-scroll scrollbar-outer scroll-content" style="height: auto; margin-bottom: 0px; margin-right: 0px; max-height: 0px;">
											<div class="quick-actions-items">
												<div class="row m-0">
													<a class="col-6 col-md-4 p-0" href="#">
														<div class="quick-actions-item">
															<i class="flaticon-file-1"></i>
															<span class="text">Generated Report</span>
														</div>
													</a>
													<a class="col-6 col-md-4 p-0" href="#">
														<div class="quick-actions-item">
															<i class="flaticon-database"></i>
															<span class="text">Create New Database</span>
														</div>
													</a>
													<a class="col-6 col-md-4 p-0" href="#">
														<div class="quick-actions-item">
															<i class="flaticon-file-1"></i>
															<span class="text">Generated Report</span>
														</div>
													</a>
													<a class="col-6 col-md-4 p-0" href="#">
														<div class="quick-actions-item">
															<i class="flaticon-interface-1"></i>
															<span class="text">Create New Task</span>
														</div>
													</a>
													<a class="col-6 col-md-4 p-0" href="#">
														<div class="quick-actions-item">
															<i class="flaticon-list"></i>
															<span class="text">Completed Tasks</span>
														</div>
													</a>
													<a class="col-6 col-md-4 p-0" href="#">
														<div class="quick-actions-item">
															<i class="flaticon-file-1"></i>
															<span class="text">Generated Report</span>
														</div>
													</a>
												</div>
											</div>
										</div><div class="scroll-element scroll-x"><div class="scroll-element_outer"><div class="scroll-element_size"></div><div class="scroll-element_track"></div><div class="scroll-bar ui-draggable ui-draggable-handle"></div></div></div><div class="scroll-element scroll-y"><div class="scroll-element_outer"><div class="scroll-element_size"></div><div class="scroll-element_track"></div><div class="scroll-bar ui-draggable ui-draggable-handle"></div></div></div></div>
									</div>
								</li>
								<li class="nav-item dropdown hidden-caret">
									<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
										<div class="avatar-sm">
											<img src="<?php echo $ASSETS_URL; ?>assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
										</div>
									</a>
									<ul class="dropdown-menu dropdown-user animated fadeIn">
										<div class="scroll-wrapper dropdown-user-scroll scrollbar-outer" style="position: relative;"><div class="dropdown-user-scroll scrollbar-outer scroll-content" style="height: auto; margin-bottom: 0px; margin-right: 0px; max-height: 0px;">
											<li>
												<div class="user-box">
													<div class="avatar-lg"><img src="<?php echo $ASSETS_URL; ?>assets/img/profile.jpg" alt="image profile" class="avatar-img rounded"></div>
													<div class="u-text">
														<h4>Hizrian</h4>
														<p class="text-muted">hello@example.com</p><a href="profile.html" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
													</div>
												</div>
											</li>
											<li>
												<div class="dropdown-divider"></div>
												<a class="dropdown-item" href="#">My Profile</a>
												<a class="dropdown-item" href="#">My Balance</a>
												<a class="dropdown-item" href="#">Inbox</a>
												<div class="dropdown-divider"></div>
												<a class="dropdown-item" href="#">Account Setting</a>
												<div class="dropdown-divider"></div>
												<a class="dropdown-item" href="#">Logout</a>
											</li>
										</div><div class="scroll-element scroll-x"><div class="scroll-element_outer"><div class="scroll-element_size"></div><div class="scroll-element_track"></div><div class="scroll-bar ui-draggable ui-draggable-handle"></div></div></div><div class="scroll-element scroll-y"><div class="scroll-element_outer"><div class="scroll-element_size"></div><div class="scroll-element_track"></div><div class="scroll-bar ui-draggable ui-draggable-handle"></div></div></div></div>
									</ul>
								</li>
								<li class="nav-item">
									<a href="#" class="nav-link quick-sidebar-toggler">
										<i class="fa fa-th"></i>
									</a>
								</li>
							</ul>
						</div>
					</nav>
					<!-- End Navbar -->
				</div>
			</div>
			<div class="container">
				<div class="nav-bottom bg-white">
					<h3 class="title-menu d-flex d-lg-none"> 
						Menu 
						<div class="close-menu"> <i class="flaticon-cross"></i></div>
					</h3>
					<ul class="nav page-navigation page-navigation-info">
						
						<li class="nav-item submenu active">
							<a class="nav-link" href="#">
								<i class="link-icon icon-screen-desktop"></i>
								<span class="menu-title">Dashboard</span>
							</a>
							<div class="navbar-dropdown animated fadeIn">
								<ul>
									<li>
										<a href="<?php echo $ASSETS_URL; ?>demo1/index.html">Dashboard 1</a>
									</li>
									<li>
										<a href="<?php echo $ASSETS_URL; ?>demo2/index.html">Dashboard 2</a>
									</li>
									<li>
										<a href="<?php echo $ASSETS_URL; ?>demo3/index.html">Dashboard 3</a>
									</li>
									<li>
										<a href="<?php echo $ASSETS_URL; ?>demo4/index.html">Dashboard 4</a>
									</li>
									<li>
										<a href="<?php echo $ASSETS_URL; ?>demo5/index.html">Dashboard 5</a>
									</li>
									<li>
										<a href="<?php echo $ASSETS_URL; ?>demo6/index.html">Dashboard 6</a>
									</li>
									<li>
										<a href="<?php echo $ASSETS_URL; ?>demo7/index.html">Dashboard 7</a>
									</li>
									<li>
										<a href="<?php echo $ASSETS_URL; ?>demo8/index.html">Dashboard 8</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item submenu">
							<a class="nav-link" href="#">
								<i class="link-icon icon-grid"></i>
								<span class="menu-title">Apps</span>
							</a>
							<div class="navbar-dropdown animated fadeIn">
								<ul>
									<li>
										<a href="boards.html">Boards</a>
									</li>
									<li>
										<a href="projects.html">Projects</a>
									</li>
									<li>
										<a href="email-inbox.html">Email Inbox</a>
									</li>
									<li>
										<a href="email-detail.html">Email Detail</a>
									</li>
									<li>
										<a href="email-compose.html">Email Inbox</a>
									</li>
									<li>
										<a href="messages.html">Messages</a>
									</li>
									<li>
										<a href="conversations.html">Conversations</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item submenu">
							<a class="nav-link" href="#">
								<i class="link-icon icon-disc"></i>
								<span class="menu-title">Finance</span>
							</a>
							<div class="navbar-dropdown animated fadeIn">
								<ul>
									<li>
										<a href="starter-template.html">Annual Report</a>
									</li>
									<li>
										<a href="starter-template.html">HR Report</a>
									</li>
									<li>
										<a href="starter-template.html">Finance Report</a>
									</li>
									<li>
										<a href="starter-template.html">Revenue Report</a>
									</li>
									<li>
										<a href="starter-template.html">IPO Report</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item submenu mega-menu dropdown">
							<a class="nav-link" href="#">
								<i class="link-icon icon-film"></i>
								<span class="menu-title">Project</span>
							</a>
							<div class="navbar-dropdown animated fadeIn">
								<div class="col-group-wrapper row">
									<div class="col-group col-md-4">
										<div class="row">
											<div class="col-12">
												<p class="category-heading">Basic Elements</p>
												<div class="submenu-item">
													<div class="row">
														<div class="col-md-6">
															<ul>
																<li><a href="#">Accordion</a></li>
																<li><a href="#">Buttons</a></li>
																<li><a href="#">Badges</a></li>
																<li><a href="#">Breadcrumbs</a></li>
																<li><a href="#">Dropdown</a></li>
																<li><a href="#">Modals</a></li>
															</ul>
														</div>
														<div class="col-md-6">
															<ul>
																<li><a href="#">Progress bar</a></li>
																<li><a href="#">Pagination</a></li>
																<li><a href="#">Tabs</a></li>
																<li><a href="#">Typography</a></li>
																<li><a href="#">Tooltip</a></li>
															</ul>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-group col-md-4">
										<div class="row">
											<div class="col-12">
												<p class="category-heading">Advanced Elements</p>
												<div class="submenu-item">
													<div class="row">
														<div class="col-md-6">
															<ul>
																<li><a href="#">Datatables</a></li>
																<li><a href="#">Carousel</a></li>
																<li><a href="#">Clipboard</a></li>
																<li><a href="#">Chart.js</a></li>
																<li><a href="#">Loader</a></li>
																<li><a href="#">Slider</a></li>
															</ul>
														</div>
														<div class="col-md-6">
															<ul>
																<li><a href="#">Popup</a></li>
																<li><a href="#">Notification</a></li>
															</ul>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-group col-md-4">
										<p class="category-heading">Icons</p>
										<ul class="submenu-item">
											<li><a href="#">Flaticons</a></li>
											<li><a href="#">Font Awesome</a></li>
											<li><a class="3">Simple Line Icons</a></li>
										</ul>
									</div>
								</div>
							</div>
						</li>
						<li class="nav-item submenu">
							<a class="nav-link" href="#">
								<i class="link-icon icon-book-open"></i>
								<span class="menu-title">HR</span>
							</a>
							<div class="navbar-dropdown animated fadeIn">
								<ul>
									<li>
										<a href="starter-template.html">Annual Report</a>
									</li>
									<li>
										<a href="starter-template.html">HR Report</a>
									</li>
									<li>
										<a href="starter-template.html">Finance Report</a>
									</li>
									<li>
										<a href="starter-template.html">Revenue Report</a>
									</li>
									<li>
										<a href="starter-template.html">IPO Report</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item submenu">
							<a class="nav-link" href="#">
								<i class="link-icon icon-pie-chart"></i>
								<span class="menu-title">Revenue</span>
							</a>
							<div class="navbar-dropdown animated fadeIn">
								<ul>
									<li>
										<a href="starter-template.html">Annual Report</a>
									</li>
									<li>
										<a href="starter-template.html">HR Report</a>
									</li>
									<li>
										<a href="starter-template.html">Finance Report</a>
									</li>
									<li>
										<a href="starter-template.html">Revenue Report</a>
									</li>
									<li>
										<a href="starter-template.html">IPO Report</a>
									</li>
								</ul>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="main-panel py-lg-4">
			<div class="content content-full">
				<div class="container">
					<div class="page-navs bg-white">
						<div class="nav-scroller">
							<div class="nav nav-tabs nav-line nav-color-secondary d-flex align-items-center justify-contents-center w-100">
								<a class="nav-link active show" data-toggle="tab" href="#tab1">All Projects
									<span class="count ml-1">(30)</span>
								</a>
								<a class="nav-link mr-5" data-toggle="tab" href="#tab2">Synced Projects</a>
								<div class="ml-auto">
									<a href="#" class="btn btn-success">New Project</a>
								</div>
							</div>
						</div>
					</div>
					<div class="page-inner bg-white">
						<div class="row row-projects">
							<div class="col-sm-6 col-lg-3">
								<div class="card">
									<div class="p-2">
										<img class="card-img-top rounded" src="<?php echo $ASSETS_URL; ?>assets/img/examples/product1.jpg" alt="Product 1">
									</div>
									<div class="card-body pt-2">
										<h4 class="mb-1 fw-bold">Play Golf</h4>
										<p class="text-muted small mb-2">Last updated: Yesterday 3:12 AM</p>
										<div class="avatar-group">
											<div class="avatar avatar-sm">
												<img src="<?php echo $ASSETS_URL; ?>assets/img/jm_denis.jpg" alt="..." class="avatar-img rounded-circle border border-white">
											</div>
											<div class="avatar avatar-sm">
												<img src="<?php echo $ASSETS_URL; ?>assets/img/chadengle.jpg" alt="..." class="avatar-img rounded-circle border border-white">
											</div>
											<div class="avatar avatar-sm">
												<img src="<?php echo $ASSETS_URL; ?>assets/img/mlane.jpg" alt="..." class="avatar-img rounded-circle border border-white">
											</div>
											<div class="avatar avatar-sm">
												<img src="<?php echo $ASSETS_URL; ?>assets/img/talha.jpg" alt="..." class="avatar-img rounded-circle border border-white">
											</div>
											<div class="avatar avatar-sm">
												<span class="avatar-title rounded-circle border border-white bg-success">+</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-lg-3">
								<div class="card">
									<div class="p-2">
										<img class="card-img-top rounded" src="<?php echo $ASSETS_URL; ?>assets/img/examples/product7.jpg" alt="Product 7">
									</div>
									<div class="card-body pt-2">
										<h4 class="mb-1 fw-bold">Brainstorming</h4>
										<p class="text-muted small mb-2">Last updated: Monday 1:32 AM</p>
										<div class="avatar-group">
											<div class="avatar avatar-sm">
												<img src="<?php echo $ASSETS_URL; ?>assets/img/jm_denis.jpg" alt="..." class="avatar-img rounded-circle border border-white">
											</div>
											<div class="avatar avatar-sm">
												<img src="<?php echo $ASSETS_URL; ?>assets/img/chadengle.jpg" alt="..." class="avatar-img rounded-circle border border-white">
											</div>
											<div class="avatar avatar-sm">
												<img src="<?php echo $ASSETS_URL; ?>assets/img/mlane.jpg" alt="..." class="avatar-img rounded-circle border border-white">
											</div>
											<div class="avatar avatar-sm">
												<img src="<?php echo $ASSETS_URL; ?>assets/img/talha.jpg" alt="..." class="avatar-img rounded-circle border border-white">
											</div>
											<div class="avatar avatar-sm">
												<span class="avatar-title rounded-circle border border-white bg-success">+</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-lg-3">
								<div class="card">
									<div class="p-2">
										<img class="card-img-top rounded" src="<?php echo $ASSETS_URL; ?>assets/img/examples/product3.jpg" alt="Product 3">
									</div>
									<div class="card-body pt-2">
										<h4 class="mb-1 fw-bold">Wisata Alam</h4>
										<p class="text-muted small mb-2">Last updated: Monday 3:30 AM</p>
										<div class="avatar-group">
											<div class="avatar avatar-sm">
												<img src="<?php echo $ASSETS_URL; ?>assets/img/jm_denis.jpg" alt="..." class="avatar-img rounded-circle border border-white">
											</div>
											<div class="avatar avatar-sm">
												<img src="<?php echo $ASSETS_URL; ?>assets/img/chadengle.jpg" alt="..." class="avatar-img rounded-circle border border-white">
											</div>
											<div class="avatar avatar-sm">
												<img src="<?php echo $ASSETS_URL; ?>assets/img/mlane.jpg" alt="..." class="avatar-img rounded-circle border border-white">
											</div>
											<div class="avatar avatar-sm">
												<img src="<?php echo $ASSETS_URL; ?>assets/img/talha.jpg" alt="..." class="avatar-img rounded-circle border border-white">
											</div>
											<div class="avatar avatar-sm">
												<span class="avatar-title rounded-circle border border-white bg-success">+</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-lg-3">
								<div class="card">
									<div class="p-2">
										<img class="card-img-top rounded" src="<?php echo $ASSETS_URL; ?>assets/img/examples/product4.jpg" alt="Product 4">
									</div>
									<div class="card-body pt-2">
										<h4 class="mb-1 fw-bold">Analysis</h4>
										<p class="text-muted small mb-2">Last updated: Sunday 3:12 PM</p>
										<div class="avatar-group">
											<div class="avatar avatar-sm">
												<img src="<?php echo $ASSETS_URL; ?>assets/img/jm_denis.jpg" alt="..." class="avatar-img rounded-circle border border-white">
											</div>
											<div class="avatar avatar-sm">
												<img src="<?php echo $ASSETS_URL; ?>assets/img/chadengle.jpg" alt="..." class="avatar-img rounded-circle border border-white">
											</div>
											<div class="avatar avatar-sm">
												<img src="<?php echo $ASSETS_URL; ?>assets/img/mlane.jpg" alt="..." class="avatar-img rounded-circle border border-white">
											</div>
											<div class="avatar avatar-sm">
												<img src="<?php echo $ASSETS_URL; ?>assets/img/talha.jpg" alt="..." class="avatar-img rounded-circle border border-white">
											</div>
											<div class="avatar avatar-sm">
												<span class="avatar-title rounded-circle border border-white bg-success">+</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-lg-3">
								<div class="card">
									<div class="p-2">
										<img class="card-img-top rounded" src="<?php echo $ASSETS_URL; ?>assets/img/examples/product5.jpg" alt="Product 5">
									</div>
									<div class="card-body pt-2">
										<h4 class="mb-1 fw-bold">Meeting</h4>
										<p class="text-muted small mb-2">Last updated: Friday 1:12 PM</p>
										<div class="avatar-group">
											<div class="avatar avatar-sm">
												<img src="<?php echo $ASSETS_URL; ?>assets/img/jm_denis.jpg" alt="..." class="avatar-img rounded-circle border border-white">
											</div>
											<div class="avatar avatar-sm">
												<img src="<?php echo $ASSETS_URL; ?>assets/img/chadengle.jpg" alt="..." class="avatar-img rounded-circle border border-white">
											</div>
											<div class="avatar avatar-sm">
												<img src="<?php echo $ASSETS_URL; ?>assets/img/mlane.jpg" alt="..." class="avatar-img rounded-circle border border-white">
											</div>
											<div class="avatar avatar-sm">
												<img src="<?php echo $ASSETS_URL; ?>assets/img/talha.jpg" alt="..." class="avatar-img rounded-circle border border-white">
											</div>
											<div class="avatar avatar-sm">
												<span class="avatar-title rounded-circle border border-white bg-success">+</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-lg-3">
								<div class="card">
									<div class="p-2">
										<img class="card-img-top rounded" src="<?php echo $ASSETS_URL; ?>assets/img/examples/product8.jpg" alt="Product 8">
									</div>
									<div class="card-body pt-2">
										<h4 class="mb-1 fw-bold">Ngopi</h4>
										<p class="text-muted small mb-2">Last updated: Yesterday 3:12 AM</p>
										<div class="avatar-group">
											<div class="avatar avatar-sm">
												<img src="<?php echo $ASSETS_URL; ?>assets/img/jm_denis.jpg" alt="..." class="avatar-img rounded-circle border border-white">
											</div>
											<div class="avatar avatar-sm">
												<img src="<?php echo $ASSETS_URL; ?>assets/img/chadengle.jpg" alt="..." class="avatar-img rounded-circle border border-white">
											</div>
											<div class="avatar avatar-sm">
												<img src="<?php echo $ASSETS_URL; ?>assets/img/mlane.jpg" alt="..." class="avatar-img rounded-circle border border-white">
											</div>
											<div class="avatar avatar-sm">
												<img src="<?php echo $ASSETS_URL; ?>assets/img/talha.jpg" alt="..." class="avatar-img rounded-circle border border-white">
											</div>
											<div class="avatar avatar-sm">
												<span class="avatar-title rounded-circle border border-white bg-success">+</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-lg-3">
								<div class="card">
									<div class="p-2">
										<img class="card-img-top rounded" src="<?php echo $ASSETS_URL; ?>assets/img/examples/product2.jpg" alt="Product 2">
									</div>
									<div class="card-body pt-2">
										<h4 class="mb-1 fw-bold">Travelling</h4>
										<p class="text-muted small mb-2">Last updated: Friday 7:45 AM</p>
										<div class="avatar-group">
											<div class="avatar avatar-sm">
												<img src="<?php echo $ASSETS_URL; ?>assets/img/jm_denis.jpg" alt="..." class="avatar-img rounded-circle border border-white">
											</div>
											<div class="avatar avatar-sm">
												<img src="<?php echo $ASSETS_URL; ?>assets/img/chadengle.jpg" alt="..." class="avatar-img rounded-circle border border-white">
											</div>
											<div class="avatar avatar-sm">
												<img src="<?php echo $ASSETS_URL; ?>assets/img/mlane.jpg" alt="..." class="avatar-img rounded-circle border border-white">
											</div>
											<div class="avatar avatar-sm">
												<img src="<?php echo $ASSETS_URL; ?>assets/img/talha.jpg" alt="..." class="avatar-img rounded-circle border border-white">
											</div>
											<div class="avatar avatar-sm">
												<span class="avatar-title rounded-circle border border-white bg-success">+</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<footer class="footer">
			<div class="container">
				<nav class="pull-left">
					<ul class="nav">
						<li class="nav-item">
							<a class="nav-link" href="http://www.themekita.com">
								ThemeKita
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">
								Help
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">
								Licenses
							</a>
						</li>
					</ul>
				</nav>
				<div class="copyright ml-auto">
					2018, made with <i class="fa fa-heart heart text-danger"></i> by <a href="http://www.themekita.com">ThemeKita</a>
				</div>				
			</div>
		</footer>
		<div class="quick-sidebar">
			<a href="#" class="close-quick-sidebar">
				<i class="flaticon-cross"></i>
			</a>
			<div class="quick-sidebar-wrapper">
				<ul class="nav nav-tabs nav-line nav-color-secondary" role="tablist">
					<li class="nav-item"> <a class="nav-link active show" data-toggle="tab" href="#messages" role="tab" aria-selected="true">Messages</a> </li>
					<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tasks" role="tab" aria-selected="false">Tasks</a> </li>
					<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab" aria-selected="false">Settings</a> </li>
				</ul>
				<div class="tab-content mt-3">
					<div class="tab-chat tab-pane fade show active" id="messages" role="tabpanel">
						<div class="messages-contact">
							<div class="quick-wrapper">
								<div class="scroll-wrapper quick-scroll scrollbar-outer" style="position: relative;"><div class="quick-scroll scrollbar-outer scroll-content scroll-scrolly_visible" style="height: auto; margin-bottom: 0px; margin-right: 0px; max-height: 133px;">
									<div class="quick-content contact-content">
										<span class="category-title mt-0">Contacts</span>
										<div class="avatar-group">
											<div class="avatar">
												<img src="<?php echo $ASSETS_URL; ?>assets/img/jm_denis.jpg" alt="..." class="avatar-img rounded-circle border border-white">
											</div>
											<div class="avatar">
												<img src="<?php echo $ASSETS_URL; ?>assets/img/chadengle.jpg" alt="..." class="avatar-img rounded-circle border border-white">
											</div>
											<div class="avatar">
												<img src="<?php echo $ASSETS_URL; ?>assets/img/mlane.jpg" alt="..." class="avatar-img rounded-circle border border-white">
											</div>
											<div class="avatar">
												<img src="<?php echo $ASSETS_URL; ?>assets/img/talha.jpg" alt="..." class="avatar-img rounded-circle border border-white">
											</div>
											<div class="avatar">
												<span class="avatar-title rounded-circle border border-white bg-success">+</span>
											</div>
										</div>
										<span class="category-title">Recent</span>
										<div class="contact-list contact-list-recent">
											<div class="user">
												<a href="#">
													<div class="avatar avatar-online">
														<img src="<?php echo $ASSETS_URL; ?>assets/img/jm_denis.jpg" alt="..." class="avatar-img rounded-circle border border-white">
													</div>
													<div class="user-data">
														<span class="name">Jimmy Denis</span>
														<span class="message">How are you ?</span>
													</div>
												</a>
											</div>
											<div class="user">
												<a href="#">
													<div class="avatar avatar-offline">
														<img src="<?php echo $ASSETS_URL; ?>assets/img/chadengle.jpg" alt="..." class="avatar-img rounded-circle border border-white">
													</div>
													<div class="user-data">
														<span class="name">Chad</span>
														<span class="message">Ok, Thanks !</span>
													</div>
												</a>
											</div>
											<div class="user">
												<a href="#">
													<div class="avatar avatar-offline">
														<img src="<?php echo $ASSETS_URL; ?>assets/img/mlane.jpg" alt="..." class="avatar-img rounded-circle border border-white">
													</div>
													<div class="user-data">
														<span class="name">John Doe</span>
														<span class="message">Ready for the meeting today with...</span>
													</div>
												</a>
											</div>
										</div>
										<span class="category-title">Other Contacts</span>
										<div class="contact-list">
											<div class="user">
												<a href="#">
													<div class="avatar avatar-online">
														<img src="<?php echo $ASSETS_URL; ?>assets/img/jm_denis.jpg" alt="..." class="avatar-img rounded-circle border border-white">
													</div>
													<div class="user-data2">
														<span class="name">Jimmy Denis</span>
														<span class="status">Online</span>
													</div>
												</a>
											</div>
											<div class="user">
												<a href="#">
													<div class="avatar avatar-offline">
														<img src="<?php echo $ASSETS_URL; ?>assets/img/chadengle.jpg" alt="..." class="avatar-img rounded-circle border border-white">
													</div>
													<div class="user-data2">
														<span class="name">Chad</span>
														<span class="status">Active 2h ago</span>
													</div>
												</a>
											</div>
											<div class="user">
												<a href="#">
													<div class="avatar avatar-away">
														<img src="<?php echo $ASSETS_URL; ?>assets/img/talha.jpg" alt="..." class="avatar-img rounded-circle border border-white">
													</div>
													<div class="user-data2">
														<span class="name">Talha</span>
														<span class="status">Away</span>
													</div>
												</a>
											</div>
										</div>
									</div>
								</div><div class="scroll-element scroll-x scroll-scrolly_visible"><div class="scroll-element_outer"><div class="scroll-element_size"></div><div class="scroll-element_track"></div><div class="scroll-bar ui-draggable ui-draggable-handle" style="width: 86px;"></div></div></div><div class="scroll-element scroll-y scroll-scrolly_visible"><div class="scroll-element_outer"><div class="scroll-element_size"></div><div class="scroll-element_track"></div><div class="scroll-bar ui-draggable ui-draggable-handle" style="height: 25px; top: 0px;"></div></div></div></div>
							</div>
						</div>
						<div class="messages-wrapper">
							<div class="messages-title">
								<div class="user">
									<div class="avatar avatar-offline float-right ml-2">
										<img src="<?php echo $ASSETS_URL; ?>assets/img/chadengle.jpg" alt="..." class="avatar-img rounded-circle border border-white">
									</div>
									<span class="name">Chad</span>
									<span class="last-active">Active 2h ago</span>
								</div>
								<button class="return">
									<i class="flaticon-left-arrow-3"></i>
								</button>
							</div>
							<div class="scroll-wrapper messages-body messages-scroll scrollbar-outer" style="position: relative;"><div class="messages-body messages-scroll scrollbar-outer scroll-content scroll-scrolly_visible" style="height: auto; margin-bottom: 0px; margin-right: 0px; max-height: 0px;">
								<div class="message-content-wrapper">
									<div class="message message-in">
										<div class="avatar avatar-sm">
											<img src="<?php echo $ASSETS_URL; ?>assets/img/chadengle.jpg" alt="..." class="avatar-img rounded-circle border border-white">
										</div>
										<div class="message-body">
											<div class="message-content">
												<div class="name">Chad</div>
												<div class="content">Hello, Rian</div>
											</div>
											<div class="date">12.31</div>
										</div>
									</div>
								</div>
								<div class="message-content-wrapper">
									<div class="message message-out">
										<div class="message-body">
											<div class="message-content">
												<div class="content">
													Hello, Chad
												</div>
											</div>
											<div class="message-content">
												<div class="content">
													What's up?
												</div>
											</div>
											<div class="date">12.35</div>
										</div>
									</div>
								</div>
								<div class="message-content-wrapper">
									<div class="message message-in">
										<div class="avatar avatar-sm">
											<img src="<?php echo $ASSETS_URL; ?>assets/img/chadengle.jpg" alt="..." class="avatar-img rounded-circle border border-white">
										</div>
										<div class="message-body">
											<div class="message-content">
												<div class="name">Chad</div>
												<div class="content">
													Thanks
												</div>
											</div>
											<div class="message-content">
												<div class="content">
													When is the deadline of the project we are working on ?
												</div>
											</div>
											<div class="date">13.00</div>
										</div>
									</div>
								</div>
								<div class="message-content-wrapper">
									<div class="message message-out">
										<div class="message-body">
											<div class="message-content">
												<div class="content">
													The deadline is about 2 months away
												</div>
											</div>
											<div class="date">13.10</div>
										</div>
									</div>
								</div>
								<div class="message-content-wrapper">
									<div class="message message-in">
										<div class="avatar avatar-sm">
											<img src="<?php echo $ASSETS_URL; ?>assets/img/chadengle.jpg" alt="..." class="avatar-img rounded-circle border border-white">
										</div>
										<div class="message-body">
											<div class="message-content">
												<div class="name">Chad</div>
												<div class="content">
													Ok, Thanks !
												</div>
											</div>
											<div class="date">13.15</div>
										</div>
									</div>
								</div>
							</div><div class="scroll-element scroll-x scroll-scrolly_visible"><div class="scroll-element_outer"><div class="scroll-element_size"></div><div class="scroll-element_track"></div><div class="scroll-bar ui-draggable ui-draggable-handle" style="width: 86px;"></div></div></div><div class="scroll-element scroll-y scroll-scrolly_visible"><div class="scroll-element_outer"><div class="scroll-element_size"></div><div class="scroll-element_track"></div><div class="scroll-bar ui-draggable ui-draggable-handle" style="height: 0px; top: 0px;"></div></div></div></div>
							<div class="messages-form">
								<div class="messages-form-control">
									<input type="text" placeholder="Type here" class="form-control input-pill input-solid message-input">
								</div>
								<div class="messages-form-tool">
									<a href="#" class="attachment">
										<i class="flaticon-file"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="tasks" role="tabpanel">
						<div class="quick-wrapper tasks-wrapper">
							<div class="scroll-wrapper tasks-scroll scrollbar-outer" style="position: relative;"><div class="tasks-scroll scrollbar-outer scroll-content" style="height: 571px; margin-bottom: 0px; margin-right: 0px; max-height: none;">
								<div class="tasks-content">
									<span class="category-title mt-0">Today</span>
									<ul class="tasks-list">
										<li>
											<label class="custom-checkbox custom-control checkbox-secondary">
												<input type="checkbox" checked="" class="custom-control-input"><span class="custom-control-label">Planning new project structure</span>
												<span class="task-action">
													<a href="#" class="link text-danger">
														<i class="flaticon-interface-5"></i>
													</a>
												</span>
											</label>
										</li>
										<li>
											<label class="custom-checkbox custom-control checkbox-secondary">
												<input type="checkbox" class="custom-control-input"><span class="custom-control-label">Create the main structure							</span>
												<span class="task-action">
													<a href="#" class="link text-danger">
														<i class="flaticon-interface-5"></i>
													</a>
												</span>
											</label>
										</li>
										<li>
											<label class="custom-checkbox custom-control checkbox-secondary">
												<input type="checkbox" class="custom-control-input"><span class="custom-control-label">Add new Post</span>
												<span class="task-action">
													<a href="#" class="link text-danger">
														<i class="flaticon-interface-5"></i>
													</a>
												</span>
											</label>
										</li>
										<li>
											<label class="custom-checkbox custom-control checkbox-secondary">
												<input type="checkbox" class="custom-control-input"><span class="custom-control-label">Finalise the design proposal</span>
												<span class="task-action">
													<a href="#" class="link text-danger">
														<i class="flaticon-interface-5"></i>
													</a>
												</span>
											</label>
										</li>
									</ul>

									<span class="category-title">Tomorrow</span>
									<ul class="tasks-list">
										<li>
											<label class="custom-checkbox custom-control checkbox-secondary">
												<input type="checkbox" class="custom-control-input"><span class="custom-control-label">Initialize the project							</span>
												<span class="task-action">
													<a href="#" class="link text-danger">
														<i class="flaticon-interface-5"></i>
													</a>
												</span>
											</label>
										</li>
										<li>
											<label class="custom-checkbox custom-control checkbox-secondary">
												<input type="checkbox" class="custom-control-input"><span class="custom-control-label">Create the main structure							</span>
												<span class="task-action">
													<a href="#" class="link text-danger">
														<i class="flaticon-interface-5"></i>
													</a>
												</span>
											</label>
										</li>
										<li>
											<label class="custom-checkbox custom-control checkbox-secondary">
												<input type="checkbox" class="custom-control-input"><span class="custom-control-label">Updates changes to GitHub							</span>
												<span class="task-action">
													<a href="#" class="link text-danger">
														<i class="flaticon-interface-5"></i>
													</a>
												</span>
											</label>
										</li>
										<li>
											<label class="custom-checkbox custom-control checkbox-secondary">
												<input type="checkbox" class="custom-control-input"><span title="This task is too long to be displayed in a normal space!" class="custom-control-label">This task is too long to be displayed in a normal space!				</span>
												<span class="task-action">
													<a href="#" class="link text-danger">
														<i class="flaticon-interface-5"></i>
													</a>
												</span>
											</label>
										</li>
									</ul>

									<div class="mt-3">
										<div class="btn btn-primary btn-rounded btn-sm">
											<span class="btn-label">
												<i class="fa fa-plus"></i>
											</span>
											Add Task
										</div>
									</div>
								</div>
							</div><div class="scroll-element scroll-x"><div class="scroll-element_outer"><div class="scroll-element_size"></div><div class="scroll-element_track"></div><div class="scroll-bar ui-draggable ui-draggable-handle"></div></div></div><div class="scroll-element scroll-y"><div class="scroll-element_outer"><div class="scroll-element_size"></div><div class="scroll-element_track"></div><div class="scroll-bar ui-draggable ui-draggable-handle"></div></div></div></div>
						</div>
					</div>
					<div class="tab-pane fade" id="settings" role="tabpanel">
						<div class="quick-wrapper settings-wrapper">
							<div class="scroll-wrapper quick-scroll scrollbar-outer" style="position: relative;"><div class="quick-scroll scrollbar-outer scroll-content" style="height: 586px; margin-bottom: 0px; margin-right: 0px; max-height: none;">
								<div class="quick-content settings-content">

									<span class="category-title mt-0">General Settings</span>
									<ul class="settings-list">
										<li>
											<span class="item-label">Enable Notifications</span>
											<div class="item-control">
												<div class="toggle btn btn-primary btn-round" data-toggle="toggle" style="width: 0px; height: 0px;"><input type="checkbox" checked="" data-toggle="toggle" data-onstyle="primary" data-style="btn-round"><div class="toggle-group"><label class="btn btn-primary toggle-on">On</label><label class="btn btn-default active toggle-off">Off</label><span class="toggle-handle btn btn-default"></span></div></div>
											</div>
										</li>
										<li>
											<span class="item-label">Signin with social media</span>
											<div class="item-control">
												<div class="toggle btn btn-default off btn-round" data-toggle="toggle" style="width: 0px; height: 0px;"><input type="checkbox" data-toggle="toggle" data-onstyle="primary" data-style="btn-round"><div class="toggle-group"><label class="btn btn-primary toggle-on">On</label><label class="btn btn-default active toggle-off">Off</label><span class="toggle-handle btn btn-default"></span></div></div>
											</div>
										</li>
										<li>
											<span class="item-label">Backup storage</span>
											<div class="item-control">
												<div class="toggle btn btn-default off btn-round" data-toggle="toggle" style="width: 0px; height: 0px;"><input type="checkbox" data-toggle="toggle" data-onstyle="primary" data-style="btn-round"><div class="toggle-group"><label class="btn btn-primary toggle-on">On</label><label class="btn btn-default active toggle-off">Off</label><span class="toggle-handle btn btn-default"></span></div></div>
											</div>
										</li>
										<li>
											<span class="item-label">SMS Alert</span>
											<div class="item-control">
												<div class="toggle btn btn-primary btn-round" data-toggle="toggle" style="width: 0px; height: 0px;"><input type="checkbox" checked="" data-toggle="toggle" data-onstyle="primary" data-style="btn-round"><div class="toggle-group"><label class="btn btn-primary toggle-on">On</label><label class="btn btn-default active toggle-off">Off</label><span class="toggle-handle btn btn-default"></span></div></div>
											</div>
										</li>
									</ul>

									<span class="category-title mt-0">Notifications</span>
									<ul class="settings-list">
										<li>
											<span class="item-label">Email Notifications</span>
											<div class="item-control">
												<div class="toggle btn btn-primary btn-round" data-toggle="toggle" style="width: 0px; height: 0px;"><input type="checkbox" checked="" data-toggle="toggle" data-onstyle="primary" data-style="btn-round"><div class="toggle-group"><label class="btn btn-primary toggle-on">On</label><label class="btn btn-default active toggle-off">Off</label><span class="toggle-handle btn btn-default"></span></div></div>
											</div>
										</li>
										<li>
											<span class="item-label">New Comments</span>
											<div class="item-control">
												<div class="toggle btn btn-primary btn-round" data-toggle="toggle" style="width: 0px; height: 0px;"><input type="checkbox" checked="" data-toggle="toggle" data-onstyle="primary" data-style="btn-round"><div class="toggle-group"><label class="btn btn-primary toggle-on">On</label><label class="btn btn-default active toggle-off">Off</label><span class="toggle-handle btn btn-default"></span></div></div>
											</div>
										</li>
										<li>
											<span class="item-label">Chat Messages</span>
											<div class="item-control">
												<div class="toggle btn btn-primary btn-round" data-toggle="toggle" style="width: 0px; height: 0px;"><input type="checkbox" checked="" data-toggle="toggle" data-onstyle="primary" data-style="btn-round"><div class="toggle-group"><label class="btn btn-primary toggle-on">On</label><label class="btn btn-default active toggle-off">Off</label><span class="toggle-handle btn btn-default"></span></div></div>
											</div>
										</li>
										<li>
											<span class="item-label">Project Updates</span>
											<div class="item-control">
												<div class="toggle btn btn-default off btn-round" data-toggle="toggle" style="width: 0px; height: 0px;"><input type="checkbox" data-toggle="toggle" data-onstyle="primary" data-style="btn-round"><div class="toggle-group"><label class="btn btn-primary toggle-on">On</label><label class="btn btn-default active toggle-off">Off</label><span class="toggle-handle btn btn-default"></span></div></div>
											</div>
										</li>
										<li>
											<span class="item-label">New Tasks</span>
											<div class="item-control">
												<div class="toggle btn btn-primary btn-round" data-toggle="toggle" style="width: 0px; height: 0px;"><input type="checkbox" checked="" data-toggle="toggle" data-onstyle="primary" data-style="btn-round"><div class="toggle-group"><label class="btn btn-primary toggle-on">On</label><label class="btn btn-default active toggle-off">Off</label><span class="toggle-handle btn btn-default"></span></div></div>
											</div>
										</li>
									</ul>
								</div>
							</div><div class="scroll-element scroll-x"><div class="scroll-element_outer"><div class="scroll-element_size"></div><div class="scroll-element_track"></div><div class="scroll-bar ui-draggable ui-draggable-handle"></div></div></div><div class="scroll-element scroll-y"><div class="scroll-element_outer"><div class="scroll-element_size"></div><div class="scroll-element_track"></div><div class="scroll-bar ui-draggable ui-draggable-handle"></div></div></div></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</body>
</html>