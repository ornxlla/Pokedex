<?php
include('header.php')
?>

<?php

// esto no funciona viendolo
if( isset($_GET["error"]) ){
    switch ($_GET["error"]){
        case 1:
            echo "<div style= color:red >Usuario y contraseña invalidos </div> ";
            break;
        case 2:
            echo "<div style= color:red >Debe completar los datos </div> ";
            break;
        case 3:
            echo "<div style=color:blue >error </div> ";
            break;
    }
}

?>
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

    <main>
                <form action="php/busqueda.php" method="GET">
                        <input type="text" name="q" id="buscar" placeholder="Ingrese el nombre, tipo o número de pokemon">
                        <input type="submit" id="buscarpokemon" name="buscarpokemon" value="¿Quién es este pokemon?">
                </form>
    </main>

</body>
</html>

<?php
include ('footer.php')
?>