<?php
function view_form($conn, $tableIns, $fileIns){
	$txt = '';

	$i = 1;
	$colIndex = array();
	$id = array();
	$table = $tableIns['TABLE_NAME'];
	$sqlS = "SHOW INDEX FROM ".$table."";
	$excuteS = mysqli_query($conn, $sqlS);
	while ($instancS = mysqli_fetch_object($excuteS)){
		//print_r($instancS);
		if (isset($instancS->Column_name)){$colIndex[] = $instancS->Column_name;}
		if ($instancS->Key_name=='PRIMARY' && !$id){$id = $instancS;}
	}

	$refTable = array();
	$sqlRef = "SELECT COLUMN_NAME, REFERENCED_TABLE_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME FROM information_schema.key_column_usage WHERE REFERENCED_TABLE_NAME IS NOT NULL AND TABLE_SCHEMA='".$tableIns['database']."' AND TABLE_NAME='".$table."'";
	$excute = mysqli_query($conn, $sqlRef);
	while ($instanc = mysqli_fetch_object($excute)){
		$refTable[$instanc->COLUMN_NAME] = $instanc;
	}


	$sql = "SHOW FULL COLUMNS FROM ".$table." WHERE Extra!='auto_increment' ";
	$excute = mysqli_query($conn, $sql);
	while ($instanc = mysqli_fetch_object($excute)){

		$span = "";
		$request = "";

		if ($instanc->Default!='CURRENT_TIMESTAMP'){
			if ($instanc->Null=='NO'){
				$span = '<span class="text-danger">*</span>';
				$request = ' required="required"';
			}

			if (isset($refTable[$instanc->Field])){
				include '_referenceTable.php';
			}else if (strpos($instanc->Comment, "@{")){
				include '_radio.php';
			}else if ($instanc->Type=='text'){
				include '_textarea.php';
			}else{
				include '_input.php';
			}
		}
	}

	$txt .= '<hr>
<button class="btn btn-success float-right" type="submit"><i class="fas fa-save"></i> บันทึกข้อมูล</button>';
	return $txt;
}
?>