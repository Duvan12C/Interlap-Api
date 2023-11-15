<?php

require_once('../newConnectionDB.php');

$actionType = $_GET['action'];

$json = file_get_contents('php://input');
$dataBody = json_decode($json);
$studyBody = json_decode($json);


date_default_timezone_set("America/El_Salvador");

$currentDate = date("Y-m-d");
$currentTime = date("H:i");

$patientId = $dataBody->patientId;

if($actionType == "getStudies") {
    // Get data from table
    $sql = "select ordenid,fecha,datosclinicos,usuario from rayosx2 where pid='$patientId' order by id desc";
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
} else if ($actionType == "getStudyDetails") {

    $orderId = $dataBody->extraDetails;

    $studyDetailQuery = "select * from rayosx where ordenid='$orderId'";
    $studyDetailResult = $conn->query($studyDetailQuery);

    if ($studyDetailResult->num_rows > 0) {
        $data = array();
        // Output data of each row
        while($row = $studyDetailResult->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
    } else {
        $emptyArray = array();
        echo json_encode($emptyArray);
    }

    $conn->close();
} else if ($actionType == "addRecipe") {

    $doctor = $dataBody->doctor;
    $receipeDetails = $dataBody->details;
    $price = $dataBody->extraDetails;

    $addRecipeQuery = "insert into recetas (pid,detalle,fecha,hora,usuario,costoconsulta) values ('$patientId','$receipeDetails','$currentDate','$currentTime','$doctor','$price')";
    $addRecipeResult = $conn->query($addRecipeQuery);

    if($addRecipeResult->connect_error) {
        $arr = array('success' => false, 'message' => 'Something went wrong');
        echo json_encode($arr);
    } else {
        $arr = array('success' => true, 'message' => 'Gracias, Su receta se agrego exitosamente');
        echo json_encode($arr);
    }

    $conn->close();

} else if ($actionType == "updateCabinetStudy") {

    $id = $studyBody->id;
    $result = $studyBody->result;
    $vtValue = $studyBody->vtValue;
    $vcValue = $studyBody->vcValue;
    $fev1Value = $studyBody->fev1Value;
    $fev1vcValue = $studyBody->fev1vcValue;
    $feValue = $studyBody->feValue;
    $faValue = $studyBody->faValue;
    $mvValue = $studyBody->mvValue;
    $pvValue = $studyBody->pvValue;
    $hpValue = $studyBody->hpValue;


    $updateQuery = "update rayosx set resultado='$result',vt='$vtValue',vc='$vcValue',fev1='$fev1Value',fev1vc='$fev1vcValue',fe='$feValue',fa='$faValue',mv='$mvValue',pv='$pvValue',hp='$hpValue' where id='$id'";
    
    $result = $conn->query($updateQuery);

    if($result->connect_error) {
        $arr = array('success' => false, 'message' => 'Something went wrong updating indication to group');
        echo json_encode($arr);
    } else {
        $arr = array('success' => true, 'message' => "Estudio actualizado exitosamente");
        echo json_encode($arr);
    }

    $conn->close();
} else {
    http_response_code(400);
}


?>