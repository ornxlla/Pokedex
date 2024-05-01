<script>
    function modificarPokemon(id){
        window.location.href='./modifPokemon.php?id=' + id;
    }

    function eliminarPokemon(id, nombre){
        let msg = "Esta accion no tiene vuelta atras.\n¿Estas seguro que deseas eliminar a " + nombre + "?";
        if(confirm(msg)){
            window.location.href='./php/baja.php?id=' + id;
        }
    }
</script>

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
    echo "<div class='tabla'><div class='imagenPoke'> <img src='img/pokemones/" . $poke["imagen"] . "'><div class='nombrePoke'> <p>" . $poke["nombre"] . "</p></div><div class='numeroPoke'><p>#" . $poke["id_pokemon"] . "</p></div>";

    if(isset($_GET['admin']) && $_GET['admin'] == 'true'){
        echo '<input type="button" name="modificafPokemon" id="modificarPokemon" value="Modificar Pokemon" onclick="modificarPokemon(\'' . $poke["id_bdd"] . '\')"> </br>';
        echo '<input type="button" name="eliminarPokemon" id="eliminarPokemon" value="Eliminar Pokemon" onclick="eliminarPokemon(\'' . $poke["id_bdd"] . '\', \'' . $poke["nombre"] . '\')">';
    }
    echo "</div></div><br>" ;
}

//<form action='modificacion.php' method='GET'> <input type='submit' id='modificarpoke' name='modificarpoke' value='Modificar'></form>
//  <form action='baja.php' method='GET'> <input type='submit' id='bajarpoke' name='bajarpoke' value='Bajar'></form>
