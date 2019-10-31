<?php 
// ob_start();
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// date_default_timezone_set('Asia/Bangkok');
// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
// include_once("../connect.php");

// $file = isset($_GET['file']) ? $_GET['file'] : 'list';
// $table = isset($_GET['table']) ? $_GET['table'] : 'member';
/*-------------------------------------------------------------------------*/
$DEFAULT_Template = '';

$i = 1;
$colIndex = array();
$id = array();
$sqlS = "SHOW INDEX FROM ".$table." WHERE TABLE_SCHEMA='".$database."'";
$excuteS = mysqli_query($conn, $sqlS);
while ($instancS = mysqli_fetch_object($excuteS)){
	//print_r($instancS);
	if (isset($instancS->Column_name)){$colIndex[] = $instancS->Column_name;}
	if ($instancS->Key_name=='PRIMARY' && !$id){$id = $instancS;}
}

$sql = "SHOW FULL COLUMNS FROM ".$table." WHERE Extra!='auto_increment' ";
$excute = mysqli_query($conn, $sql);

$tableSql = "SELECT * FROM information_schema.TABLES WHERE TABLE_NAME='".$table."' AND TABLE_SCHEMA='".$database."'";
$tableexcute = mysqli_query($conn, $tableSql);
$tableInstanc = mysqli_fetch_object($tableexcute);


$title = $tableInstanc->TABLE_COMMENT ? $tableInstanc->TABLE_COMMENT : $tableInstanc->TABLE_NAME;
$subtitle = $tableInstanc->TABLE_NAME;
$html = "";
$boxF = '
<script src="<?php echo $ASSETS_URL; ?>taglib/'.$table.'Controller.js"></script>
<div class="row" ng-controller="'.$table.'Controller">
	<!-- <div class="col-md-10 col-md-offset-1"> -->
	<div class="col-md-12">
		<div class="widget-box transparent">

';
$content='';
$boxTitle='';
$boxL = '

		</div>
	</div>
</div>

';

/*$nav = '
				<ul class="nav nav-pills nav-pills-info navbar-right"> 
					<li><a href="<?php echo $LINK_URL; ?>'.$DEFAULT_Template.''.$table.'/list/"> รายการข้อมูล'.$title.'</a></li> 
					<li><a href="<?php echo $LINK_URL; ?>'.$DEFAULT_Template.''.$table.'/create/">เพิ่มข้อมูล '.$title.'</a></li>
				</ul>
';*/
$nav = '
				<div class="widget-toolbar no-border">
					<a class="btn btn-xs btn-yellow" href="<?php echo $LINK_URL; ?>'.$DEFAULT_Template.''.$table.'/list/">
						<i class="ace-icon fa fa-list"></i>
						รายการข้อมูล '.$title.'
					</a>

					<a class="btn btn-xs btn-info" href="<?php echo $LINK_URL; ?>'.$DEFAULT_Template.''.$table.'/create/">
						<i class="ace-icon fa fa-plus-circle"></i>
						เพิ่มข้อมูล '.$title.'
					</a>
				</div>
