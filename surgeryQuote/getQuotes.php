<?php

require_once('../newConnectionDB.php');

$actionType = $_GET['action'];

$json = file_get_contents('php://input');
$dataBody = json_decode($json);

$userName = $dataBody->doctor;
$quoteId = $dataBody->extraDetails;
$packageSurgeryName = $dataBody->extraDetails;

if($actionType == "getList") {
    // Get data from table
    $sql = "select * from cotizar where usuario='$userName' order by id desc,fecha desc";
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
} else if ($actionType == "getQuoteSupplies") {
    $sql = "select * from cotizar_insumos where id_cotizar='$quoteId'";
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

} else if ($actionType == "getPackageDetails"){

    $sql = "select * from paquetes_preestablecidos where cirugia='$packageSurgeryName'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $data = array();
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            $id_paq = $row['id'];
        }

        $queryToPackageSupplies = "select * from med_ins_preestablecidos where id_cirugia='$id_paq'";
        $resultPkgSupplies = $conn->query($queryToPackageSupplies);

        if ($resultPkgSupplies->num_rows > 0) {
            while($row = $resultPkgSupplies->fetch_assoc()) {
                $data[] = $row;
            }

       ob_clean();     
            echo json_encode($data);
        } else {
            $emptyArray = array();
       ob_clean();     
            echo json_encode($emptyArray);
        }

      ob_clean();   //
         echo json_encode($data);
    } else {
        $emptyArray = array();
       ob_clean(); 
        echo json_encode($emptyArray);
    }

    $conn->close();


} else {
    http_response_code(400);
}

?>