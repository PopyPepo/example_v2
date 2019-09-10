<?php
function modelDelete($conn, $tableIns, $fileIns){

	$i = 1;
	$colIndex = array();
	$id = array();
	$table = $tableIns['TABLE_NAME'];

	$sqlS = "SHOW INDEX FROM ".$table."";
	$excuteS = mysqli_query($conn, $sqlS);
	while ($instancS = mysqli_fetch_object($excuteS)){
		//print_r($instancS);
		if (isset($instancS->Column_name)){$colIndex[] = $instancS->Column_name;}
		if ($instancS->Key_name=='PRIMARY' && !$id){$id = $instancS;}
	}

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