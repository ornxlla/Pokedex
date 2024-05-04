<?php
$timestamp = time();
require_once "php/cargarGlobales.php";

$conn = new mysqli($GLOBALS['hostdb'], $GLOBALS['userdb'], $GLOBALS['passdb'], $GLOBALS['schemadb']);

if ($conn->connect_error) {
    die("Error al conectar con db: " . $conn->connect_error);
}else{
    echo "<script> console.log('Conexión a db exitosa')</script>";
}
    $sql1 = "SELECT * FROM " . $GLOBALS['tableTypes'];
    $result = $conn->query($sql1);

    $tiposPokemon = array();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $tiposPokemon[] = $row;
        }
    }else{
        echo "<script> console.log('No se pudo obtener la lista de tipos de Pokemon')</script>";
    }

?>
<form action="" method="POST" enctype="multipart/form-data">
    <h2>¿Quien es este pokemon?</h2>
    <label for="id_pokemon">Numero de Pokemon:</label>
    <input type="number" id="id_pokemon" name="id_pokemon" min="0" placeholder="Numero de Pokemon"><br>
    <label for="name_pokemon">Nombre: </label>
    <input type="text" id="name_pokemon" name="name_pokemon" placeholder="Nombre de Pokemon"><br>
    <?php
        echo "<label for='tipo1_pokemon'>Tipo primario:</label><br>";
        echo "<select id='tipo1_pokemon' name='tipo1_pokemon'>";
        echo "<option value=''></option>";
        foreach ($tiposPokemon as $tipo) {
            echo "<option value='" . $tipo['id_tipo_pokemon']."'>" . ucfirst($tipo['descripcion']) . "</option>";
        }
        echo "</select><br>";

        echo "<label for='tipo2_pokemon'>Tipo secundario:</label><br>";
        echo "<select id='tipo2_pokemon' name='tipo2_pokemon'>";
        echo "<option value=''></option>";
        foreach ($tiposPokemon as $tipo) {
            echo "<option value='" . $tipo['id_tipo_pokemon'] . "'>" .  ucfirst($tipo['descripcion']) . "</option>";
        }
        echo "</select><br>";
    ?>
    <label for="img_pokemon">Imagen:</label>
    <input type="file" id="img_pokemon" name="img_pokemon"><br>
    <label for="desc_pokemon">Descripcion:</label><br>
    <textarea id="desc_pokemon" name="desc_pokemon" rows="10" cols="100" placeholder="Descripcion del pokemon..."></textarea><br>
    <input type="submit" id="crearPokemon" name="crearPokemon" value="Crear">
</form>

<?php
    if(isset($_POST['crearPokemon'])){
        $errorControl = 0;
        #PROCESO - Guardar imagen del Pokemon en la carpeta img con un nombre unico
        $img_pokemon_dir = "./img/pokemones/";
        $img_pokemon_name = $timestamp . '.' . pathinfo($_FILES['img_pokemon']['name'], PATHINFO_EXTENSION);
        $img_pokemon_file = $img_pokemon_dir . $img_pokemon_name;
        $img_flag = 1;

        #Check de tipo de archivo
        $check_type = pathinfo($_FILES['img_pokemon']['name'], PATHINFO_EXTENSION);
        if($check_type != 'jpg' && $check_type != 'png' && $check_type != 'jpeg' && $check_type != 'gif'){
            echo "<script>console.log('El archivo no es una imagen')</script>";
            $img_flag = 0;
            $errorControl = 1;
        }

        #check de que el archivo no exista
        if(file_exists($img_pokemon_file)){
            echo "<script>console.log('El archivo de imagen ya existe'</script>";
            $img_flag = 0;
            $errorControl = 1;
        }

        #Despues de checkear errores, intenta subir
        if($img_flag == 1){
            if(move_uploaded_file($_FILES['img_pokemon']['tmp_name'], $img_pokemon_file)){
                echo "<script>console.log('Imagen subida exitosamente')</script>";
            }else{
                echo "<script>console.log('Hubo un error al subir la imagen')</script>";
                $errorControl = 1;
            }
        }
        #PROCESO - Guardar descripcion del Pokemon en un archivo .txt, con el mismo nombre que la imagen.
        if($errorControl == 0){
            $desc_pokemon = $_POST['desc_pokemon'];
            $desc_pokemon_file = './txt/' . $timestamp . '.txt';
            if(file_exists($desc_pokemon_file)){
                echo "<script>console.log('El archivo de texto ya existe'</script>";
                $errorControl = 2;
            }else{
                $archivo = fopen($desc_pokemon_file, "a");
                fwrite($archivo, $desc_pokemon);
                fclose($archivo);
            }
        }
        #PROCESO - Guardar datos de ID(No autoincremental), Nombre, Tipos y Nombre de imagen del Pokemon en la Base de Datos
        if($errorControl == 0){
            if(isset($_POST['tipo2_pokemon'])){
                $sql2 = "INSERT INTO " . $GLOBALS['tablePokemon'] . " (id_pokemon, imagen, nombre, id_tipo_pokemon1, id_tipo_pokemon2)
            VALUES ('" . $_POST['id_pokemon'] . "', '" . $img_pokemon_name  . "' , '". $_POST['name_pokemon'] ."' , '" . $_POST['tipo1_pokemon'] . "' , '" . $_POST['tipo2_pokemon'] . "')";
            }else{
                $sql2 = "INSERT INTO " . $GLOBALS['tablePokemon'] . " (id_pokemon, imagen, nombre, id_tipo_pokemon1)
            VALUES ('" . $_POST['id_pokemon'] . "', '" . $img_pokemon_name  . "' , '". $_POST['name_pokemon'] ."' , '" . $_POST['tipo1_pokemon'] . "')";
            }

            if($conn->query($sql2) === TRUE){
                echo "<script> console.log('Pokemon agregado a la db!')</script>";
            }else{
                echo "<script> console.log('Error: " . $sql2 . " / " . $conn->error . "')</script>";
                $errorControl = 3;
            }
            $conn->close();
        }
        #PROCESO - Al finalizar guardar, llevarla a la busqueda del mismo pokemon
        switch($errorControl){
            case 0:
                echo "<script>
                        alert('Se ha creado el pokemon de forma correcta');
                        window.location.href='./index.php'
                      </script>";
                break;
            case 1:
                echo "<script>
                        alert('Hubo un error con la imagen del pokemon. Intentelo nuevamente.');
                        window.location.href='./crearPokemon.php'
                      </script>";
                break;
            case 2:
                echo "<script>
                        alert('Hubo un error con la descripcion del pokemon. Intentelo nuevamente.');
                        window.location.href='./crearPokemon.php'
                      </script>";
                break;
            case 3:
                echo "<script>
                        alert('Hubo un error al crear el pokemon. Intentelo nuevamente.');
                        window.location.href='./crearPokemon.php'
                      </script>";
                break;
            default:
                echo "<script>
                        alert('Hubo un error inesperado. Intentelo nuevamente.');
                        window.location.href='./crearPokemon.php'
                      </script>";
        }
    }
