<?php
function viewshow($conn, $tableIns, $fileIns){
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

	$txt = '<?php $ID = isset($_GET[\''.$id->Column_name.'\']) ? $_GET[\''.$id->Column_name.'\'] : $ID; ?>
';
	$init = 'ng-init="'.$table.'Show(\'<?php echo $ID; ?>\');"';

	$title = "แสดงข้อมูล".($tableInstanc->TABLE_COMMENT ? $tableInstanc->TABLE_COMMENT : $tableInstanc->TABLE_NAME);
	$title .= ' : {{ "#"+'.$table.'Instance.'.$id->Column_name.' }}';
	include '_herder.php';


	$txt .= '
	<div class="table-responsive">
		<table class="table table-striped">
			<tbody>';
				$sql = "SHOW FULL COLUMNS FROM ".$table." WHERE Extra!='auto_increment' ";
				$excute = mysqli_query($conn, $sql);
				while ($instanc = mysqli_fetch_object($excute)){
					if ($id->Column_name!=$instanc->Field){
						// if (!in_array($instanc->Field, $colIndex)){
						$label = $instanc->Comment ? $instanc->Comment : $instanc->Field;
						$td = '{{ '.$table.'Instance.'.$instanc->Field.' }}';
						if (strpos($instanc->Comment, "@{")){
							$dataSpri = explode("@{", $instanc->Comment);
							$label = $dataSpri[0];
							$td = '{{ '.$table.ucfirst($instanc->Field).'['.$table.'Instance.'.$instanc->Field.'] }}';
						}
						$txt .= '
				<tr>
					<th>'.$label.'</th>
					<td class="profile-info-value">'.$td.'</td>
				</tr>
						';
					}
				}
			$txt .= '
			</tbody>
		</table>
	</div>

	<hr>
	<a class="btn btn-warning float-right" href="<?php echo $LINK_URL; ?>'.$table.'/edit/{{ '.$table.'Instance.'.$id->Column_name.' }}/"> 
		<i class="fas fa-edit"></i>
		แก้ไขข้อมูล
	</a> 

	<button type="button" class="btn btn-danger float-right" ng-confirm-click="คุณแน่ใจว่าต้องการลบข้อมูล ใช่หรือไม่?" confirmed-click="'.$table.'Delete('.$table.'Instance.'.$id->Column_name.');"> 
		<i class="fas fa-trash-alt"></i> ลบข้อมูล 
	</button>
';

	$txt .= '</div>';
	return $txt;
}
?>