angular.module("myApp", []).controller('generateAll', ['$scope', '$http', function($scope, $http){
	
	/*$scope.functioninstance = [
		{name:'Model', file: 'controller', type: 'model'},
		{name:'Controller', file: '_form', type: 'controller'}, 
		{name: 'List รายการข้อมูล', file: 'list', type: 'view'}, 
		{name: 'Show แสดงข้อมูล', file: 'show', type: 'view'}, 
		{name:'Create รายการข้อมูล', file: 'create', type: 'view'},
		{name:'Edit แก้ไขข้อมูล', file: 'edit', type: 'view'},
		{name:'Form ฟอร์มกรอกข้อมูล', file: '_form', type: 'view'}
	];*/  


	$scope.functioninstance = [
		/* model .php */
		{file: '', path: 'model'},// index.php
		{file: 'Insert.php', path: 'model'},
		{file: 'Show.php', path: 'model'},
		{file: 'List.php', path: 'model'},
		{file: 'Update.php', path: 'model'},
		{file: 'Delete.php', path: 'model'},
		/* controller .js*/
		{file: 'Controller.js', path: 'controller'},
		/* view html .php*/
		{file: '_menu.php', path: 'view'},
		{file: 'create.php', path: 'view'},
		{file: 'list.php', path: 'view'},
		{file: 'show.php', path: 'view'},
		{file: 'edit.php', path: 'view'},
		{file: '_form.php', path: 'view'},
		/* i18n .json*/
		{file: '', path: 'i18n'}
	];
	$scope.tableList = [];     
	$scope.tableInstance = null;
	$scope.foderInstance = [];

	$scope.list= function(gameId){ 
		$http({
			method: "GET",
			url: "controller.php",
			params : {action: 'show_table'},
		}).then(function successCallback(response) {
			$scope.tableList = response.data.instance;
			//$scope.gamesInstanceList[gameId].push({'teamSelect' : teamsList});
		}, function errorCallback(error) {
		});
	};
	$scope.list();

	$scope.setTable = function(ins){
		//var TABLE_NAME = ins.TABLE_NAME.charAt(0).toUpperCase() + ins.TABLE_NAME.substr(1).toLowerCase();
		//$scope.functioninstance.push({name:'Controller '+ins.TABLE_COMMENT, file: 'controller'+TABLE_NAME+'.php', type: 'controller'});
		// $scope.functioninstance[0] = {name:'Model '+ins.TABLE_COMMENT, file: ins.TABLE_NAME, type: 'model'};
		// $scope.functioninstance[1] = {name:'Controller '+ins.TABLE_COMMENT, file: ins.TABLE_NAME+'Controller', type: 'controller'};
		$scope.tableInstance = ins;
		getFoderInstance(ins);
	};


	getFoderInstance = function(ins){
		$scope.foderInstance = [];
		$http({
			method: "GET",
			url: "controller.php",
			params : {action: 'getFoderInstance', forderName: ins.TABLE_NAME},
		}).then(function successCallback(response) {
			//console.log(response.data.instance[0]);
			$scope.foderInstance = response.data.message=='no' ? null : response.data.instance;
		}, function errorCallback(error) {
			console.log('getFoderInstance list');
		});
	};

	$scope.createForder = function(ins){
		$http({
			method: "GET",
			url: "controller.php",
			params : {action: 'createForder', forderName: ins.TABLE_NAME},
		}).then(function successCallback(response) {
			$scope.setTable(ins);
		}, function errorCallback(error) {
			console.log('generateAll createForder');
		});
	};

	$scope.createFile = function(tableIns, fileIns){
		//console.log(ins.TABLE_NAME);
		$http({
			method: "POST",
			url: "controller.php?action=createFile",
			data: $.param({table: tableIns, files: fileIns}),
			headers: {"Content-Type": "application/x-www-form-urlencoded"}
		}).then(function successCallback(response) {
			console.log(response.data);
			//$scope.setTable(ins);
		}, function errorCallback(error) {
			console.log('createFile list '+error);
		});
	};

}]);