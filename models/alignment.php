<?php
// Conexión a la base de datos (reemplaza con tus propias credenciales)
$mysqli = new mysqli("localhost", "root", "", "superhero");

// Verifica la conexión
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

// Consulta para obtener datos
$result = $mysqli->query("SELECT * FROM superhero.alignment");

// Obtén los datos en formato JSON
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Cierra la conexión
$mysqli->close();

// Devuelve los datos en formato JSON
echo json_encode($data);
?>
