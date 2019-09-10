<?php
function memberUpdate($conn){
	$json = array();
	$id = isset($_GET["id"]) ? $_GET["id"] : (isset($_POST["id"]) ? $_POST["id"] : null);
	if ($id && isset($_POST) && $_POST){
		$col = "";	$val = "";	$c="";
		include($conn->PATH."conf/getColumname.php");
		$field = getColumname($conn, "member");
		
		if (isset($_POST["id"])){	unset($_POST["id"]);}
		foreach ($_POST as $key=>$value) {	
			if (in_array($key, $field)){
				$col.=$c;
				$col.= $key."='".$value."'";
				$c=",";
			}
		}

		$col = str_replace("''", "NULL", $col);
		$updateSql = "UPDATE member SET ".$col." WHERE id='".$id."'";
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