<?php
session_start();

require_once "cargarGlobales.php";

function consultarBD($usuario, $contrasenia)
{

    $conn = mysqli_connect($GLOBALS['hostdb'], $GLOBALS['userdb'], $GLOBALS['passdb'], $GLOBALS['schemadb']);

    if (!$conn) {
        die("Error al conectar con la base de datos: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM " . $GLOBALS['tableUsers'] . " WHERE usuario = '" . $usuario . "' AND contrasenia = '" . $contrasenia . "'";
    return mysqli_query($conn, $sql);
}

if (isset($_POST["usuario"]) && isset($_POST["contrasenia"])) {
    $usuario = $_POST["usuario"];
    $contrasenia = $_POST["contrasenia"];


    if (empty($usuario) || empty($contrasenia)) {
        header("location: ./index.php?error=2");
        exit();
    }

    $result = consultarBD($usuario, $contrasenia);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION["usuario"]    = $usuario;
        $_SESSION["admin"]      = $row["es_administrador"];
        header("location: ../home.php");
        exit();
    } else {

        $_SESSION["error_message"] = "Usuario o contraseña incorrecta !";
        header("location: ../index.php?error=1");
        exit();
    }
} elseif (isset($_POST["usuario"]) || isset($_POST["contrasenia"])) {
    header("location: ../index.php?error=2");
    exit();
}

// En login.php después de gestionar el inicio de sesión
if (isset($_GET['logout'])) {
    session_start();
    session_destroy();
    header('Location: ../index.php');
    exit;
}
?>
