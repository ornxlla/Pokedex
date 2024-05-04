<?php
session_start();
if (isset($_GET['error']) && $_GET['error'] == 1 && isset($_SESSION["error_message"])) {
    echo "<h1 style=\"margin: 1rem; height: 32px; width: 67%; border-radius: 5px; 
    border: 2px solid red; background-color: #FFEFEF;
    text-align: center; font-family: 'Pixelify Sans', sans-serif;
    display: flex;
    display: grid;
    align-items: center;
    color: #e22424; font-size: 1em;\">" . $_SESSION["error_message"] . "</h1>";
    unset($_SESSION["error_message"]);
}
$usuarioLogueado = isset($_SESSION['usuario']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/busqueda.css">
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
    <?php
    if($usuarioLogueado) {
        include_once ('headerUserLogueado.php');
    } else {
        include_once('header.php');
    }
    ?>
</header>

<main>
    <form action="busqueda.php" method="GET">
        <input type="text" name="busqueda" id="buscar" placeholder="Ingrese el nombre, tipo o número de Pokémon">
        <input type="submit" id="buscarpokemon" name="buscarpokemon" value="¿Quién es este Pokémon?">
    </form>

    <?php
    $host = "localhost";
    $usuario = "root";
    $contrasenia = "";
    $base_datos = "pokemon";

    $conn = new mysqli($host, $usuario, $contrasenia, $base_datos);

    if ($conn->connect_error) {
        die("Error al conectar con la base de datos: " . $conn->connect_error);
    }

    // Obtener los tipos de Pokémon
    $sql_tipos = "SELECT * FROM tipo";
    $resultado_tipos = $conn->query($sql_tipos);

    $tipos = array(); // Array para almacenar los tipos de Pokémon
    if ($resultado_tipos->num_rows > 0) {
        while ($fila_tipo = $resultado_tipos->fetch_assoc()) {
            $tipos[] = $fila_tipo;
        }
    }

    $pokemonBuscado = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';

    $sql = "SELECT p.*, t1.descripcion AS tipo1, t2.descripcion AS tipo2 
            FROM pokemon p 
            LEFT JOIN tipo t1 ON p.id_tipo_pokemon1 = t1.id_tipo_pokemon
            LEFT JOIN tipo t2 ON p.id_tipo_pokemon2 = t2.id_tipo_pokemon
            WHERE p.nombre LIKE '%$pokemonBuscado%' 
            OR t1.descripcion LIKE '%$pokemonBuscado%' 
            OR t2.descripcion LIKE '%$pokemonBuscado%' 
            OR p.id_pokemon = '$pokemonBuscado'";

    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        echo "<div class='pokemon-container'>";
        while ($fila = $resultado->fetch_assoc()) {
            echo "<a href='vistaPokemon.php?id=" . $fila["id_pokemon"] . "'>";
            echo "<div class='tablaBus'>";
            echo "<div class='imagenPokeBus'> <img src='img/pokemones/" . $fila["imagen"] . "'></div>";
            echo "<div class='nombrePokeBus'> <p>" . $fila["nombre"] . "</p></div>";
            echo "<div class='numeroPokeBus'><p>#" . $fila["id_pokemon"] . "</p></div>";

            foreach ($tipos as $tipodescrip) {
                if ($fila["id_tipo_pokemon1"] == $tipodescrip["id_tipo_pokemon"]) {
                    echo "<div class='tipoPoke'>";
                    echo "<img src='img/tipo_" . $tipodescrip["descripcion"] . ".png' style='height: 15px; width: 100px; '>";
                    echo "</div>";
                }
            }

            if (!empty($fila["id_tipo_pokemon2"])) {
                foreach ($tipos as $tipodescrip) {
                    if ($fila["id_tipo_pokemon2"] == $tipodescrip["id_tipo_pokemon"]) {
                        echo "<div class='tipoPoke'>";
                        echo "<img src='img/tipo_" . $tipodescrip["descripcion"] . ".png' style='height: 15px; width: 100px; '>";
                        echo "</div>";
                    }
                }
            }

            echo "</div></a>";
        }
        echo "</div>";
    } else {
        echo "<div class='error-message'>No hay Pokémon disponibles</div>";
    }

    if (isset($_GET['busqueda']) && !empty($_GET['busqueda'])) {
        echo '<form method="get" action="home.php">';
        echo '<button class="botonVolver" type="submit">Volver</button>';
        echo '</form>';
    }
    $conn->close();
    ?>
</main>

<footer>
    <?php include('footer.php') ?>
</footer>

</body>
</html>
