<?php 
include("../conf/_connect.php");
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('Asia/Bangkok');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$action = isset($_GET['action']) ? $_GET['action'] : null;

$json = array();
$c="";
$mass="";
$col = "";	$val = "";	$c="";

switch ($action) {

	case 'show_table':
		$sql = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE table_schema = '".$database."'";
		$query = mysqli_query($conn, $sql);

		while ($instance=mysqli_fetch_assoc($query)) {	/*$json.=$c;
			$json.= json_encode($instance);
			$c=',';*/

			$json['instance'][] = $instance;
		}
	break;

	case 'getFoderInstance':
		//$file = "../view/Layout";
		$foder = "../app/".$_GET['forderName'];
		if (is_dir($foder)){
			$json['message']="yes";
			if ($handle = opendir($foder)) {
				while (false !== ($entry = readdir($handle))) {
					if (strlen($entry)>5){ 

						$json['instance'][] = $entry;
					}
				}
				closedir($handle);
			}

			$file = ($_GET['forderName']);
			if (file_exists("../controller/".$file."Controller.js")){ 
				// $json.=$c; 
				// $json.=json_encode($file."Controller.js"); 
				// $c=",";
				$json['instance'][]=$file."Controller.js";
			}

			if (file_exists("../model/".$file."Controller.php")){ 
				// $json.=$c; 
				// $json.=json_encode($file."Controller.php"); 
				// $c=",";
				$json['instance'][]=$file."Controller.php";
			}
			// $json.=$c;
			$json['instance'][] = "1";
		}else{
			$json['message']="no";
		}

	break;

	case 'createForder':
		$foder = "../app/".$_GET['forderName'];
		//$message = "Success";
		if (!mkdir($foder, 0777, true)) {
			$mass .= ('Failed to create view folders.');
		}else{
			$foder = "../app/".$_GET['forderName']."/controller";
			//$message = "Success";
			if (!mkdir($foder, 0777, true)) {
				$mass .= (' Failed to create controller folders.');
			}

			$foder = "../app/".$_GET['forderName']."/i18n";
			//$message = "Success";
			if (!mkdir($foder, 0777, true)) {
				$mass .= (' Failed to create i18n folders.');
			}

			$foder = "../app/".$_GET['forderName']."/model";
			//$message = "Success";
			if (!mkdir($foder, 0777, true)) {
				$mass .= (' Failed to create model folders.');
			}

			$foder = "../app/".$_GET['forderName']."/view";
			//$message = "Success";
			if (!mkdir($foder, 0777, true)) {
				$mass .= (' Failed to create view folders.');
			}
		}

		
	break;

	case 'createFile':	

		$table = $_POST['table'];
		$files = $_POST['files'];
		$functionFile = $files['path'].($files['path']=='controller' ? "Controller.php" : ($files['file'] ? $files['file'] : ($files['path']=='i18n' ? 'massages.php' : 'index.php')));
		
		$filname = "../app/".$table['TABLE_NAME']."/".$files['path']."/";

		if ($files['path']=='controller'){
			$filname .= $table['TABLE_NAME']."Controller.js";
		}else if ($files['path']=='view'){
			$filname .= $files['file'];
		}else{
			$filname .= ($files['file'] ? $table['TABLE_NAME'].$files['file'] : ($files['path']=='i18n' ? 'massages.json' : 'index.php'));
		}

		$functionName = str_replace(".php", "", $functionFile);

		include("generate/".$functionFile);
		$table['database'] = $database;
		$html = $functionName($conn, $table, $files);

		$objCreate = fopen($filname, 'wb');
		$ex = fwrite($objCreate, $html);
		if($objCreate){
			$json['message'] = "File Created.";
		}
		else{
			$json['message'] = "File Not Create.";
		}
		fclose($objCreate);
		chmod($filname, 0777);

		$json['filname'] = $filname;
		$json['functionFile'] = $functionFile;

		// $json['functionName'] = $functionName;
		// $json['result'] = $html;
	break;
}
	
mysqli_close($conn);
echo json_encode($json);
?>
