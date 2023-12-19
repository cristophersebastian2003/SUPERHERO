<?php

// Configura tus credenciales de base de datos aquí
$host = 'localhost';
$usuario = 'root';
$clave = '';
$base_de_datos = 'superhero';

try {
    // Intenta establecer la conexión
    $conexion = new PDO("mysql:host=$host;dbname=$base_de_datos;charset=utf8", $usuario, $clave);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtener el ID del editor desde la solicitud GET
    $editorId = isset($_GET['editorId']) ? $_GET['editorId'] : null;

    // Validar que se proporcionó el ID del editor
    if ($editorId !== null) {
        // Llamada al nuevo procedimiento almacenado spu_superhero_listar_por_editor
        $query = "CALL spu_ObtenerSuperheroesPorEditor_buscar(:editor_id)";
        $stmt = $conexion->prepare($query);
        $stmt->bindParam(':editor_id', $editorId, PDO::PARAM_INT);
        $stmt->execute();

        // Obtener los resultados como un array asociativo
        $superheroes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Devolver los resultados en formato JSON
        header('Content-Type: application/json');
        echo json_encode($superheroes);
    } else {
        // Si no se proporciona el ID del editor, devuelve un error
        http_response_code(400);
        echo json_encode(array('error' => 'ID del editor no proporcionado.'));
    }
} catch (PDOException $e) {
    // Devolver un error en caso de problemas con la base de datos
    http_response_code(500);
    echo json_encode(array('error' => 'Error al listar superhéroes por editor: ' . $e->getMessage()));
}
?>
