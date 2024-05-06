<?php
session_start();

$usuarioLogueado = isset($_SESSION['usuario']);
require_once "php/cargarGlobales.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/tablapokemon.css">
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
        include('php/headerUserLogueado.php');
    } else {
        include('php/header.php');
    }

    if (isset($_GET['error'])){
        if(isset($_SESSION["error_message"]) && $_GET['error'] == 1){
            echo "<h1 class=\"error-message\">" . $_SESSION["error_message"] . "</h1>";
            unset($_SESSION["error_message"]);
        }elseif($_GET['error'] == 2){
            echo "<h1 class=\"error-message\"> Por favor, complete los datos ! </h1>";
        }
    }
    ?>
</header>

<main>
    <?php
    if(isset($_SESSION['usuario'])){
        if($_SESSION['admin'] == 1) {
            echo "<h2>Bienvenid@ " . $_SESSION['usuario'] . " (Administrador)</h2>";
        } else {
            echo "<h2>Bienvenid@ " . $_SESSION['usuario'] . "</h2>";
        }
    }
    ?>

    <form action="busqueda.php" method="GET">
        <input type="text" name="busqueda" id="buscar" placeholder="Ingrese el nombre, tipo o número de Pokémon">
        <input type="submit" id="buscarpokemon" name="buscarpokemon" value="¿Quién es este Pokémon?">
    </form>

    <h2 class="pokd">Pokemones disponibles</h2>
    <div class="subirpoke">
        <?php
        if(isset($_SESSION['usuario']) && $_SESSION['admin'] == 1) {
            echo "<form action='crearPokemon.php' method='GET'>";
            echo "<input type='submit' name='subirPokemon' id='subirPokemon' value='Subir Pokemon'>";
            echo "</form>";
        }
        ?>
    </div>
    <div class="pokemonesDisponibles">
        <?php
        include("php/tablapokemon.php")
        ?>
    </div>
</main>

<footer>
    <?php
    include('php/footer.php')
    ?>
</footer>

</body>
</html>
