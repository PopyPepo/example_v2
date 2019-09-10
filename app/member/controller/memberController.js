angular.module("myApp").controller("memberController", ["$scope", "$http", "$window", "$filter", function($scope, $http, $window, $filter){
	
	$scope.memberInstanceList = [];
	$scope.memberInstance = {};
	$scope.memberInstance.gender = "1";
	$scope.memberGender = {"1":"ชาย","2":"หญิง"};
	$scope.pagination = {};
	$scope.pagination.page = 1;

	$scope.memberInsert = function(){
		$http({
			method: "POST",
			url: PATH+"app/member/model/?action=memberInsert",
			data: $.param($scope.memberInstance),
			headers: {"Content-Type": "application/x-www-form-urlencoded"}
		}).then(function successCallback(response) {
			var last_id = response.data.last_id ? response.data.last_id : null;
			if (last_id){
				$window.location.href = LINK+"member/show/"+last_id+"/";
			}else{
				$scope.displayNotify('warning', "เพิ่มข้อมูลสมาชิกใหม่ไม่สำเร็จ!!");
				console.log(response.data.sql);
			}
			
		}, function errorCallback(error) {
			$scope.displayNotify('error', "เกิดข้อผิดพลาด!! ในการเพิ่มข้อมูลสมาชิกใหม่");
			console.log("memberController save ERROR!!!");
			console.log(error);
		});
	};

	$scope.memberShow= function(id){
		$http({
			method: "GET",
			url: PATH+"app/member/model?action=memberShow",
			params: {id: id}
		}).then(function successCallback(response) {
			if (response.data.instance){
				$scope.memberInstance = response.data.instance;
			}
			else{
				$scope.displayNotify('warning', "แสดงข้อมูล สมาชิก ไม่สำเร็จ!!");
				console.log(response.data.sql);
			}
			
		}, function errorCallback(error) {
			$scope.displayNotify('error', "เกิดข้อผิดพลาด!! ในการแสดงข้อมูลสมาชิก #"+id);
			console.log("memberController show ERROR!!!");
			console.log(error);
		});
	};

	$scope.memberList= function(){
		$http({
			method: "GET",
			url: PATH+"app/member/model/?action=memberList",
			params: $scope.pagination
		}).then(function successCallback(response) {
			$scope.memberInstanceList = response.data.instance;
			$scope.pagination = response.data.pagination;
			
		}, function errorCallback(error) {
			$scope.displayNotify('error', "เกิดข้อผิดพลาด!! ในการแสดรายการข้อมูลสมาชิก");
			console.log("memberController list ERROR!!!");
			console.log(error);
		});
	};

	$scope.memberUpdate = function(){
		$http({
			method: "POST",
			url: PATH+"app/member/model/?action=memberUpdate",
			data: $.param($scope.memberInstance),
			headers: {"Content-Type": "application/x-www-form-urlencoded"}
		}).then(function successCallback(response) {
			var update_id = response.data.update_id ? response.data.update_id : null;
			if (update_id){
				$window.location.href = LINK+"member/show/"+update_id+"/";
			}else{
				$scope.displayNotify('warning', "ปรับปรุงข้อมูลสมาชิกไม่สำเร็จ!!");
				console.log(response.data);
			}
			
		}, function errorCallback(error) {
			$scope.displayNotify('error', "เกิดข้อผิดพลาด!! ในการปรับปรุงข้อมูลสมาชิก!! #"+$scope.memberInstance.id);
			console.log("memberController update ERROR!!!");
			console.log(error);
		});
	};

	$scope.memberDelete = function(id){
		$http({
			method: "POST",
			url: PATH+"app/member/model/?action=memberDelete",
			data: $.param({id: id}),
			headers: {"Content-Type": "application/x-www-form-urlencoded"}
		}).then(function successCallback(response) {
			var status = response.data.status ? response.data.status : false;
			alert(response.data.message);
			if (status){
				$window.location.href = LINK+"member/list/";
			}else{
				$scope.displayNotify('warning', "ลบข้อมูลสมาชิกไม่สำเร็จ!!");
				console.log(response.data.sql);
			}
			
		}, function errorCallback(error) {
			$scope.displayNotify('error', "เกิดข้อผิดพลาด!! ในการลบข้อมูลสมาชิก!! #"+id);
			console.log("memberController delete ERROR!!!");
			console.log(error);
		});
	};

}]);