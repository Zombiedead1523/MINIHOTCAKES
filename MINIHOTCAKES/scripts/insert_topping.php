<?php
// Incluir la conexión a la base de datos
include('scripts/conexionbd.php');

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnAgregar'])) {
    // Obtener los datos del formulario
    $nombreTopping = trim($_POST['toppingName']);
    $categoria = trim($_POST['category']);

    // Validar los datos del formulario
    if (!empty($nombreTopping) && in_array($categoria, ['cereal', 'untable', 'fruta'])) {
        // Preparar la consulta para insertar el topping
        $stmt = $conexion->prepare("INSERT INTO toppings (nombre, categoria) VALUES (?, ?)");
        if ($stmt) {
            // Bindear los parámetros y ejecutar la consulta
            $stmt->bind_param('ss', $nombreTopping, $categoria);
            if ($stmt->execute()) {
                echo "Topping agregado correctamente.";
            } else {
                echo "Error al agregar el topping: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error al preparar la consulta: " . $conexion->error;
        }
    } else {
        echo "Por favor, completa todos los campos correctamente.";
    }
}

// Cerrar la conexión
$conexion->close();
?>
