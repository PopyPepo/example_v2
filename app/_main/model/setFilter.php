<?php
function setFilter($filter){
	$condition = "";
	$c = "";
	foreach ($filter as $key=>$value) {
		$condition .= $c;
		$condition .= $key."='".$value."'";
		$c = " AND ";
	}

	return $condition;
}
?>