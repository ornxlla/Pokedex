<?php

    require_once "php/cargarGlobales.php";

    function checkTodosCampos($id_old, $id_new, $nombre_old, $nombre_new, $tipo1_old, $tipo1_new, $tipo2_old, $tipo2_new){
        #Checkea si hubo cambios. Si todos los campos estan iguales, significa que no hubo cambios.
        echo "<script>
                  console.log('id_old -> " . $id_old . "');
                  console.log('id_new -> " . $id_new . "');
                  console.log('nombre_old -> " . $nombre_old . "');
                  console.log('nombre_new -> " . $nombre_new . "');
                  console.log('tipo1_old -> " . $tipo1_old . "');
                  console.log('tipo1_new -> " . $tipo1_new . "');
                  console.log('tipo2_old -> " . $tipo2_old . "');
                  console.log('tipo2_new -> " . $tipo2_new . "');
              </script>";
        if( $id_old     == $id_new      &&
            $nombre_old == $nombre_new  &&
            $tipo1_old  == $tipo1_new   &&
            $tipo2_old  == $tipo2_new){
            return true;
        }else{
            return false;
        }
    }

    function modificarImagen(){
        $img_pokemon_dir = "./img/pokemones/";
        $img_pokemon_name = $GLOBALS['timestamp'] . '.' . pathinfo($_FILES['img_pokemon']['name'], PATHINFO_EXTENSION);
        $img_pokemon_file = $img_pokemon_dir . $img_pokemon_name;
        $img_flag = 1;
        $returnFlag = true;

        #Check de tipo de archivo
        $check_type = pathinfo($_FILES['img_pokemon']['name'], PATHINFO_EXTENSION);
        if($check_type != 'jpg' && $check_type != 'png' && $check_type != 'jpeg' && $check_type != 'gif'){
            echo "<script>console.log('El archivo no es una imagen')</script>";
            $img_flag = 0;
        }

        #check de que el archivo no exista
        if(file_exists($img_pokemon_file)){
            echo "<script>console.log('El archivo de imagen ya existe'</script>";
            $img_flag = 0;
        }

        #Despues de checkear errores, intenta subir
        if($img_flag == 1){
            if(move_uploaded_file($_FILES['img_pokemon']['tmp_name'], $img_pokemon_file)){
                echo "<script>console.log('Imagen subida exitosamente')</script>";
                $returnFlag = modificarImagen_db($_GET['id'] , $img_pokemon_name );
            }else{
                echo "<script>console.log('Hubo un error al subir la imagen')</script>";
                $returnFlag = false;
            }
        }

        return $returnFlag;
    }

    function modificarImagen_db($id_db, $new_name){
        if($id_db){
            $conn = new mysqli($GLOBALS['hostdb'], $GLOBALS['userdb'], $GLOBALS['passdb'], $GLOBALS['schemadb']);

            if ($conn->connect_error) {
                die("Error al conectar con db: " . $conn->connect_error);
            }else{
                echo "<script> console.log('Conexión a db exitosa')</script>";
            }

            $sql = "UPDATE " . $GLOBALS['tablePokemon'] . " SET imagen = '" . $new_name . "' WHERE id_bdd = " . $id_db;
            if($conn->query($sql) === TRUE){
                $conn->close();
                echo "<script> console.log('Se actualizo la tabla de forma correcta! (Campo Imagen)')</script>";
                $txt_name = $GLOBALS['timestamp'] . '.txt';
                if(modificarImagen_txt($txt_name)){
                    echo "<script> console.log('Se creo el nuevo archivo de txt por consistencia.')</script>";
                    return true;
                }else{
                    echo "<script> console.log('Hubo un problema al crear el archivo txt.')</script>";
                    return false;
                }
            }else{
                $conn->close();
                echo "<script> console.log('Hubo un error al actualizar la tabla')</script>";
                return false;
            }
        }else{
            echo "<script>console.log('Error: ID no seteado!')</script>";
            return false;
        }
    }

    function modificarImagen_txt($new_name){
        $desc_pokemon = $_POST['desc_pokemon'];
        $desc_pokemon_file = './txt/' . $new_name;
        if($new_name){
            if(file_exists($desc_pokemon_file)){
                echo "<script>console.log('El archivo de texto ya existe'</script>";
            }else{
                $archivo = fopen($desc_pokemon_file, "a");
                fwrite($archivo, $desc_pokemon);
                fclose($archivo);
                $GLOBALS['textFile'] = $new_name;
                return true;
            }
        }
        return false;
    }

    function modificarTexto(){
        $desc_pokemon = $_POST['desc_pokemon'];
        $desc_pokemon_file = './txt/' . $GLOBALS['textFile'];
        $archivo = fopen($desc_pokemon_file, "w");
        fwrite($archivo, $desc_pokemon);
        fclose($archivo);
    }

    function modificarDB($id_db ,  $id_new, $nombre_new, $tipo1_new, $tipo2_new){
        $conn = new mysqli($GLOBALS['hostdb'], $GLOBALS['userdb'], $GLOBALS['passdb'], $GLOBALS['schemadb']);

        if ($conn->connect_error) {
            die("Error al conectar con db: " . $conn->connect_error);
        }else{
            echo "<script> console.log('Conexión a db exitosa')</script>";
        }

        if($tipo2_new != ""){
            $sql = "UPDATE " . $GLOBALS['tablePokemon'] .
                   " SET id_pokemon = '"    . $id_new .
                 "', nombre = '"            . $nombre_new .
                 "', id_tipo_pokemon1 = '"  . $tipo1_new .
                 "', id_tipo_pokemon2 = '"  . $tipo2_new .
                  "' WHERE id_bdd = "       . $id_db ;
        }else{
            $sql = "UPDATE ". $GLOBALS['tablePokemon'] .
                    " SET id_pokemon = '"       . $id_new .
                    "', nombre = '"             . $nombre_new .
                    "', id_tipo_pokemon1 = '"   . $tipo1_new .
                    "' WHERE id_bdd = "         . $id_db ;
        }

        if($conn->query($sql) === TRUE){
            $conn->close();
            echo "<script> console.log('Se actualizo la tabla de forma correcta')</script>";
        }else{
            $conn->close();
            echo "<script> console.log('Hubo un error al actualizar la tabla.')</script>";
        }
    }
