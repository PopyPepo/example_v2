<html ng-app="myApp">
<head>
	<meta charset="utf-8">

	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>Dashboard Generate</title>

	<link href="style.css" rel="stylesheet">
	<script src="../plugin/angular.min.js"></script>
	<script src="../plugin/jquery.min.js"></script>
	<script>angular.module("myApp", []);</script>
	<script src="generater.js"></script>
	<style type="text/css">
		.no-skin .nav-list>li>a {
			white-space: nowrap;
			text-overflow: ellipsis;
			overflow: hidden;
		}
		body{max-width: 1440px;}
	</style>
</head>
<body class="no-skin" ng-controller="generateAll">


	<div style="width: 20%;margin-top: 50px;float: left;">
		<fieldset class="">
			<legend style="margin: 0;">
				<img src="../assets/image/icon/004-bookmarks.svg" height="24">  <input type="text" placeholder="Search ..." ng-model="findTable" autocomplete="off">
			</legend>
			<nav>
				<ul style="margin: 0;">
					<li ng-repeat="table in tableList | filter: findTable" class="">
						<a href="javascript:0;" ng-click="setTable(table);" title='{{ table.TABLE_COMMENT ? table.TABLE_NAME+" ("+table.TABLE_COMMENT+")" : table.TABLE_NAME }}'>
							 {{table.TABLE_NAME}} {{ table.TABLE_COMMENT ? " ("+table.TABLE_COMMENT+")" : "" }}
						</a>
					</li>
				</ul>
			</nav>
		</fieldset>
	</div>

	<div style="width: 80%;margin-top: 50px;float: left;" ng-show="tableInstance">
		<fieldset class="">
			<legend style="margin: 0;">
				{{ tableInstance.TABLE_COMMENT ? tableInstance.TABLE_COMMENT : tableInstance.TABLE_NAME }}
				<small>{{ tableInstance.TABLE_NAME }}</small>
			</legend>
			

			<center ng-show="!foderInstance">
				<button ng-click="createForder(tableInstance);">สร้างโฟลเดอร์ 
					{{ tableInstance.TABLE_NAME }} {{ tableInstance.TABLE_COMMENT ? " ("+tableInstance.TABLE_COMMENT+")" : "" }}
				</button>
			</center>



			<table border="1" width="100%" ng-show="foderInstance">
				<thead class="text-danger">
					<th>Function</th>
					<th>Filename</th>
					<th>Path</th>
					<th class="text-center"><i class="material-icons">settings</i></th>
					<!-- <th>Salary</th> -->
				</thead>
				<tbody>

					<tr ng-repeat="fileInstance in functioninstance" onmouseover="this.style.background='antiquewhite';" onmouseout="this.style.background='none';"> 
						<td>{{ fileInstance.path }} {{ fileInstance.file }} 
							{{ tableInstance.TABLE_COMMENT ? tableInstance.TABLE_COMMENT : tableInstance.TABLE_NAME }}
							{{ fileInstance.suc }}
						</td>
						<td>{{ fileInstance.file ? tableInstance.TABLE_NAME+fileInstance.file : 'index.php' }}</td>
						<td>

							{ROOT_PROJECT} / app / {{ tableInstance.TABLE_NAME }} / {{ fileInstance.path }} 
							/ {{ fileInstance.file ? tableInstance.TABLE_NAME+fileInstance.file : (fileInstance.path=='i18n' ? 'massages.json' : 'index.php') }}

							<!-- {{ fileInstance.path=='controller' ? tableInstance.TABLE_NAME+fileInstance.file : tableInstance.TABLE_NAME+'/'+(fileInstance.file ? tableInstance.TABLE_NAME+fileInstance.file : 'index.php') }} -->
						</td>
						<td align="center">
							<button class="btn btn-info btn-xs" ng-click="createFile(tableInstance, fileInstance);setTable(tableInstance);">
								Genedate File
							</button>
						</td>
					</tr>

					<!-- <tr ng-repeat="fileInstance in foderInstance">
						<td>{{ fileInstance }}</td>
						<td>{{ fileInstance.file }}</td>
						<td>{{ '{ROOT_PROJECT}/view/'+tableInstance.TABLE_NAME+'/'+fileInstance }}</td>
						<td class="text-center">Oud-Turnhout</td>
					</tr> -->

					<!-- <tr>
						<td>
							<div class="form-group label-floating">
								<label class="control-label">Function</label>
								<select class="form-control" ng-model="filename" ng-options="value.name for value in functioninstance"></select>
							</div>
						</td>
						<td>
							<div class="form-group label-floating">
								<label class="control-label">
									{{ filename.name ? filename.name : 'File name'}}
									{{ filename.file ? ' > '+filename.file : ''}}
								</label>
								<input type="text" ng-model="filename.file" class="form-control">
							</div>
						</td>
						<td>{{ 'ROOT_PROJECT/view/'+tableInstance.TABLE_NAME+'/'+filename.file }}</td>
						<td class="text-center">
							<button class="btn btn-primary btn-sm">Genedate File</button>
						</td>
					</tr> -->
				</tbody>
			</table>

		</fieldset>
	</div>
