<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión - Administrador</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <h1>DONKEKI - Ingreso de Administrador</h1>
        <nav>
            <a href="index.html">Inicio</a>
            <a href="menu.php">Menú</a>
            <a href="galeria.html">Galería</a>
            <a href="admin_login.php">Admin</a>
        </nav>
    </header>
    <?php
    include("scripts\conexionbd.php");
    include("scripts\controlador.php");
    ?>
    <section>
        <h2>Iniciar sesión como Administrador</h2>

        <form action="" method="POST">
            <label for="usuario">Usuario:</label>
            <input type="text" class="input "name="usuario" required>

            <label for="contrasena">Contraseña:</label>
            <input type="password" class="input" name="contrasena" required>

            <button name="btnIngresar" class="btn" type="submit" value="INGRESAR">INGRESAR</button>
        </form>
    </section>

    <footer>
    <p>&copy; 2024 Minihotcakes DON KEKI. Todos los derechos reservados.</p>
    </footer>
    <script src="scripts/interac.js"></script>
</body>

</html>