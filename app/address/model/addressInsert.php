<?php
function addressInsert($conn){
	$json = array();
	if (isset($_POST) && $_POST){
		include($conn->PATH."conf/getColumname.php");
		$field = getColumname($conn, "address");
		$col = "";	$val = "";	$c="";
		foreach ($_POST as $key=>$value) {
			if (in_array($key, $field)){
				$col.=$c;	$val.=$c;
				$col.=$key;
				$val.="'".$value."'";
				$c=",";
			}
		}
		$val = str_replace("''", "NULL", $val);
		$insertSql = "INSERT INTO address (".$col.") VALUES (".$val.")";
		$excute = mysqli_query($conn, $insertSql);
		if ($excute){
			$last_id = $conn->insert_id;
			$json["last_id"] = $last_id;
		}else{
			$json["alert"] = $excute;
			$json["sql"] = $insertSql;
		}
	}else{
		$json["alert"] = "No record information available!!";
	}
	$json["date_now"] = date("Y-m-d H:i:s");
	return $json;
}
?>