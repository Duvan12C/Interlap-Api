<?php

require_once('../newConnectionDB.php');

$actionType = $_GET['action'];

$json = file_get_contents('php://input');
$dataBody = json_decode($json);

$patientId = $dataBody->patientId;
$selectedGroupId = $dataBody->extraDetails;

date_default_timezone_set("America/El_Salvador");

$currentDate = date("Y-m-d");
$currentTime = date("H:i");

if($actionType == "getVitalSignsGroupList") {
    $sql = "select * from signosindex where pid='$patientId' order by fechacirugia desc,id desc";

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

} else if($actionType == "getVitalSignsDetailList") {
    $sql = "select * from signos where procedimiento='$selectedGroupId' order by fecha asc,id asc LIMIT 10";

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

} else if ($actionType == "addGroup") {

    $surgeryName = $dataBody->surgeryName;
    $room = $dataBody->room;
    $surgeryDate = $dataBody->surgeryDate;
    $doctor = $dataBody->doctor;


    $queryToValidateDate = "select id from signosindex where fechacirugia='$surgeryDate' and pid='$patientId'";
    $validateDate = $conn->query($queryToValidateDate);

    if ($validateDate->num_rows > 0) {
        while ($row = $validateDate->fetch_assoc()) {
            $countId= $row['id'];
        }

        if ($countId != "") {
            $arr = array('success' => false, 'message' => 'Ya existe un grupo con esta fecha');
            echo json_encode($arr);
        }
        
    }

    if($countId == "") {
        $queryAdd = "insert into signosindex (pid,tipodecirugia,habitacion,fechacirugia,fecha,hora,usuario) values ('$patientId','$surgeryName','$room','$surgeryDate','$currentDate','$currentTime','$doctor')";
        $addResult = $conn->query($queryAdd);

        if($addResult->connect_error) {
            $arr = array('success' => false, 'message' => 'Something went wrong adding group');
            echo json_encode($arr);
        } else {

            $queryToLastGroup = "select max(id) from signosindex";
            $resultOfLastGroup = $conn->query($queryToLastGroup);

            if($resultOfLastGroup->num_rows > 0) {
                while ($row = $resultOfLastGroup->fetch_assoc()) {
                    $lastGroupId = $row['max(id)'];
                }
            }
            $arr = array('success' => true, 'message' => $lastGroupId);
            echo json_encode($arr);
        }
    }

    $conn->close();
} else if ($actionType == "addSign") {

    $groupId = $dataBody->groupId;
    $pulse = $dataBody->pulse;
    $taValue = $dataBody->taValue;
    $frValue = $dataBody->frValue;
    $satValue = $dataBody->satValue;
    $temValue = $dataBody->temValue;
    $drenValue = $dataBody->drenValue;
    $diurValue = $dataBody->diurValue;
    $otherOne = $dataBody->otherOne;
    $otherTwo = $dataBody->otherTwo;
    $otherThree = $dataBody->otherThree;
    $doctor = $dataBody->doctor;
    $ta2Value = $dataBody->ta2Value;

    $addSignQuery = "insert into signos (procedimiento,fecha,hora,pulso,ta,fr,sat02,temp,dreno,diuresis,otro1,otro2,otro3,usuario,ta2) values ('$groupId','$currentDate','$currentTime','$pulse','$taValue','$frValue','$satValue','$temValue','$drenValue','$diurValue','$otherOne','$otherTwo','$otherThree','$doctor','$ta2Value')";
    $addResult = $conn->query($addSignQuery);

    if($addResult->connect_error) {
        $arr = array('success' => false, 'message' => 'Something went wrong updating surgery');
        echo json_encode($arr);
    } else {
        $arr = array('success' => true, 'message' => 'Signos agregados exitosamente');
        echo json_encode($arr);
    }

    $conn->close();
} else {
    http_response_code(400);
}


?>