<?php
// Incluir la conexión a la base de datos
include('scripts/conexionbd.php');

// Procesar formulario para agregar toppings
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Agregar un topping
    if (isset($_POST['btnAgregar'])) {
        $nombreTopping = trim($_POST['toppingName']);
        $categoria = trim($_POST['category']);

        if (!empty($nombreTopping) && in_array($categoria, ['cereal', 'untable', 'fruta'])) {
            $stmt = $conexion->prepare("INSERT INTO toppings (nombre, categoria) VALUES (?, ?)");
            if ($stmt) {
                $stmt->bind_param('ss', $nombreTopping, $categoria);
                $stmt->execute();
                $stmt->close();
            }
        }
    }

    // Eliminar un topping
    if (isset($_POST['btnEliminar'])) {
        $nombreEliminar = trim($_POST['toppingEliminar']);
        if (!empty($nombreEliminar)) {
            $stmt = $conexion->prepare("DELETE FROM toppings WHERE nombre = ?");
            if ($stmt) {
                $stmt->bind_param('s', $nombreEliminar);
                $stmt->execute();
                $stmt->close();
            }
        }
    }

    // Modificar un topping
    if (isset($_POST['btnModificar'])) {
        $toppingOriginal = trim($_POST['toppingOriginal']);
        $nuevoNombre = trim($_POST['nuevoNombre']);
        $nuevaCategoria = trim($_POST['nuevaCategoria']);

        if (!empty($toppingOriginal) && !empty($nuevoNombre) && in_array($nuevaCategoria, ['cereal', 'untable', 'fruta'])) {
            $stmt = $conexion->prepare("UPDATE toppings SET nombre = ?, categoria = ? WHERE nombre = ?");
            if ($stmt) {
                $stmt->bind_param('sss', $nuevoNombre, $nuevaCategoria, $toppingOriginal);
                $stmt->execute();
                $stmt->close();
            }
        }
    }
}

// Consultar toppings
$sql = $conexion->query("SELECT * FROM toppings WHERE categoria IN ('untable', 'cereal', 'fruta')");

$toppings = [
    'untable' => [],
    'cereal' => [],
    'fruta' => []
];

if ($sql) {
    while ($row = $sql->fetch_assoc()) {
        $toppings[$row['categoria']][] = $row['nombre'];
    }
    $sql->close();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADMIN</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <header>
    <h1>ADMIN</h1>
    <p>🍯🥞</p>
    <nav>
      <a href="index.html">Inicio</a>
      <a href="menu.php">Menú</a>
      <a href="galeria.html">Galería</a>
      <a href="admin_login.php">Admin</a>
    </nav>
  </header>

  <section id="menu">
    <h1>Gestión de Toppings</h1>

    <!-- Formulario para agregar toppings -->
    <h2>Agregar Topping</h2>
    <form method="POST">
      <label for="toppingName">Nombre del Topping:</label>
      <input type="text" id="toppingName" name="toppingName" required>

      <label for="category">Categoría:</label>
      <select id="category" name="category" required>
        <option value="cereal">Cereal</option>
        <option value="untable">Untable</option>
        <option value="fruta">Fruta</option>
      </select>

      <button name="btnAgregar" type="submit">Agregar Topping</button>
    </form>

    <!-- Formulario para eliminar toppings -->
    <h2>Eliminar Topping</h2>
    <form method="POST">
      <label for="toppingEliminar">Selecciona el Topping:</label>
      <select id="toppingEliminar" name="toppingEliminar" required>
        <option value="">-- Selecciona un topping --</option>
        <?php
        foreach ($toppings as $categoria => $items) {
            foreach ($items as $nombre) {
                echo "<option value=\"" . htmlspecialchars($nombre) . "\">" . htmlspecialchars($nombre) . " (" . htmlspecialchars($categoria) . ")</option>";
            }
        }
        ?>
      </select>

      <button name="btnEliminar" type="submit">Eliminar Topping</button>
    </form>

    <!-- Formulario para modificar toppings -->
    <h2>Modificar Topping</h2>
    <form method="POST">
      <label for="toppingOriginal">Selecciona el Topping a Modificar:</label>
      <select id="toppingOriginal" name="toppingOriginal" required>
        <option value="">-- Selecciona un topping --</option>
        <?php
        foreach ($toppings as $categoria => $items) {
            foreach ($items as $nombre) {
                echo "<option value=\"" . htmlspecialchars($nombre) . "\">" . htmlspecialchars($nombre) . " (" . htmlspecialchars($categoria) . ")</option>";
            }
        }
        ?>
      </select>

      <label for="nuevoNombre">Nuevo Nombre:</label>
      <input type="text" id="nuevoNombre" name="nuevoNombre" required>

      <label for="nuevaCategoria">Nueva Categoría:</label>
      <select id="nuevaCategoria" name="nuevaCategoria" required>
        <option value="cereal">Cereal</option>
        <option value="untable">Untable</option>
        <option value="fruta">Fruta</option>
      </select>

      <button name="btnModificar" type="submit">Modificar Topping</button>
    </form>

    <!-- Tabla de toppings -->
    <h2>Tabla de Toppings</h2>
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Nombre</th>
          <th>Categoría</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $counter = 1;
        foreach ($toppings as $categoria => $items) {
            foreach ($items as $nombre) {
                echo "<tr>
                        <td>{$counter}</td>
                        <td>" . htmlspecialchars($nombre) . "</td>
                        <td>" . htmlspecialchars($categoria) . "</td>
                      </tr>";
                $counter++;
            }
        }
        ?>
      </tbody>
    </table>
  </section>

  <footer>
    <p>&copy; 2024 Minihotcakes DON KEKI. Todos los derechos reservados.</p>
  </footer>
</body>

</html>
