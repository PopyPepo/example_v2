<?php
function modelDelete($conn, $tableIns, $fileIns){

	$i = 1;
	$colIndex = array();
	$id = null;
	$table = $tableIns['TABLE_NAME'];

	$sqlS = "SHOW INDEX FROM ".$table."";
	$excuteS = mysqli_query($conn, $sqlS);
	while ($instancS = mysqli_fetch_object($excuteS)){
		//print_r($instancS);
		if (isset($instancS->Column_name)){$colIndex[] = $instancS->Column_name;}
		if ($instancS->Key_name=='PRIMARY' && !$id){$id = $instancS;}
	}

	$listCol = array();
	$sql = "SHOW FULL COLUMNS FROM ".$table." WHERE Extra!='auto_increment' ";
	$excute = mysqli_query($conn, $sql);
	while ($instanc = mysqli_fetch_object($excute)){
		$instanc->Column_name = $instanc->Field;
		$listCol[] = $instanc;
	}

	$id = $id ? $id : $listCol[0];

	$txt = '<?php
function '.$table.'Delete($conn){
	$json = array();
	$id = isset($_POST["id"]) ? $_POST["id"] : null;
	if ($id){
		$deleteSql = "DELETE FROM '.$table.' WHERE '.$id->Column_name.'=\'".$id."\'";
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
?>';


	return $txt;
}
?>