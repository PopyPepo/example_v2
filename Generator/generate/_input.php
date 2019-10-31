<?php 
$txt .= '<div class="form-group row">
	<label for="'.$instanc->Field.'" class="col-sm-2 col-form-label">'.($instanc->Comment ? $instanc->Comment : $instanc->Field).' '.$span.' : </label>
	<div class="col-sm-10">
		<input type="text" class="form-control" id="'.$instanc->Field.'" name="'.$instanc->Field.'" ng-model="'.$table.'Instance.'.$instanc->Field.'"'.$request.'>
	</div>
</div>

';
?>