<!-- <div id="loader-wrapper">
	
	<div id="loader"></div>
	<div class="loader-section section-left"></div>
	<div class="loader-section section-right"></div>
</div><script type="text/javascript">preload(true);</script> -->
	<?php /*
	<div id="navbar" class="navbar navbar-default ace-save-state">
		<div class="navbar-container ace-save-state" id="navbar-container">
			<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
				<span class="sr-only">Toggle sidebar</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

			<div class="navbar-header pull-left">
				<a href="../" class="navbar-brand">
					<small>
						<i class="fa fa-leaf"></i>
						Code Generate
					</small>
				</a>
			</div>

			<?php //include("view/Layout/user-toobar.php"); ?>

		</div><!-- /.navbar-container -->
	</div>

	<div class="main-container ace-save-state" id="main-container">
		<script type="text/javascript">
			try{ace.settings.loadState('main-container')}catch(e){}
		</script>

		
		<div id="sidebar" class="sidebar responsive ace-save-state">
			<script type="text/javascript">
				try{ace.settings.loadState('sidebar')}catch(e){}
			</script>

			<!-- <div class="sidebar-shortcuts" id="sidebar-shortcuts">
				<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
					<button class="btn btn-success btn-white">
						<i class="ace-icon fa fa-signal"></i>
					</button>

					<button class="btn btn-info btn-white">
						<i class="ace-icon fa fa-pencil"></i>
					</button>

					<button class="btn btn-warning btn-white">
						<i class="ace-icon fa fa-users"></i>
					</button>

					<button class="btn btn-danger btn-white">
						<i class="ace-icon fa fa-cogs"></i>
					</button>
				</div> 

				<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
					<span class="btn btn-success"></span>

					<span class="btn btn-info"></span>

					<span class="btn btn-warning"></span>

					<span class="btn btn-danger"></span>
				</div>
			</div>--><!-- /.sidebar-shortcuts -->

			<ul class="nav nav-list">
				<li class="">
					<form class="form-search">
						<span class="input-icon">
							<input type="text" placeholder="Search ..." ng-model="findTable" class="nav-search-input"  autocomplete="off">
							<i class="ace-icon fa fa-search nav-search-icon"></i>
						</span>
					</form>
				</li>
				<li ng-repeat="table in tableList | filter: findTable" class="">
					<a href="javascript:0;" ng-click="setTable(table);" title='{{ table.TABLE_COMMENT ? table.TABLE_NAME+" ("+table.TABLE_COMMENT+")" : table.TABLE_NAME }}'>
						<i class="menu-icon fa fa-list"></i>
						<span class="menu-text"> {{ table.TABLE_COMMENT ? table.TABLE_NAME+" ("+table.TABLE_COMMENT+")" : table.TABLE_NAME }} </span>
					</a>

					<b class="arrow"></b>
				</li>

			</ul><!-- /.nav-list -->

			<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
				<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
			</div>
		</div>

		<div class="main-content">
			<div class="main-content-inner">

				<div class="page-content">

					<div class="row" ng-show="tableInstance">
						<div class="col-md-12">

							<div class="widget-box transparent ui-sortable-handle" id="widget-box-12">
								<div class="widget-header">
									<h4 class="widget-title lighter">{{ tableInstance.TABLE_COMMENT ? tableInstance.TABLE_COMMENT : tableInstance.TABLE_NAME }}
										<small>{{ tableInstance.TABLE_NAME }}</small>
									</h4>
								</div>

								<div class="widget-body">
									<div class="widget-main table-responsive">
										<pre>{{ foderInstance }}</pre>
										<center ng-show="!foderInstance">
											<button ng-click="createForder(tableInstance);" class="btn btn-primary btn-round">สร้างโฟลเดอร์ 
												{{ tableInstance.TABLE_COMMENT ? tableInstance.TABLE_COMMENT : tableInstance.TABLE_NAME }}
											</button>
										</center>

										<table class="table" ng-show="foderInstance">
											<thead class="text-danger">
												<th>Function</th>
												<th>Filename</th>
												<th>Path</th>
												<th class="text-center"><i class="material-icons">settings</i></th>
												<!-- <th>Salary</th> -->
											</thead>
											<tbody>

												<tr ng-repeat="fileInstance in functioninstance">
													<td>{{ fileInstance.name }}</td>
													<td>{{ fileInstance.file }}{{ fileInstance.type=='taglib' ? '.js' : '.php'}}</td>
													<td>{ROOT_PROJECT}/{{ fileInstance.type=='view' ? 'view/'+tableInstance.TABLE_NAME : fileInstance.type }}/{{fileInstance.file }}{{ fileInstance.type=='taglib' ? '.js' : '.php'}}
													</td>
													<td class="text-center">
														<button class="btn btn-info btn-xs" ng-disabled="!(foderInstance.indexOf(fileInstance.file+(fileInstance.type=='taglib' ? '.js' : '.php'))===-1)"
															ng-click="createFile(tableInstance, fileInstance);setTable(tableInstance);">
															Genedate File
														</button>
													</td>
												</tr>

												<!-- <tr ng-repeat="fileInstance in foderInstance">
													<td>{{ fileInstance }}</td>
													<td>{{ fileInstance.file }}</td>
													<td>{{ '{ROOT_PROJECT}/view/'+tableInstance.TABLE_NAME+'/'+fileInstance }}</td>
													<td class="text-center">Oud-Turnhout</td>
												</tr> -->

												<!-- <tr>
													<td>
														<div class="form-group label-floating">
															<label class="control-label">Function</label>
															<select class="form-control" ng-model="filename" ng-options="value.name for value in functioninstance"></select>
														</div>
													</td>
													<td>
														<div class="form-group label-floating">
															<label class="control-label">
																{{ filename.name ? filename.name : 'File name'}}
																{{ filename.file ? ' > '+filename.file : ''}}
															</label>
															<input type="text" ng-model="filename.file" class="form-control">
														</div>
													</td>
													<td>{{ 'ROOT_PROJECT/view/'+tableInstance.TABLE_NAME+'/'+filename.file }}</td>
													<td class="text-center">
														<button class="btn btn-primary btn-sm">Genedate File</button>
													</td>
												</tr> -->
											</tbody>
										</table>
									</div>
								</div>
							</div>
							
							

						</div>
					</div>


				</div><!-- /.page-content -->
			</div>
		</div><!-- /.main-content -->

		<div class="footer">
			<div class="footer-inner">
				<div class="footer-content">
					<span class="bigger-120">
						<span class="blue bolder">Ace</span>
						Application &copy; 2013-2014
					</span>

					&nbsp; &nbsp;
					<span class="action-buttons">
						<a href="#">
							<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
						</a>

						<a href="#">
							<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
						</a>

						<a href="#">
							<i class="ace-icon fa fa-rss-square orange bigger-150"></i>
						</a>
					</span>
				</div>
			</div>
		</div>

		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
			<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
		</a>
	</div><!-- /.main-container --> */?>
</body>
</html>
