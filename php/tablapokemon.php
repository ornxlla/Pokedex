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

require_once "php/cargarGlobales.php";

$conn = new mysqli($GLOBALS['hostdb'], $GLOBALS['userdb'], $GLOBALS['passdb'], $GLOBALS['schemadb']);
if ($conn->connect_error) {
    die("Error al conectar con db: " . $conn->connect_error . "");
}else{
    echo "<script> console.log('Conexión a db exitosa')</script>";
}
$sql1 = "SELECT * FROM " . $GLOBALS['tablePokemon'];
$result = $conn->query($sql1);
$pokemon = array();
$sql2 = "SELECT * FROM " . $GLOBALS['tableTypes'];
$result2 = $conn->query($sql2);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $pokemon[] = $row;
    }
}else{
    echo "<script> console.log('No se pudo obtener los pokemon')</script>";
}

if ($result2->num_rows > 0) {
    while($row = $result2->fetch_assoc()) {
        $tipo[] = $row;
    }
}else{
    echo "<script> console.log('No se pudo obtener los pokemon')</script>";
}

foreach ($pokemon as $poke) {
    foreach ($tipo as $tipodescrip) {
        if ($poke["id_tipo_pokemon1"] == $tipodescrip["id_tipo_pokemon"]) {
            echo "<a href='vistaPokemon.php?id=" . $poke["id_pokemon"] . "'><div class='tabla'><div class='imagenPoke'> <img src='img/pokemones/" . $poke["imagen"] . "'><div class='nombrePoke'> <p>" . $poke["nombre"] . "</p></div><div class='numeroPoke'><p>#" . $poke["id_pokemon"] . "</p> 
    <img src='img/tipo_" . $tipodescrip["descripcion"] . ".png' style='height: 15px; width: 100px; '></div></a>";

            if (!empty ($poke["id_tipo_pokemon2"])) {
                foreach ($tipo as $segundoTipo) {
                    if ($poke["id_tipo_pokemon2"] == $segundoTipo["id_tipo_pokemon"]) {
                        echo "<div class='tipoPoke'>";
                        echo "<img src='img/tipo_" . $segundoTipo["descripcion"] . ".png' style='height: 15px; width: 100px; '>";
                        echo "</div>";
                    }
                }
            }

            if ($_SESSION['admin'] == 1) {
                echo '<input type="button" name="modificafPokemon" id="modificarPokemon" value="Modificar Pokemon" onclick="modificarPokemon(\'' . $poke["id_bdd"] . '\')"> </br>';
                echo '<input type="button" name="eliminarPokemon" id="eliminarPokemon" value="Eliminar Pokemon" onclick="eliminarPokemon(\'' . $poke["id_bdd"] . '\', \'' . $poke["nombre"] . '\')">';
            }
            echo "</div></div><br>";
        }
    }
}