<?php
function memberList($conn){
	$json = array();
	
	$perPage = isset($_GET["perPage"]) ? $_GET["perPage"] : 10;
	$page = isset($_GET["page"]) ? $_GET["page"] : 1;
	$pageStart = ($page-1)*$perPage;

	$sql = "SELECT * FROM member LIMIT ".$pageStart.",".$perPage;
	$query = mysqli_query($conn, $sql);
	$json["instance"] = array();
	while ($instance=mysqli_fetch_assoc($query)) {
		$json["instance"][] = $instance;
	}

	$sqlCount = "SELECT count(id) AS total FROM member";
	$query = mysqli_query($conn, $sqlCount);
	$total = mysqli_fetch_assoc($query);

	$json['pagination'] = array();
	$json['pagination']['total'] = intval($total['total']);
	$json['pagination']['page'] = intval($page);
	$json['pagination']['pageStart'] = intval($pageStart);
	$json['pagination']['perPage'] = intval($perPage);

	return $json;
}	
?>