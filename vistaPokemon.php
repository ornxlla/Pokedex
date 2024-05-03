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
    <?php
    if(isset($_SESSION['usuario'])) {
        include('headerUserLogueado.php');
    } else {
        include('header.php');
    }
    ?>
</header>
<main>
    <?php

    if(isset($_GET['id'])){
        $GLOBALS['timestamp'] = time();

        $host = "localhost";
        $usuario = "root";
        $contrasenia = "";
        $base_datos = "pokemon";

        $conn = new mysqli($host, $usuario, $contrasenia, $base_datos);

        if ($conn->connect_error) {
            die("Error al conectar con db: " . $conn->connect_error);
        } else {
            echo "<script> console.log('Conexión a db exitosa')</script>";
        }

        $sql1 = "SELECT * FROM pokemon WHERE id_pokemon = '" . $_GET['id'] . "'";
        $result1 = $conn->query($sql1);
        $data_old = $result1->fetch_assoc();
        $pokemon = array();
        $data_old_archivo = explode( '.' ,$data_old['imagen']);
        $data_old_text = file_get_contents('./txt/' . $data_old_archivo[0] . '.txt');

        $sql2 = "SELECT * FROM tipo";
        $result2 = $conn->query($sql2);

        $tiposPokemon = array();

        if ($result2->num_rows > 0) {
            while ($row = $result2->fetch_assoc()) {
                $tiposPokemon[] = $row;
            }
        }

        if (!empty($data_old)) {
            foreach ($tiposPokemon as $tipo) {
                if($tipo['id_tipo_pokemon'] == $data_old['id_tipo_pokemon1']){
                    echo "<h2>" . $data_old['nombre'] . "</h2>";
                    echo "<img src='img/pokemones/" . $data_old['imagen'] . "'>";
                    echo "<p>" .  $data_old_text . "</p>";
                    echo "<img src='img/tipo_" . $tipo['descripcion'] . ".png'>";
                    if (!empty ($data_old["id_tipo_pokemon2"])) {
                        foreach ($tiposPokemon as $segundoTipo) {
                            if ($data_old["id_tipo_pokemon2"] == $segundoTipo["id_tipo_pokemon"]) {
                                echo "<img src='img/tipo_" . $segundoTipo["descripcion"] . ".png' style='height: 15px; width: 100px; '>";
                            }
                        }
                    }
                }
            }
        } else {
            echo "<script> console.log('No se pudo obtener al pokemon deseado')</script>";
        }


        $conn->close();
    }
    ?>


</main>
<footer>
    <?php include('footer.php') ?>
</footer>

</body>
</html>
