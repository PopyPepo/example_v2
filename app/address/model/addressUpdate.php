<?php
function addressUpdate($conn){
	$json = array();
	$id = isset($_GET["id"]) ? $_GET["id"] : (isset($_POST["id_address"]) ? $_POST["id_address"] : null);
	if ($id && isset($_POST) && $_POST){
		$col = "";	$val = "";	$c="";
		include($conn->PATH."conf/getColumname.php");
		$field = getColumname($conn, "address");
		
		if (isset($_POST["id_address"])){	unset($_POST["id_address"]);}
		foreach ($_POST as $key=>$value) {	
			if (in_array($key, $field)){
				$col.=$c;
				$col.= $key."='".$value."'";
				$c=",";
			}
		}

		$col = str_replace("''", "NULL", $col);
		$updateSql = "UPDATE address SET ".$col." WHERE id_address='".$id."'";
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
?>