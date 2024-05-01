<?php
$host = "localhost";
$usuario = "root";
$contrasenia = "";
$base_datos = "pokemon";

$conn = new mysqli($host, $usuario, $contrasenia, $base_datos);
if ($conn->connect_error) {
    die("Error al conectar con db: " . $conn->connect_error . "");
}else{
    echo "<script> console.log('Conexión a db exitosa')</script>";
}
$sql1 = "SELECT * FROM pokemon";
$result = $conn->query($sql1);
$pokemon = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $pokemon[] = $row;
    }
}else{
    echo "<script> console.log('No se pudo obtener los pokemon')</script>";
}

foreach ($pokemon as $poke) {
    echo "<div class='tabla'><div class='imagenPoke'> <img src='img/pokemones/" . $poke["imagen"] . "'><div class='nombrePoke'> <p>" . $poke["nombre"] . "</p></div><div class='numeroPoke'><p>#" . $poke["id_pokemon"] . "</p></div>
            </div></div><br>" ;
}

//<form action='modificacion.php' method='GET'> <input type='submit' id='modificarpoke' name='modificarpoke' value='Modificar'></form>
//  <form action='baja.php' method='GET'> <input type='submit' id='bajarpoke' name='bajarpoke' value='Bajar'></form>