<?php 

require_once('../newConnectionDB.php');

$patientId = $_GET['patient'];
$doctor = $_GET['doctor'];
$user = $_GET['user'];

$json = file_get_contents('php://input');

$dataBody = json_decode($json);


if($patientId != ""){

    $createdDate = date("Y-m-d");

    $examenes = array();
    $examenes = $dataBody;
    $examenesnum = count($examenes);

    $firstExamValue = $examenes[0]->id;


    $sql = "select max(ordenid) from rayosx2";
    $getLastOrderResult = $conn->query($sql);

    while ($row = $getLastOrderResult->fetch_assoc()) {
        $resinforden = $row['max(ordenid)'];
    }

    if ($resinforden == ""){
        $ordenid = 1;
    }else{
        $ordenid = $resinforden+1;
    }


    // Agregar a laboratorio2
    $insertOrderQuery = "insert into rayosx2 (pid,ordenid,fecha,datosclinicos,usuario) values ('$patientId','$ordenid','$createdDate','','$doctor')";
    $insertOrderResult = $conn->query($insertOrderQuery);


    //Agregar a laboratorio

    for($i=0;$i<$examenesnum;$i++){
        $selectedExam = $examenes[$i]->id;

        if($selectedExam == "perfil1"){
            mysqli_query($conn,"insert into rayosx (ordenid,examen,texto) values ('$ordenid','Rayos X Torax PA','')");
            mysqli_query($conn,"insert into rayosx (ordenid,examen,texto) values ('$ordenid','USG Abdominal','')");
            mysqli_query($conn,"insert into rayosx (ordenid,examen,texto) values ('$ordenid','Electrocardiograma','')");
            mysqli_query($conn,"insert into rayosx (ordenid,examen,texto) values ('$ordenid','Espirometria','')");
        } else  if($selectedExam == "perfil2"){
            mysqli_query($conn,"insert into rayosx (ordenid,examen,texto) values ('$ordenid','Rayos X Torax PA','')");
            mysqli_query($conn,"insert into rayosx (ordenid,examen,texto) values ('$ordenid','USG Abdominal','')");
            mysqli_query($conn,"insert into rayosx (ordenid,examen,texto) values ('$ordenid','Electrocardiograma','')");
            mysqli_query($conn,"insert into rayosx (ordenid,examen,texto) values ('$ordenid','Espirometria','')");
            mysqli_query($conn,"insert into rayosx (ordenid,examen,texto) values ('$ordenid','Ecocardiograma','')");
            mysqli_query($conn,"insert into rayosx (ordenid,examen,texto) values ('$ordenid','Polisonografia del Sueno','')");
        } else{
            $firstExamValue = $examenes[$i]->name;
            mysqli_query($conn,"insert into rayosx (ordenid,examen) values ('$ordenid','$firstExamValue')");
        }
    }


    $firstExamValue = $selectedExam->id;
    $arr = array('success' => true, 'message' => "Cabinet studies created with the number $ordenid");

    echo json_encode($arr);

    $conn->close();
}else{

    $arr = array('success' => false, 'message' => "Patient not found");

    echo json_encode($arr);

    $conn->close();

}


?>
