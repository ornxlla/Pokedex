<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/tablapokemon.css">
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
    <nav>
        <div class="logo">
            <img src="img/pokeball.png">
        </div>

        <div class="nombrePag">
            <h1>Pokedex</h1>
        </div>

        <div class="user-info">
            <?php
            if(isset($_SESSION['usuario'])){
                echo "<p class='usuarioBienvenido'>USUARIO:" . $_SESSION['usuario'] . "</p>";
                echo "<div class='usuarioLog'>";
               // echo "<a href='editarPerfil.php'>Editar</a>";
                echo "<a href='index.php'>Cerrar sesión</a>";
                echo "</div>";
            } else {
                echo "<form action='login.php' method='post'>";

            }
            ?>
        </div>
    </nav>
</header>

<main>
    <?php
    if(isset($_SESSION['usuario'])){
        if(isset($_GET['admin']) && $_GET['admin'] == 'true') {
            echo "<h2>Bienvenid@ " . $_SESSION['usuario'] . " (Administrador)</h2>";

        } else {
            echo "<h2>Bienvenid@ " . $_SESSION['usuario'] . "</h2>";
        }
    } else {
        header('Location: index.php');
    }
    ?>

    <form action="busqueda.php" method="GET">
        <input type="text" name="busqueda" id="buscar" placeholder="Ingrese el nombre, tipo o número de Pokémon">
        <input type="submit" id="buscarpokemon" name="buscarpokemon" value="¿Quién es este Pokémon?">
    </form>

    <h2 class="pokd">Pokemones disponibles</h2>
    <div class="pokemonesDisponibles">
        <?php
        include("php/tablapokemon.php")
        ?>
    </div>

    <div class="subirpoke">
        <?php
        if(isset($_SESSION['usuario']) && isset($_GET['admin']) && $_GET['admin'] == 'true') {
            echo "<form action='crearPokemon.php' method='GET'>";
            echo "<input type='submit' name='subirPokemon' id='subirPokemon' value='Subir Pokemon'>";
            echo "</form>";
        }
        ?>
    </div>


</main>


<footer>
    <?php
    include ('footer.php')
    ?>
</footer>

</body>
</html>
