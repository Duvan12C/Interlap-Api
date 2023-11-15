<?php

require_once('../newConnectionDB.php');

$actionType = $_GET['action'];

$json = file_get_contents('php://input');
$dataBody = json_decode($json);


date_default_timezone_set("America/El_Salvador");

$currentDate = date("Y-m-d");
$currentTime = date("H:i");

$patientId = $dataBody->patientId;

if($actionType == "getRecipes") {
    // Get data from table
    $sql = "select * from recetas where pid='$patientId' order by fecha desc,id desc limit 4";
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
} else if ($actionType == "getQuickRecipes") {

    $quickRecipesQuery = "select id,nombre,detalle from recetasrapidas order by nombre asc";
    $quickRecipesResult = $conn->query($quickRecipesQuery);

    if ($quickRecipesResult->num_rows > 0) {
        $data = array();
        // Output data of each row
        while($row = $quickRecipesResult->fetch_assoc()) {
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

} else {
    http_response_code(400);
}


?>

