<?php
function i18nmassages($conn, $tableIns, $fileIns){
$table = $tableIns['TABLE_NAME'];
    $c= "";
    $th = '"Th": {';
    $en = '"En": {';
    
    $sql = "SHOW FULL COLUMNS FROM ".$table." WHERE Extra!='auto_increment' ";
	$excute = mysqli_query($conn, $sql);
	while ($instanc = mysqli_fetch_object($excute)){
        $label = $instanc->Comment ? $instanc->Comment : $instanc->Field;
        $th .= $c.'
        "'.$instanc->Field.'": "'.$label.'"';
        $en .= $c.'
        "'.$instanc->Field.'": "'.$instanc->Field.'"';
        $c = ",";
    }

    $th .= '
    },';
    $en .= '
    }';

    $txt = '{'.$th.$en.'
}';
    return $txt;
}
?>
