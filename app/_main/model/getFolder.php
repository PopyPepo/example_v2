<?php
function  getFolder($conn){
	$json = array();
	
	$dir = "../../view/";

	// Sort in ascending order - this is default
	$a = scandir($dir);
	$list = "'".(implode("','",$a))."'";

	$sql = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE table_schema='scholaship' AND TABLE_NAME IN (".$list.")";
	$query = mysqli_query($conn, $sql);

	while ($instance=mysqli_fetch_assoc($query)) {	/*$json.=$c;
		$json.= json_encode($instance);
		$c=',';*/

		$json['instance'][] = $instance;
	}


	return $json;
}
?>