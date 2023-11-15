<?php

require_once('../newConnectionDB.php');

$actionType = $_GET['action'];

$json = file_get_contents('php://input');
$dataBody = json_decode($json);

$patientId = $dataBody->patientId;

date_default_timezone_set("America/El_Salvador");

$currentDate = date("Y-m-d");
$currentTime = date("H:i");

if($actionType == "getFirst") {
    $sql = "SELECT * FROM primeraciru WHERE pid='$patientId'";

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

} else if ($actionType == "addFirst") {

    $doctor = $dataBody->doctor;

    $insertFirstQuery = "insert into primeraciru (pid,fecha,hora,usuario) values ('$patientId','$currentDate','$currentTime','$doctor')";
    $insertQueryResult = $conn->query($insertFirstQuery);

    if($insertQueryResult->connect_error) {
        $arr = array('success' => false, 'message' => 'Something went wrong adding first');
        echo json_encode($arr);
    } else {
        $arr = array('success' => true, 'message' => 'Gracias, Su primera cirugia ha sido agregada exitosamente');
        echo json_encode($arr);
    }

    $conn->close();
} else if ($actionType == "update") {

    $patientId = $dataBody->patientId;
    $currentIllness = $dataBody->currentIllness;
    $paValue = $dataBody->paValue;
    $pulseValue = $dataBody->pulseValue;
    $frValue = $dataBody->frValue;
    $temValue = $dataBody->temValue;
    $complementaryPhysical = $dataBody->complementaryPhysical;
    $personalHistory = $dataBody->personalHistory;
    $plan = $dataBody->plan;
    $observations = $dataBody->observations;
    $diagnosis = $dataBody->diagnosis;
    $nextAppointment = $dataBody->nextAppointment;

    $updateSurgeryQuery = "update primeraciru set presenteenfermedad1a='$currentIllness',pa1a='$paValue',pulso1a='$pulseValue',fr1a='$frValue',t1a='$temValue',complementofisico1a='$complementaryPhysical',antecedentes='$personalHistory',plan='$plan',observaciones='$observations',complementodiagnostico1a='$diagnosis',proximacita='$nextAppointment' where pid='$patientId'";
    $updateResult = $conn->query($updateSurgeryQuery);
    if($updateResult->connect_error) {
        $arr = array('success' => false, 'message' => 'Something went wrong updating surgery');
        echo json_encode($arr);
    } else {
        $arr = array('success' => true, 'message' => 'Gracias, Su cirugia se ha actualizada exitosamente');
        echo json_encode($arr);
    }

    $conn->close();
} else if ($actionType == "getSurgeryList") {
    // Get data from table
    $sql = "select * from cirugia where pid='$patientId' order by id desc";
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
}  else if ($actionType == "getSurgeryHistory") {
    // Get data from table
    $currentDate = date("Y-m-d");

    $sql = "select * from cirugias where pid='$patientId' and fechacirugia <= '$currentDate' order by fechacirugia desc";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $data = array();
        // Output data of each row
        while($row = $result->fetch_assoc()) {


            $mainSurgeon = $row['cirujanoprincipal'];
            $anesthesiologist = $row['anestesiologo'];
            $firstHelper = $row['primerayudante'];
            $secondHelper = $row['segundoayudante'];

            $querySurgeon = "select nombre from medicos where login='$mainSurgeon'";
            $resultSurgeon = $conn->query($querySurgeon);

            while ($rowSurgeon = $resultSurgeon->fetch_assoc()) {
                $surgeonName = $rowSurgeon['nombre'];
            }
            $row['cirujanoprincipal'] = $surgeonName;

            if($anesthesiologist != "") {
                $querySurgeon = "select nombre from medicos where login='$anesthesiologist'";
                $resultSurgeon = $conn->query($querySurgeon);

                while ($rowSurgeon = $resultSurgeon->fetch_assoc()) {
                    $surgeonName = $rowSurgeon['nombre'];
                }

                $row['anestesiologo'] = $surgeonName;
            }

            if($firstHelper != "") {
                $querySurgeon = "select nombre from medicos where login='$firstHelper'";
                $resultSurgeon = $conn->query($querySurgeon);

                while ($rowSurgeon = $resultSurgeon->fetch_assoc()) {
                    $surgeonName = $rowSurgeon['nombre'];
                }

                $row['primerayudante'] = $surgeonName;
            }

            if($secondHelper != "") {
                $querySurgeon = "select nombre from medicos where login='$secondHelper'";
                $resultSurgeon = $conn->query($querySurgeon);

                while ($rowSurgeon = $resultSurgeon->fetch_assoc()) {
                    $surgeonName = $rowSurgeon['nombre'];
                }

                $row['segundoayudante'] = $surgeonName;
            }

            $data[] = $row;
        }
        echo json_encode($data);
    } else {
        $emptyArray = array();
        echo json_encode($emptyArray);
    }

    $conn->close();
} else if ($actionType == "addEvolution") {

    $id = $dataBody->id;
    $patientId = $dataBody->patientId;
    $dateCreated = $dataBody->dateCreated;
    $timeCreated = $dataBody->timeCreated;
    $createdBy = $dataBody->createdBy;
    $evolutionDetail = $dataBody->evolutionDetail;
    $leak = $dataBody->leak;
    $thrombosis = $dataBody->thrombosis;
    $seroma = $dataBody->seroma;
    $other = $dataBody->other;
    $otherDescription = $dataBody->otherDescription;
    $complicationsDetail = $dataBody->complicationsDetail;
    $paValue = $dataBody->paValue;
    $pulse = $dataBody->pulse;
    $frValue = $dataBody->frValue;
    $tempValue = $dataBody->tempValue;
    $height = $dataBody->height;
    $currentWeight = $dataBody->currentWeight;
    $plan = $dataBody->plan;
    $nextAppointment = $dataBody->nextAppointment;
    $observations = $dataBody->observations;
    $physicalComplement = $dataBody->physicalComplement;

    $currentDate = date("Y-m-d");
    $currentTime = date("H:i");

    $addQuery = "insert into cirugia (pid,fecha,hora,usuario,evolucion,fuga,trombosis,seroma,otro,otrocual,descripcion,pa,pulso,fr,t,estatura,pesoahorita,plan,proximacita,observaciones,complementoexamenfisico) values ('$patientId','$currentDate','$currentTime','$createdBy','$evolutionDetail','$leak','$thrombosis','$seroma','$other','$otherDescription','$complicationsDetail','$paValue','$pulse','$frValue','$tempValue','$height','$currentWeight','$plan','$nextAppointment','$observations','$physicalComplement')";
    $updateResult = $conn->query($addQuery);
    if($updateResult->connect_error) {
        $arr = array('success' => false, 'message' => 'Something went wrong adding evolution');
        echo json_encode($arr);
    } else {
        $arr = array('success' => true, 'message' => 'Gracias, Su evolucion se agrego exitosamente');
        echo json_encode($arr);
    }

    $conn->close();

} else if ($actionType == "updateEvolution") {
    
    $id = $dataBody->id;
    $evolutionDetail = $dataBody->evolutionDetail;
    $leak = $dataBody->leak;
    $thrombosis = $dataBody->thrombosis;
    $seroma = $dataBody->seroma;
    $other = $dataBody->other;
    $otherDescription = $dataBody->otherDescription;
    $complicationsDetail = $dataBody->complicationsDetail;
    $paValue = $dataBody->paValue;
    $pulse = $dataBody->pulse;
    $frValue = $dataBody->frValue;
    $tempValue = $dataBody->tempValue;
    $currentWeight = $dataBody->currentWeight;
    $plan = $dataBody->plan;
    $nextAppointment = $dataBody->nextAppointment;
    $observations = $dataBody->observations;
    $physicalComplement = $dataBody->physicalComplement;

    $updateQuery = "update cirugia set evolucion='$evolutionDetail',fuga='$leak',trombosis='$thrombosis',seroma='$seroma',otro='$other',otrocual='$otherDescription',descripcion='$complicationsDetail',pa='$paValue',pulso='$pulse',fr='$frValue',t='$tempValue',pesoahorita='$currentWeight',plan='$plan',proximacita='$nextAppointment',observaciones='$observations',complementoexamenfisico='$physicalComplement' where id='$id'";
    $updateResult = $conn->query($updateQuery);

    if($updateResult->connect_error) {
        $arr = array('success' => false, 'message' => 'Something went wrong updating evolution');
        http_response_code(401);
        echo json_encode($arr);
    } else {
        $arr = array('success' => true, 'message' => 'Gracias, Su evolucion se actualizo exitosamente');
        echo json_encode($arr);
    }

    $conn->close();

} else if ($actionType == "addOperativeReport") {
    
    $patientId = $dataBody->patientId;
    $dateCreated = $dataBody->dateCreated;
    $hourCreate = $dataBody->hourCreate;
    $createdBy = $dataBody->createdBy;
    $surgeon = $dataBody->surgeon;
    $firstHelper = $dataBody->firstHelper;
    $secondHelper = $dataBody->secondHelper;
    $anesthesiologist = $dataBody->anesthesiologist;
    $instrument = $dataBody->instrument;
    $anesthesiaFrom = $dataBody->anesthesiaFrom;
    $anesthesiaTo = $dataBody->anesthesiaTo;
    $operationFrom = $dataBody->operationFrom;
    $operationTo = $dataBody->operationTo;
    $surgery = $dataBody->surgery;
    $code = $dataBody->code;
    $postOperative = $dataBody->postOperative;
    $findings = $dataBody->findings;
    $technique = $dataBody->technique;
    $drains = $dataBody->drains;
    $specimens = $dataBody->specimens;
    $room = $dataBody->room;
    $register = $dataBody->register;
    $observations = $dataBody->observations;
    $dxPreOperative = $dataBody->dxPreOperative;
    $preOperative = $dataBody->preOperative;

    $currentTime = date("H:i");

    $addQuery = "insert into operatorio (pid,fecha,hora,usuario,cirujano,primer_ayudante,segundo_ayudante,anestesiologo,instrumentista,anestesiadesdee,anestesiahastaa,operatoriodesdee,operatoriohastaa,otracirugia,codigo,postoperatorio,hallazgo,tecnica,drenajes,especimenes,habitacion,registro,observaciones,dxpreopnew,preoperatorio) values ('$patientId','$dateCreated','$currentTime','$createdBy','$surgeon','$firstHelper','$secondHelper','$anesthesiologist','$instrument','$anesthesiaFrom','$anesthesiaTo','$operationFrom','$operationTo','$surgery','$code','$postOperative','$findings','$technique','$drains','$specimens','$room','$register','$observations','$dxPreOperative','$preOperative')";
    
    $updateResult = $conn->query($addQuery);

    if($updateResult->connect_error) {
        $arr = array('success' => false, 'message' => 'Something went wrong adding Report');
        echo json_encode($arr);
    } else {
        $arr = array('success' => true, 'message' => 'Gracias, Su reporte fue agregado exitosamente');
        echo json_encode($arr);
    }

    $conn->close();

} else {
    http_response_code(400);
}


?>