<?php
header('Content-Type: application/json'); // Establece la cabecera de respuesta como JSON

require_once('../newConnectionDB.php');

if (isset($_GET['pid'])) {
    $pid = (int)$_GET['pid'];

    // Consulta para obtener todas las imágenes del paciente con un pid específico.
    $sql = "SELECT * FROM fotos WHERE pid = $pid";
    $result = $conn->query($sql);

    $imageData = array(); // Un arreglo para almacenar los datos de las imágenes en formato base64

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $nombreImagen = $row["nombre"];
            $rutaImagen = "images/" . $nombreImagen; // Supongo que las imágenes están en el directorio 'images'

            // Leer el contenido de la imagen en formato base64
            $base64Image = base64_encode(file_get_contents($rutaImagen));

            // Agregar el contenido base64 de la imagen al arreglo
            $imageData[] = array(
                "nombre" => $nombreImagen,
                "base64" => $base64Image
            );
        }

        // Devuelve el arreglo de datos de imágenes en formato base64 como JSON
        echo json_encode($imageData);
    } else {
        // Si no se encontraron imágenes, devolver un arreglo vacío en JSON
        echo json_encode(array());
    }
} else {
    // Si falta el parámetro 'pid', devolver un mensaje de error en JSON
    echo json_encode(array("error" => "Falta el parámetro 'pid'."));
}

$conn->close();
?>