';
switch ($file) {
	case 'list':
		$boxTitle.='
			<div class="widget-header" ng-init="DOMAIN.title=\'รายการข้อมูล '.$title.'\'">
				<h4 class="widget-title lighter">{{DOMAIN.title}}
					<small>'.$subtitle.'</small>
				</h4>
				'.$nav.'
			</div>

';
		$content.='	<div class="widget-body table-responsive" ng-init="list();"><div class="widget-main">
				<table class="table table-striped table-bordered table-hover">

					<thead class="text-info">
						<tr>
							<th class="text-center">#</th>';
		while ($instanc = mysqli_fetch_object($excute)){
			$content.='
							<th>'.($instanc->Comment ? $instanc->Comment : $instanc->Field).'</th>';
			if ($i>=5) break;
			$i++;
		}
		$content.='			
							<th class="text-center"><i class="material-icons">settings</i></th>
						</tr>
					</thead>

					<tbody>
						<tr dir-paginate="'.$table.'Ins in '.$table.'InstanceList | filter:search | itemsPerPage: 10">
							<td class="text-center">{{ '.$table.'Ins.'.$id->Column_name.' }}</td>';
		$i=1;
		$excute = mysqli_query($conn, $sql);
		while ($instanc = mysqli_fetch_object($excute)){
			$content.='
							<td>
								<a href="<?php echo $LINK_URL; ?>'.$DEFAULT_Template.''.$table.'/show/{{ '.$table.'Ins.'.$id->Column_name.' }}/">
									{{ '.$table.'Ins.'.$instanc->Field.' }}
								</a>
							</td>';
			if ($i>=5) break;
			$i++;
		}
		$content.='
							<td class="text-center"><a href="<?php echo $LINK_URL; ?>'.$DEFAULT_Template.''.$table.'/show/{{ '.$table.'Ins.'.$id->Column_name.' }}/">แสดงข้อมูล</a></td>
						</tr>
					</tbody>

				</table>
				<dir-pagination-controls></dir-pagination-controls>
			</div></div>
';
	break;

	case '_form':
		
		$inputHidden = array();
		while ($instanc = mysqli_fetch_object($excute)){
			
			if (in_array($instanc->Field, $colIndex)){
				$inputHidden[] = $instanc;
			}else{
				$input = getInput($instanc, $table);
				$span = $instanc->Null=='NO' ? ' <span class="red">*</span>' : '';
				$content.='
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="'.$instanc->Field.'">'.($instanc->Comment ? $instanc->Comment : $instanc->Field).' '.$span.'</label>
	'.$input.'
</div>
';

			}
		}

		foreach ($inputHidden as $value) {
			$content.= '
<input type="hidden" class="form-control" id="'.$value->Field.'" name="'.$value->Field.'" ng-model="'.$table.'Instance.'.$value->Field.'">';
		}

	break;

	case 'show':
		$boxTitle.='
			<div class="widget-header" data-background-color="white" ng-init="DOMAIN.title=\'แสดงข้อมูล '.$title.'\'">
				<h4 class="widget-title lighter">{{DOMAIN.title}}
					<small>'.$subtitle.'</small>
				</h4>
				'.$nav.'
			</div>

';
		$content.='	<div class="widget-body table-responsive" ng-init="show(\'<?php echo $ID; ?>\');"><div class="widget-main">
				<div class="profile-user-info profile-user-info-striped">
';
		while ($instanc = mysqli_fetch_object($excute)){
			if ($id->Column_name!=$instanc->Field){
			// if (!in_array($instanc->Field, $colIndex)){
				$label = $instanc->Comment ? $instanc->Comment : $instanc->Field;
				$content.='
						<div class="profile-info-row">
							<div class="profile-info-name">'.$label.'</div>
							<div class="profile-info-value">{{ '.$table.'Instance.'.$instanc->Field.' }}</div>
						</div>
';
			}
		}
				
		$content.='

				</div>
				<hr>
				<button type="button" class="btn btn-sm btn-danger pull-right" ng-confirm-click="Are you sure to delete this record?" confirmed-click="delete('.$table.'Instance.'.$id->Column_name.');"><i class="fas fa-trash-alt"></i>  ลบข้อมูล </button>

				<a href="<?php echo $LINK_URL; ?>'.$DEFAULT_Template.''.$table.'/edit/{{ '.$table.'Instance.'.$id->Column_name.' }}/" class="btn btn-sm btn-warning pull-right"><i class="far fa-edit"></i> แก้ไขข้อมูล<div class="ripple-container"></div></a>
				<div class="clearfix"></div>
			</div></div>
';
	break;

	case 'create':
		$boxTitle.='
			<div class="widget-header" data-background-color="white" ng-init="DOMAIN.title=\'เพิ่มข้อมูล '.$title.'\'">
				<h4 class="widget-title lighter">{{DOMAIN.title}}
					<small>'.$subtitle.'</small>
				</h4>
				'.$nav.'
			</div>

';
		$content.='	<div class="widget-body table-responsive"><div class="widget-main">
				<form class="form-horizontal" name="'.$table.'Create" method="post" enctype="multipart/form-data" ng-submit="save();">
				<!-- action="<?php //echo $LINK_URL; ?>'.$table.'/create/" -->

						<?php include("view/'.$table.'/_form.php"); ?>

						<button type="submit" class="btn btn-sm btn-success pull-right"><i class="fas fa-save"></i> บันทึกข้อมูล </button>
';
		
		$content.='
				</form>
			</div></div>
';
	break;

	case 'edit':
		$nav = '
				<div class="widget-toolbar no-border" ng-init="DOMAIN.title=\'แก้ไขข้อมูล '.$title.'\'">
					<a class="btn btn-xs btn-yellow" href="<?php echo $LINK_URL; ?>'.$DEFAULT_Template.''.$table.'/list/">
						<i class="ace-icon fa fa-list"></i>
						รายการข้อมูล '.$title.'
					</a>

					<a class="btn btn-xs btn-info" href="<?php echo $LINK_URL; ?>'.$DEFAULT_Template.''.$table.'/create/">
						<i class="ace-icon fa fa-plus-circle"></i>
						เพิ่มข้อมูล '.$title.'
					</a>

					<a class="btn btn-xs btn-inverse" href="<?php echo $LINK_URL; ?>'.$DEFAULT_Template.''.$table.'/show/{{ '.$table.'Instance.'.$id->Column_name.' }}/"><i class="fa fa-arrow-left" aria-hidden="true"></i> กลับไปหน้าแสดงข้อมูล '.$title.'
					</a>
				</div>
';
		$boxTitle.='
			<div class="widget-header" data-background-color="white" ng-init="DOMAIN.title=\'แก้ไขข้อมูล '.$title.'\'">
				<h4 class="widget-title lighter">รายการข้อมูล '.$title.'
					<small>'.$subtitle.'</small>
				</h4>
				'.$nav.'
			</div>

';
		$content.='	<div class="widget-body table-responsive" ng-init="show(\'<?php echo $ID; ?>\');"><div class="widget-main">
				<form class="form-horizontal" name="'.$table.'Edit" method="post" enctype="multipart/form-data" ng-submit="update('.$table.'Instance.'.$id->Column_name.');">
				<!-- action="<?php //echo $LINK_URL; ?>'.$table.'/edit/{{ '.$table.'Instance.'.$id->Column_name.' }}" -->

						<?php include("view/'.$table.'/_form.php"); ?>

						<button type="button" class="btn btn-sm btn-danger pull-right" ng-confirm-click="Are you sure to delete this record?" confirmed-click="delete('.$table.'Instance.'.$id->Column_name.');"><i class="fas fa-trash-alt"></i> ลบข้อมูล </button>

						<button type="submit" class="btn btn-sm btn-warning pull-right"><i class="fas fa-save"></i>  ปรับปรุงข้อมูล</button>
';
		
		$content.='
				</form>
			</div></div>
';
	break;


	case $table.'Controller':
		if ($type=='controller'){
			$content = '<?php 
include("../connect.php");
ob_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
date_default_timezone_set("Asia/Bangkok");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$action = isset($_GET["action"]) ? $_GET["action"] : null;
if (isset($_GET["action"])) unset($_GET["action"]);
$json = array();
$mass="";
$col = "";	$val = "";	$c="";


switch ($action) {
	// คิวรี่รายการข้อมูล '.$title.'
	case "list":
		$sql = "SELECT * FROM '.$table.'";
		$query = mysqli_query($conn, $sql);
		$json["instance"] = array();
		while ($instance=mysqli_fetch_assoc($query)) {
			// $instance[\'eventDateText\'] = thaiDate("j F Y H:i", strtotime($instance[\'eventDate\']));
			$json["instance"][] = $instance;
		}
		$json["total"] = count($json["instance"]);
	break;
	// แสดงข้อมูล '.$title.' ตาม ID
	case "show":
		$ID = isset($_GET["id"]) ? $_GET["id"] : null;	// รับค่า PRIMARY KEY
		if ($ID){
			$sql = "SELECT * FROM '.$table.' WHERE '.$id->Column_name.'=\'".$ID."\'";
			$query = mysqli_query($conn, $sql);
			$instance=mysqli_fetch_assoc($query);
			// $instance[\'eventDateText\'] = thaiDate("j F Y H:i", strtotime($instance[\'eventDate\']));
			$json["instance"] = $instance;
		}else{
			$json["message"] = "Failed to get data!!!";
		}
	break;
	// บันทึกข้อมูล '.$title.'
	case "save":
		// $_POST[\'eventDate\'] = date("Y-m-d H:i:s");// date("U");	// เวลาในการบันทึก

		$field = getFieldList("'.$table.'", $conn);		// ดึงชื่อฟิวทั้งหมดที่อยู่ในตาราง '.$table.'
		foreach ($_POST as $key=>$value) {
			if (in_array($key, $field)){	// ตรวจสอบค่าที่ส่งมา มีอยู่ใน '.$table.'
				$col.=$c;	$val.=$c;
				$col.=$key;
				$val.="\'".$value."\'";
				$c=",";
			}
		}
		$val = str_replace("\'\'", "NULL", $val);  // เปลี่ยน value ที่มีค่าเป็น \'\' (ค่าว่าง) เป็น NULL
		$insertSql = "INSERT INTO '.$table.' (".$col.") VALUES (".$val.")";
		$excute = mysqli_query($conn, $insertSql);

		if ($excute){ // บันทึกข้อมูล (INSERT) ได้หรือไม่
			$last_id = $conn->insert_id;	// ดึง PRIMARY KRY ของข้อมูลที่ถูกบันทึกล่าสุด
			$json["last_id"] = $last_id;	// ส่ง PRIMARY KRY กลับไป
		}else{	// บันทึกข้อมูล (INSERT) ไม่สำเร็จ
			// ส่ง ข้อความ error กลับไป พร้อมกลับ คำสั่ง SQL เพื่อตรวจสอบความถูกต้องของคำสั่ง
			$json["alert"] = $excute;
			$json["sql"] = $insertSql;
		}
	break;
	// ปรับปรุงข้อมูล
	case "update":
		$ID = isset($_GET["id"]) ? $_GET["id"] : (isset($_POST["id"]) ? $_POST["id"] : null);	// รับค่า PRIMARY KEY
		
		if ($ID){
			// $_POST[\'eventDate\'] = date("Y-m-d H:i:s");// date("U");	// เวลาในการปรับปรุง
			$field = getFieldList("'.$table.'", $conn);		// ดึงชื่อฟิวทั้งหมดที่อยู่ในตาราง '.$table.'

			// ทำการทำ PRIMARY KEY ออกจากข้อมูลที่ทำการปรับปรุง
			if (isset($_POST["'.$id->Column_name.'"])){	unset($_POST["'.$id->Column_name.'"]);	}

			foreach ($_POST as $key=>$value) {	
				if (in_array($key, $field)){
					$col.=$c;
					$col.= $key."=\'".$value."\'";
					$c=",";
				}
			}
			$col = str_replace("\'\'", "NULL", $col);	// เปลี่ยน value ที่มีค่าเป็น \'\' (ค่าว่าง) เป็น NULL
			$updateSql = "UPDATE '.$table.' SET ".$col." WHERE '.$id->Column_name.'=\'".$ID."\'";
			$excute = mysqli_query($conn, $updateSql);


			if ($excute){	// ปรับปรุงข้อมูล สำเร็จ
				$json["last_id"] = $ID;
			}else{	// ปรับปรุงข้อมูล ไม่สำเร็จ
				// ส่ง ข้อความ error กลับไป พร้อมกลับ คำสั่ง SQL เพื่อตรวจสอบความถูกต้องของคำสั่ง
				$json["alert"] = $excute;
				$json["sql"] = $updateSql;
			}
		}else{
			$json["message"] = "Failed to update data!!!";
		}
	break;

	case "delete":
		$ID = isset($_POST["id"]) ? $_POST["id"] : null;	// รับค่า PRIMARY KEY
		if ($ID){
			$deleteSql = "DELETE FROM '.$table.' WHERE '.$id->Column_name.'=\'".$ID."\'";
			$excute = mysqli_query($conn, $deleteSql);
			if ($excute){	// ลบข้อมูล สำเร็จ
				$json["message"] = "Success";
			}else{// ลบข้อมูล ไม่สำเร็จ
				// ส่ง ข้อความ error กลับไป พร้อมกลับ คำสั่ง SQL เพื่อตรวจสอบความถูกต้องของคำสั่ง
				$json["alert"] = $excute;
				$json["sql"] = $deleteSql;
			}
		}else{
			$json["message"] = "Failed to delete data!!!";
		}
	break;

	default:
		$json["message"] = "Access denied!!!";
}

mysqli_close($conn);
$json["date_now"] = date("Y-m-d H:i:s");
echo json_encode($json);
?>
			';
		}else{



			$content = 'angular.module("myApp").controller("'.$table.'Controller", ["$scope", "$http", "$window", function($scope, $http, $window){
	$scope.'.$table.'InstanceList = [];
	$scope.'.$table.'Instance = {};
	';

	while ($instanc = mysqli_fetch_object($excute)){
		if (isset($instanc->Default)){
			$content .= '
	$scope.'.$table.'Instance.'.$instanc->Field.' = "'.$instanc->Default.'";';
		}
	}
	

	$content .= '

	$scope.list= function(){ preload(true);
		$http({
			method: "GET",
			url: PATH+"controller/'.$table.'Controller.php",
			params : {action: "list"},
		}).then(function successCallback(response) {
			$scope.'.$table.'InstanceList = response.data.instance;
			preload(false);
		}, function errorCallback(error) {preload(false);
			console.log("'.$table.'Controller list ERROR!!!");
			showNotification("แสดงข้อมูล ไม่สำเร็จ", "error", "fa-exclamation", "'.$table.'Controller show ERROR!!!");
		});
	};

	$scope.show= function(id){ preload(true);
		$http({
			method: "GET",
			url: PATH+"controller/'.$table.'Controller.php",
			params : {action: "show", id: id},
		}).then(function successCallback(response) {
			if (response.data.instance){
				$scope.'.$table.'Instance = response.data.instance;
			}
			else{
				console.log("Error message function Show!!");
				showNotification("แสดงข้อมูล ไม่สำเร็จ", "warning", "fa-exclamation", $scope.alert);
			}
			preload(false);
		}, function errorCallback(error) {preload(false);
			console.log("'.$table.'Controller show ERROR!!!");
			showNotification("แสดงข้อมูล ไม่สำเร็จ", "error", "fa-exclamation", "'.$table.'Controller show ERROR!!!");
		});
	};


	$scope.save = function(){preload(true);
		$http({
			method: "POST",
			url: PATH+"controller/'.$table.'Controller.php?action=save",
			data: $.param($scope.'.$table.'Instance),
			headers: {"Content-Type": "application/x-www-form-urlencoded"}
		}).then(function successCallback(response) {
			var last_id = response.data.last_id ? response.data.last_id : null;
			if (last_id){
				$window.location.href = PATH+"'.$DEFAULT_Template.$table.'/show/"+last_id+"/";
			}else{
				$scope.alert = response.data.alert;
				console.log(response.data.sql);
				showNotification("เพิ่มข้อมูล ไม่สำเร็จ", "warning", "fa-exclamation", $scope.alert);
			}
			preload(false);
		}, function errorCallback(response) {preload(false);
			console.log("'.$table.'Controller save ERROR!!!");
			showNotification("เพิ่มข้อมูล ไม่สำเร็จ", "error", "fa-exclamation", "'.$table.'Controller show ERROR!!!");
		});
	};

	$scope.update= function(id){ preload(true);
		$http({
			method: "POST",
			url: PATH+"controller/'.$table.'Controller.php?action=update&id="+id,
			data: $.param($scope.'.$table.'Instance),
			headers: {"Content-Type": "application/x-www-form-urlencoded"}
		}).then(function successCallback(response) {
			var last_id = response.data.last_id ? response.data.last_id : null;
			if (last_id){
				$window.location.href = PATH+"'.$DEFAULT_Template.$table.'/show/"+last_id+"/";
			}else{
				$scope.alert = response.data.alert;
				console.log(response.data.sql);
				showNotification("ปรับปรุงข้อมูล ไม่สำเร็จ", "warning", "fa-exclamation", $scope.alert);
			}
			preload(false);
		}, function errorCallback(response) {preload(false);
			console.log("'.$table.'Controller update ERROR!!!");
			showNotification("ปรับปรุงข้อมูล ไม่สำเร็จ", "error", "fa-exclamation", "'.$table.'Controller show ERROR!!!");
		});
	};

	$scope.delete= function(id){ preload(true);
		$http({
			method: "POST",
			url: PATH+"controller/'.$table.'Controller.php?action=delete",
			data: $.param({id: id}),
			headers: {"Content-Type": "application/x-www-form-urlencoded"}
		}).then(function successCallback(response) {
			var message = response.data.message ? response.data.message : null;
			if (message=="Success"){
				$window.location.href = PATH+"'.$DEFAULT_Template.$table.'/list/";
			}else{
				$scope.alert = response.data.alert;
				console.log(response.data.sql);
				showNotification("ลบข้อมูล ไม่สำเร็จ", "warning", "fa-exclamation", $scope.alert);
			}
			preload(false);
		}, function errorCallback(response) {preload(false);
			console.log("'.$table.'Controller update ERROR!!!");
			showNotification("ลบข้อมูล ไม่สำเร็จ", "error", "fa-exclamation", "'.$table.'Controller show ERROR!!!");
		});
	};
}]);';
		}
	break;

	// case 'controller'.ucfirst($table):
		
	// break;
}

function getInput($instanc, $table){
	
	$required = $instanc->Null=='NO' ? 'required="required" ' : '';
	$input='
	<div class="col-sm-9">
		';

	if ($instanc->Type=='text'){
		$input .= '
		<textarea class="form-control" id="'.$instanc->Field.'" name="'.$instanc->Field.'" ng-model="'.$table.'Instance.'.$instanc->Field.'" rows="5" '.$required.'></textarea>
	';
	}else{
		$input .= '<input type="text" class="form-control" id="'.$instanc->Field.'" name="'.$instanc->Field.'" ng-model="'.$table.'Instance.'.$instanc->Field.'" '.$required.' value="{{'.$table.'Instance.'.$instanc->Field.'}}">
	';
	}
	$input.='</div>';

	return $input;
}
if (in_array($file, array('_form', $table.'Controller', 'controller'.ucfirst($table)))){ $boxTitle = $boxF = $boxL = '';}
$html = $boxF.$boxTitle.$content.$boxL;

//echo $html;
?>