<?php

require_once('../newConnectionDB.php');
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', 'C:/xampp/htdocs/app/scheduleSurgery/php_error_log');
date_default_timezone_set("America/El_Salvador");

$doctorType = $_GET['doctorType'];
$surgeryCategory = $_GET['surgeryCategory'];
$queryValue = $_GET['queryValue'];
error_log('doctorType: ' . $_GET['doctorType']);
error_log('surgeryCategory: ' . $_GET['surgeryCategory']);
error_log('queryValue: ' . $_GET['queryValue']);

if($doctorType == "surgeon") {
    $sql = "(SELECT login,nombre FROM medicos WHERE (nombre LIKE '%$queryValue%' or login LIKE '%$queryValue%') and subcat1='$surgeryCategory' or subcat2='$surgeryCategory' or subcat3='$surgeryCategory') order by login asc";
} else if($doctorType == "surgeonFilter") {
    $sql = "(SELECT login,nombre FROM medicos WHERE (nombre LIKE '%$queryValue%' or login LIKE '%$queryValue%')) order by login asc";
} else {
    $sql = "(SELECT login,nombre FROM medicos WHERE (nombre LIKE '%$queryValue%' or login LIKE '%$queryValue%') and (login != 'Drortiz' and login != 'jumanzor' and login != 'jportillo') and cat='Anestesista') order by login asc";
}

// Get data from table
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = array();
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    $emptyArray = array();
    echo json_encode($emptyArray);
}

$conn->close();

?>

