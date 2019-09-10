<?php
function addressShow($conn){
	$json = array();

	$id = isset($_GET['id']) ? $_GET['id'] : null;
	$json["instance"] = (object)array();
	if ($id){
		$sql = "SELECT * FROM address WHERE id_address=".$id;
		$query = mysqli_query($conn, $sql);
		$json["instance"]=mysqli_fetch_assoc($query);
	}else{
		$json["alert"] = "No record information!!";
	}

	return $json;
}
?>