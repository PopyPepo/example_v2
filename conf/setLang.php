<?php
function setLang($conn){
	$json = false;
	if (isset($_POST)){
		$_SESSION['LANG'] = $_POST['LANG'];
		$json = true;
	}
	return $json;
}
?>