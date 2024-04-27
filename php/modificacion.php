<?php

if(isset($_GET['id'])){
    #PROCESS - Buscar datos del ID de db que se desea modificar.

    $timestamp = time();

    $host = "localhost";
    $usuario = "root";
    $contrasenia = "";
    $base_datos = "test";

    $conn = new mysqli($host, $usuario, $contrasenia, $base_datos);

    if ($conn->connect_error) {
        die("Error al conectar con db: " . $conn->connect_error);
    }else{
        echo "<script> console.log('Conexión a db exitosa')</script>";
    }

    $sql1 = "SELECT * FROM pokemon WHERE id_bdd = '".$_GET['id']."'";
    $result1 = $conn->query($sql1);
    $data_old = $result1->fetch_assoc();

    $data_old_archivo = explode( '.' ,$data_old['imagen']);
    $data_old_img = './img/pokemones/'.$data_old['imagen'];
    $data_old_text = file_get_contents('./txt/' . $data_old_archivo[0] . '.txt');

    $sql2 = "SELECT * FROM tipo";
    $result2 = $conn->query($sql2);

    $tiposPokemon = array();

    if ($result2->num_rows > 0) {
        while($row = $result2->fetch_assoc()) {
            $tiposPokemon[] = $row;
        }
    }else{
        echo "<script> console.log('No se pudo obtener la lista de tipos de Pokemon')</script>";
    }

}else{
    echo "<script>
                    alert('Error: ID no seteada.');
                    window.location.href='./index.php'
          </script>";
}
?>

<form action="" method="POST" enctype="multipart/form-data">
    <form action="" method="POST" enctype="multipart/form-data">
        <h2>¿Quien es este pokemon?</h2>
        <label for="id_pokemon">Numero de Pokemon:</label>
        <input type="number" id="id_pokemon" name="id_pokemon" min="0" placeholder="Numero de Pokemon" <?php echo "value='" . $data_old["id_pokemon"] . "'" ?>><br>
        <label for="name_pokemon">Nombre: </label>
        <input type="text" id="name_pokemon" name="name_pokemon" placeholder="Nombre de Pokemon" <?php echo "value='" . $data_old["nombre"] . "'" ?>><br>
        <?php
        echo "<label for='tipo1_pokemon'>Tipo primario:</label>";
        echo "<select id='tipo1_pokemon' name='tipo1_pokemon'>";
        echo "<option value=''></option>";
        foreach ($tiposPokemon as $tipo) {
            echo "<option value='" . $tipo['id_tipo_pokemon'] . "'";
            if($tipo['id_tipo_pokemon'] == $data_old["id_tipo_pokemon1"]){
                echo " selected";
            }
            echo ">" . ucfirst($tipo['descripcion']) . "</option>";
        }
        echo "</select><br>";

        echo "<label for='tipo2_pokemon'>Tipo secundario:</label>";
        echo "<select id='tipo2_pokemon' name='tipo2_pokemon'>";
        echo "<option value=''></option>";
        foreach ($tiposPokemon as $tipo) {
            echo "<option value='" . $tipo['id_tipo_pokemon'] . "'";
            if($tipo['id_tipo_pokemon'] == $data_old["id_tipo_pokemon2"]){
                echo " selected";
            }
            echo ">" . ucfirst($tipo['descripcion']) . "</option>";
        }
        echo "</select><br>";
        ?>
        <label for="img_actual">Imagen actual: </label>
        <img <?php echo "src='" .  $data_old_img . "'"?> alt="Imagen actual de pokemon" width='200' height='200'><br>
        <label for="img_pokemon">Imagen nueva: </label>
        <input type="file" id="img_pokemon" name="img_pokemon"><br>
        <label for="desc_pokemon">Descripcion: </label><br>
        <textarea id="desc_pokemon" name="desc_pokemon" rows="10" cols="100" placeholder="Descripcion del pokemon..."></textarea><br>
        <input type="submit" id="crearPokemon" name="crearPokemon" value="Crear">
    </form>

</form>

<?php
if(isset($_POST['submit'])){

    #TODO - Despues de una confirmacion, que modifique los datos de la BD, imagen si subio una, y texto

    echo "holis"; #Placeholder para que PHPStorm no joda
}