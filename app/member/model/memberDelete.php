<?php
function memberDelete($conn){
	$json = array();
	$id = isset($_POST["id"]) ? $_POST["id"] : null;
	if ($id){
		$deleteSql = "DELETE FROM member WHERE id='".$id."'";
		$excute = mysqli_query($conn, $deleteSql);
		if ($excute){
			$json["status"] = true;
			$json["message"] = "Delete Success.";
		}else{
			$json["status"] = false;
			$json["message"] = "Delete Fail!!";
			$json["alert"] = $excute;
			$json["sql"] = $deleteSql;
		}
	}else{
		$json["alert"] = "No record information available!!";
	}
	return $json;
}
?>