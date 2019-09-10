<?php
function view_menu($conn, $tableIns, $fileIns){
	$table = $tableIns['TABLE_NAME'];
	$tableSql = "SELECT * FROM information_schema.TABLES WHERE TABLE_NAME='".$table."' AND TABLE_SCHEMA='".$tableIns['database']."'";
	$tableexcute = mysqli_query($conn, $tableSql);
	$tableInstanc = mysqli_fetch_object($tableexcute);

	$title = $tableInstanc->TABLE_COMMENT ? $tableInstanc->TABLE_COMMENT : $tableInstanc->TABLE_NAME;

	/* $txt = '<a href="<?php echo $LINK_URL; ?>'.$table.'/list/" class="btn btn-sm btn-outline-info" title="รายการข้อมูล'.$title.'">
	<i class="fas fa-table"></i>
	<span class="d-none d-sm-inline">รายการข้อมูล'.$title.'</span>
</a>
<a href="<?php echo $LINK_URL; ?>'.$table.'/create/" class="btn btn-sm btn-outline-success" title="เพิ่มข้อมูล'.$title.'">
	<i class="fas fa-plus-circle"></i> 
	<span class="d-none d-sm-inline">เพิ่มข้อมูล'.$title.'</span>
</a>';*/ 

	/*$txt = '<div class="row">
	<div class="col-lg-6 p-r-0 mr-auto">
		<div class="page-header">
			<div class="page-title">
				<h1>'.$title.'</h1>
			</div>
		</div>
	</div>

	<div class="mr-2">
		<div class="page-header">
			<div class="page-title">
				<ol class="breadcrumb">
					<li class="mr-2">
						<a class="text-info" href="<?php echo $LINK_URL; ?>'.$table.'/list/" title="รายการข้อมูล'.$title.'">
							<i class="fas fa-table"></i>
							รายการข้อมูล'.$title.'
						</a>
					</li>
					<li>
						<a class="text-success" href="<?php echo $LINK_URL; ?>'.$table.'/create/" title="เพิ่มข้อมูล'.$title.'">
							<i class="fas fa-plus-circle"></i> 
							เพิ่มข้อมูล'.$title.'
						</a>
					</li>
				</ol>
			</div>
		</div>
	</div>
</div>'; */

	$txt ='<div class="panel-header bg-info-gradient">
	<div class="page-inner py-5">
		<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
			<div>
				<h2 class="text-white pb-2 fw-bold">'.$title.'</h2>
				<!-- <h5 class="text-white op-7 mb-2">{{ SUBTITLE }}</h5> -->
			</div>
			<div class="ml-md-auto py-2 py-md-0">
				<a href="<?php echo $LINK_URL; ?>'.$table.'/list/" title="รายการข้อมูล'.$title.'" class="btn btn-white btn-border btn-round mr-2">
					<i class="fas fa-table"></i> 
					 รายการข้อมูล'.$title.'
				</a>
				<a href="<?php echo $LINK_URL; ?>'.$table.'/create/" title="เพิ่มข้อมูล'.$title.'" class="btn btn-secondary btn-round">
					<i class="fas fa-plus-circle"></i> 
					 เพิ่มข้อมูล'.$title.'
				</a>
			</div>
		</div>
	</div>
</div>';

	return $txt;
}
?>

