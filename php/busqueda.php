<?php

$host = "localhost";
$usuario = "root";
$contraseña = "";
$base_datos = "pokemon2";


$conn = new mysqli($host, $usuario, $contraseña, $base_datos);


if ($conn->connect_error) {
    die("Error al conectar con la base de datos: " . $conn->connect_error);
}

echo "Conexión exitosa" ;


$sql = "SELECT * FROM pokemon";
$resultado = $conn->query($sql);


if ($resultado->num_rows > 0) {

    echo "<h2>Pokémon:</h2>";
    while ($fila = $resultado->fetch_assoc()) {
        echo "Nombre: " . $fila['nombre'] . "<br>";
        echo "Imagen: <img src='" . $fila['imagen'] . "'><br>";
        echo "Tipo: " . $fila ['tipo'] . "<br>";
        echo "<br>";
    }
} else {
    echo "No se encontraron Pokémon.";
}


?>
