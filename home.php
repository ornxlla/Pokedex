
<?php
session_start();

if(isset($_SESSION['usuario'])){
    echo "¡¡Bienvenido Usuario" . $_SESSION['usuario'] . " !!";
} else {
    header('Location: index.php');
}
