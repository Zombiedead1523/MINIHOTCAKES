<?php
// Iniciar sesión

// Conexión a la base de datos (ajusta estos valores a tu configuración)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "donkeki";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir datos del formulario
$user = $_POST["usuario"];
$pass = $_POST["contrasena"];



// Consultar la base de datos
$sql = "SELECT * FROM usuarios WHERE usuario='$user' AND contrasena='$pass'";
$result = $conn->query($sql);

// Verificar si el usuario existe y la contraseña es correcta
if ($result->num_rows > 0) {
    // Iniciar sesión y redirigir
    $_SESSION["usuario"] = $user;
    header("Location: pagina_administrador.php"); // Redirigir a la página del administrador
    exit();
} else {
    echo "Usuario o contraseña incorrectos.";
}

// Cerrar la conexión
$conn->close();
?>
