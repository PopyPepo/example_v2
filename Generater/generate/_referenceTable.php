<?php 
$refTableName = $refTable[$instanc->Field]->REFERENCED_TABLE_NAME;
$refTableid = $refTable[$instanc->Field]->REFERENCED_COLUMN_NAME;

$toString = "";
$result = mysqli_query($conn, "SHOW FULL COLUMNS FROM ".$refTableName." WHERE Extra!='auto_increment'");
$row = mysqli_fetch_object($result);
$toString = $row->Field;

$txt .= '<script src="<?php echo $ASSETS_URL; ?>app/'.$refTableName.'/controller/'.$refTableName.'Controller.js"></script>
<div class="form-group row" ng-controller="'.$refTableName.'Controller" ng-init="'.$refTableName.'List();">
	<label for="'.$instanc->Field.'" class="col-sm-2 col-form-label">'.($instanc->Comment ? $instanc->Comment : $instanc->Field).' '.$span.' : </label>
	<div class="col-sm-10">
		<select class="custom-select" name="'.$instanc->Field.'" ng-model="'.$table.'Instance.'.$instanc->Field.'" ng-options="'.$refTableName.'.'.$refTableid.' as '.$refTableName.'.'.$toString.' for '.$refTableName.' in '.$refTableName.'InstanceList"'.$request.'>
			<option value="">--- เลือก'.($instanc->Comment ? $instanc->Comment : $instanc->Field).' ---</option>
		</select>
	</div>
</div>


';
?>