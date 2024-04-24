<?php
session_start();

// incompleto - en tratamiento
function consultarBD($usuario, $pass) {
    // ...

    return true;
}

if (isset($_POST["usuario"]) && isset($_POST["contrasena"])) {
    $usuario = $_POST["usuario"];
    $pass = $_POST["contrasena"];

    $esValido = consultarBD($usuario, $pass);

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
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokédex</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-12">
            <nav class="navbar navbar-light bg-light">
                <a class="navbar-brand" href="#">
                    <img src="pokemon_logo.png" class="logo" alt="Logo de Pokémon">
                </a>
                <form class="form-inline" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <input class="form-control mr-sm-2" type="text" placeholder="Usuario" name="usuario">
                    <input class="form-control mr-sm-2" type="password" placeholder="Contraseña" name="contrasena">
                    <button class="btn btn-primary" type="submit">Ingresar</button>
                </form>
            </nav>
        </div>
    </div>

    <?php if (isset($error_message)) : ?>
        <div class="row mt-3">
            <div class="col-12">
                <div class="alert alert-danger" role="alert">
                    <?php echo $error_message; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Bootstrap -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
