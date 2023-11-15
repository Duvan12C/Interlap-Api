<?php

require_once('../newConnectionDB.php');

$json = file_get_contents('php://input');

$dataBody = json_decode($json);
ob_clean(); 


$userName = $dataBody->userName;

// //Se crea el script para validar si el usuario es un medico
$queryToCheckCatFromUser = "select cat from medicos where login='$userName'";
$checkCategoryResult = $conn->query($queryToCheckCatFromUser);


$categoryFoundInDoctors = $checkCategoryResult->num_rows;

if($categoryFoundInDoctors < 1) {
    $arr = array('success' => false, 'message' => 'No existe este usuario como médico');

   ob_clean(); 
    echo json_encode($arr);
} else {

    $queryToFindUserCategory = "(SELECT cat FROM medicos WHERE (login LIKE '%$userName%') LIMIT 1)";
    $userCategoryResult = $conn->query($queryToFindUserCategory);

    if($userCategoryResult->num_rows > 0) {
        while ($row = $userCategoryResult->fetch_assoc()) {
            $userCategoryFound = $row['cat'];
        }

        if($userCategoryFound != "Cirujano"){ 
            $arr = array('success' => false, 'message' => 'Sólo los médicos cirujanos pueden programar cirugías');
           ob_clean(); 
            echo json_encode($arr);
        } else {
            $arr = array('success' => true, 'message' => 'Puedes continuar con la programación de cirugia!');
           ob_clean(); 
            echo json_encode($arr);
        }
    }
}

$conn->close();

?>