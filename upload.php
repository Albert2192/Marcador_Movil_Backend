<?php
header("Access-Control-Allow-Origin: *"); // Permite el acceso desde cualquier origen
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // Métodos permitidos
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept"); // Encabezados permitidos

/* header('Content-Type: application/json'); */

// Verifica si hay un archivo cargado
if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($_FILES['photo']['name']);

    // Crea el directorio de destino si no existe
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Mueve el archivo cargado a la ubicación deseada
    if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
        $response = array(
            'status' => 'success',
            'message' => 'Archivo cargado exitosamente.',
            'path' => $uploadFile
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Error al mover el archivo cargado.'
        );
    }
} else {
    $response = array(
        'status' => 'error',
        'message' => 'No se cargó ningún archivo o hubo un error en la carga.'
    );
}

echo json_encode($response);
?>
