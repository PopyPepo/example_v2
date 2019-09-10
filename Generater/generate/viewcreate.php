<?php
function viewcreate($conn, $tableIns, $fileIns){
	$txt = '';
	$init = '';

	$table = $tableIns['TABLE_NAME'];
	$tableSql = "SELECT * FROM information_schema.TABLES WHERE TABLE_NAME='".$table."' AND TABLE_SCHEMA='".$tableIns['database']."'";
	$tableexcute = mysqli_query($conn, $tableSql);
	$tableInstanc = mysqli_fetch_object($tableexcute);

	$title = "เพิ่มข้อมูล".($tableInstanc->TABLE_COMMENT ? $tableInstanc->TABLE_COMMENT : $tableInstanc->TABLE_NAME);
	include '_herder.php';

	$txt.='	
	<form name="'.$table.'Create" method="post" ng-submit="'.$table.'Insert();">
		<?php include("app/'.$table.'/view/_form.php"); ?>';

	$txt .= $boxL;
	return $txt;
}
?>