<?php
$dataSpri = explode("@{", $instanc->Comment);

if (count($dataSpri)>1){
	$comment = $dataSpri[0];
	$dataSpri = str_replace(array("}", " "), "", $dataSpri[1]);
	$dataSpri = str_replace(":", '":"', $dataSpri);
	$dataSpri = json_decode('{"'.(str_replace(",", '","', $dataSpri)).'"}');
	// $dataSpri = explode(array(",", ":"), $dataSpri);


$txt .= '<div class="form-group row">
	<label for="'.$instanc->Field.'" class="col-sm-2 col-form-label">'.($instanc->Comment ? $comment : $instanc->Field).' '.$span.' : </label>
	<div class="col-sm-10">';

	foreach ($dataSpri as $key => $value) {
		$txt .= '
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="'.$instanc->Field.'" ng-model="'.$table.'Instance.'.$instanc->Field.'" ng-value="\''.$key.'\'" id="'.$instanc->Field.''.$key.'">
			<label class="form-check-label" for="'.$instanc->Field.''.$key.'"> : '.$value.'</label>
		</div>';
	}


$txt .= '
	</div>
</div>

';

}
?>