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

    $sql = "SELECT * FROM login WHERE usuario = '" . $usuario . "' AND contrasenia = '" . $contrasenia . "'";
    $result = mysqli_query($conn, $sql);

    return $result;
}

if (isset($_POST["usuario"]) && isset($_POST["contrasenia"])) {
    $usuario = $_POST["usuario"];
    $contrasenia = $_POST["contrasenia"];

    if (empty($usuario) || empty($contrasenia)) {
        header("location: index.php?error=2");
        exit();
    }

    $result = consultarBD($usuario, $contrasenia);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION["usuario"] = $usuario;
        if ($row["es_administrador"] == 1) {
            header("location: home.php?admin=true");
            exit();
        } else {
            header("location: home.php");
            exit();
        }
    } else {
        header("location: index.php?error=1");
        exit();
    }
} elseif (isset($_POST["usuario"]) || isset($_POST["contrasenia"])) {
    header("location: index.php?error=2");
    exit();
}

?>
