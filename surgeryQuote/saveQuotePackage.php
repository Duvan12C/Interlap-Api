<?php

require_once('../newConnectionDB.php');

$userName = $_GET['user'];

$json = file_get_contents('php://input');
ob_clean(); 
$dataBody = json_decode($json);

$speciality = $dataBody -> speciality;
$surgery = $dataBody -> surgery;
$surgeryType = $dataBody -> surgeryType;
$time = $dataBody -> time;
$days = $dataBody -> days;
$anesthesiaType = $dataBody -> anesthesiaType;
$electroSurgery = $dataBody -> electroSurgery;
$totalElectro = $dataBody -> totalElectro;
$suppliesList = $dataBody -> suppliesList;
$totalSupplies = $dataBody -> totalSupplies;
$otherEquipment = $dataBody -> otherEquipment;
$totalEquipment = $dataBody -> totalEquipment;
$services = $dataBody -> services;
$totalServices = $dataBody -> totalServices;
$exams = $dataBody -> exams;
$totalExams = $dataBody -> totalExams;
$food = $dataBody -> food;
$totalFood = $dataBody -> totalFood;
$additionalInfo = $dataBody -> additionalInfo;
$price = $dataBody -> price;


$otros = $electroSurgery." - ".$suppliesList." - ".$otherEquipment." - ".$services." - ".$exams." - ".$food;


date_default_timezone_set("America/El_Salvador");
$currentDate = date("Y-m-d");

// //Especialidad enviar vacio - otros = supplies
$sql = "insert into cotizar (especialidad,cirugia,tipo_cirugia,paquete,tiempo,dias,anestesia,edad,otros,info,fecha,usuario,enfermedades,equipo_coagulacion,otro_equipo,area_utilizar,monto) values ('$speciality','$surgery','$surgeryType','Economico','$time','$days','$anesthesiaType','','$otros','$additionalInfo','$currentDate','$userName','','','','Quirofano','$price')";
            

$result = $conn->query($sql);

if($result->connect_error) {
    $arr = array('success' => false, 'message' => 'Something went wrong');
    ob_clean(); 
    echo json_encode($arr);
} else {
    require("send_Emails.php");
    
    $arr = array('success' => true, 'message' => 'Surgery quote completed successfully');
    ob_clean(); 
    echo json_encode($arr);
    
    include('send_Email.php');
}


$conn->close();

?>