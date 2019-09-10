<?php
function getColumname($conn, $table=""){
	$field = array();
	if ($table){
		$sql = "SHOW FULL COLUMNS FROM ".$table." WHERE Extra!='auto_increment' ";
		$excute = mysqli_query($conn, $sql);
		while ($instanc = mysqli_fetch_object($excute)){
			$field[] = $instanc->Field;
		}
	}
	return $field;
}
?>