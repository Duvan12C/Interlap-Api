<?php

require_once('../newConnectionDB.php');
ini_set('display_errors',1);
ini_set('log_errors',1);
ini_set('error_log', 'C:/xampp/htdocs/app/common/php_error_log');
$itemType = $_GET['type'];

$queryValue = $_GET['queryValue'];
$queryValue = utf8_decode($queryValue);
error_log('queryValue: ' . $itemType);

if($itemType == "exam") {
$sql = "(SELECT id,codigo,nombre,tipo,cantidad,via,precio FROM examenes WHERE (nombre LIKE '%$queryValue%' or codigo LIKE '%$queryValue%') and activo='y') LIMIT 20";
} else {
$sql = "(SELECT id,codigo,nombre,tipo,cantidad,via,precio FROM productos WHERE (nombre LIKE '%$queryValue%' or codigo LIKE '%$queryValue%') and activo='y' and cantidad > 0) UNION (SELECT id,codigo,nombre,tipo,cantidad,via,costo FROM medicamentos WHERE (nombre LIKE '%$queryValue%' or codigo LIKE '%$queryValue%') and activo='y' and cantidad > 0) UNION (SELECT id,codigo,nombre,tipo,cantidad,via,costo FROM alimentos WHERE (nombre LIKE '%$queryValue%' or codigo LIKE '%$queryValue%') and activo='y') LIMIT 20";
}


$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = array();
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    ob_clean(); 
    echo json_encode($data);
} else {
    $emptyArray = array();
    ob_clean(); 
    echo json_encode($emptyArray);
}

$conn->close();

?>