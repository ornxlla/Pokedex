<?php
session_start();

function consultarBD($usuario, $contrasenia)
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "usuarios";


    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn) {
        die("Error al conectar con la base de datos: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM login WHERE usuario = '" . $usuario . "' && contrasenia = '" . $contrasenia . "'";
    $result = mysqli_query($conn, $sql);

    return mysqli_num_rows($result) == 1;
}

if (isset($_POST["usuario"]) && isset($_POST["contrasenia"])) {
    $usuario = $_POST["usuario"];
    $contrasenia = $_POST["contrasenia"];

    $esValido = consultarBD($usuario, $contrasenia);

    if ($esValido) {
        $_SESSION["usuario"] = $usuario;
        header("location: home.php");
        exit();
    } else {
        $error_message = "usuario o contraseña incorrectos";
    }
} else {
    $error_message = "ingresar un usuario y una contraseña";
}