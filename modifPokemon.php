<?php
session_start();
$usuarioLogueado = isset($_SESSION['usuario']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/modificarPokemon.css">
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
    <?php
    if($usuarioLogueado) {
        include_once ('headerUserLogueado.php');
    } else {
        include_once('header.php');
    }
    ?>
</header>

<main>
    <?php
    if( isset($_GET["error"]) ){
        switch ($_GET["error"]){
            case 1:
                echo "<div class='error-message'>Usuario y contraseña inválidos</div>";
                break;
            case 2:
                echo "<div class='error-message'>Debe completar los datos</div>";
                break;
            case 3:
                echo "<div class='error-message'>Error</div>";
                break;
        }
    }
        if($_SESSION['admin'] == 1){
            require_once('php\modificacion.php');
        }else{
            echo "<div><img src='img/msg/acceso_denegado.png' alt='Acceso Denegado' width='960' height='540' </div>";
        }


    ?>
    <form method="get" action="home.php">
        <button class="botonVolver" type="submit">Volver</button>
    </form>
</main>
<footer>
    <?php include('footer.php') ?>
</footer>

</body>
</html>
