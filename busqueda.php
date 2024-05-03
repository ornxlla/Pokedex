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
    if(isset($_SESSION['usuario'])) {
        include('headerUserLogueado.php');
    } else {
        include('header.php');
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
    $contraseña = "";
    $base_datos = "pokemon";

    $conn = new mysqli($host, $usuario, $contraseña, $base_datos);

    if ($conn->connect_error) {
        die("Error al conectar con la base de datos: " . $conn->connect_error);
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

        while ($fila = $resultado->fetch_assoc()) {
            echo "<div class='tablaBus'>";
            echo "<div class='imagenPokeBus'><img src='img/pokemones/" . $fila['imagen'] . "' alt='" . $fila['nombre'] . "'></div>";
            echo "<div class='nombrePokeBus'><p>" . $fila['nombre'] . "</p></div>";
            echo "<div class='numeroPokeBus'><p>#" . $fila['id_pokemon'] . "</p></div>";


            echo "<div class='tipoPoke'>";
            echo "<img src='img/tipo_" . $fila["tipo1"] . ".png' style='height: 15px; width: 100px; '>";
            echo "</div>";

            if (!empty($fila["tipo2"])) {
                echo "<div class='tipoPoke'>";
                echo "<img src='img/tipo_" . $fila["tipo2"] . ".png' style='height: 15px; width: 100px; '>";
                echo "</div>";
            }

            echo "</div>";
        }
    } else {

        //verifica si ya se hizo la busqueda
        if (!isset($_GET['busqueda']) || $_GET['busqueda'] === '') {
            echo "<div class='error-message'>Introduce un término de búsqueda</div>";
        } else {
            echo "<div class='error-message'>Pokemon no encontrado</div>";

            //muestra todos los disponibles
            $sql_todos = "SELECT * FROM pokemon";
            $resultado_todos = $conn->query($sql_todos);

            if ($resultado_todos->num_rows > 0) {

                while ($fila_todos = $resultado_todos->fetch_assoc()) {
                    echo "<div class='tablaBus'>";
                    echo "<div class='imagenPokeBus'><img src='img/pokemones/" . $fila_todos['imagen'] . "' alt='" . $fila_todos['nombre'] . "'></div>";
                    echo "<div class='nombrePokeBus'><p>" . $fila_todos['nombre'] . "</p></div>";
                    echo "<div class='numeroPokeBus'><p>#" . $fila_todos['id_pokemon'] . "</p></div>";
                    echo "</div>";
                }
            } else {

                echo "<div class='error-message'>No hay Pokémon disponibles</div>";
            }
        }
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
