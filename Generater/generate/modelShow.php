<?php
function modelShow($conn, $tableIns, $fileIns){
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

	$txt = '<?php
function '.$table.'Show($conn){
	$json = array();

	$id = isset($_GET[\'id\']) ? $_GET[\'id\'] : null;
	$json["instance"] = (object)array();
	if ($id){
		$sql = "SELECT * FROM '.$table.' WHERE '.$id->Column_name.'=".$id;
		$query = mysqli_query($conn, $sql);
		$json["instance"]=mysqli_fetch_assoc($query);
	}else{
		$json["alert"] = "No record information!!";
	}

	return $json;
}
?>';


	return $txt;
}
?>