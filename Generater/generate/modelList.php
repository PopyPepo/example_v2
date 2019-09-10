<?php
function modelList($conn, $tableIns, $fileIns){
	$i = 1;
	$colIndex = array();
	$id = null;
	$table = $tableIns['TABLE_NAME'];

	$sqlS = "SHOW INDEX  FROM ".$table."";
	$excuteS = mysqli_query($conn, $sqlS);
	while ($instancS = mysqli_fetch_object($excuteS)){
		//print_r($instancS);
		if (isset($instancS->Column_name)){$colIndex[] = $instancS->Column_name;}
		if ($instancS->Key_name=='PRIMARY' && !$id){$id = $instancS;}
	}

	$listCol = array();
	$sql = "SHOW FULL COLUMNS FROM ".$table." WHERE Extra!='auto_increment' ";
	$excute = mysqli_query($conn, $sql);
	while ($instanc = mysqli_fetch_object($excute)){
		$instanc->Column_name = $instanc->Field;
		$listCol[] = $instanc;
	}

	$id = $id ? $id : $listCol[0];

	$perPage = 10; // defauit perPage
	
	$txt = '<?php
function '.$table.'List($conn){
	$json = array();
	
	$perPage = isset($_GET["perPage"]) ? $_GET["perPage"] : '.$perPage.';
	$page = isset($_GET["page"]) ? $_GET["page"] : 1;
	$pageStart = ($page-1)*$perPage;

	$sql = "SELECT * FROM '.$table.' LIMIT ".$pageStart.",".$perPage;
	$query = mysqli_query($conn, $sql);
	$json["instance"] = array();
	while ($instance=mysqli_fetch_assoc($query)) {
		$json["instance"][] = $instance;
	}

	$sqlCount = "SELECT count('.$id->Column_name.') AS total FROM '.$table.'";
	$query = mysqli_query($conn, $sqlCount);
	$total = mysqli_fetch_assoc($query);

	$json[\'pagination\'] = array();
	$json[\'pagination\'][\'total\'] = intval($total[\'total\']);
	$json[\'pagination\'][\'page\'] = intval($page);
	$json[\'pagination\'][\'pageStart\'] = intval($pageStart);
	$json[\'pagination\'][\'perPage\'] = intval($perPage);

	return $json;
}	
?>';
	return $txt;
}
?>