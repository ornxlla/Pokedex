
<?php
session_start();

if(isset($_SESSION['usuario'])){
    echo "¡¡Bienvenido administrador " . $_SESSION['usuario'] . " !!";
} else {
    header('Location: index.php');
}
