<?php
include("_herder.php");
include("_connect.php");

$action = isset($_GET["action"]) ? $_GET["action"] : null;

$json["date_now"] = date("Y-m-d H:i:s");

$actionFile = $action.".php";
if (file_exists($actionFile)){
	
	include($actionFile);

	if (function_exists($action)){
		$json = $action($conn);
	}else{
		$json["alert"] = "Function not found!!!";
	}
}else{
	$json["alert"] = "File not found!!!";
}



mysqli_close($conn);

echo json_encode($json);
?>