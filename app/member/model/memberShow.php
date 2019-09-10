<?php
function memberShow($conn){
	$json = array();

	$id = isset($_GET['id']) ? $_GET['id'] : null;
	$json["instance"] = (object)array();
	if ($id){
		$sql = "SELECT * FROM member WHERE id=".$id;
		$query = mysqli_query($conn, $sql);
		$json["instance"]=mysqli_fetch_assoc($query);
	}else{
		$json["alert"] = "No record information!!";
	}

	return $json;
}
?>