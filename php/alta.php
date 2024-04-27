<?php
$timestamp = time();

$host = "localhost";
$usuario = "root";
$contrasenia = "";
$base_datos = "test";


$conn = new mysqli($host, $usuario, $contrasenia, $base_datos);

if ($conn->connect_error) {
    die("Error al conectar con la base de datos: " . $conn->connect_error);
}else{
    echo "<script> console.log('Conexión a bbdd exitosa')</script>";
}
    $sql = "SELECT * FROM tipo";
    $result = $conn->query($sql);

    $tiposPokemon = array();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $tiposPokemon[] = $row;
        }
    }else{
        echo "<script> console.log('No se pudo obtener la lista de tipos de Pokemon')</script>";
    }

?>
<form action="" method="POST">
    <h2>¿Quien es este pokemon?</h2>
    <label for="id_pokemon">Numero de Pokemon:</label>
    <input type="number" id="id_pokemon" name="id_pokemon" min="0" placeholder="Numero de Pokemon"><br>
    <label for="name_pokemon">Nombre: </label>
    <input type="text" id="name_pokemon" name="name_pokemon" placeholder="Nombre de Pokemon"><br>
    <?php
        echo "<label for='tipo1_pokemon'>Tipo primario:</label>";
        echo "<select id='tipo1_pokemon' name='tipo1_pokemon'>";
        echo "<option value=''></option>";
        foreach ($tiposPokemon as $tipo) {
            echo "<option value='".$tipo['id_tipo_pokemon']."'>".$tipo['descripcion']."</option>";
        }
        echo "</select><br>";

        echo "<label for='tipo2_pokemon'>Tipo secundario:</label>";
        echo "<select id='tipo2_pokemon' name='tipo2_pokemon'>";
        echo "<option value=''></option>";
        foreach ($tiposPokemon as $tipo) {
            echo "<option value='".$tipo['id_tipo_pokemon']."'>".$tipo['descripcion']."</option>";
        }
        echo "</select><br>";
    ?>
    <label for="img_pokemon">Imagen: </label>
    <input type="file" id="img_pokemon" name="img_pokemon"><br>
    <label for="desc_pokemon">Descripcion: </label><br>
    <textarea id="desc_pokemon" name="desc_pokemon" rows="10" cols="100" placeholder="Descripcion del pokemon..."></textarea><br>
    <input type="submit" id="crearPokemon" name="crearPokemon" value="Crear">
</form>

<?php
    if(isset($_POST['crearPokemon'])){
        $errorControl = 0;
        #PROCESO - Guardar imagen del Pokemon en la carpeta img con un nombre unico
        $img_pokemon_dir = "./img/pokemones/";
        $img_pokemon_file = $img_pokemon_dir . $timestamp . '.' . pathinfo($_FILES['img_pokemon']['name'], PATHINFO_EXTENSION);
        $img_flag = 1;

        #Check de tipo de archivo
        $check_type = getimagesize($_FILES['img_pokemon']['tmp_name']);
        if($check_type !== false) {
            echo "<script>alert('El archivo no es una imagen')</script>";
            $img_flag = 0;
            $errorControl = 1;
        }

        #check de que el archivo no exista
        if(file_exists($img_pokemon_file)){
            echo "<script>alert('El archivo ya existe'</script>";
            $img_flag = 0;
            $errorControl = 1;
        }

        #Despues de checkear errores, intenta subir
        if($img_flag == 0){
            if(move_uploaded_file($_FILES['img_pokemon']['tmp_name'], $img_pokemon_file)){
                echo "<script>console.log('Imagen subida exitosamente')</script>";
            }else{
                echo "<script>alert('Hubo un error al subir la imagen')</script>";
                $errorControl = 1;
            }
        }
        #TODO - Guardar descripcion del Pokemon en un archivo .txt, con el mismo nombre que la imagen.
        if($errorControl == 0){

        }
        #TODO - Guardar datos de ID(No autoincremental), Nombre, Tipos y Nombre de imagen del Pokemon en la Base de Datos
        if($errorControl == 0){

        }
        #TODO - Al finalizar guardar, llevarla a la busqueda del mismo pokemon
        echo "<script>alert('holis'); window.location.href='./index.php'</script>"; #Placeholder para que PHPStorm no joda
    }
