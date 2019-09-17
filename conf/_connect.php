<?php
$servername = "203.158.3.10";
$database = "scholaship";
$username = "pepo";
$password = "meroot";


// Create connection
$conn = new mysqli($servername, $username, $password, $database);
$conn->set_charset("utf8");

if ($conn->connect_error) {
	$json['connect'] = ("Connection failed: " . $conn->connect_error);
	mysqli_close($conn);
	$json["date_now"] = date("Y-m-d H:i:s");
	echo json_encode($json);
	die();
}
?>