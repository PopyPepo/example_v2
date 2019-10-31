<?php
function viewedit($conn, $tableIns, $fileIns){
	$i = 1;
	$colIndex = array();
	$id = array();
	$table = $tableIns['TABLE_NAME'];
	$tableSql = "SELECT * FROM information_schema.TABLES WHERE TABLE_NAME='".$table."' AND TABLE_SCHEMA='".$tableIns['database']."'";
	$tableexcute = mysqli_query($conn, $tableSql);
	$tableInstanc = mysqli_fetch_object($tableexcute);

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

	$toString = "";
	$result = mysqli_query($conn, "SHOW FULL COLUMNS FROM ".$table." WHERE Extra!='auto_increment'");
	$row = mysqli_fetch_object($result);
	$toString = $row->Field;



	$txt = '<?php $ID = isset($_GET[\''.$id->Column_name.'\']) ? $_GET[\''.$id->Column_name.'\'] : $ID; ?>
';
	$init = 'ng-init="'.$table.'Show(\'<?php echo $ID; ?>\');"';

	$title = "แก้ไขข้อมูล".($tableInstanc->TABLE_COMMENT ? $tableInstanc->TABLE_COMMENT : $tableInstanc->TABLE_NAME);
	$title .='
						<small>
							<a href="<?php echo $LINK_URL; ?>'.$table.'/show/{{'.$table.'Instance.'.$id->Column_name.'}}/" ng-attr-title="{{ \'กลับไปหน้า แสดงข้อมูล \'+'.$table.'Instance.'.$toString.' }}">
								<i class="fas fa-hand-point-left"></i> 
								{{ "#"+'.$table.'Instance.'.$id->Column_name.' }}
							</a>
						</small>
					';

	include '_herder.php';

	$txt.='	

				<div class="card-body">
					<form name="'.$table.'Edit" method="post" ng-submit="'.$table.'Update();">
						<?php include("app/'.$table.'/view/_form.php"); ?>';

	$txt .= $boxL;
	return $txt;
}
?>