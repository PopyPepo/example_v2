<?php 
function modelindex($conn, $tableIns, $fileIns){
	$txt='<?php
$PATH = isset($PATH) ? $PATH : "../../../";
include($PATH."conf/_header.php");
include($PATH."conf/_connect.php");
$conn->PATH = $PATH;

$action = isset($_GET["action"]) ? $_GET["action"] : null;

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

$json["date_now"] = date("Y-m-d H:i:s");

mysqli_close($conn);

$jsonEncode = json_encode($json);
if (isset($_GET["callback"])){
	$callback = $_GET["callback"];
	$jsonEncode = $callback. "(".$jsonEncode.")";
}
echo $jsonEncode;
?>';
	return $txt;
}
?>