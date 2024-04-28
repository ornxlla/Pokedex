<?php
    function bajaPokemon($id_db){
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

        $sql = "DELETE FROM pokemon WHERE id_pokemon = " . $id_db;
        if($conn->query($sql) === TRUE){
            echo "<script>console.log('Se ha borrado el registro de forma correcta.')</script>";
            return true;
        }else{
            echo "<script>console.log('Hubo un error al borrar el registro.')</script>";
            return false;
        }
    }