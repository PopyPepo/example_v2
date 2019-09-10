<?php
function i18n($conn){
	$json = array();
	$lang = isset($_SESSION['LANG']) ? $_SESSION['LANG'] : "Th";
	$domain = isset($_POST['domain']) ? $_POST['domain'] : array();
// 	$massages = isset($_POST['massages']) && $_POST['massages']!="" ? $_POST['massages'] : "massages";
	
	foreach($domain as $model=>$filename){
		$path = isset($model) && $model!="_main" ? "../../".$model : "..";
		if (file_exists($path."/i18n/".$filename.".json")){
			$str = file_get_contents($path."/i18n/".$filename.".json");
			$lable = json_decode($str, true); 
			$model = $model=="_main" ? 'default' : $model;
			$json[$model] = $lable[$lang];
		}
	}
	
	return $json;
}
?>