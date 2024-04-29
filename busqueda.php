<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pixelify+Sans:wght@400..700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pixelify+Sans:wght@400..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Pokedex</title>
</head>
<body>

<header>
    <?php include('header.php') ?>
</header>

<main>
    <?php

    $host = "localhost";
    $usuario = "root";
    $contraseña = "";
    $base_datos = "pokemon2";

    $conn = new mysqli($host, $usuario, $contraseña, $base_datos);

    if ($conn->connect_error) {
        die("Error al conectar con la base de datos: " . $conn->connect_error);
    }
    //echo "conexion exitosa";


    $pokemonBuscado = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';


    $sql = "SELECT * FROM pokemon";
    if (!empty($pokemonBuscado)) {
        $sql .= " WHERE nombre LIKE '%$pokemonBuscado%'";
    }

    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        echo "<h2>Pokémon:</h2>";
        echo "<div class='contenedor'>";
        while ($fila = $resultado->fetch_assoc()) {
            echo "Nombre: " . $fila['nombre'] . "<br>";
            echo "Imagen: <img src='" . $fila['imagen'] . "'><br>";
            echo "Tipo: " . $fila['tipo'] . "<br>";
            echo "<br>";
        }
    } else{
        echo "<div class='error-message'>Pokemon no encontrado</div>";
        $sql = "SELECT * FROM pokemon";
        $resultados = $conn->query($sql);
        echo "<div class='contenedor'>";
        while ($fila = $resultados->fetch_assoc()) {
            echo "Nombre: " . $fila['nombre'] . "<br>";
            echo "Imagen: <img src='" . $fila['imagen'] . "'><br>";
            echo "Tipo: " . $fila['tipo'] . "<br><br>";
        }
        echo "</div>";

    }

    ?>
</main>
<footer>
    <?php include('footer.php') ?>
</footer>

</body>
</html>