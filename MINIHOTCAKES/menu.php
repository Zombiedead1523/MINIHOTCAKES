<?php
// Incluir la conexión a la base de datos
include('scripts/conexionbd.php');

// Crear la consulta para obtener los toppings
$sql = $conexion->query("SELECT * FROM toppings WHERE categoria IN ('untable', 'cereal', 'fruta')");
$sql2 = $conexion->query("SELECT * FROM productos");

// Verificar si hay resultados para toppings
$toppings = [
    'untable' => [],
    'cereal' => [],
    'fruta' => []
];

if ($sql && $sql->num_rows > 0) {
    // Clasificar los toppings por categoría
    while ($row = $sql->fetch_assoc()) {
        $toppings[$row['categoria']][] = $row['nombre'];
    }
} else {
    echo "No se encontraron toppings.";
}

// Verificar si hay resultados para productos
$productos = [];
if ($sql2 && $sql2->num_rows > 0) {
    while ($row = $sql2->fetch_assoc()) {
        $productos[] = $row;
    }
} else {
    echo "No se encontraron productos.";
}

// Cerrar las consultas
$sql->close();
$sql2->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menú - Minihotcakes Deliciosos</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header>
    <h1>Menú</h1>
    <p>Endulza tu día con los mejores minihotcakes 🍯🥞</p>
    <nav>
      <a href="index.html">Inicio</a>
      <a href="menu.php">Menú</a>
      <a href="galeria.html">Galería</a>
      <a href="admin_login.php">Admin</a>
    </nav>
  </header> 

  <section id="menu">    
    <div id="productos">
      <h3>Productos</h3>
      <ul>
        <?php
        foreach ($productos as $producto) {
            echo "<li>";
            echo "<strong>Precio:</strong> \${$producto['precio']} pesos<br>";
            echo "<strong>Cantidad de Piezas:</strong> {$producto['cantidad_piezas']}<br>";
            echo "<strong>Tipo de orden:</strong> {$producto['tipo_orden']}<br>";
            echo "</li>";
            if ($producto['tipo_orden']==='grande'){
              echo "Puede elegir 3 toppings en la orden grande";
            }else{
              echo "Puede elegir 2 toppings en la orden chica";
            }
        }
        ?>
      </ul>
    </div>

    <div id="toppings">
      <h3>Toppings Disponibles</h3>

      <h4>Untables</h4>
      <ul data-category="untables">
        <?php
        foreach ($toppings['untable'] as $untable) {
            echo "<li>$untable</li>";
        }
        ?>
      </ul>

      <h4>Cereales</h4>
      <ul data-category="cereales">
        <?php
        foreach ($toppings['cereal'] as $cereal) {
            echo "<li>$cereal</li>";
        }
        ?>
      </ul>

      <h4>Frutas</h4>
      <ul data-category="frutas">
        <?php
        foreach ($toppings['fruta'] as $fruta) {
            echo "<li>$fruta</li>";
        }
        ?>
      </ul>
    </div>
  </section>

  <footer>
    <p>&copy; 2024 Minihotcakes DON KEKI. Todos los derechos reservados.</p>
  </footer>
  <script src="scripts/interac.js"></script> 
</body>
</html>
