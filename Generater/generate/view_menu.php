<?php
function view_menu($conn, $tableIns, $fileIns){
	$table = $tableIns['TABLE_NAME'];
	$tableSql = "SELECT * FROM information_schema.TABLES WHERE TABLE_NAME='".$table."' AND TABLE_SCHEMA='".$tableIns['database']."'";
	$tableexcute = mysqli_query($conn, $tableSql);
	$tableInstanc = mysqli_fetch_object($tableexcute);

	$title = $tableInstanc->TABLE_COMMENT ? $tableInstanc->TABLE_COMMENT : $tableInstanc->TABLE_NAME;

	$txt = '<a href="<?php echo $LINK_URL; ?>'.$table.'/list/" class="btn btn-sm btn-outline-info" title="รายการข้อมูล'.$title.'">
	<i class="fas fa-table"></i>
	<span class="d-none d-sm-inline">รายการข้อมูล'.$title.'</span>
</a>
<a href="<?php echo $LINK_URL; ?>'.$table.'/create/" class="btn btn-sm btn-outline-success" title="เพิ่มข้อมูล'.$title.'">
	<i class="fas fa-plus-circle"></i> 
	<span class="d-none d-sm-inline">เพิ่มข้อมูล'.$title.'</span>
</a>';


	return $txt;
}
?>