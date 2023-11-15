<?php
require_once('../newConnectionDB.php');

$json = file_get_contents('php://input');
ob_clean();
$dataBody = json_decode($json);

$user = $dataBody->user;
$nameC = $dataBody->name;
$serviceType = $dataBody->serviceType;
$surgeryType = $dataBody->surgeryType;
$time = $dataBody->duration;
$days = $dataBody->days;
$anesthesiaType = $dataBody->anesthesiaType;
$age = $dataBody->age;
$diseasesList = $dataBody->diseasesList;
$electroSurgery = $dataBody->electroSurgery;
$otherEquipment = $dataBody->otherEquipment;
$suppliesList = $dataBody->suppliesList;
$examsList = $dataBody->examsList;
$area = $dataBody->area;
$additionalInfo = $dataBody->additionalInfo;
$amount = $dataBody->amount;

$suppliesArray = explode('|', $suppliesList);
$uniqueSupplyNames = [];

$examsArray = explode('|', $examsList);
$uniqueExamNames = [];

$concatenatedInsumos = "";
$concatenatedExamenes = "";

if(!empty($suppliesArray) ){
    foreach ($suppliesArray as $element) {
        $fields = explode(', ', $element);
        $itemid = intval($fields[0]);
        $codigo = intval($fields[1]);
        $nombreInsumo = $fields[2];
        $precio = floatval($fields[4]);
        $cantidad = intval($fields[5]);
        $tipo = $fields[3];
    
        $uniqueSupplyNames[] = $nombreInsumo;
        $concatenatedInsumos .= $nombreInsumo . ', ';
        // No se necesita preparar una sentencia aquí, ya que estamos guardando los datos temporalmente
        $suppliesData[] = [$codigo, $nombreInsumo, $itemid, $precio, $cantidad, $tipo];
    }
}

if(!empty($examsArray)){
    foreach ($examsArray as $element) {
        $fields = explode(', ', $element);
        $itemid = intval($fields[0]);
        $codigo = intval($fields[1]);
        $nombreExamen = $fields[2];
        $precio = floatval($fields[4]);
        $cantidad = intval($fields[5]);
        $tipo = $fields[3];
    
        $uniqueExamNames[] = $nombreExamen;
        $concatenatedExamenes .= $nombreExamen . ', ';
        // No se necesita preparar una sentencia aquí, ya que estamos guardando los datos temporalmente
        $examsData[] = [$codigo, $nombreExamen, $itemid, $precio, $cantidad, $tipo];
    }
}


$concatenatedInsumos = !empty($concatenatedInsumos) ? $concatenatedInsumos : '';
$concatenatedExamenes = !empty($concatenatedExamenes) ? $concatenatedExamenes : '';

$concatenatedTotal = trim($concatenatedInsumos . ', ' . $concatenatedExamenes, ', ');

date_default_timezone_set("America/El_Salvador");
$currentDate = date("Y-m-d");

$sql = "INSERT INTO cotizar (especialidad, cirugia, tipo_cirugia, paquete, tiempo, dias, anestesia, edad, otros, info, fecha, usuario, enfermedades, equipo_coagulacion, otro_equipo, area_utilizar, monto) VALUES ('', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmtCotizar = $conn->prepare($sql);
$stmtCotizar->bind_param('ssssssssssssssss', $nameC, $surgeryType, $serviceType, $time, $days, $anesthesiaType, $age, $concatenatedTotal, $additionalInfo, $currentDate, $user, $diseasesList, $electroSurgery, $otherEquipment, $area, $amount);

if ($stmtCotizar->execute()) {
    // Obtener el último ID generado en la tabla "cotizar"
    $lastInsertedID = $conn->insert_id;

    // Verifica si las variables $suppliesList y $examsList no están vacías antes de ejecutar las consultas
    if (!empty($suppliesList)) {
        // Ahora que tenemos el último ID, podemos insertar los datos en "cotizar_insumos" con el ID correcto
        $stmtInsertInsumos = $conn->prepare("INSERT INTO cotizar_insumos (codigo, nombre, itemid, precio, cantidad, tipo, id_cotizar) VALUES (?, ?, ?, ?, ?, ?, ?)");

        foreach ($suppliesData as $data) {
            list($codigo, $nombreInsumo, $itemid, $precio, $cantidad, $tipo) = $data;
            $stmtInsertInsumos->bind_param('isisisi', $codigo, $nombreInsumo, $itemid, $precio, $cantidad, $tipo, $lastInsertedID);
            $stmtInsertInsumos->execute();
        }
        $stmtInsertInsumos->close();
    }

    
    if(!empty($examsList)){
        $stmtInsertInsumos = $conn->prepare("INSERT INTO cotizar_insumos (codigo, nombre, itemid, precio, cantidad, tipo, id_cotizar) VALUES (?, ?, ?, ?, ?, ?, ?)");
        foreach ($examsData as $data) {
            list($codigo, $nombreExamen, $itemid, $precio, $cantidad, $tipo) = $data;
            $stmtInsertInsumos->bind_param('isisisi', $codigo, $nombreExamen, $itemid, $precio, $cantidad, $tipo, $lastInsertedID);
            $stmtInsertInsumos->execute();
        }
        $stmtInsertInsumos->close();
    }

    $arr = array('success' => true, 'message' => 'Surgery quote completed successfully');
    ob_clean();
    echo json_encode($arr);
} else {
    $arr = array('success' => false, 'message' => 'Something went wrong');
    ob_clean();
    echo json_encode($arr);
}

$stmtCotizar->close();
$conn->close();
