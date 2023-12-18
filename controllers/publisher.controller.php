<?php

class Publisher
{
    private $conexion;

    public function __construct()
    {
        // Configura tus credenciales de base de datos aquí
        $host = 'localhost';
        $usuario = 'root';
        $clave = '';
        $base_de_datos = 'superhero';

        // Intenta establecer la conexión
        try {
            $this->conexion = new PDO("mysql:host=$host;dbname=$base_de_datos;charset=utf8", $usuario, $clave);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }

    public function listarEditores()
    {
        try {
            // Llamada al procedimiento almacenado sp_publisher_listar
            $query = "CALL sp_publisher_listar()";
            $stmt = $this->conexion->prepare($query);
            $stmt->execute();

            // Obtener los resultados como un array asociativo
            $editores = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Devolver los resultados en formato JSON
            header('Content-Type: application/json');
            echo json_encode($editores);
        } catch (PDOException $e) {
            die("Error al listar editores: " . $e->getMessage());
        }
    }
}

// Crear una instancia de la clase Publisher
$publisher = new Publisher();

// Llamar a la función listarEditores
$publisher->listarEditores();

?>
