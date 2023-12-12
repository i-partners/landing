<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $archivo = $_FILES['archivo'];

    // Verificar si no hay errores durante la subida
    if ($archivo['error'] !== UPLOAD_ERR_OK) {
        echo json_encode(['error' => 'Error durante la subida del archivo']);
        exit();
    }

    // Definir la carpeta de destino para el archivo
    $carpetaDestino = 'archivos_subidos/';

    // Crear la carpeta de destino si no existe
    if (!file_exists($carpetaDestino)) {
        mkdir($carpetaDestino, 0777, true);
    }

    // Construir la ruta completa de destino del archivo
    $rutaDestino = $carpetaDestino . $archivo['name'];

    // Mover el archivo a la carpeta de destino
    if (move_uploaded_file($archivo['tmp_name'], $rutaDestino)) {
        echo json_encode(['mensaje' => 'Archivo subido con éxito']);
    } else {
        echo json_encode(['error' => 'Error al mover el archivo']);
    }
} else {
    echo json_encode(['error' => 'Método no permitido']);
}
?>