?>

<?php
if(isset($_GET['id'])){
    #PROCESS - Buscar datos del ID de db que se desea modificar.
    $GLOBALS['timestamp'] = time();

    $conn = new mysqli($GLOBALS['hostdb'], $GLOBALS['userdb'], $GLOBALS['passdb'], $GLOBALS['schemadb']);

    if ($conn->connect_error) {
        die("Error al conectar con db: " . $conn->connect_error);
    }else{
        echo "<script> console.log('Conexión a db exitosa')</script>";
    }

    $sql1 = "SELECT * FROM " . $GLOBALS['tablePokemon'] . " WHERE id_bdd = '" . $_GET['id'] . "'";
    $result1 = $conn->query($sql1);
    $data_old = $result1->fetch_assoc();

    $data_old_archivo = explode( '.' ,$data_old['imagen']);
    $data_old_img = './img/pokemones/'.$data_old['imagen'];
    $data_old_text = file_get_contents('./txt/' . $data_old_archivo[0] . '.txt');
    $GLOBALS['textFile'] = $data_old_archivo[0] . '.txt';

    $sql2 = "SELECT * FROM " . $GLOBALS['tableTypes'] ;
    $result2 = $conn->query($sql2);

    $tiposPokemon = array();

    if ($result2->num_rows > 0) {
        while($row = $result2->fetch_assoc()) {
            $tiposPokemon[] = $row;
        }
    }else{
        echo "<script> console.log('No se pudo obtener la lista de tipos de Pokemon')</script>";
    }
    $conn->close();
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
        echo "<option value='' disabled ></option>";
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
        <label for="img_actual">Imagen actual: </label><br>
        <img <?php echo "src='" .  $data_old_img . "'"?> alt="Imagen actual de pokemon" width='200' height='200'><br>
        <label for="img_pokemon">Imagen nueva: </label>
        <input type="file" id="img_pokemon" name="img_pokemon"><br>
        <label for="desc_pokemon">Descripcion: </label><br>
        <textarea id="desc_pokemon" name="desc_pokemon" rows="10" cols="100" placeholder="Descripcion del pokemon..."><?php echo $data_old_text; ?></textarea><br>
        <input type="submit" id="modifPokemon" name="modificarPokemon" value="Modificar">
    </form>
</form>

<?php
if(isset($_POST['modificarPokemon'])){

    $checkCambios = 0;
    # 0 -> Sin cambios
    # 1 -> Modificar solamente la imagen (Se debe modificar el archivo por consistencia)
    # 2 -> Modificar solamente el archivo
    # 3 -> Modificar solamente la db
    # 4 -> Modificar db + archivo
    # 5 -> Modificar all

    if($_FILES["img_pokemon"]['name'] != ''){
        #Posible 1 / 5
        if( checkTodosCampos($data_old["id_pokemon"], $_POST['id_pokemon'], $data_old["nombre"], $_POST['name_pokemon'], $data_old["id_tipo_pokemon1"], $_POST['tipo1_pokemon'] , $data_old["id_tipo_pokemon2"], $_POST['tipo2_pokemon']) ){
            # 1
            $checkCambios = 1;
        }else{
            # 5
            $checkCambios = 5;
        }
    }elseif($data_old_text != $_POST['desc_pokemon']){
        #Posible 2 / 4
        if( checkTodosCampos($data_old["id_pokemon"], $_POST['id_pokemon'], $data_old["nombre"], $_POST['name_pokemon'], $data_old["id_tipo_pokemon1"], $_POST['tipo1_pokemon'] , $data_old["id_tipo_pokemon2"], $_POST['tipo2_pokemon']) ){
            # 2
            $checkCambios = 2;
        }else{
            # 4
            $checkCambios = 4;
        }
    }elseif(!checkTodosCampos($data_old["id_pokemon"], $_POST['id_pokemon'], $data_old["nombre"], $_POST['name_pokemon'], $data_old["id_tipo_pokemon1"], $_POST['tipo1_pokemon'] , $data_old["id_tipo_pokemon2"], $_POST['tipo2_pokemon'])){
        # 3
        $checkCambios = 3;
    }

    switch($checkCambios){
        case 0:     # Sin cambios
            echo "<script>
                    alert('¡No se ha modificado nada de este pokemon!.');
                    window.location.href='./index.php'
                  </script>";
            break;
        case 1:     # Modificar solamente la imagen (Se debe modificar el archivo por consistencia)
            modificarImagen();
            echo "<script>
                    alert('¡Se ha modificado la imagen del Pokemon!');
                    window.location.href='./modifPokemon.php?id=" . $_GET['id'] . "';
                  </script>";
            break;
        case 2:     # Modificar solamente el archivo
            modificarTexto();
            echo "<script>
                    alert('¡Se ha modificado la descripcion del Pokemon!');
                    window.location.href='./modifPokemon.php?id=" . $_GET['id'] . "';
                  </script>";
            break;
        case 3:     # Modificar solamente la db
            modificarDB($_GET['id'] , $_POST['id_pokemon'] , $_POST['name_pokemon'] , $_POST['tipo1_pokemon'] , $_POST['tipo2_pokemon'] );
            echo "<script>
                    alert('¡Se ha modificado los datos del Pokemon!');
                    window.location.href='./modifPokemon.php?id=" . $_GET['id'] . "';
                  </script>";
            break;
        case 4:     # Modificar db + archivo
            modificarTexto();
            modificarDB($_GET['id'] , $_POST['id_pokemon'] , $_POST['name_pokemon'] , $_POST['tipo1_pokemon'] , $_POST['tipo2_pokemon'] );
            echo "<script>
                    alert('¡Se ha modificado los datos del Pokemon!');
                    window.location.href='./modifPokemon.php?id=" . $_GET['id'] . "';
                  </script>";
            break;
        case 5:     # Modificar all
            modificarImagen();
            modificarTexto();
            modificarDB($_GET['id'] , $_POST['id_pokemon'] , $_POST['name_pokemon'] , $_POST['tipo1_pokemon'] , $_POST['tipo2_pokemon'] );
            echo "<script>
                    alert('¡Se ha modificado los datos del Pokemon!');
                    window.location.href='./modifPokemon.php?id=" . $_GET['id'] . "';
                  </script>";
            break;
    }
}