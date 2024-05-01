<?php
    //if(isset($_GET['admin']) && $_GET['admin'] == 'true'){
        if(isset($_GET['id'])){
            if($_GET['id']>=1){
                bajaPokemon($_GET['id']);
            }else{
                echo "<script>alert('Error: ID incorrecto.');</script>";
            }
        }else{
            echo "<script>alert('Error: ID no seteado.');</script>";
        }
    //}else{
    //    echo "<script>alert('Error: No tienes permisos para realizar esta accion.');</script>";
    //}


    //header('location:../index.php');

    function bajaPokemon($id_db){
        $host = "localhost";
        $usuario = "root";
        $contrasenia = "";
        $base_datos = "pokemon";

        $conn = new mysqli($host, $usuario, $contrasenia, $base_datos);

        if ($conn->connect_error) {
            die("Error al conectar con db: " . $conn->connect_error);
        }else{
            echo "<script> console.log('Conexión a db exitosa')</script>";
        }

        $sql = "DELETE FROM pokemon WHERE id_bdd = " . $id_db;
        if($conn->query($sql) === TRUE){
            echo "<script>alert('Se ha borrado el registro de forma correcta.')</script>";
        }else{
            echo "<script>alert('Hubo un error al borrar el registro. ')</script>";
        }
        $conn->close();
        echo "<script>window.location.href='../index.php'</script>";
    }