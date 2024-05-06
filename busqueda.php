<?php
session_start();
$usuarioLogueado = isset($_SESSION['usuario']);
require_once "php/cargarGlobales.php";
?>

<script>
    function modificarPokemon(id){
        window.location.href='modifPokemon.php?id=' + id;
    }

    function eliminarPokemon(id, nombre){
        let msg = "Esta accion no tiene vuelta atras.\n¿Estas seguro que deseas eliminar a " + nombre + "?";
        if(confirm(msg)){
            window.location.href='./php/baja.php?id=' + id;
        }
    }
</script>
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
        include_once('php/headerUserLogueado.php');
    } else {
        include_once('php/header.php');
    }
    ?>
</header>

<main>

    <form class="miFormulario" action="busqueda.php" method="GET">
        <input type="text" name="busqueda" id="buscar" placeholder="Ingrese el nombre, tipo o número de Pokémon">
        <input type="submit" id="buscarpokemon" name="buscarpokemon" value="¿Quién es este Pokémon?">
    </form>

    <div class="pokemon-container">

        <?php

        $conn = new mysqli($GLOBALS['hostdb'], $GLOBALS['userdb'], $GLOBALS['passdb'], $GLOBALS['schemadb']);

        if ($conn->connect_error) {
            die("Error al conectar con la base de datos: " . $conn->connect_error);
        }

        $pokemonBuscado = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';

        $sql = "SELECT p.*, t1.descripcion AS tipo1, t2.descripcion AS tipo2 
        FROM " . $GLOBALS['tablePokemon'] . " p 
        LEFT JOIN " . $GLOBALS['tableTypes'] . " t1 ON p.id_tipo_pokemon1 = t1.id_tipo_pokemon
        LEFT JOIN " . $GLOBALS['tableTypes'] . " t2 ON p.id_tipo_pokemon2 = t2.id_tipo_pokemon
        WHERE p.nombre LIKE '%$pokemonBuscado%' 
        OR t1.descripcion LIKE '%$pokemonBuscado%' 
        OR t2.descripcion LIKE '%$pokemonBuscado%' 
        OR p.id_pokemon = '$pokemonBuscado'";

        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {

            while ($fila = $resultado->fetch_assoc()) {
                echo "<a href='vistaPokemon.php?id=" . $fila["id_pokemon"] . "'>";
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

                echo '</a>';
              if(isset($_SESSION['usuario'])) {
                  if ($_SESSION['admin'] == 1) {
                      echo '<div class="infoPokemon">';
                      echo '<input type="button" class="modificarPokemon" name="modificarPokemon" id="modificarPokemon" value="Modificar Pokemon" onclick="modificarPokemon(\'' . $fila["id_bdd"] . '\')"> </br>';
                      echo '<input type="button" class="eliminarPokemon" name="eliminarPokemon" id="eliminarPokemon" value="Eliminar Pokemon" onclick="eliminarPokemon(\'' . $fila["id_bdd"] . '\', \'' . $fila["nombre"] . '\')">';
                      echo '</div>';
                  }
              }
                echo "</div><br>";
            }
        } else {

            //verifica si ya se hizo la busqueda
            if (!isset($_GET['busqueda']) || $_GET['busqueda'] === '') {
                echo "<div class='error-message'>Introduce un término de búsqueda</div>";
            } else {
                echo "<div class='error-message'><p>Pokemon no encontrado</p></div>";

                //muestra todos los disponibles

                $sql_todos = "SELECT p.*, t1.descripcion AS tipo1, t2.descripcion AS tipo2 
                  FROM " . $GLOBALS['tablePokemon'] . " p 
                  LEFT JOIN " . $GLOBALS['tableTypes'] . " t1 ON p.id_tipo_pokemon1 = t1.id_tipo_pokemon
                  LEFT JOIN " . $GLOBALS['tableTypes'] . " t2 ON p.id_tipo_pokemon2 = t2.id_tipo_pokemon";
                $resultado_todos = $conn->query($sql_todos);

                if ($resultado_todos->num_rows > 0) {
                    while ($fila_todos = $resultado_todos->fetch_assoc()) {
                        echo "<a href='vistaPokemon.php?id=" . $fila_todos["id_pokemon"] . "'>";
                        echo "<div class='tablaBus'>";
                        echo "<div class='imagenPokeBus'> <img src='img/pokemones/" . $fila_todos["imagen"] . "'></div>";
                        echo "<div class='nombrePokeBus'> <p>" . $fila_todos["nombre"] . "</p></div>";
                        echo "<div class='numeroPokeBus'><p>#" . $fila_todos["id_pokemon"] . "</p></div>";

                        if (!empty($fila_todos["tipo1"])) {
                            echo "<div class='tipoPoke'>";
                            echo "<img src='img/tipo_" . $fila_todos["tipo1"] . ".png' style='height: 15px; width: 100px; '>";
                            echo "</div>";
                        }

                        if (!empty($fila_todos["tipo2"])) {
                            echo "<div class='tipoPoke'>";
                            echo "<img src='img/tipo_" . $fila_todos["tipo2"] . ".png' style='height: 15px; width: 100px; '>";
                            echo "</div>";
                        }

                        echo '</a>';
                        if(isset($_SESSION['usuario'])) {
                            if ($_SESSION['admin'] == 1) {
                                echo '<div class="infoPokemon">';
                                echo '<input type="button" class="modificarPokemon" name="modificarPokemon" id="modificarPokemon" value="Modificar Pokemon" onclick="modificarPokemon(\'' . $fila_todos["id_bdd"] . '\')"> </br>';
                                echo '<input type="button" class="eliminarPokemon" name="eliminarPokemon" id="eliminarPokemon" value="Eliminar Pokemon" onclick="eliminarPokemon(\'' . $fila_todos["id_bdd"] . '\', \'' . $fila_todos["nombre"] . '\')">';
                                echo '</div>';
                            }
                        }
                        echo "</div><br>";
                    }
                } else {

                    echo "<div class='errorUser'>No hay Pokémon disponibles</div>";


                }

            }
        }

        ?>
    </div>
        <?php

        if (isset($_GET['busqueda']) && !empty($_GET['busqueda'])) {
            echo '<div>';
            echo '<form method="get" action="index.php">';
            echo '<button class="botonVolver" type="submit">Volver</button>';
            echo '</form>';
            echo '</div>';
        }

        $conn->close();
        ?>



</main>
<footer>
    <?php include('php/footer.php') ?>
</footer>

</body>
</html>
