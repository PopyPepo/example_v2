<?php
function modelUpdate($conn, $tableIns, $fileIns){

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
function '.$table.'Update($conn){
	$json = array();
	$id = isset($_GET["id"]) ? $_GET["id"] : (isset($_POST["'.$id->Column_name.'"]) ? $_POST["'.$id->Column_name.'"] : null);
	if ($id && isset($_POST) && $_POST){
		$col = "";	$val = "";	$c="";
		include("../../_main/model/getColumname.php");
		$field = getColumname($conn, "'.$table.'");
		
		if (isset($_POST["'.$id->Column_name.'"])){	unset($_POST["'.$id->Column_name.'"]);}
		foreach ($_POST as $key=>$value) {	
			if (in_array($key, $field)){
				$col.=$c;
				$col.= $key."=\'".$value."\'";
				$c=",";
			}
		}

		$col = str_replace("\'\'", "NULL", $col);
		$updateSql = "UPDATE '.$table.' SET ".$col." WHERE '.$id->Column_name.'=\'".$id."\'";
		$excute = mysqli_query($conn, $updateSql);

		if ($excute){
			$json["update_id"] = $id;
			$json["status"] = true;
		}else{
			$json["sql"] = $updateSql;
			$json["status"] = false;
		}
		$json["date_now"] = date("Y-m-d H:i:s");
	}else{
		$json["alert"] = "No record information available!!";
	}

	return $json;
}
?>';


	return $txt;
}
?>