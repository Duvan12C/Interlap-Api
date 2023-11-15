<?php
require_once('../newConnectionDB.php');

$json = file_get_contents('php://input');
$dataBody = json_decode($json);

$user = $dataBody->user;
$password = $dataBody->password;

$response = array(); // Inicializa un arreglo para la respuesta

$sql = "SELECT id, login, nombre, apellido, email, admin, cat FROM usuarios WHERE login = '$user' AND pwd = '$password' LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $response['success'] = true;
    $response['data'] = $row;
} else {
    $response['success'] = false;
    $response['message'] = 'Wrong user or password';
}

ob_clean(); 
// Establece la cabecera como JSON
header('Content-Type: application/json');

// Imprime la respuesta JSON
// Limpia el búfer de salida

echo json_encode($response);

// Cierra la conexión a la base de datos
$conn->close();
?>
