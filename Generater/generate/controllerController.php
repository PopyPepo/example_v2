<?php
function controllerController($conn, $tableIns, $fileIns){
	$txt = '';
	$i = 1;
	$colIndex = array();
	$id = array();
	$table = $tableIns['TABLE_NAME'];
	$sqlS = "SHOW INDEX  FROM ".$table."";
	$excuteS = mysqli_query($conn, $sqlS);
	while ($instancS = mysqli_fetch_object($excuteS)){
		//print_r($instancS);
		if (isset($instancS->Column_name)){$colIndex[] = $instancS->Column_name;}
		if ($instancS->Key_name=='PRIMARY' && !$id){$id = $instancS;}
	}

	$tableSql = "SELECT * FROM information_schema.TABLES WHERE TABLE_NAME='".$table."' AND TABLE_SCHEMA='".$tableIns['database']."'";
	$tableexcute = mysqli_query($conn, $tableSql);
	$tableInstanc = mysqli_fetch_object($tableexcute);
	$title = ($tableInstanc->TABLE_COMMENT ? $tableInstanc->TABLE_COMMENT : " ".$tableInstanc->TABLE_NAME." ");
	$txt = 'angular.module("myApp").controller("'.$table.'Controller", ["$scope", "$http", "$window", "$filter", function($scope, $http, $window, $filter){
	
	$scope.'.$table.'InstanceList = [];
	$scope.'.$table.'Instance = {};';	

	$sql = "SHOW FULL COLUMNS FROM ".$table." WHERE Extra!='auto_increment' ";
	$excute = mysqli_query($conn, $sql);
	while ($instanc = mysqli_fetch_object($excute)){
		if (isset($instanc->Default) && $instanc->Default!='CURRENT_TIMESTAMP'){
			$txt .= '
	$scope.'.$table.'Instance.'.$instanc->Field.' = "'.$instanc->Default.'";';
		}
		if (strpos($instanc->Comment, "@{")){
			$dataSpri = explode("@{", $instanc->Comment);
			$dataSpri = str_replace(array("}", " "), "", $dataSpri[1]);
			$dataSpri = str_replace(":", '":"', $dataSpri);
			$dataSpri = '{"'.(str_replace(",", '","', $dataSpri)).'"}';
			$txt .= '
	$scope.'.$table.ucfirst($instanc->Field).' = '.$dataSpri.';';
		}
	}

	$txt .= '
	$scope.pagination = {};
	$scope.pagination.page = 1;

	$scope.'.$table.'Insert = function(){
		$http({
			method: "POST",
			url: PATH+"app/'.$table.'/model/?action='.$table.'Insert",
			data: $.param($scope.'.$table.'Instance),
			headers: {"Content-Type": "application/x-www-form-urlencoded"}
		}).then(function successCallback(response) {
			var last_id = response.data.last_id ? response.data.last_id : null;
			if (last_id){
				$window.location.href = LINK+"'.$table.'/show/"+last_id+"/";
			}else{
				$scope.displayNotify(\'warning\', "เพิ่มข้อมูล'.$title.'ใหม่ไม่สำเร็จ!!");
				console.log(response.data.sql);
			}
			
		}, function errorCallback(error) {
			$scope.displayNotify(\'error\', "เกิดข้อผิดพลาด!! ในการเพิ่มข้อมูล'.$title.'ใหม่");
			console.log("'.$table.'Controller save ERROR!!!");
			console.log(error);
		});
	};

	$scope.'.$table.'Show= function(id){
		$http({
			method: "GET",
			url: PATH+"app/'.$table.'/model?action='.$table.'Show",
			params: {id: id}
		}).then(function successCallback(response) {
			if (response.data.instance){
				$scope.'.$table.'Instance = response.data.instance;
			}
			else{
				$scope.displayNotify(\'warning\', "แสดงข้อมูล '.$title.' ไม่สำเร็จ!!");
				console.log(response.data.sql);
			}
			
		}, function errorCallback(error) {
			$scope.displayNotify(\'error\', "เกิดข้อผิดพลาด!! ในการแสดงข้อมูล'.$title.' #"+id);
			console.log("'.$table.'Controller show ERROR!!!");
			console.log(error);
		});
	};

	$scope.'.$table.'List= function(){
		$http({
			method: "GET",
			url: PATH+"app/'.$table.'/model/?action='.$table.'List",
			params: $scope.pagination
		}).then(function successCallback(response) {
			$scope.'.$table.'InstanceList = response.data.instance;
			$scope.pagination = response.data.pagination;
			
		}, function errorCallback(error) {
			$scope.displayNotify(\'error\', "เกิดข้อผิดพลาด!! ในการแสดรายการข้อมูล'.$title.'");
			console.log("'.$table.'Controller list ERROR!!!");
			console.log(error);
		});
	};

	$scope.'.$table.'Update = function(){
		$http({
			method: "POST",
			url: PATH+"app/'.$table.'/model/?action='.$table.'Update",
			data: $.param($scope.'.$table.'Instance),
			headers: {"Content-Type": "application/x-www-form-urlencoded"}
		}).then(function successCallback(response) {
			var update_id = response.data.update_id ? response.data.update_id : null;
			if (update_id){
				$window.location.href = LINK+"'.$table.'/show/"+update_id+"/";
			}else{
				$scope.displayNotify(\'warning\', "ปรับปรุงข้อมูล'.$title.'ไม่สำเร็จ!!");
				console.log(response.data);
			}
			
		}, function errorCallback(error) {
			$scope.displayNotify(\'error\', "เกิดข้อผิดพลาด!! ในการปรับปรุงข้อมูล'.$title.'!! #"+$scope.'.$table.'Instance.'.$id->Column_name.');
			console.log("'.$table.'Controller update ERROR!!!");
			console.log(error);
		});
	};

	$scope.'.$table.'Delete = function(id){
		$http({
			method: "POST",
			url: PATH+"app/'.$table.'/model/?action='.$table.'Delete",
			data: $.param({id: id}),
			headers: {"Content-Type": "application/x-www-form-urlencoded"}
		}).then(function successCallback(response) {
			var status = response.data.status ? response.data.status : false;
			alert(response.data.message);
			if (status){
				$window.location.href = LINK+"'.$table.'/list/";
			}else{
				$scope.displayNotify(\'warning\', "ลบข้อมูล'.$title.'ไม่สำเร็จ!!");
				console.log(response.data.sql);
			}
			
		}, function errorCallback(error) {
			$scope.displayNotify(\'error\', "เกิดข้อผิดพลาด!! ในการลบข้อมูล'.$title.'!! #"+id);
			console.log("'.$table.'Controller delete ERROR!!!");
			console.log(error);
		});
	};

}]);';


	return $txt;
}
?>